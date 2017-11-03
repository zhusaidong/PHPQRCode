<?php
/**
* 汉字
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;
/*
中文汉字的转换步骤：
	1、对于第一字节为0xA1~0xAA之间,第二字节在0xA1~0xFE之间字符：
		a)第一字节减去0xA1；
		b)上一步结果乘以0x60;
		c）第二字节减去0xA1;
		d)将b)步骤的结果加上c步骤的结果;
		e)将结果转换为13位二进制串。
	1、对于第一字节为0xB0~0xFA之间,第二字节在0xA1~0xFE之间字符：
		a)第一字节减去0xA6；
		b)上一步结果乘以0x60;
		c）第二字节减去0xA1;
		d)将b)步骤的结果加上c步骤的结果;
		e)将结果转换为13位二进制串。
*/
class Chinese extends QRMode implements QRMode_Interface
{
	public function __construct()
	{
		$this->name = 'Chinese';
	}
	/**
	* 编码
	*/
	public function DataEncodation()
	{
		return $this->splitStr($this->data);
	}
	
	/**
	* 分割
	*/
	private function splitStr($text)
	{
		$text = iconv('utf-8','gbk',$text);
		$string = '';
		for($i = 0; $i < strlen($text); $i = $i + 2)
		{
			$str = '';
			$one = $this->hexEncode($text[$i]);
			$two = $this->hexEncode($text[$i + 1]);
			if(($one >= 0xA1 and $one <= 0xAA) and ($two >= 0xA1 and $two <= 0xFE))
			{
				$str = ($one - 0xA1) * 0x60 + ($two - 0xA1);
			}
			else if(($one >= 0xB0 and $one <= 0xFA) and ($two >= 0xA1 and $two <= 0xFE))
			{
				$str = ($one - 0xA6) * 0x60 + ($two - 0xA1);
			}
			$string .= $this->conversionBinary($str,13);
		}
		return $string;
	}
	/**
	* 转二进制
	*/
	private function conversionBinary($str,$length = 0)
	{
		$binary = base_convert($str,16,2);
		$binary = str_pad($binary,$length,0,STR_PAD_LEFT);
		return $binary;
	}
	
	//汉字转换为16进制编码
	private function hexEncode($s)
	{
		return str_replace('%','0x',rawurlencode($s));
	}
	//16进制编码转换为汉字
	private function hexDecode($s)
	{
		return rawurldecode(str_replace('0x','%',$s));
	}
}
