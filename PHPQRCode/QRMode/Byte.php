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
	public function __construct()
	{
		$this->indicator = '0100';
		$this->characterCountIndicator = [1=>8,10=>16,36=>16];
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
		for($i = 0; $i < strlen($text); $i++)
		{
			$list[] = $this->toBinary(bin2hex($text[$i]),16,8);
		}
		return $this->addPadBytes(implode('',$list));
	}
}
