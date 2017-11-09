<?php
/**
* 数据容量
* @author Zsdroid [635925926@qq.com]
* @version 0.1.0.0
*/
namespace PHPQRCode\QRData;

use \PHPQRCode\ErrorCorrectCode;

class DataCapacity
{
	private $DataCapacity = [];
	
	public function __construct()
	{
		$this->init();
	}
	private function init()
	{
		$this->data(1,ErrorCorrectCode::L,['Numeric'=>41,'Alphanumeric'=>25,'Byte'=>17,'Kanji'=>10]);
		$this->data(1,ErrorCorrectCode::M,['Numeric'=>34,'Alphanumeric'=>20,'Byte'=>14,'Kanji'=>8]);
		$this->data(1,ErrorCorrectCode::Q,['Numeric'=>27,'Alphanumeric'=>16,'Byte'=>11,'Kanji'=>7]);
		$this->data(1,ErrorCorrectCode::H,['Numeric'=>17,'Alphanumeric'=>10,'Byte'=>7,'Kanji'=>4]);
		$this->data(2,ErrorCorrectCode::L,['Numeric'=>77,'Alphanumeric'=>47,'Byte'=>32,'Kanji'=>20]);
		$this->data(2,ErrorCorrectCode::M,['Numeric'=>63,'Alphanumeric'=>38,'Byte'=>26,'Kanji'=>16]);
		$this->data(2,ErrorCorrectCode::Q,['Numeric'=>48,'Alphanumeric'=>29,'Byte'=>20,'Kanji'=>12]);
		$this->data(2,ErrorCorrectCode::H,['Numeric'=>34,'Alphanumeric'=>20,'Byte'=>14,'Kanji'=>8]);
		$this->data(3,ErrorCorrectCode::L,['Numeric'=>127,'Alphanumeric'=>77,'Byte'=>53,'Kanji'=>32]);
		$this->data(3,ErrorCorrectCode::M,['Numeric'=>101,'Alphanumeric'=>61,'Byte'=>42,'Kanji'=>26]);
		$this->data(3,ErrorCorrectCode::Q,['Numeric'=>77,'Alphanumeric'=>47,'Byte'=>32,'Kanji'=>20]);
		$this->data(3,ErrorCorrectCode::H,['Numeric'=>58,'Alphanumeric'=>35,'Byte'=>24,'Kanji'=>15]);
		$this->data(4,ErrorCorrectCode::L,['Numeric'=>187,'Alphanumeric'=>114,'Byte'=>78,'Kanji'=>48]);
		$this->data(4,ErrorCorrectCode::M,['Numeric'=>149,'Alphanumeric'=>90,'Byte'=>62,'Kanji'=>38]);
		$this->data(4,ErrorCorrectCode::Q,['Numeric'=>111,'Alphanumeric'=>67,'Byte'=>46,'Kanji'=>28]);
		$this->data(4,ErrorCorrectCode::H,['Numeric'=>82,'Alphanumeric'=>50,'Byte'=>34,'Kanji'=>21]);
		$this->data(5,ErrorCorrectCode::L,['Numeric'=>255,'Alphanumeric'=>154,'Byte'=>106,'Kanji'=>65]);
		$this->data(5,ErrorCorrectCode::M,['Numeric'=>202,'Alphanumeric'=>122,'Byte'=>84,'Kanji'=>52]);
		$this->data(5,ErrorCorrectCode::Q,['Numeric'=>144,'Alphanumeric'=>87,'Byte'=>60,'Kanji'=>37]);
		$this->data(5,ErrorCorrectCode::H,['Numeric'=>106,'Alphanumeric'=>64,'Byte'=>44,'Kanji'=>27]);
		$this->data(6,ErrorCorrectCode::L,['Numeric'=>322,'Alphanumeric'=>195,'Byte'=>134,'Kanji'=>82]);
		$this->data(6,ErrorCorrectCode::M,['Numeric'=>255,'Alphanumeric'=>154,'Byte'=>106,'Kanji'=>65]);
		$this->data(6,ErrorCorrectCode::Q,['Numeric'=>178,'Alphanumeric'=>108,'Byte'=>74,'Kanji'=>45]);
		$this->data(6,ErrorCorrectCode::H,['Numeric'=>139,'Alphanumeric'=>84,'Byte'=>58,'Kanji'=>36]);
		$this->data(7,ErrorCorrectCode::L,['Numeric'=>370,'Alphanumeric'=>224,'Byte'=>154,'Kanji'=>95]);
		$this->data(7,ErrorCorrectCode::M,['Numeric'=>293,'Alphanumeric'=>178,'Byte'=>122,'Kanji'=>75]);
		$this->data(7,ErrorCorrectCode::Q,['Numeric'=>207,'Alphanumeric'=>125,'Byte'=>86,'Kanji'=>53]);
		$this->data(7,ErrorCorrectCode::H,['Numeric'=>154,'Alphanumeric'=>93,'Byte'=>64,'Kanji'=>39]);
		$this->data(8,ErrorCorrectCode::L,['Numeric'=>461,'Alphanumeric'=>279,'Byte'=>192,'Kanji'=>118]);
		$this->data(8,ErrorCorrectCode::M,['Numeric'=>365,'Alphanumeric'=>221,'Byte'=>152,'Kanji'=>93]);
		$this->data(8,ErrorCorrectCode::Q,['Numeric'=>259,'Alphanumeric'=>157,'Byte'=>108,'Kanji'=>66]);
		$this->data(8,ErrorCorrectCode::H,['Numeric'=>202,'Alphanumeric'=>122,'Byte'=>84,'Kanji'=>52]);
		$this->data(9,ErrorCorrectCode::L,['Numeric'=>552,'Alphanumeric'=>335,'Byte'=>230,'Kanji'=>141]);
		$this->data(9,ErrorCorrectCode::M,['Numeric'=>432,'Alphanumeric'=>262,'Byte'=>180,'Kanji'=>111]);
		$this->data(9,ErrorCorrectCode::Q,['Numeric'=>312,'Alphanumeric'=>189,'Byte'=>130,'Kanji'=>80]);
		$this->data(9,ErrorCorrectCode::H,['Numeric'=>235,'Alphanumeric'=>143,'Byte'=>98,'Kanji'=>60]);
		$this->data(10,ErrorCorrectCode::L,['Numeric'=>652,'Alphanumeric'=>395,'Byte'=>271,'Kanji'=>167]);
		$this->data(10,ErrorCorrectCode::M,['Numeric'=>513,'Alphanumeric'=>311,'Byte'=>213,'Kanji'=>131]);
		$this->data(10,ErrorCorrectCode::Q,['Numeric'=>364,'Alphanumeric'=>221,'Byte'=>151,'Kanji'=>93]);
		$this->data(10,ErrorCorrectCode::H,['Numeric'=>288,'Alphanumeric'=>174,'Byte'=>119,'Kanji'=>74]);
		$this->data(11,ErrorCorrectCode::L,['Numeric'=>772,'Alphanumeric'=>468,'Byte'=>321,'Kanji'=>198]);
		$this->data(11,ErrorCorrectCode::M,['Numeric'=>604,'Alphanumeric'=>366,'Byte'=>251,'Kanji'=>155]);
		$this->data(11,ErrorCorrectCode::Q,['Numeric'=>427,'Alphanumeric'=>259,'Byte'=>177,'Kanji'=>109]);
		$this->data(11,ErrorCorrectCode::H,['Numeric'=>331,'Alphanumeric'=>200,'Byte'=>137,'Kanji'=>85]);
		$this->data(12,ErrorCorrectCode::L,['Numeric'=>883,'Alphanumeric'=>535,'Byte'=>367,'Kanji'=>226]);
		$this->data(12,ErrorCorrectCode::M,['Numeric'=>691,'Alphanumeric'=>419,'Byte'=>287,'Kanji'=>177]);
		$this->data(12,ErrorCorrectCode::Q,['Numeric'=>489,'Alphanumeric'=>296,'Byte'=>203,'Kanji'=>125]);
		$this->data(12,ErrorCorrectCode::H,['Numeric'=>374,'Alphanumeric'=>227,'Byte'=>155,'Kanji'=>96]);
		$this->data(13,ErrorCorrectCode::L,['Numeric'=>1022,'Alphanumeric'=>619,'Byte'=>425,'Kanji'=>262]);
		$this->data(13,ErrorCorrectCode::M,['Numeric'=>796,'Alphanumeric'=>483,'Byte'=>331,'Kanji'=>204]);
		$this->data(13,ErrorCorrectCode::Q,['Numeric'=>580,'Alphanumeric'=>352,'Byte'=>241,'Kanji'=>149]);
		$this->data(13,ErrorCorrectCode::H,['Numeric'=>427,'Alphanumeric'=>259,'Byte'=>177,'Kanji'=>109]);
		$this->data(14,ErrorCorrectCode::L,['Numeric'=>1101,'Alphanumeric'=>667,'Byte'=>458,'Kanji'=>282]);
		$this->data(14,ErrorCorrectCode::M,['Numeric'=>871,'Alphanumeric'=>528,'Byte'=>362,'Kanji'=>223]);
		$this->data(14,ErrorCorrectCode::Q,['Numeric'=>621,'Alphanumeric'=>376,'Byte'=>258,'Kanji'=>159]);
		$this->data(14,ErrorCorrectCode::H,['Numeric'=>468,'Alphanumeric'=>283,'Byte'=>194,'Kanji'=>120]);
		$this->data(15,ErrorCorrectCode::L,['Numeric'=>1250,'Alphanumeric'=>758,'Byte'=>520,'Kanji'=>320]);
		$this->data(15,ErrorCorrectCode::M,['Numeric'=>991,'Alphanumeric'=>600,'Byte'=>412,'Kanji'=>254]);
		$this->data(15,ErrorCorrectCode::Q,['Numeric'=>703,'Alphanumeric'=>426,'Byte'=>292,'Kanji'=>180]);
		$this->data(15,ErrorCorrectCode::H,['Numeric'=>530,'Alphanumeric'=>321,'Byte'=>220,'Kanji'=>136]);
		$this->data(16,ErrorCorrectCode::L,['Numeric'=>1408,'Alphanumeric'=>854,'Byte'=>586,'Kanji'=>361]);
		$this->data(16,ErrorCorrectCode::M,['Numeric'=>1082,'Alphanumeric'=>656,'Byte'=>450,'Kanji'=>277]);
		$this->data(16,ErrorCorrectCode::Q,['Numeric'=>775,'Alphanumeric'=>470,'Byte'=>322,'Kanji'=>198]);
		$this->data(16,ErrorCorrectCode::H,['Numeric'=>602,'Alphanumeric'=>365,'Byte'=>250,'Kanji'=>154]);
		$this->data(17,ErrorCorrectCode::L,['Numeric'=>1548,'Alphanumeric'=>938,'Byte'=>644,'Kanji'=>397]);
		$this->data(17,ErrorCorrectCode::M,['Numeric'=>1212,'Alphanumeric'=>734,'Byte'=>504,'Kanji'=>310]);
		$this->data(17,ErrorCorrectCode::Q,['Numeric'=>876,'Alphanumeric'=>531,'Byte'=>364,'Kanji'=>224]);
		$this->data(17,ErrorCorrectCode::H,['Numeric'=>674,'Alphanumeric'=>408,'Byte'=>280,'Kanji'=>173]);
		$this->data(18,ErrorCorrectCode::L,['Numeric'=>1725,'Alphanumeric'=>1046,'Byte'=>718,'Kanji'=>442]);
		$this->data(18,ErrorCorrectCode::M,['Numeric'=>1346,'Alphanumeric'=>816,'Byte'=>560,'Kanji'=>345]);
		$this->data(18,ErrorCorrectCode::Q,['Numeric'=>948,'Alphanumeric'=>574,'Byte'=>394,'Kanji'=>243]);
		$this->data(18,ErrorCorrectCode::H,['Numeric'=>746,'Alphanumeric'=>452,'Byte'=>310,'Kanji'=>191]);
		$this->data(19,ErrorCorrectCode::L,['Numeric'=>1903,'Alphanumeric'=>1153,'Byte'=>792,'Kanji'=>488]);
		$this->data(19,ErrorCorrectCode::M,['Numeric'=>1500,'Alphanumeric'=>909,'Byte'=>624,'Kanji'=>384]);
		$this->data(19,ErrorCorrectCode::Q,['Numeric'=>1063,'Alphanumeric'=>644,'Byte'=>442,'Kanji'=>272]);
		$this->data(19,ErrorCorrectCode::H,['Numeric'=>813,'Alphanumeric'=>493,'Byte'=>338,'Kanji'=>208]);
		$this->data(20,ErrorCorrectCode::L,['Numeric'=>2061,'Alphanumeric'=>1249,'Byte'=>858,'Kanji'=>528]);
		$this->data(20,ErrorCorrectCode::M,['Numeric'=>1600,'Alphanumeric'=>970,'Byte'=>666,'Kanji'=>410]);
		$this->data(20,ErrorCorrectCode::Q,['Numeric'=>1159,'Alphanumeric'=>702,'Byte'=>482,'Kanji'=>297]);
		$this->data(20,ErrorCorrectCode::H,['Numeric'=>919,'Alphanumeric'=>557,'Byte'=>382,'Kanji'=>235]);
		$this->data(21,ErrorCorrectCode::L,['Numeric'=>2232,'Alphanumeric'=>1352,'Byte'=>929,'Kanji'=>572]);
		$this->data(21,ErrorCorrectCode::M,['Numeric'=>1708,'Alphanumeric'=>1035,'Byte'=>711,'Kanji'=>438]);
		$this->data(21,ErrorCorrectCode::Q,['Numeric'=>1224,'Alphanumeric'=>742,'Byte'=>509,'Kanji'=>314]);
		$this->data(21,ErrorCorrectCode::H,['Numeric'=>969,'Alphanumeric'=>587,'Byte'=>403,'Kanji'=>248]);
		$this->data(22,ErrorCorrectCode::L,['Numeric'=>2409,'Alphanumeric'=>1460,'Byte'=>1003,'Kanji'=>618]);
		$this->data(22,ErrorCorrectCode::M,['Numeric'=>1872,'Alphanumeric'=>1134,'Byte'=>779,'Kanji'=>480]);
		$this->data(22,ErrorCorrectCode::Q,['Numeric'=>1358,'Alphanumeric'=>823,'Byte'=>565,'Kanji'=>348]);
		$this->data(22,ErrorCorrectCode::H,['Numeric'=>1056,'Alphanumeric'=>640,'Byte'=>439,'Kanji'=>270]);
		$this->data(23,ErrorCorrectCode::L,['Numeric'=>2620,'Alphanumeric'=>1588,'Byte'=>1091,'Kanji'=>672]);
		$this->data(23,ErrorCorrectCode::M,['Numeric'=>2059,'Alphanumeric'=>1248,'Byte'=>857,'Kanji'=>528]);
		$this->data(23,ErrorCorrectCode::Q,['Numeric'=>1468,'Alphanumeric'=>890,'Byte'=>611,'Kanji'=>376]);
		$this->data(23,ErrorCorrectCode::H,['Numeric'=>1108,'Alphanumeric'=>672,'Byte'=>461,'Kanji'=>284]);
		$this->data(24,ErrorCorrectCode::L,['Numeric'=>2812,'Alphanumeric'=>1704,'Byte'=>1171,'Kanji'=>721]);
		$this->data(24,ErrorCorrectCode::M,['Numeric'=>2188,'Alphanumeric'=>1326,'Byte'=>911,'Kanji'=>561]);
		$this->data(24,ErrorCorrectCode::Q,['Numeric'=>1588,'Alphanumeric'=>963,'Byte'=>661,'Kanji'=>407]);
		$this->data(24,ErrorCorrectCode::H,['Numeric'=>1228,'Alphanumeric'=>744,'Byte'=>511,'Kanji'=>315]);
		$this->data(25,ErrorCorrectCode::L,['Numeric'=>3057,'Alphanumeric'=>1853,'Byte'=>1273,'Kanji'=>784]);
		$this->data(25,ErrorCorrectCode::M,['Numeric'=>2395,'Alphanumeric'=>1451,'Byte'=>997,'Kanji'=>614]);
		$this->data(25,ErrorCorrectCode::Q,['Numeric'=>1718,'Alphanumeric'=>1041,'Byte'=>715,'Kanji'=>440]);
		$this->data(25,ErrorCorrectCode::H,['Numeric'=>1286,'Alphanumeric'=>779,'Byte'=>535,'Kanji'=>330]);
		$this->data(26,ErrorCorrectCode::L,['Numeric'=>3283,'Alphanumeric'=>1990,'Byte'=>1367,'Kanji'=>842]);
		$this->data(26,ErrorCorrectCode::M,['Numeric'=>2544,'Alphanumeric'=>1542,'Byte'=>1059,'Kanji'=>652]);
		$this->data(26,ErrorCorrectCode::Q,['Numeric'=>1804,'Alphanumeric'=>1094,'Byte'=>751,'Kanji'=>462]);
		$this->data(26,ErrorCorrectCode::H,['Numeric'=>1425,'Alphanumeric'=>864,'Byte'=>593,'Kanji'=>365]);
		$this->data(27,ErrorCorrectCode::L,['Numeric'=>3517,'Alphanumeric'=>2132,'Byte'=>1465,'Kanji'=>902]);
		$this->data(27,ErrorCorrectCode::M,['Numeric'=>2701,'Alphanumeric'=>1637,'Byte'=>1125,'Kanji'=>692]);
		$this->data(27,ErrorCorrectCode::Q,['Numeric'=>1933,'Alphanumeric'=>1172,'Byte'=>805,'Kanji'=>496]);
		$this->data(27,ErrorCorrectCode::H,['Numeric'=>1501,'Alphanumeric'=>910,'Byte'=>625,'Kanji'=>385]);
		$this->data(28,ErrorCorrectCode::L,['Numeric'=>3669,'Alphanumeric'=>2223,'Byte'=>1528,'Kanji'=>940]);
		$this->data(28,ErrorCorrectCode::M,['Numeric'=>2857,'Alphanumeric'=>1732,'Byte'=>1190,'Kanji'=>732]);
		$this->data(28,ErrorCorrectCode::Q,['Numeric'=>2085,'Alphanumeric'=>1263,'Byte'=>868,'Kanji'=>534]);
		$this->data(28,ErrorCorrectCode::H,['Numeric'=>1581,'Alphanumeric'=>958,'Byte'=>658,'Kanji'=>405]);
		$this->data(29,ErrorCorrectCode::L,['Numeric'=>3909,'Alphanumeric'=>2369,'Byte'=>1628,'Kanji'=>1002]);
		$this->data(29,ErrorCorrectCode::M,['Numeric'=>3035,'Alphanumeric'=>1839,'Byte'=>1264,'Kanji'=>778]);
		$this->data(29,ErrorCorrectCode::Q,['Numeric'=>2181,'Alphanumeric'=>1322,'Byte'=>908,'Kanji'=>559]);
		$this->data(29,ErrorCorrectCode::H,['Numeric'=>1677,'Alphanumeric'=>1016,'Byte'=>698,'Kanji'=>430]);
		$this->data(30,ErrorCorrectCode::L,['Numeric'=>4158,'Alphanumeric'=>2520,'Byte'=>1732,'Kanji'=>1066]);
		$this->data(30,ErrorCorrectCode::M,['Numeric'=>3289,'Alphanumeric'=>1994,'Byte'=>1370,'Kanji'=>843]);
		$this->data(30,ErrorCorrectCode::Q,['Numeric'=>2358,'Alphanumeric'=>1429,'Byte'=>982,'Kanji'=>604]);
		$this->data(30,ErrorCorrectCode::H,['Numeric'=>1782,'Alphanumeric'=>1080,'Byte'=>742,'Kanji'=>457]);
		$this->data(31,ErrorCorrectCode::L,['Numeric'=>4417,'Alphanumeric'=>2677,'Byte'=>1840,'Kanji'=>1132]);
		$this->data(31,ErrorCorrectCode::M,['Numeric'=>3486,'Alphanumeric'=>2113,'Byte'=>1452,'Kanji'=>894]);
		$this->data(31,ErrorCorrectCode::Q,['Numeric'=>2473,'Alphanumeric'=>1499,'Byte'=>1030,'Kanji'=>634]);
		$this->data(31,ErrorCorrectCode::H,['Numeric'=>1897,'Alphanumeric'=>1150,'Byte'=>790,'Kanji'=>486]);
		$this->data(32,ErrorCorrectCode::L,['Numeric'=>4686,'Alphanumeric'=>2840,'Byte'=>1952,'Kanji'=>1201]);
		$this->data(32,ErrorCorrectCode::M,['Numeric'=>3693,'Alphanumeric'=>2238,'Byte'=>1538,'Kanji'=>947]);
		$this->data(32,ErrorCorrectCode::Q,['Numeric'=>2670,'Alphanumeric'=>1618,'Byte'=>1112,'Kanji'=>684]);
		$this->data(32,ErrorCorrectCode::H,['Numeric'=>2022,'Alphanumeric'=>1226,'Byte'=>842,'Kanji'=>518]);
		$this->data(33,ErrorCorrectCode::L,['Numeric'=>4965,'Alphanumeric'=>3009,'Byte'=>2068,'Kanji'=>1273]);
		$this->data(33,ErrorCorrectCode::M,['Numeric'=>3909,'Alphanumeric'=>2369,'Byte'=>1628,'Kanji'=>1002]);
		$this->data(33,ErrorCorrectCode::Q,['Numeric'=>2805,'Alphanumeric'=>1700,'Byte'=>1168,'Kanji'=>719]);
		$this->data(33,ErrorCorrectCode::H,['Numeric'=>2157,'Alphanumeric'=>1307,'Byte'=>898,'Kanji'=>553]);
		$this->data(34,ErrorCorrectCode::L,['Numeric'=>5253,'Alphanumeric'=>3183,'Byte'=>2188,'Kanji'=>1347]);
		$this->data(34,ErrorCorrectCode::M,['Numeric'=>4134,'Alphanumeric'=>2506,'Byte'=>1722,'Kanji'=>1060]);
		$this->data(34,ErrorCorrectCode::Q,['Numeric'=>2949,'Alphanumeric'=>1787,'Byte'=>1228,'Kanji'=>756]);
		$this->data(34,ErrorCorrectCode::H,['Numeric'=>2301,'Alphanumeric'=>1394,'Byte'=>958,'Kanji'=>590]);
		$this->data(35,ErrorCorrectCode::L,['Numeric'=>5529,'Alphanumeric'=>3351,'Byte'=>2303,'Kanji'=>1417]);
		$this->data(35,ErrorCorrectCode::M,['Numeric'=>4343,'Alphanumeric'=>2632,'Byte'=>1809,'Kanji'=>1113]);
		$this->data(35,ErrorCorrectCode::Q,['Numeric'=>3081,'Alphanumeric'=>1867,'Byte'=>1283,'Kanji'=>790]);
		$this->data(35,ErrorCorrectCode::H,['Numeric'=>2361,'Alphanumeric'=>1431,'Byte'=>983,'Kanji'=>605]);
		$this->data(36,ErrorCorrectCode::L,['Numeric'=>5836,'Alphanumeric'=>3537,'Byte'=>2431,'Kanji'=>1496]);
		$this->data(36,ErrorCorrectCode::M,['Numeric'=>4588,'Alphanumeric'=>2780,'Byte'=>1911,'Kanji'=>1176]);
		$this->data(36,ErrorCorrectCode::Q,['Numeric'=>3244,'Alphanumeric'=>1966,'Byte'=>1351,'Kanji'=>832]);
		$this->data(36,ErrorCorrectCode::H,['Numeric'=>2524,'Alphanumeric'=>1530,'Byte'=>1051,'Kanji'=>647]);
		$this->data(37,ErrorCorrectCode::L,['Numeric'=>6153,'Alphanumeric'=>3729,'Byte'=>2563,'Kanji'=>1577]);
		$this->data(37,ErrorCorrectCode::M,['Numeric'=>4775,'Alphanumeric'=>2894,'Byte'=>1989,'Kanji'=>1224]);
		$this->data(37,ErrorCorrectCode::Q,['Numeric'=>3417,'Alphanumeric'=>2071,'Byte'=>1423,'Kanji'=>876]);
		$this->data(37,ErrorCorrectCode::H,['Numeric'=>2625,'Alphanumeric'=>1591,'Byte'=>1093,'Kanji'=>673]);
		$this->data(38,ErrorCorrectCode::L,['Numeric'=>6479,'Alphanumeric'=>3927,'Byte'=>2699,'Kanji'=>1661]);
		$this->data(38,ErrorCorrectCode::M,['Numeric'=>5039,'Alphanumeric'=>3054,'Byte'=>2099,'Kanji'=>1292]);
		$this->data(38,ErrorCorrectCode::Q,['Numeric'=>3599,'Alphanumeric'=>2181,'Byte'=>1499,'Kanji'=>923]);
		$this->data(38,ErrorCorrectCode::H,['Numeric'=>2735,'Alphanumeric'=>1658,'Byte'=>1139,'Kanji'=>701]);
		$this->data(39,ErrorCorrectCode::L,['Numeric'=>6743,'Alphanumeric'=>4087,'Byte'=>2809,'Kanji'=>1729]);
		$this->data(39,ErrorCorrectCode::M,['Numeric'=>5313,'Alphanumeric'=>3220,'Byte'=>2213,'Kanji'=>1362]);
		$this->data(39,ErrorCorrectCode::Q,['Numeric'=>3791,'Alphanumeric'=>2298,'Byte'=>1579,'Kanji'=>972]);
		$this->data(39,ErrorCorrectCode::H,['Numeric'=>2927,'Alphanumeric'=>1774,'Byte'=>1219,'Kanji'=>750]);
		$this->data(40,ErrorCorrectCode::L,['Numeric'=>7089,'Alphanumeric'=>4296,'Byte'=>2953,'Kanji'=>1817]);
		$this->data(40,ErrorCorrectCode::M,['Numeric'=>5596,'Alphanumeric'=>3391,'Byte'=>2331,'Kanji'=>1435]);
		$this->data(40,ErrorCorrectCode::Q,['Numeric'=>3993,'Alphanumeric'=>2420,'Byte'=>1663,'Kanji'=>1024]);
		$this->data(40,ErrorCorrectCode::H,['Numeric'=>3057,'Alphanumeric'=>1852,'Byte'=>1273,'Kanji'=>784]);
	}
	private function data($version,$errorCorrectCode,$data)
	{
		$this->DataCapacity[$version][$errorCorrectCode] = $data;
	}
	
	public function getVersion($length,$errorCorrectCode,$type = 'Numeric')
	{
		foreach($this->DataCapacity as $key => $value)
		{
			if(!isset($value[$errorCorrectCode][$type]))
			{
				continue;
			}
			if($value[$errorCorrectCode][$type] - $length >= 0)
			{
				return $key;
			}
		}
		return 0;
	}
}
