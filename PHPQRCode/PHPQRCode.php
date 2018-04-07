<?php
/**
* PHPQRCode
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

use PHPQRCode\QRCodeObject,
	PHPQRCode\QRCodeGenerate,
	PHPQRCode\QRCodeImageGenerate;

class PHPQRCode
{
	/**
	* 创建二维码
	* @param string $text 内容
	* @param string $eccl 纠错码级别
	*
	* @return QRCodeImageGenerate QRCodeImageGenerate
	*/
	public function createQRCode($text,$eccl = '')
	{
		$qrCodeObject   = new QRCodeObject(['errorCorrectionCodeLevel'=>$eccl,'content'=>$text]);
		$qrCodeGenerate = new QRCodeGenerate($qrCodeObject);
		$qrCodeImage    = $qrCodeGenerate
			->DataAnalysis()//数据分析
			->DataEncodation()//数据编码
			->ErrorCorrectionCoding()//纠错编码
			->StructureFinalMessage()//构造最终信息
			->ModulePlacementInMatrix()//在矩阵中布置模块
			->Masking()//掩模
			->FormatAndVersionInformation()//格式和版本信息
			->getQRCodeObject()
			->qrCodeImage;
		return new QRCodeImageGenerate($qrCodeImage);
	}

	/**
	* TODO 解析二维码
	* 	https://cli.im/news/help/21072
	* @param string $qrCodeUrl 二维码地址
	*
	* @return string 内容
	*/
	public function parseQRCode($qrCodeUrl = '')
	{
		
	}
}
