<?php
/**
* 格式信息
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\DataSet;

use PHPQRCode\ErrorCorrectCodeLevel as ecc;

class FormatInformation
{
	private $formatInformation = [
		ecc::L => [30660,29427,32170,30877,26159,25368,27713,26998],
		ecc::M => [21522,20773,24188,23371,17913,16590,20375,19104],
		ecc::Q => [13663,12392,16177,14854,9396,8579,11994,11245],
		ecc::H => [5769,5054,7399,6608,1890,597,3340,2107],
	];
	
	/**
	* 格式信息
	* @param int $ecc 纠错级别
	* @param int $maskformat 掩码格式
	*/
	public function getFormatInformation($ecc,$maskFormat)
	{
		return str_pad(base_convert($this->formatInformation[$ecc][$maskFormat],10,2),15,0,STR_PAD_LEFT);
	}
}
