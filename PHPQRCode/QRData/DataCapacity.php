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
		$this->data(1,ErrorCorrectCode::L,['Number'=>41,'Letter'=>25,'Bit'=>17,'Japanese'=>10]);
		$this->data(1,ErrorCorrectCode::M,['Number'=>34,'Letter'=>20,'Bit'=>14,'Japanese'=>8]);
		$this->data(1,ErrorCorrectCode::Q,['Number'=>27,'Letter'=>16,'Bit'=>11,'Japanese'=>7]);
		$this->data(1,ErrorCorrectCode::H,['Number'=>17,'Letter'=>10,'Bit'=>7,'Japanese'=>4]);
		$this->data(2,ErrorCorrectCode::L,['Number'=>77,'Letter'=>47,'Bit'=>32,'Japanese'=>20]);
		$this->data(2,ErrorCorrectCode::M,['Number'=>63,'Letter'=>38,'Bit'=>26,'Japanese'=>16]);
		$this->data(2,ErrorCorrectCode::Q,['Number'=>48,'Letter'=>29,'Bit'=>20,'Japanese'=>12]);
		$this->data(2,ErrorCorrectCode::H,['Number'=>34,'Letter'=>20,'Bit'=>14,'Japanese'=>8]);
		$this->data(3,ErrorCorrectCode::L,['Number'=>127,'Letter'=>77,'Bit'=>53,'Japanese'=>32]);
		$this->data(3,ErrorCorrectCode::M,['Number'=>101,'Letter'=>61,'Bit'=>42,'Japanese'=>26]);
		$this->data(3,ErrorCorrectCode::Q,['Number'=>77,'Letter'=>47,'Bit'=>32,'Japanese'=>20]);
		$this->data(3,ErrorCorrectCode::H,['Number'=>58,'Letter'=>35,'Bit'=>24,'Japanese'=>15]);
		$this->data(4,ErrorCorrectCode::L,['Number'=>187,'Letter'=>114,'Bit'=>78,'Japanese'=>48]);
		$this->data(4,ErrorCorrectCode::M,['Number'=>149,'Letter'=>90,'Bit'=>62,'Japanese'=>38]);
		$this->data(4,ErrorCorrectCode::Q,['Number'=>111,'Letter'=>67,'Bit'=>46,'Japanese'=>28]);
		$this->data(4,ErrorCorrectCode::H,['Number'=>82,'Letter'=>50,'Bit'=>34,'Japanese'=>21]);
		$this->data(5,ErrorCorrectCode::L,['Number'=>255,'Letter'=>154,'Bit'=>106,'Japanese'=>65]);
		$this->data(5,ErrorCorrectCode::M,['Number'=>202,'Letter'=>122,'Bit'=>84,'Japanese'=>52]);
		$this->data(5,ErrorCorrectCode::Q,['Number'=>144,'Letter'=>87,'Bit'=>60,'Japanese'=>37]);
		$this->data(5,ErrorCorrectCode::H,['Number'=>106,'Letter'=>64,'Bit'=>44,'Japanese'=>27]);
		$this->data(6,ErrorCorrectCode::L,['Number'=>322,'Letter'=>195,'Bit'=>134,'Japanese'=>82]);
		$this->data(6,ErrorCorrectCode::M,['Number'=>255,'Letter'=>154,'Bit'=>106,'Japanese'=>65]);
		$this->data(6,ErrorCorrectCode::Q,['Number'=>178,'Letter'=>108,'Bit'=>74,'Japanese'=>45]);
		$this->data(6,ErrorCorrectCode::H,['Number'=>139,'Letter'=>84,'Bit'=>58,'Japanese'=>36]);
		$this->data(7,ErrorCorrectCode::L,['Number'=>370,'Letter'=>224,'Bit'=>154,'Japanese'=>95]);
		$this->data(7,ErrorCorrectCode::M,['Number'=>293,'Letter'=>178,'Bit'=>122,'Japanese'=>75]);
		$this->data(7,ErrorCorrectCode::Q,['Number'=>207,'Letter'=>125,'Bit'=>86,'Japanese'=>53]);
		$this->data(7,ErrorCorrectCode::H,['Number'=>154,'Letter'=>93,'Bit'=>64,'Japanese'=>39]);
		$this->data(8,ErrorCorrectCode::L,['Number'=>461,'Letter'=>279,'Bit'=>192,'Japanese'=>118]);
		$this->data(8,ErrorCorrectCode::M,['Number'=>365,'Letter'=>221,'Bit'=>152,'Japanese'=>93]);
		$this->data(8,ErrorCorrectCode::Q,['Number'=>259,'Letter'=>157,'Bit'=>108,'Japanese'=>66]);
		$this->data(8,ErrorCorrectCode::H,['Number'=>202,'Letter'=>122,'Bit'=>84,'Japanese'=>52]);
		$this->data(9,ErrorCorrectCode::L,['Number'=>552,'Letter'=>335,'Bit'=>230,'Japanese'=>141]);
		$this->data(9,ErrorCorrectCode::M,['Number'=>432,'Letter'=>262,'Bit'=>180,'Japanese'=>111]);
		$this->data(9,ErrorCorrectCode::Q,['Number'=>312,'Letter'=>189,'Bit'=>130,'Japanese'=>80]);
		$this->data(9,ErrorCorrectCode::H,['Number'=>235,'Letter'=>143,'Bit'=>98,'Japanese'=>60]);
		$this->data(10,ErrorCorrectCode::L,['Number'=>652,'Letter'=>395,'Bit'=>271,'Japanese'=>167]);
		$this->data(10,ErrorCorrectCode::M,['Number'=>513,'Letter'=>311,'Bit'=>213,'Japanese'=>131]);
		$this->data(10,ErrorCorrectCode::Q,['Number'=>364,'Letter'=>221,'Bit'=>151,'Japanese'=>93]);
		$this->data(10,ErrorCorrectCode::H,['Number'=>288,'Letter'=>174,'Bit'=>119,'Japanese'=>74]);
		$this->data(11,ErrorCorrectCode::L,['Number'=>772,'Letter'=>468,'Bit'=>321,'Japanese'=>198]);
		$this->data(11,ErrorCorrectCode::M,['Number'=>604,'Letter'=>366,'Bit'=>251,'Japanese'=>155]);
		$this->data(11,ErrorCorrectCode::Q,['Number'=>427,'Letter'=>259,'Bit'=>177,'Japanese'=>109]);
		$this->data(11,ErrorCorrectCode::H,['Number'=>331,'Letter'=>200,'Bit'=>137,'Japanese'=>85]);
		$this->data(12,ErrorCorrectCode::L,['Number'=>883,'Letter'=>535,'Bit'=>367,'Japanese'=>226]);
		$this->data(12,ErrorCorrectCode::M,['Number'=>691,'Letter'=>419,'Bit'=>287,'Japanese'=>177]);
		$this->data(12,ErrorCorrectCode::Q,['Number'=>489,'Letter'=>296,'Bit'=>203,'Japanese'=>125]);
		$this->data(12,ErrorCorrectCode::H,['Number'=>374,'Letter'=>227,'Bit'=>155,'Japanese'=>96]);
		$this->data(13,ErrorCorrectCode::L,['Number'=>1022,'Letter'=>619,'Bit'=>425,'Japanese'=>262]);
		$this->data(13,ErrorCorrectCode::M,['Number'=>796,'Letter'=>483,'Bit'=>331,'Japanese'=>204]);
		$this->data(13,ErrorCorrectCode::Q,['Number'=>580,'Letter'=>352,'Bit'=>241,'Japanese'=>149]);
		$this->data(13,ErrorCorrectCode::H,['Number'=>427,'Letter'=>259,'Bit'=>177,'Japanese'=>109]);
		$this->data(14,ErrorCorrectCode::L,['Number'=>1101,'Letter'=>667,'Bit'=>458,'Japanese'=>282]);
		$this->data(14,ErrorCorrectCode::M,['Number'=>871,'Letter'=>528,'Bit'=>362,'Japanese'=>223]);
		$this->data(14,ErrorCorrectCode::Q,['Number'=>621,'Letter'=>376,'Bit'=>258,'Japanese'=>159]);
		$this->data(14,ErrorCorrectCode::H,['Number'=>468,'Letter'=>283,'Bit'=>194,'Japanese'=>120]);
		$this->data(15,ErrorCorrectCode::L,['Number'=>1250,'Letter'=>758,'Bit'=>520,'Japanese'=>320]);
		$this->data(15,ErrorCorrectCode::M,['Number'=>991,'Letter'=>600,'Bit'=>412,'Japanese'=>254]);
		$this->data(15,ErrorCorrectCode::Q,['Number'=>703,'Letter'=>426,'Bit'=>292,'Japanese'=>180]);
		$this->data(15,ErrorCorrectCode::H,['Number'=>530,'Letter'=>321,'Bit'=>220,'Japanese'=>136]);
		$this->data(16,ErrorCorrectCode::L,['Number'=>1408,'Letter'=>854,'Bit'=>586,'Japanese'=>361]);
		$this->data(16,ErrorCorrectCode::M,['Number'=>1082,'Letter'=>656,'Bit'=>450,'Japanese'=>277]);
		$this->data(16,ErrorCorrectCode::Q,['Number'=>775,'Letter'=>470,'Bit'=>322,'Japanese'=>198]);
		$this->data(16,ErrorCorrectCode::H,['Number'=>602,'Letter'=>365,'Bit'=>250,'Japanese'=>154]);
		$this->data(17,ErrorCorrectCode::L,['Number'=>1548,'Letter'=>938,'Bit'=>644,'Japanese'=>397]);
		$this->data(17,ErrorCorrectCode::M,['Number'=>1212,'Letter'=>734,'Bit'=>504,'Japanese'=>310]);
		$this->data(17,ErrorCorrectCode::Q,['Number'=>876,'Letter'=>531,'Bit'=>364,'Japanese'=>224]);
		$this->data(17,ErrorCorrectCode::H,['Number'=>674,'Letter'=>408,'Bit'=>280,'Japanese'=>173]);
		$this->data(18,ErrorCorrectCode::L,['Number'=>1725,'Letter'=>1046,'Bit'=>718,'Japanese'=>442]);
		$this->data(18,ErrorCorrectCode::M,['Number'=>1346,'Letter'=>816,'Bit'=>560,'Japanese'=>345]);
		$this->data(18,ErrorCorrectCode::Q,['Number'=>948,'Letter'=>574,'Bit'=>394,'Japanese'=>243]);
		$this->data(18,ErrorCorrectCode::H,['Number'=>746,'Letter'=>452,'Bit'=>310,'Japanese'=>191]);
		$this->data(19,ErrorCorrectCode::L,['Number'=>1903,'Letter'=>1153,'Bit'=>792,'Japanese'=>488]);
		$this->data(19,ErrorCorrectCode::M,['Number'=>1500,'Letter'=>909,'Bit'=>624,'Japanese'=>384]);
		$this->data(19,ErrorCorrectCode::Q,['Number'=>1063,'Letter'=>644,'Bit'=>442,'Japanese'=>272]);
		$this->data(19,ErrorCorrectCode::H,['Number'=>813,'Letter'=>493,'Bit'=>338,'Japanese'=>208]);
		$this->data(20,ErrorCorrectCode::L,['Number'=>2061,'Letter'=>1249,'Bit'=>858,'Japanese'=>528]);
		$this->data(20,ErrorCorrectCode::M,['Number'=>1600,'Letter'=>970,'Bit'=>666,'Japanese'=>410]);
		$this->data(20,ErrorCorrectCode::Q,['Number'=>1159,'Letter'=>702,'Bit'=>482,'Japanese'=>297]);
		$this->data(20,ErrorCorrectCode::H,['Number'=>919,'Letter'=>557,'Bit'=>382,'Japanese'=>235]);
		$this->data(21,ErrorCorrectCode::L,['Number'=>2232,'Letter'=>1352,'Bit'=>929,'Japanese'=>572]);
		$this->data(21,ErrorCorrectCode::M,['Number'=>1708,'Letter'=>1035,'Bit'=>711,'Japanese'=>438]);
		$this->data(21,ErrorCorrectCode::Q,['Number'=>1224,'Letter'=>742,'Bit'=>509,'Japanese'=>314]);
		$this->data(21,ErrorCorrectCode::H,['Number'=>969,'Letter'=>587,'Bit'=>403,'Japanese'=>248]);
		$this->data(22,ErrorCorrectCode::L,['Number'=>2409,'Letter'=>1460,'Bit'=>1003,'Japanese'=>618]);
		$this->data(22,ErrorCorrectCode::M,['Number'=>1872,'Letter'=>1134,'Bit'=>779,'Japanese'=>480]);
		$this->data(22,ErrorCorrectCode::Q,['Number'=>1358,'Letter'=>823,'Bit'=>565,'Japanese'=>348]);
		$this->data(22,ErrorCorrectCode::H,['Number'=>1056,'Letter'=>640,'Bit'=>439,'Japanese'=>270]);
		$this->data(23,ErrorCorrectCode::L,['Number'=>2620,'Letter'=>1588,'Bit'=>1091,'Japanese'=>672]);
		$this->data(23,ErrorCorrectCode::M,['Number'=>2059,'Letter'=>1248,'Bit'=>857,'Japanese'=>528]);
		$this->data(23,ErrorCorrectCode::Q,['Number'=>1468,'Letter'=>890,'Bit'=>611,'Japanese'=>376]);
		$this->data(23,ErrorCorrectCode::H,['Number'=>1108,'Letter'=>672,'Bit'=>461,'Japanese'=>284]);
		$this->data(24,ErrorCorrectCode::L,['Number'=>2812,'Letter'=>1704,'Bit'=>1171,'Japanese'=>721]);
		$this->data(24,ErrorCorrectCode::M,['Number'=>2188,'Letter'=>1326,'Bit'=>911,'Japanese'=>561]);
		$this->data(24,ErrorCorrectCode::Q,['Number'=>1588,'Letter'=>963,'Bit'=>661,'Japanese'=>407]);
		$this->data(24,ErrorCorrectCode::H,['Number'=>1228,'Letter'=>744,'Bit'=>511,'Japanese'=>315]);
		$this->data(25,ErrorCorrectCode::L,['Number'=>3057,'Letter'=>1853,'Bit'=>1273,'Japanese'=>784]);
		$this->data(25,ErrorCorrectCode::M,['Number'=>2395,'Letter'=>1451,'Bit'=>997,'Japanese'=>614]);
		$this->data(25,ErrorCorrectCode::Q,['Number'=>1718,'Letter'=>1041,'Bit'=>715,'Japanese'=>440]);
		$this->data(25,ErrorCorrectCode::H,['Number'=>1286,'Letter'=>779,'Bit'=>535,'Japanese'=>330]);
		$this->data(26,ErrorCorrectCode::L,['Number'=>3283,'Letter'=>1990,'Bit'=>1367,'Japanese'=>842]);
		$this->data(26,ErrorCorrectCode::M,['Number'=>2544,'Letter'=>1542,'Bit'=>1059,'Japanese'=>652]);
		$this->data(26,ErrorCorrectCode::Q,['Number'=>1804,'Letter'=>1094,'Bit'=>751,'Japanese'=>462]);
		$this->data(26,ErrorCorrectCode::H,['Number'=>1425,'Letter'=>864,'Bit'=>593,'Japanese'=>365]);
		$this->data(27,ErrorCorrectCode::L,['Number'=>3517,'Letter'=>2132,'Bit'=>1465,'Japanese'=>902]);
		$this->data(27,ErrorCorrectCode::M,['Number'=>2701,'Letter'=>1637,'Bit'=>1125,'Japanese'=>692]);
		$this->data(27,ErrorCorrectCode::Q,['Number'=>1933,'Letter'=>1172,'Bit'=>805,'Japanese'=>496]);
		$this->data(27,ErrorCorrectCode::H,['Number'=>1501,'Letter'=>910,'Bit'=>625,'Japanese'=>385]);
		$this->data(28,ErrorCorrectCode::L,['Number'=>3669,'Letter'=>2223,'Bit'=>1528,'Japanese'=>940]);
		$this->data(28,ErrorCorrectCode::M,['Number'=>2857,'Letter'=>1732,'Bit'=>1190,'Japanese'=>732]);
		$this->data(28,ErrorCorrectCode::Q,['Number'=>2085,'Letter'=>1263,'Bit'=>868,'Japanese'=>534]);
		$this->data(28,ErrorCorrectCode::H,['Number'=>1581,'Letter'=>958,'Bit'=>658,'Japanese'=>405]);
		$this->data(29,ErrorCorrectCode::L,['Number'=>3909,'Letter'=>2369,'Bit'=>1628,'Japanese'=>1002]);
		$this->data(29,ErrorCorrectCode::M,['Number'=>3035,'Letter'=>1839,'Bit'=>1264,'Japanese'=>778]);
		$this->data(29,ErrorCorrectCode::Q,['Number'=>2181,'Letter'=>1322,'Bit'=>908,'Japanese'=>559]);
		$this->data(29,ErrorCorrectCode::H,['Number'=>1677,'Letter'=>1016,'Bit'=>698,'Japanese'=>430]);
		$this->data(30,ErrorCorrectCode::L,['Number'=>4158,'Letter'=>2520,'Bit'=>1732,'Japanese'=>1066]);
		$this->data(30,ErrorCorrectCode::M,['Number'=>3289,'Letter'=>1994,'Bit'=>1370,'Japanese'=>843]);
		$this->data(30,ErrorCorrectCode::Q,['Number'=>2358,'Letter'=>1429,'Bit'=>982,'Japanese'=>604]);
		$this->data(30,ErrorCorrectCode::H,['Number'=>1782,'Letter'=>1080,'Bit'=>742,'Japanese'=>457]);
		$this->data(31,ErrorCorrectCode::L,['Number'=>4417,'Letter'=>2677,'Bit'=>1840,'Japanese'=>1132]);
		$this->data(31,ErrorCorrectCode::M,['Number'=>3486,'Letter'=>2113,'Bit'=>1452,'Japanese'=>894]);
		$this->data(31,ErrorCorrectCode::Q,['Number'=>2473,'Letter'=>1499,'Bit'=>1030,'Japanese'=>634]);
		$this->data(31,ErrorCorrectCode::H,['Number'=>1897,'Letter'=>1150,'Bit'=>790,'Japanese'=>486]);
		$this->data(32,ErrorCorrectCode::L,['Number'=>4686,'Letter'=>2840,'Bit'=>1952,'Japanese'=>1201]);
		$this->data(32,ErrorCorrectCode::M,['Number'=>3693,'Letter'=>2238,'Bit'=>1538,'Japanese'=>947]);
		$this->data(32,ErrorCorrectCode::Q,['Number'=>2670,'Letter'=>1618,'Bit'=>1112,'Japanese'=>684]);
		$this->data(32,ErrorCorrectCode::H,['Number'=>2022,'Letter'=>1226,'Bit'=>842,'Japanese'=>518]);
		$this->data(33,ErrorCorrectCode::L,['Number'=>4965,'Letter'=>3009,'Bit'=>2068,'Japanese'=>1273]);
		$this->data(33,ErrorCorrectCode::M,['Number'=>3909,'Letter'=>2369,'Bit'=>1628,'Japanese'=>1002]);
		$this->data(33,ErrorCorrectCode::Q,['Number'=>2805,'Letter'=>1700,'Bit'=>1168,'Japanese'=>719]);
		$this->data(33,ErrorCorrectCode::H,['Number'=>2157,'Letter'=>1307,'Bit'=>898,'Japanese'=>553]);
		$this->data(34,ErrorCorrectCode::L,['Number'=>5253,'Letter'=>3183,'Bit'=>2188,'Japanese'=>1347]);
		$this->data(34,ErrorCorrectCode::M,['Number'=>4134,'Letter'=>2506,'Bit'=>1722,'Japanese'=>1060]);
		$this->data(34,ErrorCorrectCode::Q,['Number'=>2949,'Letter'=>1787,'Bit'=>1228,'Japanese'=>756]);
		$this->data(34,ErrorCorrectCode::H,['Number'=>2301,'Letter'=>1394,'Bit'=>958,'Japanese'=>590]);
		$this->data(35,ErrorCorrectCode::L,['Number'=>5529,'Letter'=>3351,'Bit'=>2303,'Japanese'=>1417]);
		$this->data(35,ErrorCorrectCode::M,['Number'=>4343,'Letter'=>2632,'Bit'=>1809,'Japanese'=>1113]);
		$this->data(35,ErrorCorrectCode::Q,['Number'=>3081,'Letter'=>1867,'Bit'=>1283,'Japanese'=>790]);
		$this->data(35,ErrorCorrectCode::H,['Number'=>2361,'Letter'=>1431,'Bit'=>983,'Japanese'=>605]);
		$this->data(36,ErrorCorrectCode::L,['Number'=>5836,'Letter'=>3537,'Bit'=>2431,'Japanese'=>1496]);
		$this->data(36,ErrorCorrectCode::M,['Number'=>4588,'Letter'=>2780,'Bit'=>1911,'Japanese'=>1176]);
		$this->data(36,ErrorCorrectCode::Q,['Number'=>3244,'Letter'=>1966,'Bit'=>1351,'Japanese'=>832]);
		$this->data(36,ErrorCorrectCode::H,['Number'=>2524,'Letter'=>1530,'Bit'=>1051,'Japanese'=>647]);
		$this->data(37,ErrorCorrectCode::L,['Number'=>6153,'Letter'=>3729,'Bit'=>2563,'Japanese'=>1577]);
		$this->data(37,ErrorCorrectCode::M,['Number'=>4775,'Letter'=>2894,'Bit'=>1989,'Japanese'=>1224]);
		$this->data(37,ErrorCorrectCode::Q,['Number'=>3417,'Letter'=>2071,'Bit'=>1423,'Japanese'=>876]);
		$this->data(37,ErrorCorrectCode::H,['Number'=>2625,'Letter'=>1591,'Bit'=>1093,'Japanese'=>673]);
		$this->data(38,ErrorCorrectCode::L,['Number'=>6479,'Letter'=>3927,'Bit'=>2699,'Japanese'=>1661]);
		$this->data(38,ErrorCorrectCode::M,['Number'=>5039,'Letter'=>3054,'Bit'=>2099,'Japanese'=>1292]);
		$this->data(38,ErrorCorrectCode::Q,['Number'=>3599,'Letter'=>2181,'Bit'=>1499,'Japanese'=>923]);
		$this->data(38,ErrorCorrectCode::H,['Number'=>2735,'Letter'=>1658,'Bit'=>1139,'Japanese'=>701]);
		$this->data(39,ErrorCorrectCode::L,['Number'=>6743,'Letter'=>4087,'Bit'=>2809,'Japanese'=>1729]);
		$this->data(39,ErrorCorrectCode::M,['Number'=>5313,'Letter'=>3220,'Bit'=>2213,'Japanese'=>1362]);
		$this->data(39,ErrorCorrectCode::Q,['Number'=>3791,'Letter'=>2298,'Bit'=>1579,'Japanese'=>972]);
		$this->data(39,ErrorCorrectCode::H,['Number'=>2927,'Letter'=>1774,'Bit'=>1219,'Japanese'=>750]);
		$this->data(40,ErrorCorrectCode::L,['Number'=>7089,'Letter'=>4296,'Bit'=>2953,'Japanese'=>1817]);
		$this->data(40,ErrorCorrectCode::M,['Number'=>5596,'Letter'=>3391,'Bit'=>2331,'Japanese'=>1435]);
		$this->data(40,ErrorCorrectCode::Q,['Number'=>3993,'Letter'=>2420,'Bit'=>1663,'Japanese'=>1024]);
		$this->data(40,ErrorCorrectCode::H,['Number'=>3057,'Letter'=>1852,'Bit'=>1273,'Japanese'=>784]);
	}
	private function data($version,$errorCorrectCode,$data)
	{
		$this->DataCapacity[$version][$errorCorrectCode] = $data;
	}
	
	public function getVersion($length,$errorCorrectCode,$type = 'Number')
	{
		$type == 'Mix' and $type = 'Letter';
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
