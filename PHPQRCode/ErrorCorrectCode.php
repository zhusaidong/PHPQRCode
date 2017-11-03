<?php
/**
* 纠错码
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode;

class ErrorCorrectCode
{
	const L = 'L';
	const M = 'M';
	const Q = 'Q';
	const H = 'H';
	//错误修正容量
	private $errorCorrectingCapacity = 
	[
		ErrorCorrect::L=>0.07,
		ErrorCorrect::M=>0.15,
		ErrorCorrect::Q=>0.25,
		ErrorCorrect::H=>0.30,
	];
}
