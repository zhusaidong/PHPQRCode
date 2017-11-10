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
		//debug
		//foreach($qrCodeImages as $key => $value)echo $key.'=>'.$qrCodeImageTotals[$key].$value->toQRCode();exit;
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
	public function scoringRules_0(QRCodeImageGenerate $qrCodeImage)
	{
		$qrCodeImageArray = $qrCodeImage->toArray();
		$total = 0;
		foreach($qrCodeImageArray as $value)
		{
			$values = implode('',$value);
			$index_1 = strpos($values,'11111');
			$index_0 = strpos($values,'00000');
			if($index_1 !== FALSE)
			{
				$index_1 += 5;
				while(isset($values[$index_1 + 1]) and $values[$index_1 + 1] === 0)
				{
					$index_1++;
				}
				$index_1 -= 2;
				$total += $index_1;
			}
			if($index_0 !== FALSE)
			{
				$index_0 += 5;
				while(isset($values[$index_0 + 1]) and $values[$index_0 + 1] === 0)
				{
					$index_0++;
				}
				$index_0 -= 2;
				$total += $index_0;
			}
		}
		foreach($qrCodeImageArray as $key => $value)
		{
			$values = '';
			foreach($qrCodeImageArray as $k => $v)
			{
				$values .= $v[$key];
			}
			$index_1 = strpos($values,'11111');
			$index_0 = strpos($values,'00000');
			if($index_1 !== FALSE)
			{
				$index_1 += 5;
				while(isset($values[$index_1 + 1]) and $values[$index_1 + 1] === 0)
				{
					$index_1++;
				}
				$index_1 -= 2;
				$total += $index_1;
			}
			if($index_0 !== FALSE)
			{
				$index_0 += 5;
				while(isset($values[$index_0 + 1]) and $values[$index_0 + 1] === 0)
				{
					$index_0++;
				}
				$index_0 -= 2;
				$total += $index_0;
			}
		}
		return $total;
	}
	public function scoringRules_1(QRCodeImageGenerate $qrCodeImage)
	{
		$arr = $qrCodeImage->toArray();
		$total = 0;
		for($i = 0; $i < count($arr); $i++)
		{
			for($j = 0; $j < count($arr); $j++)
			{
				if((
					isset($arr[$i][$j]) and $arr[$i][$j] === 1 and 
					isset($arr[$i + 1][$j]) and $arr[$i + 1][$j] === 1 and 
					isset($arr[$i][$j + 1]) and $arr[$i][$j + 1] === 1 and 
					isset($arr[$i + 1][$j + 1]) and $arr[$i + 1][$j + 1] === 1
				) or (
					isset($arr[$i][$j]) and $arr[$i][$j] === 0 and 
					isset($arr[$i + 1][$j]) and $arr[$i + 1][$j] === 0 and 
					isset($arr[$i][$j + 1]) and $arr[$i][$j + 1] === 0 and 
					isset($arr[$i + 1][$j + 1]) and $arr[$i + 1][$j + 1] === 0
				))
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
			$index_1 = strpos($values,'10111010000');
			if($index_1 !== FALSE)
			{
				$total++;
			}
			$index_0 = strpos($values,'00001011101');
			if($index_0 !== FALSE)
			{
				$total++;
			}
		}
		foreach($qrCodeImageArray as $key => $value)
		{
			$values = '';
			foreach($qrCodeImageArray as $k => $v)
			{
				$values .= $v[$key];
			}
			$index_1 = strpos($values,'10111010000');
			if($index_1 !== FALSE)
			{
				$total++;
			}
			$index_0 = strpos($values,'00001011101');
			if($index_0 !== FALSE)
			{
				$total++;
			}
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
		
		$darkModuleNumber = substr_count($values,'1');
		$lightModuleNumber= substr_count($values,'0');
		
		$percent = round($darkModuleNumber / ($lightModuleNumber + $darkModuleNumber),2) * 100;
		$mod = ceil($percent / 5);
		$total = min(abs($mod * 5 - 50) / 5,abs(($mod + 1) * 5 - 50) / 5) * 10;
		
		return $total;
	}
}
