<?php
/**
* 掩码
* 	掩码模式只应用于数据模块和纠错模块
* 	循环8种掩码模式,每种模式分别运用4种评分规则，并相加，取最小的掩码模式
* @author Zsdroid [635925926@qq.com]
*/
namespace PHPQRCode;

use PHPQRCode\DataSet\FormatInformation,
	PHPQRCode\DataSet\VersionInformation;
	
class QRCodeMask
{
	private function FormatAndVersionInformation($image,$version,$errorCorrectionCodeLevel,$mask)
	{
		$qrImageLength = $image->getQRCodeImageLength();
		//保留版本信息区:二维码版本7以上包含两个版本信息
		if($version >= 7)
		{
			$versionInfo = (new VersionInformation)->getVersionInformation($version);
			$version_infomation_up = $image->qrcodeVersionInfomation($versionInfo);
			$version_infomation_down = $image->rotate($version_infomation_up);
			$image->merge($version_infomation_down,new Point(0,$qrImageLength - 7 - 1 - 3));
			$image->merge($version_infomation_up,new Point($qrImageLength - 7 - 1 - 3,0));
		}
		
		//保留格式信息区
		$formatInfo = (new FormatInformation)->getFormatInformation($errorCorrectionCodeLevel,$mask);
		$image->merge($image->qrcodeFormatInfomation($formatInfo,QRCodeImage::FORMAT_INFOMATION_DIR_UP),new Point(8,0),QRCodeImageType::VERSION_INFOMATION);
		$image->merge($image->qrcodeFormatInfomation($formatInfo,QRCodeImage::FORMAT_INFOMATION_DIR_DOWN),new Point(8,$qrImageLength - 8 + 1),QRCodeImageType::VERSION_INFOMATION);
		$image->merge($image->qrcodeFormatInfomation($formatInfo,QRCodeImage::FORMAT_INFOMATION_DIR_LEFT),new Point(0,8),QRCodeImageType::VERSION_INFOMATION);
		$image->merge($image->qrcodeFormatInfomation($formatInfo,QRCodeImage::FORMAT_INFOMATION_DIR_RIGHT),new Point($qrImageLength - 8,8),QRCodeImageType::VERSION_INFOMATION);
		return $image;
	}
	public function setQRCodeImage(QRCodeObject $qRCodeObject,$debug = FALSE)
	{
		$qrCodeImage = $qRCodeObject->qrCodeImage;
		
		$scores = $scoresTotals = [];
		$qrCodeImages = [];
		for($k = 0; $k < 8; $k++)
		{
			$_temp = clone $qrCodeImage;
			$_temp = $this->FormatAndVersionInformation($_temp,$qRCodeObject->version,$qRCodeObject->errorCorrectionCodeLevel,$k);
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
			for($i = 0; $i < 4; $i++)
			{
				$scoresTotals[$k][$i] = call_user_func_array([$this,'scoringRules_'.$i],[$_temp]);
			}
			$scores[$k] = array_sum($scoresTotals[$k]);
		}
		//uasort($scoresTotals,function($a,$b){return $a - $b <= 0 ? - 1 : 1;});
		
		//debug
		if($debug)
		{
			var_dump($scoresTotals);
			foreach($scores as $key => $value)
			{
				echo '第'.$key.'种掩码:'.$scores[$key].$qrCodeImages[$key]->toQRCode();
			}
			exit;
		}
		
		$minMask = array_search(min($scores),$scores);
		return $qrCodeImages[$minMask];
	}
	
	//8种掩码模式
	private function mode($mode = 0,$i,$j,$value)
	{
		$modes = [
			function($i,$j){return ($i + $j) % 2;},
			function($i,$j){return $i % 2;},
			function($i,$j){return $j % 3;},
			function($i,$j){return ($i + $j) % 3;},
			function($i,$j){return ( floor($i / 2) + floor($j / 3) ) % 2;},
			function($i,$j){return (($i * $j) % 2) + (($i * $j) % 3);},
			function($i,$j){return ( (($i * $j) % 2) + (($i * $j) % 3) ) % 2;},
			function($i,$j){return ( (($i + $j) % 2) + (($i * $j) % 3) ) % 2;},
		];
		return call_user_func_array($modes[$mode],[$i,$j]) == 0 ? $value ^ 1 : $value;
	}
	//4种评分规则
	private function scoringRules_0(QRCodeImage $qrCodeImage)
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
	private function scoringRules_1(QRCodeImage $qrCodeImage)
	{
		$arr = $qrCodeImage->toArray();
		$total = 0;
		for($i = 0; $i < count($arr) - 1; $i++)
		{
			for($j = 0; $j < count($arr) - 1; $j++)
			{
				$sum = $arr[$i][$j] + $arr[$i + 1][$j] + $arr[$i][$j + 1] + $arr[$i + 1][$j + 1];
				if($sum % 4 == 0)
				{
					$total++;
				}
			}
		}
		return $total * 3;
	}
	private function scoringRules_2(QRCodeImage $qrCodeImage)
	{
		$qrCodeImageArray = $qrCodeImage->toArray();
		$total = 0;
		//横向查找
		foreach($qrCodeImageArray as $value)
		{
			$values = implode('',$value);
			$total += substr_count($values,'10111010000');
			$total += substr_count($values,'00001011101');
		}
		//纵向查找
		foreach($qrCodeImageArray as $key => $value)
		{
			$values = '';
			foreach($qrCodeImageArray as $k => $v)
			{
				$values .= $v[$key];
			}
			$total += substr_count($values,'10111010000');
			$total += substr_count($values,'00001011101');
		}
		return $total * 40;
	}
	private function scoringRules_3(QRCodeImage $qrCodeImage)
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
