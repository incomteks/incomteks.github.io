<?
/*
include "header.php";

if (isset($wd_base))
{
if ($lvl[8]!=0)
{

$scale=ceil($lvl[8]);

if ($scale>10) $scale=10;
if ($key=="full") $scale=50;

?>
<center>
����������� � ���� <b><?=$res_name?></b> ���������� (����� ������ <?=$scale?>):<br><br>

<table border=0 cellpadding=0 cellspacing=1 bordercolor=#e2a267><?

for ($y=$res_y+$scale;$y>=$res_y-$scale;$y--)
{
?><tr><?
for ($x=$res_x-$scale;$x<=$res_x+$scale;$x++)
{
echo "<td width=32 height=32";

if ($x<=0 || $x>100 || $y<=0 || $y>100) echo " bgcolor=#000000 ";
else
{


$res=mysql_query("select * from `base` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($res)==0) echo " background=pics/map_sand.gif title='[$x:$y]\n�������'";
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
if ($delta<1000)
{
$deft=1000-$delta;
$sd="����� ���� ����������, ��� ������� �����. ������ �������� ������ ����� ��� $deft ������� ����.\n\n";
}

$uhome=@mysql_result($res2,0,'home');

if ($al!="") $uname="[".$al."] ".$uname;

if ($status>0) $awaytext="������: $status ������� ����\n";

if ($uhome==0) echo " background=pics/map_base_o.gif  title='[$x:$y]\n$awaytext $sd ���� �������� $name' ";
if ($uhome==4) echo " background=pics/map_base_p.gif  title='[$x:$y]\n$awaytext $sd ���� ������ $name \n�����: $uname\n������� $constr' ";
if ($uhome==1) echo " background=pics/map_base_b.gif  title='[$x:$y]\n$awaytext $sd ���� ���������� $name\n�����: $uname\n������� $constr' ";
if ($uhome==2) echo " background=pics/map_base_g.gif  title='[$x:$y]\n$awaytext $sd ���� ������� $name\n�����: $uname\n������� $constr' ";
if ($uhome==3) echo " background=pics/map_base_r.gif  title='[$x:$y]\n$awaytext $sd ���� ����������� $name\n�����: $uname\n������� $constr' ";

}


}
echo ">";


$res=mysql_query("select * from `army` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($res)==1)
{
$up=mysql_result($res,0,'up');
$name=mysql_result($res,0,'name');
$wins=mysql_result($res,0,'wins');

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uname=@mysql_result($res2,0,'login');
$uhome=@mysql_result($res2,0,'home');
$al=@mysql_result($res2,0,'al');

if ($al!="") $uname="[".$al."] ".$uname;

if ($uhome==0) echo "<img src=pics/map_army_o.gif alt='[$x:$y] \n����� �������� $name \n���� $wins' >";
if ($uhome==4) echo "<img src=pics/map_army_p.gif alt='[$x:$y] \n����� ������ $name  \n�����: $uname\n���� $wins' >";
if ($uhome==1) echo "<img src=pics/map_army_b.gif alt='[$x:$y] \n����� ���������� $name \n�����: $uname\n���� $wins' >";
if ($uhome==2) echo "<img src=pics/map_army_g.gif alt='[$x:$y] \n����� ������� $name \n�����: $uname\n���� $wins' >";
if ($uhome==3) echo "<img src=pics/map_army_r.gif alt='[$x:$y] \n����� ����������� $name \n�����: $uname\n���� $wins'>";

}
else
if (mysql_num_rows($res)>1)
{
$qname="";

for ($i=0;$i<mysql_num_rows($res);$i++) 
{

$qname.=$name=mysql_result($res,$i,'name');

if ($i!=mysql_num_rows($res)-1) $qname.="\n";
}

echo "<img src=pics/map_army_w.gif alt='[$x:$y]\n � �������� �����:\n$qname'>";
}



echo "</td>";
}
?></tr><?
}


?>
</table>
</center>
<br><br>
�� ����� �������� ������ ��������, ����������� � ���� �������� ������� ��������� ����. <br>�������������� ������� �����, ����� ������� �������� �������, ������ ������� �������� ���� ������ �� 1. ������������ ���� ������ 10;
<br><br>
*�������� ������ ����� �� �������, ����� �������� ���������.
<?

} else echo "��������� ������� �����, ����� �������� ����������� ������������� �����.";
} 

include "footer.php";
*/
?>