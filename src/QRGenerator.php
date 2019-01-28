<?php
/**
 * @author zhusaidong [zhusaidong@gmail.com]
 */

namespace PHPQRCode;

class QRGenerator
{
	/**
	 * @var QRObject
	 */
	private $qrObject = NULL;
	
	/**
	 * QRGenerator constructor.
	 */
	public function __construct()
	{
	
	}
	
	/**
	 * get QRObject
	 *
	 * @return QRObject
	 */
	public function getQrObject()
	{
		return $this->qrObject;
	}
	
	/**
	 * set QRObject
	 *
	 * @param QRObject $qrObject
	 *
	 * @return $this
	 */
	public function setQrObject(QRObject $qrObject)
	{
		$this->qrObject = $qrObject;
		return $this;
	}
	
	/**
	 * generator qr-code
	 *
	 * @param string $type
	 * @param string|null   $saveName
	 *
	 * @return string|null
	 */
	public function generator($type = QRImageGenerator::PNG,$saveName = NULL)
	{
		$qrImage = new QRImage();
		
		$qrObject = $this->getQrObject();
		$qrObject->setQrImage($qrImage);
		$qrImageGenerator = new QRImageGenerator();
		return $qrImageGenerator
			->setQrObject($qrObject)
			->setImageType($type)
			->setSaveName($saveName)
			->save();
	}
}
