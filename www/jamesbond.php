<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_base))
{

if ($t_spy>=1)
{
if ($res_cred>=5000)
{
?>

<table width=100%>
<tr valign=top><td width=5%><img src=pics/tech8.jpg border=1></td><td>
<b>�������</b>
<br><br>
��� ���������� �������� �������� ���������� ����� ������ ���������� ���� ��� ����� ����������.
<br><br>
�� ���������� � ���������� ������ �������� ���������� 5000 ��������.
</td></tr></table>

<form action=<?=$a?> method=post>
<table <?=$paramtable?>>
<tr valign=top align=center><td>
������� ���������� ����: </td><td>
<input name=hodx>
</td><td>
<input name=hody>
</td><td>
<input type=submit name=start value='������ ��������'>
</td></tr>

</table>
</form>

<?



if (isset($start) && ($start=="������ ��������"))
{
echo "<br><br>�������� ������. ������� [$hodx:$hody]<br><br>";

if ($hodx<1 || $hodx>$dune_x || $hody<1 || $hody>$dune_y ) echo "�������� ����������. ������ ������� ���������.<br>";
else if ($hodx==75 && $hody==100) echo "���������� �������� �������� �� ������� ���� ���������� ����������.<br>";
else
{
setactiv($wd_usern);
log_("17","$hodx:$hody");

$res2=mysql_query("select * from `base` where `x`='$hodx' and `y`='$hody'");
if (@mysql_num_rows($res2)==0) echo "� �������� �������� ��� �� ����� ����.<br><br>";
else 
{
$j=0;

$up2=mysql_result($res2,$j,'up');
$name2=mysql_result($res2,$j,'name');

	$res3=mysql_query("select login from `wduser` where `n`='$up2'");
	$enemy=@mysql_result($res3,0,'login');

$constr=mysql_result($res2,$j,'constr');
$bar=mysql_result($res2,$j,'bar');
$fact=mysql_result($res2,$j,'fact');
$cosmo=mysql_result($res2,$j,'cosmo');

$cred=mysql_result($res2,$j,'cred');
$stone=mysql_result($res2,$j,'stone');

$wall=mysql_result($res2,$j,'wall');
$tower=mysql_result($res2,$j,'tower');
$rtower=mysql_result($res2,$j,'rtower');

$harv=mysql_result($res2,$j,'harv');

$linf=mysql_result($res2,$j,'linf');
$hinf=mysql_result($res2,$j,'hinf');

$tank=mysql_result($res2,$j,'tank');
$rtank=mysql_result($res2,$j,'rtank');

$palace=mysql_result($res2,$j,'palace');
$hod=mysql_result($res2,$j,'hod');

echo "���������� ����: <b>$name2</b><br>
���� ����������� ������: <b>$enemy</b><br>
<b>�������:</b><br>
����� �������: <b>$stone</b><br>
�������: <b>$cred</b><br>
<b>�������������� ��������:</b><br>
��������� �����: <b>$constr</b><br>
�������: <b>$bar</b><br>
�������: <b>$fact</b><br>
���������: <b>$cosmo</b><br>
������: <b>$palace</b><br>
������ ���� ������: <b>$hod</b><br>
<b>�������������� ����������:</b><br>
�������� �����: <b>$wall</b><br>
�����: <b>$tower</b><br>
�������� �����: <b>$rtower</b><br>
<b>����������� �������:</b><br>
����������: <b>$harv</b><br>
<b>��������:</b><br>
������: <b>$linf</b><br>
������� ������: <b>$hinf</b><br>
�����: <b>$tank</b><br>
�������� �����: <b>$rtank</b><br><br>
";

}





$res2=mysql_query("select * from `army` where `x`='$hodx' and `y`='$hody'");
if (@mysql_num_rows($res2)==0) echo "� �������� ����� �� ����������.<br><br>";
else 
{
for ($j=0;$j<mysql_num_rows($res2);$j++)
{
$up2=mysql_result($res2,$j,'up');
$name2=mysql_result($res2,$j,'name');

	$res3=mysql_query("select login from `wduser` where `n`='$up2'");
	$enemy=@mysql_result($res3,0,'login');

$mobconst=mysql_result($res2,$j,'mobconst');

$linf=mysql_result($res2,$j,'linf');
$hinf=mysql_result($res2,$j,'hinf');

$tank=mysql_result($res2,$j,'tank');
$rtank=mysql_result($res2,$j,'rtank');

echo "���������� �����: <b>$name2</b> ������: <b>$enemy</b><br>
���: <b>$mobconst</b><br>
������ ������: <b>$linf</b><br>
������� ������: <b>$hinf</b><br>
�����: <b>$tank</b><br>
�������� �����: <b>$rtank</b><br><br>
";

} }









echo "<b>�������� ������ �������.</b><br>";

$hod_left=$res_cred-5000;
mysql_query("update `base` set `cred`='$hod_left' where `n`='$wd_base' and `up`='$wd_usern'");
} } 




} else echo "� ��� ������������ ������� ��� ���������� �������� ��������. ��������� �������� 5000 ��������.";
} else echo "��� ���������� ����������� ���������� ��������, ����� �������� ����������� �������� �� ������� ��������.";
}
include "footer.php";
?>