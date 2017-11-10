<?php
/**
* 剩余位
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRData;

class ResidualPosition
{
	private $residualPosition = [];
	
	public function __construct()
	{
		$this->init();
	}
	private function init()
	{
		$this->data(1,0);
		$this->data(2,7);
		$this->data(3,7);
		$this->data(4,7);
		$this->data(5,7);
		$this->data(6,7);
		$this->data(7,0);
		$this->data(8,0);
		$this->data(9,0);
		$this->data(10,0);
		$this->data(11,0);
		$this->data(12,0);
		$this->data(13,0);
		$this->data(14,3);
		$this->data(15,3);
		$this->data(16,3);
		$this->data(17,3);
		$this->data(18,3);
		$this->data(19,3);
		$this->data(20,3);
		$this->data(21,4);
		$this->data(22,4);
		$this->data(23,4);
		$this->data(24,4);
		$this->data(25,4);
		$this->data(26,4);
		$this->data(27,4);
		$this->data(28,3);
		$this->data(29,3);
		$this->data(30,3);
		$this->data(31,3);
		$this->data(32,3);
		$this->data(33,3);
		$this->data(34,3);
		$this->data(35,0);
		$this->data(36,0);
		$this->data(37,0);
		$this->data(38,0);
		$this->data(39,0);
		$this->data(40,0);
	}
	private function data($version,$residualPosition)
	{
		$this->residualPosition[$version] = $residualPosition;
	}
	
	public function getResidualPosition($version)
	{
		return $this->residualPosition[$version];
	}
}
