<?
	if (0
		&& $_SERVER['REMOTE_ADDR']!='82.199.102.55'
		&& $_SERVER['REMOTE_ADDR']!='87.249.5.226'
	) {
		echo '<p>Ведутся технические работы. Игра временно простановлена.</p><p>Администрация игры приносит свои извинения.</p>';
		exit;
	}
extract($_GET);
extract($_POST);
$a=$_SERVER['SCRIPT_NAME'];
$ip=htmlspecialchars($_SERVER["REMOTE_ADDR"],ENT_NOQUOTES);

//if($ip!="212.154.180.18"){
// echo "<center><h1>САЙТ ВРЕМЕННО НЕДОСТУПЕН, ВЕДУТСЯ РАБОТЫ!</h1></center>";
//die();
//}

if ($ip=="81.25.38.158" || $ip=="212.32.217.160" || $ip=="81.198.188.47" || $ip=="213.228.84.201" || $ip=="85.140.254.138" || $ip=="85.114.2.236" || $ip=="81.57.1.223" || $ip=="213.247.244.134" || $ip=="213.221.18.58" || $ip=="195.62.14.94" || $ip=="62.105.131.121" || $ip=="81.26.131.78" || $ip=="213.154.202.234" || $ip=="80.84.181.178") {
	echo "Доступ запрещен.";
  die();
}
include "connect.php";
$res=mysql_query("select * from `banlist` where ip='$ip'");
if (@mysql_num_rows($res)>='1'){
$desc=mysql_result($res,0,'desc');
$days=mysql_result($res,0,'days');
$banday=mysql_result($res,0,'banday');
$curday=date("d.m.Y");
if(($banday+$days)<=$curday) {
  mysql_query("DELETE FROM `banlist` WHERE `ip`='$ip'");
}
echo "Вы забанены за $desc на $days дней";
die();
}
if (isset($baseselect)) {
	$mres=mysql_query("SELECT * FROM `base` WHERE `up`='$wd_usern' AND `n`='$basenumber'");
  if(@mysql_num_rows($mres)>0) {$_SESSION['wd_base']=$basenumber;$wd_base=$basenumber;} else session_unset();
}

if(isset($wd_usern)){
$res=mysql_query("SELECT * FROM `wduser` WHERE `n`='$wd_usern'");
if(intval(@mysql_num_rows($res))==0) {
	echo "Связь с сервером потеряна.";
	session_unset();
} else {
	$res1=mysql_query("select * from `day` limit 1");
  $game_day=mysql_result($res1,0,'n');
  $_SESSION['wd_inplay']=$game_day-mysql_result($res,0,'reg');
  $wd_inplay=$_SESSION['wd_inplay'];
  $showmemap=mysql_result($res,0,'showmap');
}
}

include "av_func.php";
include "wd_func.php";

if(isset($wd_username)) {
//if (!sess_on($wd_usern)) die("Дублируемый запрос с одного логина!");
$usr=$wd_username;
}else $usr="UNNAMED";

$paramhead=" bgcolor=#e6a76c background=pics/grad1.jpg style='color:#f8cda4;font-weight: bolder;padding:5px;font-size: 11px;' ";
$paramhead2=" bgcolor=#e6a76c background=pics/grad1.jpg";
$paramtable=" cellspacing=2 cellpadding=2 border=1 bordercolor=#cc9664 ";

function inform($ot,$to,$dsc)
{
$time=date("Y-m-d H:i:s");
mysql_query("insert into `mes` values ('','$ot','$to','$dsc','$time','2','0','1')");
}

function getmicrotime()
{
list($usec, $sec) = explode(" ",microtime());
return ((float)$usec + (float)$sec);
}

function bolnul($cif)
{
if ($cif<0) $cif=0;
return ceil($cif);
}


function BoxTop($param="",$spec="")
{
?>
<table width=100% height=100% cellpadding=0 cellspacing=0 border=0>
<tr><td height=12 width=12><img src=pics/ball<?=$spec?>.gif height=12 width=12></td><td height=12 background=pics/tubeh<?=$spec?>.gif></td><td height=12 width=12><img src=pics/ball<?=$spec?>.gif height=12 width=12></td></tr>
<tr><td width=12 background=pics/tubev<?=$spec?>.gif></td><td width=100% height=100% <?=$param?>>
<?
}

function BoxBot($spec="")
{
?>
</td><td width=12 background=pics/tubev<?=$spec?>.gif></td></tr>
<tr><td height=12 width=12><img src=pics/ball<?=$spec?>.gif height=12 width=12></td><td height=12 background=pics/tubeh<?=$spec?>.gif></td><td height=12 width=12><img src=pics/ball<?=$spec?>.gif height=12 width=12></td></tr>
</table>
<?
}

$TIME_START = getmicrotime();

//######################
echo "<html><head><title>Бесплатная браузерная онлайн стратегия - Dune2 On-Line</title>";
$day1=60*60*24;
$store=3;
$last=gmdate("D, d M Y H:i:s",floor(time()/$day1/$store)*$day1*$store)." GMT";
$exp=gmdate("D, d M Y H:i:s",ceil(time()/$day1/$store)*$day1*$store)." GMT";
$meta="";
$meta.='<meta http-equiv="Last-Modified" content="'.$last.'">'."\n";
$meta.='<meta http-equiv="Expires" content="'.$exp.'">'."\n";
$meta.='<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">'."\n";
$meta.='<meta http-equiv="Cache-Control: no-cache, must-revalidate">'."\n";
$meta.='<meta http-equiv="Pragma: no-cache">'."\n";
$meta.='<meta name="robots" content="index,follow">'."\n";
$meta.='<meta name="revisit" content="3 days">'."\n";
$meta.='<meta name="revisit-after" content="3 days">'."\n";

$meta.='<meta http-equiv="KEYWORDS" content="Бесплатная браузерная стратегия, браузерная онлайн стратегия - Dune2 On-Line, онлайн игра, таймкиллер, новая онлайн стратегия, ММО стратегия, MMO">'."\n";
$meta.='<meta http-equiv="DESCRIPTION" content="Бесплатная браузерная стратегия, браузерная онлайн стратегия - Dune2 On-Line, онлайн игра, таймкиллер, новая онлайн стратегия, ММО стратегия, MMO">'."\n";
echo $meta;
echo '<link rel="stylesheet" href="style.css" type="text/css"></head><body>';
include "jvscripts.php"
?>

<table width=100% border=0 cellpadding=0 cellspacing=0>
<tr><td bgcolor=#e5ac77>
<table width=100% border=0>

<tr><td width=300 valign=top>
<?

include "wd_loginform.php";
?>
</td><td valign=top align=right>

<table width=100%>
<tr><td align=center>
<?
//if (!isset($wd_usern))
 echo "<a href=index.php><img src=pics/title_r1.gif width=300 height=75 border=0></a><br>Последнее обновление 03.12.2008</td>";
 include "inc_units.php";
if (isset($wd_usern))
{
	if(isset($showmemap) && $showmemap==1 && !isset($minimap)) {
		echo "<td>";
		include "small_map.php";
		echo "</td>";
	} elseif(isset($showmap)&&($showmap=="on"||$showmap==1)) {
		echo "<td>";
		include "small_map.php";
		echo "</td>";
	}
}
echo "
<td width=150 align=right><table width=150>
<tr><td align=right><a href=index.php><img src='pics/ub1.gif' height=15 width=121 border=0 alt='домашняя страница'></a></td></tr>
<!-- <tr><td align=right><a href=index.php><img src='pics/ub2.gif' height=15 width=121 border=0 alt='предыстория'></a></td></tr> -->
<tr><td align=right><a href=rules.php><img src='pics/ub3.gif' height=15 width=121 border=0 alt='правила игры\n*обязательно для прочтения'></a></td></tr>
<tr><td align=right><a href=http://localhost/forum.php?iid=1/ target=_blank><img src='pics/ub4.gif' height=15 width=121 border=0 alt='форум'></a></td></tr>
<tr><td align=right><a href=cre.php><img src='pics/ub5.gif' height=15 width=121 border=0 alt='создатели'></a></td></tr>
<tr><td align=right><a href=fame.php target=_blank><img src='pics/ub6.gif' height=15 width=121 border=0 alt='зал славы игры Dune 2 on-line'></a></td></tr>
</table></td></tr></table>";

?>
</td></tr></table>
</td>
<td bgcolor=#e5ac77 valign=top align=right>
<?
if (isset($wd_usern))
{

?>
<table width=100% border=0>
<tr><td width=1>
<a href=<?=$a?>><img src=../pics/refresh.gif border=0 alt='Обновить'></a>
</td><td valign=top style="padding:10px" align=center>
<? if ($wd_home>=1 and $wd_home<=3) echo "<img src=pics/logo".$wd_home.".gif width=88 height=94>"; ?>
</td></tr></table>
<?
}
else
{
echo "<a href=http://localhost><img src=pics/tp.gif border=0></a>";
}
?>
</td></tr>


<tr height=100% valign=top>
<? if($a=="/logonizer.php") {?>
<td colspan=2 height=500 width=100% style="padding:5px">
<? }else{ ?>
<td height=500 width=80% style="padding:5px">
<? } ?>