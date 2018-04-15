<?php
/**
* PHPQRCode demo
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
require_once('PHPQRCode/__autoload.php');

/*
//debug
$rs = new \PHPQRCode\ReedSolomon\ReedSolomon;
echo $rs->encode([32,91,11,120,209,114,220,77,67,64,236,17,236,17,236,17],10);//196 35 39 119 235 215 231 226 93 23
exit;
*/

$text = isset($_GET['text'])?$_GET['text']:'HELLO WORLD';

$text = '1505772536615057725366';
//$text = 'abcdefghi';
//$text = 'http://localhost/PHPQRCode/demo.php';

use PHPQRCode\PHPQRCode,
	PHPQRCode\ErrorCorrectCodeLevel as ecl;

$phpQRCode = new PHPQRCode;
echo $phpQRCode
	->createQRCode($text,ecl::M)
	->setSize(500)
	->toPng();
