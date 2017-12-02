<?
extract($_GET);
extract($_POST);
include "header.php";
define('QST','map');

?>
<script language=javascript>
var a=0;
var p=0;
function malert(s)
{
	if(p==1 && a==1) {
		a=0;
		p=0;
	}
	if(a==1 || p==1) alert(s);
}
</script>
<?
if (isset($wd_base))
{

if ($lvl[8]!=0)
{

$scale=ceil($lvl[8]);

if ($scale>10) $scale=10;
//if ($key=="full") $scale=50;

?>
<center>
Прилегающие к базе <b><?=$res_name?></b> территории (охват радара <?=$scale?>):<br><br>

<table border=0 cellpadding=0 cellspacing=1 bordercolor=#e2a267><?

for ($y1=$res_y+$scale;$y1>=$res_y-$scale;$y1--)
{
?><tr><?
for ($x1=$res_x-$scale;$x1<=$res_x+$scale;$x1++)
{

if(!$granica) {
echo "<td width=32 height=32";
if ($x1<=0) $x=$x1+$dune_x; 
else if ($x1>$dune_x) $x=$x1-$dune_x;
else $x=$x1;

if ($y1<=0) $y=$y1+$dune_y;
else if ($y1>$dune_y) $y=$y1-$dune_y;
else $y=$y1;
} else {
	$x=$x1;
	$y=$y1;
	if($x<=0 || $x>$dune_x || $y<=0 || $y>$dune_y) echo "<td width=32 height=32 bgcolor=#e2a267 ";
	else echo "<td width=32 height=32";
}

{
	
include "quests.php";

$res=mysql_query("select * from `base` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($res)==0) {
	if($x==-1 && $y==-1) {
		echo " background=pics/map_sand.gif title='[$x1:$y1]\nПустыня'";
	}
	else {
		if($granica && ($x<=0 || $x>$dune_x || $y<=0 || $y>$dune_y)) echo " title='Граница мира'";
		else echo " background=pics/map_sand.gif title='[$x:$y]\nПустыня'";
	}
}
else
{
$up=mysql_result($res,0,'up');
$name=mysql_result($res,0,'name');
$constr=mysql_result($res,0,'constr');

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uname=@mysql_result($res2,0,'login');
$al=@mysql_result($res2,0,'al');
$status=@mysql_result($res2,0,'status');

$delta=@mysql_result($res2,0,'act')-@mysql_result($res2,0,'reg');

$sd="";
if ($delta<1500)
{
$deft=1500-$delta;
$sd="Атака базы невозможна, это молодой игрок. $deft игровых дней до окончания статуса молодого игрока.";
}

$uhome=@mysql_result($res2,0,'home');

if ($al!="") $uname="[".$al."] ".$uname;

if ($status>0) $awaytext="Отпуск: $status игровых дней\n"; else $awaytext="";

if ($uhome==0) echo " background=pics/map_base_o.gif  title='[$x:$y]\n$awaytext $sd\n\n База фрименов $name \nИгрок: $uname\nуровень $constr' onclick=\"alert('[$x:$y]\\n$awaytext $sd\\n\\n База фрименов $name \\nИгрок: $uname\\nуровень $constr')\"";
if ($uhome==4) echo " background=pics/map_base_p.gif  title='[$x:$y]\n$awaytext $sd\n\n База Карину $name \nИгрок: $uname\nуровень $constr' onclick=\"alert('[$x:$y]\\n$awaytext $sd\\n\\n База Карину $name \\nИгрок: $uname\\nуровень $constr')\"";
if ($uhome==1) echo " background=pics/map_base_b.gif  title='[$x:$y]\n$awaytext $sd\n\n База Атрейдесов $name\nИгрок: $uname\nуровень $constr' onclick=\"alert('[$x:$y]\\n$awaytext $sd\\n\\n База Атрейдесов $name\\nИгрок: $uname\\nуровень $constr')\"";
if ($uhome==2) echo " background=pics/map_base_g.gif  title='[$x:$y]\n$awaytext $sd\n\n База Ордосов $name\nИгрок: $uname\nуровень $constr' onclick=\"alert('[$x:$y]\\n$awaytext $sd\\n\\n База Ордосов $name\\nИгрок: $uname\\nуровень $constr')\"";
if ($uhome==3) echo " background=pics/map_base_r.gif  title='[$x:$y]\n$awaytext $sd\n\n База Харконненов $name\nИгрок: $uname\nуровень $constr' onclick=\"alert('[$x:$y]\\n$awaytext $sd\\n\\n База Харконненов $name\\nИгрок: $uname\\nуровень $constr')\"";

}


}
echo ">";


$res=mysql_query("select * from `army` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($res)==1)
{
$up=mysql_result($res,0,'up');
$name=mysql_result($res,0,'name');
$wins=mysql_result($res,0,'wins');
$rang=round(mysql_result($res,0,'rang'),1);

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uname=@mysql_result($res2,0,'login');
$uhome=@mysql_result($res2,0,'home');
$al=@mysql_result($res2,0,'al');

if ($al!="") $uname="[".$al."] ".$uname;

if ($uhome==0) echo "<img src=pics/map_army_o.gif title='[$x:$y] \nАрмия фрименов $name \nИгрок: $uname\nранг $rang\nодержано побед: $wins' onclick=\"a=1;p=0;malert('[$x:$y] \\nАрмия фрименов $name \\nИгрок: $uname\\nранг $rang\\nодержано побед: $wins');\">";
if ($uhome==4) echo "<img src=pics/map_army_p.gif title='[$x:$y] \nАрмия Карину $name  \nИгрок: $uname\nранг $rang\nодержано побед: $wins' onclick=\"a=1;p=0;malert('[$x:$y] \\nАрмия Карину $name  \\nИгрок: $uname\\nранг $rang\\nодержано побед: $wins');\">";
if ($uhome==1) echo "<img src=pics/map_army_b.gif title='[$x:$y] \nАрмия Атрейдесов $name \nИгрок: $uname\nранг $rang\nодержано побед: $wins' onclick=\"a=1;p=0;malert('[$x:$y] \\nАрмия Атрейдесов $name \\nИгрок: $uname\\nранг $rang\\nодержано побед: $wins');\">";
if ($uhome==2) echo "<img src=pics/map_army_g.gif title='[$x:$y] \nАрмия Ордосов $name \nИгрок: $uname\nранг $rang\nодержано побед: $wins' onclick=\"a=1;p=0;malert('[$x:$y] \\nАрмия Ордосов $name \\nИгрок: $uname\\nранг $rang\\nодержано побед: $wins');\">";
if ($uhome==3) echo "<img src=pics/map_army_r.gif title='[$x:$y] \nАрмия Харконненов $name \nИгрок: $uname\nранг $rang\nодержано побед: $wins' onclick=\"a=1;p=0;malert('[$x:$y] \\nАрмия Харконненов $name \\nИгрок: $uname\\nранг $rang\\nодержано побед: $wins');\">";

}
else
if (mysql_num_rows($res)>1)
{
$qname="";
$qSname="";

for ($i=0;$i<mysql_num_rows($res);$i++) 
{

$qname.=$name=mysql_result($res,$i,'name');
$qSname.=$name=mysql_result($res,$i,'name');

if($i!=mysql_num_rows($res)-1) $qname.="\n";
if($i!=mysql_num_rows($res)-1) $qSname.="\\n";
}

echo "<img src=pics/map_army_w.gif title='[$x:$y]\n В квадрате армии:\n$qname' onclick=\"a=1;p=0;malert('[$x:$y]\\n В квадрате армии:\\n$qSname')\">";
}



echo "</td>";
}
?></tr><?
}


?>
</table>
</center>
<br><br>
На карте выведены только квадраты, находящиеся в зоне действия радаров выбранной базы. <br>Модернизируйте научный центр, чтобы усилить мощность радаров, каждый уровень увеличит зону охвата на 1. Максимальная зона охвата 10;
<br><br>
*наведите курсор мышки на квадрат, чтобы получить подсказку.
<?
log_(18,1);
} else echo "Постройте Научный центр, чтобы получить возможность просматривать карту.";
} 

include "footer.php";
?>