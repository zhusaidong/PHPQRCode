<?php
/**
* 二进制
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;

class Binary extends QRMode implements QRMode_Interface
{
	public function __construct()
	{
		$this->name = 'Binary';
	}
	/**
	* 编码
	*/
	public function DataEncodation()
	{
		return $this->data;
	}
}
