<?php
/**
* __autoload
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
spl_autoload_register(
	function($class)
	{
		file_exists($class.'.php') and require($class.'.php');
	});
