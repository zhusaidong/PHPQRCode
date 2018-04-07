<?php
/**
* 剩余位
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\DataSet;

class RemainderBits
{
	private $remainderBits = [
		1 => 0,7,7,7,7,		//version 1-5
		6 => 7,0,0,0,0,		//version 6-10
		11 => 0,0,0,3,3,	//version 11-15
		16 => 3,3,3,3,3,	//version 16-20
		21 => 4,4,4,4,4,	//version 21-25
		26 => 4,4,3,3,3,	//version 26-30
		31 => 3,3,3,3,0,	//version 31-35
		36 => 0,0,0,0,0,	//version 36-40
	];
	
	public function getRemainderBits($version)
	{
		return $this->remainderBits[$version];
	}
}