<? 
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_usern))
{
include "inc_war_dsc.php";

?>
<table width=100% <?=$paramtable?>>
<tr>
<td <?=$paramhead?> width=20%>������ �������</td>
<td <?=$paramhead?> width=80%>������ ��������</td>
</tr>
<?

for ($i=12;$i<=29;$i++)
{
if ($i==14) $i=21;

if ($war_c[$i]==1) $war_c[$i]="������";
if ($war_c[$i]==2) $war_c[$i]="�������";

$war_a1[$i]=round($war_a1[$i]*0.5)."-".round($war_a1[$i]*1.5);
$war_a2[$i]=round($war_a2[$i]*0.5)."-".round($war_a2[$i]*1.5);

?>
<tr valign=top>
<td>
<?=$war_n[$i]?>
<br><br>
<img src=pics/unit<?=$i?>.jpg width=100 height=100 border=1>
</td>
<td>
�����: <b><?=$war_c[$i]?></b><br>
����� ������ ������: <b><?=$war_a1[$i]?></b><br>
����� ������ �������: <b><?=$war_a2[$i]?></b><br>
�����: <b><?=$war_hp[$i]?></b><br><br>������� ������������:<br>
<?
if ($i==12) echo "�������� ����� ������� 1";
if ($i==13) echo "��������� ����� ������� 5, ������� ����� ������� 5";

if ($i==21) echo "����� �� ����������� ������ ������� 1";
if ($i==22) echo "������� ������� ������� ������� 5";
if ($i==23) echo "������� ������� 1";
if ($i==24) echo "������� ������� 3";
if ($i==25) echo "������� ������� ������� ������� 1";
if ($i==26) echo "������� ������� ������� ������� 5";
if ($i==27) echo "�� ����������";
if ($i==28) echo "�� ����������";
if ($i==29) echo "�� ����������";

?>
</td>
</tr>
<?
}
?></table><?
}
include "footer.php";
?>