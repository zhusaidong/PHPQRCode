<?php
/**
* 二维码生成
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

use PHPQRCode\QRCodeImage,
	PHPQRCode\DataInMatrix,
	PHPQRCode\QRCodeMask,
	PHPQRCode\ErrorCorrectCodeLevel,

	PHPQRCode\CodeMode\CodeMode,
	PHPQRCode\CodeMode\Number,
	PHPQRCode\CodeMode\Letter,
	PHPQRCode\CodeMode\Mix,
	PHPQRCode\CodeMode\Chinese,
	PHPQRCode\CodeMode\Binary,

	PHPQRCode\DataSet\DataCapacity,
	PHPQRCode\DataSet\RemainderBits,
	PHPQRCode\DataSet\ErrorCorrectionCode,
	PHPQRCode\DataSet\ErrorCorrectionCodingPolynomial,
	PHPQRCode\DataSet\AlignmentPattern,
	PHPQRCode\DataSet\FormatInformation,
	PHPQRCode\DataSet\VersionInformation,
	
	PHPQRCode\ReedSolomon\LogAantilog,
	PHPQRCode\ReedSolomon\Polynomial,
	PHPQRCode\ReedSolomon\ReedSolomon;

class QRCodeGenerate
{
	/**
	* @var 二维码对象
	*/
	private $qrCodeObject = null;
	/**
	* @var 二维码Mode
	*/
	private $codeMode = null;
	/**
	* @var 二维码掩码
	*/
	private $qrCodeMask = null;
	
	public function __construct(QRCodeObject $qrCodeObject)
	{
		$this->qrCodeObject = $qrCodeObject;
	}
	/**
	* Step 1 Data analysis 数据分析
	*/
	public function DataAnalysis()
	{
		$this->codeMode = CodeMode::getMode($this->qrCodeObject->content);
		//根据数据容量获取二维码版本
		$this->qrCodeObject->version = (new DataCapacity)->getVersion(strlen($this->qrCodeObject->content),$this->qrCodeObject->errorCorrectionCodeLevel,$this->codeMode->getClassName());
		$this->codeMode->setVersion($this->qrCodeObject->version);
		return $this;
	}
	/**
	* Step 2 Data encodation 数据编码
	*/
	public function DataEncodation()
	{
		$this->codeMode->setMaxBitLength((new ErrorCorrectionCode)->getDataCodeNumber($this->qrCodeObject->version,$this->qrCodeObject->errorCorrectionCodeLevel));
		$this->qrCodeObject->contentBits = $this->codeMode->DataEncodation();
		return $this;
	}
	/**
	* Step 3 Error correction coding 纠错编码
	*/
	public function ErrorCorrectionCoding($debugPolynomial = FALSE)
	{
		$polynomial = new Polynomial;
		
		$data = [];
		foreach(str_split($this->qrCodeObject->contentBits,8) as $value)
		{
			$data[] = base_convert($value,2,10);
		}
		
		//纠错码字数
		$ecc = new ErrorCorrectionCode;
		$eccNumber = $ecc->getErrorCorrectingCodeNumber($this->qrCodeObject->version,$this->qrCodeObject->errorCorrectionCodeLevel);
		
		foreach($data as $key => $value)
		{
			$polynomial->setPolynomial($eccNumber + (count($data) - $key - 1),$value);
		}
		
		//多项式除法
		$eccPolynomial = (new ErrorCorrectionCodingPolynomial)->getErrorCorrectionCodingPolynomial($eccNumber);
		
		if($debugPolynomial)echo 'eccPolynomial：'.$eccPolynomial."<br>\n";//debug
		//重复执行步骤(数据码字的数量)的次。
		for($i = 0; $i < count($data); $i++)
		{
			if($debugPolynomial)echo '第'.($i + 1).'次运算:'."<br>\n";//debug
			if($debugPolynomial)echo '被除数：'.$polynomial."<br>\n";//debug
			$polynomialDivisor = $this->PolynomialCalc($polynomial,$eccPolynomial);
			$polynomial->division($polynomialDivisor);
			if($debugPolynomial)echo '除数：'.$polynomialDivisor."<br>\n";//debug
			if($debugPolynomial)echo '结果：'.$polynomial."<br>\n";//debug
			
			$_polynomial = array_keys($polynomial->toArray());
			if(end($_polynomial) == 0)
			{
				break;
			}
		}
		if($debugPolynomial)exit();//debug
		
		$errorCodeBits = '';
		foreach($polynomial->toArray() as $value)
		{
			$errorCodeBits .= str_pad(base_convert($value,10,2),8,0,STR_PAD_LEFT);
		}
		$this->qrCodeObject->errorCorrectionCodeBits = $errorCodeBits;
		return $this;
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
		$eccBlocks = (new ErrorCorrectionCode)->getErrorCorrectingCodeBlocks($this->qrCodeObject->version,$this->qrCodeObject->errorCorrectionCodeLevel);
		if(count($eccBlocks['ErrorCorrectingCodeBlocks_1']) == 1 and count($eccBlocks['ErrorCorrectingCodeBlocks_2']) == 0)
		{
			//较小版本的二维码仅包括一个数据码字块，具有用于该块的一组纠错码字。在这种情况下，不需要交替排列。只需将纠错码字放置在数据码字之后
			$this->qrCodeObject->finalBits = $this->qrCodeObject->contentBits . $this->qrCodeObject->errorCorrectionCodeBits;
		}
		else
		{
			//较大版本的二维码需要分组交替排列
			$eccBlocks = array_merge_recursive($eccBlocks['ErrorCorrectingCodeBlocks_1'],$eccBlocks['ErrorCorrectingCodeBlocks_2']);
			
			$bit = $this->qrCodeObject->contentBits;
			$bits = str_split($bit,8);
			foreach($bits as $key => $value)
			{
				$bits[$key] = base_convert($value,2,10);
			}
			
			$errorCodeBit = $this->qrCodeObject->errorCorrectionCodeBits;
			$errorCodeBits = str_split($errorCodeBit,8);
			foreach($errorCodeBits as $key => $value)
			{
				$errorCodeBits[$key] = base_convert($value,2,10);
			}
			
			$data = [];
			$a = 0;
			foreach($eccBlocks as $key => $value)
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
			for($i = 0; $i < max($eccBlocks); $i++)
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
		
		//添加 RemainderBits
		//$this->qrCodeObject->finalBits .= str_pad('',(new RemainderBits)->getRemainderBits($this->qrCodeObject->version),0,STR_PAD_RIGHT);
		return $this;
	}
	/**
	* Step 5 Module placement in matrix 在矩阵中布置模块
	*/
	public function ModulePlacementInMatrix()
	{
		$qrCodeImage = new QRCodeImage($this->qrCodeObject->version);
		$qrCodeImage->createQRCodeImage();
		$qrCodeImage->initQRCodeImage($this->qrCodeObject->version);
		
		//蛇形数据处理
		$qrCodeImage = $this->DataInMatrix($qrCodeImage);
		
		//debug
		//echo $qrCodeImage->toQRCode();exit;
		
		$this->qrCodeObject->qrCodeImage = $qrCodeImage;
		return $this;
	}
	/**
	* Step 5.1 在矩阵中布置模块-蛇形数据处理
	*/
	private function DataInMatrix(QRCodeImage $qrCodeImage)
	{
		$finalBits = $this->qrCodeObject->finalBits;
		$finalBits = str_split($finalBits,1);
		
		$_qrImage = $qrImage = $qrCodeImage->getQRCodeImage();
		$_qrImage = end($_qrImage);
		$_qrImage = end($_qrImage);
		
		//起始坐标
		$dm = new DataInMatrix($_qrImage['point']->x,$_qrImage['point']->y);
		
		$dir_up = TRUE;
		
		//debug
		//$finalBits = range(1,count($finalBits));
		
		for($i = 0; $i < count($finalBits); $i++)
		{
			$bit1 = $finalBits[$i];
			$bit2 = isset($finalBits[$i + 1]) ? $finalBits[$i + 1] : -1;
			
			$point = $dm->getPoint();
			if(!isset($qrImage[$point->x][$point->y]['type']))
			{
				if($point->y < 0)
				{
					break;
				}
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
			elseif($point->y == 4)
			{
				$dm->changeDir(DataInMatrix::RIGHT);
				$point->x = 0;
				$dir_up = FALSE;
				$dm->changeDir(DataInMatrix::DOWN);
				$i--;
				continue;
			}
			else
			{
				$qrCodeImage->mergeByCoordinate($bit1,$point);
				if($bit2 != -1 and isset($qrImage[$point->x][$point->y - 1]['type']) and $qrImage[$point->x][$point->y - 1]['type'] == QRCodeImageType::DATA)
				{
					$qrCodeImage->mergeByCoordinate($bit2,new Point($point->x,$point->y - 1));
					$i++;
				}
				$dm->changeDir($dir_up ? DataInMatrix::UP : DataInMatrix::DOWN);
			}
		}
		
		//debug
		//echo $qrCodeImage;exit;
		
		return $qrCodeImage;
	}
	/**
	* Step 6 Masking 掩模
	*/
	public function Masking()
	{
		$this->qrCodeMask = (new QRCodeMask)->setQRCodeImage($this->qrCodeObject);
		return $this;
	}
	/**
	* Step 7 Format and Version Information 格式和版本信息
	*/
	public function FormatAndVersionInformation()
	{
		//二维码周围添加2格空白
		$whiteImage = new QRCodeImage($this->qrCodeObject->version);
		$whiteImage->createQRCodeImageByLength($whiteImage->getQRCodeImageLength() + 4);
		$whiteImage->merge($this->qrCodeMask->toArray(),new Point(2,2));
		
		$this->qrCodeObject->qrCodeImage = $whiteImage;
		unset($whiteImage,$image);
		return $this;
	}
	
	/**
	* debug 输出html二维码
	*/
	public function toQRCode()
	{
		return $this->getQRCodeObject()->qrCodeImage->toQRCode();
	}
	/**
	* debug 输出html二维码
	*/
	public function toColor()
	{
		return $this->getQRCodeObject()->qrCodeImage->toColor();
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
