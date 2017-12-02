<?
extract($_POST);
extract($_GET);
if (isset($wd_base))
{
define('QINFO','info');
include "quests.php";


//$cp=$lvl[2]*10;
$electro=5+$lvl[3]*5;
$fundam=5+10*($lvl[2]-1);
$silo_cap=500+$lvl[5]*500;

$res=@mysql_query("select count(*) from `mes` where `to`='$wd_usern' and (`typ`='0' or `typ`='1' or `typ`='2')");
$mcnt=@mysql_result($res,0,'count(*)');

$res=@mysql_query("select count(*) from `mes` where `to`='$wd_usern' and `new`='1' and (`typ`='0' or `typ`='1' or `typ`='2')");
if(@mysql_num_rows($res)>0){ $newmes=mysql_result($res,0,'count(*)');}
else {$newmes=0;}

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

if (!isset($mcnt) || $mcnt=="") $mcnt=0;

$png=(ceil($game_day/20)-1)*20+9;
?>
<a href=stat_0.php>Статистика Баз и Гарнизонов</a></br></br>
<div id="info">
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
<tr><td align=right>Харвестеры:	</td><td><font <? /*if ($cp<=$lvl[21]) echo "color=#ff0000";*/ ?>><b><? echo $lvl[21]; ?></b></font></td></tr>
<tr><td align=right>Фундамент:	</td><td><font <? if ($lvl[1]==0) echo "color=#ff0000"; if ($lvl[1]>$fundam) echo "color=#0000ff"; ?>><b><? echo $lvl[1]." / $fundam"; ?></b></font></td></tr>
<tr><td colspan=2 height=5 align=center><b>По всем базам:</b></td></tr>

<tr><td align=right>Гранит:	</td><td><b><?=$all_stone?></b></td></tr>
<tr><td align=right>Кредиты:	</td><td><b><?=$all_cred?></b></td></tr>
</table>
</div>

<p align=left>
<a href=mes.php>У вас <b><?=$mcnt?></b> <? if($newmes>0) echo "(<font color=blue>новых: $newmes</font>)"; ?></b> сообщений</a><br>
Спутниковая карта: <!-- <a href=pngmap.php?gameday=<?=$png?> target=_blank>PNG</a>, --><a href=dunefullmap.html target=_blank>HTML</a>
</p>

<a href=buildings.php><img src=pics/btn1.gif alt='постройки' border=0 width=199 height=26></a><br>
<a href=units.php><img src=pics/btn2.gif alt='пехота и техника' border=0 width=199 height=26></a><br>
<a href=army.php><img src=pics/btn3.gif alt='армии' border=0 width=199 height=26></a><br>
<a href=spaceport.php><img src=pics/btn4.gif alt='космопорт' border=0 width=199 height=26></a><br>
<a href=trade.php><img src=pics/btn8.gif alt='база торговой гильдии' border=0 width=199 height=26></a><br>
<a href=tech.php><img src=pics/btn7.gif alt='научный центр' border=0 width=199 height=26></a><br>
<a href=jamesbond.php><img src=pics/btn9.gif alt='шпионаж' border=0 width=199 height=26></a><br>
<a href=map.php><img src=pics/btn5.gif alt='карта' border=0 width=199 height=26></a><br>
<a href=war_book.php><img src=pics/btn6.gif alt='cправочник по технике' border=0 width=199 height=26></a><br>
<a href=clan.php><img src=pics/btn10.gif alt='альянсы' border=0 width=199 height=26></a><br><br>

уничтожить базу [<a href=blowbase.php>x</a>]
<?
}
?>
