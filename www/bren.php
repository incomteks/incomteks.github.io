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
if (in_array($wd_base, array(73231, 73228, 73229))) $stop="<font color=red>��� ���� ������������� ����������!</font><br>";
else {
if (strlen($nbn)<30) {
if (strrpos($nbn,' ') == 0)  {
if ((!$nbn) || ($nbn=="") || (ereg("[^a-zA-Z0-9�-��-�=_@.-]",$nbn))) { $stop="<font color=red>������������ ������� � �������� ����</font><br>"; }
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
} else $stop="<font color=red>� �������� ��� ������ ������������ �������!</font><br>";
} else $stop="<font color=red>������������ ����� �������� ���� �� ������ ��������� 30 ��������</font><br>";
}
if ($stop!="") echo $stop;
}
?>
������� �������� ����: <b><?=$res_name?>
<form action=<?=$a?> method=post>
����� ��������: <input name=nbn value="<?=$res_name?>">&nbsp;&nbsp;<input type=submit name=bren value="������������� ����">
</form><br><br>
��������! �������� ���� ����� �������� �� ���������� � ������� ����, � ����� �������� "_", "=", "-", ".", "@" � ����. ������� � ������ ������� � �������� ���� �� ���������. ������������ ����� �������� ���� �� ������ ��������� 30 ��������.</font>
<?
}
include "footer.php";
?>