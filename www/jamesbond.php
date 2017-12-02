<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_base))
{

if ($t_spy>=1)
{
if ($res_cred>=5000)
{
?>

<table width=100%>
<tr valign=top><td width=5%><img src=pics/tech8.jpg border=1></td><td>
<b>Шпионаж</b>
<br><br>
Для проверения операции шпионажа необходимо знать точные координаты базы или армии противника.
<br><br>
На подготовку и проведение каждой операции необходимо 5000 кредитов.
</td></tr></table>

<form action=<?=$a?> method=post>
<table <?=$paramtable?>>
<tr valign=top align=center><td>
введите координаты цели: </td><td>
<input name=hodx>
</td><td>
<input name=hody>
</td><td>
<input type=submit name=start value='Начать операцию'>
</td></tr>

</table>
</form>

<?



if (isset($start) && ($start=="Начать операцию"))
{
echo "<br><br>Операция начата. Квадрат [$hodx:$hody]<br><br>";

if ($hodx<1 || $hodx>$dune_x || $hody<1 || $hody>$dune_y ) echo "Операция невозможна. Ошибка задания координат.<br>";
else if ($hodx==75 && $hody==100) echo "Проведение операции шпионажа на главную базу императора невозможно.<br>";
else
{
setactiv($wd_usern);
log_("17","$hodx:$hody");

$res2=mysql_query("select * from `base` where `x`='$hodx' and `y`='$hody'");
if (@mysql_num_rows($res2)==0) echo "В заданном квадрате нет ни одной базы.<br><br>";
else 
{
$j=0;

$up2=mysql_result($res2,$j,'up');
$name2=mysql_result($res2,$j,'name');

	$res3=mysql_query("select login from `wduser` where `n`='$up2'");
	$enemy=@mysql_result($res3,0,'login');

$constr=mysql_result($res2,$j,'constr');
$bar=mysql_result($res2,$j,'bar');
$fact=mysql_result($res2,$j,'fact');
$cosmo=mysql_result($res2,$j,'cosmo');

$cred=mysql_result($res2,$j,'cred');
$stone=mysql_result($res2,$j,'stone');

$wall=mysql_result($res2,$j,'wall');
$tower=mysql_result($res2,$j,'tower');
$rtower=mysql_result($res2,$j,'rtower');

$harv=mysql_result($res2,$j,'harv');

$linf=mysql_result($res2,$j,'linf');
$hinf=mysql_result($res2,$j,'hinf');

$tank=mysql_result($res2,$j,'tank');
$rtank=mysql_result($res2,$j,'rtank');

$palace=mysql_result($res2,$j,'palace');
$hod=mysql_result($res2,$j,'hod');

echo "Обнаружена база: <b>$name2</b><br>
База принадлежит игроку: <b>$enemy</b><br>
<b>Ресурсы:</b><br>
Запас гранита: <b>$stone</b><br>
Кредиты: <b>$cred</b><br>
<b>Стратегические строения:</b><br>
Командный центр: <b>$constr</b><br>
Казармы: <b>$bar</b><br>
Фабрики: <b>$fact</b><br>
Космопорт: <b>$cosmo</b><br>
Дворец: <b>$palace</b><br>
Ракеты Рука Смерти: <b>$hod</b><br>
<b>Оборонительные сооружения:</b><br>
Защитная стена: <b>$wall</b><br>
Башни: <b>$tower</b><br>
Ракетные башни: <b>$rtower</b><br>
<b>Гражданская техника:</b><br>
Харвестеры: <b>$harv</b><br>
<b>Гарнизон:</b><br>
Пехота: <b>$linf</b><br>
Тяжелая пехота: <b>$hinf</b><br>
Танки: <b>$tank</b><br>
Ракетные танки: <b>$rtank</b><br><br>
";

}





$res2=mysql_query("select * from `army` where `x`='$hodx' and `y`='$hody'");
if (@mysql_num_rows($res2)==0) echo "В квадрате армий не обнаружено.<br><br>";
else 
{
for ($j=0;$j<mysql_num_rows($res2);$j++)
{
$up2=mysql_result($res2,$j,'up');
$name2=mysql_result($res2,$j,'name');

	$res3=mysql_query("select login from `wduser` where `n`='$up2'");
	$enemy=@mysql_result($res3,0,'login');

$mobconst=mysql_result($res2,$j,'mobconst');

$linf=mysql_result($res2,$j,'linf');
$hinf=mysql_result($res2,$j,'hinf');

$tank=mysql_result($res2,$j,'tank');
$rtank=mysql_result($res2,$j,'rtank');

echo "Обнаружена армия: <b>$name2</b> игрока: <b>$enemy</b><br>
МКЦ: <b>$mobconst</b><br>
Легкая пехота: <b>$linf</b><br>
Тяжелая пехота: <b>$hinf</b><br>
Танки: <b>$tank</b><br>
Ракетные танки: <b>$rtank</b><br><br>
";

} }









echo "<b>Операция прошла успешно.</b><br>";

$hod_left=$res_cred-5000;
mysql_query("update `base` set `cred`='$hod_left' where `n`='$wd_base' and `up`='$wd_usern'");
} } 




} else echo "У вас недостаточно средств для проведения операции шпионажа. Стоимость операции 5000 кредитов.";
} else echo "Вам необходимо исследовать технологию шпионажа, чтобы получить возможность шпионить за другими игроками.";
}
include "footer.php";
?>