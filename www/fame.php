<?
extract($_GET);
extract($_POST);
 include "header.php"; 
?>

<p><b>������������ ��� ����� ���� Dune2 on-line</b><br>
  ����� �������� ����� ������ ����. ����� ����� �� ������ ������� � �� �� ������� ����� �������� ����� �� ������ ��������!</p>
��������, ���� ��� ����� ��������� � 16 ������, ������ ��� �������� �� ������:
<a href=fame_old.php>http://localhost/fame_old.php</a>
<br><br>
<table width=100% cellspacing="5" border=1>
<tr><th>�</th><th>�����</th><th>���-�� ������� (����� ������� �����)</th><th>������</th></tr>
<?
  $i=0;
  $res=mysql_query("SELECT DISTINCT `name` FROM `fame` ORDER BY `col` DESC");
  while($r=mysql_fetch_array($res)){
  	$name=$r['name'];
  	$res2=mysql_query("SELECT * FROM `fame` WHERE `name`='$name'");
  	$r2=mysql_fetch_array($res2);
  	$n=$r2['n'];
  	$col=$r2['col'];
  	$i+=1;
  	echo "<tr align=center><td>$i</td><td width=60%><b><font style=\"font-size:14px\" color=blue>$name</font></b></td><td>$col</td><td><a href=fame.php?view=$n>��������</a></td></tr>";
  }
?>
</table>
<?
  if(isset($view)){
  	$n=intval($view);
  echo "<br><br>";
  $res=mysql_query("SELECT * FROM `fame` WHERE `n`='$n'");
  if(intval(@mysql_num_rows($res))>0) {
  	$name=mysql_result($res,0,'name');
?>
  <center><b>������� ������ <font style="font-size:14px" color=blue><?=$name?></font></b></center>
  <table width=100% cellspacing="5" border=1>
  <tr><th>�</th><th>������</th><th>�������� ������</th><th>������ ���� ��:</th></tr>
<?
  $res=mysql_query("SELECT * FROm `fame` WHERE `name`='$name'");
  $max=mysql_num_rows($res);
  for($i=0;$i<$max;$i++){
  	$medn=mysql_result($res,$i,'medal');
  	$info=mysql_result($res,$i,'about');
  	$res2=mysql_query("SELECT * FROM `medales` WHERE `n`='$medn'");
  	$medname=mysql_result($res2,0,'name');
  	$medinfo=mysql_result($res2,0,'about');
  	$medfile=mysql_result($res2,0,'path');
  	$n=$i+1;
    echo "<tr align=center><td>$n</td><td><img src=\"pics/$medfile\"></td><td>$medname</td><td>$info</td></tr>";
  }
?>
 </table>


<? } else echo "������ ������ ��� � ����";} ?>
<br><br>
<table cellpadding=5 cellspacing="5">
  <tr>
    <td colspan="3" <?=$paramhead?>>�������:</td>
  </tr>
  <tr align="center">
    <td><img src="pics/m1.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>�������</b></td>
    <td align="left" valign="top">������ ������ ������ � ������� �������� �� ������� � ������ ������� ����</td>
  </tr>
  <tr align="center">
    <td><img src="pics/m10.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>�� ���������</b> </td>
    <td align="left" valign="top">�� ������� � off-line ������������ </td>
  </tr>
  <tr align="center">
    <td><img src="pics/m9.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>���� ����������� �������� </b></td>
    <td align="left" valign="top">������������ �� ������� ������ �������, �� ������ ����� � ������� ������� </td>
  </tr>
  <tr align="center">
    <td><b><img src="pics/m2.gif" width="20" height="35"></b></td>
    <td align="left" valign="top"><b>������ �� ������ </b></td>
    <td align="left" valign="top">������������ �� ������ ������ ������� � ���������� ��������� �������  </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m3.gif" width="20" height="35"><br>      </td>
    <td align="left" valign="top"><b>������� ������</b></td>
    <td align="left" valign="top">�� ������ � ��������, ���������� ��������� ���������� </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m4.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>���� ���������� </b></td>
    <td align="left" valign="top">�� ������ � ������ ��� �����, ����������� ����� � ������������ </td>
  </tr>
  <tr align="center" valign="top">
    <td><b><img src="pics/m5.gif" width="20" height="35"></b></td>
    <td align="left" valign="top"><b>��������</b></td>
    <td align="left" valign="top">�� ������� � �������� ����, ������ ������� ������� � ����������� �����</td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m6.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>����� ���� </b></td>
    <td align="left" valign="top">�� ���������� ������� ������� </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m11.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>������� �����</b></td>
    <td align="left" valign="top">�� ������������ ���������� </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m8.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>������� ������</b> </td>
    <td align="left" valign="top">��������� ������� �� ������ ������� </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m7.gif" width="20" height="35" /></td>
    <td align="left" valign="top"><b>������</b></td>
    <td align="left" valign="top">�� ������ � ���� </td>
  </tr>
</table>
<?
include "footer.php"; ?>