<?php
/**
* QRCode Object
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

class QRCodeObject
{
	/**
	* @var 二维码版本
	*/
	public $version = null;
	/**
	* @var 二维码图形
	*/
	public $qrCodeImage = null;
	/**
	* @var 纠错码级别
	*/
	public $errorCorrectCode = null;
	/**
	* @var 内容
	*/
	public $content = null;
	/**
	* @var 内容二进制
	*/
	public $bits = null;
	/**
	* @var 纠错码二进制
	*/
	public $errorCodeBits = null;
	/**
	* @var 总二进制
	*/
	public $finalBits = null;
}
