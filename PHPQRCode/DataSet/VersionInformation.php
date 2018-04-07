<?php
/**
* 版本信息
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\DataSet;

class VersionInformation
{
	private $versionInformation = [
		7 => 31892,34236,39577,42195,				//version 7-10
		11 => 48118,51042,55367,58893,63784,		//version 11-15
		16 => 68472,70749,76311,79154,84390,		//version 16-20
		21 => 87683,92361,96236,102084,102881,		//version 21-25
		26 => 110507,110734,117786,119615,126325,	//version 26-30
		31 => 127568,133589,136944,141498,145311,	//version 31-35
		36 => 150283,152622,158308,161089,167017,	//version 36-40
	];
	
	/**
	* 获取版本信息
	* @param int $version
	* 
	* @return string 版本信息
	*/
	public function getVersionInformation($version)
	{
		return $version < 7 ? '' : str_pad(base_convert($this->versionInformation[$version],10,2),18,0,STR_PAD_LEFT);
	}
}
