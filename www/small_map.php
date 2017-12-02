<?
extract($_GET);
extract($_POST);
if ($lvl[8]!=0)
{
echo "<table border=0 cellpadding=0 cellspacing=1 width=100 height=100 bordercolor=#e2a267>";
$scale=ceil($lvl[8]);
if ($scale>10) $scale=10;
for ($y1=$res_y+$scale;$y1>=$res_y-$scale;$y1--)
{
?><tr><?
for ($x1=$res_x-$scale;$x1<=$res_x+$scale;$x1++)
{
if(!$granica) {
echo "<td width=5 height=5";
if ($x1<=0) $x=$x1+$dune_x; 
else if ($x1>$dune_x) $x=$x1-$dune_x;
else $x=$x1;

if ($y1<=0) $y=$y1+$dune_y;
else if ($y1>$dune_y) $y=$y1-$dune_y;
else $y=$y1;
} else {
	$x=$x1;
	$y=$y1;
	if($x<=0 || $x>$dune_x || $y<=0 || $y>$dune_y) echo "<td width=5 height=5 bgcolor=#e2a267 ";
	else echo "<td width=5 height=5";
}

{
	
include "quests.php";

$res=mysql_query("select * from `base` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($res)==0) {
	if($granica && ($x<=0 || $x>$dune_x || $y<=0 || $y>$dune_y)) echo "";
	else echo " background=pics/map_sand.gif";
}
else
{
$up=mysql_result($res,0,'up');
$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uhome=@mysql_result($res2,0,'home');

if ($uhome==0) echo " background=pics/map_base_o.gif";
if ($uhome==4) echo " background=pics/map_base_p.gif";
if ($uhome==1) echo " background=pics/map_base_b.gif";
if ($uhome==2) echo " background=pics/map_base_g.gif";
if ($uhome==3) echo " background=pics/map_base_r.gif";

}


}
echo ">";


$res=mysql_query("select * from `army` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($res)==1)
{
$up=mysql_result($res,0,'up');
$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uhome=@mysql_result($res2,0,'home');

if ($uhome==0) echo "<img src=pics/map_army_o.gif width=5 height=5>";
if ($uhome==4) echo "<img src=pics/map_army_p.gif width=5 height=5>";
if ($uhome==1) echo "<img src=pics/map_army_b.gif width=5 height=5>";
if ($uhome==2) echo "<img src=pics/map_army_g.gif width=5 height=5>";
if ($uhome==3) echo "<img src=pics/map_army_r.gif width=5 height=5>";

}
else
if (mysql_num_rows($res)>1)
  //echo "<img src=pics/map_army_w.gif width=\"$arm_sw%\" height=\"$arm_sh%\">";
  echo "<img src=pics/map_army_w.gif width=5 height=5>";



echo "</td>";
}
?></tr><?
}


?>
</table>
<?
}
?>