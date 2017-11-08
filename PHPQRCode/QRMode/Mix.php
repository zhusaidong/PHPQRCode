<?php
/**
* 混合
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;
/*
混合字符模式下的编码
	混合字符模式编码，其字符对照表如下：$strList
编码方式为：
	源码被分成两个字符一段，如下所示，每段的第一个字符乘上45，再用第二个数字相加。因此每段变成了11bit的2进制码，如果字符个数只有1个，则用6bit表示。
示例：
	"AB" 45*10+11 	461 	00111001101
	"CD" 45*12+13 	553 	01000101001
	"E1" 45*14+1 	631 	01001110111
	"23" 45*2+3 	93 		00001011101
	加上混合字符模式标识码，总的编码为0010 000001000
*/
class Mix extends QRMode implements QRMode_Interface
{
	private static $strList = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',' ','$','%','*','+','-','.','/',':'];
	private $bitLengthConfig = [1=>6,2=>11];
	public function __construct()
	{
		$this->name = 'Mix';
		$this->strList = array_flip(self::$strList);
	}
	public static function getStrList()
	{
		return self::$strList;
	}
	/**
	* 编码
	*/
	public function DataEncodation()
	{
		$this->data = strtoupper($this->data);
		return $this->splitStr($this->data);
	}
	/**
	* 数字分割
	*/
	private function splitStr($text)
	{
		$list	= [];
		$list[] = '0010';
		$list[] = $this->conversionBinary(strlen($text),9);
		while(strlen($text) > 0)
		{
			$list[] = $this->conversionBinary(substr($text,0,2));
			$text = substr($text,2,strlen($text));
		}
		
		//如果尾部数据不足8bit,则在尾部充0:
		$data = implode('',$list);
		$data = str_split($data,8);
		foreach($data as $key => $value)
		{
			$data[$key] = str_pad($value,8,0,STR_PAD_RIGHT);
		}
		
		$data = implode('',$data);
		while(strlen($data) < $this->maxBitLength)
		{
			$data .= $this->PaddingBytes;
		}
		if(strlen($data) > $this->maxBitLength)
		{
			$data = substr($data,0,$this->maxBitLength);
		}
		return $data;
	}
	/**
	* 转二进制
	*/
	private function conversionBinary($str,$length = 0)
	{
		if($length == 0)
		{
			$length = $this->bitLengthConfig[strlen($str)];
			$nums   = [];
			for($i = 0; $i < strlen($str); $i++)
			{
				$nums[] = $this->strList[$str[$i]];
			}
			if(count($nums) == 2)
			{
				$str = $nums[0] * 45 + $nums[1];
			}
			else
			{
				$str = $nums[0];
			}
		}
		$binary = base_convert($str,10,2);
		$binary = str_pad($binary,$length,0,STR_PAD_LEFT);
		return $binary;
	}
}
