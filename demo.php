<?php
/**
* PHPQRCode demo
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
require_once('PHPQRCode/__autoload.php');

$text = isset($_GET['text'])?$_GET['text']:'HELLO WORLD';

use PHPQRCode\PHPQRCode,
	PHPQRCode\ErrorCorrectCodeLevel;

$phpQRCode = new PHPQRCode;
echo $phpQRCode
	->createQRCode($text,ErrorCorrectCodeLevel::M)
	->setSize(500)
	->toPng();
