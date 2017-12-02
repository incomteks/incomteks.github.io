<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_base))
{

if ($lvl[31]>=1)
{

$res=mysql_query("select * from `wduser` where `n`='$wd_usern'");
$status=mysql_result($res,0,'status');

if ($status==0) 
{ 

$price[1]=300*(1-$t_orb*0.1);
$price[2]=700*(1-$t_orb*0.1);
$price[3]=9000*(1-$t_orb*0.1);
$price[4]=20000*(1-$t_orb*0.1);

$price[5]=900*(1-$t_orb*0.1);
$price[6]=30000*(1-$t_orb*0.1);


if ($mode=="sendsend" && $btn=="Заказать")
{
if (isset($armylinf)) $armylinf=intval($armylinf);
if (isset($armyhinf)) $armyhinf=intval($armyhinf);
if (isset($armytank)) $armytank=intval($armytank);
if (isset($armyrtank)) $armyrtank=intval($armyrtank);
if (isset($armymobconst)) $armymobconst=intval($armymobconst);
//############################################################################
if (( $armylinf >0)||($armyhinf >0)||( $armytank >0)||( $armyrtank >0)||( $armyharv >0)||( $armymobconst >0))
{

if ($armylinf*$price[1]+$armyhinf*$price[2]+$armytank*$price[3]+$armyrtank*$price[4]+$armyharv*$price[5]+$armymobconst*$price[6]<=$res_cred)
{

$res=mysql_query("select * from `base` where `n`='$wd_base'");
if (mysql_num_rows($res)==1)
{

$xx=mysql_result($res,0,'x');
$yy=mysql_result($res,0,'y');

$dleft=1000-($lvl[31]-1)*40;

$x=mysql_query("insert into `trade` (`up`,`x`,`y`,`linf`,`hinf`,`tank`,`rtank`,`harv`,`mobconst`,`dleft`) values ('$wd_usern','$xx','$yy','$armylinf','$armyhinf','$armytank','$armyrtank','$armyharv','$armymobconst','$dleft')");

if ($x==1)
{
$cred_left=$res_cred-($armylinf*$price[1]+$armyhinf*$price[2]+$armytank*$price[3]+$armyrtank*$price[4]+$armyharv*$price[5]+$armymobconst*$price[6]);

$x2=mysql_query("update base set `cred`='$cred_left' where `up`='$wd_usern' and `n`='$wd_base' ");

if ($x2!=1) echo mysql_error();
else 
{
setactiv($wd_usern);
echo "Заказ оформлен.";
log_(25,"$armylinf:$armyhinf:$armytank:$armyrtank:$armyharv:$armymobconst");
?><script>window.location.href="trade.php?mode=view";</script><?
} 
} else echo mysql_error();
} else echo mysql_error();

} else echo "Извините, у вас недостаточно кредитов для такого заказа.";
} else echo "Невозможно выполнить нулевой заказ";


}
else
{

?>
<table width=100%>
<tr valign=top><td><img src=pics/unit31.jpg border=1></td><td>
<b>Представительство торговой гильдии</b><br><br>
<b>Стоимость войск</b> при заказе у торговой гильдии гораздо выше той, за которую Вы можете произвести технику или пехоту сами. Чтобы снизить стоимость покупки - исследуйте соответствующую технологию в научном центре.
<br><br>

<b>Время доставки</b> при первом уровне строения составит 1000 дней. Каждый следующий уровень уменьшит время доставки на 40 дней. Текущий уровень строения <?=$lvl[31]?>.
</td></tr></table>
<br>
<form action=<?=$a?> method=post>
<center>
<table <?=$paramtable?> width=50%>

<tr><td colspan=3 <?=$paramhead?>>Покупка техники и пехоты:</td></tr>

<tr><td>Легкая пехота</td>
<td><input name=armylinf value=0><td><?=$price[1]?> кредитов</td> 
</td></tr>

<tr><td>Тяжелая пехота</td>
<td><input name=armyhinf value=0><td><?=$price[2]?> кредитов</td>
</td></tr>

<tr><td>Танки</td>
<td><input name=armytank value=0><td><?=$price[3]?> кредитов</td>
</td></tr>

<tr><td>Ракетные танки</td>
<td><input name=armyrtank value=0><td><?=$price[4]?> кредитов</td>
</td></tr>

<tr><td>Харвестеры</td>
<td><input name=armyharv value=0><td><?=$price[5]?> кредитов</td>
</td></tr>

<tr><td>МКЦ</td>
<td><input name=armymobconst value=0><td><?=$price[6]?> кредитов</td>
</td></tr>

<tr><td colspan=3><input type=hidden name=mode value=sendsend><input type=submit name=btn value='Заказать'></td></tr>

</table>
</center>
</form>

<table width=100% <?=$paramtable?>>
<tr>
<td <?=$paramhead?> colspan=7>Ожидаемые заказы</td>
</tr>

<tr>
<!-- <td <?=$paramhead?> width=12%>Пункт назначения</td> -->
<td <?=$paramhead?> width=12%>Дней до доставки</td>
<td <?=$paramhead?> width=12%>Легкая пехота</td>
<td <?=$paramhead?> width=12%>Тяжелая пехота</td>
<td <?=$paramhead?> width=12%>Танки</td>
<td <?=$paramhead?> width=12%>Ракетные танки</td>
<td <?=$paramhead?> width=12%>Харвестеры</td>
<td <?=$paramhead?> width=12%>МКЦ</td>
</tr>

<?

$res=mysql_query("select * from `trade` where `up`='$wd_usern'");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$x=mysql_result($res,$i,'x');
$y=mysql_result($res,$i,'y');

$linf=mysql_result($res,$i,'linf');
$hinf=mysql_result($res,$i,'hinf');
$tank=mysql_result($res,$i,'tank');
$rtank=mysql_result($res,$i,'rtank');
$harv=mysql_result($res,$i,'harv');
$mobconst=mysql_result($res,$i,'mobconst');
$dleft=mysql_result($res,$i,'dleft');

echo "<tr><!-- <td>[$x:$y]</td> --> <td>$dleft</td> <td>$linf</td> <td>$hinf</td> <td>$tank</td> <td>$rtank</td> <td>$harv</td> <td>$mobconst</td></tr>";
}
echo "</table>";


}
} else echo "Доступ к представительству торговой гильдии в режиме отпуска закрыт.";
} else echo "На этой базе не построено представительство торговой гильдии. Для постройки необходим космопорт.";
}
include "footer.php";
?>