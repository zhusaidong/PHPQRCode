<?php
/**
* Point
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

class Point
{
	public $x = 0;
	public $y = 0;
	public function __construct($x,$y)
	{
		$this->x = $x;
		$this->y = $y;
	}
	public function __toString()
	{
		return '('.$this->x.','.$this->y.')';
	}
}
