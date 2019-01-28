<?php
/**
 * @author zhusaidong [zhusaidong@gmail.com]
 */

require('vendor/autoload.php');

use PHPQRCode\QRCode;
use PHPQRCode\ErrorCorrectionLevel as ecl;

//create qr-code
$text = 'test,this is a qr-code.';
QRCode::_create($text,ecl::L);

/*
//parse qr-code
$imgUrl = 'qrcode.png';
QRCode::_parse($imgUrl);
*/
