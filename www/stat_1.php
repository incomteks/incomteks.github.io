<?
extract($_GET);
extract($_POST);
 include "header.php"; 
//##############################   КВЕСТ1 - СКРЫТИЕ ОТ РАДАРОВ   ##############################
define('QST','stat1');
//##########################################################################
?>


<table width=100% <?=$paramtable?>><tr valign=top>
<?
for ($i=1;$i<=4;$i++)
{
echo "<td width=25%>";

echo "<table width=100%>";
if ($i==4) $res=mysql_query("select * from `wduser` where `home`='0' or `home`='4' order by `al`,`ip`");
else $res=mysql_query("select * from `wduser` where `home`='$i' order by `al`,`ip`");

$max=mysql_num_rows($res);

echo "<tr><td $paramhead >";

if ($i==1) echo "<b>Атрейдесы</b>";
if ($i==2) echo "<b>Ордосы</b>";
if ($i==3) echo "<b>Харконнены</b>";
if ($i==4) echo "<b>Другие игроки</b>";

echo "</td></tr>";

for ($j=0;$j<$max;$j++)
{

$n=mysql_result($res,$j,'n');
$login=mysql_result($res,$j,'login');
$ip=mysql_result($res,$j,'ip');
$al=mysql_result($res,$j,'al');
$typ=mysql_result($res,$j,'typ');

if ($n==6) $ip = false;

$res2=mysql_query("select * from `base` where `up`='$n' order by `n`");
$max2=mysql_num_rows($res2);

if ($max2>0) {

echo "<tr><td bgcolor=#ecac70>";

if ($al!="") echo " <b><i>[$al]</i></b> ";
$font="";$tit=$ip;
if ($typ==1) {$font="<font color=black>";$tit="Представитель Верховного Совета Дюны";}
if ($typ==2) {$font="<font color=blue>";$tit="Администрация Дюны";}
echo "<b><a title='$tit'>$font$login</font></a></b>";

if (isset($yo) && $yo=="yo") echo " [$ip] ";

echo "</td></tr>";

for ($k=0;$k<$max2;$k++)
{

$name=mysql_result($res2,$k,'name');
$x=mysql_result($res2,$k,'x');
$y=mysql_result($res2,$k,'y');
$c=mysql_result($res2,$k,'constr');

//##############################   КВЕСТ1 - СКРЫТИЕ ОТ РАДАРОВ   ##############################

include "quests.php";
if(isset($hideme)) continue(0);
if ($n == 1 && $name == '*GOLD PALACE*') continue;

//##########################################################################


echo "<tr><td style='padding-left:15px'><b>[$c]</b> <a title='$x:$y'>$name</a></td></tr>";

}
}



}
?></table></td><?
if ($i%4==0) echo "</tr><tr valign=top>";
}
?>
</tr></table>

<? include "footer.php"; ?>