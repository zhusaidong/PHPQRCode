<?php
/**
* 格式信息
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRData;

use PHPQRCode\ErrorCorrectCode as ecc;

class FormatInformation
{
	private $formatInformation = [];
	public function __construct()
	{
		$this->init();
	}
	private function data($ecc,$maskFormat,$formatInformation)
	{
		$this->formatInformation[$ecc][$maskFormat] = $formatInformation;
	}
	private function init()
	{
		$this->data(ecc::L,0,"111011111000100");
		$this->data(ecc::L,1,"111001011110011");
		$this->data(ecc::L,2,"111110110101010");
		$this->data(ecc::L,3,"111100010011101");
		$this->data(ecc::L,4,"110011000101111");
		$this->data(ecc::L,5,"110001100011000");
		$this->data(ecc::L,6,"110110001000001");
		$this->data(ecc::L,7,"110100101110110");
		$this->data(ecc::M,0,"101010000010010");
		$this->data(ecc::M,1,"101000100100101");
		$this->data(ecc::M,2,"101111001111100");
		$this->data(ecc::M,3,"101101101001011");
		$this->data(ecc::M,4,"100010111111001");
		$this->data(ecc::M,5,"100000011001110");
		$this->data(ecc::M,6,"100111110010111");
		$this->data(ecc::M,7,"100101010100000");
		$this->data(ecc::Q,0,"011010101011111");
		$this->data(ecc::Q,1,"011000001101000");
		$this->data(ecc::Q,2,"011111100110001");
		$this->data(ecc::Q,3,"011101000000110");
		$this->data(ecc::Q,4,"010010010110100");
		$this->data(ecc::Q,5,"010000110000011");
		$this->data(ecc::Q,6,"010111011011010");
		$this->data(ecc::Q,7,"010101111101101");
		$this->data(ecc::H,0,"001011010001001");
		$this->data(ecc::H,1,"001001110111110");
		$this->data(ecc::H,2,"001110011100111");
		$this->data(ecc::H,3,"001100111010000");
		$this->data(ecc::H,4,"000011101100010");
		$this->data(ecc::H,5,"000001001010101");
		$this->data(ecc::H,6,"000110100001100");
		$this->data(ecc::H,7,"000100000111011");
	}
	
	/**
	* 格式信息
	* @param int $ecc 纠错级别
	* @param int $maskformat 掩码格式
	*/
	public function getFormatInformation($ecc,$maskFormat)
	{
		return $this->formatInformation[$ecc][$maskFormat];
	}
}
