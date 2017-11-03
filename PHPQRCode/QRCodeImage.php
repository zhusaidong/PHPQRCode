<?php
/**
* 生成二维码图形
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

class QRCodeImage
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
	
	private $qrImage = [];
	private $toPHPQRCode = FALSE;
	public function __construct($version = 0)
	{
		$version != 0 and $this->createQRImage($version);
	}
	/**
	* 位置探测图形
	*/
	public function qrcodePositionDetection()
	{
		$blocks = [1,0,1,1,1,0,1];
		return $this->Square(7,$blocks);
	}
	/**
	* 校正图形
	*/
	public function qrcodeAlignmentPattern()
	{
		$blocks = [1,0,1,0,1];
		return $this->Square(5,$blocks);
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
	public function qrcodeTimingPatterns($version,$timing_patterns_dir = QRCodeImage::TIMING_PATTERNS_DIR_HORIZONTAL)
	{
		$positions = [];
		for($i = 0; $i <= $this->getSquareLength($version) - 8 * 2; $i++)
		{
			switch($timing_patterns_dir)
			{
				case QRCodeImage::TIMING_PATTERNS_DIR_HORIZONTAL:
					$positions[7 + $i][6] = $i % 2 == 1 ? 1 : 0;
					break;
				case QRCodeImage::TIMING_PATTERNS_DIR_VERTICAL:
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
	public function qrcodeVersionInfomation($versionInfomation,$version_infomation_dir = QRCodeImage::VERSION_INFOMATION_DIR_UP)
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
				case QRCodeImage::VERSION_INFOMATION_DIR_UP:
					$positions[$i%3][$a] = $ver;
					break;
				case QRCodeImage::VERSION_INFOMATION_DIR_DOWN:
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
	public function qrcodeFormatInfomation($formatInfomation,$formatInfomationDir = QRCodeImage::FORMAT_INFOMATION_DIR_UP)
	{
		$formatInfomation_before = substr($formatInfomation,0,8);
		$formatInfomation_after = substr($formatInfomation,8,strlen($formatInfomation));
		
		$positions = [];
		switch($formatInfomationDir)
		{
			case QRCodeImage::FORMAT_INFOMATION_DIR_UP://上
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
			case QRCodeImage::FORMAT_INFOMATION_DIR_DOWN://下
				for($i = 0; $i < strlen($formatInfomation_after); $i++)
				{
					$positions[$i][0] = $formatInfomation_after[$i];
				}
				break;
			case QRCodeImage::FORMAT_INFOMATION_DIR_LEFT://左
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
			case QRCodeImage::FORMAT_INFOMATION_DIR_RIGHT://右
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
	* 生成正方形图形
	* 
	* @param int $position  边长
	* @param array $blocks 黑白分布
	* 
	* @return array $positions 正方形图形数组
	*/
	private function Square($position,$blocks)
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
	* 获取二维码正方形边长
	* 
	* @param int $version 版本
	*/
	public function getSquareLength($version)
	{
		return ($version - 1) * 4 + 21;
	}
	/**
	* 初始化二维码数组
	* @param int $version 版本
	*/
	public function createQRImage($version)
	{
		$this->createQRImageBySquareLength($this->getSquareLength($version));
	}
	/**
	* 根据正方形边长初始化二维码数组
	* 
	* @param int $squareLength 正方形边长
	*/
	public function createQRImageBySquareLength($squareLength)
	{
		for($i = 0; $i < $squareLength; $i++)
		{
			for($j = 0; $j < $squareLength; $j++)
			{
				$this->qrImage[$i][$j] = [
					'data'	=>-1,//数据
					'isUse'	=>0,//是否使用
					'isData'=>0,//是否是数据模块
				];
			}
		}
	}
	/**
	* 获取二维码数组
	*/
	public function getQRImage()
	{
		return $this->qrImage;
	}
	/**
	* 合并坐标
	* 
	* @param int $i 坐标x
	* @param int $j 坐标y
	* @param int $value 值
	* 
	* @return QRCodeImage
	*/
	public function mergeByCoordinate($i,$j,$value)
	{
		return $this->merge([
			$i => [
				$j => $value,
			],
		],[0,0]);
	}
	/**
	* 合并二维数组
	* 
	* @param array $array 二维数组
	* @param array $startCoordinate 起始坐标，默认[0,0]
	* 
	* @return QRCodeImage
	*/
	public function merge($array,$startCoordinate = [0,0])
	{
		foreach($array as $key => $value)
		{
			foreach($value as $kk => $vv)
			{
				$this->qrImage[$startCoordinate[0] + $key][$startCoordinate[1] + $kk] = [
					'data'=>$vv,
					'isUse'=>1
				];
			}
		}
		return $this;
	}
	/**
	* toArray
	*/
	public function toArray()
	{
		$qrImage = [];
		foreach($this->getQRImage() as $key => $value)
		{
			foreach($value as $k => $v)
			{
				$v['data'] == -1 and $v['data'] = 0;
				$qrImage[$key][$k] = $v['data'];
			}
		}
		return $qrImage;
	}
	/**
	* 转成二维码显示方式
	*/
	public function toPHPQRCode()
	{
		$this->toPHPQRCode = TRUE;
		return $this;
	}
	/**
	* __toString
	*/
	public function __toString()
	{
		$str = '';
		$str .= '<table style="text-align:center;" border="0" cellpadding="0" cellspacing="0">'."\n";
		foreach($this->qrImage as $i => $value)
		{
			$str .= '<tr>'."\n";
			foreach($value as $j => $v)
			{
				$vo = $v['data'];
				$textcolor = '';
				$bgcolor = '';
				if($vo == -1 and !$this->toPHPQRCode)
				{
					$bgcolor = ' style="background-color:#7f7f7f;"';
				}
				else if($vo == 1)
				{
					$bgcolor = ' style="background-color:#000000;"';
					$textcolor = ' style="color:#ffffff;"';
				}
				
				$vo == -1 and $vo = 0;
				
				if($this->toPHPQRCode)
				{
					$str .= '<td'.$bgcolor.' style="width:21px;height:21px;">';
				}
				else
				{
					$str .= '<td'.$bgcolor.' style="border: 1px dashed #7f7f7f;">';
				}
				
				if($this->toPHPQRCode)
				{
					$str .= '<span'.$textcolor.' title="('.$i.','.$j.')">&nbsp;&nbsp;&nbsp;</span>';
				}
				else
				{
					$str .= '<span'.$textcolor.'>'.$vo.'<sub>('.$i.','.$j.')</sub>'.'</span>';
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
