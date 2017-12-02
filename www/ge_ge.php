<?
/*
function getmicrotime()
{
list($usec, $sec) = explode(" ",microtime());
return ((float)$usec + (float)$sec);
}

$TIME_START = getmicrotime();

$sys_dbhost="localhost";
$sys_dbname="dune";   
$sys_dbuser="nightmind";   
$sys_dbpass="nightpass"; 

mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpass);
mysql_select_db($sys_dbname);

$mul=7;
$mul2=3;

$img = imagecreate(100*$mul+2, 100*$mul+20); 

// Создаем цвета изображения $b - черный цвет (цвет фона), $w - белый. $c - линейки на графике

$w = imagecolorallocate($img, 222, 182, 106); 
$d = imagecolorallocate($img, 210, 170, 80); 
$b = imagecolorallocate($img, 0, 0, 0); 


$a = imagecolorallocate($img, 0, 0, 128); 
$o = imagecolorallocate($img, 0, 128, 0); 
$h = imagecolorallocate($img, 128, 0, 0); 
$e = imagecolorallocate($img, 128, 0, 128); 
$g = imagecolorallocate($img, 128, 128, 128); 

$aa = imagecolorallocate($img, 0, 0, 255); 
$oa = imagecolorallocate($img, 0, 255, 0); 
$ha = imagecolorallocate($img, 255, 0, 0); 
$ea = imagecolorallocate($img, 255, 0, 255); 
$ga = imagecolorallocate($img, 255, 255, 255); 


//imagerectangle($img, 0, 0, $imagewidth-1, $imageheight-1, $b);
//imagerectangle($img, 2, 2, $imagewidth-2, $imageheight-2, $b);

//###################################################

for ($y=1;$y<=100;$y++)
{

for ($x=1;$x<=100;$x++)
{

$y2=101-$y;

$res=mysql_query("select * from `base` where `x`='$x' and `y`='$y2'");

if (mysql_num_rows($res)==0)
{
imagerectangle($img, ($x-1)*$mul, ($y-1)*$mul, ($x)*$mul, ($y)*$mul, $d);
}
else
{
$up=mysql_result($res,0,'up');

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uhome=@mysql_result($res2,0,'home');

if ($uhome==0) $col=$g;
if ($uhome==4) $col=$e; 
if ($uhome==1) $col=$a;
if ($uhome==2) $col=$o; 
if ($uhome==3) $col=$h;

imagerectangle($img, ($x-1)*$mul+1, ($y-1)*$mul+1, ($x)*$mul-1, ($y)*$mul-1, $col);
}
$res=mysql_query("select * from `army` where `x`='$x' and `y`='$y2'");

if (mysql_num_rows($res)!=0) {

$up=mysql_result($res,0,'up');

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uhome=@mysql_result($res2,0,'home');

if ($uhome==0) $col=$ga;
if ($uhome==4) $col=$ea; 
if ($uhome==1) $col=$aa;
if ($uhome==2) $col=$oa; 
if ($uhome==3) $col=$ha;

imagerectangle($img, ($x-1)*$mul+$mul2, ($y-1)*$mul+$mul2, ($x)*$mul-$mul2, ($y)*$mul-$mul2, $col);
}

}

}


$res=mysql_query("select * from `day` limit 1");
$game_day=mysql_result($res,0,'n');

$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START;

imagestring($img,2, 3, 100*$mul+3, "game day: ".$game_day,$b);
imagestring($img,2, 200, 100*$mul+3, "map generated in: ".number_format($TIME_SCRIPT,5,'.','')." sec",$b);


//###################################################

header ("Content-type: image/png"); 
imagepng($img); 

//imagepng($img,"../maps/".$game_day.".png"); 


imagedestroy($img); 
*/
?>