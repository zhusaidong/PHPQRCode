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
	public $errorCorrectionCodeLevel = null;
	/**
	* @var 内容
	*/
	public $content = null;
	/**
	* @var 内容二进制
	*/
	public $contentBits = null;
	/**
	* @var 纠错码
	*/
	public $errorCorrectionCode = null;
	/**
	* @var 纠错码二进制
	*/
	public $errorCorrectionCodeBits = null;
	/**
	* @var 总二进制
	*/
	public $finalBits = null;
	
	public function __construct($option = [])
	{
		$this->set($option);
	}
	public function set($option = [])
	{
		foreach($option as $key => $value)
		{
			property_exists($this,$key) and $this->{$key} = $value;
		}
	}
}
