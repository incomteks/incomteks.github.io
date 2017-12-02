<?php
extract($_POST);
extract($_GET);
//Фильтрация данных...
function filter ($string,$type) 
{ 
if ($type=="message"){
$string = trim($string); 
for( $i=0; eregi("\r\n\r\n",$string); $i++){$string = ereg_replace("\r\n\r\n","\r\n",$string);} 
for( $i=0; eregi("\n\n",$string); $i++){$string = ereg_replace("\n\n","\n",$string);} 
for( $i=0; eregi("  ",$string); $i++){$string = ereg_replace("  "," ",$string);} 
$string = ereg_replace("<","&lt;",$string);
$string = ereg_replace('\\\"',"&quot;",$string);
$string = ereg_replace('\\"',"&quot;",$string);
$string = ereg_replace("!","&#33;",$string);
$string = ereg_replace("\r\n","<br>",$string);
$string = ereg_replace("\n","<br>",$string);
$string = ereg_replace("%","&#37;",$string);
$string = ereg_replace("^ +","",$string);
$string = ereg_replace(" +$","",$string);
$string = ereg_replace(" +"," ",$string);
$string = str_replace('\"','&quot;',$string); 
$string = str_replace("\'","&quot;",$string); 
$string = str_replace("\&","&",$string); 
}
if ($type=="name") {
	$string=htmlspecialchars($string,ENT_NOQUOTES);
}
return $string;
} 

function log_($act,$data)
{
	global $wd_username,$wd_usern;
	$dt=date("d.m.Y");
	$tm=date("H:i:s");
	$file=fopen("log/$dt.log","a+");
	$ip=$_SERVER['REMOTE_ADDR'];
	$url=$_SERVER['REQUEST_URI'];
	$warn=0;
	if($tm==""||$ip==""||$act==""||$data==""||$url=="") $warn=1;
	fwrite($file,"$tm,$ip,$wd_usern,$wd_username,$act,$data,$url,$warn\n");
	fclose($file);
	return 0;
}

function sess_on($id)
{
	if(file_exists("userflags/$id.fl")) {
		return 0;
	} else {
		$f=fopen("userflags/$id.fl","w+");
		fwrite($f,"1");
		fclose($f);
		return 1;
	}
}

function sess_off($id)
{
	if(file_exists("userflags/$id.fl")) {
			echo "<br>unlinking";
			unlink("userflags/$id.fl");
			return 1;
	} else {
		return 0;
	}
}

function techlog($act)
{
	return 0;
}

function setactiv($n) {
	mysql_query("UPDATE `wduser` SET `notactiv`='0' WHERE `n`='$n'");
}
?>