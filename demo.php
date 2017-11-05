<?php
/**
* PHPQRCode demo
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
require_once('./PHPQRCode/PHPQRCode.php');

use PHPQRCode\PHPQRCode;
use PHPQRCode\ErrorCorrectCode;

$PHPQRCode = new PHPQRCode;
echo $PHPQRCode->createQRCode('HELLO WORLD',ErrorCorrectCode::Q);
