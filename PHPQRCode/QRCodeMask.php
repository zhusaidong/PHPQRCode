<?php
/**
* 掩码
* 	掩码模式只应用于数据模块和纠错模块
* 	循环8种掩码模式,每种模式分别运用4种评分规则，并相加，取最小的掩码模式
* @author Zsdroid [635925926@qq.com]
*/
namespace PHPQRCode;

use PHPQRCode\QRData\FormatInformation,
	PHPQRCode\QRData\VersionInformation;
	
class QRCodeMask
{
	public function __construct()
	{
	}
	public function setQRCodeImage(QRCodeImageGenerate $qrCodeImage)
	{
		$qrCodeImageTotals = [];
		$qrCodeImages = [];
		for($k = 0; $k < 8; $k++)
		{
			$_temp = clone $qrCodeImage;
			$image = $_temp->getQRCodeImage();
			for($i = 0; $i < count($image); $i++)
			{
				for($j = 0; $j < count($image[$i]); $j++)
				{
					$_image = $image[$i][$j];
					if($_image['type'] == QRCodeImageType::DATA)
					{
						$_temp->mergeByCoordinate($this->mode($k,$i,$j,$_image['bit']),$_image['point']);
					}
				}
			}
			
			$qrCodeImages[$k] = $_temp;
			$qrCodeImageTotals[$k] = 0;
			for($i = 0; $i < 4; $i++)
			{
				$qrCodeImageTotals[$k] += call_user_func_array([$this,'scoringRules_'.$i],[$_temp]);
			}
		}
		uasort($qrCodeImageTotals,function($a,$b){return $a - $b <= 0 ? - 1 : 1;});
		
		//debug
		//var_dump($qrCodeImageTotals);foreach($qrCodeImageTotals as $key => $value)echo '掩码:',$key.'=>'.'值:'.$value.$qrCodeImages[$key]->toQRCode();exit;
		
		$minMask = array_search(min($qrCodeImageTotals),$qrCodeImageTotals);
		return [
			'mask'		 =>$minMask,
			'qrCodeImage'=>$qrCodeImages[$minMask],
		];
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
				$_v = $j % 2;
				break;
			case 2:
				$_v = $i % 3;
				break;
			case 3:
				$_v = ($i + $j) % 3;
				break;
			case 4:
				$_v = ( floor($j / 2) + floor($i / 3) ) % 2;
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
		//return ($_v == 0)?1:0;
		if($_v == 0)
		{
			return $value ^ 1;
		}
		return $value;
	}
	
	//4种评分规则
	public function scoringRules_0(QRCodeImageGenerate $qrCodeImage)
	{
		$findScore = function($str,$findStr)
		{
			$total = 0;
			$f = substr($findStr,0,1);
			while(($index = strpos($str,$findStr)) !== FALSE)
			{
				$index += 4;
				$total += 3;
				while(isset($str[$index + 1]) and $str[$index + 1] == $f)
				{
					$index++;
					$total++;
				}
				$str = substr($str,$index,strlen($str));
			}
			return $total;
		};
		
		$qrCodeImageArray = $qrCodeImage->toArray();
		$total = 0;
		foreach($qrCodeImageArray as $value)
		{
			$values = implode('',$value);
			
			$total += $findScore($values,'11111');
			$total += $findScore($values,'00000');
		}
		foreach($qrCodeImageArray as $key => $value)
		{
			$values = '';
			foreach($qrCodeImageArray as $k => $v)
			{
				$values .= $v[$key];
			}
			
			$total += $findScore($values,'11111');
			$total += $findScore($values,'00000');
		}
		return $total;
	}
	public function scoringRules_1(QRCodeImageGenerate $qrCodeImage)
	{
		$arr = $qrCodeImage->toArray();
		$total = 0;
		for($i = 0; $i < count($arr) - 1; $i++)
		{
			for($j = 0; $j < count($arr) - 1; $j++)
			{
				$sum = $arr[$i][$j] + $arr[$i + 1][$j] + $arr[$i][$j + 1] + $arr[$i + 1][$j + 1];
				if($sum == 0 or $sum == 4)
				{
					$total++;
				}
			}
		}
		return $total * 3;
	}
	public function scoringRules_2(QRCodeImageGenerate $qrCodeImage)
	{
		$qrCodeImageArray = $qrCodeImage->toArray();
		$total = 0;
		foreach($qrCodeImageArray as $value)
		{
			$values = implode('',$value);
			
			$total += substr_count($values,'1011101');
		}
		foreach($qrCodeImageArray as $key => $value)
		{
			$values = '';
			foreach($qrCodeImageArray as $k => $v)
			{
				$values .= $v[$key];
			}
			
			$total += substr_count($values,'1011101');
		}
		return $total * 40;
	}
	public function scoringRules_3(QRCodeImageGenerate $qrCodeImage)
	{
		$qrCodeImageArray = $qrCodeImage->toArray();
		$total = 0;
		
		$values = '';
		foreach($qrCodeImageArray as $key => $value)
		{
			$values .= implode('',$value);
		}
		
		$darkNumber = substr_count($values,'1');
		$percent = round($darkNumber / strlen($values),2) * 100;
		$mod = floor($percent / 5);
		$total = min(abs($mod * 5 - 50) / 5,abs(($mod + 1) * 5 - 50) / 5);
		//$total = abs($percent - 50) / 5;
		
		return $total * 10;
	}
}
