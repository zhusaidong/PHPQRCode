<?php
/**
* 数字编码
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;
/*
数字模式下的编码
	在数字模式下，数据被限制为3个数字一段，分成若干段。
		如："123456" 将分成"123" 和 "456"，分别被编码成10bit的二进制数。
		“123”的10bit二进制表示法为：0001111011，实际上就是二进制的123。
	当数据的长度不足3个数字时，如果只有1个数字则用4bit，如果有2个数字就用7个bit来表示。
		如："9876"被分成"987"和"6"两段，因此被表示为"1111011011 0110"。
*/
class Numeric extends QRMode implements QRMode_Interface
{
	//数据长度转二进制的长度
	protected $dataLength = [1=>10,10=>12,36=>14];
	private $tag = '0001';
	//字节长度 = 字节数 * 3 + 1
	private $bitLengthConfig = [1=>4,2=>7,3=>10];
	public function __construct()
	{
		$this->name = 'Numeric';
	}
	/**
	* 编码
	*/
	public function DataEncodation()
	{
		return $this->addPadBytes($this->splitStr($this->data));
	}
	
	/**
	* 分割
	*/
	private function splitStr($text)
	{
		$list	= [];
		$list[]	= $this->tag;
		$list[]	= $this->conversionBinary(strlen($text),$this->getDataLength());
		while(strlen($text) > 0)
		{
			$list[] = $this->conversionBinary(substr($text,0,3));
			$text 	= substr($text,3,strlen($text));
		}
		return implode('',$list);
	}
	/**
	* 转二进制
	*/
	private function conversionBinary($str,$length = 0)
	{
		if($length == 0)
		{
			$length = $this->bitLengthConfig[strlen($str)];
		}
		$binary = base_convert($str,10,2);
		$binary = str_pad($binary,$length,0,STR_PAD_LEFT);
		return $binary;
	}
}
