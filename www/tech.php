<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_base))
{
define('QST','tech');
include "quests.php";

if ($lvl[8]>=1)
{

$res=mysql_query("select * from `wduser` where `n`='$wd_usern'");
$status=mysql_result($res,0,'status');

if ($status==0) 
{ 

include "inc_tech_dsc.php";



if ($mode=="research")
{

if (isset($structure)) $structure=intval($structure);
$i=$structure;

################################################################################
$ttt=$ttech[$i]+1;
$stop = false;

if ($lvl[8]<$ttt) $stop = 1;
if (($i==1 || $i==2) && ($lvl[7]<$ttt)) $stop = 1;
if (($i==1 || $i==2) && ($lvl[6]<$ttt)) $stop = 1;
if ($i==3 && $lvl[7]<$ttt) $stop = 1;
if ($i==3 && $ttt>4) $stop = 1;
if ($i==4 && $lvl[2]<$ttt) $stop = 1;
if ($i==5 && $lvl[4]<$ttt) $stop = 1;

if ($i==6 && $lvl[10]<1) $stop = 1;
if ($i==6 && $ttt>1) $stop = 1;
if ($i==7 && $ttt>5) $stop = 1;
if ($i==8 && $ttt>1) $stop = 1;

if (!$stop) {
################################################################################



if (($res_cred>=$tcred[$i] && $res_stone>=$tstone[$i]) and ($i>=1 && $i<=8)) 
{

$res=mysql_query("select * from `res` where `up`='$wd_usern' and `struct`='$i'");
if (@mysql_num_rows($res)==0)
{

$x=mysql_query("insert into `res` (`up`,`struct`,`dleft`,`base`) values ('$wd_usern','$structure','$tdays[$i]','$wd_base')");
if ($x==1)
{
	setactiv($wd_usern);
	$tmp=$days[$i];
  log_(14,"$structure:$tmp");
//echo "������������� ����� ��������� ����� ".$days[$i]." ����.<br>";

$cred_left=$res_cred-$tcred[$i];
$place_left=$lvl[1]-$tsite[$i];
$stone_left=$res_stone-$tstone[$i];

$x2=mysql_query("update base set `cred`='$cred_left',`stone`='$stone_left' where `n`='$wd_base' and `up`='$wd_usern'");
if ($x2!=1) echo mysql_error();
else { ?><script>window.location.href="tech.php?mode=view";</script><? }
} 
} 
} else echo "������������ ��������.";
}
else echo "���������� �����������!";
}

if ($mode=="cansel")
{

if (isset($structure)) $structure=intval($structure);
$i=$structure;

if ($bass==$wd_base) 
{

$res=mysql_query("select * from `res` where `up`='$wd_usern' and `struct`='$i' and `base`='$wd_base'");
if (mysql_num_rows($res)==1)
{

$x=mysql_query("delete from `res` where `base`='$wd_base' and `struct`='$structure' and `base`='$wd_base'");
if ($x==1)
{
	log_(24,$structure);
$cred_left=$res_cred+$tcred[$i];
$place_left=$lvl[1]+$tsite[$i];
$stone_left=$res_stone+$tstone[$i];

$x2=mysql_query("update base set `cred`='$cred_left',`place`='$place_left',`stone`='$stone_left' where `up`='$wd_usern' and `n`='$wd_base' ");
if ($x2!=1) echo mysql_error();
else { ?><script>window.location.href="tech.php?mode=view";</script><? }
} 
} 
} else echo "�� �� ����";
}


for ($i=1;$i<=8;$i++)
{
$price[$i]="������: <b>".$tstone[$i]." </b><br>�������: <b>".$tcred[$i]."</b><br>�����: <b>".$tdays[$i]." ����</b>";

$res=mysql_query("select * from `res` where `up`='$wd_usern' and `struct`='$i'");

if (@mysql_num_rows($res)==0) $ab[$i]="0";
else 
{
$ab[$i]=mysql_result($res,0,'dleft');
$bas[$i]=mysql_result($res,0,'base');
}

if (($res_cred<$tcred[$i] || $res_stone<$tstone[$i]) && $ab[$i]==0) $ab[$i]="-1";
}

?>

<table width=100% <?=$paramtable?>>
<tr valign=top><td>&nbsp;</td><td width=40% <?=$paramhead?>>����������</td><td width=40% <?=$paramhead?>>��������� � ����� ������������</td><td width=20% <?=$paramhead?>>������</td></tr>

<? for ($i=1;$i<=8;$i++) { ?>

<tr valign=top>
<td><img src=pics/tech<?=$i?>.jpg border=1></td>
<td><?=$tname[$i]?></td><td><?=$price[$i]?>
</td><td>�������: <b><?=$ttech[$i]?></b>
<br><br>
<?
$ttt=$ttech[$i]+1;

if ($lvl[8]>=$ttt) {
//20.10.2006 Prokopenko Anton (���������� 6 � 7)
if (($i!=1 && $i!=2) || ($lvl[7]>=$ttt)) {
if (($i!=1 && $i!=2) || ($lvl[6]>=$ttt)) {
//20.10.2006 Prokopenko Anton
if ($i!=3 || $lvl[7]>=$ttt) {
if ($i!=3 || $ttt<=4) {
if ($i!=4 || $lvl[2]>=$ttt) {
if ($i!=5 || $lvl[4]>=$ttt) {
if ($i!=6 || $lvl[10]>'0') {
if ($i!=6 || $ttt<='1') {
if ($i!=7 || $ttt<='5') {
if ($i!=8 || $ttt<='1') {

if ($ab[$i]==0) echo "<a href=$a?mode=research&structure=$i>�����������<br> ������� ".$ttt." </a>";
if ($ab[$i]<0) echo "������������ �������� ��� ������������";
if ($ab[$i]>0) 
{
echo "�� ���������� ������������: ".$ab[$i]." ����"; 
if ($bas[$i]==$wd_base)
echo "<br><a href=$a?mode=cansel&structure=$i&bass=$wd_base>������ </a>";
}

} else echo "���������� ������������ ����������.";
} else echo "���������� ������������ ����������.";
} else echo "���������� ������������ ����������.";
} else echo "���������� ��������� ������.";
} else echo "���������� ����������������� ����� ����������� ������.";
} else echo "���������� ����������������� ��������� �����.";
} else echo "���������� ������������ ����������.";
} else echo "���������� ����������������� ������� ������� �������.";
} else echo "���������� ����������������� �������.";
} else echo "���������� ����������������� ������� ������� �������.";
} else echo "���������� ����������������� ������� �����.";
?>
</td></tr>

<? } ?>

</table>


<?

} else echo "������� ����� � ������ ������� ����������.";
} else echo "�� ���� ���� ���� ��� �������� ������. ��������� ���, ����� ����� ����������� ����������� ����� ����������.";
}
include "footer.php";
?>