<?php
/**
* 字符编码
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;

class Alphanumeric extends QRMode implements QRMode_Interface
{
	private static $strLists = ['0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',' ','$','%','*','+','-','.','/',':'];
	private $bitLengthConfig = [1=>6,2=>11];
	public function __construct()
	{
		$this->indicator = '0010';
		$this->characterCountIndicator = [1=>9,10=>11,36=>13];
		$this->strList = array_flip(self::$strLists);
	}
	public static function getStrList()
	{
		return self::$strLists;
	}
	/**
	* 编码
	*/
	public function DataEncodation()
	{
		$text = $this->data;
		
		$list	= [];
		$list[] = $this->indicator;
		$list[] = $this->toBinary(strlen($text),10,$this->getCharacterCountIndicatorLength());
		while(strlen($text) > 0)
		{
			$list[] = $this->specialToBinary(substr($text,0,2));
			$text = substr($text,2,strlen($text));
		}
		return $this->addPadBytes(implode('',$list));
	}
	
	/**
	* 特殊转二进制,长度计算比较复杂,故单独方法
	*/
	private function specialToBinary($str)
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
		return $this->toBinary($str,10,$length);
	}
}
