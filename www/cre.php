<?
extract($_GET);
extract($_POST);
 include "header.php"; 
?>

<p><b>���������</b>
  <br>
  <br>
     ���� 2 on-line ������� ���-������� <a href="http://localhost">��������-�������� localhost </a>� ��������� ����� ;) ��� �������� �������� �������� 
������� � ��������� ������ ������������ ����������� ������������.<br><br>
����� ���� ����� ������� � ������������! ������ ��� �� ��������� ���� ������.</p>
<p><b>��� ����� ��������:</b></p>
<table width="100%"  border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td width="1"><img src="pics/x-ray.jpg" border=0></td>
    <td valign="top"><p>��� ����, ������, ���������, �����<br><b>X-ray</b>.</p>
      <p><a href="javascript:alert('X-ray'+String.fromCharCode(64)+'localhost')">e-mail</a></p></td>
  </tr>
  <tr>
    <td width="1"><img src="pics/anton.gif" border="1"></td>
    <td valign="top"><p>���-����������� <b>����� ��������</b>.</p>
    <p><a href="mailto:anton@localhost?subject=DUNE">e-mail</a></p></td>
  </tr>
  <tr>
    <td width="1"><img src="pics/igor.gif" border=1></td>
    <td valign="top"><p>������� ������������ � ������� ����������� <b>����� ��������</b>.</p>
      <p><a href="mailto:medusa@localhost?subject=DUNE">e-mail</a></p></td>
  </tr>
  <tr>
    <td width="1"><img src="pics/logo_mini.jpg" border=0></td>
    <td valign="top"><p>�����������, �����, �������� � ���������� ���, ��������� <br><b>����� ��������</b>.</p>
      <p><a href="javascript:alert('av_soft'+String.fromCharCode(64)+'localhost')">e-mail</a></p></td>
  </tr>
</table>
<p>&nbsp;  </p>

<? include "footer.php"; ?>

