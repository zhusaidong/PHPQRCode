<?php
/**
* 二维码生成
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

use PHPQRCode\QRCodeImageGenerate,
	PHPQRCode\DataInMatrix,
	PHPQRCode\QRCodeMask,
	PHPQRCode\ErrorCorrectCode,

	PHPQRCode\QRMode\QRMode,
	PHPQRCode\QRMode\Number,
	PHPQRCode\QRMode\Letter,
	PHPQRCode\QRMode\Mix,
	PHPQRCode\QRMode\Chinese,
	PHPQRCode\QRMode\Binary,

	PHPQRCode\QRData\DataCapacity,
	PHPQRCode\QRData\ErrorCorrectionCode,
	PHPQRCode\QRData\ErrorCorrectionCodingPolynomial,
	PHPQRCode\QRData\AlignmentPattern,
	PHPQRCode\QRData\FormatInformation,
	PHPQRCode\QRData\VersionInformation,
	PHPQRCode\QRData\LogAantilog;

class QRCodeGenerate
{
	/**
	* @var 二维码对象
	*/
	private $qrCodeObject = null;
	
	public function __construct(QRCodeObject $qrCodeObject)
	{
		$this->qrCodeObject = $qrCodeObject;
	}
	/**
	* Step 1 Data analysis 数据分析
	*/
	public function DataAnalysis()
	{
		//区分内容类型,不同类型处理方式不同
		$data = $this->qrCodeObject->content;
		$qrMode = null;
		switch($data)
		{
			case QRMode::isBinary($data):
				$qrMode = new Binary();
				break;
			case QRMode::isNumber($data):
				$qrMode = new Number();
				break;
			case QRMode::isLetter($data):
				$qrMode = new Letter();
				break;
			case QRMode::isChinese($data):
				$qrMode = new Chinese();
				break;
			case QRMode::isMix($data):
				$qrMode = new Mix();
				break;
		}
		$qrMode->setData($data);
		
		//根据数据容量获取二维码版本
		$dataCapacity = new DataCapacity;
		$this->qrCodeObject->version = $dataCapacity->getVersion(strlen($data),$this->qrCodeObject->errorCorrectCode,$qrMode->name);
		
		return $qrMode;
	}
	/**
	* Step 2 Data encodation 数据编码
	*/
	public function DataEncodation(QRMode $qrMode)
	{
		$errorCorrectionCode = new ErrorCorrectionCode;
		$qrMode->setMaxBitLength($errorCorrectionCode->getDataCodeNumber($this->qrCodeObject->version,$this->qrCodeObject->errorCorrectCode));
		$this->qrCodeObject->bits = $qrMode->DataEncodation();
	}
	/**
	* Step 3 Error correction coding 纠错编码
	*/
	public function ErrorCorrectionCoding()
	{
		$polynomial = new Polynomial;
		
		$data = [];
		foreach(str_split($this->qrCodeObject->bits,8) as $key => $value)
		{
			$data[] = base_convert($value,2,10);
		}
		
		//纠错码字数
		$errorCorrectionCode = new ErrorCorrectionCode;
		$ErrorCorrectingCodeNumber = $errorCorrectionCode->getErrorCorrectingCodeNumber($this->qrCodeObject->version,$this->qrCodeObject->errorCorrectCode);
		
		foreach($data as $key => $value)
		{
			$polynomial->setPolynomial($ErrorCorrectingCodeNumber + (count($data) - $key - 1),$value);
		}
		
		//多项式除法
		$errorCorrectionCodingPolynomial = new ErrorCorrectionCodingPolynomial;
		$eccPolynomial = $errorCorrectionCodingPolynomial->getErrorCorrectionCodingPolynomial($ErrorCorrectingCodeNumber);
		
		//重复执行步骤(数据码字的数量)的次。
		//echo '初始值：'.$polynomial."<br>";
		for($i = 0; $i < count($data); $i++)
		{
			$polynomialDivisor = $this->PolynomialCalc($polynomial,$eccPolynomial);
			$polynomial->division($polynomialDivisor);
			//echo '第'.($i + 1).'次运算的除数：'.$polynomialDivisor."<br>";
			//echo '第'.($i + 1).'次运算后结果：'.$polynomial."<br>";
		}
		
		$errorCodeBits = '';
		foreach($polynomial->toArray() as $value)
		{
			$errorCodeBits .= str_pad(base_convert($value,10,2),8,0,STR_PAD_LEFT);
		}
		$this->qrCodeObject->errorCodeBits = $errorCodeBits;
	}
	/**
	* Step 3.1 纠错编码-多项式计算
	*/
	private function PolynomialCalc(Polynomial $polynomial,Polynomial $errorCorrectionCodingPolynomial)
	{
		$first = current($polynomial->getPolynomial());
		$firstecc = current($errorCorrectionCodingPolynomial->getPolynomial());
		
		$errorCorrectionCodingPolynomial->multiplication((new Polynomial)->setPolynomial($first['exponent'] - $firstecc['exponent'],1));
		
		$logAantilog = new LogAantilog;
		$log = $logAantilog->getAlphaByInteger($first['coefficient']);
		
		$polynomial = new Polynomial;
		foreach($errorCorrectionCodingPolynomial->toArray() as $key => $value)
		{
			if($value == 1)
			{
				$value = 0;
			}
			$value += $log;
			if($value > 255)
			{
				$value %= 255;
			}
			$polynomial->setPolynomial($key,$logAantilog->getIntegerByAlpha($value));
		}
		return $polynomial;
	}
	/**
	* Step 4 Structure final message 构造最终信息
	*/
	public function StructureFinalMessage()
	{
		$errorCorrectionCode = new ErrorCorrectionCode;
		$errorCorrectingCodeBlocks = $errorCorrectionCode->getErrorCorrectingCodeBlocks($this->qrCodeObject->version,$this->qrCodeObject->errorCorrectCode);
		if(count($errorCorrectingCodeBlocks['ErrorCorrectingCodeBlocks_1']) == 1 and count($errorCorrectingCodeBlocks['ErrorCorrectingCodeBlocks_2']) == 0)
		{
			//较小版本的二维码仅包括一个数据码字块，具有用于该块的一组纠错码字。在这种情况下，不需要交替排列。只需将纠错码字放置在数据码字之后
			$this->qrCodeObject->finalBits = $this->qrCodeObject->bits . $this->qrCodeObject->errorCodeBits;
		}
		else
		{
			//较大版本的二维码需要分组交替排列
			$errorCorrectingCodeBlocks = array_merge_recursive($errorCorrectingCodeBlocks['ErrorCorrectingCodeBlocks_1'],$errorCorrectingCodeBlocks['ErrorCorrectingCodeBlocks_2']);
			
			$bit = $this->qrCodeObject->bits;
			$bits = str_split($bit,8);
			foreach($bits as $key => $value)
			{
				$bits[$key] = base_convert($value,2,10);
			}
			
			
			$errorCodeBit = $this->qrCodeObject->errorCodeBits;
			$errorCodeBits = str_split($errorCodeBit,8);
			foreach($errorCodeBits as $key => $value)
			{
				$errorCodeBits[$key] = base_convert($value,2,10);
			}
			
			$data = [];
			$a = 0;
			foreach($errorCorrectingCodeBlocks as $key => $value)
			{
				$data[$key] = [
					'bits'			=>array_slice($bits,$a,$value),
					'errorCodeBits'	=>array_slice($errorCodeBits,$key * 18,18),
				];
				$a += $value;
			}
			
			$bits = $errorCodeBits = [];
			foreach($data as $key => $value)
			{
				$bits[] = $value['bits'];
				$errorCodeBits[] = $value['errorCodeBits'];
			}
			
			$bitStr = '';
			for($i = 0; $i < max($errorCorrectingCodeBlocks); $i++)
			{
				foreach($bits as $key => $value)
				{
					$bitStr .= isset($value[$i])?str_pad(base_convert($value[$i],10,2),8,0,STR_PAD_LEFT):'';
				}
			}
			
			$errorCodeBitStr = '';
			for($i = 0; $i < 18; $i++)
			{
				foreach($errorCodeBits as $key => $value)
				{
					$errorCodeBitStr .= isset($value[$i])?str_pad(base_convert($value[$i],10,2),8,0,STR_PAD_LEFT):'';
				}
			}
			
			$this->qrCodeObject->finalBits = $bitStr . $errorCodeBitStr;
		}
	}
	/**
	* Step 5 Module placement in matrix 在矩阵中布置模块
	*/
	public function ModulePlacementInMatrix()
	{
		$qrCodeImage = new QRCodeImageGenerate($this->qrCodeObject->version);
		$qrCodeImage->createQRCodeImage();
		$qrCodeImage->initQRCodeImage($this->qrCodeObject->version);
		
		//蛇形数据处理
		$qrCodeImage = $this->DataInMatrix($qrCodeImage);
		
		$this->qrCodeObject->qrCodeImage = $qrCodeImage;
	}
	/**
	* 在矩阵中布置模块-蛇形数据处理
	*/
	private function DataInMatrix(QRCodeImageGenerate $qrCodeImage)
	{
		$finalBits = str_split($this->qrCodeObject->finalBits,1);
		$bitIndex = 0;
		
		$qrImage = $qrCodeImage->getQRCodeImage();
		$length = $qrCodeImage->getQRCodeImageLength($this->qrCodeObject->version);
		
		//起始坐标
		$dm = new DataInMatrix($length - 1,$length - 1);
		
		//$mask = new QRCodeMask;
		
		$dir_up = TRUE;
		for($i = 0; $i < count($finalBits); $i++)
		{
			//*/
			$bit1 = $finalBits[$i];
			$bit2 = isset($finalBits[$i + 1]) ? $finalBits[$i + 1] : -1;
			/*/
			//test
			$bit1 = $i + 1;
			$bit2 = $bit1 + 1;
			//**/
			
			$point = $dm->getPoint();
			if(!isset($qrImage[$point->x][$point->y]['type']))
			{
				switch($dm->getCurrentDir())
				{
					case DataInMatrix::UP:
						$dir_up = FALSE;
						$dm->changeDir(DataInMatrix::DOWN);
						break;
					case DataInMatrix::DOWN:
						$dir_up = TRUE;
						$dm->changeDir(DataInMatrix::UP);
						break;
				}
				$dm->changeDir(DataInMatrix::LEFT);
				$dm->changeDir(DataInMatrix::LEFT);
				
				$i--;
			}
			elseif($qrImage[$point->x][$point->y]['type'] != QRCodeImageType::DATA)
			{
				while(isset($qrImage[$point->x][$point->y]['type']) and $qrImage[$point->x][$point->y]['type'] != QRCodeImageType::DATA)
				{
					switch($dir_up)
					{
						case TRUE:
							$dm->changeDir(DataInMatrix::UP);
							break;
						case FALSE:
							$dm->changeDir(DataInMatrix::DOWN);
							break;
					}
					$point = $dm->getPoint();
				}
				$i--;
			}
			else
			{
				if($point->y == 4)
				{
					$dm->changeDir(DataInMatrix::RIGHT);
					$point = $dm->getPoint();
				}
				
				//$bit1 = $mask->mode(1,$point->x,$point->y,$bit1);
				$qrCodeImage->mergeByCoordinate($bit1,$point);
				if($bit2 != -1 and isset($qrImage[$point->x][$point->y - 1]['type']) and $qrImage[$point->x][$point->y - 1]['type'] == QRCodeImageType::DATA)
				{
					//$bit2 = $mask->mode(1,$point->x,$point->y - 1,$bit2);
					$qrCodeImage->mergeByCoordinate($bit2,new Point($point->x,$point->y - 1));
					$i++;
				}
				
				switch($dir_up)
				{
					case TRUE:
						$dm->changeDir(DataInMatrix::UP);
						break;
					case FALSE:
						$dm->changeDir(DataInMatrix::DOWN);
						break;
				}
			}
		}
		
		return $qrCodeImage;
	}
	/**
	* Step 6 Masking 掩模
	*/
	public function Masking()
	{
		$mask = new QRCodeMask;
		return $mask->setQRCodeImage($this->qrCodeObject->qrCodeImage);
	}
	/**
	* Step 7 Format and Version Information 格式和版本信息
	*/
	public function FormatAndVersionInformation($maskInfo)
	{
		$version = $this->qrCodeObject->version;
		
		$maskFormat = $maskInfo['mask'];
		$image = $maskInfo['qrCodeImage'];
		
		$qrImageLength = $image->getQRCodeImageLength();
		//保留版本信息区:二维码版本7以上包含两个版本信息
		if($version >= 7)
		{
			$versionInformation = new VersionInformation;
			$versionInfo = $versionInformation->getVersionInformation($version);
			
			$image->merge($image->qrcodeVersionInfomation($versionInfo,QRCodeImageGenerate::VERSION_INFOMATION_DIR_DOWN),new Point(0,$qrImageLength - 7 - 1 - 3));
			$image->merge($image->qrcodeVersionInfomation($versionInfo,QRCodeImageGenerate::VERSION_INFOMATION_DIR_UP),new Point($qrImageLength - 7 - 1 - 3,0));
		}
		
		//保留格式信息区
		$formatInformation = $this->getFormatInformation($maskFormat);
		
		$image->merge($image->qrcodeFormatInfomation($formatInformation,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_UP),new Point(0,8));
		$image->merge($image->qrcodeFormatInfomation($formatInformation,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_DOWN),new Point($qrImageLength - 8 + 1,8));
		$image->merge($image->qrcodeFormatInfomation($formatInformation,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_LEFT),new Point(8,0));
		$image->merge($image->qrcodeFormatInfomation($formatInformation,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_RIGHT),new Point(8,$qrImageLength - 8));
		
		//二维码周围添加2格空白
		$whiteImage = new QRCodeImageGenerate($version);
		$whiteImage->createQRCodeImageByLength($whiteImage->getQRCodeImageLength() + 4);
		$whiteImage->merge($image->toArray(),new Point(2,2));
		
		$this->qrCodeObject->qrCodeImage = $whiteImage;
		unset($whiteImage,$image);
	}
	
	//计算格式信息,文档:http://tiierr.xyz/2017/02/28/%E4%BA%8C%E7%BB%B4%E7%A0%81-%E6%A0%BC%E5%BC%8F%E5%92%8C%E7%89%88%E6%9C%AC%E4%BF%A1%E6%81%AF/
	private function getFormatInformation($maskFormat)
	{
		$formatInformation = new FormatInformation;
		$formatInfo = $formatInformation->getFormatInformation($this->qrCodeObject->errorCorrectCode,$maskFormat);
		return $formatInfo;
	}
	
	/**
	* 输出html二维码
	*/
	public function toQRCode()
	{
		return $this->qrCodeObject->qrCodeImage->toQRCode();
	}
	
	//TODO 输出二维码图片
	public function toImage($imageType)
	{
		
	}
}
