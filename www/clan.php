<?
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_base))
{

echo "<b>�������</b><br><br>";

$res=mysql_query("select * from wduser where n='$wd_usern'");
$al=mysql_result($res,0,'al');





if (isset($mode) && ($mode=="newal"))
{
	$errmes="";
	$alname = htmlspecialchars($alname,ENT_NOQUOTES);
  if ((!$alname) || ($alname=="") || (ereg("[^a-zA-Z0-9�-��-�=_@.-]",$alname))) $errmes = "������������ ������� � �������� �������.";
  if (strlen($alname) > 40) $errmes = "������� ������� �������� �������. ������������ ����� 40 ��������.";
  if ($errmes=="") {
    $reso=mysql_query("select count(*) from al where name='$alname'");
    $alov=mysql_result($reso,0,'count(*)');
    if ($alov>0) echo "������! ����� ������ ��� ����. <br>";
    else 
    {
      echo "�������� ������ �������...";
      $x=mysql_query("insert into `al` (`up`,`name`) values ('$wd_usern','$alname')");
      if ($x==1)
      {
        echo "������ �������!<br>";
        log_(37,$alname);
        ?><script>window.location.href="clan.php?mode=view";</script><?
      } else echo mysql_error();
      mysql_query("update wduser set `al`='$alname' where `n`='$wd_usern'");
      $al=$alname;
    }
  } echo "$errmes<br>";
}
if (isset($mode) && ($mode=="drop")) 
{
$res=mysql_query("SELECT * FROM `al` WHERE `up`='$wd_usern'");
$res=mysql_query("SELECT * FROM `wduser` WHERE `al`='$al'");
$max=mysql_num_rows($res);
if ($max==1){
mysql_query("update wduser set `al`='' where `n`='$wd_usern'");
mysql_query("delete from al where `up`='$wd_usern'");
log_(38,$al);
$al="";
} else echo "�� �� ������ ������� ������, �.�. � ��� ���� ����. <a href=\"clan.php\">�����</a>";
}

if (isset($mode) && ($mode=="away"))
{
mysql_query("update wduser set `al`='' where `n`='$wd_usern'");
log_(39,$al);
$al="";
}
if (isset($plrn)) $plrn=intval($plrn);
if (isset($mode) && ($mode=="insert" && $plrn>0)) 
{
if ($email!="") 
{
$res=mysql_query("select * from wduser where `n`='$plrn'");
$eml=mysql_result($res,0,'email');

if ($email==$eml) 
{

$x=mysql_query("update wduser set `al`='$al' where `n`='$plrn' and `al`=''");
if ($x==1) {
	inform($wd_usern,$plrn,"�� ���� �������� � ������ <b>$al</b>.");
	log_(40,"$al:$plrn");
}

} else echo "<font color=#990000>��������� e-mail �� ��������� � e-mail'�� ������.</font><br>";
} else echo "<font color=#990000>�� ������ e-mail ������. ��������� ������ � ������ ����������.</font><br>";
}

if (isset($player)) $player=intval($player);
if (isset($mode) && ($mode=="fire" && $player>0))
{
$x=mysql_query("update wduser set `al`='' where `n`='$player' and `n`!='$wd_usern' and `al`='$al'");
if ($x==1) {
	log_(41,"$al:$player");
	inform($wd_usern,$player,"�� ���� � ������� ��������� �� ������� <b>$al</b>.");
}
}

if ($al=="") 
{
echo "<b>�� �� �������� �� � ��� � �������.</b><br><br>";

?>
<form action=<?=$a?> method=post>
<b>������� ���� ������:</b> 
<input name=alname>
<input type=hidden name=mode value=newal>
<input type=submit value="�������">
</form>
<?


}
else
{
echo "�� �������� � ������� <b>$al</b>.<br><br>";

$res=mysql_query("select * from al where name='$al'");

$up=mysql_result($res,0,'up');

$res=mysql_query("select * from wduser where n='$up'");
$llogin=mysql_result($res,0,'login');

echo "����� ������� $al: <b>$llogin</b><br><br>";

$res=mysql_query("select * from wduser where al='$al'");
$max=mysql_num_rows($res);

echo "����� ������� $al (����� $max �������):<br><br>";

for ($i=0;$i<$max;$i++)
{
$n=mysql_result($res,$i,'n');
$login=mysql_result($res,$i,'login');
$email=mysql_result($res,$i,'email');

if (!isset($act)) $act=0;
$dd=$game_day-$act;

echo "<li><b>$login</b> ($email)";
if ($llogin==$wd_username && $login!=$wd_username) echo " ... <a href=$a?mode=fire&player=$n>��������� �� �������</a> ";
}

if ($llogin==$wd_username) 
{
echo "<br><br><b>�� ��������� ������� ����� �������.</b>";
if ($max==1) echo "<br><a href=$a?mode=drop>������� ������</a> (�� ������ ������� ������ ������ ���� � ��� ��� ������ �������).";
else echo "<br>* �� �� ������ ������� ������ ���� � ��� ���� ������";

?>
<form action=<?=$a?> method=post>
<b>�������� � ������ ������:</b> <select name=plrn>
<?
$res=mysql_query("select * from wduser where `n`!='$wd_usern' and `al`='' and `home`='$wd_home' order by `login`");

$max=mysql_num_rows($res);

for ($i=0;$i<$max;$i++)
{
$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'login');

echo "<option value=$n>$name</option>";
}
?>
</select>
e-mail ������: <input name=email> 
<input type=hidden name=mode value=insert>
<input type=submit value="��������">
</form>
<?

}
else echo "<br><br><a href=$a?mode=away>�������� ������</a>";


}











echo "<hr><b>��� �������:</b>";

$res=mysql_query("select * from al");

$max=mysql_num_rows($res);

echo "<table width=100% $paramtable><tr valign=top>
<td $paramhead>���</td>
<td $paramhead>���</td>
<td $paramhead>�����</td>
<td $paramhead>�������</td>
</tr>";

for ($i=0;$i<$max;$i++)
{

$up=mysql_result($res,$i,'up');
$name=mysql_result($res,$i,'name');

$res2=mysql_query("select * from wduser where n='$up'");
$login=@mysql_result($res2,0,'login');
$home=@mysql_result($res2,0,'home');


if ($home==0) $home="�������";
if ($home==1) $home="��������";
if ($home==2) $home="�����";
if ($home==3) $home="���������";
if ($home==4) $home="������";


$res2=@mysql_query("select count(*) from wduser where `al`='$name'");
$plr=@mysql_result($res2,0,'count(*)');

echo "<tr valign=top>
<td>$name</td>
<td>$home</td>
<td>$login</td>
<td>$plr</td>
</tr>";


}

echo "</table><br>* ���� �� ������ �������� � ������ - ����������� ������ �� <a href=mes.php>���������� �����</a> ������ �������.
<br>** ���� ��� �������� � ������ ��� ������ ������� - ������ ���������� (��� *Emperor*). ���������� ����� �������.";

}
include "footer.php";
?>