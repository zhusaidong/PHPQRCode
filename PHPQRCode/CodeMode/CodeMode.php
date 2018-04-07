<?php
/**
* 编码模式
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\CodeMode;

abstract class CodeMode
{
	//指示符
	protected $indicator = '';
	//字符计数指示符长度
	protected $characterCountIndicator = [];
	//二维码版本
	protected $version = null;
	//数据
	protected $data = null;
	//最大长度
	protected $maxBitLength = 0;
	//补齐码
	protected $PaddingBytes = '1110110000010001';
	
	public function __construct()
	{
	}
	
	/**
	* 设置二维码版本
	* @param int $version
	*/
	public function setVersion($version)
	{
		$this->version = $version;
		return $this;
	}
	/**
	* 设置数据
	* @param string $data 数据
	*/
	public function setData($data)
	{
		$this->data = $data;
		return $this;
	}
	/**
	* 获取类名
	* @param boolean $hasNamespace 是否包含命名空间
	* 
	* @return string 类名
	*/
	public function getClassName($hasNamespace = FALSE)
	{
		$className = get_class($this);
		return !$hasNamespace ? join('',array_slice(explode('\\',$className),-1)) : array_slice(explode('\\',$className),0,-1);
	}
	/**
	* 设置最大长度
	* @param int $maxBitLength
	*/
	public function setMaxBitLength($maxBitLength)
	{
		$this->maxBitLength = $maxBitLength;
		return $this;
	}
	
	/**
	* 添加终止符,补齐码
	* @param string $data
	* 
	* @return string
	*/
	protected function addPadBytes($data)
	{
		//结束符
		$data .= '0000';
		//如果尾部数据不足8bit,则在尾部充0:
		$data .= str_pad('',ceil(strlen($data) / 8) * 8 - strlen($data),0,STR_PAD_RIGHT);
		//如果字符串仍然太短，则添加补齐码
		while(strlen($data) < $this->maxBitLength)
		{
			$data .= $this->PaddingBytes;
		}
		$data = substr($data,0,$this->maxBitLength);
		return $data;
	}
	/**
	* 字符计数指示符长度
	* 
	* @return int 计数指示符长度
	*/
	protected function getCharacterCountIndicatorLength()
	{
		foreach($this->characterCountIndicator as $key => $value)
		{
			if($key <= $this->version)
			{
				return $value;
			}
		}
		return 0;
	}
	
	/**
	* 转二进制
	* @param string|int $text 文本
	* @param int $frombase 文本初始进制
	* @param int $length 二进制长度
	* 
	* @return string 二进制
	*/
	protected function toBinary($text,$frombase,$length)
	{
		return str_pad(base_convert($text,$frombase,2),$length,0,STR_PAD_LEFT);
	}
	
	/**
	* get mode
	* @param string $text
	*/
	public static function getMode($text)
	{
		$codeMode = null;
		switch($text)
		{
			case self::isNumeric($text):
				$codeMode = new Numeric();
				break;
			case self::isAlphanumeric($text):
				$codeMode = new Alphanumeric();
				break;
			case self::isKanji($text):
				$codeMode = new Kanji();
				break;
			case self::isByte($text):
				$codeMode = new Byte();
				break;
		}
		if(empty($codeMode))
		{
			echo 'no support context!';exit;
		}
		return $codeMode->setData($text);
	}
	
	/**
	* 是否是字节
	*/
	private static function isByte($text)
	{
		return !empty(str_replace(Alphanumeric::getStrList(),'',$text));
	}
	/**
	* 是否是数字
	*/
	private static function isNumeric($text)
	{
		return !preg_match('/[^0-9]+/',$text);
	}
	/**
	* 是否是混合
	*/
	private static function isAlphanumeric($text)
	{
		return empty(str_replace(Alphanumeric::getStrList(),'',$text));
		//return !!preg_match('/(?:[A-Z]){1,}(?:[0-9]){1,}|(?:[\s\$%\*\+-\.\/\:]){1,}/',$text);
	}
	/**
	* 是否是中文
	*/
	private static function isKanji($text)
	{
		return !preg_match('/[^\x7f-\xff]/',$text);
	}
}
