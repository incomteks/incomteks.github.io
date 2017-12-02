<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_base)) {
	
define('QST','hod');
include "quests.php";

if ($lvl[10]>=1) {
if ($lvl[30]>=1) {
if ($t_hod>0) {

echo "<center>";

if ($start=="Пуск!")
{
echo "Прогрев двигателей...<br>";
echo "Анализ цели...<br>";
if (isset($hodx)) $hodx=intval($hodx);
if (isset($hody)) $hody=intval($hody);
if ($hodx<1 || $hodx>$dune_x || $hody<1 || $hody>$dune_y ) echo "Отмена пуска. Ошибка задания координат цели.<br>";
else if ($hodx==75 && $hody==100) echo "Невозможно атаковать цель, атакуемая база создает сильные помехи системе наведения. Пуск отменен.<br>";
else if ($hodx==89 && $hody==30) echo "Невозможно атаковать цель, атакуемая база создает сильные помехи системе наведения. Пуск отменен... Навсегда...<br>";

else
{

$res=mysql_query("select * from `base` where `x`='$hodx' and `y`='$hody'");
if (mysql_num_rows($res)==1)
{
$up=mysql_result($res,0,'up');
$res=mysql_query("select * from `wduser` where `n`='$up'");
$status=mysql_result($res,0,'status');
}

if ($status>0) echo "Невозможно атаковать цель, игрок находится в режиме отпуска. Атака невозможна еще <b>$status</b> игровых дней. Пуск отменен.<br>";
else
{


$res=mysql_query("select * from `base` where `n`='$wd_base'");
$basex=mysql_result($res,0,'x');
$basey=mysql_result($res,0,'y');

$mes="Внимание, из квадрата [$basex:$basey] игороком $wd_username  была произведена ракетная атака по квадрату [$hodx:$hody]. Время полета ракеты 5 дней.";
log_(42,"$basex:$basey");
$resu=mysql_query("select * from `wduser`");

for ($ii=0;$ii<mysql_num_rows($resu);$ii++)
{
$n=mysql_result($resu,$ii,'n');
inform(0,$n,$mes);
}

echo "<b>Ракета успешно запущена с базы [$basex:$basey] в квадрат [$hodx:$hody].</b><br>";

$lvl[30]=$lvl[30]-1;
$hod_left=$lvl[30];

mysql_query("insert into `hod` values ('','$wd_usern','$hodx','$hody','5')");
mysql_query("update `base` set `hod`='$hod_left' where `n`='$wd_base'");

} } }


if ($lvl[30]>=1) {
?>

<br><b>Ракетная атака</b>
<form action=<?=$a?> method=post>
<table width=10% <?=$paramtable?>>
<tr valign=top align=center><td colspan=2>
координаты
</td></tr>

<tr valign=top align=center><td>
<input name=hodx>
</td><td>
<input name=hody>
</td></tr>

<tr valign=top align=center><td colspan=2>
<input type=submit name=start value=Пуск!>
</td></tr>

</table>
</form>
</center>
<?

} else echo "<br><br>ВЫ не умеете запускать ракеты, пожалуйста исследуйте эту науку в научном центре.";
} else echo "<br><br>Больше на этой базе нет ракет.";
} else echo "На этой базе нет построеных ракет Рука Смерти. ";
} else echo "Постройте дворец, чтобы получить доступ к супероружию. ";
}
include "footer.php";
?>