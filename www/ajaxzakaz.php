<?php
extract($_POST);
extract($_GET);
// Load JsHttpRequest backend.
require_once "lib/JsHttpRequest/JsHttpRequest.php";
// Create main library object. You MUST specify page encoding!
$JsHttpRequest =& new JsHttpRequest("windows-1251");
// Store resulting data in $_RESULT array (will appear in req.responseJs).
include "av_func.php";
include "config.php";
include "connect.php";

define('QST','build');
include "quests.php";
include "inc_units.php";
/*
if ($_SERVER['REMOTE_ADDR']=='82.199.102.55') {
	ob_start();
	echo $wd_base;
//	print_r($lvl);
	$_RESULT = array("result" => ob_get_clean());
	exit;
}
*/
/*$lim[21]=$refin;
$lim[22]=$fact-4;
$lim[23]=round($bar*$bar/1.5);
$lim[24]=round(($bar-2)*($bar-1)/1.5);
$lim[25]=round(pow($fact, 0.7));
$lim[26]=round(pow($fact-4, 0.7));
$lim[30]=5;*/

$i=intval($_REQUEST['n']);
$s=intval($_REQUEST['col']);
$_RESULT = array("result" => "");

//if ($lim[21]>($lvl[2]*10-$lvl[21])) $lim[21]=($lvl[2]*10-$lvl[21]);

/*
if ($_SERVER['REMOTE_ADDR']=='82.199.102.55') {
	ob_start();
	echo $_REQUEST['col'];
//	print_r($lvl);
	$_RESULT = array("result" => ob_get_clean());
	exit;
}
*/
if(isset($col))
{
  $col=intval($col);
  if(($col=="nan") || (is_nan($col))) $col[$i]=0;
} else $col=0;
//  $col[$i]=0;

// Проверка доступности постройки (DW)
	switch ($i) {
		case 21: if ($lvl[4] < 1) $col = 0; break;
		case 22: if ($lvl[7] < 5) $col = 0; break;
		case 23: if ($lvl[6] < 1) $col = 0; break;
		case 24: if ($lvl[6] < 3) $col = 0; break;
		case 25: if ($lvl[7] < 1) $col = 0; break;
		case 26: if ($lvl[7] < 5) $col = 0; break;
		case 30: if ($lvl[10] < 1 || $t_hod != 1) $col = 0; break;
	}

if ($col<0) $col=0;
if ($i==21 && $lvl[21]>=$lvl[2]*10) $col=0;
if ($i!=27 && $i!=28 && $i!=29 && $col>0)
{

  //если не хватает заказываем столько, на сколько хватает
  if(($res_cred>=$cred[$i]*$col && $lvl[1]>=$site[$i]*$col && $res_stone>=$stone[$i]*$col) and ($i>=21 && $i<=26) || ($i==30))
    $min=$col;
  else
  {
    $min=floor($res_cred / $cred[$i]);

    if($i==22 || $i==25 || $i==26 || $i==30)
    {
      $min2=floor($lvl[1] / $site[$i]);
      if($min2<$min) $min=$min2;

      if($i==22 || $i==30)
      {
        $min2=floor($res_stone / $stone[$i]);
        if ($min2<$min) $min=$min2;
      }
    }
  }
  if(is_nan($min)) $min=0;
  $zak=$min;

  //заполнение очереди до конца
  $res=mysql_query("select * from `bild` where `base`='$wd_base' and `struct`='$i'");
  if(@mysql_num_rows($res)==0) $is=0;
  else {
    $is=mysql_result($res,0,'col');
    $dd=mysql_result($res,0,'dleft');
  }
// вырублен лимит
//  if ($zak>($lim[$i]-$is)) $zak=($lim[$i]-$is);
  $col2=$is+$zak;

  if($col2<=0) {
    $_RESULT = array("result" => "Недостаточно ресурсов для заказа!");
  }
  elseif ($i!=30 || ($lvl[10]>=1 && $t_hod==1))
  {
    if (@mysql_num_rows($res)==0)
    {
      if ($col2>0) {
        $x=mysql_query("insert into bild (`user`,`base`,`struct`,`dleft`,`col`,`bday`) values ('$wd_usern','$wd_base','$i','$days[$i]','$col2','$days[$i]')");
        $_RESULT = array("result" => "Очередная постройка через <b>".$days[$i]."</b> дней<br>Всего заказано <b>".$col2."</b> юнитов");
      }
    }
    else {
      $x=mysql_query("update bild set `user`='$wd_usern',`col`='$col2',`bday`='$days[$i]' where `base`='$wd_base' and `struct`='$i' ");
      $_RESULT = array("result" => "Очередная постройка через <b>".$dd."</b> дней<br>Всего заказано <b>".$col2."</b> юнитов");
    }

    if(isset($x) && ($x==1))
    {
      //echo "Строительство будет завершено через ".$days[$i]." дней.<br>";
      $cred_left=$res_cred-$cred[$i]*$zak;
      $place_left=$lvl[1]-$site[$i]*$zak;
      $stone_left=$res_stone-$stone[$i]*$zak;

      $res_cred=$cred_left;
      $lvl[1]=$place_left;
      $res_stone=$stone_left;

      setactiv($wd_usern);
      $x2=mysql_query("update base set `cred`='$cred_left',`place`='$place_left',`stone`='$stone_left' where `up`='$wd_usern' and `n`='$wd_base' ");
      log_(7,"$i:$col2");
    }
  }
}
?>