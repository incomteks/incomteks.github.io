<? 
extract($_GET);
extract($_POST);
include "header.php"; 

$res=mysql_query("select count(*) from wduser");
$cnt1=mysql_result($res,0,'count(*)');
$res=mysql_query("select count(*) from base");
$cnt2=mysql_result($res,0,'count(*)');
$res=mysql_query("select count(*) from army");
$cnt3=mysql_result($res,0,'count(*)');
$res=mysql_query("select * from `day` limit 1");
$day=mysql_result($res,0,'n');

$res=mysql_query("select count(*) from wduser where `home`='1'");
$hm1=mysql_result($res,0,'count(*)');
$res=mysql_query("select count(*) from wduser where `home`='2'");
$hm2=mysql_result($res,0,'count(*)');
$res=mysql_query("select count(*) from wduser where `home`='3'");
$hm3=mysql_result($res,0,'count(*)');

?>

<table width=100%>

<tr><td <?=$paramhead?> colspan=4><b>������������� �������: </b></td></tr>

<tr valign=top>
<td align=center bgcolor=#e5ac77 width=25%>
<b>��� ����������</b><br>
<img src=pics/logo1.gif width=88 height=94>
<br>
�������: <b><?=$hm1?></b></td>
<td align=center bgcolor=#e5ac77 width=25%>
<b>��� �������</b><br>
<img src=pics/logo2.gif width=88 height=94>
<br>�������: <b><?=$hm2?></b></td>
<td align=center bgcolor=#e5ac77 width=25%>
<b>��� �����������</b><br>
<img src=pics/logo3.gif width=88 height=94>
<br>�������: <b><?=$hm3?></b></td>
</tr>

<tr><td <?=$paramhead?> colspan=3><b>����������� ������ ��������� ���� 2</b></td></tr>

<tr><td colspan=3>
<table width=100% height=100%><tr valign=top>
<td style="padding:15px"><p class="MsoNormal" style="text-align: justify;"><strong>����
������!</strong>&nbsp;<br>
</p><p class="MsoNormal" style="text-align: justify;">�����
�� ��������
���� ������� ������������ � <span style="font-weight: bold;">on
line
���������� &ndash; ����2</span>. � ����� ������ �� ���������
���� �������� � �������
���������� <span style="" lang="EN-US">on</span><span
 lang="EN-US"> </span><span style=""
 lang="EN-US">line</span>
����. ���, ��� �������, ���� �� �������� ����������� ���� ���
�����������. �
������, ��� ���� ��������� � ����, ��� ��� ��, ��� ��� ������ ������ ��
�����
������� � ��� � 2-3 ������ ������ �������. ������ ����� ������ ������:
&laquo;� ���
��� ����?&raquo; �� ������� � ���� ���� ��������� �����:</p>
<p class="MsoNormal" style="text-align: justify;">1.
������� <span style="font-weight: bold;">�������� ����
�������
��������� � ������ ������� ������������</span> ���������� <span
 style="" lang="EN-US">on</span><span
 lang="EN-US"> </span><span style=""
 lang="EN-US">line</span> ��������� � �����
�������������� ���� � ������, � �� ��������� ���������� ���������,
�������
�������� � ������� �� ���� ������� �� ������������.</p>
<p class="MsoNormal" style="text-align: justify;">2.
<span style="font-weight: bold;">��� ����������
����������� ��
���������� � ���������</span> � �������� ���������� ����������
���� �������� � ����
������ ���������, ���� ��� �� ������������ ��� �������, �����
���������� �����,
�� ��� �� �� ����������� ������ ��� ������ ������.</p>
<p class="MsoNormal" style="text-align: justify;">3.
����� ���� � ����� ������ ����
���������� ���������, <span style="font-weight: bold;">�
������� ������ ���� ���� �������� ���� ��� � ������</span>,
����������� ��� ���� � ����� �� ������� ��������, � �� �������� �����
����� �
����� ������������ ������� �������, ������� ��� � ����, ����� �� � ����
�������� ��� ���������� ���-������.</p>
<p class="MsoNormal" style="text-align: justify;">4.
���� �������� ���������� <span style="" lang="EN-US">on</span><span
 lang="EN-US"> </span><span style=""
 lang="EN-US">line</span> ���������� � � �����
������ ������� �������� � � ����� ������ ������������� ���������. ���
����������� ������������� ����� �������� ������, ���� ��������� �������
���������� ���� ����2, �� ����� ����� ������ ���� � ������ �������
��������,
������ ����, ��� ��� ������������� ��������� �� �����������, � � ������
��
������� ����� ������������ ����� ������������� ����������
������-�������������
������� ���� ���������.</p>
<p class="MsoNormal" style="text-align: justify;">5.
<span style="font-weight: bold;">� ������ ������� ������
����
������ ��������� ��� ������ ��������� � ������ ��������� ��������,
��������
������� �� ���� �������� �������� �������� ��� �����������</span>
� ��� ������, ���
��� ������� ����� �� ����� �������������.</p>
<p class="MsoNormal" style="text-align: justify;">6.
���� ���� ��� ���� � �����
������������� �������� �������� ���� ���������� � ���� ������, ���
����������
�������� � ������� ������, � �����, ����������� �� �� ���� ����������
����������� ����������, � ���� ���� ���� ���������������� ���� ��������
�
��������� ���� ������������� ������ � ����� ������, ��� ������
������������
������ ������-������������� ��������� �������� � ������.<br>
<br><br>
</p><div style="text-align: right;"><span
 style="font-style: italic;">�����</span><span
 style="font-weight: bold; font-style: italic;"> -Roman-SPb-</span></div>
<p class="MsoNormal" style="text-align: justify;"></p><br>
</td><td width=150 bgcolor=#ecac70 style="padding:15px">

<?
$res=mysql_query("SELECT count(*) FROM `wduser` WHERE `notactiv`<1000");
$act=mysql_result($res,0,'count(*)');
echo "<b>������ � ����:</b><br><br>
�������: <b>$cnt1</b><br>
��������: <b>$act</b><br>
��������� ���: <b>$cnt2</b><br>
������� �����: <b>$cnt3</b><br>
���� <b>$day</b> ������� ����.";

$res=mysql_query("select sum(constr) from `base`");
$all_constr=mysql_result($res,0,'sum(constr)');
echo "<br>������:<br> ";
for ($i=0;$i<=4;$i++)
{
$sum[$i]=0;
$res=mysql_query("select * from `wduser` where `home`='$i'");
$max=@mysql_num_rows($res);

for ($j=0;$j<$max;$j++)
{
$n=mysql_result($res,$j,'n');

$res2=mysql_query("select sum(constr) from `base` where `up`='$n'");
$sum[$i]+=mysql_result($res2,0,'sum(constr)');
}

if ($i==0) echo " <font color=#666666>";
if ($i==1) echo " <font color=#000099>";
if ($i==2) echo " <font color=#009900>";
if ($i==3) echo " <font color=#990000>";
if ($i==4) echo " <font color=#990099>";

if($all_constr>0)
  $perc=round($sum[$i]*100/ $all_constr);
else
  $perc=0;
echo $sum[$i]." ($perc%)</font><br>";
}

$res=mysql_query("select sum(spice) from `wduser`");
$all_spice=mysql_result($res,0,'sum(spice)');
echo "<br>������ ������:<br>";
for ($i=0;$i<=4;$i++)
{
$sum[$i]=0;

$res=mysql_query("select sum(spice) from `wduser` where `home`='$i'");
$sum[$i]+=@mysql_result($res,0,'sum(spice)');

if ($i==0) echo " <font color=#666666>";
if ($i==1) echo " <font color=#000099>";
if ($i==2) echo " <font color=#009900>";
if ($i==3) echo " <font color=#990000>";
if ($i==4) echo " <font color=#990099>";

if($all_spice>0)
  $perc=round($sum[$i]*100/ $all_spice);
else
  $perc=0;
echo $sum[$i]." ($perc%)</font><br>";
}
?>
<br>
<b>>></b> <a href="/best_dune.php">����������� ������ ��������� ���� 2</a><br>
<b>>></b> <a href="/about_dune.php">������� � ����� ������ ���� Dune2</a><br></td>
</tr></table>
</td></tr>
<tr><td <?=$paramhead?> colspan=3> ���-��� </td></tr>
<tr>
  <td colspan=3>
    <p><strong>������! ���� ��������� � ����� ������.    </strong></p>
    <p>��� ��� ��� ������ ��������, � ���� ������������� ���������� ��������� �������� ����� ���� ����� �������. ����� ���� ������ �������� ���������� - � ����� ������ ����������� ������ ��������� ���� �������� ����������� &quot;������&quot; ������, ��������� ��� ���������� ������� ���������� ����� �����������, � ���� ��������� ������ �� ����� �������.</p>
    <p>���������� ����������� ��� ��������� ���� - �������� ��������� �������� ����, ���� ������� �������� � ����������� �������� �� ������ ������ ���� ������� �� ����� 1 �������� � �������� �� �� e-mail - help@localhost ���� support@localhost ���� � ����� �� ������. ������ ������ ����� ������������ �� ����� (�������� ������������ �������������). ��������, ��� ������������� ������� ����� ������ ���������.</p>
    <p>P.S. ���������� � ������� ����������� ����� �� ������� ��������� �������� �����:</p>
    <p>���������� ���������<br />
        ���� ���������<br />
        ��������� ����<br />
        on line ���������<br />
        ������ ���������<br />
        ������ ���� ���������<br />
        ���������� ������ ���������<br />
        ���������� ������ ���������<br />
        ������������� ������ ���������<br />
        ��������� ������ ���������<br />
        ������ ��� ���������<br />
    ����� ������ ���������</p>
    <p>&nbsp;</p></td>
</tr>
<tr><td <?=$paramhead?> colspan=3> ������� </td></tr>
<tr><td colspan=3>
<? include("avnews.php"); ?>
</td></tr>
</table>

<br><br><br>

<? include "footer.php"; ?>

