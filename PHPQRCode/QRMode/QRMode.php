<?php
/**
* 编码模式
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRMode;

class QRMode
{
	public $name = '';
	protected $version = null;
	protected $data = null;
	protected $maxBitLength = 0;
	//补齐码
	protected $PaddingBytes = '1110110000010001';
	public function __construct()
	{
		
	}
	public function setVersion($version)
	{
		$this->version = $version;
		return $this;
	}
	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}
	public function setMaxBitLength($maxBitLength)
	{
		$this->maxBitLength = $maxBitLength;
		return $this;
	}
	//添加终止符,补齐码
	protected function addPadBytes($data)
	{
		//如果尾部数据不足8bit,则在尾部充0:
		$data = str_split($data,8);
		foreach($data as $key => $value)
		{
			$data[$key] = str_pad($value,8,0,STR_PAD_RIGHT);
		}
		$data = implode('',$data);
		//如果字符串仍然太短，则添加补齐码
		while(strlen($data) < $this->maxBitLength)
		{
			$data .= $this->PaddingBytes;
		}
		if(strlen($data) > $this->maxBitLength)
		{
			$data = substr($data,0,$this->maxBitLength);
		}
		return $data;
	}
	//字符计数指示符-转二进制的长度
	protected function getDataLength()
	{
		$length = 0;
		foreach($this->dataLength as $key => $value)
		{
			if($key <= $this->version)
			{
				$length = $value;
			}
		}
		return $length;
	}
	
	/**
	* 二进制转十进制数字
	*/
	public function Binary2Number($binary)
	{
		if(is_array($binary))
		{
			foreach($binary as $key => $value)
			{
				$binary[$key] = $this->Binary2Number($value);
			}
		}
		else
		{
			$binary = base_convert($binary,2,10);
		}
		return $binary;
	}
	/**
	* get mode
	* @param string $text
	* 
	* @return QRMode
	*/
	public function getMode($text)
	{
		$qrMode = null;
		switch($text)
		{
			case QRMode::isBinary($text):
				$qrMode = new Binary();
				break;
			case QRMode::isNumeric($text):
				$qrMode = new Numeric();
				break;
			case QRMode::isAlphanumeric($text):
				$qrMode = new Alphanumeric();
				break;
			case QRMode::isKanji($text):
				$qrMode = new Kanji();
				break;
			case QRMode::isByte($text):
				$qrMode = new Byte();
				break;
			default:
				$qrMode = new Alphanumeric();
				break;
		}
		return $qrMode->setData($text);
	}
	
	/**
	* 是否是字节
	*/
	public function isByte($text)
	{
		return !empty(str_replace(Alphanumeric::getStrList(),'',$text));
	}
	/**
	* 是否是数字
	*/
	public static function isNumeric($text)
	{
		return !preg_match('/[^0-9]+/',$text);
	}
	/**
	* 是否是混合
	*/
	public static function isAlphanumeric($text)
	{
		return !!preg_match('/(?:[A-Z]){1,}(?:[0-9]){1,}|(?:[\s\$%\*\+-\.\/\:]){1,}/',$text);
	}
	/**
	* 是否是中文
	*/
	public static function isKanji($text)
	{
		return !preg_match('/[^\x7f-\xff]/',$text);
	}
	/**
	* 是否是二进制
	*/
	public static function isBinary($text)
	{
		return !preg_match('/[^01]+/',$text);
	}
}
