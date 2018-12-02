<?php
/**
* 蛇形数据处理模块
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
	
	//当前方向
	private $currentDir = null;
	//点
	private $point = null;
	
	public function __construct($startX,$startY)
	{
		$this->point = new Point($startX,$startY);
		$this->currentDir = DataInMatrix::LEFT;
	}
	/**
	* 转向
	* @param int $dir 方向
	*/
	public function changeDir($dir)
	{
		switch($dir)
		{
			case DataInMatrix::LEFT:
				$this->point->x--;
				break;
			case DataInMatrix::RIGHT:
				$this->point->x++;
				break;
			case DataInMatrix::UP:
				$this->point->y--;
				break;
			case DataInMatrix::DOWN:
				$this->point->y++;
				break;
		}
		$this->currentDir = $dir;
	}
	/**
	* 获取当前方向
	* 
	* @return int 当前方向
	*/
	public function getCurrentDir()
	{
		return $this->currentDir;
	}
	/**
	* 获取点
	* 
	* @return Point 点
	*/
	public function getPoint()
	{
		return $this->point;
	}	
}
