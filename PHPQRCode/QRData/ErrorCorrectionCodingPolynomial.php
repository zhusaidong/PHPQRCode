<?php
/**
* 纠错码多项式
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRData;

use PHPQRCode\Polynomial;

class ErrorCorrectionCodingPolynomial
{
	private $errorCorrectionCodingPolynomial = [];
	public function __construct()
	{
		$this->init();
	}
	private function init()
	{
		$this->data(7,"1x7+87x6+229x5+146x4+149x3+238x2+102x1+21x0");
		$this->data(10,"1x10+251x9+67x8+46x7+61x6+118x5+70x4+64x3+94x2+32x1+45x0");
		$this->data(13,"1x13+74x12+152x11+176x10+100x9+86x8+100x7+106x6+104x5+130x4+218x3+206x2+140x1+78x0");
		$this->data(15,"1x15+8x14+183x13+61x12+91x11+202x10+37x9+51x8+58x7+58x6+237x5+140x4+124x3+5x2+99x1+105x0");
		$this->data(16,"1x16+120x15+104x14+107x13+109x12+102x11+161x10+76x9+3x8+91x7+191x6+147x5+169x4+182x3+194x2+225x1+120x0");
		$this->data(17,"1x17+43x16+139x15+206x14+78x13+43x12+239x11+123x10+206x9+214x8+147x7+24x6+99x5+150x4+39x3+243x2+163x1+136x0");
		$this->data(18,"1x18+215x17+234x16+158x15+94x14+184x13+97x12+118x11+170x10+79x9+187x8+152x7+148x6+252x5+179x4+5x3+98x2+96x1+153x0");
		$this->data(20,"1x20+17x19+60x18+79x17+50x16+61x15+163x14+26x13+187x12+202x11+180x10+221x9+225x8+83x7+239x6+156x5+164x4+212x3+212x2+188x1+190x0");
		$this->data(22,"1x22+210x21+171x20+247x19+242x18+93x17+230x16+14x15+109x14+221x13+53x12+200x11+74x10+8x9+172x8+98x7+80x6+219x5+134x4+160x3+105x2+165x1+231x0");
		$this->data(24,"1x24+229x23+121x22+135x21+48x20+211x19+117x18+251x17+126x16+159x15+180x14+169x13+152x12+192x11+226x10+228x9+218x8+111x7+1x6+117x5+232x4+87x3+96x2+227x1+21x0");
		$this->data(26,"1x26+173x25+125x24+158x23+2x22+103x21+182x20+118x19+17x18+145x17+201x16+111x15+28x14+165x13+53x12+161x11+21x10+245x9+142x8+13x7+102x6+48x5+227x4+153x3+145x2+218x1+70x0");
		$this->data(28,"1x28+168x27+223x26+200x25+104x24+224x23+234x22+108x21+180x20+110x19+190x18+195x17+147x16+205x15+27x14+232x13+201x12+21x11+43x10+245x9+87x8+42x7+195x6+212x5+119x4+242x3+37x2+9x1+123x0");
		$this->data(30,"1x30+41x29+173x28+145x27+152x26+216x25+31x24+179x23+182x22+50x21+48x20+110x19+86x18+239x17+96x16+222x15+125x14+42x13+173x12+226x11+193x10+224x9+130x8+156x7+37x6+251x5+216x4+238x3+40x2+192x1+180x0");
		$this->data(32,"1x32+10x31+6x30+106x29+190x28+249x27+167x26+4x25+67x24+209x23+138x22+138x21+32x20+242x19+123x18+89x17+27x16+120x15+185x14+80x13+156x12+38x11+69x10+171x9+60x8+28x7+222x6+80x5+52x4+254x3+185x2+220x1+241x0");
		$this->data(34,"1x34+111x33+77x32+146x31+94x30+26x29+21x28+108x27+19x26+105x25+94x24+113x23+193x22+86x21+140x20+163x19+125x18+58x17+158x16+229x15+239x14+218x13+103x12+56x11+70x10+114x9+61x8+183x7+129x6+167x5+13x4+98x3+62x2+129x1+51x0");
		$this->data(36,"1x36+200x35+183x34+98x33+16x32+172x31+31x30+246x29+234x28+60x27+152x26+115x25+1x24+167x23+152x22+113x21+248x20+238x19+107x18+18x17+63x16+218x15+37x14+87x13+210x12+105x11+177x10+120x9+74x8+121x7+196x6+117x5+251x4+113x3+233x2+30x1+120x0");
		$this->data(40,"1x40+59x39+116x38+79x37+161x36+252x35+98x34+128x33+205x32+128x31+161x30+247x29+57x28+163x27+56x26+235x25+106x24+53x23+26x22+187x21+174x20+226x19+104x18+170x17+7x16+175x15+35x14+181x13+114x12+88x11+41x10+47x9+163x8+125x7+134x6+72x5+20x4+232x3+53x2+35x1+15x0");
		$this->data(42,"1x42+250x41+103x40+221x39+230x38+25x37+18x36+137x35+231x34+1x33+3x32+58x31+242x30+221x29+191x28+110x27+84x26+230x25+8x24+188x23+106x22+96x21+147x20+15x19+131x18+139x17+34x16+101x15+223x14+39x13+101x12+213x11+199x10+237x9+254x8+201x7+123x6+171x5+162x4+194x3+117x2+50x1+96x0");
		$this->data(44,"1x44+190x43+7x42+61x41+121x40+71x39+246x38+69x37+55x36+168x35+188x34+89x33+243x32+191x31+25x30+72x29+123x28+9x27+145x26+14x25+247x24+1x23+238x22+44x21+78x20+143x19+62x18+224x17+126x16+118x15+114x14+68x13+163x12+52x11+194x10+217x9+147x8+204x7+169x6+37x5+130x4+113x3+102x2+73x1+181x0");
		$this->data(46,"1x46+112x45+94x44+88x43+112x42+253x41+224x40+202x39+115x38+187x37+99x36+89x35+5x34+54x33+113x32+129x31+44x30+58x29+16x28+135x27+216x26+169x25+211x24+36x23+1x22+4x21+96x20+60x19+241x18+73x17+104x16+234x15+8x14+249x13+245x12+119x11+174x10+52x9+25x8+157x7+224x6+43x5+202x4+223x3+19x2+82x1+15x0");
		$this->data(48,"1x48+228x47+25x46+196x45+130x44+211x43+146x42+60x41+24x40+251x39+90x38+39x37+102x36+240x35+61x34+178x33+63x32+46x31+123x30+115x29+18x28+221x27+111x26+135x25+160x24+182x23+205x22+107x21+206x20+95x19+150x18+120x17+184x16+91x15+21x14+247x13+156x12+140x11+238x10+191x9+11x8+94x7+227x6+84x5+50x4+163x3+39x2+34x1+108x0");
		$this->data(50,"1x50+232x49+125x48+157x47+161x46+164x45+9x44+118x43+46x42+209x41+99x40+203x39+193x38+35x37+3x36+209x35+111x34+195x33+242x32+203x31+225x30+46x29+13x28+32x27+160x26+126x25+209x24+130x23+160x22+242x21+215x20+242x19+75x18+77x17+42x16+189x15+32x14+113x13+65x12+124x11+69x10+228x9+114x8+235x7+175x6+124x5+170x4+215x3+232x2+133x1+205x0");
		$this->data(52,"1x52+116x51+50x50+86x49+186x48+50x47+220x46+251x45+89x44+192x43+46x42+86x41+127x40+124x39+19x38+184x37+233x36+151x35+215x34+22x33+14x32+59x31+145x30+37x29+242x28+203x27+134x26+254x25+89x24+190x23+94x22+59x21+65x20+124x19+113x18+100x17+233x16+235x15+121x14+22x13+76x12+86x11+97x10+39x9+242x8+200x7+220x6+101x5+33x4+239x3+254x2+116x1+51x0");
		$this->data(54,"1x54+183x53+26x52+201x51+87x50+210x49+221x48+113x47+21x46+46x45+65x44+45x43+50x42+238x41+184x40+249x39+225x38+102x37+58x36+209x35+218x34+109x33+165x32+26x31+95x30+184x29+192x28+52x27+245x26+35x25+254x24+238x23+175x22+172x21+79x20+123x19+25x18+122x17+43x16+120x15+108x14+215x13+80x12+128x11+201x10+235x9+8x8+153x7+59x6+101x5+31x4+198x3+76x2+31x1+156x0");
		$this->data(56,"1x56+106x55+120x54+107x53+157x52+164x51+216x50+112x49+116x48+2x47+91x46+248x45+163x44+36x43+201x42+202x41+229x40+6x39+144x38+254x37+155x36+135x35+208x34+170x33+209x32+12x31+139x30+127x29+142x28+182x27+249x26+177x25+174x24+190x23+28x22+10x21+85x20+239x19+184x18+101x17+124x16+152x15+206x14+96x13+23x12+163x11+61x10+27x9+196x8+247x7+151x6+154x5+202x4+207x3+20x2+61x1+10x0");
		$this->data(58,"1x58+82x57+116x56+26x55+247x54+66x53+27x52+62x51+107x50+252x49+182x48+200x47+185x46+235x45+55x44+251x43+242x42+210x41+144x40+154x39+237x38+176x37+141x36+192x35+248x34+152x33+249x32+206x31+85x30+253x29+142x28+65x27+165x26+125x25+23x24+24x23+30x22+122x21+240x20+214x19+6x18+129x17+218x16+29x15+145x14+127x13+134x12+206x11+245x10+117x9+29x8+41x7+63x6+159x5+142x4+233x3+125x2+148x1+123x0");
		$this->data(60,"1x60+107x59+140x58+26x57+12x56+9x55+141x54+243x53+197x52+226x51+197x50+219x49+45x48+211x47+101x46+219x45+120x44+28x43+181x42+127x41+6x40+100x39+247x38+2x37+205x36+198x35+57x34+115x33+219x32+101x31+109x30+160x29+82x28+37x27+38x26+238x25+49x24+160x23+209x22+121x21+86x20+11x19+124x18+30x17+181x16+84x15+25x14+194x13+87x12+65x11+102x10+190x9+220x8+70x7+27x6+209x5+16x4+89x3+7x2+33x1+240x0");
		$this->data(62,"1x62+65x61+202x60+113x59+98x58+71x57+223x56+248x55+118x54+214x53+94x52+1x51+122x50+37x49+23x48+2x47+228x46+58x45+121x44+7x43+105x42+135x41+78x40+243x39+118x38+70x37+76x36+223x35+89x34+72x33+50x32+70x31+111x30+194x29+17x28+212x27+126x26+181x25+35x24+221x23+117x22+235x21+11x20+229x19+149x18+147x17+123x16+213x15+40x14+115x13+6x12+200x11+100x10+26x9+246x8+182x7+218x6+127x5+215x4+36x3+186x2+110x1+106x0");
		$this->data(64,"1x64+45x63+51x62+175x61+9x60+7x59+158x58+159x57+49x56+68x55+119x54+92x53+123x52+177x51+204x50+187x49+254x48+200x47+78x46+141x45+149x44+119x43+26x42+127x41+53x40+160x39+93x38+199x37+212x36+29x35+24x34+145x33+156x32+208x31+150x30+218x29+209x28+4x27+216x26+91x25+47x24+184x23+146x22+47x21+140x20+195x19+195x18+125x17+242x16+238x15+63x14+99x13+108x12+140x11+230x10+242x9+31x8+204x7+11x6+178x5+243x4+217x3+156x2+213x1+231x0");
		$this->data(66,"1x66+5x65+118x64+222x63+180x62+136x61+136x60+162x59+51x58+46x57+117x56+13x55+215x54+81x53+17x52+139x51+247x50+197x49+171x48+95x47+173x46+65x45+137x44+178x43+68x42+111x41+95x40+101x39+41x38+72x37+214x36+169x35+197x34+95x33+7x32+44x31+154x30+77x29+111x28+236x27+40x26+121x25+143x24+63x23+87x22+80x21+253x20+240x19+126x18+217x17+77x16+34x15+232x14+106x13+50x12+168x11+82x10+76x9+146x8+67x7+106x6+171x5+25x4+132x3+93x2+45x1+105x0");
		$this->data(68,"1x68+247x67+159x66+223x65+33x64+224x63+93x62+77x61+70x60+90x59+160x58+32x57+254x56+43x55+150x54+84x53+101x52+190x51+205x50+133x49+52x48+60x47+202x46+165x45+220x44+203x43+151x42+93x41+84x40+15x39+84x38+253x37+173x36+160x35+89x34+227x33+52x32+199x31+97x30+95x29+231x28+52x27+177x26+41x25+125x24+137x23+241x22+166x21+225x20+118x19+2x18+54x17+32x16+82x15+215x14+175x13+198x12+43x11+238x10+235x9+27x8+101x7+184x6+127x5+3x4+5x3+8x2+163x1+238x0");
	}
	private function data($eccWords,$polynomialStr)
	{
		preg_match_all('/\d+x\d++/iUs',$polynomialStr,$arr);
		$polynomial = new Polynomial;
		foreach($arr[0] as $vv)
		{
			$vvs = explode('x',$vv);
			$polynomial->setPolynomial($vvs[1],$vvs[0]);
		}
		$this->errorCorrectionCodingPolynomial[$eccWords] = $polynomial;
	}
	
	/*
	* @param int $eccWords 纠错码数
	*/
	public function getErrorCorrectionCodingPolynomial($eccWords)
	{
		return $this->errorCorrectionCodingPolynomial[$eccWords];
	}
}
