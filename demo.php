<?php
/**
* PHPQRCode demo
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
require_once('PHPQRCode/__autoload.php');

$text = isset($_GET['text'])?$_GET['text']:'HELLO WORLD';

echo (new \PHPQRCode\PHPQRCode)
	->createQRCode($text,\PHPQRCode\ErrorCorrectCode::Q)
	->setSize(500)
	->toPng();
