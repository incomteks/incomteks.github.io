<?php
extract($_POST);
extract($_GET);
// Load JsHttpRequest backend.
require_once "lib/JsHttpRequest/JsHttpRequest.php";
// Create main library object. You MUST specify page encoding!
$JsHttpRequest =& new JsHttpRequest("windows-1251");
// Store resulting data in $_RESULT array (will appear in req.responseJs).
include "av_func.php";
include "config.php";
include "connect.php";
define('QST','army');
include "quests.php";
include "inc_units.php";

$army=intval($_REQUEST['army']);
$shift=intval($_REQUEST['shift']);
$direction=intval($_REQUEST['direction']);

$_RESULT = array("result" => "");

if($army>0)
{
if($direction==0)
{
$x=mysql_query("delete from `move` where up='$army'");
setactiv($wd_usern);
$res="<table width=60 height=60 cellspacing=0 cellpadding=0 border=0 bordercolor=#e2a267>";
$res.="<tr height=20>";
$res.="<td width=20 height=20>&nbsp;</td>";
$res.="<td width=20 height=20><a href=\"javascript:movearmy(marmy$army,$army,document.sh$army.shift.value,1)\"><img src=pics/ar_u.gif border=0></a></td>";
$res.="<td width=20 height=20>&nbsp;</td>";
$res.="</tr>";
$res.="<tr height=20 valign=middle>";
$res.="<td width=20 height=20><a href=\"javascript:movearmy(marmy$army,$army,document.sh$army.shift.value,4)\"><img src=pics/ar_l.gif border=0></a></td>";
$res.="<td width=20 height=20><form name=sh$army><input class=\"shift\" name=shift type=text value=1 maxlength=3></form></td>";
$res.="<td width=20 height=20><a href=\"javascript:movearmy(marmy$army,$army,document.sh$army.shift.value,2)\"><img src=pics/ar_r.gif border=0></a></td>";
$res.="</tr>";
$res.="<tr height=20>";
$res.="<td width=20 height=20>&nbsp;</a></td>";
$res.="<td width=20 height=20><a href=\"javascript:movearmy(marmy$army,$army,document.sh$army.shift.value,3)\"><img src=pics/ar_d.gif border=0></a></td>";
$res.="<td width=20 height=20>&nbsp;</td>";
$res.="</tr>";
$res.="</table>";
$_RESULT = array("result" => "$res");
}
elseif ($shift>0 && $direction>=1 && $direction<=4)
{
$res=mysql_query("select * from `army` where `n`='$army' and `up`='$wd_usern'");
if (mysql_num_rows($res)==1)
{
$res2=mysql_query("SELECT * FROM `move` WHERE `up`='$army'");
if (@mysql_num_rows($res2)==0) {
$arm_x=mysql_result($res,0,'x');
$arm_y=mysql_result($res,0,'y');
if (isset($shift)) $shift=intval($shift);
else $shift=0;

if ($direction==1) $arm_y+=$shift;
if ($direction==2) $arm_x+=$shift;
if ($direction==3) $arm_y-=$shift;
if ($direction==4) $arm_x-=$shift;

if(!$granica) {
if ($arm_x<=0) $arm_x=$dune_x;
if ($arm_y<=0) $arm_y=$dune_y;
if ($arm_x>$dune_x) $arm_x=1;
if ($arm_y>$dune_y) $arm_y=1;
} else {
if ($arm_x<=0) $arm_x=1;
if ($arm_y<=0) $arm_y=1;
if ($arm_x>$dune_x) $arm_x=$dune_x;
if ($arm_y>$dune_y) $arm_y=$dune_y;
}

$dleft=5-$t_engine;
if ($dleft<1) $dleft=1;

$x=mysql_query("insert into `move` (`up`,`x`,`y`,`dleft`,`hday`,`direct`) values ('$army','$arm_x','$arm_y','$dleft','$dleft','$direction')");
setactiv($wd_usern);
$res="<table width=60 height=60 cellspacing=1 cellpadding=0 border=1 bordercolor=#e2a267>";
$res.="<tr>";
$res.="<td width=60 height=40>";
$res.="<center>маршрут<br><b>[".$arm_x.":".$arm_y."]</b><br>дней <b>$dleft</b><br>всего <b>$dleft</b></center>";
$res.="</td></tr><tr><td><center>";
$res.="<a href=\"javascript:movearmy(marmy$army,$army,0,0)\"><img src=pics/ar_st.gif border=0></a></center>";
$res.="</td>";
$res.="</tr>";
$res.="</table>";

$_RESULT = array("result" => "$res");
}
}
}
}
?>