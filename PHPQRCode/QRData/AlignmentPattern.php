<?php
/**
* AlignmentPattern 校正图形
* 	公式(version > 1) : AlignmentPattern数 = 二维码宽度数组个数 ^ 2 - 3
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRData;

class AlignmentPattern
{
	private $alignmentPattern = [];
	public function __construct()
	{
		$this->init();
	}
	private function init()
	{
		$this->data(1,[]);
		$this->data(2,[6,18]);
		$this->data(3,[6,22]);
		$this->data(4,[6,26]);
		$this->data(5,[6,30]);
		$this->data(6,[6,34]);
		$this->data(7,[6,22,38]);
		$this->data(8,[6,24,42]);
		$this->data(9,[6,26,46]);
		$this->data(10,[6,28,50]);
		$this->data(11,[6,30,54]);
		$this->data(12,[6,32,58]);
		$this->data(13,[6,34,62]);
		$this->data(14,[6,26,46,66]);
		$this->data(15,[6,26,48,70]);
		$this->data(16,[6,26,50,74]);
		$this->data(17,[6,30,54,78]);
		$this->data(18,[6,30,56,82]);
		$this->data(19,[6,30,58,86]);
		$this->data(20,[6,34,62,90]);
		$this->data(21,[6,28,50,72,94]);
		$this->data(22,[6,26,50,74,98]);
		$this->data(23,[6,30,54,78,102]);
		$this->data(24,[6,28,54,80,106]);
		$this->data(25,[6,32,58,84,110]);
		$this->data(26,[6,30,58,86,114]);
		$this->data(27,[6,34,62,90,118]);
		$this->data(28,[6,26,50,74,98,122]);
		$this->data(29,[6,30,54,78,102,126]);
		$this->data(30,[6,26,52,78,104,130]);
		$this->data(31,[6,30,56,82,108,134]);
		$this->data(32,[6,34,60,86,112,138]);
		$this->data(33,[6,30,58,86,114,142]);
		$this->data(34,[6,34,62,90,118,146]);
		$this->data(35,[6,30,54,78,102,126,150]);
		$this->data(36,[6,24,50,76,102,128,154]);
		$this->data(37,[6,28,54,80,106,132,158]);
		$this->data(38,[6,32,58,84,110,136,162]);
		$this->data(39,[6,26,54,82,110,138,166]);
		$this->data(40,[6,30,58,86,114,142,170]);
	}
	private function data($version,$alignmentPattern)
	{
		$this->alignmentPattern[$version] = $alignmentPattern;
	}
	
	/**
	* 校正图形
	* @param int $version 版本
	*/
	public function getAlignmentPattern($version)
	{
		return $this->alignmentPattern[$version];
	}
	/**
	* 校正图形个数
	* @param int $version 版本
	*/
	public function getAlignmentPatternNumber($version)
	{
		if($version == 1)
		{
			return 0;
		}
		$alignmentPattern = $this->getAlignmentPattern($version);
		return pow(count($alignmentPattern),2) - 3;
	}
}
