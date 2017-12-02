<?
extract($_GET);
extract($_POST);
 include "header.php"; 
?>

<p><b>Объединенный зал славы игры Dune2 on-line</b><br>
  Здесь записаны имена героев Дюны. Пусть вечно их помнят потомки и да не заметут пески Араккиса следы их боевых легионов!</p>
Внимание, этот зал славы действует с 16 раунда, старый зал доступен по адресу:
<a href=fame_old.php>http://localhost/fame_old.php</a>
<br><br>
<table width=100% cellspacing="5" border=1>
<tr><th>№</th><th>Игрок</th><th>Кол-во медалей (минус розовый орден)</th><th>Медали</th></tr>
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
  	echo "<tr align=center><td>$i</td><td width=60%><b><font style=\"font-size:14px\" color=blue>$name</font></b></td><td>$col</td><td><a href=fame.php?view=$n>Смотреть</a></td></tr>";
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
  <center><b>Награды игрока <font style="font-size:14px" color=blue><?=$name?></font></b></center>
  <table width=100% cellspacing="5" border=1>
  <tr><th>№</th><th>Медаль</th><th>Название медали</th><th>Медаль дана за:</th></tr>
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


<? } else echo "Такого игрока нет в базе";} ?>
<br><br>
<table cellpadding=5 cellspacing="5">
  <tr>
    <td colspan="3" <?=$paramhead?>>Награды:</td>
  </tr>
  <tr align="center">
    <td><img src="pics/m1.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>ветеран</b></td>
    <td align="left" valign="top">дается только вместе с другими медалями за участие в других раундах игры</td>
  </tr>
  <tr align="center">
    <td><img src="pics/m10.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>за стойкость</b> </td>
    <td align="left" valign="top">за участие в off-line мероприятиях </td>
  </tr>
  <tr align="center">
    <td><img src="pics/m9.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>приз зрительских симпатий </b></td>
    <td align="left" valign="top">присуждается по просьбе других игроков, за личный вклад в игровой процесс </td>
  </tr>
  <tr align="center">
    <td><b><img src="pics/m2.gif" width="20" height="35"></b></td>
    <td align="left" valign="top"><b>медаль за отвагу </b></td>
    <td align="left" valign="top">присуждается за особые боевые заслуги и выполнение квестовых заданий  </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m3.gif" width="20" height="35"><br>      </td>
    <td align="left" valign="top"><b>золотое солнце</b></td>
    <td align="left" valign="top">за успехи в торговле, финансовую поддержку соратников </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m4.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>друг императора </b></td>
    <td align="left" valign="top">за помощь в работе над игрой, обнаружение багов и тестирование </td>
  </tr>
  <tr align="center" valign="top">
    <td><b><img src="pics/m5.gif" width="20" height="35"></b></td>
    <td align="left" valign="top"><b>командир</b></td>
    <td align="left" valign="top">за участие в развитии игры, помощь молодым игрокам и привлечение новых</td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m6.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>герой дюны </b></td>
    <td align="left" valign="top">за уникальные игровые подвиги </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m11.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>розовый орден</b></td>
    <td align="left" valign="top">за сомнительные достижения </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m8.gif" width="20" height="35"></td>
    <td align="left" valign="top"><b>золотая звезда</b> </td>
    <td align="left" valign="top">наивысшая награда за боевые заслуги </td>
  </tr>
  <tr align="center" valign="top">
    <td><img src="pics/m7.gif" width="20" height="35" /></td>
    <td align="left" valign="top"><b>мастер</b></td>
    <td align="left" valign="top">за победу в игре </td>
  </tr>
</table>
<?
include "footer.php"; ?>