<?php
/**
 * @author zhusaidong [zhusaidong@gmail.com]
 */

namespace PHPQRCode;

class QRCode
{
	/**
	 * QRCode constructor.
	 */
	public function __construct()
	{
		
	}
	/**
	 * create qr-code
	 *
	 * @param        $text
	 * @param string $ecl
	 *
	 * @return string|null
	 */
	public function create($text,$ecl = ErrorCorrectionLevel::L)
	{
		$qrObject = new QRObject();
		$qrObject->setOriginData($text);
		$qrObject->setErrorCorrectionLevel($ecl);
		
		return (new QRGenerator())->setQrObject($qrObject)->generator();
	}
	
	/**
	 * create qr-code
	 *
	 * @param        $text
	 * @param string $ecl
	 *
	 * @return string|null
	 */
	public static function _create($text,$ecl = ErrorCorrectionLevel::L)
	{
		return (new self())->create($text,$ecl);
	}
	
	/**
	 * todo parse qr-code
	 *
	 * @param $imgUrl
	 *
	 * @return null
	 */
	public function parse($imgUrl)
	{
		$image = imagecreatefromstring(file_get_contents($imgUrl));
		
		list($width, $height) = $imageInfo = getimagesize($imgUrl);
		
		return (new QRParse())
			->setResource($image)
			->setWidth($width)
			->setHeight($height)
			->parse();
	}
	
	/**
	 * todo parse qr-code
	 *
	 * @param $imgUrl
	 *
	 * @return null
	 */
	public static function _parse($imgUrl)
	{
		return (new self())->parse($imgUrl);
	}
}
