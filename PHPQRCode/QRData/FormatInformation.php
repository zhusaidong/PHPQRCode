<?php
/**
* 格式信息
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRData;

use PHPQRCode\ErrorCorrectCode;

class FormatInformation
{
	private $formatInformation = [];
	public function __construct()
	{
		$this->init();
	}
	private function data($errorCorrectCode,$maskFormat,$formatInformation)
	{
		$this->formatInformation[$errorCorrectCode][$maskFormat] = $formatInformation;
	}
	private function init()
	{
		$this->data(ErrorCorrectCode::L,0,"111011111000100");
		$this->data(ErrorCorrectCode::L,1,"111001011110011");
		$this->data(ErrorCorrectCode::L,2,"111110110101010");
		$this->data(ErrorCorrectCode::L,3,"111100010011101");
		$this->data(ErrorCorrectCode::L,4,"110011000101111");
		$this->data(ErrorCorrectCode::L,5,"110001100011000");
		$this->data(ErrorCorrectCode::L,6,"110110001000001");
		$this->data(ErrorCorrectCode::L,7,"110100101110110");
		$this->data(ErrorCorrectCode::M,0,"101010000010010");
		$this->data(ErrorCorrectCode::M,1,"101000100100101");
		$this->data(ErrorCorrectCode::M,2,"101111001111100");
		$this->data(ErrorCorrectCode::M,3,"101101101001011");
		$this->data(ErrorCorrectCode::M,4,"100010111111001");
		$this->data(ErrorCorrectCode::M,5,"100000011001110");
		$this->data(ErrorCorrectCode::M,6,"100111110010111");
		$this->data(ErrorCorrectCode::M,7,"100101010100000");
		$this->data(ErrorCorrectCode::Q,0,"011010101011111");
		$this->data(ErrorCorrectCode::Q,1,"011000001101000");
		$this->data(ErrorCorrectCode::Q,2,"011111100110001");
		$this->data(ErrorCorrectCode::Q,3,"011101000000110");
		$this->data(ErrorCorrectCode::Q,4,"010010010110100");
		$this->data(ErrorCorrectCode::Q,5,"010000110000011");
		$this->data(ErrorCorrectCode::Q,6,"010111011011010");
		$this->data(ErrorCorrectCode::Q,7,"010101111101101");
		$this->data(ErrorCorrectCode::H,0,"001011010001001");
		$this->data(ErrorCorrectCode::H,1,"001001110111110");
		$this->data(ErrorCorrectCode::H,2,"001110011100111");
		$this->data(ErrorCorrectCode::H,3,"001100111010000");
		$this->data(ErrorCorrectCode::H,4,"000011101100010");
		$this->data(ErrorCorrectCode::H,5,"000001001010101");
		$this->data(ErrorCorrectCode::H,6,"000110100001100");
		$this->data(ErrorCorrectCode::H,7,"000100000111011");
	}
	/**
	* 格式信息
	* @param int $errorCorrectCode 纠错级别
	* @param int $maskformat 掩码格式
	*/
	public function getFormatInformation($errorCorrectCode,$maskFormat)
	{
		return $this->formatInformation[$errorCorrectCode][$maskFormat];
	}
}
