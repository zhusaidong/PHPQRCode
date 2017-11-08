<?php
/**
* 混合模式
* 	字节:包含小写字母，逗号和感叹号，所以它不能用字符模式编码。
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
