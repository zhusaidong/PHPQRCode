<?php
/**
* 二维码图像生成
* 	创建时划分区域，使得数据更好填入，转换和生成
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

use PHPQRCode\Point;
use PHPQRCode\QRData\AlignmentPattern;

class QRCodeImageGenerate
{
	//Timing Patterns图形位置
	const TIMING_PATTERNS_DIR_HORIZONTAL = 0;
	const TIMING_PATTERNS_DIR_VERTICAL = 1;
	//版本信息图形位置
	const VERSION_INFOMATION_DIR_UP = 0;
	const VERSION_INFOMATION_DIR_DOWN = 1;
	//格式信息图形位置
	const FORMAT_INFOMATION_DIR_UP = 0;
	const FORMAT_INFOMATION_DIR_DOWN = 1;
	const FORMAT_INFOMATION_DIR_LEFT = 2;
	const FORMAT_INFOMATION_DIR_RIGHT = 3;
	
	/**
	* @var 二维码数组
	*/
	private $qrCodeImage = [];
	/**
	* @var 二维码长度
	*/
	private $qrCodeImageLength = 0;
	private $toQRCode = FALSE;
	public function __construct($version = 0)
	{
		$version != 0 and $this->qrCodeImageLength = ($version - 1) * 4 + 21;
	}
	/**
	* 位置探测图形
	*/
	public function qrcodePositionDetection()
	{
		$blocks = [1,0,1,1,1,0,1];
		return $this->createQRCodeSquare(7,$blocks);
	}
	/**
	* 校正图形
	*/
	public function qrcodeAlignmentPattern()
	{
		$blocks = [1,0,1,0,1];
		return $this->createQRCodeSquare(5,$blocks);
	}
	/**
	* 位置探测分隔符图形
	*/
	public function qrcodePositionDetectionDelimiter()
	{
		$blocks = [0,0,0,0,0,0,0,0];
		$position = 8;
		
		$positions = [];
		for($i = 0; $i < $position; $i++)
		{
			for($j = 0; $j < $position; $j++)
			{
				$positions[$i][$j] = ($i == 0 or $j == 0 or $i == $position - 1 or $j == $position - 1)?0:$blocks[$i] * $blocks[$j];
			}
		}
		return $positions;
	}
	
	/**
	* Timing Patterns
	* 
	* @param int $version 版本
	* @param boolean $timing_patterns_dir 图形位置
	*/
	public function qrcodeTimingPatterns($version,$timing_patterns_dir = QRCodeImageGenerate::TIMING_PATTERNS_DIR_HORIZONTAL)
	{
		$positions = [];
		for($i = 0; $i <= $this->qrCodeImageLength - 8 * 2; $i++)
		{
			switch($timing_patterns_dir)
			{
				case QRCodeImageGenerate::TIMING_PATTERNS_DIR_HORIZONTAL:
					$positions[7 + $i][6] = $i % 2 == 1 ? 1 : 0;
					break;
				case QRCodeImageGenerate::TIMING_PATTERNS_DIR_VERTICAL:
					$positions[6][7 + $i] = $i % 2 == 1 ? 1 : 0;
					break;
			}
		}
		return $positions;
	}
	/**
	* 版本信息图形
	* 
	* @param string $versionInfomation 版本信息
	* @param int $version_infomation_dir 图形位置
	*/
	public function qrcodeVersionInfomation($versionInfomation,$version_infomation_dir = QRCodeImageGenerate::VERSION_INFOMATION_DIR_UP)
	{
		if(strlen($versionInfomation) != 18)
		{
			return [];
		}
		
		$versionInfomation = strrev($versionInfomation);
		$positions = [];
		$a = 0;
		for($i = 0; $i < strlen($versionInfomation); $i++)
		{
			$ver = $versionInfomation[$i];
			switch($version_infomation_dir)
			{
				case QRCodeImageGenerate::VERSION_INFOMATION_DIR_UP:
					$positions[$i%3][$a] = $ver;
					break;
				case QRCodeImageGenerate::VERSION_INFOMATION_DIR_DOWN:
					$positions[$a][$i%3] = $ver;
					break;
			}
			if($i%3 == 2)
			{
				$a++;
			}
		}
		return $positions;
	}
	/**
	* 格式信息图形(有4个)
	* 
	* @param string $formatInfomation 格式信息
	* @param int $formatInfomationDir 图形位置
	*/
	public function qrcodeFormatInfomation($formatInfomation,$formatInfomationDir = QRCodeImageGenerate::FORMAT_INFOMATION_DIR_UP)
	{
		$formatInfomation = strrev($formatInfomation);
		$formatInfomation_before = substr($formatInfomation,0,8);
		$formatInfomation_after = substr($formatInfomation,8,strlen($formatInfomation));
		
		$positions = [];
		switch($formatInfomationDir)
		{
			case QRCodeImageGenerate::FORMAT_INFOMATION_DIR_UP://上
				$a = 0;
				for($i = 0; $i < strlen($formatInfomation_before); $i++)
				{
					if($i == 6)
					{
						//小黑块
						$positions[$a][0] = 1;
						$a++;
					}
					$positions[$a][0] = $formatInfomation_before[$i];
					$a++;
				}
				break;
			case QRCodeImageGenerate::FORMAT_INFOMATION_DIR_DOWN://下
				for($i = 0; $i < strlen($formatInfomation_after); $i++)
				{
					$positions[$i][0] = $formatInfomation_after[$i];
				}
				break;
			case QRCodeImageGenerate::FORMAT_INFOMATION_DIR_LEFT://左
				$a = 0;
				$_formatInfomation_after = strrev($formatInfomation_after);
				for($i = 0; $i < strlen($_formatInfomation_after); $i++)
				{
					if($i == 6)
					{
						//小黑块
						$positions[0][$a] = 1;
						$a++;
					}
					$positions[0][$a] = $_formatInfomation_after[$i];
					$a++;
				}
				break;
			case QRCodeImageGenerate::FORMAT_INFOMATION_DIR_RIGHT://右
				$_formatInfomation_before = strrev($formatInfomation_before);
				for($i = 0; $i < strlen($_formatInfomation_before); $i++)
				{
					$positions[0][$i] = $_formatInfomation_before[$i];
				}
				break;
		}
		return $positions;
	}
	
	/**
	* 生成二维码正方形图形
	* 
	* @param int $position  边长
	* @param array $blocks 黑白分布
	* 
	* @return array $positions 正方形图形数组
	*/
	private function createQRCodeSquare($position,$blocks)
	{
		$positions = [];
		for($i = 0; $i < $position; $i++)
		{
			for($j = 0; $j < $position; $j++)
			{
				$positions[$i][$j] = ($i == 0 or $j == 0 or $i == $position - 1 or $j == $position - 1)?1:$blocks[$i] * $blocks[$j];
			}
		}
		return $positions;
	}
	/**
	* 初始化二维码数组
	*/
	public function createQRCodeImage()
	{
		$this->createQRCodeImageByLength($this->qrCodeImageLength);
	}
	/**
	* 根据边长初始化二维码数组
	* 
	* @param int $qrCodeImageLength 正方形边长
	*/
	public function createQRCodeImageByLength($qrCodeImageLength)
	{
		for($i = 0; $i < $qrCodeImageLength; $i++)
		{
			for($j = 0; $j < $qrCodeImageLength; $j++)
			{
				$this->qrCodeImage[$i][$j] = 
				[
					'point'	=>new Point($i,$j),
					'bit'	=>0,
					'type'	=>QRCodeImageType::DATA,
				];
			}
		}
	}
	
	/**
	* 初始化 QRCodeImage
	* 	图形分2部分
	* 		1.静态图形，如位置探测图形，直接在初始化时写入
	* 		2.动态图形，如数据图形，先分配位置标识，再写入数据
	*/
	public function initQRCodeImage($version)
	{
		//位置探测图形
		$qrcodePositionDetection = $this->qrcodePositionDetection();
		
		//位置探测分隔符图形
		$qrcodePositionDetectionDelimiter = $this->qrcodePositionDetectionDelimiter();
		
		$this->merge($qrcodePositionDetectionDelimiter,new Point(0,0),QRCodeImageType::POSITION_DETECTION_DELIMITER);
		$this->merge($qrcodePositionDetection,new Point(0,0),QRCodeImageType::POSITION_DETECTION);
		
		$this->merge($qrcodePositionDetectionDelimiter,new Point(0,$this->qrCodeImageLength - 8),QRCodeImageType::POSITION_DETECTION_DELIMITER);
		$this->merge($qrcodePositionDetection,new Point(0,$this->qrCodeImageLength - 7),QRCodeImageType::POSITION_DETECTION);
		
		$this->merge($qrcodePositionDetectionDelimiter,new Point($this->qrCodeImageLength - 8,0),QRCodeImageType::POSITION_DETECTION_DELIMITER);
		$this->merge($qrcodePositionDetection,new Point($this->qrCodeImageLength - 7,0),QRCodeImageType::POSITION_DETECTION);
		
		//校正图形位置
		$qrcodeAlignmentPattern = $this->qrcodeAlignmentPattern();
		$alignmentPattern = new AlignmentPattern;
		$ap = $alignmentPattern->getAlignmentPattern($version);
		foreach($ap as $value1)
		{
			foreach($ap as $value2)
			{
				//排除位置
				if(!(
					($value1 == min($ap) and $value2 == max($ap)) or 
					($value1 == max($ap) and $value2 == min($ap)) or 
					($value1 == min($ap) and $value2 == min($ap))
				))
				{
					//注:得到的'校正图形位置数据'是'模块中心位置数据',故左上角起始点的坐标要-2
					$this->merge($qrcodeAlignmentPattern,new Point($value1 - 2,$value2 - 2),QRCodeImageType::ALIGNMENT_PATTERN);
				}
			}
		}
		
		//Timing Patterns-分隔条
		$this->merge($this->qrcodeTimingPatterns($version,QRCodeImageGenerate::TIMING_PATTERNS_DIR_HORIZONTAL),new Point(0,0),QRCodeImageType::TIMING_PATTERNS);
		$this->merge($this->qrcodeTimingPatterns($version,QRCodeImageGenerate::TIMING_PATTERNS_DIR_VERTICAL),new Point(0,0),QRCodeImageType::TIMING_PATTERNS);
		
		//dark module-小黑块,坐标:[4 * $version + 9,8]
		$this->mergeByCoordinate(1,new Point(4 * $version + 9,8),QRCodeImageType::DARK_MODULE);
		
		
		//保留版本信息区:二维码版本7以上包含两个版本信息
		if($version >= 7)
		{
			$versionInfo = '000000000000000000';
			$this->merge($this->qrcodeVersionInfomation($versionInfo,QRCodeImageGenerate::VERSION_INFOMATION_DIR_DOWN),new Point(0,$this->qrCodeImageLength - 7 - 1 - 3),QRCodeImageType::VERSION_INFOMATION);
			$this->merge($this->qrcodeVersionInfomation($versionInfo,QRCodeImageGenerate::VERSION_INFOMATION_DIR_UP),new Point($this->qrCodeImageLength - 7 - 1 - 3,0),QRCodeImageType::VERSION_INFOMATION);
		}
		
		//保留格式信息区
		$formatInformation = '000000000000000';
		$this->merge($this->qrcodeFormatInfomation($formatInformation,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_UP),new Point(0,8),QRCodeImageType::FORMAT_INFOMATION);
		$this->merge($this->qrcodeFormatInfomation($formatInformation,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_DOWN),new Point($this->qrCodeImageLength - 8 + 1,8),QRCodeImageType::FORMAT_INFOMATION);
		$this->merge($this->qrcodeFormatInfomation($formatInformation,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_LEFT),new Point(8,0),QRCodeImageType::FORMAT_INFOMATION);
		$this->merge($this->qrcodeFormatInfomation($formatInformation,QRCodeImageGenerate::FORMAT_INFOMATION_DIR_RIGHT),new Point(8,$this->qrCodeImageLength - 8),QRCodeImageType::FORMAT_INFOMATION);
	}	
	
	/**
	* 获取二维码数组
	*/
	public function getQRCodeImage()
	{
		return $this->qrCodeImage;
	}
	/**
	* 获取二维码长度
	*/
	public function getQRCodeImageLength()
	{
		return $this->qrCodeImageLength;
	}
	
	/**
	* 合并坐标
	* 
	* @param int $value 值
	* @param Point $point 点
	* 
	* @return QRCodeImageGenerate
	*/
	public function mergeByCoordinate($value,Point $point,$qrCodeImageType = NULL)
	{
		return $this->merge([
			$point->x => [
				$point->y => $value,
			],
		],new Point(0,0),$qrCodeImageType);
	}
	/**
	* 合并二维数组
	* 
	* @param array $array 二维数组
	* @param Point $point 点
	* 
	* @return QRCodeImageGenerate
	*/
	public function merge($array,Point $point,$qrCodeImageType = NULL)
	{
		foreach($array as $key => $value)
		{
			foreach($value as $kk => $vv)
			{
				$this->qrCodeImage[$point->x + $key][$point->y + $kk]['bit'] = $vv;
				if($qrCodeImageType != NULL)
				$this->qrCodeImage[$point->x + $key][$point->y + $kk]['type'] = $qrCodeImageType;
			}
		}
		return $this;
	}
	
	/**
	* toArray
	*/
	public function toArray()
	{
		$qrCodeImage = [];
		foreach($this->getQRCodeImage() as $key => $value)
		{
			foreach($value as $k => $v)
			{
				$qrCodeImage[$key][$k] = $v['bit'];
			}
		}
		return $qrCodeImage;
	}
	/**
	* 转成二维码显示方式
	*/
	public function toQRCode()
	{
		$this->toQRCode = TRUE;
		return $this;
	}
	/**
	* __toString
	*/
	public function __toString()
	{
		$str = '';
		$str .= '<table style="text-align:center;" border="0" cellpadding="0" cellspacing="0">'."\n";
		foreach($this->qrCodeImage as $i => $value)
		{
			$str .= '<tr>'."\n";
			foreach($value as $j => $v)
			{
				if($v['bit'] == 1)
				{
					$bgcolor = ' style="background-color:#000000;"';
					$textcolor = ' style="color:#ffffff;"';
				}
				else
				{
					$textcolor = '';
					$bgcolor = '';
				}
				
				if($this->toQRCode)
				{
					$str .= '<td'.$bgcolor.' style="width:21px;height:21px;">';
				}
				else
				{
					$str .= '<td'.$bgcolor.' style="border: 1px dashed #7f7f7f;">';
				}
				
				if($this->toQRCode)
				{
					$str .= '<span'.$textcolor.' title="'.$v['point'].'">&nbsp;</span>';
				}
				else
				{
					$str .= '<span'.$textcolor.'>'.$v['bit'].'<sub>'.$v['point'].'</sub>'.'</span>';
				}
				$str .= '</td>'."\n";
			}
			$str .= '</tr>'."\n";
		}
		$str .= '</table>'."\n";
		$str .= '<br>'."\n";
		
		return $str;
	}
}

class QRCodeImageType
{
	const DATA = 0;
	//位置探测图形
	const POSITION_DETECTION = 1;
	//校正图形
	const ALIGNMENT_PATTERN = 2;
	//位置探测分隔符图形
	const POSITION_DETECTION_DELIMITER = 3;
	//Timing Patterns图形
	const TIMING_PATTERNS = 4;
	//版本信息图形位置
	const VERSION_INFOMATION = 5;
	//格式信息图形位置
	const FORMAT_INFOMATION = 6;
	//小黑块
	const DARK_MODULE = 7;
}
