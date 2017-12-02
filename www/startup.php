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
if (strlen($basename)>30) $errmes="<font color=red>Максимальная длина названия базы не должна превышать 30 символов</font><br>";
if (strrpos($basename,' ') > 0) $errmes="<font color=red>В названии базы нельзя использовать пробелы!</font><br>";
if ((!$basename) || ($basename=="") || (ereg("[^a-zA-Z0-9А-Яа-я=_@.-]",$basename))) $errmes="<font color=red>Недопустимые символы в названии базы</font><br>";
$cc_x=intval($cc_x);
$cc_y=intval($cc_y);
if($cc_x>$dune_x || $cc_x<1 || $cc_y>$dune_y || $cc_y<1) $errmes="Неправильные координаты!";
if($wd_home==1)
	if($cc_x< ($dune_x-30) || $cc_y< ($dune_y-30)) $errmes = "Указанные координаты не входят в границу выбранного дома";
if($wd_home==2)
	if($cc_x< ($dune_x/2-15) || $cc_x> ($dune_x/2+15) || $cc_y>30) $errmes = "Указанные координаты не входят в границу выбранного дома";
if($wd_home==3)
	if($cc_x>30 || $cc_y< ($dune_y-30)) $errmes = "Указанные координаты не входят в границу выбранного дома";		
$res=mysql_query("SELECT * FROM `base` WHERE `x`='$cc_x' and `y`='$cc_y'");
if(intval(@mysql_num_rows($res))!=0) $errmes="В этих координатах уже есть база";
	
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
Введите имя Вашей главной базы
<br>
<input name=basename>
<br>
<fieldset>
<legend>Координаты базы</legend>
<table width=100%>
<tr><td width=100 align=center><b>X</b></td><td><input name=cc_x></td></tr>
<tr><td width=100 align=center><b>Y</b></td><td><input name=cc_y></td></tr>
<tr><td colspan=2 align=left><font style="font-size:6pt;">Атрейдесы: <?=$dune_x-30?>:<?=$dune_y-30?> - <?=$dune_x?>:<?=$dune_y?><br>Ордосы: <?=$dune_x/2-15?>:1 - <?=$dune_x/2+15?>:30<br>Харконены: 1:<?=$dune_y?> - 30:<?=$dune_y-30?></font></td></tr>
<tr><td colspan=2><a href=dunefullmap.html target=_blank>Карта</a> <a href="javascript:home()">В доме</a> <a href="javascript:check()">Проверить</a></td></tr>
</table>
</fieldset>
<input type=submit name=savebtn value=Сохранить>
</form>
<?
}
} else { 
?>
<form action=<?=$a?> name=reg method=post>
<input type=hidden name=home value='<?=$wd_home?>'>
Введите имя Вашей главной базы
<br>
<input name=basename>
<br>
<fieldset>
<legend>Координаты базы</legend>
<table width=100%>
<tr><td width=100 align=center><b>X</b></td><td><input name=cc_x></td></tr>
<tr><td width=100 align=center><b>Y</b></td><td><input name=cc_y></td></tr>
<tr><td colspan=2 align=left><font style="font-size:6pt;">Атрейдесы: <?=$dune_x-30?>:<?=$dune_y-30?> - <?=$dune_x?>:<?=$dune_y?><br>Ордосы: <?=$dune_x/2-15?>:1 - <?=$dune_x/2+15?>:30<br>Харконены: 1:<?=$dune_y?> - 30:<?=$dune_y-30?></font></td></tr>
<tr><td colspan=2><a href=dunefullmap.html target=_blank>Карта</a> <a href="javascript:home()">В доме</a> <a href="javascript:check()">Проверить</a></td></tr>
</table>
</fieldset>
<input type=submit name=savebtn value=Сохранить>
</form>
<?
}
} 
else
{
$res=mysql_query("SELECT * FROM `day`");
$round=mysql_result($res,0,'round');
echo "<table width=100%><tr><td $paramhead >Раунд: $round</td></tr><tr><td $paramhead >Игровой день: $game_day</td></tr><tr><td>системное время: <b>".date("H:i:s")."</b><br>один игровой день = 3 минуты</td></table>";
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
<input type=submit name=baseselect value='Выбрать базу'>
</center>
</form>
<?
}


}
?>
