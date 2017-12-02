<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_base))
{
	
define('QST','bren');
include "quests.php";

if (isset($bren) && $nbn!="")
{

$nbn=htmlspecialchars($nbn,ENT_NOQUOTES);
$stop="";
if (in_array($wd_base, array(73231, 73228, 73229))) $stop="<font color=red>Эту базу переименовать невозможно!</font><br>";
else {
if (strlen($nbn)<30) {
if (strrpos($nbn,' ') == 0)  {
if ((!$nbn) || ($nbn=="") || (ereg("[^a-zA-Z0-9А-Яа-я=_@.-]",$nbn))) { $stop="<font color=red>Недопустимые символы в названии базы</font><br>"; }
else {
$x=mysql_query("update `base` set `name`='$nbn' where `n`='$wd_base'");
if ($x==1)
{
	log_(36,"$wd_base:$nbn");
?>
<script>window.location.href="bren.php?mode=view";</script>
<?
}// else echo mysql_error();
} 
} else $stop="<font color=red>В названии баз нельзя использовать пробелы!</font><br>";
} else $stop="<font color=red>Максимальная длина названия базы не должна превышать 30 символов</font><br>";
}
if ($stop!="") echo $stop;
}
?>
Текущее название базы: <b><?=$res_name?>
<form action=<?=$a?> method=post>
Новое название: <input name=nbn value="<?=$res_name?>">&nbsp;&nbsp;<input type=submit name=bren value="Переименовать базу">
</form><br><br>
Внимание! Название базы может состоять из английских и русских букв, а также символов "_", "=", "-", ".", "@" и цифр. Пробелы и другие символы в названии базы не допустимы. Максимальная длина названия базы не должна превышать 30 символов.</font>
<?
}
include "footer.php";
?>