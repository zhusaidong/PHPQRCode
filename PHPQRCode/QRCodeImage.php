<?php
/**
* 二维码图像
* 	创建时划分区域，使得数据更好填入，转换和生成
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

use PHPQRCode\Point;
use PHPQRCode\DataSet\AlignmentPattern;

class QRCodeImage
{
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
	private $toColor = FALSE;
	
	public function __construct($version = 0)
	{
		$version != 0 and $this->qrCodeImageLength = ($version - 1) * 4 + 21;
	}
	/**
	* 位置探测图形
	*/
	public function qrcodePositionDetection()
	{
		return $this->createQRCodeSquare([1,0,1,1,1,0,1]);
	}
	/**
	* 校正图形
	*/
	public function qrcodeAlignmentPattern()
	{
		return $this->createQRCodeSquare([1,0,1,0,1]);
	}
	/**
	* 位置探测分隔符图形
	*/
	public function qrcodePositionDetectionDelimiter()
	{
		return $this->createQRCodeSquare([0,0,0,0,0,0,0,0],0);
	}
	
	/**
	* 生成二维码正方形图形
	* 
	* @param array $blocks 黑白分布
	* @param array $color  1黑,0白
	* 
	* @return array $positions 正方形图形数组
	*/
	private function createQRCodeSquare($blocks,$color = 1)
	{
		$position = count($blocks);
		$positions = [];
		for($y = 0; $y < $position; $y++)
		{
			for($x = 0; $x < $position; $x++)
			{
				$positions[$y][$x] = ($y == 0 or $x == 0 or $y == $position - 1 or $x == $position - 1) ? $color : $blocks[$y] * $blocks[$x];
			}
		}
		return $positions;
	}
	/**
	* 矩阵转置
	*/
	public function rotate($arr)
	{
		$b = [];
		foreach($arr as $key => $val)
		{
			foreach($val as $k => $v)
			{
				$b[$k][$key] = $v;
			}
		}
		return $b;
	}
	
	/**
	* Timing Patterns
	* 
	* @param int $version 版本
	* @param boolean $timing_patterns_dir 图形位置
	*/
	public function qrcodeTimingPatterns($version)
	{
		$positions = [];
		for($i = 0; $i <= $this->qrCodeImageLength - 8 * 2; $i++)
		{
			$positions[7 + $i][6] = $i % 2 == 1 ? 1 : 0;
		}
		return $positions;
	}
	/**
	* 版本信息图形
	* 
	* @param string $versionInfomation 版本信息
	* @param int $version_infomation_dir 图形位置
	*/
	public function qrcodeVersionInfomation($versionInfomation)
	{
		if(strlen($versionInfomation) != 18)
		{
			return [];
		}
		
		$versionInfomation = strrev($versionInfomation);
		$positions = [];
		$a = 0;
		for($i = 0; $i < 18; $i++)
		{
			$positions[$i%3][$a] = $versionInfomation[$i];
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
	public function qrcodeFormatInfomation($formatInfomation,$formatInfomationDir = self::FORMAT_INFOMATION_DIR_UP)
	{
		$formatInfomation = strrev($formatInfomation);
		$formatInfomation_before = substr($formatInfomation,0,8);
		$formatInfomation_after = substr($formatInfomation,8,strlen($formatInfomation));
		
		$positions = [];
		switch($formatInfomationDir)
		{
			case self::FORMAT_INFOMATION_DIR_UP://上
				$a = 0;
				for($i = 0; $i < strlen($formatInfomation_before); $i++)
				{
					if($i == 6)
					{
						//小黑块
						$positions[$a][0] = 1;
						$a++;
					}
					$positions[$a][0] = intval($formatInfomation_before[$i]);
					$a++;
				}
				break;
			case self::FORMAT_INFOMATION_DIR_DOWN://下
				for($i = 0; $i < strlen($formatInfomation_after); $i++)
				{
					$positions[$i][0] = intval($formatInfomation_after[$i]);
				}
				break;
			case self::FORMAT_INFOMATION_DIR_LEFT://左
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
					$positions[0][$a] = intval($_formatInfomation_after[$i]);
					$a++;
				}
				break;
			case self::FORMAT_INFOMATION_DIR_RIGHT://右
				$_formatInfomation_before = strrev($formatInfomation_before);
				for($i = 0; $i < strlen($_formatInfomation_before); $i++)
				{
					$positions[0][$i] = intval($_formatInfomation_before[$i]);
				}
				break;
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
		for($y = 0; $y < $qrCodeImageLength; $y++)
		{
			for($x = 0; $x < $qrCodeImageLength; $x++)
			{
				$this->qrCodeImage[$y][$x] = 
				[
					'point'	=>new Point($x,$y),
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
		$qrcodePD = $this->qrcodePositionDetection();
		
		//位置探测分隔符图形
		$qrcodePDD = $this->qrcodePositionDetectionDelimiter();
		
		$this->merge($qrcodePDD,new Point(0,0),QRCodeImageType::POSITION_DETECTION_DELIMITER);
		$this->merge($qrcodePD,new Point(0,0),QRCodeImageType::POSITION_DETECTION);
		
		$this->merge($qrcodePDD,new Point(0,$this->qrCodeImageLength - 8),QRCodeImageType::POSITION_DETECTION_DELIMITER);
		$this->merge($qrcodePD,new Point(0,$this->qrCodeImageLength - 7),QRCodeImageType::POSITION_DETECTION);
		
		$this->merge($qrcodePDD,new Point($this->qrCodeImageLength - 8,0),QRCodeImageType::POSITION_DETECTION_DELIMITER);
		$this->merge($qrcodePD,new Point($this->qrCodeImageLength - 7,0),QRCodeImageType::POSITION_DETECTION);
		
		//校正图形位置
		$qrcodeAlignmentPattern = $this->qrcodeAlignmentPattern();
		$alignmentPattern = new AlignmentPattern;
		$ap = $alignmentPattern->getAlignmentPattern($version);
		if(!empty($ap))
		{
			$ap_min =  min($ap);
			$ap_max =  max($ap);
			foreach($ap as $ap_v1)
			{
				foreach($ap as $ap_v2)
				{
					//排除位置
					if(!(
						($ap_v1 == $ap_min and $ap_v2 == $ap_max) or 
						($ap_v1 == $ap_max and $ap_v2 == $ap_min) or 
						($ap_v1 == $ap_min and $ap_v2 == $ap_min)
					))
					{
						//注:得到的'校正图形位置数据'是'模块中心位置数据',故左上角起始点的坐标要-2
						$this->merge($qrcodeAlignmentPattern,new Point($ap_v1 - 2,$ap_v2 - 2),QRCodeImageType::ALIGNMENT_PATTERN);
					}
				}
			}
		}
		
		//Timing Patterns-分隔条
		$timing_patterns_horizontal = $this->qrcodeTimingPatterns($version);
		$timing_patterns_vertical = $this->rotate($timing_patterns_horizontal);
		$this->merge($timing_patterns_horizontal,new Point(0,0),QRCodeImageType::TIMING_PATTERNS);
		$this->merge($timing_patterns_vertical,new Point(0,0),QRCodeImageType::TIMING_PATTERNS);
		
		//dark module-小黑块,坐标:[8,4 * $version + 9]
		$this->mergeByCoordinate(1,new Point(8,4 * $version + 9),QRCodeImageType::DARK_MODULE);
		
		//保留版本信息区:二维码版本7以上包含两个版本信息
		if($version >= 7)
		{
			$versionInfo = str_pad('',18,0);
			$version_infomation_up = $this->qrcodeVersionInfomation($versionInfo);
			$version_infomation_down = $this->rotate($version_infomation_up);
			$this->merge($version_infomation_up,new Point(0,$this->qrCodeImageLength - 7 - 1 - 3),QRCodeImageType::VERSION_INFOMATION);
			$this->merge($version_infomation_down,new Point($this->qrCodeImageLength - 7 - 1 - 3,0),QRCodeImageType::VERSION_INFOMATION);
		}
		
		//保留格式信息区
		$formatInformation = str_pad('',15,0);
		$this->merge($this->qrcodeFormatInfomation($formatInformation,self::FORMAT_INFOMATION_DIR_UP),new Point(8,0),QRCodeImageType::FORMAT_INFOMATION);
		$this->merge($this->qrcodeFormatInfomation($formatInformation,self::FORMAT_INFOMATION_DIR_DOWN),new Point(8,$this->qrCodeImageLength - 8 + 1),QRCodeImageType::FORMAT_INFOMATION);
		$this->merge($this->qrcodeFormatInfomation($formatInformation,self::FORMAT_INFOMATION_DIR_LEFT),new Point(0,8),QRCodeImageType::FORMAT_INFOMATION);
		$this->merge($this->qrcodeFormatInfomation($formatInformation,self::FORMAT_INFOMATION_DIR_RIGHT),new Point($this->qrCodeImageLength - 8,8),QRCodeImageType::FORMAT_INFOMATION);
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
	* @return QRCodeImage
	*/
	public function mergeByCoordinate($value,Point $point,$qrCodeImageType = NULL)
	{
		return $this->merge([
			$point->y => [
				$point->x => $value,
			],
		],new Point(0,0),$qrCodeImageType);
	}
	/**
	* 合并二维数组
	* 
	* @param array $array 二维数组
	* @param Point $point 点
	* 
	* @return QRCodeImage
	*/
	public function merge($array,Point $point,$qrCodeImageType = NULL)
	{
		foreach($array as $y => $value)
		{
			foreach($value as $x => $vv)
			{
				$this->qrCodeImage[$point->y + $y][$point->x + $x]['bit'] = $vv;
				if($qrCodeImageType != NULL)
				$this->qrCodeImage[$point->y + $y][$point->x + $x]['type'] = $qrCodeImageType;
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
	* 转成二维码显示方式
	*/
	public function toColor()
	{
		$this->toColor = TRUE;
		return $this;
	}
	/**
	* __toString
	*/
	public function __toString()
	{
		$str = '<table style="text-align:center;" border="0" cellpadding="0" cellspacing="0">'."\n";
		foreach($this->qrCodeImage as $y => $value)
		{
			$str .= '<tr>'."\n";
			foreach($value as $x => $v)
			{
				$textcolor = '';
				$bgcolor = '';
				if($this->toColor and $v['type'] === QRCodeImageType::DATA)
				{
					$bgcolor = ' style="background-color:#ff0000;"';
				}
				else
				{
					if($v['bit'] == 1)
					{
						$bgcolor = ' style="background-color:#000000;"';
						$textcolor = ' style="color:#ffffff;"';
					}
				}
				
				if($this->toQRCode)
				{
					$str .= '<td'.$bgcolor.' title="'.$v['point'].'" style="width:21px;height:21px;">';
				}
				else
				{
					$str .= '<td'.$bgcolor.' style="border: 1px dashed #7f7f7f;">';
				}
				
				if($this->toQRCode)
				{
					$str .= '<span'.$textcolor.'>&nbsp;</span>';
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
