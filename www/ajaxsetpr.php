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
define('QST','info');
include "quests.php";
include "inc_units.php";

if(isset($wd_base)){
$i=intval($_REQUEST['n']);
$pr=intval($_REQUEST['p']);
$_RESULT = array("result" => "");

//Структуры
if($i==1) $fld="prplace";
if($i==2) $fld="prconstr";
if($i==3) $fld="prwind";
if($i==4) $fld="prrefin";
if($i==5) $fld="prsilo";
if($i==6) $fld="prbar";
if($i==7) $fld="prfact";
if($i==8) $fld="prtech";
if($i==9) $fld="prcosmo";
if($i==10) $fld="prpalace";
if($i==11) $fld="prwall";
if($i==12) $fld="prtower";
if($i==13) $fld="prrtower";
if($i==31) $fld="prtrade";

//Юниты
if($i==21) $fld="prharv";
if($i==22) $fld="prmobconst";
if($i==23) $fld="prlinf";
if($i==24) $fld="prhinf";
if($i==25) $fld="prtank";
if($i==26) $fld="prrtank";
if($i==30) $fld="prhod";




$stop=0;


	switch ($i) {
		case 7: if ($lvl[8] == 0 || $lvl[6] == 0) $stop = 1; break;
		case 9: if ($lvl[8] < 5) $stop = 1; break;
		case 10: if ($lvl[2] < 5 || $lvl[9] == 0) $stop = 1; break;
		case 12: if ($lvl[11] < 1) $stop = 1; break;
		case 13: if ($lvl[12] < 5 || $lvl[8] < 5) $stop = 1; break;
		case 31: if ($lvl[9] == 0) $stop = 1; break;

		case 21: if ($lvl[4] < 1) $stop = 1; break;
		case 22: if ($lvl[7] < 5) $stop = 1; break;
		case 23: if ($lvl[6] < 1) $stop = 1; break;
		case 24: if ($lvl[6] < 3) $stop = 1; break;
		case 25: if ($lvl[7] < 1) $stop = 1; break;
		case 26: if ($lvl[7] < 5) $stop = 1; break;
		case 30: if ($lvl[10] < 1 || $t_hod != 1) $stop = 1; break;
	}


if (!$stop) {
mysql_query("UPDATE `base` SET `$fld`='$pr' WHERE `n`='$wd_base'");
$res="<select name=\"prior$i\">";
for($m=0;$m<21;$m++) {
	if($m==$pr) $sel="SELECTED"; else $sel="";
	$res.="<option value=\"$m\" ".$sel.">$m</option>";
}
$res.="</select>";
$_RESULT = array("result" => "$res");
}
}
?>