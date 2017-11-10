<?php
/**
* 日文编码
* 	也是双字节编码,也可以用于中文编码
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;

class Kanji extends QRMode implements QRMode_Interface
{
	public function __construct()
	{
		$this->indicator = '1000';
		$this->characterCountIndicator = [1=>8,10=>10,36=>12];
	}
	/**
	* 编码
	*/
	public function DataEncodation()
	{
		$text = iconv('utf-8','Shift_jis//ignore',$this->data);
		
		$list	= [];
		$list[]	= $this->indicator;
		$list[]	= $this->toBinary(strlen($text) / 2,10,$this->getCharacterCountIndicatorLength());
		while(strlen($text) > 0)
		{
			$t = '0x'.bin2hex(substr($text,0,2));
			if($t >= 0x8140 and $t <= 0x9FFC)
			{
				$t = $t - 0x8140;
			}
			else if($t >= 0xE040 and $t <= 0xEBBF)
			{
				$t = $t - 0xC140;
			}
			$t = base_convert($t,10,16);
			$t = str_pad($t,4,0,STR_PAD_LEFT);
			
			$t_1 = '0x'.substr($t,0,2);
			$t_2 = '0x'.substr($t,2,2);
			$t = $t_1 * 0xC0 + $t_2;
			
			$t = base_convert($t,10,16);
			
			$list[] = $this->toBinary($t,16,13);
			
			$text = substr($text,2,strlen($text));
		}
		return $this->addPadBytes(implode('',$list));
	}
}
