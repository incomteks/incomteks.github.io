<?php
extract($_POST);
extract($_GET);
// Load JsHttpRequest backend.
require_once "lib/JsHttpRequest/JsHttpRequest.php";
// Create main library object. You MUST specify page encoding!
$JsHttpRequest =& new JsHttpRequest("windows-1251");
// Store resulting data in $_RESULT array (will appear in req.responseJs).
include "av_func.php";
include "connect.php";
define('QINFO','info');
include "quests.php";
include "inc_units.php";

if(isset($wd_base)){
$_RESULT = array("result" => "");

$cp=$lvl[2]*10;
$electro=5+$lvl[3]*5;
$silo_cap=500+$lvl[5]*500;

$rest=mysql_query("select * from `tech` where `up`='$wd_usern'");
$tharv=@mysql_result($rest,0,'harv');

//Кредиты и гранит со всех баз
$all_cred=0;
$all_stone=0;
$res_all_cred=mysql_query("SELECT * FROM `base` WHERE `up`='$wd_usern'");
while($r_all=mysql_fetch_array($res_all_cred)){
  $all_cred=$all_cred+$r_all['cred'];
  $all_stone=$all_stone+$r_all['stone'];
}

//Минимальный доход
$coef=2/4;
$dohod=$lvl[2]*10+$lvl[9]*20+$lvl[10]*50;
$sp=$coef*$lvl[21]*(3+$tharv)+$res_spice;
$rp=($lvl[4]+round($coef*($lvl[4]*$lvl[4]/2)))*5;
$sp=$sp-$rp;
$dohod=$dohod+$rp;
if($sp<0) $dohod=$dohod+$sp;
$dohodmin=round($dohod);

//Максимальный доход
$coef=6/4;
$dohod=$lvl[2]*10+$lvl[9]*20+$lvl[10]*50;
$sp=$coef*$lvl[21]*(3+$tharv)+$res_spice;
$rp=($lvl[4]+round($coef*($lvl[4]*$lvl[4]/2)))*5;
$sp=$sp-$rp;
$dohod=$dohod+$rp;
if($sp<0) $dohod=$dohod+$sp;
$dohodmax=round($dohod);
?>
<table width=100% cellpadding=2 cellspacing=5 bordercolor=#cc9664 border=1>
<tr><td align=right width=50%>База:		</td><td width=50%><b><?=$res_name?></b></td></tr>
<tr><td align=right>Координаты:	</td><td><b><?=$res_x?>:<?=$res_y?></b></td></tr>
<tr><td colspan=2 height=5 align=center><a href=bren.php>переименовать базу</a></td></tr>

<tr><td align=right>Гранит:	</td><td><b><?=$res_stone?></b></td></tr>
<tr><td align=right>Спайс:	</td><td><font <? if (isset($spice) && ($silo_cap<=$spice)) echo "color=#ff0000"; ?>><b><? echo "$res_spice / $silo_cap"; ?></b></font></td></tr>
<tr><td align=right>Кредиты:	</td><td><b><?=$res_cred?></b></td></tr>
<tr><td align=right>Прибыль:	</td><td><b><?=$dohodmin?>-<?=$dohodmax?></b></td></tr>
<tr><td colspan=2 height=5></td></tr>

<tr><td align=right>Энергия:	</td><td><font <? if ($electro<=$sumb) echo "color=#ff0000"; ?> ><b><? echo "$sumb / $electro"; ?></b></font></td></tr>
<tr><td align=right>Харвестеры:	</td><td><font <? if ($cp<=$lvl[21]) echo "color=#ff0000"; ?>><b><? echo $lvl[21]." / $cp"; ?></b></font></td></tr>
<tr><td align=right>Фундамент:	</td><td><font <? if ($lvl[1]==0) echo "color=#ff0000"; ?>><b><? echo $lvl[1]; ?></b></font></td></tr>
<tr><td colspan=2 height=5 align=center><b>По всем базам:</b></td></tr>

<tr><td align=right>Гранит:	</td><td><b><?=$all_stone?></b></td></tr>
<tr><td align=right>Кредиты:	</td><td><b><?=$all_cred?></b></td></tr>
</table>
<?
}
?>