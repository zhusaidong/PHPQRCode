<?php
/**
* 编码模式
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;

class QRMode
{
	public $name = '';
	protected $data = null;
	protected $maxBitLength = 0;
	//补齐码
	protected $PaddingBytes = '1110110000010001';
	public function __construct()
	{
		
	}
	public function setData($data)
	{
		$this->data = $data;
	}
	public function setMaxBitLength($maxBitLength)
	{
		$this->maxBitLength = $maxBitLength;
	}
	/**
	* 是否是数字
	*/
	public static function isNumber($text)
	{
		return !preg_match('/[^0-9]+/',$text);
	}
	/**
	* 是否是字母
	*/
	public static function isLetter($text)
	{
		return !preg_match('/[^a-zA-Z]+/',$text);
	}
	/**
	* 是否是混合
	*/
	public static function isMix($text)
	{
		return !!preg_match('/(?:[a-zA-Z]){1}(?:[0-9]){1}|(?:[\s\$%\*\+-\.\/\:]){1}/',$text);
	}
	/**
	* 是否是中文
	*/
	public static function isChinese($text)
	{
		return !preg_match('/[^\x7f-\xff]/',$text);
	}
	/**
	* 是否是二进制
	*/
	public static function isBinary($text)
	{
		return !preg_match('/[^01]+/',$text);
	}
	/**
	* 二进制转十进制数字
	*/
	public function Binary2Number($binary)
	{
		if(is_array($binary))
		{
			foreach($binary as $key => $value)
			{
				$binary[$key] = $this->Binary2Number($value);
			}
		}
		else
		{
			$binary = base_convert($binary,2,10);
		}
		return $binary;
	}
}
