<?php
/**
* PHPQRCode demo
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
require_once('./PHPQRCode/PHPQRCode.php');

use PHPQRCode\PHPQRCode;
use PHPQRCode\ErrorCorrectCode;

$text = isset($_GET['text'])?$_GET['text']:'HELLO WORLD';

/*
* bug:
	Numeric 位数>=7，识别失败
	Byte 位数>=7，识别失败
	Alphanumeric 位数>=5，识别失败
	Kanji 识别失败
*/
$text = '8675309';

echo (new PHPQRCode)
	->createQRCode($text,ErrorCorrectCode::Q)
	->setSize(500)
	->toPng();
