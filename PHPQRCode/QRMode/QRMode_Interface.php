<?php
/**
* QRMode_Interface
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;

interface QRMode_Interface
{
	/**
	* 设置数据
	*/
	function setData($data);
	/**
	* 编码
	*/
	function DataEncodation();
}
