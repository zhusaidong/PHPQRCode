<?php
/**
 * @author zhusaidong [zhusaidong@gmail.com]
 */

namespace PHPQRCode;

class QRImage
{
	/**
	 * @var int length
	 */
	private $length = 0;
	
	/**
	 * QRImage constructor.
	 */
	public function __construct()
	{
	}
	
	/**
	 * get length
	 *
	 * @return int
	 */
	public function getLength()
	{
		return $this->length;
	}
	
	/**
	 * set length
	 *
	 * @param int $length
	 *
	 * @return $this
	 */
	public function setLength($length)
	{
		$this->length = $length;
		return $this;
	}
	
	/**
	 * qr-image to array
	 *
	 * @return array
	 */
	public function toArray()
	{
		return [];
	}
}