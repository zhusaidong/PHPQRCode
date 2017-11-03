<?php
/**
* 掩码
* 	掩码模式只应用于数据模块和纠错模块
* 	循环8种掩码模式,每种模式分别运用4种评分规则，并相加，取最小的掩码模式
* @author Zsdroid [635925926@qq.com]
*/
namespace PHPQRCode;

class QRCodeMask
{
	private $masks = [];
	private $qrImages = [];
	public $minMask = 0;
	public function __construct()
	{
	}
	public function setQRImage(QRCodeImage $qrImage)
	{
		for($k = 0; $k < 8; $k++)
		{
			$image = $qrImage->toArray();
			$image1 = $qrImage->getQRImage();
			for($i = 0; $i < count($image); $i++)
			{
				for($j = 0; $j < count($image[$i]); $j++)
				{
					$image[$i][$j] = $this->mode($k,$i,$j,$image[$i][$j]);
				}
			}
			$qi = new QRCodeImage;
			$qi->createQRImageBySquareLength(count($image));
			$this->qrImages[$k] = $qi->merge($image);
		}
	}
	//取最小的掩码模式
	public function getQRImage()
	{
		return $this->qrImages[$this->minMask];
	}
	//8种掩码模式
	public function mode($mode = 0,$i,$j,$value)
	{
		$_v = -1;
		switch($mode)
		{
			case 0:
				$_v = ($i + $j) % 2;
				break;
			case 1:
				$_v = $i % 2;
				break;
			case 2:
				$_v = $j % 2;
				break;
			case 3:
				$_v = ($i + $j) % 3;
				break;
			case 4:
				$_v = ( floor($i / 2) + floor($j / 3) ) % 2;
				break;
			case 5:
				$_v = (($i * $j) % 2) + (($i * $j) % 3);
				break;
			case 6:
				$_v = ( (($i * $j) % 2) + (($i * $j) % 3) ) % 2;
				break;
			case 7:
				$_v = ( (($i + $j) % 2) + (($i * $j) % 3) ) % 2;
				break;
		}
		if($_v === 0)
		{
			$arr 	= [1=>0,0=>1];
			$value 	= $arr[$value];
		}
		return $value;
	}
	//4种评分规则
	public function scoringRules_0()
	{
		
	}
}
