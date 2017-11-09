<?php
/**
* 字节编码
* 	包含小写字母，逗号和感叹号，所以它不能用字符模式编码。
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;

class Byte extends QRMode implements QRMode_Interface
{
	//数据长度转二进制的长度
	protected $dataLength = [1=>8,10=>16,36=>16];
	private $tag = '0100';
	public function __construct()
	{
		$this->name = 'Byte';
	}
	/**
	* 编码
	*/
	public function DataEncodation()
	{
		return $this->addPadBytes($this->splitStr($this->data));
	}
	/**
	* 数字分割
	*/
	private function splitStr($text)
	{
		$list	= [];
		$list[] = $this->tag;
		$list[] = $this->conversionBinary(strlen($text),10,$this->getDataLength());
		for($i = 0; $i < strlen($text); $i++)
		{
			$list[] = $this->conversionBinary(bin2hex($text[$i]),16);
		}
		return implode('',$list);
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
