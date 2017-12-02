<?php
extract($_GET);
extract($_POST);
if(defined('QST') && !defined('QINFO')){
//КВЕСТ 1
  $_basename_="*GOLD PALACE*";
  $myres=mysql_query("SELECT * FROM `base` WHERE `name`='$_basename_'");
  if(intval(@mysql_num_rows($myres))!=0){
  	$r=mysql_fetch_array($myres);
  	$bn=$r['n'];
  	$myx=$r['x'];
  	$myy=$r['y'];
  	$harv=$r['harv'];
  	if($wd_base==$bn){
    //##############################   ПОСТРОЙКИ   ##############################
    if(QST=='build'){
  	  if (isset($mode) && $structure!="1")
			{
				$structure=0;
				unset($mode);
      }
    }
    //##############################   ЮНИТЫ   ##############################
    if(QST=='units'){
  	  $lvl[2]=50;
    }
    //##############################   НАУЧНЫЙ ЦЕНТР   ##############################
    if(QST=='tech'){
  	  echo "На этой базе нельзя развивать науку!";
  	  include "footer.php";
  	  die();  
    }
    //##############################   ЗАПРЕТ НА ВЗРЫВЧАТКУ   ##############################
    if(QST=='blow'){
  	  echo "Эту базу нельзя взорвать!";
  	  include "footer.php";
  	  die();  
    }
    //##############################   ЗАПРЕТ НА ПЕРЕИМЕНОВАНИЕ   ##############################
    if(QST=='bren'){
  	  echo "Эту базу нельзя переименовать!";
  	  include "footer.php";
  	  die();  
    }
  } else {
  	//##############################   СКРЫТИЕ ОТ РАДАРОВ   ##############################
  	if(QST=='map'){
  		if(isset($x) && isset($y))
  		if($x==$myx && $y==$myy && $harv==0) {
  	    $x=-1;
  	    $y=-1;
  	  }
    }
    //##############################   ПРОТИВОРАКЕТНАЯ УСТАНОВКА   ##############################
  	if(QST=='hod'){
  		if (isset($hodx) && isset($hody))
  		{
  		  if($hodx==$myx && $hody==$myy) {
    	    $hodx=50;
  	      $hody=50;
  	    }
  	  }
    }
  }
  //##############################   УДАЛЕНИЕ ПРОФИЛЯ   ##############################
  if(QST=='del'){
    if (isset($mode) && $mode=="delpro") {
  	  echo "Вы не можете удалить свой профиль, так как владете базой $_basename_";
  	  include "footer.php";
  	  die();  
  	}
  }
  //##############################   СОКРЫТИЕ ОТ РАДАРОВ   ##############################
  if(QST=='stat1' || QST=='stat2'){
  	if($x==$myx && $y==$myy && $harv==0) $hideme=1; else unset($hideme);
  }
}
//КВЕСТ 2
  $_basename_="*Заброшенная база*";
  $myres=mysql_query("SELECT * FROM `base` WHERE `name`='$_basename_'");
  if(intval(@mysql_num_rows($myres))!=0){
  while($r=mysql_fetch_array($myres)){
  	$bn=$r['n'];
  	$up=$r['up'];
  	$myx=$r['x'];
  	$myy=$r['y'];
  	$harv=$r['harv'];
  	if($wd_base==$bn){
    //##############################   ПОСТРОЙКИ   ##############################
    if(QST=='build'){
  	  if (isset($mode) && $structure!=0)
			{
				$structure=0;
				unset($mode);
      }
    }
    //##############################   ЮНИТЫ   ##############################
    if(QST=='units'){
  	  if(isset($btn)) unset($btn);
    }
    //##############################   КОСМОПОРТ   ##############################
    if(QST=='cosmo'){
  	  $destme=1;
    }
    //##############################   НАУЧНЫЙ ЦЕНТР   ##############################
    if(QST=='tech'){
  	  echo "На этой базе нельзя развивать науку!";
  	  include "footer.php";
  	  die();  
    }
    //##############################   ЗАПРЕТ НА ВЗРЫВЧАТКУ   ##############################
    if(QST=='blow'){
  	  echo "Эту базу нельзя взорвать!";
  	  include "footer.php";
  	  die();  
    }
    //##############################   ЗАПРЕТ НА ПЕРЕИМЕНОВАНИЕ   ##############################
    if(QST=='bren'){
  	  echo "Эту базу нельзя переименовать!";
  	  include "footer.php";
  	  die();  
    }
  } else {
  	//##############################   СКРЫТИЕ ОТ РАДАРОВ   ##############################
  	if(QST=='map'){
  		if(isset($x) && isset($y))
  		if($x==$myx && $y==$myy && $up==6) {
  	    $x=-1;
  	    $y=-1;
  	  }
    }
    //##############################   ПРОТИВОРАКЕТНАЯ УСТАНОВКА   ##############################
  	if(QST=='hod'){
  		if (isset($hodx) && isset($hody))
  		{
  		  if($hodx==$myx && $hody==$myy) {
    	    $hodx=50;
  	      $hody=50;
  	    }
  	  }
    }
  }
  //##############################   УДАЛЕНИЕ ПРОФИЛЯ   ##############################
  if(QST=='del'){
    if (isset($mode) && $mode=="delpro") {
  	  echo "Вы не можете удалить свой профиль, так как владете базой $_basename_";
  	  include "footer.php";
  	  die();  
  	}
  }
  //##############################   СОКРЫТИЕ ОТ РАДАРОВ   ##############################
  if(QST=='stat1' || QST=='stat2'){
  	if($x==$myx && $y==$myy && $up==6) $hideme=1; else unset($hideme);
  }
}
}
}
?>