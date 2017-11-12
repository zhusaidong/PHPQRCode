<?php
/**
* QRCodeImage Advanced
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

class QRCodeImageAdvanced
{
	private $qrCodeImage = NULL;
	private $qrCodeImageLength = 0;
	private $imageSize = 10;
	public function __construct(QRCodeImageGenerate $qrCodeImage)
	{
		$this->qrCodeImage = $qrCodeImage;
		$this->qrCodeImageLength = $qrCodeImage->getQRCodeImageLength() + 4;
		
		$this->imageSize *= $this->qrCodeImageLength;
	}
	
	/**
	* 输出二维码图片
	* @param string $imageType 图片类型
	* @param string|null $saveName 图片地址
	*/
	private function toImage($imageType = 'png',$saveName = NULL)
	{
		$qrCodeImageArray = $this->qrCodeImage->toArray();
		$width = $height = $this->qrCodeImageLength;
		
		$image = imagecreate($width,$height);
		$black = imagecolorallocate($image, 0, 0, 0);
		$white = imagecolorallocate($image, 255, 255, 255);
		imagefill($image,0,0,$white);
		
		for($i = 0; $i < $width; $i++)
		{
			for($j = 0; $j < $height; $j++)
			{
				if($qrCodeImageArray[$i][$j] == 1)
				{
					imagesetpixel($image,$j,$i,$black);
				}
			}
		}
		
		$enlarge = $this->imageSize;
		$enlargeImage = imagecreate($enlarge,$enlarge);
		imagecopyresized($enlargeImage,$image,0,0,0,0,$enlarge,$enlarge,$width,$height);
		imagedestroy($image);
		
		$saveName === NULL and header('content-type:image/'.$imageType);
		switch($imageType)
		{
			case 'png':
				imagepng($enlargeImage,$saveName);
				imagedestroy($enlargeImage);
				return $saveName;
				break;
			case 'jpeg':
			case 'jpg':
				imagejpeg($enlargeImage,$saveName);
				imagedestroy($enlargeImage);
				return $saveName;
				break;
			case 'base64':
				ob_start();
				imagepng($enlargeImage);
				imagedestroy($enlargeImage);
				$image_contents = ob_get_contents();
				ob_end_clean();
				return 'data:image/png;base64,'.base64_encode($image_contents);
				break;
		}
	}
	
	/**
	* 设置大小
	* 	(10-50)倍之间
	* @param int $imageSize
	* 
	* @return QRCodeImageAdvanced
	*/
	public function setSize($imageSize)
	{
		$imageSize < $this->qrCodeImageLength and $imageSize = $this->qrCodeImageLength;
		$imageSize > 50 * $this->qrCodeImageLength and $imageSize = 50 * $this->qrCodeImageLength;
		
		$this->imageSize = $imageSize;
		return $this;
	}
	/**
	* 输出二维码png图片
	* @param string|null $saveName 图片地址
	*/
	public function toPng($saveName = NULL)
	{
		return $this->toImage('png',$saveName);
	}
	/**
	* 输出二维码jpg图片
	* @param string|null $saveName 图片地址
	*/
	public function toJpeg($saveName = NULL)
	{
		return $this->toImage('jpeg',$saveName);
	}
	/**
	* 输出二维码 Base64图片
	* 
	* @return string Base64
	*/
	public function toBase64()
	{
		return $this->toImage('base64','base64');
	}
}
