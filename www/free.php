<?
/*
include "connect.php";

$x=57;
$y=35;

$res=mysql_query("select * from `army` where `up`='6' and `x`='$x' and `y`='$y' order by `n`");
$max=@mysql_num_rows($res);

for ($i=22;$i<=29;$i++) $aa[$i]=0;

for ($i=0;$i<$max;$i++)
{

$aa[23]+=mysql_result($res,$i,'linf');
$aa[24]+=mysql_result($res,$i,'hinf');
$aa[25]+=mysql_result($res,$i,'tank');
$aa[26]+=mysql_result($res,$i,'rtank');
$aa[22]+=mysql_result($res,$i,'mobconst');

$aa[27]+=mysql_result($res,$i,'spec1');
$aa[28]+=mysql_result($res,$i,'spec2');
$aa[29]+=mysql_result($res,$i,'spec3');

}

mysql_query("delete from `army` where `up`='6' and `x`='$x' and `y`='$y'");
mysql_query("insert into `army` (`name`,`up`,`x`,`y`,`linf`,`hinf`,`tank`,`rtank`,`mobconst`,`spec1`,`spec2`,`spec3`) values  ('Армада','6','$x','$y','$aa[23]','$aa[24]','$aa[25]','$aa[26]','$aa[22]','$aa[27]','$aa[28]','$aa[29]')");

echo mysql_error();
echo "Freedom!";
*/
?>