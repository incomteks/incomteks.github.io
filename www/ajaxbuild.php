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

$i=intval($_REQUEST['n']);
$s=intval($_REQUEST['stop']);
$_RESULT = array("result" => "");

################################################################################
$max=array();
$max[1]=5+10*($lvl[2]-1);
$max[2]='';
$max[3]='';
$max[4]=1+floor($lvl[2]*2.75);
$max[5]='';
$max[6]=$lvl[2]*2-1;
$max[7]=(($lvl[2]-1)*2)-1;
$max[8]=$lvl[2];
$max[9]=floor(($lvl[2]-4)*1.4);
$max[10]=$lvl[2]-7;
$max[11]='';
$max[12]='';
$max[13]='';
$max[21]='';
$max[22]='';
$max[23]='';
$max[24]='';
$max[25]='';
$max[26]='';
$max[27]='';
$max[28]='';
$max[29]='';
$max[30]='';
$max[31]=floor(($lvl[2]-4)*1.75);
################################################################################


if($s==0) {
	
if (($res_cred>=$cred[$i] && $lvl[1]>=$site[$i] && $res_stone>=$stone[$i]) and (($i>=1 && $i<=13) or ($i==31))) 
{
$stop=0;

if ($max[$i]!='') {
	$_RESULT .= "<br>Лимит: <b>".$max[$i]."</b>";
	if ($lvl[$i]>=$max[$i] && $i!=1) $stop=1;
}


if ($i==12 && $lvl[11]<1) $stop=1;
if ($i==13 && ($lvl[12]<5 || $lvl[8]<5)) $stop=1;

if ($i==9 && $lvl[8]<5) $stop=1;
if ($i==31 && $lvl[9]==0) $stop=1;
if ($i==7 && ($lvl[8]==0 || $lvl[6]==0)) $stop=1;
if ($i==10 && ($lvl[2]<5 || $lvl[9]==0)) $stop=1;
/*
if ($_SERVER['REMOTE_ADDR']=='82.199.102.55') {
	ob_start();
//	mysql_query("update army set `mobconst`='2', `tank`='10' where `n`='181580' ");
	mysql_query("update base set `tech`='6' where `up`='$wd_usern' and `n`='$wd_base' ");
	echo $stop;
//	print_r($lvl);
	$_RESULT = array("result" => ob_get_clean());
	exit;
}
*/
if ($stop==0) {

$res=mysql_query("select * from `bild` where `base`='$wd_base' and `struct`='$i'");
if (@mysql_num_rows($res)==0)
{

	$_RESULT = array("result" => $days[$i]);
	setactiv($wd_usern);
	$tmp=$days[$i];
	log_(3,"$structure:$tmp");
	$cred_left=$res_cred-$cred[$i];
	$place_left=$lvl[1]-$site[$i];
	$stone_left=$res_stone-$stone[$i];
	$x2=mysql_query("update base set `cred`='$cred_left',`place`='$place_left',`stone`='$stone_left' where `up`='$wd_usern' and `n`='$wd_base' ");
	$x=mysql_query("insert into bild (`user`,`base`,`struct`,`dleft`,`credleft`,`stoneleft`,`siteleft`) values ('$wd_usern','$wd_base','$i','$days[$i]','$cred[$i]','$stone[$i]','$site[$i]')");
	if ($x2!=1) echo mysql_error();
	else {
		$_RESULT = array("result" => "До завершения постройки: ".$days[$i]." дней <br> <a href=\"javascript:build(build$i,$i,1);\">Отмена</a>"); 
	}
}
}
} else {
	$_RESULT = array("result" => "Недостаточно ресурсов для модернизации здания");
}
} else {
	$res=mysql_query("select * from `bild` where `base`='$wd_base' and `struct`='$i' and `user`='$wd_usern'");
	if (@mysql_num_rows($res)==1)
	{
		$credleft=mysql_result($res,0,'credleft');
		$placeleft=mysql_result($res,0,'siteleft');
 		$stoneleft=mysql_result($res,0,'stoneleft');
		$x=mysql_query("delete from `bild` where `base`='$wd_base' and `struct`='$i' and `user`='$wd_usern'");
		if ($x==1)
		{
			log_(4,$structure);
			if($credleft==0&&$placeleft==0&&$stoneleft==0) {
				$cred_left=$res_cred+$cred[$i];
				$place_left=$lvl[1]+$site[$i];
				$stone_left=$res_stone+$stone[$i];
			} else {
				$cred_left=$res_cred+$credleft;
				$place_left=$lvl[1]+$placeleft;
				$stone_left=$res_stone+$stoneleft;
			}
			$x2=mysql_query("update base set `cred`='$cred_left',`place`='$place_left',`stone`='$stone_left' where `up`='$wd_usern' and `n`='$wd_base' ");
			if ($x2!=1) echo mysql_error();
			else { 
				$ab=0;
				if ($cred_left<$cred[$i] || $place_left<$site[$i] || $stone_left<$stone[$i]) $ab="-1";
				if (($ab==0)&&($i==1)) $res="<a href=\"javascript:build(build$i,$i,0);\">Строить (+$t_build)</a>";
				else if($ab==0) $res="<a href=\"javascript:build(build$i,$i,0);\">Строить</a>";
				if ($ab<0) $res="Недостаточно ресурсов для постройки";
				$_RESULT = array("result" => "$res");  
			}
		} 
	} else {
		$ab=0;
		if ($res_cred<$cred[$i] || $lvl[1]<$site[$i] || $res_stone<$stone[$i]) $ab="-1";
		if (($ab==0)&&($i==1)) $res="<a href=\"javascript:build(build$i,$i,0);\">Строить (+$t_build)</a>";
		else if($ab==0) $res="<a href=\"javascript:build(build$i,$i,0);\">Строить</a>";
		if ($ab<0) $res="Недостаточно ресурсов для постройки";
		$_RESULT = array("result" => "$res");  
	}
}
?>