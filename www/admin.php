<?
extract($_POST);
extract($_GET);

include "header.php";

if (isset($wd_usertyp) && ($wd_usertyp>=2))
{

//###########################################    СУПЕР АДМИНЫ    ###########################################//
define('_ADM_',true);
if(isset($dosql)){
	mysql_query($sql);
	echo mysql_error();
}
if (isset($view) && ($view=="user")) {
  if (isset($mode) && ($mode=="Инфо")){
  	echo "<table><tr><td colspan=2>";
  	$plr=intval($plr);
  	//Информация о игроке
  	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`='$plr'");
  	$login=mysql_result($res,0,'login');
  	$pass=mysql_result($res,0,'password');
  	$email=mysql_result($res,0,'email');
  	$typ=mysql_result($res,0,'typ');
  	$delta=@mysql_result($res,0,'act')-@mysql_result($res,0,'reg');
    if ($delta<1000) $deft=1000-$delta; else $deft="Защита снята";
  	$home=mysql_result($res,0,'home');
  	$notactiv=mysql_result($res,0,'notactiv');
  	$actcode=mysql_result($res,0,'actcode');
  	if($actcode==0) $actcode="Активирован";
  	if ($home==1) $home="Атрейдес"; else if ($home==2) $home="Ордос";else if ($home==3) $home="Харконнен";
  	$al=mysql_result($res,0,'al');if ($al=="") $al="---";
  	$ip=mysql_result($res,0,'ip');
  	echo "<b>Личная информация</b></td></tr>
  	<tr><td>Логин</td><td>$login</td></tr>
  	<tr><td>Пароль</td><td>$pass</td></tr>
  	<tr><td>Email</td><td>$email</td></tr>
  	<tr><td>Статус админа</td><td>$typ</td></tr>
  	<tr><td>Дом</td><td>$home</td></tr>
  	<tr><td>Альянс</td><td>$al</td></tr>
  	<tr><td>IP</td><td>$ip</td></tr>
  	<tr><td>Неактивен</td><td>$notactiv</td></tr>
  	<tr><td>Код активации</td><td>$actcode</td></tr>
  	<tr><td>Защита мол. игрока</td><td>$deft</td></tr>
  	<tr><td colspan=2>&nbsp;</td></tr>
  	<tr><td colspan=2><b>Базы</td></tr>";
  	//Базы
  	$res=mysql_query("SELECT * FROM `base` WHERE `up`='$plr'");
  	$max=mysql_num_rows($res);
  	if ($max>0) {
  	echo "<tr><td colspan=2><table border=1><tr><th>Назв.</th><th>Коорд.</th><th>Кред.</th><th>Гр-т</th><th>С</th><th>Б</th><th>РБ</th><th>КЦ</th><th>ВЭ</th><th>ЗПС</th><th>СС</th><th>КЗ</th><th>ФТТ</th><th>НЦ</th><th>КС</th><th>ДЦ</th><th>Х</th><th>МКЦ</th><th>ЛП</th><th>ТП</th><th>Т</th><th>РТ</th><th>РРС</th><th>ТГ</th></tr>";
  	for($i=0;$i<$max;$i++) {
  		$aname=mysql_result($res,$i,'name');
  	  $ax=mysql_result($res,$i,'x');
  	  $ay=mysql_result($res,$i,'y');
  	  $acred=mysql_result($res,$i,'cred');
  	  $astone=mysql_result($res,$i,'stone');
  	  $awall=mysql_result($res,$i,'wall');
  	  $atower=mysql_result($res,$i,'tower');
  	  $artower=mysql_result($res,$i,'rtower');
  	  $aconstr=mysql_result($res,$i,'constr');
  	  $awind=mysql_result($res,$i,'wind');
  	  $arefin=mysql_result($res,$i,'refin');
  	  $asilo=mysql_result($res,$i,'silo');
  	  $abar=mysql_result($res,$i,'bar');
  	  $afact=mysql_result($res,$i,'fact');
  	  $atech=mysql_result($res,$i,'tech');
  	  $acosmo=mysql_result($res,$i,'cosmo');
  	  $apalace=mysql_result($res,$i,'palace');
  	  $aharv=mysql_result($res,$i,'harv');
  	  $amobconst=mysql_result($res,$i,'mobconst');
  	  $alinf=mysql_result($res,$i,'linf');
  	  $ahinf=mysql_result($res,$i,'hinf');
  	  $atank=mysql_result($res,$i,'tank');
  	  $artank=mysql_result($res,$i,'rtank');
  	  $ahod=mysql_result($res,$i,'hod');
  	  $atrade=mysql_result($res,$i,'trade');
  	  echo "<tr><td>$aname</td><td>$ax:$ay</td><td>$acred</td><td>$astone</td><td>$awall</td><td>$atower</td>
  	  <td>$artower</td><td>$aconstr</td><td>$awind</td><td>$arefin</td><td>$asilo</td><td>$abar</td><td>$afact</td>
  	  <td>$atech</td><td>$acosmo</td><td>$apalace</td><td>$aharv</td><td>$amobconst</td><td>$alinf</td><td>$ahinf</td>
  	  <td>$atank</td><td>$artank</td><td>$ahod</td><td>$atrade</td></tr>";
  	}
  	echo "</table></td></tr>";
    }
  	echo"<tr><td colspan=2>&nbsp;</td></tr>
  	<tr><td colspan=2><b>Армии</td></tr>";
  	//Армии
  	$res=mysql_query("SELECT * FROM `army` WHERE `up`='$plr'");
  	$max=mysql_num_rows($res);
  	if ($max>0) {
  	echo "<tr><td colspan=2><table border=1><tr><th>Название</th><th>Координаты</th><th>Ранг</th><th>Состав</th></tr>";
  	for($i=0;$i<$max;$i++) {
  		$aname=mysql_result($res,$i,'name');
  	  $ax=mysql_result($res,$i,'x');
  	  $ay=mysql_result($res,$i,'y');
  	  $awins=mysql_result($res,$i,'wins');
  	  $amob=mysql_result($res,$i,'mobconst');
  	  $alinf=mysql_result($res,$i,'linf');
  	  $ahinf=mysql_result($res,$i,'hinf');
  	  $atank=mysql_result($res,$i,'tank');
  	  $artank=mysql_result($res,$i,'rtank');
  	  $aspec1=mysql_result($res,$i,'spec1');
  	  $aspec2=mysql_result($res,$i,'spec2');
  	  $aspec3=mysql_result($res,$i,'spec3');
  	  echo "<tr><td>$aname</td><td>$ax:$ay</td><td>$awins</td><td>$alinf лп-$ahinf тп-$atank т-$artank рт-$amob мкц</td></tr>";
  	}
  	echo "</table></td></tr>";
    }
  	echo "</table>";
  }
  if (isset($mode) && ($mode=="Бан")){
  	$plr=intval($plr);
  	$msg=htmlspecialchars($msg,ENT_NOQUOTES);
  	$dd=intval($dd);
  	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`='$plr'");
  	$resarr=mysql_fetch_array($res);
  	$ip=$resarr['ip'];
  	$res1=mysql_query("SELECT * FROM `wduser` WHERE `ip`='$ip'");
  	while($resarr1=mysql_fetch_array($res1)) {
  	  $login=$resarr1['login'];
  	  $banday=date("d.m.Y");
  	  mysql_query("INSERT INTO `banlist` (`n`,`ip`,`name`,`desc`,`days`,`banday`) VALUES ('','$ip','$login','$msg','$dd','$banday')");
    	echo mysql_error();
    	echo "Игрок $login успешно забанен за $msg на $dd реальных дней<br>";
    }
  }
  if (isset($mode) && ($mode=="Снять бан")){
  	$plr=intval($plr);
  	$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  	$log=mysql_result($res,0,'login');
    $res2=mysql_query("SELECT `ip` FROM `banlist` WHERE `name`='$log'");
  	$ip=mysql_result($res2,0,'ip');
  	mysql_query("DELETE FROM `banlist` WHERE `name`='$log' or `ip`='$ip'");
  	echo "С игрока $log успешно снят бан";
  }
  if (isset($mode) && ($mode=="Удалить")){
  	$plr=intval($plr);
  	$res=mysql_query("SELECT login FROM `wduser` where `n`='$plr'");
  	$login=mysql_result($res,0,'login');
  	if (!isset($contr)) {
  		echo "Подтверждаете удаление игрока $login?<br>";
  		echo "<form method=post><input type=hidden name=contr value=1><input type=hidden name=mode value=\"Удалить\"><input type=hidden name=plr value=$plr><input type=hidden name=view value=user><input type=submit value=\"Потверждаю!\"></form>";
  	} else {
  	  mysql_query("DELETE FROM `wduser` WHERE `n`='$plr'");
  	  mysql_query("DELETE FROM `base` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `army` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `space` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `hod` WHERE `up`='$plr'");
  	  $res=mysql_query("SELECT name FROM `al` where `up`='$plr'");
  	  if (mysql_num_rows($res)>0) {
    		$alname=mysql_result($res,0,'name');
  	    mysql_query("DELETE FROM `al` WHERE `up`='$plr'");
  	    mysql_query("UPDATE `wduser` SET `al`='' WHERE `al`='$alname'");
  	  }
  	  mysql_query("DELETE FROM `bild` WHERE `user`='$plr'");
  	  mysql_query("DELETE FROM `move` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `res` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `trade` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `tech` WHERE `up`='$plr'");
  	  echo "Игрок $login успешно удален из базы данных.";
  	}
  }
  if (isset($mode) && ($mode=="Изменить")){
  	$plr=intval($plr);
  	$res=mysql_query("SELECT * FROM `wduser` where `n`='$plr'");
  	$login=mysql_result($res,0,'login');
  	if (!isset($contr)) {
  		$pass=mysql_result($res,0,'password');
  	  $email=mysql_result($res,0,'email');
  	  $typ=mysql_result($res,0,'typ');
  	  $home=mysql_result($res,0,'home');
  	  $al=mysql_result($res,0,'al');
  	  $status=mysql_result($res,0,'status');
  	  $actcode=mysql_result($res,0,'actcode');
  	  if($actcode==0) $actcode="<input type=hidden name=actcode value=0>Активирован"; else $actcode="<input type=text name=actcode value=$actcode>";
  		echo "Измнение личных данных игрока $login<br>";
  		echo "<form method=post><input type=hidden name=contr value=1><input type=hidden name=mode value=\"Изменить\"><input type=hidden name=plr value=$plr><input type=hidden name=view value=user>
  		<table><tr><td>Логин:</td><td><input type=text name=log value=\"$login\"><td></tr>
  		<tr><td>Пароль</td><td><input type=text name=pass value=\"$pass\"></td></tr>
		<tr><td>Новый пароль</td><td><input type=text name=newpass value=\"\"></td></tr>
  		<tr><td>Email</td><td><input type=text name=email value=\"$email\"></td></tr>
  		<tr><td>Статус админа</td><td><input type=text name=typ value=\"$typ\"></td></tr>
  		<tr><td>Дом</td><td><input type=text name=home value=\"$home\"></td></tr>
  		<tr><td>Альянс</td><td><input type=text name=al value=\"$al\"></td></tr>
  		<tr><td>Игровой статус</td><td><input type=text name=status value=\"$status\"></td></tr>
  		<tr><td>Код активации</td><td>$actcode</td></tr>
  		</table><input type=submit value=\"Сохранить\"></form>";
  	} else {
	  if((isset($newpass)) & ($newpass!='')) $pass=md5($newpass);
  	  mysql_query("UPDATE `wduser` SET `login`='$log', `password`='$pass', `email`='$email', `typ`='$typ', `home`='$home', `al`='$al', `status`='$status', `actcode`='$actcode' WHERE `n`='$plr'");
  	  echo "Данные игрока $login успешно изменены";
  	}
  }
}
if (isset($view) && ($view=="al")) {
	$al=intval($al);
  if (isset($mode) && ($mode=="Удалить")){
  	$res=mysql_query("SELECT * FROM `al` WHERE `n`='$al'");
  	$alname=mysql_result($res,0,'name');
    if (!isset($contr)) {
    	echo "Вы пытаетесь уничтожить альянс $alname, подтвердите уничтожение";
    	echo "<form method=post>
    	<input type=hidden name=al value=\"$al\">
    	<input type=hidden name=view value=\"al\"><br>
			<input type=hidden name=mode value=\"Удалить\">
			<br><input type=submit name=contr value=\"Подтверждаю\">
			</form>";
    }
    else {
    	mysql_query("DELETE FROM `al` WHERE `n`='$al'");
    	mysql_query("UPDATE `wduser` SET `al`='' WHERE `al`='$alname'");
    	echo "Альянс $alname успешно удален.";
    }
  }
  if (isset($mode) && ($mode=="Изменить")){
  	$res=mysql_query("SELECT * FROM `al` WHERE `n`='$al'");
  	$alname=mysql_result($res,0,'name');
  	$up=mysql_result($res,0,'up');
    if (!isset($act)) {
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$up'");
  		$upname=mysql_result($res,0,'login');
  		$res=mysql_query("SELECT `n`,`login` FROM `wduser` WHERE `al`='$alname' order by `login` desc");
  		$max=mysql_num_rows($res);
  		echo "Альянс $alname, лидер альянса $upname<br>";
  		echo "Члены альянса<form method=post><select name=\"plr\">";
  		for($ii=0;$ii<$max;$ii++) {
  			$log=mysql_result($res,$ii,'login');
  			$n=mysql_result($res,$ii,'n');
  			echo "<option value=$n>$log";
  			if ($n==$up) echo " (ЛИДЕР)";
  			echo "</option>";
  		}
  		echo "</select><input type=hidden name=mode value=\"Изменить\"><input type=hidden name=al value=\"$al\"><input type=hidden name=view value=al><input type=submit name=act value=\"Сделать лидером\"><input type=submit name=act value=\"Исключить из альянса\"></form>";
  		echo "<br><form method=post><input type=hidden name=mode value=\"Изменить\"><input type=hidden name=al value=\"$al\"><input type=hidden name=view value=al><input type=text name=aln value=\"$alname\"><input type=submit name=act value=\"Сохранить\"></form>";
  	} else if($act=="Сделать лидером") {
  		  $plr=intval($plr);
  		  mysql_query("UPDATE `al` SET `up`='$plr' WHERE `n`='$al'");
  		  echo "Лидер альянса изменен!";
  	} else if($act=="Исключить из альянса") {
  		  $plr=intval($plr);
  		  if ($plr!=$up) {
  		  $res=mysql_query("SELECT login FROM `wduser` WHERE `n`='$plr'");
  		  $log=mysql_result($res,0,'login');
  		  mysql_query("UPDATE `wduser` SET `al`='' WHERE `n`='$plr'");
  		  echo "Игрок $log исключен из альянса $alname!";
  		} else echo "Вы не можете исключить лидера альянса!";
  	} else if($act=="Сохранить") {
  		  $aln=filter($aln,"name");
  		  mysql_query("UPDATE `wduser` SET `al`='$aln' WHERE `al`='$alname'");
  		  mysql_query("UPDATE `al` SET `name`='$aln' WHERE `name`='$alname'");
  		  echo "Альянс $alname теперь известен как $aln!";
  	}
  }
}
if (isset($view) && ($view=="news")) {
  if (isset($mode) && ($mode=="Опубликовать")){
    if (isset($index)){
    	 include("avnews.php");
    	//$file=fopen("/home/www/avnews.php","w+");
    	$txt=ereg_replace("\"","&quote;",$txt);
    	$news="<tr><td colspan=3><b>".date("d.m.Y")."</b> - ".$txt."</td></tr><tr><td colspan=3 align=right><i>".$wd_username."</i><hr></td></tr>\n".$news;
    	$file=fopen("avnews.php","w+");
    	fwrite($file,"<?php\n \$news=\"".$news."\";\n?".">");
   	fclose($file);
	mysql_query("INSERT INTO `news` (`date`,`author`,`title`,`text`,`showed`) VALUES ('".date("d.m.Y")."','$wd_username','$title','$txt','1')");
    }
    if (isset($privmes)){
    	$txt=ereg_replace("\"","&quote;",$txt);
    	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`!='$wd_usern'");
    	$max=intval(@mysql_num_rows($res));
      for($ii=0;$ii<$max;$ii++){
      	inform($wd_usern,mysql_result($res,$ii,'n'),$txt);
      }
    }
    if (isset($index) || isset($privmes)) echo "Ваша новость успешно опубликована"; else echo "Вы не указали, куда опубликовать новость";
  }
}
if (isset($view) && ($view=="restart")) {
  if (isset($mode) && ($mode=="Рестарт")){
    if (isset($yes)){
    	$dt=htmlspecialchars($dt,ENT_NOQUOTES);
    	echo "Рестарт будет выполнен: $dt";
    	mysql_query("INSERT INTO `tasks` (`n`,`name`,`parnum1`,`parnum2`,`parnum3`,`parchar1`,`parchar2`,`parchar3`) VALUES ('','restart','','','','$dt','','')");
		  mysql_query("UPDATE `day` SET `round`='$rnd'");
		  //Рассылаем игрокам информацию о рестарте
			$resu=mysql_query("SELECT * FROM `wduser`");
			while($resarr=mysql_fetch_array($resu)){
				if($resarr['sendmail']==1) {
					$login=$resarr['login'];
					$message="Здраствуйте игрок $login,\n\n Мы рады Вам сообщить, что в Дюне $dt будет выполнен рестарт,\n";
					$message.="в следствии чего предлагаем Вам сыграть новый раунд.\n Вас ждут интерестные изменения в игре.\n\n";
					$message.="--\nС уважением Администрация игры Online DUNE2";
					$subject = "Скоро рестарт в Дюне!";
					$from = "av_soft@localhost";
					$mailheaders = "Content-Type: text/plain; charset=\"1251\"\n";
					$mailheaders .= "From: dune-2.ru <av_soft@localhost>\n";
					if(!mail($resarr['email'], $subject, $message, $mailheaders)) echo "<br>Ошибка отправки почты!";
				}
			}
    	echo mysql_error();
    } else {
    	$dt=htmlspecialchars($dt,ENT_NOQUOTES);
    	echo "Вы действительно хотите сделать рестарт?<br><form method=post>
    	<input type=hidden name=view value=\"restart\">
    	<input type=hidden name=mode value=\"Рестарт\">
    	<input type=hidden name=dt value=\"$dt\">
		<input type=hidden name=rnd value=\"$rnd\">
    	<input type=submit name=yes value=\"ДА\">
    	</form>";
    }
  }
}
if (isset($view) && ($view=="mults")) {
  if (isset($mode) && ($mode=="Найти")){
    $res=mysql_query("SELECT DISTINCT ip FROM `wduser`");
    echo "<table border=1 width=100%>";
    while($resarr=mysql_fetch_array($res)){
    	$ip=$resarr['ip'];
      $res1=mysql_query("SELECT * FROM `wduser` WHERE `ip`='$ip'");
      if(intval(@mysql_num_rows($res1))>1) {
        echo "<tr><td>$ip</td><td><table>";
        while($resarr1=mysql_fetch_array($res1)) {
      	  	$login=$resarr1['login'];
			$home=$resarr1['home'];
			if($home==0) $home="<font color=#666666>Фримен</font>";
			if($home==1) $home="<font color=#000099>Атрейдес</font>";
			if($home==2) $home="<font color=#009900>Ордос</font>";
			if($home==3) $home="<font color=#990000>Харконен</font>";
			if($home==4) $home="<font color=#990099>Карино</font>";
        	$notactiv=$resarr1['notactiv'];
        	$n=$resarr1['n'];
        	echo "<tr><td width=200>Логин: <a href=?view=user&mode=Инфо&plr=$n>$login</a></td><td width=150>Неактивен: $notactiv</td><td width=100>$home</td></tr>";
        }
        echo "</table></td></tr>";
      }
    }
  }
}
if (isset($view) && ($view=="cfg")) {
  if (isset($mode) && ($mode=="Обновить")){
     if(isset($cosmo_vr) && ($cosmo_vr==true)) $cfg_cosmo_vrag=1; else $cfg_cosmo_vrag=0;
  }
}
if (isset($view) && ($view=="activ")) {
  if (isset($mode) && ($mode=="Показать")){
    echo "<table width=100% border=1>
    <tr><th>Логин игрока</th><th>Неактивен</th></tr>";
    $notactiv=intval($notactiv);
    $res=mysql_query("SELECT * FROM `wduser` WHERE `notactiv`>$notactiv ORDER BY `notactiv` DESC");
    while($r=mysql_fetch_array($res)){
    	$login=$r['login'];
    	$notact=$r['notactiv'];
      echo "<tr><td>$login</td><td>$notact</td></tr>";
    }
    echo "</table>";
  }
}
if (isset($view) && ($view=="task")) {
  if (isset($mode) && ($mode=="del")){
  	 $task=intval($task);
     mysql_query("DELETE FROM `tasks` WHERE `n`='$task'");
     echo "Задача № $task успешно удалена";
  }
}
if (isset($view) && ($view=="armys")) {
  if (isset($mode) && ($mode=="Сформировать")){
  	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`!=1");
  	while($r=mysql_fetch_array($res)){
  		$n=$r['n'];
  		$login=$r['login'];
  		$users[$n]=$login;
  	}
    echo "<hr color=red><table border=1 width=100%><tr><th>№</th><th>Владелец</th><th>Название</th><th>X:Y</th><th>Ранг</th><th>Победы</th><th>ЛП</th><th>ТП</th><th>Т</th><th>РТ</th></tr>";

	$lpmax[]=0;
	$tpmax[]=0;
	$tmax[]=0;
	$rtmax[]=0;
    echo "<tr><td colspan=9 align=center>Армии</td></tr>";
    $i=0;
    $res=mysql_query("SELECT * FROM `army` WHERE (`linf`>0 OR `hinf`>0 OR `tank`>0 OR `rtank`>0) AND `up`!=1 order by linf desc,hinf desc,tank desc,rtank desc,rang desc,wins desc");
    while($r=mysql_fetch_array($res)){
    	$i+=1;
     	$name=$r['name'];
     	$up=$r['up'];
     	$rang=$r['rang'];
     	$wins=$r['wins'];
     	$lp=$r['linf'];$lpmax[$up]=$lpmax[$up]+$lp;
     	$tp=$r['hinf'];$tpmax[$up]=$tpmax[$up]+$tp;
     	$t=$r['tank'];$tmax[$up]=$tmax[$up]+$t;
     	$rt=$r['rtank'];$rtmax[$up]=$rtmax[$up]+$rt;
		$x=$r['x'];
		$y=$r['y'];
     	$login=$users[$up];
     	echo "<tr><td>$i</td><td>$login</td><td>$name</td><td>$x:$y</td><td>$rang</td><td>$wins</td><td>$lp</td><td>$tp</td><td>$t</td><td>$rt</td></tr>";
    }

    echo "<tr><td colspan=9 align=center>Гарнизоны</td></tr>";
    $i=0;
    $res=mysql_query("SELECT * FROM `base` WHERE (`linf`>0 OR `hinf`>0 OR `tank`>0 OR `rtank`>0) AND `up`!=1 order by linf desc,hinf desc,tank desc,rtank desc");
    while($r=mysql_fetch_array($res)){
    	$i+=1;
     	$name=$r['name'];
     	$up=$r['up'];
     	$lp=$r['linf'];$lpmax[$up]=$lpmax[$up]+$lp;
     	$tp=$r['hinf'];$tpmax[$up]=$tpmax[$up]+$tp;
     	$t=$r['tank'];$tmax[$up]=$tmax[$up]+$t;
     	$rt=$r['rtank'];$rtmax[$up]=$rtmax[$up]+$rt;
		$x=$r['x'];
		$y=$r['y'];
     	$login=$users[$up];
     	echo "<tr><td>$i</td><td>$login</td><td>$name</td><td>$x:$y</td><td>n/a</td><td>n/a</td><td>$lp</td><td>$tp</td><td>$t</td><td>$rt</td></tr>";
    }

	echo "<tr><td colspan=9 align=center>Общее</td></tr>";
    $i=0;
    $res=mysql_query("SELECT * FROM `base` WHERE (`linf`>0 OR `hinf`>0 OR `tank`>0 OR `rtank`>0) AND `up`!=1  order by linf desc,hinf desc,tank desc,rtank desc");
    while($r=mysql_fetch_array($res)){
    	$i+=1;
     	$name=$r['name'];
     	$up=$r['up'];
     	$lp=$lpmax[$up];
     	$tp=$tpmax[$up];
     	$t=$tmax[$up];
     	$rt=$rtmax[$up];
     	$login=$users[$up];
     	echo "<tr><td>$i</td><td>$login</td><td>$name</td><td>n/a</td><td>n/a</td><td>$lp</td><td>$tp</td><td>$t</td><td>$rt</td></tr>";
    }
    echo "</table><hr color=red>";
  }
}
if (isset($view) && ($view=="fame")) {
  if (isset($mode) && ($mode=="Наградить")){
  	if(isset($ok) && ($ok=="ДА")) {
  		$plr=intval($plr);
  		$medal=intval($medal);
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  		$r=mysql_fetch_array($res);
  		$name=$r['login'];
  		$info=htmlspecialchars($info,ENT_NOQUOTES);
  		$uname=htmlspecialchars($uname,ENT_NOQUOTES);
  		if($uname!="") $name=$uname;
  		$res=mysql_query("SELECT `col` FROM `fame` WHERE `name`='$name'");
  		if(intval(@mysql_num_rows($res))>0){
  			if($medal!=9)
  		    $col=mysql_result($res,0,'col')+1;
  		  else
  		    $col=mysql_result($res,0,'col')-1;
  		}
  	  else {
  	  	if($medal!=9)
  		    $col=1;
  		  else
  		    $col=0;
  		}
  		if($col<0) $col=0;
    	if(mysql_query("INSERT INTO `fame` (`n`,`name`,`medal`,`about`,`col`) VALUES ('','$name','$medal','$info','$col')"))
    	{
    		mysql_query("UPDATE `fame` SET `col`='$col' WHERE `name`='$name'");
    	  echo "Игрок $name успешно награжден";
    	}
    	else
    	  echo "Возникла проблема при награждении!";
  	} else {
  		$plr=intval($plr);
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  		$r=mysql_fetch_array($res);
  		$name=$r['login'];
  		$medal=intval($medal);
  		$res=mysql_query("SELECT `name` FROM `medales` WHERE `n`='$medal'");
  		$r=mysql_fetch_array($res);
  		$med_name=$r['name'];
  		$info=htmlspecialchars($info,ENT_NOQUOTES);
  		$uname=htmlspecialchars($uname,ENT_NOQUOTES);
  		if($uname!="") $name=$uname;
  		echo "Вы уверены, что хотите наградить игрока $name медалью: \"$med_name\", за \"$info\"?<br>
  		<form method=post>
  		<input type=hidden name=plr value='$plr'>
  		<input type=hidden name=uname value='$uname'>
      <input type=hidden name=medal value='$medal'>
      <input type=hidden name=info value='$info'>
      <input type=hidden name=view value=\"fame\">
      <input type=hidden name=mode value=\"Наградить\">
      <input type=submit name=ok value=\"ДА\">
      </form>
  		";
  	}
  }
}
?>
<table width=100%>
<tr><td><b>Выполнить запрос</b><hr></td></tr>
<tr><td colspan=2><form method=post><input type=text name=sql><input type=submit name=dosql value=Go></form></td></tr>
<tr><td><b>Игроки</b><hr></td></tr>
<tr><td>
<form method=post name=uform>
<select name=plr>
<?
$res=mysql_query("select * from `wduser` order by `login`");
$max=mysql_num_rows($res);
for ($i=0;$i<$max;$i++)
{
$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'login');
$ip=mysql_result($res,$i,'ip');
$res1=mysql_query("SELECT * FROM `banlist` where `name`='$name' or `ip`='$ip'");
if (mysql_num_rows($res1)>0) $ban=" (Забанен)"; else $ban="";
echo "<option value=$n";
if (isset($plr) && ($plr==$n)) echo " SELECTED";
echo">$name$ban</option>";
}
?>
</select>
<script language="javascript">
function getban()
{
	s=prompt('За что бан?','');
	if(s==null) s='Причина не указана';
	d=prompt('На сколько дней?','1');
	if(d==null) d='1';
	w=window.document.uform;
	w.msg.value=s;
	w.dd.value=d;
}
</script>
<input type=hidden name=view value="user">
<input type=hidden name=msg><input type=hidden name=dd>
<input type=submit name=mode value="Инфо"><input type=submit name=mode value="Удалить"><input type=submit name=mode value="Изменить"><input type=submit name=mode value="Бан" onclick="javascript:getban();"><input type=submit name=mode value="Снять бан">
</form>
</td></tr>
<tr><td><b>Альянсы</b><hr></td></tr>
<tr><td>
<form method=post>
<select name=al>
<?
$res=mysql_query("select * from `al` order by `name`");
$max=mysql_num_rows($res);
for ($i=0;$i<$max;$i++)
{
$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'name');
$up=mysql_result($res,$i,'up');
$res1=mysql_query("SELECT `login` FROM `wduser` where `n`='$up'");
$login=mysql_result($res1,0,'login');
$res1=mysql_query("SELECT * FROM `wduser` where `al`='$name'");
$max1=mysql_num_rows($res1);
echo "<option value=$n";
if (isset($al) && ($al==$n)) echo " SELECTED";
echo ">$name [$login] ($max1)</option>";
}
?>
</select>
<input type=hidden name=view value="al"><br>
<input type=submit name=mode value="Изменить"><input type=submit name=mode value="Удалить">
</form>
</td></tr>
<tr><td><b>Новости</b><hr></td></tr>
<tr><td>
<form method=post>
Заголовок: <input type=text name=title value=""><br>
Новая новость (можно использовать HTML):<br>
<textarea name=txt rows=10 cols=100></textarea><br>
<input type=checkbox name=index checked> Разместить на главной<br>
<input type=checkbox name=privmes> Разослать всем игрокам<br>
<input type=hidden name=view value="news">
<input type=submit name=mode value="Опубликовать">
</form>
</td></tr>
<tr><td><b>Рестарт</b><hr></td></tr>
<tr><td>
<form method=post>
<input type=hidden name=view value="restart">
Дата и время рестарта в формате: "дд.мм.гг - чч:мм"<br>
<input type=text name=dt><br>Номер раунда<br>
<input type=text name=rnd>
<input type=submit name=mode value="Рестарт">
</form>
</td></tr>
<?
$res=mysql_query("SELECT * FROM `tasks`");
if(intval(@mysql_num_rows($res))>0) {
	echo "<tr><td><b>Текущие задачи</b><hr></td></tr><tr><td><table border=1>";
  echo "<tr><th>№</th><th>Имя</th><th>Число1</th><th>Число2</th><th>Число3</th><th>Строка1</th><th>Строка2</th><th>Строка3</th><th>Отмена</th></tr>";
while($resarr=mysql_fetch_array($res)){
	echo "<tr><td>".$resarr['n']."</td><td>".$resarr['name']."</td><td>".$resarr['parnum1']."</td><td>".$resarr['parnum2']."</td><td>".$resarr['parnum3']."</td><td>&nbsp;".$resarr['parchar1']."</td><td>&nbsp;".$resarr['parchar2']."</td><td>&nbsp;".$resarr['parchar3']."</td><td align=center><a href=?view=task&mode=del&task=".$resarr['n'].">X</a></td></tr>";
}
  echo "</table></td></tr>";
}
?>
<tr><td><b>Поиск мультов и аккаунт-ситтеров</b><hr></td></tr>
<tr><td>
<form method=post>
<input type=hidden name=view value="mults">
<input type=submit name=mode value="Найти">
</form>
</td></tr>
<tr><td><table width=100%><tr><td colspan=2><b>Активность игроков</b><hr></td></tr>
<tr><td width=200>
Показать игроков чья неактивность больше: </td><td align=left><form method=post><input type=hidden name=view value="activ"><input type=text name=notactiv value="0"> дней</td></tr>
<tr><td colspan=2><input type=submit name=mode value="Показать"></form></td></tr>
</table>
</td></tr>
<tr><td><b>Статистика армий</b><hr></td></tr>
<tr><td>
<form method=post>
<input type=hidden name=view value="armys">
<input type=submit name=mode value="Сформировать">
</form>
</td></tr>
<tr><td>
<b>Выдача медалей</b><hr><fieldset><legend>Награды</legend>
<form method=post>
<table width=100%><tr><td colspan=2>Игрок<br><select name=plr style="width:220px">
<?
$res=mysql_query("select * from `wduser` order by `login`");
while($r=mysql_fetch_array($res)){
$n=$r['n'];
$name=$r['login'];
$ip=$r['ip'];
$res1=mysql_query("SELECT * FROM `banlist` where `name`='$name' or `ip`='$ip'");
if (mysql_num_rows($res1)>0) $ban=" (Забанен)"; else $ban="";
echo "<option value=$n";
if (isset($plr) && ($plr==$n)) echo " SELECTED";
echo">$name$ban</option>";
}
?>
</select><br>если нет в списке, напишите:<br><input type=text style="width:220px" name=uname maxlength=25><br>Медали<br><select style="width:220px" name=medal>
<?
$res=mysql_query("select * from `medales`");
while($r=mysql_fetch_array($res)){
$n=$r['n'];
$name=$r['name'];
echo "<option value=$n>$name</option>";
}
?>
</select> <a href=fame.php#about>?</a><br>За что награда (не пишите слово "ЗА"):<br><input type=text name=info style="width:300px" maxlength=200></td>
<td><input type=hidden name=view value="fame"><input type=submit name=mode value="Наградить"></td></tr></table>
</form></fieldset>
</td></tr>
</table>
<?

//###########################################    ПРЕДСТАВИТЕЛИ ВСД    ###########################################//
} elseif (isset($wd_usertyp) && ($wd_usertyp==1)) {
/*  if(isset($wd_twopass)) define('_ADM_',true);
  else if(!isset($wd_twopass) && !isset($twopass)) {
		echo "<h1>Введи второй пароль!</h1><br>
		<form method=post><input type=password name=twopass>
		<input type=submit value=\"Подтвердить\"></form>
		<br>Для получения второго пароля необходимо обратиться к dark_avenger'у";
		die();
	} else if(isset($twopass)){
		if(($twopass=="99doom58")&&($wd_username=="nightmind")) $_SESSION['wd_twopass']="ok";
		else if(($twopass=="51nba93")&&($wd_username=="Squaer")) $_SESSION['wd_twopass']="ok";
		else if(($twopass=="jo91ko")&&($wd_username=="ACE")) $_SESSION['wd_twopass']="ok";
		else if(($twopass=="kon666tin")&&($wd_username=="Ganima")) $_SESSION['wd_twopass']="ok";
		else {
			echo "Неверный пароль! Будьте внимательны.";
			log_("$wd_username совершил неудачную попытку входа в админку!");
			die();
		}
	} else die();*/
if (isset($view) && ($view=="news")) {
  if (isset($mode) && ($mode=="Опубликовать")){
    if (isset($index)){
    	include("avnews.php");
    	//$file=fopen("/home/www/avnews.php","w+");
    	$txt=ereg_replace("\"","&quote;",$txt);
    	$news="<tr><td colspan=3><b>".date("d.m.Y")."</b> - ".$txt."</td></tr><tr><td colspan=3 align=right><i>".$wd_username."</i><hr></td></tr>\n".$news;
    	$file=fopen("avnews.php","w+");
    	fwrite($file,"<?php\n \$news=\"".$news."\";\n?>");
    	fclose($file);
    }
    if (isset($privmes)){
    	$txt=ereg_replace("\"","&quote;",$txt);
    	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`!='$wd_usern'");
    	$max=intval(@mysql_num_rows($res));
      for($ii=0;$ii<$max;$ii++){
      	inform($wd_usern,mysql_result($res,$ii,'n'),$txt);
      }
    }
    if (isset($index) || isset($privmes)) echo "Ваша новость успешно опубликована"; else echo "Вы не указали, куда опубликовать новость";
  }
}
if (isset($view) && ($view=="mults")) {
  if (isset($mode) && ($mode=="Найти")){
    $res=mysql_query("SELECT DISTINCT ip FROM `wduser`");
    echo "<table border=1 width=100%>";
    while($resarr=mysql_fetch_array($res)){
    	$ip=$resarr['ip'];
      $res1=mysql_query("SELECT * FROM `wduser` WHERE `ip`='$ip'");
      if(intval(@mysql_num_rows($res1))>1) {
        echo "<tr><td>$ip</td><td><table>";
        while($resarr1=mysql_fetch_array($res1)) {
      	  $login=$resarr1['login'];
        	$notactiv=$resarr1['notactiv'];
        	$n=$resarr1['n'];
        	echo "<tr><td width=200>Логин: <a href=?view=user&mode=Инфо&plr=$n>$login</a></td><td>Неактивен: $notactiv</td></tr>";
        }
        echo "</table></td></tr>";
      }
    }
  }
}
if (isset($view) && ($view=="activ")) {
  if (isset($mode) && ($mode=="Показать")){
    echo "<table width=100% border=1>
    <tr><th>Логин игрока</th><th>Неактивен</th></tr>";
    $notactiv=intval($notactiv);
    $res=mysql_query("SELECT * FROM `wduser` WHERE `notactiv`>$notactiv ORDER BY `notactiv` DESC");
    while($r=mysql_fetch_array($res)){
    	$login=$r['login'];
    	$notact=$r['notactiv'];
      echo "<tr><td>$login</td><td>$notact</td></tr>";
    }
    echo "</table>";
  }
}
if (isset($view) && ($view=="fame")) {
  if (isset($mode) && ($mode=="Наградить")){
  	if(isset($ok) && ($ok=="ДА")) {
  		$plr=intval($plr);
  		$medal=intval($medal);
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  		$r=mysql_fetch_array($res);
  		$name=$r['login'];
  		$info=htmlspecialchars($info,ENT_NOQUOTES);
  		$uname=htmlspecialchars($uname,ENT_NOQUOTES);
  		if($uname!="") $name=$uname;
  		$res=mysql_query("SELECT `col` FROM `fame` WHERE `name`='$name'");
  		if(intval(@mysql_num_rows($res))>0){
  			if($medal!=9)
  		    $col=mysql_result($res,0,'col')+1;
  		  else
  		    $col=mysql_result($res,0,'col')-1;
  		}
  	  else {
  	  	if($medal!=9)
  		    $col=1;
  		  else
  		    $col=0;
  		}
  		if($col<0) $col=0;
    	if(mysql_query("INSERT INTO `fame` (`n`,`name`,`medal`,`about`,`col`) VALUES ('','$name','$medal','$info','$col')"))
    	{
    		mysql_query("UPDATE `fame` SET `col`='$col' WHERE `name`='$name'");
    	  echo "Игрок $name успешно награжден";
    	}
    	else
    	  echo "Возникла проблема при награждении!";
  	} else {
  		$plr=intval($plr);
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  		$r=mysql_fetch_array($res);
  		$name=$r['login'];
  		$medal=intval($medal);
  		$res=mysql_query("SELECT `name` FROM `medales` WHERE `n`='$medal'");
  		$r=mysql_fetch_array($res);
  		$med_name=$r['name'];
  		$info=htmlspecialchars($info,ENT_NOQUOTES);
  		$uname=htmlspecialchars($uname,ENT_NOQUOTES);
  		if($uname!="") $name=$uname;
  		echo "Вы уверены, что хотите наградить игрока $name медалью: \"$med_name\", за \"$info\"?<br>
  		<form method=post>
  		<input type=hidden name=plr value='$plr'>
  		<input type=hidden name=uname value='$uname'>
      <input type=hidden name=medal value='$medal'>
      <input type=hidden name=info value='$info'>
      <input type=hidden name=view value=\"fame\">
      <input type=hidden name=mode value=\"Наградить\">
      <input type=submit name=ok value=\"ДА\">
      </form>
  		";
  	}
  }
}
?>
<table width=100%>
<tr><td><b>Новости</b><hr></td></tr>
<tr><td>
Новая новость (можно использовать HTML, но без кавычек):
<form method=post>
<textarea name=txt rows=10 cols=100></textarea><br>
<input type=checkbox name=index checked> Разместить на главной<br>
<input type=checkbox name=privmes> Разослать всем игрокам<br>
<input type=hidden name=view value="news">
<input type=submit name=mode value="Опубликовать">
</form>
</td></tr>
<tr><td><b>Поиск мультов и аккаунт-ситтеров</b><hr></td></tr>
<tr><td>
<form method=post>
<input type=hidden name=view value="mults">
<input type=submit name=mode value="Найти">
</form>
</td></tr>
<tr><td><table width=100%><tr><td colspan=2><b>Активность игроков</b><hr></td></tr>
<tr><td width=200>
Показать игроков чья неактивность больше: </td><td align=left><form method=post><input type=hidden name=view value="activ"><input type=text name=notactiv value="0"> дней</td></tr>
<tr><td colspan=2><input type=submit name=mode value="Показать"></form></td></tr>
</table>
</td></tr>
<tr><td>
<b>Выдача медалей</b><hr><fieldset><legend>Награды</legend>
<form method=post>
<table width=100%><tr><td colspan=2>Игрок<br><select name=plr style="width:220px">
<?
$res=mysql_query("select * from `wduser` order by `login`");
while($r=mysql_fetch_array($res)){
$n=$r['n'];
$name=$r['login'];
$ip=$r['ip'];
$res1=mysql_query("SELECT * FROM `banlist` where `name`='$name' or `ip`='$ip'");
if (mysql_num_rows($res1)>0) $ban=" (Забанен)"; else $ban="";
echo "<option value=$n";
if (isset($plr) && ($plr==$n)) echo " SELECTED";
echo">$name$ban</option>";
}
?>
</select><br>если нет в списке, напишите:<br><input type=text style="width:220px" name=uname maxlength=25><br>Медали<br><select style="width:220px" name=medal>
<?
$res=mysql_query("select * from `medales`");
while($r=mysql_fetch_array($res)){
$n=$r['n'];
$name=$r['name'];
echo "<option value=$n>$name</option>";
}
?>
</select> <a href=fame.php#about>?</a><br>За что награда (не пишите слово "ЗА"):<br><input type=text name=info style="width:300px" maxlength=200></td>
<td><input type=hidden name=view value="fame"><input type=submit name=mode value="Наградить"></td></tr></table>
</form></fieldset>
</td></tr>
</table>
<?
} else echo "<font color=red><h1>Доступ запрещен!</h1></font>";
include "footer.php";
?>