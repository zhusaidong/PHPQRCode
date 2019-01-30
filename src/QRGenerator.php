<?php
/**
 * @author zhusaidong [zhusaidong@gmail.com]
 */

namespace PHPQRCode;

use PHPQRCode\QRDataSet\DataCapacity;
use PHPQRCode\QRMode\QRMode;

class QRGenerator
{
	/**
	 * @var QRObject
	 */
	private $qrObject = NULL;
	private $qrMode;
	
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
		$this->DataAnalysis()->DataEncodation();
		
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
	
	/**
	 * TODO Step 1 Data analysis 数据分析
	 */
	private function DataAnalysis()
	{
		$data = $this->qrObject->getOriginData();
		$this->qrMode = QRMode::getMode($data);
		//根据数据容量获取二维码版本
		$version = (new DataCapacity)->getVersion(
			strlen($this->qrObject->getOriginData()),
			$this->qrObject->getErrorCorrectionLevel(),
			$this->qrMode->getClassName()
		);
		$this->qrObject->setVersion($version);
		$this->qrMode->setVersion($version);
		return $this;
	}
	/**
	 * TODO Step 2 Data encodation 数据编码
	 */
	private function DataEncodation()
	{
		/*
		$this->qrMode->setMaxBitLength(
			(new ErrorCorrectionCode)->getDataCodeNumber(
				$this->qrObject->version,$this->qrObject->errorCorrectionCodeLevel
			)
		);
		$this->qrObject->contentBits = $this->qrMode->DataEncodation();
		*/
		return $this;
	}
}
