<?
function getmicrotime()
{
list($usec, $sec) = explode(" ",microtime());
return ((float)$usec + (float)$sec);
}

$TIME_START = getmicrotime();

$sys_dbhost="localhost";
$sys_dbname="dune";   
$sys_dbuser="db_user";   
$sys_dbpass="db1982anton"; 

mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpass);
mysql_select_db($sys_dbname);


for ($i=1;$i<=3;$i++)
{
$res=mysql_query("select * from `wduser` where `home`='$i'");
$max=mysql_num_rows($res);

for ($j=0;$j<$max;$j++)
{
$n=mysql_result($res,$j,'n');

$res2=mysql_query("select sum(constr) from `base` where `up`='$n'");
$sum[$i]+=mysql_result($res2,0,'sum(constr)');
}

echo "Дом $i сумма уровней: ".$sum[$i]."<br>";
}




$res=mysql_query("select * from `army` where `up`='6'");
$max=mysql_num_rows($res);

for ($j=0;$j<$max;$j++)
{
$n=mysql_result($res,$j,'n');
$x=mysql_result($res,$j,'x');
$y=mysql_result($res,$j,'y');

$name=mysql_result($res,$j,'name');

echo "<br>Армия $name [$x:$y] --- ";

$res2=mysql_query("select count(*) from `base` where `up`!='6' and `up`!='1' and `up`!='5' and `up`!='7' and `home`='$enemy' and `x`='$x' and `y`='$y'");
if (@mysql_result($res2,0,'count(*)')==0)
{

$rx=rand(1,4);

}
else echo "<b>Готов к атаке врага!</b>";
}


?>