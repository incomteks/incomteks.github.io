<?
extract($_GET);
extract($_POST);
include "header.php";


if (isset($wd_base))
{

define('QST','units');
include "quests.php";

/*$lim[21]=$refin;
$lim[22]=$fact-4;
$lim[23]=round($bar*$bar/1.5);
$lim[24]=round(($bar-2)*($bar-1)/1.5);
$lim[25]=round(pow($fact, 0.7));
$lim[26]=round(pow($fact-4, 0.7));
$lim[30]=5;*/
/*
if(isset($setprior) && ($setprior==1)) {
	$unit=intval($unit);
	$pr=intval($pr);
	if($unit==21) $fld="prharv";
	if($unit==22) $fld="prmobconst";
	if($unit==23) $fld="prlinf";
	if($unit==24) $fld="prhinf";
	if($unit==25) $fld="prtank";
	if($unit==26) $fld="prrtank";
	if($unit==30) $fld="prhod";
	mysql_query("UPDATE `base` SET `$fld`='$pr' WHERE `n`='$wd_base'");
	$prior[$unit]=$pr;
}
*/
/*
if (isset($btn) && ($btn=="Заказать"))
{//лимит на харвы вырублен
//if ($lim[21]>($lvl[2]*10-$lvl[21])) $lim[21]=($lvl[2]*10-$lvl[21]);

for ($i=21;$i<=30;$i++) {
if (isset($col[$i]))
{

	$col[$i]=intval($col[$i]);
  if(($col[$i]=="nan") || (is_nan($col[$i])))
    $col[$i]=0;
} else $col[$i]=0;

if ($col[$i]<0) $col[$i]=0;
if ($i==21 && $lvl[21]>=$lvl[2]*10) $col[$i]=0;

if ($i!=27 && $i!=28 && $i!=29 && $col[$i]>0) {

//если не хватает заказываем столько, на сколько хватает
if (($res_cred>=$cred[$i]*$col[$i] && $lvl[1]>=$site[$i]*$col[$i] && $res_stone>=$stone[$i]*$col[$i]) and ($i>=21 && $i<=26) || ($i==30))
$min=$col[$i];
else
{
$min=floor($res_cred / $cred[$i]);

if ($i==22 || $i==25 || $i==26 || $i==30)
{
$min2=floor($lvl[1] / $site[$i]);
if ($min2<$min) $min=$min2;

if ($i==22 || $i==30)
{
$min2=floor($res_stone / $stone[$i]);
if ($min2<$min) $min=$min2;
}
}
}
if(is_nan($min)) $min=0;
$zak=$min;

//заполнение очереди до конца
$res=mysql_query("select * from `bild` where `base`='$wd_base' and `struct`='$i'");
if (@mysql_num_rows($res)==0) $is=0;
else $is=mysql_result($res,0,'col');

//if ($zak>($lim[$i]-$is)) $zak=($lim[$i]-$is);
$col2=$is+$zak;

if ($i!=30 || ($lvl[10]>=1 && $t_hod==1))
{
if (@mysql_num_rows($res)==0)
{
if ($col2>0)

$x=mysql_query("insert into bild (`user`,`base`,`struct`,`dleft`,`col`,`bday`) values ('$wd_usern','$wd_base','$i','$days[$i]','$col2','$days[$i]')");
}
else
$x=mysql_query("update bild set `user`='$wd_usern',`col`='$col2',`bday`='$days[$i]' where `base`='$wd_base' and `struct`='$i' ");

if(isset($x) && ($x==1))
{
//echo "Строительство будет завершено через ".$days[$i]." дней.<br>";
$cred_left=$res_cred-$cred[$i]*$zak;
$place_left=$lvl[1]-$site[$i]*$zak;
$stone_left=$res_stone-$stone[$i]*$zak;

$res_cred=$cred_left;
$lvl[1]=$place_left;
$res_stone=$stone_left;

setactiv($wd_usern);
$x2=mysql_query("update base set `cred`='$cred_left',`place`='$place_left',`stone`='$stone_left' where `up`='$wd_usern' and `n`='$wd_base' ");
log_(7,"$i:$col2");

if ($x2!==1) echo mysql_error();
} else echo "Ошибка БД";
} else echo "Строительство Руки Смерти невозможно.";
}
}
echo '<script>window.location.href="units.php?mode=view";</script>';
}
*/
for ($i=21;$i<=30;$i++)
{
if ($i==27) $i=30;

$price[$i]="Гранит: <b>".$stone[$i]." </b><br>Кредиты: <b>".$cred[$i]."</b><br>Фундамент: <b>".$site[$i]."</b><br>Время: <b>".$days[$i]." дней</b>";

$res=mysql_query("select * from `bild` where `base`='$wd_base' and `struct`='$i'");

if (@mysql_num_rows($res)==0) $ab[$i]="0";
else
{
$ab[$i]=mysql_result($res,0,'dleft');
$z[$i]=mysql_result($res,0,'col');
}

if (($res_cred<$cred[$i] || $lvl[1]<$site[$i] || $res_stone<$stone[$i]) && $ab[$i]==0) $ab[$i]="-1";
}
?>

<table width=100% <?=$paramtable?>>
<tr valign=top><td>&nbsp;</td><td width=40% <?=$paramhead?>>Боевая единица</td><td width=20% <?=$paramhead?>>Стоимость и время постройки</td><td width=20% <?=$paramhead?>>Статус</td><td width=20% <?=$paramhead?>>Автопостройка</td></tr>


<? for ($i=21;$i<=30;$i++) {
if ($i==27) $i=30;

if ($i==21) echo "<tr><td colspan=5 height=5 $paramhead>Гражданская техника</td></tr>";
if ($i==23) echo "<tr><td colspan=5 height=5 $paramhead>Пехота</td></tr>";
if ($i==25) echo "<tr><td colspan=5 height=5 $paramhead>Боевая техника</td></tr>";

?>

<? if ($i!=21 || $refin>=1) {
   if ($i!=22 || $fact>=5) {
   if ($i!=23 || $bar>=1) {
   if ($i!=24 || $bar>=3) {
   if ($i!=25 || $fact>=1) {
   if ($i!=26 || $fact>=5) {
   if ($i!=30 || $lvl[10]>=1 && $t_hod==1) {

if ($i==30) echo "<tr><td colspan=5 height=5 $paramhead>Супероружие: ракета Рука смерти</td></tr>";
?>

<tr valign=top>
<td><img src=pics/unit<?=$i?>.jpg></td>
<td><?=$name[$i]?></td><td><?=$price[$i]?><!--//<br>Лимит на заказ <b><?=$lim[$i]?></b>//-->
</td><td>В гарнизоне: <b><?=$lvl[$i]?></b>
<br><br>
<?
if ($i==30 && $lvl[30]>=1) echo "<a href=hod.php>Атаковать</a><br><br>";

// ЗАМЕНИТЬ ЭТОТ БЛОК ДЛЯ СМЕНЫ ОГРАНИЧЕНИЯ С ВОЙСК НА ХАРВЫ
//if ($i==21 && $lvl[$i]>=$lvl[2]*10) echo "Недостаточно командных очков. Усовершенствуйте командный центр.";
//else
//{

?>
<form name="formzak<?=$i?>" method=post>
<input name=col<?=$i?> value=0>
</form>
<a href="javascript:zakaz(zak<?=$i?>,<?=$i?>,document.formzak<?=$i?>.col<?=$i?>.value)">Заказать</a>
<div id="zak<?=$i?>" style="border:0px solid #000; padding:0px">
<?
if ($ab[$i]==0) echo "Сейчас не строится";
if ($ab[$i]<0) echo "Недостаточно ресурсов для постройки";
if ($ab[$i]>0)
echo "Очередная постройка через <b>".$ab[$i]."</b> дней<br>Всего заказано <b>".$z[$i]."</b> юнитов";
//}
// ЗАМЕНИТЬ ЭТОТ БЛОК ДЛЯ СМЕНЫ ОГРАНИЧЕНИЯ С ВОЙСК НА ХАРВЫ
?>
</div>
</td><td align=center><b>Приоритет</b><br><br>
<form name=formpr<?=$i?> method=post>
<div id="pr<?=$i?>" style="border:0px solid #000; padding:0px">
<select name=prior<?=$i?>>
<?
for($m=0;$m<21;$m++) {
	if($prior[$i]==$m) $sel="SELECTED"; else $sel="";
	echo "<option value=\"$m\" ".$sel.">$m</option>";
}
?>
</select>
</div>
</form>
<a href="javascript:setprior(pr<?=$i?>,<?=$i?>,document.formpr<?=$i?>.prior<?=$i?>.value)">Установить</a>
<br>Автопостройка включена если приоритет выше нуля.
</td></tr>

<? } } } } } } } } ?>
<tr align=right><td colspan=5></td></tr>
</table>

<form method=post name=data>
<input type=hidden name=unit>
<input type=hidden name=pr>
<input type=hidden name=setprior value=1>
</form>


<?
}


include "footer.php";
?>