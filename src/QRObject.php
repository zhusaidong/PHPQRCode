<?php
/**
 * @author zhusaidong [zhusaidong@gmail.com]
 */

namespace PHPQRCode;

class QRObject
{
	/**
	 * @var string errorCorrectionLevel
	 */
	private $errorCorrectionLevel = ErrorCorrectionLevel::L;
	/**
	 * @var null origin data
	 */
	private $originData = null;
	/**
	 * @var null bit data
	 */
	private $bitData = null;
	/**
	 * @var null errorCorrection data
	 */
	private $errorCorrectionData = null;
	/**
	 * @var null final data
	 */
	private $finalData = null;
	/**
	 * @var QRImage qrImage
	 */
	private $qrImage = null;
	
	/**
	 * QRObject constructor.
	 */
	public function __construct()
	{
	}
	
	/**
	 * get errorCorrectionLevel
	 *
	 * @return string
	 */
	public function getErrorCorrectionLevel()
	{
		return $this->errorCorrectionLevel;
	}
	
	/**
	 * set errorCorrectionLevel
	 *
	 * @param string $errorCorrectionLevel
	 *
	 * @return $this
	 */
	public function setErrorCorrectionLevel($errorCorrectionLevel)
	{
		$this->errorCorrectionLevel = $errorCorrectionLevel;
		return $this;
	}
	
	/**
	 * get origin data
	 *
	 * @return null
	 */
	public function getOriginData()
	{
		return $this->originData;
	}
	
	/**
	 * set origin data
	 *
	 * @param null $originData
	 *
	 * @return $this
	 */
	public function setOriginData($originData)
	{
		$this->originData = $originData;
		return $this;
	}
	
	/**
	 * get bit data
	 *
	 * @return null
	 */
	public function getBitData()
	{
		return $this->bitData;
	}
	
	/**
	 * set bit data
	 *
	 * @param null $bitData
	 *
	 * @return $this
	 */
	public function setBitData($bitData)
	{
		$this->bitData = $bitData;
	}
	
	/**
	 * get errorCorrection data
	 *
	 * @return null
	 */
	public function getErrorCorrectionData()
	{
		return $this->errorCorrectionData;
	}
	
	/**
	 * set errorCorrection data
	 *
	 * @param null $errorCorrectionData
	 *
	 * @return $this
	 */
	public function setErrorCorrectionData($errorCorrectionData)
	{
		$this->errorCorrectionData = $errorCorrectionData;
		return $this;
	}
	
	/**
	 * get final data
	 *
	 * @return null
	 */
	public function getFinalData()
	{
		return $this->finalData;
	}
	
	/**
	 * set final data
	 *
	 * @param null $finalData
	 *
	 * @return $this
	 */
	public function setFinalData($finalData)
	{
		$this->finalData = $finalData;
		return $this;
	}
	
	/**
	 * get qrImage
	 *
	 * @return QRImage
	 */
	public function getQrImage()
	{
		return $this->qrImage;
	}
	
	/**
	 * set qrImage
	 *
	 * @param QRImage $qrImage
	 *
	 * @return $this
	 */
	public function setQrImage(QRImage $qrImage)
	{
		$this->qrImage = $qrImage;
		return $this;
	}
	
}