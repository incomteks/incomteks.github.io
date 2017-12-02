<?
extract($_GET);
extract($_POST);
include "header.php";
define('QST','cosmo');
include "quests.php";

if (isset($wd_base))
{

if ($lvl[9]>=1)
{

$res=mysql_query("select * from `wduser` where `n`='$wd_usern'");
$status=mysql_result($res,0,'status');

if ($status==0) 
{ 

if (isset($mode) && isset($btn) && ($mode=="sendsend" && $btn=="Отправить"))
{

if (isset($armylinf)) $armylinf=intval($armylinf);
if (isset($armyhinf)) $armyhinf=intval($armyhinf);
if (isset($armytank)) $armytank=intval($armytank);
if (isset($armyrtank)) $armyrtank=intval($armyrtank);
if (isset($armystone)) $armystone=intval($armystone);
if (isset($armycred)) $armycred=intval($armycred);
if (isset($armyharv)) $armyharv=intval($armyharv);
if (isset($armymobconst)) $armymobconst=intval($armymobconst);

//############################################################################
if ($armylinf+$armyhinf+$armytank+$armyrtank+$armystone+$armycred+$armyharv+$armymobconst>0)
{
if (isset($armydst)) $armydst=intval($armydst);
$res=mysql_query("select * from `base` where `n`='$armydst' and `cosmo`>0");
$up=mysql_result($res,0,'up');
$res2=mysql_query("select * from `wduser` where `n`='$up'");
$hm=mysql_result($res2,0,'home');

if (($hm==$wd_home) || ($wd_home==4))
{
if (mysql_num_rows($res)==1)
{

if ($armycred<0) $armycred=0;
if ($armystone<0) $armystone=0;

if ($armycred>$res_cred) $armycred=$res_cred;
if ($armystone>$res_stone) $armystone=$res_stone;

$upup=mysql_result($res,0,'up');

$xx=mysql_result($res,0,'x');
$yy=mysql_result($res,0,'y');

$dleft=ceil(20/$lvl[9]);

$linf_left=$lvl[23]-$armylinf;
$hinf_left=$lvl[24]-$armyhinf;
$tank_left=$lvl[25]-$armytank;
$rtank_left=$lvl[26]-$armyrtank;

$harv_left=$lvl[21]-$armyharv;
$mobconst_left=$lvl[22]-$armymobconst;

if ($linf_left>=0 && $hinf_left>=0 && $tank_left>=0 && $rtank_left>=0 && $harv_left>=0 && $mobconst_left>=0)
{
if ($armylinf>=0 && $armyhinf>=0 && $armytank>=0 && $armyrtank>=0 && $armyharv>=0 && $armymobconst>=0)
{

$stone_left=$res_stone-$armystone;

$cred_summ1=$armycred+($armyharv*300);
$cred_summ2=$armylinf*100+$armyhinf*250+$armytank*3000+$armyrtank*7500;

if($upup!=$wd_usern) $cred_left=$res_cred-$armycred-($cred_summ1*75 / 100);
else $cred_left=$res_cred-$armycred-($cred_summ2*25 / 100);

//if ($upup==$wd_usern) $cred_left=$res_cred-$armycred-($armylinf*5+$armyhinf*13+$armytank*150+$armyrtank*375+$armyharv*15+$armymobconst*500);
//else $cred_left=$res_cred-$armycred;

/**
 * Раскоментировать, чтобы включить пересылку ресурсов другим игрокам.
 if ((!(($armylinf+$armyhinf+$armytank+$armyrtank+$armymobconst>0) && ($upup!=$wd_usern))) || $wd_home==4)
 */
if ($upup==$wd_usern || $wd_home==4)
{


if ($cred_left>=0)
{
//echo "X=$x Y=$y ";

$rest=mysql_query("select * from `base` where `x`='$xx' and `y`='$yy' and `cosmo`>'0'");
$t=mysql_num_rows($rest);
if ($t==1)
{
$tup=mysql_result($rest,0,'up');

setactiv($wd_usern);

mysql_query("update base set `hinf`='$hinf_left',`linf`='$linf_left',`tank`='$tank_left',`rtank`='$rtank_left',`harv`='$harv_left',`mobconst`='$mobconst_left',`cred`='$cred_left',`stone`='$stone_left' where `up`='$wd_usern' and `n`='$wd_base' ");

mysql_query("insert into `space` (`up`,`x`,`y`,`stone`,`cred`,`linf`,`hinf`,`tank`,`rtank`,`harv`,`mobconst`,`dleft`,`fx`,`fy`,`tup`) values ('$wd_usern','$xx','$yy','$armystone','$armycred','$armylinf','$armyhinf','$armytank','$armyrtank','$armyharv','$armymobconst','$dleft','$res_x','$res_y','$tup')");

echo "Груз успешно отправлен.";
log_(23,"$xx:$yy:$armystone:$armycred:$armylinf:$armyhinf:$armytank:$armyrtank:$armyharv:$armymobconst:$dleft");
//###############   ДЛЯ КВЕСТА 2   ###############
if(isset($destme)){
	echo "Внимание, обнаружен запуск челнока с заброшенной базы!<br>Император заметил этот запуск и приказал своим диверсантам немедленно уничтожить базу! <br>Сожалею, но мы не успели ничего спасти, Вы потеряли эту базу.<br>Однако наш челнок улетел, и будет доставлен в точку назначения!";
	mysql_query("DELETE FROM `base` WHERE `n`='$wd_base'");
	include "footer.php";
	die();
}
//###############   ДЛЯ КВЕСТА 2   ###############
?><script>window.location.href="spaceport.php?mode=view";</script><?

} else echo "На заданных координатах больше нет базы с космопортом";

} else echo "Количество кредитов на базе недостаточно для отправки выбранного количества техники. Вам не хватает ".abs($cred_left)." кредитов.";

} else echo "Передача войск и МКЦ другим игрокам в этом раунде запрещена.";

} else echo "Ошибка! Некорректное количество посылаемой техники: введено отрицательное значение. Обновите страницу, чтобы повторить попытку.";
} else echo "Ошибка! Вы пытаетесь послать больше техники чем у вас есть. Обновите страницу, чтобы повторить попытку.";
 
} else echo mysql_error();

} else echo "Данная база не принадлежит вашему дому";

} else echo "Некорректное задание данных отправки...";
} 
else
{

?>

<table width=100%>
<tr valign=top><td width=5%><img src=pics/unit9.jpg border=1></td><td>
<b>Космопорт</b>
<br><br>
Помните, что пилоты грузовых кораблей берут за доставку <b> 75% общей стоимости при отправке груза на чужую базу</b><br><br>
<br>При отправке груза на свои базы, налог на войска - 25%. Передача войск и МКЦ другим игрокам запрещена.
</td></tr></table>

<form action=<?=$a?> method=post>
<center>
<table <?=$paramtable?>>

<tr><td colspan=2 <?=$paramhead?>>Отправка ресурсов и войск</td></tr>

<tr><td>Пункт назначения</td>
<td><select name=armydst>
<?
$res=mysql_query("select * from `base` where `up`='$wd_usern' and `cosmo`>0 and `n`!='$wd_base'");
$max=mysql_num_rows($res);

for ($i=0;$i<$max;$i++) 
{
$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'name');
$x=mysql_result($res,$i,'x');
$y=mysql_result($res,$i,'y');

echo "<option value=$n>Ваша база '$name' [$x:$y]</option>";
}


/**
 * Раскоментировать, чтобы включить пересылку ресурсов другим игрокам.
 *

$res=mysql_query("select * from `base` where `up`!='$wd_usern' and `cosmo`>0 order by `name`");
$max=mysql_num_rows($res);

for ($i=0;$i<$max;$i++) 
{
$n=mysql_result($res,$i,'n');
$up=mysql_result($res,$i,'up');
$name=mysql_result($res,$i,'name');
$x=mysql_result($res,$i,'x');
$y=mysql_result($res,$i,'y');

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uname=mysql_result($res2,0,'login');
$uhome=mysql_result($res2,0,'home');

if ($uhome=='4' || $uhome==$wd_home || $wd_home=='4')
{
$al=@mysql_result($res2,0,'al');

if ($al!="") $uname="[".$al."] ".$uname;

if ($uhome==1) $uhome="Атрейдес";
if ($uhome==2) $uhome="Ордос";
if ($uhome==3) $uhome="Харконнен";
if ($uhome==4) $uhome="Император";

echo "<option value=$n>[$x:$y] $uhome база '$name', игрок $uname</option>";
}
}
*/
?>
</select></td>
</tr>


<tr><td>Гранит</td>
<td><input name=armystone value=0> всего на базе: <?=$res_stone?></td></tr>

<tr><td>Кредиты</td>
<td><input name=armycred value=0> всего на базе: <?=$res_cred?></td></tr>

<tr><td>Легкая пехота</td>
<td><input name=armylinf value=0> всего на базе: <?=$lvl[23]?></td></tr>

<tr><td>Тяжелая пехота</td>
<td><input name=armyhinf value=0> всего на базе: <?=$lvl[24]?></td></tr>

<tr><td>Танки</td>
<td><input name=armytank value=0> всего на базе: <?=$lvl[25]?></td></tr>

<tr><td>Ракетные танки</td>
<td><input name=armyrtank value=0> всего на базе: <?=$lvl[26]?></td></tr>

<tr><td>Харвестеры</td>
<td><input name=armyharv value=0> всего на базе: <?=$lvl[21]?></td></tr>

<tr><td>МКЦ</td>
<td><input name=armymobconst value=0> всего на базе: <?=$lvl[22]?></td></tr>

<tr><td colspan=2><input type=hidden name=mode value=sendsend><input type=submit name=btn value='Отправить'></td></tr>

</table>
</center>
</form>

<table width=100% <?=$paramtable?>>
<tr>
<td <?=$paramhead?> colspan=10>Отправленные вашими космопортами грузы</td>
</tr>

<tr>
<td <?=$paramhead?> width=10%>Пункт назначения</td>
<td <?=$paramhead?> width=10%>Дней до прибытия</td>
<td <?=$paramhead?> width=10%>Гранит</td>
<td <?=$paramhead?> width=10%>Кредиты</td>
<td <?=$paramhead?> width=10%>Легкая пехота</td>
<td <?=$paramhead?> width=10%>Тяжелая пехота</td>
<td <?=$paramhead?> width=10%>Танки</td>
<td <?=$paramhead?> width=10%>Ракетные танки</td>
<td <?=$paramhead?> width=10%>Харвестеры</td>
<td <?=$paramhead?> width=10%>МКЦ</td>
</tr>

<?

$res=mysql_query("select * from `space` where `up`='$wd_usern'");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$x=mysql_result($res,$i,'x');
$y=mysql_result($res,$i,'y');

$stone=mysql_result($res,$i,'stone');
$cred=mysql_result($res,$i,'cred');
$linf=mysql_result($res,$i,'linf');
$hinf=mysql_result($res,$i,'hinf');
$tank=mysql_result($res,$i,'tank');
$rtank=mysql_result($res,$i,'rtank');
$harv=mysql_result($res,$i,'harv');
$mobconst=mysql_result($res,$i,'mobconst');
$dleft=mysql_result($res,$i,'dleft');


echo "<tr><td>[$x:$y]</td> <td>$dleft</td> <td>$stone</td> <td>$cred</td> <td>$linf</td> <td>$hinf</td> <td>$tank</td> <td>$rtank</td> <td>$harv</td> <td>$mobconst</td></tr>";
}
?>

</table>


<?

}

} else echo "Вы не можете пользоваться космопортом в режиме отпуска.";
} else echo "На этой базе пока нет космопорта. Постройте его, чтобы иметь возможность посылать и принимать грузы с орбиты. Для постройки космопорта необходим научный центр пятого уровня.";
}
include "footer.php";
?>