<?php
/**
 * @author zhusaidong [zhusaidong@gmail.com]
 */

namespace PHPQRCode\QRMode;

abstract class QRMode
{
	public static function getMode($data)
	{
		return new Alphanumeric();
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

	public function setData($data)
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
}
