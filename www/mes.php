<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_usern))
{
//УСТАНОВКА-СНЯТИЕ ИГНОРА
if (isset($mode) && ($mode=="Установить/Снять игнор") && isset($plr)){
  $plr=intval($plr);
  if($plr!=0){
  	$res=mysql_query("SELECT * FROM `ignor` WHERE `up`='$wd_usern' and `ignor`='$plr'");
  	if(intval(@mysql_num_rows($res))>0) {
  		mysql_query("DELETE FROM `ignor` WHERE `up`='$wd_usern' and `ignor`='$plr'");
      log_(20,$plr);
    } else {
    	mysql_query("INSERT INTO `ignor` (`n`,`up`,`ignor`) VALUES ('','$wd_usern','$plr')");
    	log_(19,$plr);
    }
  }
}
//УДАЛЕНИЕ ВЫБРАННЫХ СООБЩЕНИЙ КРОМЕ ИСХОДЯЩИХ
if (isset($mode) && ($mode=="delsel") && (isset($selmes))){
	$allval="";
  foreach($selmes as $val) {
  	$val=intval($val);
  	mysql_query("UPDATE `mes` SET `typ`='5' where `n`='$val' and `to`='$wd_usern'");
  	$allval=$allval.":".$val;
  }
  log_(6,$allval);
}
//УДАЛЕНИЕ ВЫБРАННЫХ СООБЩЕНИЙ - ИСХОДЯЩИХ
if (isset($mode) && ($mode=="delselOut") && (isset($selmes))){
	$allval="";
  foreach($selmes as $val) {
  	$val=intval($val);
  	mysql_query("update `mes` set `delmark`='1' where `n`='$val' and `ot`='$wd_usern'");
  	$allval=$allval.":".$val;
  }
  log_(6,$allval);
}

//УДАЛЕНИЕ ОДНОГО СООБЩЕНИЯ В ИСХОДЯЩИХ
if (isset($message)) $message=intval($message);
if (isset($mode) && ($mode=="deleteOut" and $message>0))
{
mysql_query("update `mes` set `delmark`='1' where `n`='$message' and `ot`='$wd_usern'");
log_(6,$message);
}

//УДАЛЕНИЕ ОДНОГО СООБЩЕНИЯ КРОМЕ ИСХОДЯЩИХ
if (isset($mode) && ($mode=="delete" and $message>0))
{
$res=mysql_query("select count(*) from `mes` where `to`='$wd_usern' and `n`='$message'");
if (mysql_result($res,0,'count(*)')==1)
{
mysql_query("UPDATE `mes` SET `typ`='5' where `n`='$message' and `to`='$wd_usern'");
log_(6,$message);
}
}
//ОТПРАВКА СООБЩЕНИЯ
if (isset($plr)) $plr=intval($plr);
if (isset($mode) && ($mode=="Отправить сообщение" && $plr!=0 && $txt!="") && isset($dest))
{
$res=mysql_query("SELECT * FROM `ignor` WHERE `up`='$plr' and `ignor`='$wd_usern'");
if(intval(@mysql_num_rows($res))==0) {
$txt=filter($txt,"message");
$date=date("Y-m-d H:i:s");
if ($dest=="al") {
$res=mysql_query("select `al` from `wduser` where `n`='$wd_usern'");
$al=mysql_result($res,0,'al');
$resu=mysql_query("select * from `wduser` where `al`='$al' and `n`!='$wd_usern'");

for ($ii=0;$ii<mysql_num_rows($resu);$ii++)
{
$n=mysql_result($resu,$ii,'n');
mysql_query("insert into `mes` values ('','$wd_usern','$n','$txt','$date','1','$ii','1')");
}
log_(5,$plr);
echo "<center>***Сообщение отослано всем членам альянса***</center><br>";
} else if ($dest=="priv") {
$res=mysql_query("select `login` from `wduser` where `n`='$plr'");
$login=mysql_result($res,0,'login');
$x=mysql_query("insert into `mes` values ('','$wd_usern','$plr','$txt','$date','0','0','1')");
if ($x==1) {
	echo "Сообщение отправлено игроку $login!<br><br>";
	log_(5,$plr);
}
else echo mysql_error();
}
} else echo "<font color=red>Этот пользователь не может получать ваши сообщения! Он поставил вас в Игнор.</font><br>";
}
//УДАЛЕНИЕ ВСЕХ СООБЩЕНИЙ КРОМЕ ИСХОДЯЩИХ
if (isset($mode) && ($mode=="clear") && isset($v))
{
$v=intval($v);
mysql_query("UPDATE `mes` SET `typ`='5' where `to`='$wd_usern' and `typ`=$v");
}
//УДАЛЕНИЕ ВСЕХ ИСХОДЯЩИХ СООБЩЕНИЙ
if (isset($mode) && ($mode=="clearOut") && isset($v))
{
$v=intval($v);
mysql_query("update `mes` set `delmark`='1' where `ot`='$wd_usern'");
}

if (isset($v)) $v=intval($v); else $v=0;
$res=mysql_query("select * from `mes` where `to`='$wd_usern' and `typ`='0'");
$max0=@mysql_num_rows($res);
$res=@mysql_query("select * from `mes` where `to`='$wd_usern' and `new`='1' and `typ`='0'");
$new0=@mysql_num_rows($res);

$res=mysql_query("select * from `mes` where `to`='$wd_usern' and `typ`='1'");
$max1=@mysql_num_rows($res);
$res=@mysql_query("select * from `mes` where `to`='$wd_usern' and `new`='1' and `typ`='1'");
$new1=@mysql_num_rows($res);

$res=mysql_query("select * from `mes` where `to`='$wd_usern' and `typ`='2'");
$max2=@mysql_num_rows($res);
$res=@mysql_query("select * from `mes` where `to`='$wd_usern' and `new`='1' and `typ`='2'");
$new2=@mysql_num_rows($res);

$res=mysql_query("select * from `mes` where `ot`='$wd_usern' and `delmark`='0'");
$max3=@mysql_num_rows($res);
$max0=intval($max0);$max1=intval($max1);$max2=intval($max2);$max3=intval($max3);
$new0=intval($new0);$new1=intval($new1);$new2=intval($new2);
if($new0>0) $newmes0="<font color=blue>[$new0]</font>"; else $newmes0="";
if($new1>0) $newmes1="<font color=blue>[$new1]</font>"; else $newmes1="";
if($new2>0) $newmes2="<font color=blue>[$new2]</font>"; else $newmes2="";

if ($v!=0) echo "<a href=$a?v=0>Личные($max0)$newmes0</a> | "; else echo "Личные($max0)$newmes0 | ";
if ($v!=1) echo "<a href=$a?v=1>Альянс($max1)$newmes1</a> | "; else echo "Альянс($max1)$newmes1 | ";
if ($v!=2) echo "<a href=$a?v=2>Системные($max2)$newmes2</a> | "; else echo "Системные($max2)$newmes2 | ";
if ($v!=3) echo "<a href=$a?v=3>Отправленные($max3)</a>"; else echo "Отправленные($max3)";
if ($v<3) {echo "<br><a href=\"javascript:confdel('$a?mode=clear&v=$v')\">Удалить все в этом разделе</a>"; } else {
	echo "<br><a href=\"javascript:confdel('$a?mode=clearOut&v=$v')\">Удалить все в этом разделе</a>";
}
echo "<br><br><table width=100% $paramtable ><tr valign=top>";
if ($v<3) {
	if(!isset($l)) $l=$wd_maxmess;
	$maxm=$l;
	$minm=$maxm-$wd_maxmess;
	$res=mysql_query("select * from `mes` where `to`='$wd_usern' and `typ`='$v'");
	$realmax=@mysql_num_rows($res);
	$res=mysql_query("select * from `mes` where `to`='$wd_usern' and `typ`='$v' order by `n` desc LIMIT $minm,$wd_maxmess");
	$logn="отправитель";
}
else {
	if(!isset($l)) $l=$wd_maxmess;
	$maxm=$l;
	$minm=$maxm-$wd_maxmess;
	$res=mysql_query("select * from `mes` where `ot`='$wd_usern' and `delmark`='0'");
	$realmax=@mysql_num_rows($res);
	$res=mysql_query("select * from `mes` where `ot`='$wd_usern' and `delmark`='0' order by `n` desc LIMIT $minm,$wd_maxmess");
	$logn="получатель";
}
$max=@mysql_num_rows($res);
echo "<td $paramhead width=20%>s/n<br>$logn<br>время</td><td $paramhead>текст</td><td $paramhead width=10%>действие</td></tr>";
$max=intval($max);
for ($i=0;$i<$max;$i++)
{
echo "<form method=POST>";
$n=mysql_result($res,$i,'n');
$newstat=$n;

if ($v<3) {
$ot=mysql_result($res,$i,'ot');
$newstat1=mysql_result($res,$i,'new');
if($newstat1>0) $newstat="<font color=blue><b>$n</b></font>";
if ($ot!=0)
{
$res2=mysql_query("select login from `wduser` where `n`='$ot'");
if(intval(@mysql_num_rows($res2))==0) $login="игрок - <b>Безымянный"; else
$login="игрок <b>".mysql_result($res2,0,'login');
} else $login="игрок <b>localhost";
}
else {
$to=mysql_result($res,$i,'to');
$typ=mysql_result($res,$i,'typ');
if($typ==1) $login="<b>АЛЬЯНС";
else if ($to!=0)
{
$res2=mysql_query("select login from `wduser` where `n`='$to'");
if (mysql_num_rows($res2)>0) {
$login="игрок <b>".mysql_result($res2,0,'login');} else { $login="игрок <b>localhost"; }
} else $login="игрок <b>localhost";
}
$dsc=mysql_result($res,$i,'dsc');
$time=mysql_result($res,$i,'time');

echo "<tr valign=top><td>$newstat<br>$login</b><br>$time</td> <td>$dsc</td>
<td>";

if ($v<3) {
echo "<a href=$a?mode=reply&message=$n&v=$v&from=$ot#form>Ответить</a><br>
<a href=$a?mode=quote&message=$n&v=$v&from=$ot#form>Цитировать</a><br>
<center><input type=checkbox name=\"selmes[]\" value=$n></center>
Удалить [<a href=\"javascript:confdel_one('$a?mode=delete&message=$n&v=$v')\">x</a>]
</td></tr>";
}
else { echo "<center><input type=checkbox name=\"selmes[]\" value=$n></center>Удалить [<a href=\"javascript:confdel_one('$a?mode=deleteOut&message=$n&v=3')\">x</a>]</td></tr>"; }
}
if ($max>0) {
	if ($v==3) $del="delselOut"; else $del="delsel";
	echo "<tr><td align=right colspan=3><input type=hidden name=mode value=$del><input type=submit value=\"Удалить выбранные\"></tr></td>";
}
mysql_query("update `mes` set `new`='0' where `to`='$wd_usern' and `typ`='$v'");
echo "</form></table>";
if($max>0){
	echo "<p align=center>";
	$maxp=ceil($realmax/$wd_maxmess);
	for($i=1;$i<=$maxp;$i++) {
		$tmp=$wd_maxmess*$i;
		if($l==$tmp) echo "[$i] ";
		else echo "<a href=?v=$v&l=$tmp>$i</a> ";
	}
	echo "</p>";
}
?>

<br><br>
<a name=form></a>
<form action=<?=$a?> method=post>
<input type=radio name=dest value="priv"<? if($v!=1) echo " checked"; ?>><b>Отправить сообщение игроку: </b><select name=plr>

<?
$res=mysql_query("select * from wduser where `n`!='$wd_usern' order by `login`");

$max=mysql_num_rows($res);

while($resarr=mysql_fetch_array($res))
{
$n=$resarr['n'];
$name=$resarr['login'];
$res1=mysql_query("SELECT * FROM `ignor` WHERE `up`='$wd_usern' and `ignor`='$n'");
if(intval(@mysql_num_rows($res1))>0) $ignor="(игнор)"; else $ignor="";
$res1=mysql_query("SELECT * FROM `ignor` WHERE `up`='$n' and `ignor`='$wd_usern'");
if(intval(@mysql_num_rows($res1))>0) $ignor.="(вы в игноре)";

echo "<option value=".$n;

if (isset($mode) && (($mode=="reply" || $mode=="quote") && $from==$n))  echo " SELECTED ";
echo ">$name$ignor</option>";
}
echo "</select> <input type=submit name=mode value=\"Установить/Снять игнор\">";
$res=mysql_query("select `al` from `wduser` where `n`='$wd_usern'");
$al=mysql_result($res,0,'al');
if ($al!="") { ?>
<br><input type=radio name=dest value="al"<? if($v==1) echo " checked"; ?>><b>Отправить сообщение альянсу <?=$al?></b>
<?
}

if (isset($mode) && ($mode=="quote"))
{
$res=mysql_query("select * from `mes` where `n`='$message'");
$dsc=@mysql_result($res,0,'dsc');
$from=mysql_result($res,0,'ot');
if($from!=0) {
	$res=mysql_query("select `login` from `wduser` where `n`='$from'");
	$from=mysql_result($res,0,'login');
} else $from="localhost";
$dsc=ereg_replace("<br>","\n",$dsc);
$dsc="Текст исходного сообщения от игрока $from\n---\n$dsc\n---\n";
}

?>
<br>
текст сообщения:<br>
<textarea name=txt rows=10 cols=100><? if (isset($mode) && ($mode=="quote")) echo "$dsc"; ?></textarea>
<br>
<input type=submit name=mode value="Отправить сообщение">
</form>
<br>
<?
}

include "footer.php";
?>