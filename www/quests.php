<?php
extract($_GET);
extract($_POST);
if(defined('QST') && !defined('QINFO')){
//����� 1
  $_basename_="*GOLD PALACE*";
  $myres=mysql_query("SELECT * FROM `base` WHERE `name`='$_basename_'");
  if(intval(@mysql_num_rows($myres))!=0){
  	$r=mysql_fetch_array($myres);
  	$bn=$r['n'];
  	$myx=$r['x'];
  	$myy=$r['y'];
  	$harv=$r['harv'];
  	if($wd_base==$bn){
    //##############################   ���������   ##############################
    if(QST=='build'){
  	  if (isset($mode) && $structure!="1")
			{
				$structure=0;
				unset($mode);
      }
    }
    //##############################   �����   ##############################
    if(QST=='units'){
  	  $lvl[2]=50;
    }
    //##############################   ������� �����   ##############################
    if(QST=='tech'){
  	  echo "�� ���� ���� ������ ��������� �����!";
  	  include "footer.php";
  	  die();  
    }
    //##############################   ������ �� ����������   ##############################
    if(QST=='blow'){
  	  echo "��� ���� ������ ��������!";
  	  include "footer.php";
  	  die();  
    }
    //##############################   ������ �� ��������������   ##############################
    if(QST=='bren'){
  	  echo "��� ���� ������ �������������!";
  	  include "footer.php";
  	  die();  
    }
  } else {
  	//##############################   ������� �� �������   ##############################
  	if(QST=='map'){
  		if(isset($x) && isset($y))
  		if($x==$myx && $y==$myy && $harv==0) {
  	    $x=-1;
  	    $y=-1;
  	  }
    }
    //##############################   ��������������� ���������   ##############################
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
  //##############################   �������� �������   ##############################
  if(QST=='del'){
    if (isset($mode) && $mode=="delpro") {
  	  echo "�� �� ������ ������� ���� �������, ��� ��� ������� ����� $_basename_";
  	  include "footer.php";
  	  die();  
  	}
  }
  //##############################   �������� �� �������   ##############################
  if(QST=='stat1' || QST=='stat2'){
  	if($x==$myx && $y==$myy && $harv==0) $hideme=1; else unset($hideme);
  }
}
//����� 2
  $_basename_="*����������� ����*";
  $myres=mysql_query("SELECT * FROM `base` WHERE `name`='$_basename_'");
  if(intval(@mysql_num_rows($myres))!=0){
  while($r=mysql_fetch_array($myres)){
  	$bn=$r['n'];
  	$up=$r['up'];
  	$myx=$r['x'];
  	$myy=$r['y'];
  	$harv=$r['harv'];
  	if($wd_base==$bn){
    //##############################   ���������   ##############################
    if(QST=='build'){
  	  if (isset($mode) && $structure!=0)
			{
				$structure=0;
				unset($mode);
      }
    }
    //##############################   �����   ##############################
    if(QST=='units'){
  	  if(isset($btn)) unset($btn);
    }
    //##############################   ���������   ##############################
    if(QST=='cosmo'){
  	  $destme=1;
    }
    //##############################   ������� �����   ##############################
    if(QST=='tech'){
  	  echo "�� ���� ���� ������ ��������� �����!";
  	  include "footer.php";
  	  die();  
    }
    //##############################   ������ �� ����������   ##############################
    if(QST=='blow'){
  	  echo "��� ���� ������ ��������!";
  	  include "footer.php";
  	  die();  
    }
    //##############################   ������ �� ��������������   ##############################
    if(QST=='bren'){
  	  echo "��� ���� ������ �������������!";
  	  include "footer.php";
  	  die();  
    }
  } else {
  	//##############################   ������� �� �������   ##############################
  	if(QST=='map'){
  		if(isset($x) && isset($y))
  		if($x==$myx && $y==$myy && $up==6) {
  	    $x=-1;
  	    $y=-1;
  	  }
    }
    //##############################   ��������������� ���������   ##############################
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
  //##############################   �������� �������   ##############################
  if(QST=='del'){
    if (isset($mode) && $mode=="delpro") {
  	  echo "�� �� ������ ������� ���� �������, ��� ��� ������� ����� $_basename_";
  	  include "footer.php";
  	  die();  
  	}
  }
  //##############################   �������� �� �������   ##############################
  if(QST=='stat1' || QST=='stat2'){
  	if($x==$myx && $y==$myy && $up==6) $hideme=1; else unset($hideme);
  }
}
}
}
?>