<?
extract($_POST);
extract($_GET);
include "header.php";

if (isset($wd_base))
{

define('QST','blow');
include "quests.php";

if ($nbn=="confirm")
{

$res=mysql_query("select * from `base` where `n`='$wd_base' and `up`='$wd_usern'");
if (@mysql_num_rows($res)==1 && !in_array($wd_base, array(73231, 73228, 73229)))
{
$bname=mysql_result($res,0,'name');
$bx=mysql_result($res,0,'x');
$by=mysql_result($res,0,'y');

$x=mysql_query("delete from `base` where `n`='$wd_base' and `up`='$wd_usern'");
unset($wd_base);

if ($x==1) {
	echo "База уничтожена!";
	log_(34,"$bx:$by:$bname");

$res=mysql_query("select * from `base` where `up`='$wd_usern'");

if (@mysql_num_rows($res)==0)
	 {
	mysql_query("delete from `army` where `up`='$wd_usern'");
	echo "<br>Связь с вашими армиями потеряна";
	log_(35,"0");
 	}

}
else echo mysql_error();
//} else echo "Ваш стаж меньше 1000 дней! Невозможно уничтожить базу.";
} else echo "Невозможно заложить взрывчатку. Уничтожение базы отменено!";
}
else
{
?>
Вы пытаетесь уничтожить свою базу! Эта операция необратима. <a href=<?=$a?>?nbn=confirm>Подтверждаю уничтожение базы.</a>
<br><br>

<?
$res=mysql_query("select * from `base` where `up`='$wd_usern'");

if (@mysql_num_rows($res)==1)
{
echo "<br><br>Внимание!<br><b>Эта база у вас последняя. При её уничтожении ваши армии погибнут в песках.</b>";
}
} 

}
include "footer.php";
?>