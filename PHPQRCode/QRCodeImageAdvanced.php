<?php
/**
* QRCodeImage
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

class QRCodeImageAdvanced
{
	private $qrCodeImage = NULL;
	private $imageSize = 10;
	public function __construct(QRCodeImageGenerate $qrCodeImage)
	{
		$this->qrCodeImage = $qrCodeImage;
	}
	
	/**
	* 输出二维码图片
	* @param string $imageType 图片类型
	* @param string|null $saveName 图片地址
	* 
	* @return image
	*/
	private function toImage($imageType = 'png',$saveName = NULL)
	{
		//放大倍数
		$enlarge = $this->imageSize;
		
		$qrCodeImageArray = $this->qrCodeImage->toArray();
		$width = $height = count($qrCodeImageArray);
		
		$image = imagecreate($width,$height);
		$black = imagecolorallocate($image, 0, 0, 0);
		$white = imagecolorallocate($image, 255, 255, 255);
		imagefill($image,0,0,$white);
		
		for($i = 0; $i < $width; $i++)
		{
			for($j = 0; $j < $height; $j++)
			{
				if($qrCodeImageArray[$i][$j] === 1)
				{
					imagesetpixel($image,$i,$j,$black);
				}
			}
		}
		
		$enlargeImage = imagecreate($width * $enlarge, $height * $enlarge);
		imagecopyresized($enlargeImage, $image, 0, 0, 0, 0, $width * $enlarge, $height * $enlarge, $width, $height);
		imagedestroy($image);
		
		header('content-type:image/'.$imageType);
		switch($imageType)
		{
			case 'png':
				imagepng($enlargeImage,$saveName);
				break;
			case 'jpeg':
			case 'jpg':
				imagejpeg($enlargeImage,$saveName);
				break;
		}
		imagedestroy($enlargeImage);
	}
	
	/**
	* 设置大小
	* @param int $imageSize
	* 
	* @return QRCodeImageAdvanced
	*/
	public function setSize($imageSize = 10)
	{
		$this->imageSize = $imageSize;
		return $this;
	}
	/**
	* 输出二维码png图片
	* @param string|null $saveName 图片地址
	* 
	* @return image
	*/
	public function toPng($saveName = NULL)
	{
		$this->toImage('png',$saveName);
	}
	/**
	* 输出二维码jpg图片
	* @param string|null $saveName 图片地址
	* 
	* @return image
	*/
	public function toJpeg($saveName = NULL)
	{
		$this->toImage('jpeg',$saveName);
	}
}
