<?php
/**
* 对数与反对数表
* @author Zsdroid [635925926@qq.com]
*/
namespace PHPQRCode\QRData;

class LogAantilog
{
	private $logAantilog = [];
	
	public function __construct()
	{
		$this->init();
	}
	private function init()
	{
		$this->data(0,1,'','');
		$this->data(1,2,1,0);
		$this->data(2,4,2,1);
		$this->data(3,8,3,25);
		$this->data(4,16,4,2);
		$this->data(5,32,5,50);
		$this->data(6,64,6,26);
		$this->data(7,128,7,198);
		$this->data(8,29,8,3);
		$this->data(9,58,9,223);
		$this->data(10,116,10,51);
		$this->data(11,232,11,238);
		$this->data(12,205,12,27);
		$this->data(13,135,13,104);
		$this->data(14,19,14,199);
		$this->data(15,38,15,75);
		$this->data(16,76,16,4);
		$this->data(17,152,17,100);
		$this->data(18,45,18,224);
		$this->data(19,90,19,14);
		$this->data(20,180,20,52);
		$this->data(21,117,21,141);
		$this->data(22,234,22,239);
		$this->data(23,201,23,129);
		$this->data(24,143,24,28);
		$this->data(25,3,25,193);
		$this->data(26,6,26,105);
		$this->data(27,12,27,248);
		$this->data(28,24,28,200);
		$this->data(29,48,29,8);
		$this->data(30,96,30,76);
		$this->data(31,192,31,113);
		$this->data(32,157,32,5);
		$this->data(33,39,33,138);
		$this->data(34,78,34,101);
		$this->data(35,156,35,47);
		$this->data(36,37,36,225);
		$this->data(37,74,37,36);
		$this->data(38,148,38,15);
		$this->data(39,53,39,33);
		$this->data(40,106,40,53);
		$this->data(41,212,41,147);
		$this->data(42,181,42,142);
		$this->data(43,119,43,218);
		$this->data(44,238,44,240);
		$this->data(45,193,45,18);
		$this->data(46,159,46,130);
		$this->data(47,35,47,69);
		$this->data(48,70,48,29);
		$this->data(49,140,49,181);
		$this->data(50,5,50,194);
		$this->data(51,10,51,125);
		$this->data(52,20,52,106);
		$this->data(53,40,53,39);
		$this->data(54,80,54,249);
		$this->data(55,160,55,185);
		$this->data(56,93,56,201);
		$this->data(57,186,57,154);
		$this->data(58,105,58,9);
		$this->data(59,210,59,120);
		$this->data(60,185,60,77);
		$this->data(61,111,61,228);
		$this->data(62,222,62,114);
		$this->data(63,161,63,166);
		$this->data(64,95,64,6);
		$this->data(65,190,65,191);
		$this->data(66,97,66,139);
		$this->data(67,194,67,98);
		$this->data(68,153,68,102);
		$this->data(69,47,69,221);
		$this->data(70,94,70,48);
		$this->data(71,188,71,253);
		$this->data(72,101,72,226);
		$this->data(73,202,73,152);
		$this->data(74,137,74,37);
		$this->data(75,15,75,179);
		$this->data(76,30,76,16);
		$this->data(77,60,77,145);
		$this->data(78,120,78,34);
		$this->data(79,240,79,136);
		$this->data(80,253,80,54);
		$this->data(81,231,81,208);
		$this->data(82,211,82,148);
		$this->data(83,187,83,206);
		$this->data(84,107,84,143);
		$this->data(85,214,85,150);
		$this->data(86,177,86,219);
		$this->data(87,127,87,189);
		$this->data(88,254,88,241);
		$this->data(89,225,89,210);
		$this->data(90,223,90,19);
		$this->data(91,163,91,92);
		$this->data(92,91,92,131);
		$this->data(93,182,93,56);
		$this->data(94,113,94,70);
		$this->data(95,226,95,64);
		$this->data(96,217,96,30);
		$this->data(97,175,97,66);
		$this->data(98,67,98,182);
		$this->data(99,134,99,163);
		$this->data(100,17,100,195);
		$this->data(101,34,101,72);
		$this->data(102,68,102,126);
		$this->data(103,136,103,110);
		$this->data(104,13,104,107);
		$this->data(105,26,105,58);
		$this->data(106,52,106,40);
		$this->data(107,104,107,84);
		$this->data(108,208,108,250);
		$this->data(109,189,109,133);
		$this->data(110,103,110,186);
		$this->data(111,206,111,61);
		$this->data(112,129,112,202);
		$this->data(113,31,113,94);
		$this->data(114,62,114,155);
		$this->data(115,124,115,159);
		$this->data(116,248,116,10);
		$this->data(117,237,117,21);
		$this->data(118,199,118,121);
		$this->data(119,147,119,43);
		$this->data(120,59,120,78);
		$this->data(121,118,121,212);
		$this->data(122,236,122,229);
		$this->data(123,197,123,172);
		$this->data(124,151,124,115);
		$this->data(125,51,125,243);
		$this->data(126,102,126,167);
		$this->data(127,204,127,87);
		$this->data(128,133,128,7);
		$this->data(129,23,129,112);
		$this->data(130,46,130,192);
		$this->data(131,92,131,247);
		$this->data(132,184,132,140);
		$this->data(133,109,133,128);
		$this->data(134,218,134,99);
		$this->data(135,169,135,13);
		$this->data(136,79,136,103);
		$this->data(137,158,137,74);
		$this->data(138,33,138,222);
		$this->data(139,66,139,237);
		$this->data(140,132,140,49);
		$this->data(141,21,141,197);
		$this->data(142,42,142,254);
		$this->data(143,84,143,24);
		$this->data(144,168,144,227);
		$this->data(145,77,145,165);
		$this->data(146,154,146,153);
		$this->data(147,41,147,119);
		$this->data(148,82,148,38);
		$this->data(149,164,149,184);
		$this->data(150,85,150,180);
		$this->data(151,170,151,124);
		$this->data(152,73,152,17);
		$this->data(153,146,153,68);
		$this->data(154,57,154,146);
		$this->data(155,114,155,217);
		$this->data(156,228,156,35);
		$this->data(157,213,157,32);
		$this->data(158,183,158,137);
		$this->data(159,115,159,46);
		$this->data(160,230,160,55);
		$this->data(161,209,161,63);
		$this->data(162,191,162,209);
		$this->data(163,99,163,91);
		$this->data(164,198,164,149);
		$this->data(165,145,165,188);
		$this->data(166,63,166,207);
		$this->data(167,126,167,205);
		$this->data(168,252,168,144);
		$this->data(169,229,169,135);
		$this->data(170,215,170,151);
		$this->data(171,179,171,178);
		$this->data(172,123,172,220);
		$this->data(173,246,173,252);
		$this->data(174,241,174,190);
		$this->data(175,255,175,97);
		$this->data(176,227,176,242);
		$this->data(177,219,177,86);
		$this->data(178,171,178,211);
		$this->data(179,75,179,171);
		$this->data(180,150,180,20);
		$this->data(181,49,181,42);
		$this->data(182,98,182,93);
		$this->data(183,196,183,158);
		$this->data(184,149,184,132);
		$this->data(185,55,185,60);
		$this->data(186,110,186,57);
		$this->data(187,220,187,83);
		$this->data(188,165,188,71);
		$this->data(189,87,189,109);
		$this->data(190,174,190,65);
		$this->data(191,65,191,162);
		$this->data(192,130,192,31);
		$this->data(193,25,193,45);
		$this->data(194,50,194,67);
		$this->data(195,100,195,216);
		$this->data(196,200,196,183);
		$this->data(197,141,197,123);
		$this->data(198,7,198,164);
		$this->data(199,14,199,118);
		$this->data(200,28,200,196);
		$this->data(201,56,201,23);
		$this->data(202,112,202,73);
		$this->data(203,224,203,236);
		$this->data(204,221,204,127);
		$this->data(205,167,205,12);
		$this->data(206,83,206,111);
		$this->data(207,166,207,246);
		$this->data(208,81,208,108);
		$this->data(209,162,209,161);
		$this->data(210,89,210,59);
		$this->data(211,178,211,82);
		$this->data(212,121,212,41);
		$this->data(213,242,213,157);
		$this->data(214,249,214,85);
		$this->data(215,239,215,170);
		$this->data(216,195,216,251);
		$this->data(217,155,217,96);
		$this->data(218,43,218,134);
		$this->data(219,86,219,177);
		$this->data(220,172,220,187);
		$this->data(221,69,221,204);
		$this->data(222,138,222,62);
		$this->data(223,9,223,90);
		$this->data(224,18,224,203);
		$this->data(225,36,225,89);
		$this->data(226,72,226,95);
		$this->data(227,144,227,176);
		$this->data(228,61,228,156);
		$this->data(229,122,229,169);
		$this->data(230,244,230,160);
		$this->data(231,245,231,81);
		$this->data(232,247,232,11);
		$this->data(233,243,233,245);
		$this->data(234,251,234,22);
		$this->data(235,235,235,235);
		$this->data(236,203,236,122);
		$this->data(237,139,237,117);
		$this->data(238,11,238,44);
		$this->data(239,22,239,215);
		$this->data(240,44,240,79);
		$this->data(241,88,241,174);
		$this->data(242,176,242,213);
		$this->data(243,125,243,233);
		$this->data(244,250,244,230);
		$this->data(245,233,245,231);
		$this->data(246,207,246,173);
		$this->data(247,131,247,232);
		$this->data(248,27,248,116);
		$this->data(249,54,249,214);
		$this->data(250,108,250,244);
		$this->data(251,216,251,234);
		$this->data(252,173,252,168);
		$this->data(253,71,253,80);
		$this->data(254,142,254,88);
		$this->data(255,1,255,175);
	}
	//todo 生成数据
	private function createLogData()
	{
		$x = 0;
		$arr = [];
		for($i = 0; $i < pow(2,8); $i++)
		{
			if($x > 0)
			{
				$a = $arr[$x] * 2;
				$x = $i;
				if($a > 256)
				{
					$x = 0;
				}
			}
			else
			{
				$a = pow(2,$i);
			}
			
			if($x == 0 and $a >= 256)
			{
				$a = $a ^ 285;
				$x = $i;
			}
			$arr[$i] = $a;
		}
		return $arr;
	}
	private function data($logKey,$logValue,$antilogKey = '',$antilogValue = '')
	{
		$logAantilog = [];
		$this->logAantilog['log'][$logKey] = $logValue;//对数:α的指数=>整数
		$antilogKey !== '' and $antilogValue !== '' and $this->logAantilog['antilog'][$antilogKey] = $antilogValue;//反对数:整数=>α的指数
	}
	
	//对数
	public function getIntegerByAlpha($alpha)
	{
		return $this->logAantilog['log'][$alpha];
	}
	//反对数
	public function getAlphaByInteger($integer)
	{
		return $this->logAantilog['antilog'][$integer];
	}
}
