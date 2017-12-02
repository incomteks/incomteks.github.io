<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_base))
{

echo "<b>Альянсы</b><br><br>";

$res=mysql_query("select * from wduser where n='$wd_usern'");
$al=mysql_result($res,0,'al');





if (isset($mode) && ($mode=="newal"))
{
	$errmes="";
	$alname = htmlspecialchars($alname,ENT_NOQUOTES);
  if ((!$alname) || ($alname=="") || (ereg("[^a-zA-Z0-9А-Яа-я=_@.-]",$alname))) $errmes = "Недопустимые символы в названии альянса.";
  if (strlen($alname) > 40) $errmes = "Слишком длинное название альянса. Максимальная длина 40 символов.";
  if ($errmes=="") {
    $reso=mysql_query("select count(*) from al where name='$alname'");
    $alov=mysql_result($reso,0,'count(*)');
    if ($alov>0) echo "Ошибка! Такой альянс уже есть. <br>";
    else 
    {
      echo "Создание нового альянса...";
      $x=mysql_query("insert into `al` (`up`,`name`) values ('$wd_usern','$alname')");
      if ($x==1)
      {
        echo "прошло успешно!<br>";
        log_(37,$alname);
        ?><script>window.location.href="clan.php?mode=view";</script><?
      } else echo mysql_error();
      mysql_query("update wduser set `al`='$alname' where `n`='$wd_usern'");
      $al=$alname;
    }
  } echo "$errmes<br>";
}
if (isset($mode) && ($mode=="drop")) 
{
$res=mysql_query("SELECT * FROM `al` WHERE `up`='$wd_usern'");
$res=mysql_query("SELECT * FROM `wduser` WHERE `al`='$al'");
$max=mysql_num_rows($res);
if ($max==1){
mysql_query("update wduser set `al`='' where `n`='$wd_usern'");
mysql_query("delete from al where `up`='$wd_usern'");
log_(38,$al);
$al="";
} else echo "Вы не можете удалить альянс, т.к. в нем есть люди. <a href=\"clan.php\">Назад</a>";
}

if (isset($mode) && ($mode=="away"))
{
mysql_query("update wduser set `al`='' where `n`='$wd_usern'");
log_(39,$al);
$al="";
}
if (isset($plrn)) $plrn=intval($plrn);
if (isset($mode) && ($mode=="insert" && $plrn>0)) 
{
if ($email!="") 
{
$res=mysql_query("select * from wduser where `n`='$plrn'");
$eml=mysql_result($res,0,'email');

if ($email==$eml) 
{

$x=mysql_query("update wduser set `al`='$al' where `n`='$plrn' and `al`=''");
if ($x==1) {
	inform($wd_usern,$plrn,"Вы были включены в альянс <b>$al</b>.");
	log_(40,"$al:$plrn");
}

} else echo "<font color=#990000>Введенный e-mail не совпадает с e-mail'ом игрока.</font><br>";
} else echo "<font color=#990000>Не введен e-mail игрока. Включение игрока в альянс невозможно.</font><br>";
}

if (isset($player)) $player=intval($player);
if (isset($mode) && ($mode=="fire" && $player>0))
{
$x=mysql_query("update wduser set `al`='' where `n`='$player' and `n`!='$wd_usern' and `al`='$al'");
if ($x==1) {
	log_(41,"$al:$player");
	inform($wd_usern,$player,"Вы были с позором исключены из альянса <b>$al</b>.");
}
}

if ($al=="") 
{
echo "<b>Вы не состоите ни с кем в альянсе.</b><br><br>";

?>
<form action=<?=$a?> method=post>
<b>создать свой альянс:</b> 
<input name=alname>
<input type=hidden name=mode value=newal>
<input type=submit value="Создать">
</form>
<?


}
else
{
echo "Вы состоите в альянсе <b>$al</b>.<br><br>";

$res=mysql_query("select * from al where name='$al'");

$up=mysql_result($res,0,'up');

$res=mysql_query("select * from wduser where n='$up'");
$llogin=mysql_result($res,0,'login');

echo "Лидер альянса $al: <b>$llogin</b><br><br>";

$res=mysql_query("select * from wduser where al='$al'");
$max=mysql_num_rows($res);

echo "Члены альянса $al (всего $max игроков):<br><br>";

for ($i=0;$i<$max;$i++)
{
$n=mysql_result($res,$i,'n');
$login=mysql_result($res,$i,'login');
$email=mysql_result($res,$i,'email');

if (!isset($act)) $act=0;
$dd=$game_day-$act;

echo "<li><b>$login</b> ($email)";
if ($llogin==$wd_username && $login!=$wd_username) echo " ... <a href=$a?mode=fire&player=$n>исключить из альянса</a> ";
}

if ($llogin==$wd_username) 
{
echo "<br><br><b>Вы являетесь лидером этого альянса.</b>";
if ($max==1) echo "<br><a href=$a?mode=drop>Удалить альянс</a> (вы можете удалить альянс только пока в нем нет других игроков).";
else echo "<br>* вы не можете удалить альянс пока в нем есть игроки";

?>
<form action=<?=$a?> method=post>
<b>Включить в альянс игрока:</b> <select name=plrn>
<?
$res=mysql_query("select * from wduser where `n`!='$wd_usern' and `al`='' and `home`='$wd_home' order by `login`");

$max=mysql_num_rows($res);

for ($i=0;$i<$max;$i++)
{
$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'login');

echo "<option value=$n>$name</option>";
}
?>
</select>
e-mail игрока: <input name=email> 
<input type=hidden name=mode value=insert>
<input type=submit value="Включить">
</form>
<?

}
else echo "<br><br><a href=$a?mode=away>Покинуть альянс</a>";


}











echo "<hr><b>Все альянсы:</b>";

$res=mysql_query("select * from al");

$max=mysql_num_rows($res);

echo "<table width=100% $paramtable><tr valign=top>
<td $paramhead>Имя</td>
<td $paramhead>Дом</td>
<td $paramhead>Лидер</td>
<td $paramhead>Игроков</td>
</tr>";

for ($i=0;$i<$max;$i++)
{

$up=mysql_result($res,$i,'up');
$name=mysql_result($res,$i,'name');

$res2=mysql_query("select * from wduser where n='$up'");
$login=@mysql_result($res2,0,'login');
$home=@mysql_result($res2,0,'home');


if ($home==0) $home="Фримены";
if ($home==1) $home="Атреидес";
if ($home==2) $home="Ордос";
if ($home==3) $home="Харконнен";
if ($home==4) $home="Карину";


$res2=@mysql_query("select count(*) from wduser where `al`='$name'");
$plr=@mysql_result($res2,0,'count(*)');

echo "<tr valign=top>
<td>$name</td>
<td>$home</td>
<td>$login</td>
<td>$plr</td>
</tr>";


}

echo "</table><br>* если вы хотите вступить в альянс - отправляйте заявки по <a href=mes.php>внутренней почте</a> лидеру альянса.
<br>** если вас включили в альянс без вашего желания - пишите императору (ник *Emperor*). Нарушитель будет наказан.";

}
include "footer.php";
?>