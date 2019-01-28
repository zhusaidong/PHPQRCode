<?php
/**
 * @author zhusaidong [zhusaidong@gmail.com]
 */

namespace PHPQRCode;

class QRImageGenerator
{
	/**
	 * const png
	 */
	const PNG = 'png';
	/**
	 * const jpg
	 */
	const JPG = 'jpg';
	
	/**
	 * @var QRObject qrObject
	 */
	private $qrObject = NULL;
	/**
	 * @var null save name
	 */
	private $saveName = NULL;
	/**
	 * @var null image type
	 */
	private $imageType = NULL;
	
	/**
	 * save qr-code
	 *
	 * @return string|null
	 */
	public function save()
	{
		$qrImage = $this->getQrObject()->getQrImage();
		$width   = $height = $qrImage->getLength();
		$image   = imagecreate($width,$height);
		$black   = imagecolorallocate($image, 0, 0, 0);
		$white   = imagecolorallocate($image, 255, 255, 255);
		imagefill($image,0,0,$white);
		
		$qrImageArray = $qrImage->toArray();
		for($i = 0; $i < $width; $i++)
		{
			for($j = 0; $j < $height; $j++)
			{
				if($qrImageArray[$i][$j] == 1)
				{
					imagesetpixel($image,$j,$i,$black);
				}
			}
		}
		
		switch($this->imageType)
		{
			case self::PNG:
				$this->saveName === NULL and header('content-type:image/'.$this->imageType);
				imagepng($image,$this->saveName);
				imagedestroy($image);
				break;
			case self::JPG:
				$this->saveName === NULL and header('content-type:image/'.$this->imageType);
				imagejpeg($image,$this->saveName);
				imagedestroy($image);
				break;
			case 'base64':
				ob_start();
				imagepng($image);
				imagedestroy($image);
				$image_contents = ob_get_contents();
				ob_end_clean();
				return 'data:image/png;base64,'.base64_encode($image_contents);
				break;
			case 'html':
				
				break;
		}
		return NULL;
	}
	
	/**
	 * get qrObject
	 *
	 * @return QRObject
	 */
	public function getQrObject()
	{
		return $this->qrObject;
	}
	
	/**
	 * set qrObject
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
	 * get save name
	 *
	 * @return null
	 */
	public function getSaveName()
	{
		return $this->saveName;
	}
	
	/**
	 * set save name
	 *
	 * @param null $saveName
	 *
	 * @return $this
	 */
	public function setSaveName($saveName)
	{
		$this->saveName = $saveName;
		return $this;
	}
	
	/**
	 * get image type
	 *
	 * @return null
	 */
	public function getImageType()
	{
		return $this->imageType;
	}
	
	/**
	 * set image type
	 *
	 * @param null $imageType
	 *
	 * @return $this
	 */
	public function setImageType($imageType)
	{
		$this->imageType = $imageType;
		return $this;
	}
	
}