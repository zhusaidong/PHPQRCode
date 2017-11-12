<?php
/**
* PHPQRCode demo
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
require_once('./PHPQRCode/PHPQRCode.php');

$text = isset($_GET['text'])?$_GET['text']:'HELLO WORLD';

echo (new \PHPQRCode\PHPQRCode)
	->createQRCode($text,\PHPQRCode\ErrorCorrectCode::M)
	->setSize(500)
	->toPng();
