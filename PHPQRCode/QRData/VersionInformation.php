<?php
/**
* 版本信息
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRData;

class VersionInformation
{
	private $versionInformation = [];
	
	public function __construct()
	{
		$this->init();
	}
	private function data($version,$versionInformation)
	{
		$this->versionInformation[$version] = $versionInformation;
	}
	private function init()
	{
		$this->data(7,"000111110010010100");
		$this->data(8,"001000010110111100");
		$this->data(9,"001001101010011001");
		$this->data(10,"001010010011010011");
		$this->data(11,"001011101111110110");
		$this->data(12,"001100011101100010");
		$this->data(13,"001101100001000111");
		$this->data(14,"001110011000001101");
		$this->data(15,"001111100100101000");
		$this->data(16,"010000101101111000");
		$this->data(17,"010001010001011101");
		$this->data(18,"010010101000010111");
		$this->data(19,"010011010100110010");
		$this->data(20,"010100100110100110");
		$this->data(21,"010101011010000011");
		$this->data(22,"010110100011001001");
		$this->data(23,"010111011111101100");
		$this->data(24,"011000111011000100");
		$this->data(25,"011001000111100001");
		$this->data(26,"011010111110101011");
		$this->data(27,"011011000010001110");
		$this->data(28,"011100110000011010");
		$this->data(29,"011101001100111111");
		$this->data(30,"011110110101110101");
		$this->data(31,"011111001001010000");
		$this->data(32,"100000100111010101");
		$this->data(33,"100001011011110000");
		$this->data(34,"100010100010111010");
		$this->data(35,"100011011110011111");
		$this->data(36,"100100101100001011");
		$this->data(37,"100101010000101110");
		$this->data(38,"100110101001100100");
		$this->data(39,"100111010101000001");
		$this->data(40,"101000110001101001");
	}
	
	public function getVersionInformation($version)
	{
		if($version < 7)
		{
			return '';
		}
		return $this->versionInformation[$version];
	}
}
