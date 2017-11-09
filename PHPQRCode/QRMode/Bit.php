<?php
/**
* 字节模式
* 	包含小写字母，逗号和感叹号，所以它不能用字符模式编码。
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;

class Bit extends QRMode implements QRMode_Interface
{
	private $bitLengthConfig = [1=>6,2=>11];
	public function __construct()
	{
		$this->name = 'Bit';
	}
	/**
	* 编码
	*/
	public function DataEncodation()
	{
		return $this->splitStr($this->data);
	}
	/**
	* 数字分割
	*/
	private function splitStr($text)
	{
		$list	= [];
		$list[] = '0100';
		$list[] = $this->conversionBinary(strlen($text));
		for($i = 0; $i < strlen($text); $i++)
		{
			$list[] = $this->conversionBinary(bin2hex($text[$i]),16);
		}
		
		$data = implode('',$list);
		
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
	private function conversionBinary($str,$hex = 10,$length = 8)
	{
		$binary = base_convert($str,$hex,2);
		$binary = str_pad($binary,$length,0,STR_PAD_LEFT);
		return $binary;
	}
}
