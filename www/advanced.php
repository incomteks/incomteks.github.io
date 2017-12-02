<?
include "header.php";

if (isset($wd_base))
{

$res=mysql_query("select * from `wduser` where `n`='$wd_usern'");
$bal=mysql_result($res,0,'bal');
$status=mysql_result($res,0,'status');
$sendmail=mysql_result($res,0,'sendmail');
$showmap_=mysql_result($res,0,'showmap');


// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if (isset($mode) && $mode=="setaway" && $awaytime>0 && $awaytime<4) if ($status==0)
{
if ($awaytime==1) $price=100;
if ($awaytime==2) $price=200;
if ($awaytime==3) $price=400;

if ($bal>=$price)
{
$bal=$bal-$price;
if ($awaytime==1) $awaytime=1440;
if ($awaytime==2) $awaytime=3360;
if ($awaytime==3) $awaytime=6720;

mysql_query("update `wduser` set `bal`='$bal', `status`='$awaytime' where `n`='$wd_usern'");
mysql_query("update `base` set `spec1`='10000' where `up`='$wd_usern'");

$res=mysql_query("select * from `wduser` where `n`='$wd_usern'");
$bal=mysql_result($res,0,'bal');
$status=mysql_result($res,0,'status');
log_(27,$awaytime);
} else echo "Пополните баланс для ухода в отпуск на такой срок.";
}


//Показывать или нет мини-карту
if (isset($minimap)) {
	mysql_query("UPDATE `wduser` SET `showmap`='$showmap' WHERE `n`='$wd_usern'");
	$showmap_=$showmap;
}

//Отправлять письма о рестарте
if (isset($mode) && $mode=="smail") {
	if(isset($mailme)) $mailme=1; else $mailme=0;
	mysql_query("UPDATE `wduser` SET `sendmail`='$mailme' WHERE `n`='$wd_usern'");
	$sendmail=$mailme;
}

//Смена пароля
if (isset($mode) && $mode=="chpass") {
	$nowpass=htmlspecialchars($nowpass,ENT_NOQUOTES);
	$newpass1=htmlspecialchars($newpass1,ENT_NOQUOTES);
	$newpass2=htmlspecialchars($newpass2,ENT_NOQUOTES);
	if ((isset($nowpass)) && ($nowpass!="")) {
		$res=mysql_query("select * from `wduser` where `n`='$wd_usern'");
		$truepass=mysql_result($res,0,'password');
		$nowpass=md5($nowpass);
		if ($nowpass==$truepass) {
			if ($newpass1==$newpass2) {
				$newpass1=md5($newpass1);
				mysql_query("UPDATE `wduser` SET `password`='$newpass1' WHERE `n`='$wd_usern'");
				$succmes="<font color=blue>Пароль успешно изменен</font>";
				log_(28,"0");
			} else $errmes="<font color=red>Введенные новые пароли не совпадают</font>";
		} else $errmes="<font color=red>Вы неверно указали свой текущий пароль</font>";
	} else $errmes="<font color=red>Вы забыли ввести свой текущий пароль</font>";
}
//Удаление профиля
if (isset($mode) && $mode=="chhome") {
	$nowpass=htmlspecialchars($nowpass,ENT_NOQUOTES);
	if ((isset($nowpass)) && ($nowpass!="")) {
		$res=mysql_query("select * from `wduser` where `n`='$wd_usern'");
		$truepass=mysql_result($res,0,'password');
		$nowpass=md5($nowpass);
		//$act=mysql_result($res,0,'act');
		//if($act>=1000) 
		$newhome=intval($newhome);
		if($newhome>=1 && $newhome<=3) {
			$res=mysql_query("SELECT * FROM `wduser` WHERE `home`='1' and `notactiv`<'$deltime'");
			$maxh1=intval(@mysql_num_rows($res));
			$res=mysql_query("SELECT * FROM `wduser` WHERE `home`='2' and `notactiv`<'$deltime'");
			$maxh2=intval(@mysql_num_rows($res));
			$res=mysql_query("SELECT * FROM `wduser` WHERE `home`='3' and `notactiv`<'$deltime'");
			$maxh3=intval(@mysql_num_rows($res));
			if(($maxh1>=($maxh2+$disbalance)) || ($maxh1>=($maxh3+$disbalance))) $may[1]=0; else $may[1]=1;
			if(($maxh2>=($maxh1+$disbalance)) || ($maxh2>=($maxh3+$disbalance))) $may[2]=0; else $may[2]=1;
			if(($maxh3>=($maxh2+$disbalance)) || ($maxh3>=($maxh1+$disbalance))) $may[3]=0; else $may[3]=1;
			if($may[$newhome]==1) {
		if ($nowpass==$truepass) {
			$res=mysql_query("SELECT * FROM `al` where `up`='$wd_usern'");
			if (@mysql_num_rows($res)==0) {
				$x=mysql_query("UPDATE `wduser` SET `al`='' WHERE `n`='$wd_usern'");
			  if ($x==1) echo "Армии уничтожены<br>";
			  $x=mysql_query("DELETE FROM `army` WHERE `up`='$wd_usern'");
			  if ($x==1) echo "Армии уничтожены<br>";
			  $x=mysql_query("DELETE FROM `base` WHERE `up`='$wd_usern'");
			  if ($x==1) echo "Базы уничтожены<br>";
			  $x=mysql_query("DELETE FROM `bild` WHERE `user`='$wd_usern'");
			  if ($x==1) echo "Постройки отменены<br>";
			  //$x=mysql_query("DELETE FROM `hod` WHERE `up`='$wd_usern'");
			  //if ($x==1) echo "Запуски ракет отменены<br>";
			  //$x=mysql_query("DELETE FROM `mes` WHERE `to`='$wd_usern'");
			  //if ($x==1) echo "";
			  $x=mysql_query("DELETE FROM `move` WHERE `up`='$wd_usern'");
			  if ($x==1) echo "Передвижения отменены<br>";
			  //$x=mysql_query("DELETE FROM `res` WHERE `up`='$wd_usern'");
			  //if ($x==1) echo "";
			  $x=mysql_query("DELETE FROM `space` WHERE `up`='$wd_usern'");
			  if ($x==1) echo "Полеты космопорта отменены<br>";
			  //$x=mysql_query("DELETE FROM `tech` WHERE `up`='$wd_usern'");
			  //if ($x==1) echo "Исследования отменены<br>";
			  $x=mysql_query("DELETE FROM `trade` WHERE `up`='$wd_usern'");
			  if ($x==1) echo "Заказы войск отменены<br>";
			  //$x=mysql_query("DELETE FROM `wduser` WHERE `n`='$wd_usern'");
			  //if ($x==1) echo "Игрок УНИЧТОЖЕН!<br>";
			  mysql_query("UPDATE `wduser` SET `home`='$newhome' WHERE `n`='$wd_usern'");
			  log_(29,$newhome);
			  session_unset();
			  echo "<font color=blue>Ваш дом успешно изменен</font>";
			  echo "<script>document.location=\"index.php\"</script>";
			  
		  } else {
		  	$alname=mysql_result($res,0,'name');
		  	$errmes="<font color=red>Вы являетесь лидером альянса $alname. Прежде чем сменить свой дом вам необходимо <a href=\"clan.php\">уничтожить альянс</a>.</font>";
		  }
		} else $errmes="<font color=red>Вы неверно указали свой текущий пароль</font>";
		} else $errmes="<font color=red>В этот дом пока нельзя вступить! Слишком много игроков.</font>";
	  } else $errmes="<font color=red>Нельзя играть за выбранный дом!</font>";
	} else $errmes="<font color=red>Вы забыли ввести свой текущий пароль</font>";
}
if (isset($mode) && $mode=="mess") {
	$maxm=intval($maxm);
	$wd_maxmess=$maxm;
	mysql_query("UPDATE `wduser` SET `maxmess`='$maxm' WHERE `n`='$wd_usern'");
}
?>
<h1>Опции расширенного интерфейса</h1>
<table width=100% border=0>
<tr><td colspan=2><br>
<table width=100% border=0>
<tr><td colspan=2 width=360><b>Рестарт</b></td><td valign=top><b>Мини-карта</b></td></tr>
<tr><td colspan=3><hr></td></tr>
<tr><td colspan=2><form method=POST><input type=checkbox name=mailme <? if($sendmail==1) echo "checked"; ?>>Уведомлять меня о Рестартах<input type=hidden name=mode value='smail'></td><td valign=top><input type=checkbox name=showmap <? if($showmap_==1) echo "checked"?>>Показывать мини-карту</td></tr>
<tr><td colspan=2><input type=submit value='Сохранить'></td><td><input type=submit name=minimap value='Сохранить'></form></td></tr>
<tr><td colspan=2><br><form method=POST><b>Смена пароля:</b>
<? if (isset($mode) && ($mode=="chpass") && (isset($succmes))) echo "<br>$succmes"; ?>
<? if (isset($mode) && ($mode=="chpass") && (isset($errmes))) echo "<br>$errmes"; ?></td><td>&nbsp;</td></tr>
<tr><td colspan=3><hr></td></tr>
<tr><td width=150>
Ваш текущий пароль:</td><td><input type="password" name="nowpass"></td><td rowspan=4>&nbsp;</td></tr>
<tr><td>
Ваш новый пароль:</td><td><input type="password" name="newpass1"></td></tr>
<tr><td>
Повторите новый пароль:</td><td><input type="password" name="newpass2"></td></tr>
<tr><td colspan=2>
<input type=hidden name=mode value="chpass">
<input type=submit value="Изменить"></form><br><br></td></tr>
<tr><td colspan=2><br><form method=POST><b>Смена дома</b><br>
<? if (isset($mode) && ($mode=="chhome") && (isset($errmes))) echo "<br>$errmes"; ?>
</td><td>&nbsp;</td></tr>
<tr><td colspan=3><hr></td></tr>
<tr><td colspan=2><font color=red>Внимание!!! Для смены вашего дома, прийдется уничтожить все ваши базы и армии!!!</font></td><td rowspan=4>&nbsp;</td></tr>
<tr><td width=150>Ваш текущий пароль:</td><td><input type="password" name="nowpass"></td></tr>
<tr><td>
Выберите новый дом:</td><td>
<select name=newhome>
<option value=1>Атрейдес</option>
<option value=2>Ордос</option>
<option value=3>Харконен</option>
</select></td></tr><tr><td colspan=2>
<input type=hidden name=mode value="chhome">
<input type=submit value="Изменить"></form><br>После смены дома, вам предстоит снова войти игру.</td></tr>
<tr><td colspan=2><br><form method=POST><b>Настройка сообщений</b><br></td><td>&nbsp;</td></tr>
<tr><td colspan=3><hr></td></tr>
<tr><td>Макс. показывать: </td><td><input type=text value='<?=$wd_maxmess?>' name=maxm><input type=hidden name=mode value='mess'></td><td>&nbsp;</td></tr>
<tr><td colspan=2><input type=submit value='Сохранить'></form></td><td>&nbsp;</td></tr>
</table>
<hr><br><br>

</td></tr>
</table>
<?

}

include "footer.php";
?>