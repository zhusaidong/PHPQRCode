<?php
/**
* PHPQRCode
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

spl_autoload_register("PHPQRCode\PHPQRCode::__autoload");

use PHPQRCode\QRCodeGenerate;
use PHPQRCode\QRCodeObject;
use PHPQRCode\QRCodeImageAdvanced;

class PHPQRCode
{
	/**
	* autoload
	* @param string $class
	*/
	public static function __autoload($class)
	{
		file_exists($class.'.php') and require($class.'.php');
	}
	
	/**
	* 创建二维码
	* @param string $text 内容
	* @param string $errorCorrectCode 纠错码级别
	* 
	* @return QRCodeImageAdvanced QRCodeImageAdvanced
	*/
	public function createQRCode($text,$errorCorrectCode = '')
	{
		$qrCodeObject = new QRCodeObject;
		
		$qrCodeObject->errorCorrectCode = $errorCorrectCode;
		$qrCodeObject->content = $text;
		
		$qrCodeGenerate = new QRCodeGenerate($qrCodeObject);
		
		//数据分析
		$qrMode = $qrCodeGenerate->DataAnalysis();
		//数据编码
		$qrCodeGenerate->DataEncodation($qrMode);
		//纠错编码
		$qrCodeGenerate->ErrorCorrectionCoding();
		//构造最终信息
		$qrCodeGenerate->StructureFinalMessage();
		//在矩阵中布置模块
		$qrCodeGenerate->ModulePlacementInMatrix();
		//掩模
		$mask = $qrCodeGenerate->Masking();
		//格式和版本信息
		$qrCodeGenerate->FormatAndVersionInformation($mask);
		
		return new QRCodeImageAdvanced($qrCodeGenerate->getQRCodeObject()->qrCodeImage);
	}
	
	/**
	* TODO 解析二维码
	* @param string $qrCodeUrl 二维码地址
	* 
	* @return string 内容
	*/
	public function parseQRCode($qrCodeUrl = '')
	{
		
	}
}
