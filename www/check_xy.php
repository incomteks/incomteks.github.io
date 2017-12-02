<?php
extract($_GET);
extract($_POST);
  include "connect.php";
  if(isset($x) && isset($y)) {
  	$x=intval($x);
  	$y=intval($y);
  	if($x>=1 && $x<=$dune_x && $y>=1 && $y<=$dune_y) {
  		$res=mysql_query("SELECT * FROM `base` WHERE `x`='$x' and `y`='$y'");
  		echo "<html><body><center><h1>";
  		if(intval(@mysql_num_rows($res))>0) echo "<font color=red>Ёти координаты уже зан€ты!</font>";
  		else echo "<font color=blue> оординаты $x:$y свободны!</font>";
  		echo "</center></h1></body></html>";
  		exit;
  	}
  }
  echo "Ќеверно указаны координаты!";
?>