<?
extract($_GET);
extract($_POST);
?>
<script language=javascript>
var g_wndCheck = null;
function check()
{
  var pw = 252;
  var ph = 195;
  var l = screen.width/2-pw/2;
  var t = screen.height/2-ph/2;
  if(g_wndCheck) g_wndCheck.close();
  var x = reg.cc_x.value;
  var y = reg.cc_y.value;
  g_wndCheck = window.open('check_xy.php?x='+x+'&y='+y, '', 'fullscreen=no, titlebar=no, scrollbars=auto, width='+pw+', height='+ph+', left='+l+', top='+t, true);
}
function getRandom(max) {return (Math.floor(Math.random()*max))+1;}
function home()
{
  if(reg.home.value==1){
  	var x=getRandom(15);
  	var y=getRandom(15);
  	var znakx=getRandom(2);
  	var znaky=getRandom(2);
  	var maxx=<?=$dune_x?>;
  	var maxy=<?=$dune_y?>;
  	if(znakx==2) x=-x;
  	if(znaky==2) y=-y;
  	x=maxx-15+x;
  	y=maxy-15+y;
  }
  if(reg.home.value==2){
  	var x=getRandom(15);
  	var y=getRandom(15);
  	var znakx=getRandom(2);
  	var znaky=getRandom(2);
  	var maxx=<?=$dune_x?>;
  	var maxy=<?=$dune_y?>;
  	if(znakx==2) x=-x;
  	if(znaky==2) y=-y;
  	x=maxx/2+x;
  	if(y<-14) y=-14;
  	y=15+y;
  }
  if(reg.home.value==3){
  	var x=getRandom(15);
  	var y=getRandom(15);
  	var znakx=getRandom(2);
  	var znaky=getRandom(2);
  	var maxx=<?=$dune_x?>;
  	var maxy=<?=$dune_y?>;
  	if(znakx==2) x=-x;
  	if(znaky==2) y=-y;
  	if(x<-14) x=-14;
  	x=15+x;
  	y=maxy-15+y;
  }
  reg.cc_x.value=x;
  reg.cc_y.value=y;
}
</script>
<?
if (isset($wd_usertyp))
{
$res=mysql_query("select * from base where up='$wd_usern'");
$max=mysql_num_rows($res);

if ($max==0)
{
if (isset($savebtn))
{
	
$basename=htmlspecialchars($basename,ENT_NOQUOTES);
$errmes="";
if (strlen($basename)>30) $errmes="<font color=red>������������ ����� �������� ���� �� ������ ��������� 30 ��������</font><br>";
if (strrpos($basename,' ') > 0) $errmes="<font color=red>� �������� ���� ������ ������������ �������!</font><br>";
if ((!$basename) || ($basename=="") || (ereg("[^a-zA-Z0-9�-��-�=_@.-]",$basename))) $errmes="<font color=red>������������ ������� � �������� ����</font><br>";
$cc_x=intval($cc_x);
$cc_y=intval($cc_y);
if($cc_x>$dune_x || $cc_x<1 || $cc_y>$dune_y || $cc_y<1) $errmes="������������ ����������!";
if($wd_home==1)
	if($cc_x< ($dune_x-30) || $cc_y< ($dune_y-30)) $errmes = "��������� ���������� �� ������ � ������� ���������� ����";
if($wd_home==2)
	if($cc_x< ($dune_x/2-15) || $cc_x> ($dune_x/2+15) || $cc_y>30) $errmes = "��������� ���������� �� ������ � ������� ���������� ����";
if($wd_home==3)
	if($cc_x>30 || $cc_y< ($dune_y-30)) $errmes = "��������� ���������� �� ������ � ������� ���������� ����";		
$res=mysql_query("SELECT * FROM `base` WHERE `x`='$cc_x' and `y`='$cc_y'");
if(intval(@mysql_num_rows($res))!=0) $errmes="� ���� ����������� ��� ���� ����";
	
if ($errmes=="") {
mysql_query("insert into base(`up`,`name`,`x`,`y`,`constr`,`harv`) values ('$wd_usern','$basename','$cc_x','$cc_y','1','5')");
$wd_base=mysql_insert_id();
$resT=mysql_query("SELECT * FROM `tech` WHERE `up`='$wd_usern'");
$sumT=mysql_result($resT,0,'att')+mysql_result($resT,0,'arm')+mysql_result($resT,0,'engine')+mysql_result($resT,0,'build')+mysql_result($resT,0,'harv')+mysql_result($resT,0,'hod')+mysql_result($resT,0,'orb')+mysql_result($resT,0,'spy');
$resA=mysql_query("SELECT * FROM `army` WHERE `up`='$wd_usern'");
if(@mysql_num_rows($resA)>0) $sumT=$sumT+1;
if($sumT==0) {
  mysql_query("UPDATE `wduser` SET `reg`='$game_day', `act`='$game_day' WHERE `n`='$wd_usern'");
}
log_(15,"$x:$y");
?><script>window.location.href="buildings.php?mode=view";</script><?
} else {
	echo $errmes;
	?>
	<form action=<?=$a?> name=reg method=post>
������� ��� ����� ������� ����
<br>
<input name=basename>
<br>
<fieldset>
<legend>���������� ����</legend>
<table width=100%>
<tr><td width=100 align=center><b>X</b></td><td><input name=cc_x></td></tr>
<tr><td width=100 align=center><b>Y</b></td><td><input name=cc_y></td></tr>
<tr><td colspan=2 align=left><font style="font-size:6pt;">���������: <?=$dune_x-30?>:<?=$dune_y-30?> - <?=$dune_x?>:<?=$dune_y?><br>������: <?=$dune_x/2-15?>:1 - <?=$dune_x/2+15?>:30<br>���������: 1:<?=$dune_y?> - 30:<?=$dune_y-30?></font></td></tr>
<tr><td colspan=2><a href=dunefullmap.html target=_blank>�����</a> <a href="javascript:home()">� ����</a> <a href="javascript:check()">���������</a></td></tr>
</table>
</fieldset>
<input type=submit name=savebtn value=���������>
</form>
<?
}
} else { 
?>
<form action=<?=$a?> name=reg method=post>
<input type=hidden name=home value='<?=$wd_home?>'>
������� ��� ����� ������� ����
<br>
<input name=basename>
<br>
<fieldset>
<legend>���������� ����</legend>
<table width=100%>
<tr><td width=100 align=center><b>X</b></td><td><input name=cc_x></td></tr>
<tr><td width=100 align=center><b>Y</b></td><td><input name=cc_y></td></tr>
<tr><td colspan=2 align=left><font style="font-size:6pt;">���������: <?=$dune_x-30?>:<?=$dune_y-30?> - <?=$dune_x?>:<?=$dune_y?><br>������: <?=$dune_x/2-15?>:1 - <?=$dune_x/2+15?>:30<br>���������: 1:<?=$dune_y?> - 30:<?=$dune_y-30?></font></td></tr>
<tr><td colspan=2><a href=dunefullmap.html target=_blank>�����</a> <a href="javascript:home()">� ����</a> <a href="javascript:check()">���������</a></td></tr>
</table>
</fieldset>
<input type=submit name=savebtn value=���������>
</form>
<?
}
} 
else
{
$res=mysql_query("SELECT * FROM `day`");
$round=mysql_result($res,0,'round');
echo "<table width=100%><tr><td $paramhead >�����: $round</td></tr><tr><td $paramhead >������� ����: $game_day</td></tr><tr><td>��������� �����: <b>".date("H:i:s")."</b><br>���� ������� ���� = 3 ������</td></table>";
?>
<form action=<?=$a?> method=post>
<center>
<select name=basenumber style="width:200px">
<?
$res=mysql_query("select n,name from base where up='$wd_usern' order by `name`");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
echo "<option value=".mysql_result($res,$i,'n')." ";
if (mysql_result($res,$i,'n')==$wd_base) echo "SELECTED";
echo " >".mysql_result($res,$i,'name')."</option>";
}
?>
</select><br><br>
<input type=submit name=baseselect value='������� ����'>
</center>
</form>
<?
}


}
?>
