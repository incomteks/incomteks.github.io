<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_base))
{
	?>
	<center><b>Статистика баз</b></center><hr>
<table width=100% <?=$paramtable?>>
<tr><th>Строения</th><th><img width=25 height=25 src='pics/unit1.jpg' title='Строительный фундамент'></th><th><img width=25 height=25 src='pics/unit2.jpg' title='Командный центр'></th><th><img width=25 height=25 src='pics/unit3.jpg' title='Ветряная энергоустановка'></th><th><img width=25 height=25 src='pics/unit4.jpg' title='Завод по переработке спайса'></th><th><img width=25 height=25 src='pics/unit5.jpg' title='Спайс-силос'></th><th><img width=25 height=25 src='pics/unit6.jpg' title='Казармы'></th><th><img width=25 height=25 src='pics/unit7.jpg' title='Фабрика тяжелой техники'></th><th><img width=25 height=25 src='pics/unit8.jpg' title='Научный центр'></th><th><img width=25 height=25 src='pics/unit9.jpg' title='Космопорт'></th><th><img width=25 height=25 src='pics/unit10.jpg' title='Дворец'></th><th><img width=25 height=25 src='pics/unit31.jpg' title='Представительство Торговой Гильдии'><th><img width=25 height=25 src='pics/unit11.jpg' title='Защитная стена'></th><th><img width=25 height=25 src='pics/unit12.jpg' title='Оборонительные турели'></th><th><img width=25 height=25 src='pics/unit13.jpg' title='Ракетные турели'></th></th></tr>
	<?
	$res=mysql_query("SELECT * FROM `base` WHERE `up`='$wd_usern' ORDER BY `n`");
	if(@mysql_num_rows($res)>0) while($r=mysql_fetch_array($res)){
		$bname=$r['name'];
		$bn=$r['n'];
		$energy=5+$r['wind']*5;
		$bx=$r['x'];
		$by=$r['y'];
		$credi=$r['cred'];
		$gran=$r['stone'];
		$spice=$r['spice'];
		$harv=$r['harv'];
		$type[1]=$r['place'];
		$type[2]=$r['constr'];
    $type[3]=$r['wind'];
		$type[4]=$r['refin'];
		$type[5]=$r['silo'];
		$type[6]=$r['bar'];
		$type[7]=$r['fact'];
		$type[8]=$r['tech'];
		$type[9]=$r['cosmo'];
		$type[10]=$r['palace'];
		$type[11]=$r['wall'];
		$type[12]=$r['tower'];
		$type[13]=$r['rtower'];
		$type[31]=$r['trade'];
		
		$maxh=$type[2]*10;
		$scap=500+$type[5]*500;
		$sum_e=$type[31]+$type[2];
		for($i=4;$i<=10;$i++) $sum_e=$sum_e+$type[$i];
		$sum_e=$sum_e+$type[12]+$type[13];
		echo "<tr><td colspan=15 align=left bgcolor=#e2a267><a href=?baseselect=1&basenumber=$bn><b>$bname"."[$bx:$by]</a>:<br> Энергия - </b>$sum_e/$energy<b>, Кредиты - </b>$credi<b>, Гранит - </b>$gran<b>, Спайс</b> - $spice/$scap<b>, Харвы - </b>$harv/$maxh</td></tr>";
		echo "<tr align=center><td bgcolor=#e2a267>Уровень<a href='#desc'>*</a></td>";
		for($i=1;$i<=14;$i++){
			$m=$i;
			if($i==11) $m=31;
			if($i>11) $m=$i-1;
			$rb=mysql_query("SELECT * FROM `bild` WHERE `base`='$bn' AND `struct`='$m'");
			if(@mysql_num_rows($rb)>0) $dleft=mysql_result($rb,0,'dleft'); else $dleft=0;
			if($dleft>0) $font="<font color=blue>";
			else {
				if($credi< $cred[$m] || $gran< $stone[$m] || $type[1]< $site[$m]) $font="<font color=red>";
				else $font="<font color=green>";
			}
			echo "<td bgcolor=#e2a267>$font".$type[$m]."</font></td>";
		}
		echo "</tr><tr align=center><td bgcolor=#e2a267>Окончание стр-ва через (дн.)</td>";
		for($i=1;$i<=14;$i++){
			$m=$i;
			if($i==11) $m=31;
			if($i>11) $m=$i-1;
			$rb=mysql_query("SELECT * FROM `bild` WHERE `base`='$bn' AND `struct`='$m'");
			if(@mysql_num_rows($rb)>0) $dleft=mysql_result($rb,0,'dleft'); else $dleft=0;
			echo "<td bgcolor=#e2a267>$dleft</td>";
		}
		echo "</tr><tr><td colspan=15>&nbsp;</td></tr>";
	}
	?>
  <tr align=center><td><b>Строения</b></td><td><img width=25 height=25 src='pics/unit1.jpg' title='Строительный фундамент'></td><td><img width=25 height=25 src='pics/unit2.jpg' title='Командный центр'></td><td><img width=25 height=25 src='pics/unit3.jpg' title='Ветряная энергоустановка'></td><td><img width=25 height=25 src='pics/unit4.jpg' title='Завод по переработке спайса'></td><td><img width=25 height=25 src='pics/unit5.jpg' title='Спайс-силос'></td><td><img width=25 height=25 src='pics/unit6.jpg' title='Казармы'></td><td><img width=25 height=25 src='pics/unit7.jpg' title='Фабрика тяжелой техники'></td><td><img width=25 height=25 src='pics/unit8.jpg' title='Научный центр'></td><td><img width=25 height=25 src='pics/unit9.jpg' title='Космопорт'></td><td><img width=25 height=25 src='pics/unit10.jpg' title='Дворец'></td><td><img width=25 height=25 src='pics/unit31.jpg' title='Представительство Торговой Гильдии'><td><img width=25 height=25 src='pics/unit11.jpg' title='Защитная стена'></td><td><img width=25 height=25 src='pics/unit12.jpg' title='Оборонительные турели'></td><td><img width=25 height=25 src='pics/unit13.jpg' title='Ракетные турели'></td></td></tr>
  </table>
  <a name=desc></a> * Текущий уровень обозначается цветами:<br>
  <font color=blue>Синий</font> - Идет постройка<br><font color=green>Зеленый</font> - 
  Строить можно, ресурсов хватает<br><font color=red>Красный</font> - Недостаточно ресурсов
  для постройки<br><br><br><br>
  
<center><b>Статистика гарнизонов</b></center><hr>
<table width=100% <?=$paramtable?>>
<tr align=center>
<td <?=$paramhead?>>Гарнизон</td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit23.jpg border=1 alt='Легкая пехота'></td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit24.jpg border=1 alt='Тяжелая пехота'></td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit25.jpg border=1 alt='Танк'></td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit26.jpg border=1 alt='Ракетный танк'></td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit22.jpg border=1 alt='ПКЦ'></td>
<td <?=$paramhead2?>><b>Стоимость<b></td>

</tr>
<?
$res1=mysql_query("SELECT SUM(linf) as sl,SUM(hinf) as sh, SUM(tank) as st,SUM(rtank) as srt,SUM(mobconst) as sm FROM `base` WHERE `up`='$wd_usern'");
$sl=mysql_result($res1,0,'sl');
$sh=mysql_result($res1,0,'sh');
$st=mysql_result($res1,0,'st');
$srt=mysql_result($res1,0,'srt');
$sm=mysql_result($res1,0,'sm');
$costa=$sl*$cred[23]+$sh*$cred[24]+$st*$cred[25]+$srt*$cred[26]+$sm*$cred[22];
  $res=mysql_query("SELECT * FROM `base` WHERE `up`='$wd_usern' ORDER BY `n`");
  $max=intval(@mysql_num_rows($res));
  for($ii=0;$ii<$max;$ii++) {
$lp=mysql_result($res,$ii,'linf');
$tp=mysql_result($res,$ii,'hinf');
$t=mysql_result($res,$ii,'tank');
$rt=mysql_result($res,$ii,'rtank');
$sd=mysql_result($res,$ii,'spec1');
$dv=mysql_result($res,$ii,'spec2');
$fr=mysql_result($res,$ii,'spec3');
$mkc=mysql_result($res,$ii,'mobconst');
$costbase=$lp*$cred[23]+$tp*$cred[24]+$t*$cred[25]+$rt*$cred[26]+$mkc*$cred[22];
$bname=mysql_result($res,$ii,'name');
?>
<tr align=center>
<td bgcolor=#e2a267 align=left>Гарнизон базы <b><?=$bname?></b>
<?
if ($sd>0) echo "<br>Саудукары: ".$sd;
if ($dv>0) echo "<br>Разрушители: ".$dv;
if ($fr>0) echo "<br>Фримены: ".$fr;
?>
</td>
<td bgcolor=#e2a267><b><?=$lp?></b></td>
<td bgcolor=#e2a267><b><?=$tp?></b></td>
<td bgcolor=#e2a267><b><?=$t?></b></td>
<td bgcolor=#e2a267><b><?=$rt?></b></td>
<td bgcolor=#e2a267><b><?=$mkc?></b></td>
<td bgcolor=#e2a267 align=right><b><?=$costbase?></b></td>

</tr>
<? } ?>
<tr align=center>
<td bgcolor=#e2a267 align=left><font color=blue><b>Итого</b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$sl?></b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$sh?></b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$st?></b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$srt?></b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$sm?></b></font></td>
<td bgcolor=#e2a267 align=right><font color=blue><b><?=$costa?></b></font></td>

</table>
<br><br><br><br>
<center><b>Статистика армий</b></center><hr>
<table width=100% <?=$paramtable?>>
<tr align=center>
<td <?=$paramhead?>>Армия</td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit23.jpg border=1 alt='Легкая пехота'></td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit24.jpg border=1 alt='Тяжелая пехота'></td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit25.jpg border=1 alt='Танк'></td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit26.jpg border=1 alt='Ракетный танк'></td>
<td <?=$paramhead2?>><img width=30 height=30 src=pics/sm/unit22.jpg border=1 alt='ПКЦ'></td>
<td <?=$paramhead2?>><b>Стоимость<b></td>

</tr>
<?
$res=mysql_query("SELECT * FROM `army` WHERE `up`='$wd_usern'");
if(@mysql_num_rows($res)>0) {
$res1=mysql_query("SELECT SUM(linf) as sl,SUM(hinf) as sh, SUM(tank) as st,SUM(rtank) as srt,SUM(mobconst) as sm FROM `army` WHERE `up`='$wd_usern'");
$sl=mysql_result($res1,0,'sl');
$sh=mysql_result($res1,0,'sh');
$st=mysql_result($res1,0,'st');
$srt=mysql_result($res1,0,'srt');
$sm=mysql_result($res1,0,'sm');
$costa=$sl*$cred[23]+$sh*$cred[24]+$st*$cred[25]+$srt*$cred[26]+$sm*$cred[22];

$res=mysql_query("SELECT * FROM `army` WHERE `up`='$wd_usern'");
$max=intval(@mysql_num_rows($res));
for($ii=0;$ii<$max;$ii++) {
$lp=mysql_result($res,$ii,'linf');
$tp=mysql_result($res,$ii,'hinf');
$t=mysql_result($res,$ii,'tank');
$rt=mysql_result($res,$ii,'rtank');
$mkc=mysql_result($res,$ii,'mobconst');
$costbase=$lp*$cred[23]+$tp*$cred[24]+$t*$cred[25]+$rt*$cred[26]+$mkc*$cred[22];
$aname=mysql_result($res,$ii,'name');
$rang=mysql_result($res,$ii,'rang');
$wins=mysql_result($res,$ii,'wins');
?>
<tr align=center>
<td bgcolor=#e2a267 align=left><b><?=$aname?></b><br>Ранг: <?=$rang?><br>Победы: <?=$wins?></td>
<td bgcolor=#e2a267><b><?=$lp?></b></td>
<td bgcolor=#e2a267><b><?=$tp?></b></td>
<td bgcolor=#e2a267><b><?=$t?></b></td>
<td bgcolor=#e2a267><b><?=$rt?></b></td>
<td bgcolor=#e2a267><b><?=$mkc?></b></td>
<td bgcolor=#e2a267 align=right><b><?=$costbase?></b></td>

</tr>
<? } ?>
<tr align=center>
<td bgcolor=#e2a267 align=left><font color=blue><b>Итого</b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$sl?></b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$sh?></b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$st?></b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$srt?></b></font></td>
<td bgcolor=#e2a267><font color=blue><b><?=$sm?></b></font></td>
<td bgcolor=#e2a267 align=right><font color=blue><b><?=$costa?></b></font></td>

<?
}
echo "</table>";
}
include "footer.php";
?>
