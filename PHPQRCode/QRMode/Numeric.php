<?php
/**
* 数字编码
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;

class Numeric extends QRMode implements QRMode_Interface
{
	public function __construct()
	{
		$this->indicator = '0001';
		$this->characterCountIndicator = [1=>10,10=>12,36=>14];
	}
	/**
	* 编码
	*/
	public function DataEncodation()
	{
		$text = $this->data;
		
		$list	= [];
		$list[]	= $this->indicator;
		$list[]	= $this->toBinary(strlen($text),10,$this->getCharacterCountIndicatorLength());
		while(strlen($text) > 0)
		{
			$str = substr($text,0,3);
			//二进制长度 = 字节数 * 3 + 1
			$list[] = $this->toBinary($str,10,strlen($str) * 3 + 1);
			$text 	= substr($text,3,strlen($text));
		}
		return $this->addPadBytes(implode('',$list));
	}
}
