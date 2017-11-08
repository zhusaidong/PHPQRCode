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
		$qrModeInfo = (new QRMode)->getMode($this->qrCodeObject->content);
		//根据数据容量获取二维码版本
		$this->qrCodeObject->version = (new DataCapacity)->getVersion(strlen($this->qrCodeObject->content),$this->qrCodeObject->errorCorrectCode,$qrModeInfo->name);
		return $qrModeInfo;
	}
	/**
	* Step 2 Data encodation 数据编码
	*/
	public function DataEncodation(QRMode $qrModeInfo)
	{
		$qrModeInfo->setMaxBitLength((new ErrorCorrectionCode)->getDataCodeNumber($this->qrCodeObject->version,$this->qrCodeObject->errorCorrectCode));
		$this->qrCodeObject->bits = $qrModeInfo->DataEncodation();
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
		$errorCorrectingCodeNumber = (new ErrorCorrectionCode)->getErrorCorrectingCodeNumber($this->qrCodeObject->version,$this->qrCodeObject->errorCorrectCode);
		
		foreach($data as $key => $value)
		{
			$polynomial->setPolynomial($errorCorrectingCodeNumber + (count($data) - $key - 1),$value);
		}
		
		//多项式除法
		$eccPolynomial = (new ErrorCorrectionCodingPolynomial)->getErrorCorrectionCodingPolynomial($errorCorrectingCodeNumber);
		
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
	private function PolynomialCalc(Polynomial $polynomial,Polynomial $eccPolynomial)
	{
		$first = current($polynomial->getPolynomial());
		$firstecc = current($eccPolynomial->getPolynomial());
		
		$eccPolynomial->multiplication((new Polynomial)->setPolynomial($first['exponent'] - $firstecc['exponent'],1));
		
		$logAantilog = new LogAantilog;
		$log = $logAantilog->getAlphaByInteger($first['coefficient']);
		
		$polynomial = new Polynomial;
		foreach($eccPolynomial->toArray() as $key => $value)
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
		$errorCorrectingCodeBlocks = (new ErrorCorrectionCode)->getErrorCorrectingCodeBlocks($this->qrCodeObject->version,$this->qrCodeObject->errorCorrectCode);
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
	* Step 5.1 在矩阵中布置模块-蛇形数据处理
	*/
	private function DataInMatrix(QRCodeImageGenerate $qrCodeImage)
	{
		$finalBits = $this->qrCodeObject->finalBits;
		
		$_qrImage = $qrImage = $qrCodeImage->getQRCodeImage();
		$_qrImage = end($_qrImage);
		$_qrImage = end($_qrImage);
		
		//起始坐标
		$dm = new DataInMatrix($_qrImage['point']->x,$_qrImage['point']->y);
		
		$dir_up = TRUE;
		for($i = 0; $i < strlen($finalBits); $i++)
		{
			$bit1 = $finalBits[$i];
			$bit2 = isset($finalBits[$i + 1]) ? $finalBits[$i + 1] : -1;
			
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
					$dm->changeDir($dir_up ? DataInMatrix::UP : DataInMatrix::DOWN);
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
				
				$qrCodeImage->mergeByCoordinate($bit1,$point);
				if($bit2 != -1 and isset($qrImage[$point->x][$point->y - 1]['type']) and $qrImage[$point->x][$point->y - 1]['type'] == QRCodeImageType::DATA)
				{
					$qrCodeImage->mergeByCoordinate($bit2,new Point($point->x,$point->y - 1));
					$i++;
				}
				$dm->changeDir($dir_up ? DataInMatrix::UP : DataInMatrix::DOWN);
			}
		}
		
		return $qrCodeImage;
	}
	/**
	* Step 6 Masking 掩模
	*/
	public function Masking()
	{
		return (new QRCodeMask)->setQRCodeImage($this->qrCodeObject->qrCodeImage);
	}
	/**
	* Step 7 Format and Version Information 格式和版本信息
	*/
	public function FormatAndVersionInformation($maskInfo)
	{
		$version = $this->qrCodeObject->version;
		
		$image = $maskInfo['qrCodeImage'];
		
		$qrImageLength = $image->getQRCodeImageLength();
		//保留版本信息区:二维码版本7以上包含两个版本信息
		if($version >= 7)
		{
			$versionInfo = (new VersionInformation)->getVersionInformation($version);
			
			$image->merge($image->qrcodeVersionInfomation($versionInfo,QRCodeImageGenerate::VERSION_INFOMATION_DIR_DOWN),new Point(0,$qrImageLength - 7 - 1 - 3));
			$image->merge($image->qrcodeVersionInfomation($versionInfo,QRCodeImageGenerate::VERSION_INFOMATION_DIR_UP),new Point($qrImageLength - 7 - 1 - 3,0));
		}
		
		//保留格式信息区
		$formatInfo = (new FormatInformation)->getFormatInformation($this->qrCodeObject->errorCorrectCode,$maskInfo['mask']);
		
		$image->merge($image->qrcodeFormatInfomation($formatInfo,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_UP),new Point(0,8));
		$image->merge($image->qrcodeFormatInfomation($formatInfo,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_DOWN),new Point($qrImageLength - 8 + 1,8));
		$image->merge($image->qrcodeFormatInfomation($formatInfo,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_LEFT),new Point(8,0));
		$image->merge($image->qrcodeFormatInfomation($formatInfo,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_RIGHT),new Point(8,$qrImageLength - 8));
		
		//二维码周围添加2格空白
		$whiteImage = new QRCodeImageGenerate($version);
		$whiteImage->createQRCodeImageByLength($whiteImage->getQRCodeImageLength() + 4);
		$whiteImage->merge($image->toArray(),new Point(2,2));
		
		$this->qrCodeObject->qrCodeImage = $whiteImage;
		unset($whiteImage,$image);
	}
	
	/**
	* debug 输出html二维码
	*/
	public function toQRCode()
	{
		return $this->qrCodeObject->qrCodeImage->toQRCode();
	}
	
	/**
	* getQRCodeObject
	* 
	* @return QRCodeObject
	*/
	public function getQRCodeObject()
	{
		return $this->qrCodeObject;
	}
}
