<?
$sys_dbhost="localhost";
$sys_dbname="dune";   
$sys_dbuser="dune";   
$sys_dbpass="dunepass"; 

// ���������� � �������� MySQL   

if(!mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpass))    
{  
   echo "�� ���� ����������� � ����� !<br>";    
   echo mysql_error();   
   exit;    
}
// else echo "���������� � ����� ������ ������� !<br>";

mysql_select_db($sys_dbname);

$f=fopen("/home/www/dunefullmap.html","w+");

$date=date("Y-m-d H:i:s");
?>
<center>
������ ����� ���� �� <?=$date?>:<br><br>
<? fputs($f,"������ ����� ���� �� $date <br><br>"); ?>
<table width=3200 height=3200 border=0 cellpadding=0 cellspacing=0 bordercolor=#e2a267 background=pics/map_sand.gif>
<?

fputs($f,"<table width=3200 height=3200 border=0 cellpadding=0 cellspacing=0 bordercolor=#e2a267 background=pics/map_sand.gif>");


for ($y=100;$y>=1;$y--)
{
?><tr><?
fputs($f,"<tr>");

for ($x=1;$x<=100;$x++)
{
echo "<td width=32 height=32";
fputs($f,"<td width=32 height=32");

if ($x<=0 || $x>100 || $y<=0 || $y>100)
{
echo " bgcolor=#000000 ";
fputs($f," bgcolor=#000000 ");
}
else
{

$res=mysql_query("select * from `base` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($res)==0)
{
//echo " title='[$x:$y]\n�������'";
//fputs($f," background=pics/map_sand.gif title='[$x:$y]\n�������' ");
}
else
{
$up=mysql_result($res,0,'up');
$name=mysql_result($res,0,'name');
$constr=mysql_result($res,0,'constr');

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uname=@mysql_result($res2,0,'login');
$uhome=@mysql_result($res2,0,'home');

if ($uhome==0) fputs($f," background=pics/map_base_o.gif  title='[$x:$y]\n���� �������� $name' ");
if ($uhome==4) fputs($f," background=pics/map_base_p.gif  title='[$x:$y]\n���� ������ $name\n������� $constr' ");
if ($uhome==1) fputs($f," background=pics/map_base_b.gif  title='[$x:$y]\n���� ���������� $name\n�����: $uname\n������� $constr' ");
if ($uhome==2) fputs($f," background=pics/map_base_g.gif  title='[$x:$y]\n���� ������� $name\n�����: $uname\n������� $constr' ");
if ($uhome==3) fputs($f," background=pics/map_base_r.gif  title='[$x:$y]\n���� ����������� $name\n�����: $uname\n������� $constr' ");

if ($uhome==0) echo " background=pics/map_base_o.gif  title='[$x:$y]\n���� �������� $name' ";
if ($uhome==4) echo " background=pics/map_base_p.gif  title='[$x:$y]\n���� ������ $name\n������� $constr' ";
if ($uhome==1) echo " background=pics/map_base_b.gif  title='[$x:$y]\n���� ���������� $name\n�����: $uname\n������� $constr' ";
if ($uhome==2) echo " background=pics/map_base_g.gif  title='[$x:$y]\n���� ������� $name\n�����: $uname\n������� $constr' ";
if ($uhome==3) echo " background=pics/map_base_r.gif  title='[$x:$y]\n���� ����������� $name\n�����: $uname\n������� $constr' ";


}


}
echo ">";
fputs($f,">");

$res=mysql_query("select * from `army` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($res)==1)
{
$up=mysql_result($res,0,'up');
$name=mysql_result($res,0,'name');
$wins=mysql_result($res,0,'wins');

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uname=@mysql_result($res2,0,'login');
$uhome=@mysql_result($res2,0,'home');

if ($uhome==0) fputs($f,"<img src=pics/map_army_o.gif title='[$x:$y] \n����� �������� $name \n���� $wins' >");
if ($uhome==4) fputs($f,"<img src=pics/map_army_p.gif title='[$x:$y] \n����� ������ $name \n���� $wins' >");
if ($uhome==1) fputs($f,"<img src=pics/map_army_b.gif title='[$x:$y] \n����� ���������� $name \n�����: $uname\n���� $wins' >");
if ($uhome==2) fputs($f,"<img src=pics/map_army_g.gif title='[$x:$y] \n����� ������� $name \n�����: $uname\n���� $wins' >");
if ($uhome==3) fputs($f,"<img src=pics/map_army_r.gif title='[$x:$y] \n����� ����������� $name \n�����: $uname\n���� $wins'>");


if ($uhome==0) echo "<img src=pics/map_army_o.gif title='[$x:$y] \n����� �������� $name \n���� $wins' >";
if ($uhome==4) echo "<img src=pics/map_army_p.gif title='[$x:$y] \n����� ������ $name \n���� $wins' >";
if ($uhome==1) echo "<img src=pics/map_army_b.gif title='[$x:$y] \n����� ���������� $name \n�����: $uname\n���� $wins' >";
if ($uhome==2) echo "<img src=pics/map_army_g.gif title='[$x:$y] \n����� ������� $name \n�����: $uname\n���� $wins' >";
if ($uhome==3) echo "<img src=pics/map_army_r.gif title='[$x:$y] \n����� ����������� $name \n�����: $uname\n���� $wins'>";

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

echo "<img src=pics/map_army_w.gif title='[$x:$y]\n � �������� �����:\n$qname'>";
fputs($f,"<img src=pics/map_army_w.gif title='[$x:$y]\n � �������� �����:\n$qname'>");
}



echo "</td>";
fputs($f,"</td>");
}
?></tr><?
fputs($f,"</tr>");

}


?>
</table>
</center>
<br><br>
*�������� ������ ����� �� �������, ����� �������� ���������.

<?
fputs($f,"</table></center><br><br>*�������� ������ ����� �� �������, ����� �������� ���������.");

fclose($f);

// ���������� ����������
$res=mysql_query("select * from `day`");
$game_day=mysql_result($res,0,'n');
mysql_query("update `wduser` set `act`='$game_day'");

?>