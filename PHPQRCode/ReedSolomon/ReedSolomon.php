<?php
/**
* Reed-Solomon
* 	https://github.com/zxing/zxing/tree/master/core/src/main/java/com/google/zxing/common/reedsolomon
* 	https://github.com/khanamiryan/php-qrcode-detector-decoder/tree/master/lib/Common/Reedsolomon
* @author Zsdroid [635925926@qq.com]
*/
namespace PHPQRCode\ReedSolomon;

class ReedSolomon
{
	public function __construct()
	{
		
	}
	
	/**
	* 解码
	*/
	public function decode(array $data)
	{
		
	}
	
	/**
	* 编码
	*/
	public function encode(array $data,$errorCodeLength)
	{
		$polynomial = new Polynomial;
		$length = count($data);
		foreach($data as $key => $value)
		{
			$polynomial->setPolynomial($length - $key - 1,$value);
		}
		$polynomial->multiplication((new Polynomial)->setPolynomial($errorCodeLength,1));
		echo $polynomial;exit;
	}
}
