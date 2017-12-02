<?
extract($_POST);
extract($_GET);
include "header.php";

if (isset($wd_base))
{
//максимумы
$max=array();
$max[1]=5+10*($lvl[2]-1);
$max[2]='';
$max[3]='';
$max[4]=1+floor($lvl[2]*2.75);
$max[5]='';
$max[6]=$lvl[2]*2-1;
$max[7]=(($lvl[2]-1)*2)-1;
$max[8]=$lvl[2];
$max[9]=floor(($lvl[2]-4)*1.4);
$max[10]=$lvl[2]-7;
$max[11]='';
$max[12]='';
$max[13]='';
$max[21]='';
$max[22]='';
$max[23]='';
$max[24]='';
$max[25]='';
$max[26]='';
$max[27]='';
$max[28]='';
$max[29]='';
$max[30]='';
$max[31]=floor(($lvl[2]-4)*1.75);

define('QST','build');
include "quests.php";
/*
if(isset($setprior) && ($setprior==1)) {
	$unit=intval($unit);
	$pr=intval($pr);
	if($unit==1) $fld="prplace";
	if($unit==2) $fld="prconstr";
	if($unit==3) $fld="prwind";
	if($unit==4) $fld="prrefin";
	if($unit==5) $fld="prsilo";
	if($unit==6) $fld="prbar";
	if($unit==7) $fld="prfact";
	if($unit==8) $fld="prtech";
	if($unit==9) $fld="prcosmo";
	if($unit==10) $fld="prpalace";
	if($unit==11) $fld="prwall";
	if($unit==12) $fld="prtower";
	if($unit==13) $fld="prrtower";
	if($unit==31) $fld="prtrade";
	mysql_query("UPDATE `base` SET `$fld`='$pr' WHERE `n`='$wd_base'");
	$prior[$unit]=$pr;
}
*/
/*
if (isset($mode) && ($mode=="construct"))
{

$i=intval($structure);

if (($res_cred>=$cred[$i] && $lvl[1]>=$site[$i] && $res_stone>=$stone[$i]) and (($i>=1 && $i<=13) or ($i==31)))
{
$stop=0;
if ($i==9 && $lvl[8]<5) $stop=1;
if ($i==31 && $lvl[9]==0) $stop=1;
if ($i==7 && ($lvl[8]==0 || $lvl[6]==0)) $stop=1;
if ($i==10 && ($lvl[2]<5 || $lvl[9]==0)) $stop=1;
//проверка максимумов
if ($max[$i]!='' && $lvl[$i]>=$max[$i]  && $i!=1)
{	$stop=1;
	$ab[$i]=-2;
}

if ($stop==0) {

$res=mysql_query("select * from `bild` where `base`='$wd_base' and `struct`='$i'");
if (@mysql_num_rows($res)==0)
{

$x=mysql_query("insert into bild (`user`,`base`,`struct`,`dleft`) values ('$wd_usern','$wd_base','$structure','$days[$i]')");
if ($x==1)
{
	setactiv($wd_usern);
	$tmp=$days[$i];
	log_(3,"$structure:$tmp");
//echo "Строительство будет завершено через ".$days[$i]." дней.<br>";
$cred_left=$res_cred-$cred[$i];
$place_left=$lvl[1]-$site[$i];
$stone_left=$res_stone-$stone[$i];

$x2=mysql_query("update base set `cred`='$cred_left',`place`='$place_left',`stone`='$stone_left' where `up`='$wd_usern' and `n`='$wd_base' ");
if ($x2!=1) echo mysql_error();
else {echo '<script>window.location.href="buildings.php?mode=view";</script>';}
}
}
}
}
}
*/

if (isset($mode) && ($mode=="cansel"))
{

$i=intval($structure);

$res=mysql_query("select * from `bild` where `base`='$wd_base' and `struct`='$i' and `user`='$wd_usern'");
if (mysql_num_rows($res)==1)
{

$x=mysql_query("delete from `bild` where `base`='$wd_base' and `struct`='$i' and `user`='$wd_usern'");
if ($x==1)
{
	log_(4,$structure);
$cred_left=$res_cred+$cred[$i];
$place_left=$lvl[1]+$site[$i];
$stone_left=$res_stone+$stone[$i];

$x2=mysql_query("update base set `cred`='$cred_left',`place`='$place_left',`stone`='$stone_left' where `up`='$wd_usern' and `n`='$wd_base' ");
if ($x2!=1) echo mysql_error();
else { ?><script>window.location.href="buildings.php?mode=view";</script><? }
}
}
}

for ($i=1;$i<=31;$i++)
{
if ($i==14) $i=31;

$price[$i]="Гранит: <b>".$stone[$i]." </b><br>Кредиты: <b>".$cred[$i]."</b><br>Фундамент: <b>".$site[$i]."</b><br>Время: <b>".$days[$i]." дней</b>";
if ($i!=1) $price[$i].="<br><br><a href=details.php?getunit=$i>Стоимость по уровням</a>";
$res=mysql_query("select * from `bild` where `base`='$wd_base' and `struct`='$i'");

if (@mysql_num_rows($res)==0) $ab[$i]=0;
else $ab[$i]=mysql_result($res,0,'dleft');

if (($res_cred<$cred[$i] || $lvl[1]<$site[$i] || $res_stone<$stone[$i]) && $ab[$i]==0) $ab[$i]=-1;
if ($max[$i]!='')
{
	$price[$i].="<br>Лимит: <b>".$max[$i]."</b>";
    if ($lvl[$i]>=$max[$i] && $i!=1) $ab[$i]=-2;
}
}

?>

<table width=100% <?=$paramtable?>>
<tr valign=top><td>&nbsp;</td><td width=40% <?=$paramhead?>>Сооружение</td><td width=20% <?=$paramhead?>>Стоимость и время постройки</td><td width=20% <?=$paramhead?>>Статус</td><td width=40% <?=$paramhead?>>Автопостройка</td></tr>
<tr><td colspan=5 height=5 <?=$paramhead?>>Фундамент</td></tr>

<tr valign=top>
<td><img src=pics/unit1.jpg border=1></td>
<td><?=$name[1]?></td><td><?=$price[1]?></td>
<td>
<br>
<div id="build1" style="border:0px solid #000; padding:0px">
<?
$i=1;
$contr=date("d")+date("m")*500-$wd_base*72-30+51*($wd_usern*$i+13);
if ($ab[1]==0) echo "<br><a href=\"javascript:build(build1,1,0);\">Строить (+$t_build)</a>";
if ($ab[1]==-1) echo "<br>Недостаточно ресурсов для постройки";
if ($ab[1]==-2) echo "<br><a href=\"javascript:build(build1,1,0);\"><font color=#0000ff>Строить (+$t_build)</font></a>";
if ($ab[1]>0) echo "<br>До завершения постройки: ".$ab[1]." дней <br> <a href=\"javascript:build(build1,1,1);\">Отмена </a>";
?>
</div>
</td>
<td align=center><b>Приоритет</b><br><br>
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

<tr><td colspan=5 height=5 <?=$paramhead?>>Командный центр</td></tr>

<tr valign=top>
<td><img src=pics/unit2.jpg border=1></td>
<td><?=$name[2]?></td><td><?=$price[2]?></td>
<td>Уровень: <b><?=$lvl[2]?></b>
<br>
<div id="build2" style="border:0px solid #000; padding:0px">
<?
$i=2;
if ($ab[2]==0) echo "<br><a href=\"javascript:build(build2,2,0);\">Строить</a>";
if ($ab[2]==-1) echo "<br>Недостаточно ресурсов для модернизации здания";
if ($ab[2]>0) echo "<br>До завершения постройки : ".$ab[2]." дней<br> <a href=\"javascript:build(build2,2,1);\">Отмена</a>"; ?>
</div>
</td>
<td align=center><b>Приоритет</b><br><br>
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

<tr><td colspan=5 height=5 <?=$paramhead?>>Производственные здания</td></tr>

<? for ($i=3;$i<=31;$i++)
{
if ($i==11) $i=31;

   if ($i!=31 || $lvl[9]>=1) {
   if ($i!=9 || $lvl[8]>=5) {
   if ($i!=7 || ($lvl[8]>=1 && $lvl[6]>=1)) {
   if ($i!=10 || ($lvl[2]>=5 && $lvl[9]>=1)) {

?>

<tr valign=top>
<td><img src=pics/unit<?=$i?>.jpg border=1></td>
<td><?=$name[$i]?></td><td><?=$price[$i]?>
</td><td>Уровень: <b><?=$lvl[$i]?></b>
<br>
<div id="build<?=$i?>" style="border:0px solid #000; padding:0px">
<?
$contr=date("d")+date("m")*500-$wd_base*72-30+51*($wd_usern*$i+13);

if ($ab[$i]==0) echo "<br><a href=\"javascript:build(build$i,$i,0);\">Строить</a>";
if ($ab[$i]==-1) echo "<br>Недостаточно ресурсов для модернизации здания";
if ($ab[$i]==-2) echo "<br>Достигнут лимит. Усовершенствуйте комцентр.";
if ($ab[$i]>0) echo "<br>До завершения постройки: ".$ab[$i]." дней<br> <a href=\"javascript:build(build$i,$i,1);\">Отмена</a>"; ?>
</div>
</td>
<td align=center><b>Приоритет</b><br><br>
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

<? } } } } } ?>

<tr><td colspan=5 height=5 <?=$paramhead?>>Оборонительные структуры</td></tr>

<? for ($i=11;$i<=13;$i++) { ?>

<? if ($i!=12 || $lvl[11]>=1) { ?>
<? if ($i!=13 || ($lvl[12]>=5 && $lvl[8]>=5)) { ?>

<tr valign=top>
<td><img src=pics/unit<?=$i?>.jpg border=1></td>
<td><?=$name[$i]?></td><td><?=$price[$i]?>
</td><td>Уровень: <b><?=$lvl[$i]?></b>
<br>
<div id="build<?=$i?>" style="border:0px solid #000; padding:0px">
<?
$contr=date("d")+date("m")*500-$wd_base*72-30+51*($wd_usern*$i+13);

if ($ab[$i]==0) echo "<br><a href=\"javascript:build(build$i,$i,0);\">Строить</a>";
if ($ab[$i]==-1) echo "<br>Недостаточно ресурсов для модернизации здания";
if ($ab[$i]==-2) echo "<br>Достигнут лимит. Усовершенствуйте комцентр.";
if ($ab[$i]>0) echo "<br>До завершения постройки: ".$ab[$i]." дней<br> <a href=\"javascript:build(build$i,$i,1);\">Отмена</a>"; ?>
</div>
</td>
<td align=center><b>Приоритет</b><br><br>
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

<? } } } ?>

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