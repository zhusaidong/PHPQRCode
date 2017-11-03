<?php
/**
* 在矩阵中布置模块-蛇形数据处理
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

class DataInMatrix
{
	const LEFT = -1;
	const RIGHT = 1;
	const UP = -10;
	const DOWN = 10;
	
	private $currentDir = null;
	private $point = null;
	public function __construct($startCoordinateX,$startCoordinateY)
	{
		$this->point = new Point($startCoordinateX,$startCoordinateY);
		$this->currentDir = DataInMatrix::LEFT;
	}
	public function changeDir($dir)
	{
		switch($dir)
		{
			case DataInMatrix::LEFT:
				$this->point->y--;
				break;
			case DataInMatrix::RIGHT:
				$this->point->y++;
				break;
			case DataInMatrix::UP:
				$this->point->x--;
				break;
			case DataInMatrix::DOWN:
				$this->point->x++;
				break;
		}
		$this->currentDir = $dir;
	}
	public function getCurrentDir()
	{
		return $this->currentDir;
	}
	public function getPoint()
	{
		return $this->point;
	}
	
}

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
