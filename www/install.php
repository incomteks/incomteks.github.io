<?php
extract($_GET);
extract($_POST);
echo "А сюда лезть не надо!";

include("connect.php");

//mysql_query("ALTER TABLE `mes` ADD `typ` TINYINT DEFAULT '0' NOT NULL");
//mysql_query("ALTER TABLE `wduser` ADD `newmes` TINYINT DEFAULT '0' NOT NULL");
//mysql_query("UPDATE `wduser` SET `login`='*Emperor*' WHERE `n`=1");
//mysql_query("CREATE TABLE `ban_ip` (`n` mediumint(8) NOT NULL auto_increment,`ip` varchar(16), `warn` tinyint(4) NOT NULL default '0', PRIMARY KEY  (`n`)) TYPE=MyISAM");
//mysql_query("DELETE FROM `al` WHERE `name`='ИМПЕРИЯ' or `name`='fhesu5' or `name`='agb' or `name`='Darkness'  or `name`='LOTOS'");
//mysql_query("DELETE FROM `al` WHERE `name`='НАМ_ПОХУЮ_НА_IP'");
//mysql_query("UPDATE `wduser` SET `al`=' WHERE `al`='НАМ_ПОХУЮ_НА_IP'");
//mysql_query("UPDATE `wduser` SET `typ`='2' WHERE `login`='dark_avenger' OR `login`='*Emperor*'");
//mysql_query("CREATE TABLE `banlist` (`n` mediumint(8) NOT NULL auto_increment, `ip` varchar(16), `name` varchar(20), `desc` varchar(100), PRIMARY KEY(`n`)) TYPE=MyISAM");
//mysql_query("ALTER TABLE `mes` ADD `delmark` TINYINT DEFAULT '0' NOT NULL");
//mysql_query("ALTER TABLE `banlist` ADD `banday` INT(10) NOT NULL");
//mysql_query("UPDATE `base` SET `palace`='10' WHERE `up`='1'");
//mysql_query("ALTER TABLE `wduser` DROP `newmes`");
//mysql_query("ALTER TABLE `mes` ADD `new` TINYINT NOT NULL");
//mysql_query("ALTER TABLE `wduser` ADD `actcode` MEDIUMINT DEFAULT '0' NOT NULL");
//mysql_query("UPDATE `wduser` SET `actcode`='0'");
//mysql_query("DELETE FROM `base` WHERE `up`<4971");
//mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) VALUES (NULL , '1', 'Cydonia', '50', '50', '0', '5000000', '100000', '100', '50', '30', '15', '15', '50', '25', '5', '15', '15', '10', '10', '5', '100', '0', '0', '0', '0', '0', '10000', '100', '0', '100', '5')");
//mysql_query("CREATE TABLE `tasks` (`n` MEDIUMINT NOT NULL AUTO_INCREMENT ,`name` VARCHAR( 50 ) NOT NULL ,`parnum1` MEDIUMINT NOT NULL ,`parnum2` MEDIUMINT NOT NULL ,`parnum3` MEDIUMINT NOT NULL ,`parchar1` VARCHAR( 100 ) NOT NULL ,`parchar2` VARCHAR( 100 ) NOT NULL ,`parchar3` VARCHAR( 100 ) NOT NULL ,PRIMARY KEY ( `n` )) TYPE=MyISAM");
//mysql_query("ALTER TABLE `wduser` ADD `notactiv` MEDIUMINT DEFAULT '0' NOT NULL");
//mysql_query("ALTER TABLE `army` ADD `rang` FLOAT DEFAULT '0' NOT NULL");
//mysql_query("DELETE FROM `base` WHERE `x`=50 and `y`=50 and `up`!=1");
/*
  $res=mysql_query("SELECT `x`,`y` FROM `base`");
  while($resarr=mysql_fetch_array($res)){
  	$x=$resarr['x'];
  	$y=$resarr['y'];
  	$res2=mysql_query("SELECT * FROM `base` WHERE `x`='$x' and `y`='$y' ORDER BY `n`");
  	echo "<br>Проверка базы $x:$y...";
  	$first=0;
  	if(intval(@mysql_num_rows($res2))>1) {
  		echo "<br>Найдена база двойник в координатах $x:$y";
  		while($resarr2=mysql_fetch_array($res2)){
  			if($first!=0){
  			$xnew=rand(1,100);
  			$ynew=rand(1,100);
  			$n=$resarr2['n'];
  			while($stop!=1){
  				$res3=mysql_query("SELECT `n` FROM `base` WHERE `x`='$xnew' and `y`='$ynew'");
  				if(intval(@mysql_num_rows($res3))==0) $stop=1;
  			}
  			mysql_query("UPDATE `base` SET `x`='$xnew',`y`='$ynew' WHERE `n`='$n'");
  			echo "<br>Новые координаты базы $n установлены на $xnew:$ynew";
  		} else $first=1;
  	}
  	}
  */
  //mysql_query("CREATE TABLE `ignor` (`n` MEDIUMINT NOT NULL AUTO_INCREMENT ,`up` MEDIUMINT NOT NULL ,`ignor` MEDIUMINT NOT NULL ,PRIMARY KEY ( `n` )) TYPE = MYISAM");
  //mysql_query("DELETE FROM `base` WHERE `name`='*GOLD PALACE*'");
  //mysql_query("UPDATE `base` SET `spec3`='500' WHERE `name`='*GOLD PALACE*'");
  
  //mysql_query("CREATE TABLE `fame` (`n` MEDIUMINT NOT NULL AUTO_INCREMENT ,`name` VARCHAR( 50 ) NOT NULL ,`medal` MEDIUMINT NOT NULL ,`about` VARCHAR( 200 ) NOT NULL, `col` MEDIUMINT NOT NULL ,PRIMARY KEY ( `n` )) TYPE = MYISAM");
  //mysql_query("CREATE TABLE `medales` (`n` MEDIUMINT NOT NULL AUTO_INCREMENT ,`name` VARCHAR( 50 ) NOT NULL ,`path` VARCHAR( 200 ) NOT NULL,`about` VARCHAR( 200 ) NOT NULL ,PRIMARY KEY ( `n` )) TYPE = MYISAM");
  //mysql_query("INSERT INTO `medales` VALUES (1, 'Ветеран', 'm1.gif', 'Дается только вместе с другими медалями за участие в других раундах игры.')");
  //mysql_query("INSERT INTO `medales` VALUES (2, 'За стойкость', 'm10.gif', 'За участие в off-line мероприятиях')");
  //mysql_query("INSERT INTO `medales` VALUES (3, 'Приз зрительских симпатий', 'm9.gif', 'Присуждается по просьбе других игроков, за личный вклад в игровой процесс')");
  //mysql_query("INSERT INTO `medales` VALUES (4, 'Медаль за отвагу', 'm2.gif', 'Присуждается за особые боевые заслуги и выполнение квестовых заданий')");
  //mysql_query("INSERT INTO `medales` VALUES (5, 'Золотое солнце', 'm3.gif', 'За успехи в торговле, финансовую поддержку соратников')");
  //mysql_query("INSERT INTO `medales` VALUES (6, 'Друг императора', 'm4.gif', 'За помощь в работе над игрой, обнаружение багов и тестирование')");
  //mysql_query("INSERT INTO `medales` VALUES (7, 'Командир', 'm5.gif', 'За участие в развитии игры, помощь молодым игрокам и привлечение новых')");
  //mysql_query("INSERT INTO `medales` VALUES (8, 'Герой дюны', 'm6.gif', 'За уникальные игровые подвиги')");
  //mysql_query("INSERT INTO `medales` VALUES (9, 'Розовый орден', 'm11.gif', 'За сомнительные достижения')");
  //mysql_query("INSERT INTO `medales` VALUES (10, 'Золотая звезда', 'm8.gif', 'Наивысшая награда за боевые заслуги')");
  //mysql_query("INSERT INTO `medales` VALUES (11, 'Мастер', 'm7.gif', 'За победу в игре')");
  //mysql_query("CREATE TABLE `chat` (  `n` mediumint(9) NOT NULL auto_increment,  `from` varchar(25) NOT NULL default ',  `to` varchar(25) NOT NULL default '',  `msg` varchar(200) NOT NULL default '',  `time` varchar(10) NOT NULL default '',  `color` varchar(10) NOT NULL default '#000000',  PRIMARY KEY  (`n`)) TYPE=MyISAM");
  //$res=mysql_query("SELECT * FROM `wduser`");
  //while($r=mysql_fetch_array($res)){
  //  $al=$r['al'];
  //  if($al!="") {
  //  $res2=mysql_query("SELECT * FROM `al` WHERE `name`='$al'");
  //    if(@mysql_num_rows($res2)==0) 
  //      mysql_query("UPDATE `wduser` SET `al`='' WHERE `al`='$al'");
  //  }
  //}
  //$res=mysql_query("SELECT * FROM `wduser`");
  //while($r=mysql_fetch_array($res)){
  //	$n=$r['n'];
  //	$res2=mysql_query("SELECT * FROM `tech` WHERE `up`='$n'");
  //	if(@mysql_num_rows($res2)==0)
  //	  mysql_query("INSERT INTO `tech` (`n`,`up`,`att`,`arm`,`engine`,`build`,`harv`) VALUES ('','$n','0','0','0','0','0')");
  //}
  //$res=mysql_query("SELECT * FROM `base`");
  //while($r=mysql_fetch_array($res)){
  //	$up=$r['up'];
  //  $res2=mysql_query("SELECT * FROM `wduser` WHERE `n`='$up'");
  //  if(@mysql_num_rows($res2)==0)
//		  mysql_query("DELETE FROM `base` WHERE `up`='$up'");
//  }
  //$d=mysql_query("SELECT * FROM `day` LIMIT 1");
  //$day=mysql_result($d,0,'n');
  //$res=mysql_query("SELECT * FROM `wduser`");
  //while($r=mysql_fetch_array($res)){
//  	$reg=$r['reg'];
  //	$n=$r['n'];
//  	if(($day-$reg)<0) mysql_query("UPDATE `wduser` SET `reg`='1' WHERE `n`='$n'");
  //}
  
  //mysql_query("UPDATE `wduser` SET `spice`='0' where n!=1 and n!=6");
  //mysql_query("ALTER TABLE `wduser` ADD `maxmess` MEDIUMINT DEFAULT '10' NOT NULL");
  //mysql_query("DELETE FROM `banlist` WHERE `ip`='83.167.100.16'");
  //mysql_query("ALTER TABLE `base` ADD `addon1` MEDIUMINT NOT NULL");
  //mysql_query("UPDATE `base` SET `linf`='200' WHERE `up`='5662'");
  //mysql_query("UPDATE `base` SET `x`='75',`y`='100' WHERE `name`='Cydonia'");
  //$res=mysql_query("SELECT * FROM `base` WHERE `name`='*Заброшенная база*'");
	//if(intval(@mysql_num_rows($res))==0){
	
//  mysql_query("ALTER TABLE `army` ADD `targ` MEDIUMINT DEFAULT '0' NOT NULL");
/*for($ii=1;$ii<=10;$ii++)
{

$res=mysql_query("select * from `day` limit 1");
$game_day=mysql_result($res,0,'n');

$x=rand(1,150);
$y=rand(1,150);

$res=mysql_query("select count(*) from base where `x`='$x' and `y`='$y'");
$res2=mysql_query("select count(*) from army where `x`='$x' and `y`='$y'");

$rn[1]="Воины песков";
$rn[2]="Защитники Дюны";
$rn[3]="Песчанники";
$rn[4]="Разведка фрименов";
$rn[5]="Посланники Муаддиба";
$rn[6]="Песчаный шторм";
$rn[7]="Патруль фрименов";
$rn[8]="Огненные демоны";
$rn[9]="Песчаный дозор";

$rnm=$rn[rand(1,9)]." [уровень ".ceil($game_day/100)."]";

$coef=rand(2,6);

$rcr=round($game_day*10)*10*$coef/4;
$rst=round($game_day*10)*$coef/4;
$rwl=round($game_day/500)*$coef/4;
$rtw=round($game_day/750)*$coef/4;
$rtn=round($game_day/100)*$coef/4;
$rfr=round($game_day/50)*$coef/4;
$rlf=round($game_day/6)*$coef/4;
$rhf=round($game_day/12)*$coef/4;
$rdv=round($game_day/1000)*$coef/4;

if (mysql_result($res2,0,'count(*)')==0) if (mysql_result($res,0,'count(*)')==0) if (5==5)
{

mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` ) 
VALUES ('', '6', '$rnm', '$x', '$y', '0', '$rcr', '$rst', '10', '$rwl', '$rtw', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1', '0', '$rlf', '$rhf', '$rtn', '0', '0', '$rdv', '$rfr')");

echo "Создана база фрименов $rnm в квадрате $x:$y \n<br>";

}
else
{
$resbf=mysql_query("select * from `base` where `up`='6'");
$i=rand(0,mysql_num_rows($resbf)-1);

$x=mysql_result($resbf,$i,'x');
$y=mysql_result($resbf,$i,'y');

mysql_query("INSERT INTO `army` ( `n` , `up` , `name` , `x` , `y` , `wins` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` ) 
VALUES ('', '6', '$rnm', '$x', '$y', '0', '0', '$rlf', '$rhf', '$rtn', '0', '0', '$rdv', '$rfr')");

echo "Армия фрименов $rnm создана в квадрате $x:$y \n<br>";

}
}
*/
/*$res=mysql_query("SELECT * FROM `fame`");
while($r=mysql_fetch_array($res)){
	$name=$r['name'];
	$res2=mysql_query("SELECT * FROM `fame` WHERE `name`='$name' and `medal`!=9");
	$col1=@mysql_num_rows($res2);
	$res2=mysql_query("SELECT * FROM `fame` WHERE `name`='$name' and `medal`=9");
	$col2=@mysql_num_rows($res2);
	$col=$col1-$col2;
	mysql_query("UPDATE fame SET `col`='$col' WHERE `name`='$name'");
}*/
//  mysql_query("ALTER TABLE `army` ADD `harv` MEDIUMINT NOT NULL");
//$res=mysql_query("SELECT * FROM `wduser`");
//while($r=mysql_fetch_array($res)){
//  $n=$r['n'];
//  $res2=mysql_query("SELECT * FROM `tech` WHERE `up`='$n'");
//  if(@mysql_num_rows($res2)==0) mysql_query("INSERT INTO `tech` (`n`,`up`,`att`,`arm`,`engine`,`build`,`harv`) VALUES ('','$n','0','0','0','0','0')");
//}
//mysql_query("ALTER TABLE `banlist` CHANGE `banday` `banday` VARCHAR( 10 ) DEFAULT '0' NOT NULL");
//mysql_query("ALTER TABLE `wduser` ADD `color` MEDIUMINT DEFAULT '0' NOT NULL");
//mysql_query("ALTER TABLE `day` ADD `round` MEDIUMINT DEFAULT '0' NOT NULL");
//mysql_query("UPDATE `day` SET `round`='22'");
//$sql = "ALTER TABLE `base` ADD `prplace` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prwall` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prtower` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prrtower` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prconstr` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prwind` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prrefin` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prsilo` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prbar` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prfact` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prtech` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prcosmo` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prpalace` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prharv` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prmobconst` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prlinf` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prhinf` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prtank` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prrtank` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prhod` MEDIUMINT DEFAULT '0' NOT NULL, ADD `prtrade` MEDIUMINT DEFAULT '0' NOT NULL";
//mysql_query($sql);
//mysql_query("ALTER TABLE `bild` ADD `buff` MEDIUMINT DEFAULT '0' NOT NULL");
//mysql_query("ALTER TABLE `army` ADD `round` MEDIUMINT DEFAULT '0' NOT NULL"); 
//  mysql_query("ALTER TABLE `wduser` ADD `sendmail` MEDIUMINT DEFAULT '0' NOT NULL");
//  mysql_query("UPDATE wduser SET `sendmail`='1' WHERE `n`!=1 AND `n`!=6");
//  $resU=mysql_query("SELECT * FROM `wduser`");
//  while($r=mysql_fetch_array($resU)){
  //	$up=$r['n'];
  	//$delta=$r['act']-$r['reg'];
//  	$resT=mysql_query("SELECT * FROM `tech` WHERE `up`='$up'");
//  	$sumT=mysql_result($resT,0,'att')+mysql_result($resT,0,'arm')+mysql_result($resT,0,'engine')+mysql_result($resT,0,'build')+mysql_result($resT,0,'harv')+mysql_result($resT,0,'hod')+mysql_result($resT,0,'orb')+mysql_result($resT,0,'spy');
//  	$resA=mysql_query("SELECT * FROM `army` WHERE `up`='$up'");
//		if(@mysql_num_rows($resA)>0) $sumT=$sumT+1;
//		if($sumT>0) {
//			if($delta<1000) {
//				$reg=$r['reg']-1000;
//				mysql_query("UPDATE `wduser` SET `reg`='$reg' WHERE `n`='$up'");
//			}
//		}
//  }
//  $pas=crypt('12345',CRYPT_MD5);
//  mysql_query("UPDATE `wduser` SET `password`='$pas' WHERE `n`='5662'");
//	$sql="CREATE TABLE `tradeorder` (  `n` mediumint(9) NOT NULL auto_increment,  `up` mediumint(9) NOT NULL default '0',  `item` mediumint(9) NOT NULL default '0',  `col` mediumint(9) NOT NULL default '0',  `base` mediumint(9) NOT NULL default '0',  `days` mediumint(9) NOT NULL default '0', PRIMARY KEY  (`n`)) Type=MyISAM";
//	$sql2="CREATE TABLE `tradeyard` (  `n` mediumint(9) NOT NULL auto_increment,  `up` mediumint(9) NOT NULL default '0',  `base` mediumint(9) NOT NULL default '0',  `stone` mediumint(9) NOT NULL default '0',  `linf` mediumint(9) NOT NULL default '0',  `hinf` mediumint(9) NOT NULL default '0',  `tank` mediumint(9) NOT NULL default '0',  `rtank` mediumint(9) NOT NULL default '0',  `hod` mediumint(9) NOT NULL default '0',  `harv` mediumint(9) NOT NULL default '0',  `mobconst` mediumint(9) NOT NULL default '0',  `stone_price` mediumint(9) NOT NULL default '0',  `linf_price` mediumint(9) NOT NULL default '0',  `hinf_price` mediumint(9) NOT NULL default '0',  `tank_price` mediumint(9) NOT NULL default '0',  `rtank_price` mediumint(9) NOT NULL default '0',  `mobconst_price` mediumint(9) NOT NULL default '0',  `hod_price` mediumint(9) NOT NULL default '0',  `harv_price` mediumint(9) NOT NULL default '0',  `dd` mediumint(9) NOT NULL default '0',  PRIMARY KEY  (`n`)) TYPE=MyISAM";
//  mysql_query($sql);
//  mysql_query($sql2);
//$res=mysql_query("SELECT * FROM `wduser` WHERE `login`='MaxStoun'");
//if(@mysql_num_rows($res)>0){
//	while($r=mysql_fetch_array($res)){
//		echo "<br>".$r['n']."   ".$r['login'];
//	}
//}
//mysql_query("ALTER TABLE `wduser` ADD `showmap` MEDIUMINT NOT NULL");
//mysql_query("UPDATE `wduser` SET `showmap`='1' WHERE `n`!=1 AND `n`!=6");
//Генерация карточек
/*  echo "Золотые - 1 месяц<br>";
    for($i=0;$i<50;$i++){
       $part1=rand(0,8999)+1000;
       $part2=rand(0,8999)+1000;
       $part3=rand(0,8999)+1000;
       $cardno=$part1."-".$part2."-".$part3;
       echo $cardno." - ";
       $cardno=md5($cardno);
       echo $cardno."<br>";
       mysql_query("INSERT INTO `cards` ( `id`,`cardno`,`cardtype`,`owner`,`limit` ) VALUES ('','$cardno','1','1','30')");
    }
  echo "Золотые - 2 месяца<br>";
    for($i=0;$i<50;$i++){
       $part1=rand(0,8999)+1000;
       $part2=rand(0,8999)+1000;
       $part3=rand(0,8999)+1000;
       $cardno=$part1."-".$part2."-".$part3;
       echo $cardno." - ";
       $cardno=md5($cardno);
       echo $cardno."<br>";
       mysql_query("INSERT INTO `cards` ( `id`,`cardno`,`cardtype`,`owner`,`limit` ) VALUES ('','$cardno','1','1','60')");
    }
  echo "Платина - 1 месяц<br>";
    for($i=0;$i<50;$i++){
       $part1=rand(0,8999)+1000;
       $part2=rand(0,8999)+1000;
       $part3=rand(0,8999)+1000;
       $cardno=$part1."-".$part2."-".$part3;
       echo $cardno." - ";
       $cardno=md5($cardno);
       echo $cardno."<br>";
       mysql_query("INSERT INTO `cards` ( `id`,`cardno`,`cardtype`,`owner`,`limit` ) VALUES ('','$cardno','2','1','30')");
    }
  echo "Платина - 2 месяца<br>";
    for($i=0;$i<50;$i++){
       $part1=rand(0,8999)+1000;
       $part2=rand(0,8999)+1000;
       $part3=rand(0,8999)+1000;
       $cardno=$part1."-".$part2."-".$part3;
       echo $cardno." - ";
       $cardno=md5($cardno);
       echo $cardno."<br>";
       mysql_query("INSERT INTO `cards` ( `id`,`cardno`,`cardtype`,`owner`,`limit` ) VALUES ('','$cardno','2','1','60')");
    }
  
$resb=mysql_query("SELECT * FROM `base`");
while($r=mysql_fetch_array($resb)) {
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','1','".$r['place']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','2','".$r['constr']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','3','".$r['wind']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','4','".$r['refin']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','5','".$r['silo']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','6','".$r['bar']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','7','".$r['fact']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','8','".$r['tech']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','9','".$r['cosmo']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','10','".$r['trade']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','11','".$r['palace']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','12','".$r['wall']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','13','".$r['tower']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','14','".$r['rtower']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','15','".$r['harv']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','16','".$r['mobconst']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','17','".$r['linf']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','18','".$r['hinf']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','19','".$r['tank']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','20','".$r['rtank']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','21','".$r['spec1']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','22','".$r['spec2']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','23','".$r['spec3']."')");
  mysql_query("INSERT INTO `objects` (`base`,`obj`,`col`) VALUES ('".$r['n']."','24','".$r['hod']."')");
}
mysql_query("UPDATE `base` SET `place`='50'");*/
mysql_query("UPDATE `tech` SET `build`='1'");
echo mysql_error();

?>