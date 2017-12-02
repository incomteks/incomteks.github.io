<?
extract($_GET);
extract($_POST);
 include "header.php"; 
//##############################   КВЕСТ1 - СКРЫТИЕ ОТ РАДАРОВ   ##############################
define('QST','stat2');
//##########################################################################
?>

<table width=100% <?=$paramtable?>>
<tr valign=top><td width=33%><b>Самые развитые базы</b><br><br>
<?
$res=mysql_query("select * from `base` order by `constr` desc, `palace` desc, `cosmo` desc, `harv` desc limit 150");

$max=mysql_num_rows($res);
$jj=0;
for ($j=0;$j<$max;$j++)
{

$name=mysql_result($res,$j,'name');
$up=mysql_result($res,$j,'up');
$x=mysql_result($res,$j,'x');
$y=mysql_result($res,$j,'y');
$c=mysql_result($res,$j,'constr');

$res2=mysql_query("select * from wduser where n='$up'");
$login=@mysql_result($res2,0,'login');
$al=@mysql_result($res2,0,'al');
$home=@mysql_result($res2,0,'home');
$typ=@mysql_result($res2,0,'typ');

//##############################   КВЕСТ1 - СКРЫТИЕ ОТ РАДАРОВ   ##############################

include "quests.php";
if(isset($hideme)) continue(0);

//##########################################################################

if ($home!=0 && $home!=4 && $jj<100)
{
$jj=$jj+1;

$font="";$tit="";
if ($typ==1) {$font="<font color=black>";$tit="<a title='Представитель Верховного Совета Дюны'>";}
if ($typ==2) {$font="<font color=blue>";$tit="<a title='Администрация Дюны'>";}

echo "$jj. <b>[$c] <a title='$x:$y'>$name</a></b> (";
if ($al!="") echo " [$al] ";
echo "$tit$font$login</font></a>)<br>";
}
}
?>
</td><td  width=33%><b>Самые богатые базы</b><br><br>

<?
$res=mysql_query("select * from `base` order by `cred` desc limit 150");

$max=mysql_num_rows($res);
$jj=0;
for ($j=0;$j<$max;$j++)
{

$name=mysql_result($res,$j,'name');
$up=mysql_result($res,$j,'up');
$x=mysql_result($res,$j,'x');
$y=mysql_result($res,$j,'y');
$c=mysql_result($res,$j,'constr');

$res2=mysql_query("select * from wduser where n='$up'");
$login=@mysql_result($res2,0,'login');
$al=@mysql_result($res2,0,'al');
$home=@mysql_result($res2,0,'home');
$typ=@mysql_result($res2,0,'typ');

//##############################   КВЕСТ1 - СКРЫТИЕ ОТ РАДАРОВ   ##############################

include "quests.php";
if(isset($hideme)) continue(0);

//##########################################################################

if ($home!=0 && $home!=4 && $jj<100)
{
$jj=$jj+1;

$font="";$tit="";
if ($typ==1) {$font="<font color=black>";$tit="<a title='Представитель Верховного Совета Дюны'>";}
if ($typ==2) {$font="<font color=blue>";$tit="<a title='Администрация Дюны'>";}

echo "$jj. <b>[$c] <a title='$x:$y'>$name</a></b> (";
if ($al!="") echo " [$al] ";
echo "$tit$font$login</font></a>)<br>";
}
}
?>

</td><td width=33%><b>Самые защищенные базы</b><br><br>

<?
$res=mysql_query("select * from `base` order by `rtower` desc,`tower` desc,`wall` desc limit 150");

$max=mysql_num_rows($res);
$jj=0;
for ($j=0;$j<$max;$j++)
{

$name=mysql_result($res,$j,'name');
$up=mysql_result($res,$j,'up');
$x=mysql_result($res,$j,'x');
$y=mysql_result($res,$j,'y');
$c=mysql_result($res,$j,'constr');

$res2=mysql_query("select * from wduser where n='$up'");
$login=@mysql_result($res2,0,'login');
$al=@mysql_result($res2,0,'al');
$home=@mysql_result($res2,0,'home');
$typ=@mysql_result($res2,0,'typ');

//##############################   КВЕСТ1 - СКРЫТИЕ ОТ РАДАРОВ   ##############################

include "quests.php";
if(isset($hideme)) continue(0);

//##########################################################################

if ($home!=0 && $home!=4 && $jj<100)
{
$jj=$jj+1;

$font="";$tit="";
if ($typ==1) {$font="<font color=black>";$tit="<a title='Представитель Верховного Совета Дюны'>";}
if ($typ==2) {$font="<font color=blue>";$tit="<a title='Администрация Дюны'>";}

echo "$jj. <b>[$c] <a title='$x:$y'>$name</a></b> (";
if ($al!="") echo " [$al] ";
echo "$tit$font$login</font></a>)<br>";
}
}
?>


</td></tr></table>

<? include "footer.php"; ?>