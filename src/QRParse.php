<?php
/**
 * @author zhusaidong [zhusaidong@gmail.com]
 */

namespace PHPQRCode;

class QRParse
{
	/**
	 * @var null resource
	 */
	private $resource = null;
	/**
	 * @var int width
	 */
	private $width = 0;
	/**
	 * @var int height
	 */
	private $height = 0;
	
	/**
	 * QRParse constructor.
	 */
	public function __construct()
	{
	}
	
	/**
	 * get resource
	 *
	 * @return null
	 */
	public function getResource()
	{
		return $this->resource;
	}
	
	/**
	 * set resource
	 *
	 * @param null $resource
	 *
	 * @return $this
	 */
	public function setResource($resource)
	{
		$this->resource = $resource;
		return $this;
	}
	
	/**
	 * get width
	 *
	 * @return int
	 */
	public function getWidth()
	{
		return $this->width;
	}
	
	/**
	 * set width
	 *
	 * @param int $width
	 *
	 * @return $this
	 */
	public function setWidth($width)
	{
		$this->width = $width;
		return $this;
	}
	
	/**
	 * get height
	 *
	 * @return int
	 */
	public function getHeight()
	{
		return $this->height;
	}
	
	/**
	 * set height
	 *
	 * @param int $height
	 *
	 * @return $this
	 */
	public function setHeight($height)
	{
		$this->height = $height;
		return $this;
	}
	
	/**
	 * parse image
	 *
	 * @return null
	 */
	public function parse()
	{
		for($i = 0;$i < $this->height;$i++)
		{
			for($j = 0;$j < $this->width;$j++)
			{
				$color = imagecolorsforindex($this->resource, imagecolorat($this->resource, $i,$j));
				if($color['red'] == 255 and $color['green'] == 255 and $color['blue'] == 255)
				{
					var_dump($color);exit;
				}
			}
		}
		return NULL;
	}
}
