<?php
/**
* PHPQRCode demo
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
require_once('./PHPQRCode/PHPQRCode.php');

use PHPQRCode\PHPQRCode;
use PHPQRCode\ErrorCorrectCode;
use PHPQRCode\QRCodeImageAdvanced;

(new PHPQRCode)
	->createQRCode('HELLO WORLD',ErrorCorrectCode::Q)
	//->setSize(10)
	->toPng();
