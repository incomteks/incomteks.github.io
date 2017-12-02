<?
set_time_limit(90);

function getmicrotime(){
list($usec, $sec) = explode(" ",microtime());
return ((float)$usec + (float)$sec);
}

function log_ ($s)
{
	$dt=date("d.m.Y");
	$tm=date("H:i:s");
	$file=fopen("/usr/home/www/dune1/public_html/log/$dt"."_daily.log","a+");
	//$file=fopen("$dt"."_daily.log","a+");
	$ip=$_SERVER['REMOTE_ADDR'];
	fwrite($file,"[$tm] [$ip] - $s\n");
	fclose($file);
	return $s;
}

function inform($ot,$to,$dsc)
{
$time=date("Y-m-d H:i:s");
$dsc = ereg_replace("\n","<br>",$dsc);
mysql_query("insert into `mes` values ('','$ot','$to','$dsc','$time','2','0','1')");
}

$TIME_START = getmicrotime();

include "/home/dune/data/www/dune-2.ru/config.php";

$dune_x=150;
$dune_y=150;
$granica=true;

// соединение с сервером MySQL

if(!mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpass))
{
   echo "Не могу соединиться с базой !<br>";
   echo mysql_error();
   exit;
}
// else echo "Соединение с базой прошло успешно !<br>";

mysql_select_db($sys_dbname);

$res=mysql_query("select * from `day` limit 1");
$n=mysql_result($res,0,'n');

$nx=$n+1;

mysql_query("update `day` set `n`='$nx' where `n`='$n'");

echo "R1 День $nx <br><br>\n\n";

// ДОБАВКА ГРАНИТА И КРЕДИТОВ ИЗ СБОР ДВОРОВ

echo "\n\n<br><br>Проверка Баз <br><br>\n\n";
// log_("Проверка баз");


$res=mysql_query("select * from base");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$upcred=0;
$upstone=0;

$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'name');

$up=mysql_result($res,$i,'up');

$constr=mysql_result($res,$i,'constr');

$wind=mysql_result($res,$i,'wind');
$refin=mysql_result($res,$i,'refin');
$silo=mysql_result($res,$i,'silo');
$bar=mysql_result($res,$i,'bar');
$fact=mysql_result($res,$i,'fact');

$tech=mysql_result($res,$i,'tech');
$cosmo=mysql_result($res,$i,'cosmo');
$palace=mysql_result($res,$i,'palace');

$trade=mysql_result($res,$i,'trade');
$rtower=mysql_result($res,$i,'rtower');
$tower=mysql_result($res,$i,'tower');


$rest=mysql_query("select * from `tech` where `up`='$up'");
$t_harv=@mysql_result($rest,0,'harv');
$t_build=@mysql_result($rest,0,'build');

$sumb=$constr+$refin+$silo+$bar+$fact+$tech+$cosmo+$palace+$trade+$tower+$rtower;

$energy=5+$wind*5;

echo "База $n. Строений $sumb, энергии $energy. ";

$stone=mysql_result($res,$i,'stone');
$cred=mysql_result($res,$i,'cred');
$spice=mysql_result($res,$i,'spice');

$harv=mysql_result($res,$i,'harv');

$upstone=$stone+3+$constr;
$upcred=$cred+$constr*10+$cosmo*20+$palace*50;

$coef=rand(2,6)/4;

$spiceup=$coef*$harv*(3+$t_harv);
$spice=$spice+$spiceup;

$resuser=mysql_query("select * from wduser where `n`='$up'");
$userspice=intval(@mysql_result($resuser,0,'spice'))+$spiceup;
mysql_query("update wduser set `spice`='$userspice' where `n`='$up'");

$coef=rand(2,6)/4;

$refin_power=($refin+round($coef*($refin*$refin/2)))*5;

if ($energy>=$sumb)
{
$spice=$spice-$refin_power;
$upcred=$upcred+$refin_power;

if ($spice<0)
{
$upcred=$upcred+$spice;
$spice=0;
}

echo " Энергии достаточно. Спайса $spice (добыто $spiceup, переработано $refin_power, кредитов $upcred).<br>\n";
}
else
{
echo " Энергии нехватает.<br>\n";
if (rand(1,10)==5) inform("0",$up,"На базе $name приостановлена переработка спайса.\nНе достаточно энергии, нужны дополнительные электростанции.");
}


if ($spice>(500+$silo*500)) $spice=500+$silo*500;

$lvl[1]=@mysql_result($res,$i,'place');
$lvl[2]=@mysql_result($res,$i,'constr');
$lvl[3]=@mysql_result($res,$i,'wind');
$lvl[4]=@mysql_result($res,$i,'refin');
$lvl[5]=@mysql_result($res,$i,'silo');
$lvl[6]=@mysql_result($res,$i,'bar');
$lvl[7]=@mysql_result($res,$i,'fact');
$lvl[8]=@mysql_result($res,$i,'tech');
$lvl[9]=@mysql_result($res,$i,'cosmo');
$lvl[10]=@mysql_result($res,$i,'palace');
$lvl[11]=@mysql_result($res,$i,'wall');
$lvl[12]=@mysql_result($res,$i,'tower');
$lvl[13]=@mysql_result($res,$i,'rtower');
$lvl[21]=@mysql_result($res,$i,'harv');
$lvl[22]=@mysql_result($res,$i,'mobconst');
$lvl[23]=@mysql_result($res,$i,'linf');
$lvl[24]=@mysql_result($res,$i,'hinf');
$lvl[25]=@mysql_result($res,$i,'tank');
$lvl[26]=@mysql_result($res,$i,'rtank');
$lvl[27]=@mysql_result($res,$i,'spec1');
$lvl[28]=@mysql_result($res,$i,'spec2');
$lvl[29]=@mysql_result($res,$i,'spec3');
$lvl[30]=@mysql_result($res,$i,'hod');
$lvl[31]=@mysql_result($res,$i,'trade');

//максимумы
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

unset ($stone);
unset ($cred);
unset ($site);
unset ($days);

$stone[1]=2+round($lvl[1]/2);
$cred[1]=5;
$site[1]=0;
$days[1]=1;
$stone[2]=30+50*$lvl[2];
$cred[2]=1000*round(pow(2,$lvl[2]/1.1));
$site[2]=2*$lvl[2];
$days[2]=10*$lvl[2];
$stone[3]=5*(5+round($lvl[3]/2));
$cred[3]=20+20*round(pow(2,$lvl[3]/1.4));
$site[3]=1;
$days[3]=3+$lvl[3];
$stone[4]=10+15*$lvl[4];
$cred[4]=100*round(pow(2,$lvl[4]/1.2));
$site[4]=2;
$days[4]=5+5*$lvl[4];
$stone[5]=5+round($lvl[5]/2);
$cred[5]=15*round(pow(2,$lvl[5]/1.1));
$site[5]=1;
$days[5]=2+2*$lvl[5];
$stone[6]=5*(1+$lvl[6]);
$cred[6]=45*round(pow(2,$lvl[6]/1.1));
$site[6]=1;
$days[6]=5+5*$lvl[6];
$stone[7]=15+15*$lvl[7];
$cred[7]=125*round(pow(2,$lvl[7]/1.1));
$site[7]=2;
$days[7]=7+6*$lvl[7];
$stone[8]=10+10*$lvl[8];
$cred[8]=500*round(pow(2,$lvl[8]/1.1));
$site[8]=1;
$days[8]=10+8*$lvl[8];
$stone[9]=100+56*$lvl[9];
$cred[9]=5000*round(pow(2,$lvl[9]/1.1));
$site[9]=4;
$days[9]=15+10*$lvl[9];
$stone[10]=1000+1000*$lvl[10];
$cred[10]=1000000*round(pow(2,$lvl[10]/1.1));
$site[10]=10;
$days[10]=50+50*$lvl[10];
$stone[11]=20+round(pow(2,$lvl[11]));
$cred[11]=20*round(pow(2,$lvl[11]/1.2));
$site[11]=1;
$days[11]=5+round(10*$lvl[11]/$t_build);
$stone[12]=50+2*round(pow(2,$lvl[12]/1.2));
$cred[12]=25*round(pow(2,$lvl[12]/1.2));
$site[12]=1;
$days[12]=10+round(14*$lvl[12]/$t_build);
$stone[13]=100+2*round(pow(2,$lvl[13]/1.2));
$cred[13]=500*round(pow(2,$lvl[13]/1.2));
$site[13]=2;
$days[13]=31+round(24*$lvl[13]/$t_build);
$stone[21]=0;
$cred[21]=300;
$site[21]=0;
$days[21]=@ceil(20/$lvl[4]);
$stone[22]=100;
$cred[22]=10000;
$site[22]=1;
$days[22]=@ceil(1000/$lvl[7]);
$stone[23]=0;
$cred[23]=100;
$site[23]=0;
$days[23]=@ceil(10/$lvl[6]);
$stone[24]=0;
$cred[24]=250;
$site[24]=0;
$days[24]=@ceil(20/$lvl[6]);
$stone[25]=0;
$cred[25]=3000;
$site[25]=1;
$days[25]=@ceil(250/$lvl[7]);
$stone[26]=0;
$cred[26]=7500;
$site[26]=1;
$days[26]=@ceil(500/$lvl[7]);
$stone[27]=0;
$cred[27]=3000;
$site[27]=0;
$days[27]=0;
$stone[28]=0;
$cred[28]=10000;
$site[28]=0;
$days[28]=0;
$stone[29]=0;
$cred[29]=5000;
$site[29]=0;
$days[29]=0;
$stone[30]=50000;
$cred[30]=500000;
$site[30]=5;
$days[30]=round(100/($lvl[10]+1));
$stone[31]=85+62*$lvl[31];
$cred[31]=2500*round(pow(2,$lvl[31]/1.1));
$site[31]=2;
$days[31]=10+10*$lvl[31];


//Заполняем приоритеты
$prior[1]=@mysql_result($res,$i,'prplace');
$prior[2]=@mysql_result($res,$i,'prconstr');
$prior[3]=@mysql_result($res,$i,'prwind');
$prior[4]=@mysql_result($res,$i,'prrefin');
$prior[5]=@mysql_result($res,$i,'prsilo');
$prior[6]=@mysql_result($res,$i,'prbar');
$prior[7]=@mysql_result($res,$i,'prfact');
$prior[8]=@mysql_result($res,$i,'prtech');
$prior[9]=@mysql_result($res,$i,'prcosmo');
$prior[10]=@mysql_result($res,$i,'prpalace');
$prior[11]=@mysql_result($res,$i,'prwall');
$prior[12]=@mysql_result($res,$i,'prtower');
$prior[13]=@mysql_result($res,$i,'prrtower');
$prior[21]=@mysql_result($res,$i,'prharv');
$prior[22]=@mysql_result($res,$i,'prmobconst');
$prior[23]=@mysql_result($res,$i,'prlinf');
$prior[24]=@mysql_result($res,$i,'prhinf');
$prior[25]=@mysql_result($res,$i,'prtank');
$prior[26]=@mysql_result($res,$i,'prrtank');
$prior[30]=@mysql_result($res,$i,'prhod');
$prior[31]=@mysql_result($res,$i,'prtrade');
$maxharv=$lvl[2]*10;

arsort($prior);
reset($prior);
$prev_pr=0;
unset($brk);

if($name!="*GOLD PALACE*" && $name!="*Заброшенная база*")
while(list($key,$val)=each($prior)){
	if($val>0){
		if(isset($brk)) {
		  if($prev_pr!=$val) break;
    }
		$prev_pr=$val;
		$resb=mysql_query("SELECT * FROM `bild` WHERE `base`='$n' AND `struct`='$key'");
		if(@mysql_num_rows($resb)==0) {
			$stop=0;
			if($max[$key]!='' && $lvl[$key]>=$max[$key]) $stop=1;
			if($stop==0){
				if(($upcred>=$cred[$key]) && ($upstone>=$stone[$key]) && ($lvl[1]>=$site[$key])) {
			  	$dd=$days[$key];
			  	$dd_now=$dd;
			  	$col=1;
			  	echo "<br>Автопостройка $key, затрачено: $cred[$key] кр., $stone[$key] кам., $site[$key] места. Требуется $dd дней!";
			  	mysql_query("INSERT INTO `bild` (`n`,`user`,`base`,`struct`,`dleft`,`col`,`bday`,`buff`) values ('','$up','$n','$key','$dd_now','$col','$dd','')");
			  	$lvl[1]=$lvl[1]-$site[$key];
			  	$upcred=$upcred-$cred[$key];
			  	$upstone=$upstone-$stone[$key];
			  } else $brk=1;
		  }
		}
	}
}

mysql_query("update `base` set `stone`='$upstone',`cred`='$upcred',`spice`='$spice',`place`='$lvl[1]' where n='$n'");
}


// Заказы из торговой площади
$resT=mysql_query("SELECT * FROM `tradeorder`");
if(@mysql_num_rows($resT)>0){
	while($r=mysql_fetch_array($resT)){
		$n=$r['n'];
		$up=$r['up'];
		$base=$r['base'];
		$item=$r['item'];
		$col=$r['col'];
		$dd=$r['days']-1;
		if($dd<=0){
			$resB=mysql_query("SELECT * FROM `base` WHERE `n`='$base'");
			if(@mysql_num_rows($resB)>0){
				$rb=mysql_fetch_array($resB);
				if($rb['up']==$up) {
					if($item==20) $fld="stone";
					if($item==21) $fld="harv";
					if($item==22) $fld="mobconst";
					if($item==23) $fld="linf";
					if($item==24) $fld="hinf";
					if($item==25) $fld="tank";
					if($item==26) $fld="rtank";
					if($item==30) $fld="hod";
					$val=$rb[$fld]+$col;
					mysql_query("UPDATE `base` SET `$fld`='$val' WHERE `n`='$base'");
					mysql_query("DELETE FROM `tradeorder` WHERE `n`='$n'");
				} else mysql_query("DELETE FROM `tradeorder` WHERE `n`='$n'");
			} else mysql_query("DELETE FROM `tradeorder` WHERE `n`='$n'");
		}
		else
			mysql_query("UPDATE `tradeorder` SET `days`='$dd' WHERE `n`='$n'");
	}
}

// СТРОИТЕЛЬСТВО

// log_("Строительство");
echo "\n\n<br><br>Строительство <br><br>\n\n";

$res=mysql_query("select * from bild");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$n=mysql_result($res,$i,'n');
$usr=mysql_result($res,$i,'user');

$res_u=mysql_query("select * from `wduser` where `n`='$usr'");
$status=@mysql_result($res_u,0,'status');

if ($status==0)
{

$dleft=mysql_result($res,$i,'dleft');
$base=mysql_result($res,$i,'base');
$struct=mysql_result($res,$i,'struct');

$rest=mysql_query("select * from `tech` where `up`='$usr'");
$t_build=@mysql_result($rest,0,'build');

$dleft2=$dleft-1;
echo "База $base постройка $struct срок: $dleft -> $dleft2 <br>\n";
if ($dleft2<=0)
{

if ($struct==1)  $field="place";
if ($struct==2)  $field="constr";
if ($struct==3)  $field="wind";
if ($struct==4)  $field="refin";
if ($struct==5)  $field="silo";
if ($struct==6)  $field="bar";
if ($struct==7)  $field="fact";
if ($struct==8)  $field="tech";
if ($struct==9)  $field="cosmo";
if ($struct==10) $field="palace";
if ($struct==11) $field="wall";
if ($struct==12) $field="tower";
if ($struct==13) $field="rtower";

if ($struct==21) $field="harv";
if ($struct==22) $field="mobconst";
if ($struct==23) $field="linf";
if ($struct==24) $field="hinf";
if ($struct==25) $field="tank";
if ($struct==26) $field="rtank";

if ($struct==30) $field="hod";
if ($struct==31) $field="trade";

//строительство юнитов
if ($struct==21 || $struct==22 || $struct==23 || $struct==24 || $struct==25 || $struct==26 || $struct==30)
{
$col=mysql_result($res,$i,'col');
$col=$col-1;

$res2=mysql_query("select * from `base` where `n`='$base'");
if(@mysql_num_rows($res2)==0) $col=0;
else {
$val=mysql_result($res2,0,$field);
$field2=$val+1;
mysql_query("update `base` set $field='$field2' where `n`='$base'");

$lvl[1]=@mysql_result($res2,0,'place');
$lvl[2]=@mysql_result($res2,0,'constr');
$lvl[3]=@mysql_result($res2,0,'wind');
$lvl[4]=@mysql_result($res2,0,'refin');
$lvl[5]=@mysql_result($res2,0,'silo');
$lvl[6]=@mysql_result($res2,0,'bar');
$lvl[7]=@mysql_result($res2,0,'fact');
$lvl[8]=@mysql_result($res2,0,'tech');
$lvl[9]=@mysql_result($res2,0,'cosmo');
$lvl[10]=@mysql_result($res2,0,'palace');
$lvl[11]=@mysql_result($res2,0,'wall');
$lvl[12]=@mysql_result($res2,0,'tower');
$lvl[13]=@mysql_result($res2,0,'rtower');
$lvl[21]=@mysql_result($res2,0,'harv');
$lvl[22]=@mysql_result($res2,0,'mobconst');
$lvl[23]=@mysql_result($res2,0,'linf');
$lvl[24]=@mysql_result($res2,0,'hinf');
$lvl[25]=@mysql_result($res2,0,'tank');
$lvl[26]=@mysql_result($res2,0,'rtank');
$lvl[27]=@mysql_result($res2,0,'spec1');
$lvl[28]=@mysql_result($res2,0,'spec2');
$lvl[29]=@mysql_result($res2,0,'spec3');
$lvl[30]=@mysql_result($res2,0,'hod');
$lvl[31]=@mysql_result($res2,0,'trade');

$days[1]=1;
$days[2]=10*$lvl[2];
$days[3]=3+$lvl[3];
$days[4]=5+5*$lvl[4];
$days[5]=2+2*$lvl[5];
$days[6]=5+5*$lvl[6];
$days[7]=7+6*$lvl[7];
$days[8]=10+8*$lvl[8];
$days[9]=15+10*$lvl[9];
$days[10]=50+50*$lvl[10];
$days[11]=5+round(10*$lvl[11]/$t_build);
$days[12]=10+round(14*$lvl[12]/$t_build);
$days[13]=31+round(24*$lvl[13]/$t_build);
$days[21]=@ceil(20/$lvl[4]);
$days[22]=@ceil(1000/$lvl[7]);
$days[23]=@ceil(10/$lvl[6]);
$days[24]=@ceil(20/$lvl[6]);
$days[25]=@ceil(250/$lvl[7]);
$days[26]=@ceil(500/$lvl[7]);
$days[27]=0;
$days[28]=0;
$days[29]=0;
$days[30]=round(100/($lvl[10]+1));
$days[31]=10+10*$lvl[31];

$bday=$days[$struct];

}

if ($col<=0)
mysql_query("delete from `bild` where n='$n'");
else
mysql_query("update `bild` set `col`='$col',`dleft`='$bday' where `n`='$n'");
}


else
{
$res2=mysql_query("select * from `base` where `n`='$base'");
$val=mysql_result($res2,0,$field);
$harv=mysql_result($res2,0,'harv');

if ($struct==1) $field2=$val+$t_build;
else $field2=$val+1;

mysql_query("update `base` set $field='$field2' where `n`='$base'");

mysql_query("delete from `bild` where n='$n'");

}
} else mysql_query("update `bild` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
} }


// Перемещения
// log_("Перемещения");

echo "\n\n<br><br>Перемещения <br><br>\n\n";

$res=mysql_query("select * from `move`");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$n=mysql_result($res,$i,'n');
$up=mysql_result($res,$i,'up');

$newx=mysql_result($res,$i,'x');
$newy=mysql_result($res,$i,'y');

$dleft=mysql_result($res,$i,'dleft');
$hday=mysql_result($res,$i,'hday');
$direct=mysql_result($res,$i,'direct');

$resa=mysql_query("SELECT * FROM `army` where `n`='$up'");
$r=mysql_fetch_array($resa);
$aup=$r['up'];
$rest=mysql_query("SELECT * FROM `tech` where `up`='$aup'");
$nrows=@mysql_num_rows($rest);
$r=mysql_fetch_array($rest);
$hday=5-$r['engine'];

$dleft2=$dleft-1;
echo "Армия $up перемещение в точку $newx:$newy срок: $dleft -> $dleft2 <br>\n";

if ($dleft2<=0)
{
  $res2=mysql_query("select * from `army` WHERE `n`='$up'");
  if (mysql_num_rows($res2)>0) {
    $r=mysql_fetch_array($res2);
    $x=$r['x'];
    $y=$r['y'];
    if ($direct==1) $y++;
    if ($direct==2) $x++;
    if ($direct==3) $y--;
    if ($direct==4) $x--;

    if(!$granica) {
      if ($x<=0) $x=$dune_x;
      if ($y<=0) $y=$dune_y;
      if ($x>$dune_x) $x=1;
      if ($y>$dune_y) $y=1;
    } else {
      if ($x<=0) $x=1;
      if ($y<=0) $y=1;
      if ($x>$dune_x) $x=$dune_x;
      if ($y>$dune_y) $y=$dune_y;
    }
    mysql_query("update `army` set `x`='$x',`y`='$y' where `n`='$up'");

    if (($newx==$x) && ($newy==$y))
      mysql_query("delete from `move` where n='$n'");
    else
      mysql_query("update `move` SET `dleft`='$hday' where n='$n'");
  }
  else
    mysql_query("DELETE FROM `move` WHERE n='$n'");
}
else
  mysql_query("update `move` set `dleft`='$dleft2' where `n`='$n'");
echo mysql_error();
}


// Рука смерти

echo "\n\n<br><br>Ракетные атаки <br><br>\n\n";

$res=mysql_query("select * from `hod`");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$n=mysql_result($res,$i,'n');
$up=mysql_result($res,$i,'up');
$x=mysql_result($res,$i,'x');
$y=mysql_result($res,$i,'y');
$dleft=mysql_result($res,$i,'dleft');

$dleft2=$dleft-1;
echo "Атака квадрата $x:$y срок: $dleft -> $dleft2 <br>\n";
if ($dleft2<=0)
{
mysql_query("delete from `hod` where n='$n'");

$res2=mysql_query("select * from `army` where `x`='$x' and `y`='$y'");
for ($j=0;$j<mysql_num_rows($res2);$j++)
{
$n2=mysql_result($res2,$j,'n');
$up2=mysql_result($res2,$j,'up');
$name2=mysql_result($res2,$j,'name');

inform("0",$up2,"Ваша армия $name2, находившаяся в квадрате [$x:$y] была уничтожена в результате ракетной атаки.");
inform("0",$up,"Ваша ракета уничтожила армию $name2 в квадрате [$x:$y].");

mysql_query("delete from `army` where `n`='$n2'");
}

// АТАКА БАЗ

$res2=mysql_query("select * from `base` where `x`='$x' and `y`='$y'");
for ($j=0;$j<mysql_num_rows($res2);$j++)
{
$n2=mysql_result($res2,$j,'n');
$up2=mysql_result($res2,$j,'up');
$name2=mysql_result($res2,$j,'name');

$constr=rand(floor(mysql_result($res2,$j,'constr')*0.75),mysql_result($res2,$j,'constr'));
$wind=rand(floor(mysql_result($res2,$j,'wind')*0.75),mysql_result($res2,$j,'wind'));
$refin=rand(floor(mysql_result($res2,$j,'refin')*0.75),mysql_result($res2,$j,'refin'));
$bar=rand(floor(mysql_result($res2,$j,'bar')*0.75),mysql_result($res2,$j,'bar'));
$fact=rand(floor(mysql_result($res2,$j,'fact')*0.75),mysql_result($res2,$j,'fact'));
$tech=rand(floor(mysql_result($res2,$j,'tech')*0.75),mysql_result($res2,$j,'tech'));
$cosmo=rand(floor(mysql_result($res2,$j,'cosmo')*0.75),mysql_result($res2,$j,'cosmo'));

$silo=rand(floor(mysql_result($res2,$j,'silo')*0.75),mysql_result($res2,$j,'silo'));

$wall=rand(floor(mysql_result($res2,$j,'wall')*0.75),mysql_result($res2,$j,'wall'));
$tower=rand(floor(mysql_result($res2,$j,'tower')*0.5),mysql_result($res2,$j,'tower'));
$rtower=rand(floor(mysql_result($res2,$j,'rtower')*0.5),mysql_result($res2,$j,'rtower'));

$harv=rand(floor(mysql_result($res2,$j,'harv')*0.75),mysql_result($res2,$j,'harv'));
$tank=rand(0,mysql_result($res2,$j,'tank'));
$rtank=rand(0,mysql_result($res2,$j,'rtank'));

$palace=rand(floor(mysql_result($res2,$j,'palace')*0.75),mysql_result($res2,$j,'palace'));

$x5=mysql_query("update `base` set `silo`='$silo',`palace`='$palace',`cosmo`='$cosmo',`constr`='$constr',`wind`='$wind',`refin`='$refin',`bar`='$bar',`fact`='$fact',`tech`='$tech',`harv`='$harv',`tank`='$tank',`rtank`='$rtank',`linf`='0',`hinf`='0',`tower`='$tower',`rtower`='$rtower',`wall`='$wall',`mobconst`='0' where `n`='$n2'");

if ($x5==1)
{
inform("0",$up2,"Ваша база $name2, в квадрате [$x:$y] подверглась ракетной атаке.");
inform("0",$up,"Ваша ракета поразила базу $name2 в квадрате [$x:$y].");
} else echo mysql_error();

}



} else mysql_query("update `hod` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
}




// Исследования

// log_("Исследования");
echo "\n\n<br><br>Исследования <br><br>\n\n";

$res=mysql_query("select * from `res`");

for ($i=0;$i<mysql_num_rows($res);$i++)
{
$n=mysql_result($res,$i,'n');
$up=mysql_result($res,$i,'up');

$struct=mysql_result($res,$i,'struct');
$dleft=mysql_result($res,$i,'dleft');

$dleft2=$dleft-1;

echo "Игрок $up исследование $struct срок: $dleft -> $dleft2 <br>\n";

if ($dleft2<=0)
{

if ($struct==1)  $field="att";
if ($struct==2)  $field="arm";
if ($struct==3)  $field="engine";
if ($struct==4)  $field="build";
if ($struct==5)  $field="harv";
if ($struct==6)  $field="hod";
if ($struct==7)  $field="orb";
if ($struct==8)  $field="spy";


$res2=mysql_query("select * from `tech` where `up`='$up'");
if(@mysql_num_rows($res2)>0) $val=mysql_result($res2,0,$field);
else $val=0;

$field2=$val+1;

mysql_query("update `tech` set $field='$field2' where `up`='$up'");
mysql_query("delete from `res` where n='$n'");

if($struct==3) {
  $eng=5-$field2;
  mysql_query("update `move` set `hday`='$eng' where `up`='$up'");
}
inform("0",$up,"Вы завершили очередное исследование.\nОбратитесь в научный центр за дополнительной информацией.");

} else mysql_query("update `res` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
}



// Космопорт

echo "\n\n<br><br>Космопорт<br><br>\n\n";

$res=mysql_query("select * from `space`");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$n=mysql_result($res,$i,'n');
$up=mysql_result($res,$i,'up');
$tup=mysql_result($res,$i,'tup');
$tx=mysql_result($res,$i,'fx');
$ty=mysql_result($res,$i,'fy');
$dleft=mysql_result($res,$i,'dleft');
$x=mysql_result($res,$i,'x');
$y=mysql_result($res,$i,'y');
$res4=mysql_query("select * from `base` where `x`='$x' and `y`='$y'");
if(@mysql_num_rows($res4)>0) $up3=mysql_result($res4,0,'up'); else $up3=0;
if($tup!=$up3) {
	echo "<br>$tx:$ty";
	$res2=mysql_query("select * from `base` where `x`='$tx' and `y`='$ty'");
	if(@mysql_num_rows($res2)>0) {
		$up2=mysql_result($res2,0,'up');
	  $cosmo=mysql_result($res2,0,'cosmo');
	} else {
		$up2=0;
		$cosmo=1;
	}
	if($up!=$up2) {
	  $res3=mysql_query("select * from `base` where `up`='$up' order by `n`");
	  if(@mysql_num_rows($res3)>0) {
	  	$dl=ceil(20/$cosmo);
	  	$x=mysql_result($res3,0,'x');
	  	$y=mysql_result($res3,0,'y');
		  mysql_query("UPDATE `space` SET `x`='$x',`y`='$y',`fx`='$x',`fy`='$y',`tup`='$up',`dleft`='$dl' WHERE `n`='$n'");
  		inform(0,$up,'База на которую отправлялся груз, захвачена врагом. <br>А так же база, с которой отправлялся груз тоже захвачена врагом!<br>В связи с этим груз перенаправлен на одну из других ваших баз.');
	  } else {
	  	mysql_query("delete from `space` where n='$n'");
	  }
	} else {
		$ndl=ceil(20/$cosmo);
		$dl=$ndl-$dleft;
		if($dl<=0) $dl=1;
		mysql_query("UPDATE `space` SET `x`='$tx',`y`='$ty',`fx`='$tx',`fy`='$ty',`tup`='$up',`dleft`='$dl' WHERE `n`='$n'");
		inform(0,$up,'База на которую отправлялся груз, захвачена врагом. Ваш груз возвращается назад.');
	}
} else {

$stone=mysql_result($res,$i,'stone');
$cred=mysql_result($res,$i,'cred');
$linf=mysql_result($res,$i,'linf');
$hinf=mysql_result($res,$i,'hinf');
$tank=mysql_result($res,$i,'tank');
$rtank=mysql_result($res,$i,'rtank');

$harv=mysql_result($res,$i,'harv');
$mobconst=mysql_result($res,$i,'mobconst');

$dleft2=$dleft-1;

echo "Отправка $n в квадрат $x:$y срок: $dleft -> $dleft2 <br>\n";

if ($dleft2<=0)
{

$res2=mysql_query("select * from `base` where `x`='$x' and `y`='$y' and `cosmo`>0");

$n2=mysql_result($res2,0,'n');
$up2=mysql_result($res2,0,'up');


$stone2=mysql_result($res2,0,'stone')+$stone;
$cred2=mysql_result($res2,0,'cred')+$cred;
$linf2=mysql_result($res2,0,'linf')+$linf;
$hinf2=mysql_result($res2,0,'hinf')+$hinf;
$tank2=mysql_result($res2,0,'tank')+$tank;
$rtank2=mysql_result($res2,0,'rtank')+$rtank;

$harv2=mysql_result($res2,0,'harv')+$harv;
$mobconst2=mysql_result($res2,0,'mobconst')+$mobconst;

mysql_query("update `base` set `stone`='$stone2',`cred`='$cred2',`linf`='$linf2',`hinf`='$hinf2',`tank`='$tank2',`rtank`='$rtank2',`harv`='$harv2',`mobconst`='$mobconst2' where `n`='$n2'");
mysql_query("delete from `space` where n='$n'");


$resu=mysql_query("select login from `wduser` where `n`='$up'");
$login=mysql_result($resu,0,'login');

if($up!=$up2) {
inform("0",$up,"Ваш груз доставлен в точку $x:$y.\n\n Груз содержал:\nКредиты: $cred \nГранит: $stone\nЛегкая пехота: $linf \nТяжелая пехота: $hinf \nТанки: $tank \nРакетные танки: $rtank \nХарвестеры: $harv \nМобильные командные центры: $mobconst ");
inform("0",$up2,"Вам доставлен груз от игрока $login:\nКредиты: $cred \nГранит: $stone\nЛегкая пехота: $linf \nТяжелая пехота: $hinf \nТанки: $tank \nРакетные танки: $rtank \nХарвестеры: $harv \nМобильные командные центры: $mobconst ");
} else
  inform("0",$up,"Переброска груза завершена $login:\nКредиты: $cred \nГранит: $stone\nЛегкая пехота: $linf \nТяжелая пехота: $hinf \nТанки: $tank \nРакетные танки: $rtank \nХарвестеры: $harv \nМобильные командные центры: $mobconst ");


} else mysql_query("update `space` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
}
}





// Заказ войск

echo "\n\n<br><br>Заказ войск<br><br>\n\n";

$res=mysql_query("select * from `trade`");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$n=mysql_result($res,$i,'n');
$up=mysql_result($res,$i,'up');

$x=mysql_result($res,$i,'x');
$y=mysql_result($res,$i,'y');

$resb=mysql_query("SELECT * FROM `base` WHERE `x`='$x' and `y`='$y'");
if(@mysql_num_rows($resb)>0) $bup=mysql_result($resb,0,'up');
else $bup=0;

if($up!=$bup){
	$resbb=mysql_query("SELECT * FROM `base` WHERE `up`='$up' and `cosmo`>0 order by `n`");
	if(@mysql_num_rows($resbb)>0) {
		$x=mysql_result($resbb,0,'x');
		$y=mysql_result($resbb,0,'y');
		$tr=mysql_query("UPDATE `trade` set `x`='$x',`y`='$y',`up`='$up' where `n`='$n'");
		if ($tr>0)
inform(0,$up,"Ваша база была захвачена врагом, в связи с этим заказ гильдии перенаправлен на другую вашу базу, с координатами $x:$y");
else inform(0,$up,"Сатанинский баг с обновлением координат пересылки.");
	} else {
		mysql_query("DELETE FROM `trade` WHERE `n`='$n'");
		inform(0,$up,"Ваша база захвачена врагом, у вас больше нет баз способных принять груз, поэтому ваш заказ будет анулирован!");
	}
}

$linf=mysql_result($res,$i,'linf');
$hinf=mysql_result($res,$i,'hinf');
$tank=mysql_result($res,$i,'tank');
$rtank=mysql_result($res,$i,'rtank');

$harv=mysql_result($res,$i,'harv');
$mobconst=mysql_result($res,$i,'mobconst');

$dleft=mysql_result($res,$i,'dleft');

$dleft2=$dleft-1;

echo "Доставка $n в квадрат $x:$y срок: $dleft -> $dleft2 <br>\n";

if ($dleft2<=0)
{


$res2=mysql_query("select * from `base` where `x`='$x' and `y`='$y' and `cosmo`>0");

$n2=mysql_result($res2,0,'n');
$up2=mysql_result($res2,0,'up');

$linf2=mysql_result($res2,0,'linf')+$linf;
$hinf2=mysql_result($res2,0,'hinf')+$hinf;
$tank2=mysql_result($res2,0,'tank')+$tank;
$rtank2=mysql_result($res2,0,'rtank')+$rtank;

$harv2=mysql_result($res2,0,'harv')+$harv;
$mobconst2=mysql_result($res2,0,'mobconst')+$mobconst;

mysql_query("update `base` set `linf`='$linf2',`hinf`='$hinf2',`tank`='$tank2',`rtank`='$rtank2',`harv`='$harv2',`mobconst`='$mobconst2' where `n`='$n2'");
mysql_query("delete from `trade` where n='$n'");

inform("0",$up,"Торговая гильдия выполнила ваш заказ. На базу [$x:$y] доставлены:\n\nЛегкая пехота: $linf \nТяжелая пехота: $hinf \nТанки: $tank \nРакетные танки: $rtank \nХарвестеры: $harv \nМобильные командные центры: $mobconst ");

} else mysql_query("update `trade` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
}




//################################################ подсчёт лимита войск
$users=0;
$res=mysql_query("select * from wduser where `typ`='0'");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$n=mysql_result($res,$i,'n');
$reso=mysql_query("select count(*) from base where up='$n'");
$baz=mysql_result($reso,0,'count(*)');

if ($baz>0) $users++;

}

$cost=0;

//гарнизоны баз
$res=mysql_query("select * from base");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$linf=mysql_result($res,$i,'linf');
$hinf=mysql_result($res,$i,'hinf');
$tank=mysql_result($res,$i,'tank');
$rtank=mysql_result($res,$i,'rtank');
$cost=($cost + $linf * 100 + $hinf * 250 + $tank * 3000 + $rtank * 7500);
}

//армии
$res=mysql_query("select * from army");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$n=mysql_result($res,$i,'n');
$linf=mysql_result($res,$i,'linf');
$hinf=mysql_result($res,$i,'hinf');
$tank=mysql_result($res,$i,'tank');
$rtank=mysql_result($res,$i,'rtank');
$cost=($cost + $linf * 100 + $hinf * 250 + $tank * 3000 + $rtank * 7500);
$round_=mysql_result($res,$i,'round');
if($round_>0) {
	$round_=$round_-1;
	mysql_query("UPDATE `army` SET `round`='$round_' WHERE `n`='$n'");
}
}

//$limit= ceil($cost * 5 /$users) + 100;
$limit= ceil($cost/$users);

$res=mysql_query("select * from `day`");
$n=mysql_result($res,0,'n');
mysql_query("update `day` set `limit`='$limit' where `n`='$n'");

//Удаление неактивных аккаунтов, с базами.
echo "<br><br>Проверка активности игроков<br>";
$res=mysql_query("SELECT * FROM `wduser` WHERE `login`!='*GOLD PALACE*'");
while($resarr=mysql_fetch_array($res)){
	$notactiv=$resarr['notactiv'];

	//не парим админов
	$typ=$resarr['typ'];
	if($typ==0)
	{
	$n=$resarr['n'];
	$al=$resarr['al'];
	$name=$resarr['login'];
	$code=$resarr['actcode'];
	$res_b=mysql_query("SELECT * FROM `base` WHERE `up`='$n'");
	$max_b=@mysql_num_rows($res_b);
	if($max_b==0) $base_lvl=0; else {
		if($max_b==1) $base_lvl=mysql_result($res_b,0,'constr'); else $base_lvl=2;
	}

	//echo "Игрок $name неактивен $notactiv дней<br>";
	if($notactiv==1700 && $n!=1 && $n!=6) inform(0,$n,"<font color=red>Внимание! Ваш аккаунт неактивен в течении 1700 игровых дней.<br>Если вы не выполните одно из перечисленных действий (постройка здания, постройка юнитов, заказ юнитов в гильдии, пересылка ресурсов через космопорт, любой приказ армии, исследовние науки), на любой вашей базе, ваши армии и все <br>базы будут уничтожены через 300 игровых дней</font>");
	if(($notactiv==2000 && $n!=1 && $n!=6) || ($notactiv>=999 && $base_lvl==1 && $n!=1 && $n!=6)) {
		mysql_query("DELETE FROM `army` WHERE `up`='$n'");
		mysql_query("DELETE FROM `base` WHERE `up`='$n'");
	  mysql_query("DELETE FROM `bild` WHERE `user`='$n'");
	  mysql_query("DELETE FROM `move` WHERE `up`='$n'");
	  mysql_query("DELETE FROM `res` WHERE `up`='$n'");
	  mysql_query("DELETE FROM `space` WHERE `up`='$n'");
	  mysql_query("DELETE FROM `trade` WHERE `up`='$n'");
//	  log_("Игрок $name не был активен в течении 1000 игровых дней. Все его базы и армии удалены.");
	  inform(0,1,"Игрок $name не был активен в течении 1000 игровых дней. Все его базы и армии удалены.");
	  echo "<br>$name удален";
	}
/*	if($notactiv>=10000 && $n!=1 && $n!=6) {
	  mysql_query("DELETE FROM `hod` WHERE `up`='$n'");
	  mysql_query("DELETE FROM `tech` WHERE `up`='$n'");
	  mysql_query("DELETE FROM `trade` WHERE `up`='$n'");
	  mysql_query("DELETE FROM `wduser` WHERE `n`='$n'");
	  if($al!="") {
	  	$res=mysql_query("SELECT * FROM `al` WHERE `up`='$n'");
	  	if(intval(@mysql_num_rows($res))>0) {
	  		mysql_query("DELETE FROM `al` WHERE `up`='$n'");
	  		mysql_query("UPDATE `wduser` SET `al`='' WHERE `al`='$al'");
	  	}
	  }
//	  log_("Игрок $name не был активен в течении месяца. Он удален из базы.");*/
	}
	$notactiv+=1;
	mysql_query("UPDATE `wduser` SET `notactiv`='$notactiv' WHERE `n`='$n'");
}

//Задания админов...
echo "<br>Проверяем задания админов...<br>";
$res=mysql_query("SELECT * FROM `tasks`");
while($resarr=mysql_fetch_array($res)) {
	$taskname=$resarr['name'];
	$n=$resarr['n'];
	if($taskname=="restart") {
		$rdatetime=$resarr['parchar1'];
		if(date("d.m.y - H:i")>=$rdatetime) {
			echo "Задание РЕСТАРТ, ВЫПОЛНИТЬ!<br>";
			//mysql_query("delete from `wduser` where n!=1 and n!=6");
			mysql_query("delete from `base`");
			mysql_query("delete from `army`");
			mysql_query("delete from `mes`");
			mysql_query("delete from `space`");
			mysql_query("delete from `hod`");
			mysql_query("delete from `al`");
			mysql_query("delete from `bild`");
			mysql_query("delete from `move`");
			mysql_query("delete from `res`");
			mysql_query("delete from `trade`");
			mysql_query("delete from `tech`");
			mysql_query("INSERT INTO `tech` ( `n` , `up` , `att` , `arm` , `engine` , `build` , `harv` , `hod` , `orb` , `spy` ) VALUES (NULL , '1', '5', '5', '3', '10', '10', '1', '3', '1')");
			mysql_query("INSERT INTO `tech` ( `n` , `up` , `att` , `arm` , `engine` , `build` , `harv` , `hod` , `orb` , `spy` ) VALUES (NULL , '6', '0', '0', '1', '5', '3', '0', '0', '0')");
			mysql_query("UPDATE `day` SET `n` = '1' LIMIT 1");
			mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) VALUES (NULL , '1', 'Cydonia', '75', '100', '0', '5000000', '100000', '100', '50', '30', '15', '15', '50', '25', '5', '15', '15', '10', '10', '5', '100', '0', '0', '0', '0', '0', '10000', '100', '0', '100', '5')");
			mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) VALUES (NULL , '6', 'Freemonia', '76', '100', '0', '100000', '10', '10', '10', '5', '0', '5', '10', '5', '2', '3', '3', '5', '5', '0', '50', '0', '0', '0', '0', '0', '0', '0', '10000', '0', '0')");
			mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) VALUES (NULL , '6', 'Freemonia', '74', '100', '0', '100000', '10', '10', '10', '5', '0', '5', '10', '5', '2', '3', '3', '5', '5', '0', '50', '0', '0', '0', '0', '0', '0', '0', '10000', '0', '0')");
			mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) VALUES (NULL , '6', 'Freemonia', '75', '101', '0', '100000', '10', '10', '10', '5', '0', '5', '10', '5', '2', '3', '3', '5', '5', '0', '50', '0', '0', '0', '0', '0', '0', '0', '10000', '0', '0')");
			mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) VALUES (NULL , '6', 'Freemonia', '75', '99', '0', '100000', '10', '10', '10', '5', '0', '5', '10', '5', '2', '3', '3', '5', '5', '0', '50', '0', '0', '0', '0', '0', '0', '0', '10000', '0', '0')");

			//Удаление неактивных игроков - не админов.
			$res=mysql_query("SELECT * FROM `wduser` WHERE `login`!='*GOLD PALACE*' and `typ`='0' and `notactiv`>='10000'");
			for ($i=0;$i<mysql_num_rows($res);$i++){
			$n=mysql_result($res,$i,'n');
			if($n!=1 && $n!=6)
			mysql_query("DELETE FROM `wduser` WHERE `n`='$n'");
//	  log_("Игрок $name не был активен в течении месяца. Он удален из базы.");
			}

			$res=mysql_query("SELECT * FROM `wduser` WHERE `n`!='1' AND `n`!='6'");
			while($r=mysql_fetch_array($res)){
				$basename=$r['login'];
				$usern=$r['n'];
				mysql_query("INSERT INTO `tech` (`n`,`up`,`att`,`arm`,`engine`,`build`,`harv`) VALUES ('','$usern','0','0','0','1','0')");
			}
			mysql_query("update `wduser` set `spice`='0', `act`='0', `reg`='0', `bal`='0', `al`='' WHERE n!=1 AND n!=6");
			mysql_query("OPTIMIZE TABLE `al` , `army` , `base` , `bild` , `day` , `hod` , `mes` , `move` , `res` , `space` , `tech` , `trade` , `wdatr` , `wdobj` , `wduser` ");
			inform(0,1,'Рестарт выполнен');
			$nx=0;
			mysql_query("DELETE FROM `tasks` WHERE `n`='$n'");
		}
	}
}
//###########    КВЕСТЫ    ############
echo "ПРОВЕРКА КВЕСТОВ<br>";
if($nx>=1000){
	//Квест 1
	$res=mysql_query("SELECT * FROM `base` WHERE `name`='*GOLD PALACE*'");
	if(intval(@mysql_num_rows($res))==0){
		$stop=0;
		while($stop!=1){
			$x=rand(1,$dune_x);
			$y=rand(1,$dune_y);
			$res=mysql_query("SELECT * FROM `base` WHERE `x`='$x' and `y`='$y'");
			if(intval(@mysql_num_rows($res))==0) $stop=1; else $stop=0;
		}
		mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) VALUES ('','1','*GOLD PALACE*','$x','$y','0','0','0','0','25','0','0','5','50','25','1','25','25','10','0','0','0','0','0','0','0','0','0','0','1500','0','10')");;
		echo mysql_error();
		echo "Квест 1 запущен!";
		inform(0,1,'Квест1 запущен');
	}
//Квест 2 - создание нулевых фрименских баз
	if($nx==1000){
	$res=mysql_query("SELECT * FROM `base` WHERE `name`='*Заброшенная база*'");
	if(intval(@mysql_num_rows($res))<3){
		$stop=3;
		while($stop!=0){
			$x=rand(1,$dune_x);
			$y=rand(1,$dune_y);
			$res=mysql_query("SELECT * FROM `base` WHERE `x`='$x' and `y`='$y'");
			if(intval(@mysql_num_rows($res))==0) {
				$stop--;
				mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) VALUES ('','6','*Заброшенная база*','$x','$y','0','0','0','0','10','5','2','0','2','0','0','0','0','10','1','0','0','0','500','200','10','5','0','0','0','0','0')");;
			}
		}
		echo mysql_error();
		echo "Квест 2 запущен!";
		inform(0,1,'Квест2 запущен');
	}
  }
}
//Квест 2 - поступление кредитов на 100 день после захвата
$res=mysql_query("SELECT * FROM `base` WHERE `name`='*Заброшенная база*'");
if(@mysql_num_rows($res)!=0){
  while($r=mysql_fetch_array($res)){
  	$up=$r['up'];
  	if($up!=1 && $up!=6){
  		$getday=$r['addon1'];
  		$usedays=$nx-$getday;
  		if($usedays==100) {
  			$n=$r['n'];
  			$cred=$r['cred']+rand(100000,200000);
  			mysql_query("UPDATE `base` SET `cred`='$cred', `addon1`='$nx' WHERE `n`='$n'");
  		}
  	}
  }
}
//#####################################




//################################################ RANDOM BASES
//log_("inc1");
//include "ai.php"
//log_("inc2");
//include "/usr/home/www/dune1/public_html/sys/ai.php";

echo "\n\n<br><br>Монстры<br><br>\n\n";

function bolnul($cif)
{
if ($cif<0) $cif=0;
return round($cif);
}

//Функция движения фрименов
function goto($n,$x,$y,$targ){
	$resa=mysql_query("SELECT * FROM `army` WHERE `n`='$n'");
	$mx=mysql_result($resa,0,'x');
	$my=mysql_result($resa,0,'y');
	if($mx==$x && $my==$y) ; else
	if($mx!=$x && $my!=$y){
		$rnd=rand(0,1);
		if($rnd==0){
			if($x>$mx) $mx++;
			else $mx--;
		} else {
			if($y>$my) $my++;
			else $my--;
		}
	} elseif($mx!=$x) {
		if($x>$mx) $mx++;
		else $mx--;
	} else {
		if($y>$my) $my++;
		else $my--;
	}
	//echo "<br>$n -> $mx:$my (=>$x:$y|$targ)";
	mysql_query("UPDATE `army` SET `x`='$mx',`y`='$my',`targ`='$targ' WHERE `n`='$n'");
}
//Функция атаки базы
function attack_base($n1,$n2){
	echo "<br>Фримен $n1 атакует базу $n2";
	$res1=mysql_query("select * from `army` where `n`='$n1'");
if (mysql_num_rows($res1)==1)
{
	$up1=mysql_result($res1,0,'up');
	$resname=mysql_query("select * from `wduser` where `n`='$up1'");
	$wd_username=mysql_result($resname,0,'login');
	$x=mysql_result($res1,0,'x');
	$y=mysql_result($res1,0,'y');
$res2=mysql_query("select * from `base` where `n`='$n2'");
if (mysql_num_rows($res2)>=1)
{
	$rest1=mysql_query("select * from `tech` where `up`='$up1'");
	$techatt[1]=@mysql_result($rest1,0,'att');
	$techarm[1]=@mysql_result($rest1,0,'arm');
	$rang[1]=mysql_result($res1,0,'rang');
	$wins[1]=mysql_result($res1,0,'wins');
	$armn[1]=mysql_result($res1,0,'name');
	$linf[1]=mysql_result($res1,0,'linf');
	$hinf[1]=mysql_result($res1,0,'hinf');
	$tank[1]=mysql_result($res1,0,'tank');
	$rtank[1]=mysql_result($res1,0,'rtank');
	$costall[1]=$linf[1]*100+$hinf[1]*250+$tank[1]*3000+$rtank[1]*7500;
	$tower[1]="0";
	$rtower[1]="0";
	$wall[1]="0";
	$sard[1]=mysql_result($res1,0,'spec1');
	$deva[1]=mysql_result($res1,0,'spec2');
	$free[1]=mysql_result($res1,0,'spec3');
	$up=mysql_result($res2,0,'up');
	$enemysn=$up;
	$res3=mysql_query("select login from `wduser` where `n`='$up'");
	$enemy=@mysql_result($res3,0,'login');
	$rest2=mysql_query("select * from `tech` where `up`='$up'");
	$techatt[2]=@mysql_result($rest2,0,'att');
	$techarm[2]=@mysql_result($rest2,0,'arm');
	$army2_n=mysql_result($res2,0,'n');
  $rang[2]=0;
  $armn[2]=mysql_result($res2,0,'name');
	$linf[2]=mysql_result($res2,0,'linf');
	$hinf[2]=mysql_result($res2,0,'hinf');
	$tank[2]=mysql_result($res2,0,'tank');
	$rtank[2]=mysql_result($res2,0,'rtank');
	$tower[2]=mysql_result($res2,0,'tower');
	$rtower[2]=mysql_result($res2,0,'rtower');
	$wall[2]=mysql_result($res2,0,'wall');
	$costall[2]=$linf[2]*100+$hinf[2]*250+$tank[2]*3000+$rtank[2]*7500+$tower[2]*3000+$rtower[2]*7000;
	$sard[2]=mysql_result($res2,0,'spec1');
	$deva[2]=mysql_result($res2,0,'spec2');
	$free[2]=mysql_result($res2,0,'spec3');
	$techarm[2]+=$wall[2];
if ($sard[1]>0 || $sard[2]>0 || $deva[1]>0 || $deva[2]>0 || $free[1]>0 || $free[2]>0) $unit="super"; else $unit="";
$itxt="";
$itxt.="Армия <b>".$armn[1]."</b> атакует вашу базу <b>".$armn[2]."</b><br><br>";

for ($i=1;$i<=2;$i++)
{
if (!isset($techatt[$i]) || $techatt[$i]=="") $techatt[$i]=0;
if (!isset($techarm[$i]) || $techarm[$i]=="") $techarm[$i]=0;
}
// ########################################### начало расчета боя
$i=1;
$sum[$i]=$armn[$i]+$linf[$i]+$hinf[$i]+$tank[$i]+$rtank[$i]+$sard[$i]+$deva[$i]+$free[$i];
$i=2;
$sum[$i]=$armn[$i]+$linf[$i]+$hinf[$i]+$tank[$i]+$rtank[$i]+$sard[$i]+$deva[$i]+$free[$i]+$tower[$i]+$rtower[$i];
$f=1;
// задание номеров юнитов, должно быть согласовано с очерёдностью атаки
$unit_n[-1]=12;
$unit_n[0]=13;
$unit_n[1]=26;
$unit_n[2]=28;
$unit_n[3]=25;
$unit_n[4]=27;
$unit_n[5]=24;
$unit_n[6]=29;
$unit_n[7]=23;

$war_n[23]="<b>Легкая пехота</b>";
$war_c[23]=1;
$war_a1[23]=3;
$war_a2[23]=1;
$war_hp[23]=50;
$war_n[24]="<b>Тяжелая пехота</b>";
$war_c[24]=1;
$war_a1[24]=2;
$war_a2[24]=8;
$war_hp[24]=90;
$war_n[25]="<b>Танк</b>";
$war_c[25]=2;
$war_a1[25]=33;
$war_a2[25]=90;
$war_hp[25]=1200;
$war_n[26]="<b>Ракетный танк</b>";
$war_c[26]=2;
$war_a1[26]=250;
$war_a2[26]=100;
$war_hp[26]=2200;
$war_n[27]="<b>Сардукар</b>";
$war_c[27]=1;
$war_a1[27]=10;
$war_a2[27]=20;
$war_hp[27]=200;
$war_n[28]="<b>Разрушитель</b>";
$war_c[28]=2;
$war_a1[28]=75;
$war_a2[28]=90;
$war_hp[28]=7500;
$war_n[29]="<b>Фримен</b>";
$war_c[29]=1;
$war_a1[29]=20;
$war_a2[29]=12;
$war_hp[29]=150;
$war_n[12]="<b>Оружейная башня</b>";
$war_c[12]=1;
$war_a1[12]=250;
$war_a2[12]=120;
$war_hp[12]=3000;
$war_n[13]="<b>Ракетная башня</b>";
$war_c[13]=2;
$war_a1[13]=400;
$war_a2[13]=400;
$war_hp[13]=4000;

// ########################################### запуск цикла фаз боя

while ($sum[1]>0 && $sum[2]>0)
{
// ########################################### перебор игроков

for ($j=2;$j>=1;$j--)
{
if ($j==1) $ej=2;
else $ej=1;

// ########################################### перебор юнитов
for ($i=-1;$i<=7;$i++)
{
// задание очерёдности атаки юнитов и числа юнитов в i-ом отряде
$unit_q[-1]=$tower[$j];
$unit_q[0]=$rtower[$j];
$unit_q[1]=$rtank[$j];
$unit_q[2]=$deva[$j];
$unit_q[3]=$tank[$j];
$unit_q[4]=$sard[$j];
$unit_q[5]=$hinf[$j];
$unit_q[6]=$free[$j];
$unit_q[7]=$linf[$j];
if ($unit_q[$i]>0)
{
$target=0;
                if ( 26 == $unit_n[$i] )
                {
                         if ($sard[$ej]>0)   { $target=27; }
                    else if ($free[$ej]>0)   { $target=29; }
                    else if ($linf[$ej]>0)   { $target=23; }
                    else if ($hinf[$ej]>0)   { $target=24; }
                    else if ($deva[$ej]>0)   { $target=28; }
                    else if ($rtank[$ej]>0)  { $target=26; }
                    else if ($tank[$ej]>0)   { $target=25; }
                    else if ($tower[$ej]>0)  { $target=12; }
                    else if ($rtower[$ej]>0) { $target=13; }
                }
           else if ( ( 25 == $unit_n[$i] ) ||
                     ( 28 == $unit_n[$i] ) ||
                     ( 13 == $unit_n[$i] ) )
                {
                         if ($deva[$ej]>0)   { $target=28; }
                    else if ($tank[$ej]>0)   { $target=25; }
                    else if ($rtank[$ej]>0)  { $target=26; }
                    else if ($sard[$ej]>0)   { $target=27; }
                    else if ($free[$ej]>0)   { $target=29; }
                    else if ($linf[$ej]>0)   { $target=23; }
                    else if ($hinf[$ej]>0)   { $target=24; }
                    else if ($rtower[$ej]>0) { $target=13; }
                    else if ($tower[$ej]>0)  { $target=12; }
                }
           else if ( ( 24 == $unit_n[$i] ) ||
                     ( 27 == $unit_n[$i] ) )
                {
                         if ($deva[$ej]>0)   { $target=28; }
                    else if ($tank[$ej]>0)   { $target=25; }
                    else if ($rtank[$ej]>0)  { $target=26; }
                    else if ($sard[$ej]>0)   { $target=27; }
                    else if ($free[$ej]>0)   { $target=29; }
                    else if ($hinf[$ej]>0)   { $target=24; }
                    else if ($linf[$ej]>0)   { $target=23; }
                    else if ($rtower[$ej]>0) { $target=13; }
                    else if ($tower[$ej]>0)  { $target=12; }
                }
           else if ( ( 23 == $unit_n[$i] ) ||
                     ( 29 == $unit_n[$i] ) ||
                     ( 12 == $unit_n[$i] ) )
                {
                         if ($free[$ej]>0)   { $target=29; }
                    else if ($sard[$ej]>0)   { $target=27; }
                    else if ($linf[$ej]>0)   { $target=23; }
                    else if ($hinf[$ej]>0)   { $target=24; }
                    else if ($deva[$ej]>0)   { $target=28; }
                    else if ($tank[$ej]>0)   { $target=25; }
                    else if ($rtank[$ej]>0)  { $target=26; }
                    else if ($tower[$ej]>0)  { $target=12; }
                    else if ($rtower[$ej]>0) { $target=13; }
                }
if ($target==26 || $target==28 || $target==25 || $target==13) $damage=$war_a2[$unit_n[$i]];
else $damage=$war_a1[$unit_n[$i]];

$coef=3/rand(2,6);

if ($j==1) $damage=$damage*$unit_q[$i]*(1+$rang[$j]/50)*$coef;
else $damage=$damage*$unit_q[$i]*$coef;

$totaldmg=(1+$techatt[$j]/10)*$damage;

if ($target!=0) $totalhp=(1+$techarm[$ej]/10)*$war_hp[$target];
else $totalhp=0;

if ($totalhp!=0) $killed=$totaldmg/$totalhp;
else $killed=0;

if ($target==12) $tower[$ej]-=$killed;
if ($target==13) $rtower[$ej]-=$killed;

if ($target==23) $linf[$ej]-=$killed;
if ($target==24) $hinf[$ej]-=$killed;
if ($target==25) $tank[$ej]-=$killed;
if ($target==26) $rtank[$ej]-=$killed;
if ($target==27) $sard[$ej]-=$killed;
if ($target==28) $deva[$ej]-=$killed;
if ($target==29) $free[$ej]-=$killed;

}

} // конец перебора юнитов
} // конец перебора игроков
$itxt.="Расстановка сил после фазы <b>".$f."</b><br>";
for ($ii=1;$ii<=2;$ii++) {
$itxt.=" ".$armn[$ii]." СТ=".bolnul($wall[$ii])." Б=".bolnul($tower[$ii])." РБ=".bolnul($rtower[$ii]).": ЛП=".bolnul($linf[$ii])." ТП=".bolnul($hinf[$ii])." Т=".bolnul($tank[$ii])." РТ=".bolnul($rtank[$ii]);
if ($unit=="super") $itxt.=" С=".bolnul($sard[$ii])." Р=".bolnul($deva[$ii])." Ф=".bolnul($free[$ii]);
$itxt.=" <br>";
}
$f++;
$i=1;
$sum[1]=bolnul($linf[$i])+bolnul($hinf[$i])+bolnul($tank[$i])+bolnul($rtank[$i])+bolnul($sard[$i])+bolnul($deva[$i])+bolnul($free[$i]);

$i=2;
$sum[2]=bolnul($linf[$i])+bolnul($hinf[$i])+bolnul($tank[$i])+bolnul($rtank[$i])+bolnul($sard[$i])+bolnul($deva[$i])+bolnul($free[$i])+bolnul($tower[$i])+bolnul($rtower[$i]);


}

// ######################################### конец расчета боя


if ($sum[2]<=0)
{
$i=1;

	$linf[$i]=round($linf[$i]);
	$hinf[$i]=round($hinf[$i]);
	$tank[$i]=round($tank[$i]);
	$rtank[$i]=round($rtank[$i]);
	$sard[$i]=round($sard[$i]);
	$deva[$i]=round($deva[$i]);
	$free[$i]=round($free[$i]);

$setwins=$wins[$i]+1;
$rang=$rang[$i]+3*($costall[2]/ $costall[1]);
if($rang>50) $rang=50;

$x=mysql_query("update `base` set `up`='$up1',`tower`='0',`rtower`='0',`linf`='0',`hinf`='0',`tank`='0',`rtank`='0',`spec1`='0',`spec2`='0',`spec3`='0',`addon1`='$nx' where `n`='$army2_n'");

if ($x==1)
{
$x2=mysql_query("update `army` set `rang`='$rang', `wins`='$setwins',`linf`='$linf[$i]',`hinf`='$hinf[$i]',`tank`='$tank[$i]',`rtank`='$rtank[$i]',`spec1`='$sard[$i]',`spec2`='$deva[$i]',`spec3`='$free[$i]' where `n`='$n1'");
if ($x2==1)
{

$mm="Ваша база ".$armn[2]." была захвачена армией ".$armn[1]." игрока ".$wd_username."<br><br><b>Лог сражения</b>:<br><Br>".$itxt;
inform (0,$enemysn,$mm);
// log_("$wd_username захаватил базу ".$armn[2]." игрока $enemy");

} else echo mysql_error();
} else echo mysql_error();
}

if ($sum[1]<=0)
{
$i=2;

	$linf[$i]=round($linf[$i]);
	$hinf[$i]=round($hinf[$i]);
	$tank[$i]=round($tank[$i]);
	$rtank[$i]=round($rtank[$i]);
	$sard[$i]=round($sard[$i]);
	$deva[$i]=round($deva[$i]);
	$free[$i]=round($free[$i]);

	$rtower[$i]=round($rtower[$i]);
	$tower[$i]=round($tower[$i]);

$x=mysql_query("delete from `army` where `n`='$n1'");
if ($x==1)
{
$x2=mysql_query("update `base` set `tower`='$tower[$i]',`rtower`='$rtower[$i]',`linf`='$linf[$i]',`hinf`='$hinf[$i]',`tank`='$tank[$i]',`rtank`='$rtank[$i]',`spec1`='$sard[$i]',`spec2`='$deva[$i]',`spec3`='$free[$i]' where `n`='$army2_n'");
if ($x==1)
{

$mm="Ваша база ".$armn[2]." была атакована армией ".$armn[1]." игрока ".$wd_username.". Армия противника оказалась очень слаба и была полностью уничтожена. \nБлестящая победа!<br><br><b>Лог сражения</b>:<br><Br>".$itxt;
inform (0,$enemysn,$mm);
//log_("$wd_username напал на базу ".$armn[2]." игрока $enemy но проиграл");

} else echo mysql_error();
} else echo mysql_error();
}
}
}
}

//функция атаки армии
function attack_army($n1,$n2){
	echo "Фримен $n1 атакует армию $n2";
	$res1=mysql_query("select * from `army` where `n`='$n1'");
if (mysql_num_rows($res1)==1)
{
$x=mysql_result($res1,0,'x');
$y=mysql_result($res1,0,'y');
$up1=mysql_result($res1,0,'up');
$resname=mysql_query("select * from `wduser` where `n`='$up1'");
$wd_username=mysql_result($resname,0,'login');

$res2=mysql_query("select * from `army` where `n`='$n2'");
if (mysql_num_rows($res2)>=1)
{

	$rest1=mysql_query("select * from `tech` where `up`='$up1'");
	$techatt[1]=@mysql_result($rest1,0,'att');
	$techarm[1]=@mysql_result($rest1,0,'arm');

  $rang[1]=mysql_result($res1,0,'rang');
	$wins[1]=mysql_result($res1,0,'wins');
	$armn[1]=mysql_result($res1,0,'name');
	$linf[1]=mysql_result($res1,0,'linf');
	$hinf[1]=mysql_result($res1,0,'hinf');
	$tank[1]=mysql_result($res1,0,'tank');
	$rtank[1]=mysql_result($res1,0,'rtank');
	$harv[1]=mysql_result($res1,0,'harv');

	$sard[1]=mysql_result($res1,0,'spec1');
	$deva[1]=mysql_result($res1,0,'spec2');
	$free[1]=mysql_result($res1,0,'spec3');
	$costall[1]=$linf[1]*100+$hinf[1]*250+$tank[1]*3000+$rtank[1]*7500;

	$up=mysql_result($res2,0,'up');

	$enemysn=$up;

	$res3=mysql_query("select login from `wduser` where `n`='$up'");
	$enemy=@mysql_result($res3,0,'login');

	$rest2=mysql_query("select * from `tech` where `up`='$up'");
	$techatt[2]=@mysql_result($rest2,0,'att');
	$techarm[2]=@mysql_result($rest2,0,'arm');

	$army2_n=mysql_result($res2,0,'n');

  $rang[2]=mysql_result($res2,0,'rang');
	$wins[2]=mysql_result($res2,0,'wins');
	$armn[2]=mysql_result($res2,0,'name');
	$linf[2]=mysql_result($res2,0,'linf');
	$hinf[2]=mysql_result($res2,0,'hinf');
	$tank[2]=mysql_result($res2,0,'tank');
	$rtank[2]=mysql_result($res2,0,'rtank');
	$harv[2]=mysql_result($res2,0,'harv');

	$sard[2]=mysql_result($res2,0,'spec1');
	$deva[2]=mysql_result($res2,0,'spec2');
	$free[2]=mysql_result($res2,0,'spec3');
	$costall[2]=$linf[2]*100+$hinf[2]*250+$tank[2]*3000+$rtank[2]*7500;

if ($sard[1]>0 || $sard[2]>0 || $deva[1]>0 || $deva[2]>0 || $free[1]>0 || $free[2]>0) $unit="super";

// log_("$wd_username напал на армию $enemy");
$itxt="";
$itxt.="Армия <b>".$armn[1]."</b> атакует вашу армию <b>".$armn[2]."</b><br><br>";
for ($i=1;$i<=2;$i++)
{
if (!isset($techatt[$i]) || $techatt[$i]=="") $techatt[$i]=0;
if (!isset($techarm[$i]) || $techarm[$i]=="") $techarm[$i]=0;
}
// ########################################### начало расчета боя
$i = 1;
$sum[$i]=$armn[$i]+$linf[$i]+$hinf[$i]+$tank[$i]+$rtank[$i]+$sard[$i]+$deva[$i]+$free[$i];
$i = 2;
$sum[$i]=$armn[$i]+$linf[$i]+$hinf[$i]+$tank[$i]+$rtank[$i]+$sard[$i]+$deva[$i]+$free[$i];
$f=1;
// задание номеров юнитов, должно быть согласовано с очерёдностью атаки
$unit_n[1]=26;
$unit_n[2]=28;
$unit_n[3]=25;
$unit_n[4]=27;
$unit_n[5]=24;
$unit_n[6]=29;
$unit_n[7]=23;

$war_n[23]="<b>Легкая пехота</b>";
$war_c[23]=1;
$war_a1[23]=3;
$war_a2[23]=1;
$war_hp[23]=50;
$war_n[24]="<b>Тяжелая пехота</b>";
$war_c[24]=1;
$war_a1[24]=2;
$war_a2[24]=8;
$war_hp[24]=90;
$war_n[25]="<b>Танк</b>";
$war_c[25]=2;
$war_a1[25]=33;
$war_a2[25]=90;
$war_hp[25]=1200;
$war_n[26]="<b>Ракетный танк</b>";
$war_c[26]=2;
$war_a1[26]=250;
$war_a2[26]=100;
$war_hp[26]=2200;
$war_n[27]="<b>Сардукар</b>";
$war_c[27]=1;
$war_a1[27]=10;
$war_a2[27]=20;
$war_hp[27]=200;
$war_n[28]="<b>Разрушитель</b>";
$war_c[28]=2;
$war_a1[28]=75;
$war_a2[28]=90;
$war_hp[28]=7500;
$war_n[29]="<b>Фримен</b>";
$war_c[29]=1;
$war_a1[29]=20;
$war_a2[29]=12;
$war_hp[29]=150;
$war_n[12]="<b>Оружейная башня</b>";
$war_c[12]=1;
$war_a1[12]=250;
$war_a2[12]=120;
$war_hp[12]=3000;
$war_n[13]="<b>Ракетная башня</b>";
$war_c[13]=2;
$war_a1[13]=400;
$war_a2[13]=400;
$war_hp[13]=4000;

// ########################################### запуск цикла фаз боя

while ($sum[1]>0 && $sum[2]>0)
{
// ########################################### перебор игроков
for ($j=1;$j<=2;$j++)
{
if ($j==1) $ej=2;
else $ej=1;

// ########################################### перебор юнитов

for ($i=1;$i<=7;$i++)
{
// задание очерёдности атаки юнитов и числа юнитов в i-ом отряде
$unit_q[1]=$rtank[$j];
$unit_q[2]=$deva[$j];
$unit_q[3]=$tank[$j];
$unit_q[4]=$sard[$j];
$unit_q[5]=$hinf[$j];
$unit_q[6]=$free[$j];
$unit_q[7]=$linf[$j];
if ($unit_q[$i]>0)
{
$target=0;
                if ( 26 == $unit_n[$i] )
                {
                         if ($sard[$ej]>0)   { $target=27; }
                    else if ($free[$ej]>0)   { $target=29; }
                    else if ($linf[$ej]>0)   { $target=23; }
                    else if ($hinf[$ej]>0)   { $target=24; }
                    else if ($deva[$ej]>0)   { $target=28; }
                    else if ($rtank[$ej]>0)  { $target=26; }
                    else if ($tank[$ej]>0)   { $target=25; }
                }
           else if ( ( 25 == $unit_n[$i] ) ||
                     ( 28 == $unit_n[$i] ) ) //||
                     //( 13 == $unit_n[$i] ) )
                {
                         if ($deva[$ej]>0)   { $target=28; }
                    else if ($tank[$ej]>0)   { $target=25; }
                    else if ($rtank[$ej]>0)  { $target=26; }
                    else if ($sard[$ej]>0)   { $target=27; }
                    else if ($free[$ej]>0)   { $target=29; }
                    else if ($linf[$ej]>0)   { $target=23; }
                    else if ($hinf[$ej]>0)   { $target=24; }
                }
           else if ( ( 24 == $unit_n[$i] ) ||
                     ( 27 == $unit_n[$i] ) )
                {
                         if ($deva[$ej]>0)   { $target=28; }
                    else if ($tank[$ej]>0)   { $target=25; }
                    else if ($rtank[$ej]>0)  { $target=26; }
                    else if ($sard[$ej]>0)   { $target=27; }
                    else if ($free[$ej]>0)   { $target=29; }
                    else if ($hinf[$ej]>0)   { $target=24; }
                    else if ($linf[$ej]>0)   { $target=23; }
                }
           else if ( ( 23 == $unit_n[$i] ) ||
                     ( 29 == $unit_n[$i] ) )
                {
                         if ($free[$ej]>0)   { $target=29; }
                    else if ($sard[$ej]>0)   { $target=27; }
                    else if ($linf[$ej]>0)   { $target=23; }
                    else if ($hinf[$ej]>0)   { $target=24; }
                    else if ($deva[$ej]>0)   { $target=28; }
                    else if ($tank[$ej]>0)   { $target=25; }
                    else if ($rtank[$ej]>0)  { $target=26; }
                }
if ($target==26 || $target==28 || $target==25) $damage=$war_a2[$unit_n[$i]];
else $damage=$war_a1[$unit_n[$i]];

$coef=3/rand(2,6);
$damage=$damage*$unit_q[$i]*(1+$rang[$j]/50)*$coef;

$totaldmg=(1+$techatt[$j]/10)*$damage;
if ($target!=0) $totalhp=(1+$techarm[$ej]/10)*$war_hp[$target];
else $totalhp=0;

if ($totalhp!=0) $killed=$totaldmg/$totalhp;
else $killed=0;

if ($target==23) $linf[$ej]-=$killed;
if ($target==24) $hinf[$ej]-=$killed;
if ($target==25) $tank[$ej]-=$killed;
if ($target==26) $rtank[$ej]-=$killed;
if ($target==27) $sard[$ej]-=$killed;
if ($target==28) $deva[$ej]-=$killed;
if ($target==29) $free[$ej]-=$killed;

}

} // конец перебора юнитов
} // конец перебора игроков

$itxt.="Расстановка сил после фазы <b>".$f."</b><br>";
for ($ii=1;$ii<=2;$ii++) {
$itxt.="Армия ".$armn[$ii].": ЛП=".bolnul($linf[$ii])." ТП=".bolnul($hinf[$ii])." Т=".bolnul($tank[$ii])." РТ=".bolnul($rtank[$ii]);
if ($unit=="super") $itxt.=" С=".bolnul($sard[$ii])." Р=".bolnul($deva[$ii])." Ф=".bolnul($free[$ii]);
$itxt.=" <br>";
}

$f++;

//for ($i=1;$i<=2;$i++) $sum[$i]=bolnul($linf[$i])+bolnul($hinf[$i])+bolnul($tank[$i])+bolnul($rtank[$i])+bolnul($sard[$i])+bolnul($deva[$i])+bolnul($free[$i]);
$i = 1;
$sum[$i]=bolnul($linf[$i])+bolnul($hinf[$i])+bolnul($tank[$i])+bolnul($rtank[$i])+bolnul($sard[$i])+bolnul($deva[$i])+bolnul($free[$i]);

$i = 2;
$sum[$i]=bolnul($linf[$i])+bolnul($hinf[$i])+bolnul($tank[$i])+bolnul($rtank[$i])+bolnul($sard[$i])+bolnul($deva[$i])+bolnul($free[$i]);
}

// ######################################### конец расчета боя

if ($sum[2]<=0)
{
$i=1;

	$linf[$i]=round($linf[$i]);
	$hinf[$i]=round($hinf[$i]);
	$tank[$i]=round($tank[$i]);
	$rtank[$i]=round($rtank[$i]);
	$sard[$i]=round($sard[$i]);
	$deva[$i]=round($deva[$i]);
	$free[$i]=round($free[$i]);

$setwins=$wins[$i]+1;
$rang=$rang[$i]+3*($costall[2]/ $costall[1]);
if($rang>50) $rang=50;

$x=mysql_query("delete from `army` where `n`='$army2_n'");
if ($x==1)
{
$harv=$harv[1]+$harv[2];
$x2=mysql_query("update `army` set `rang`='$rang',`harv`='$harv',`wins`='$setwins',`linf`='$linf[$i]',`hinf`='$hinf[$i]',`tank`='$tank[$i]',`rtank`='$rtank[$i]',`spec1`='$sard[$i]',`spec2`='$deva[$i]',`spec3`='$free[$i]' where `n`='$n1'");
if ($x==1)
{
$mm="Ваша армия ".$armn[2]." была уничтожена армией ".$armn[1]." игрока ".$wd_username."<br><br><b>Лог сражения</b>:<br><Br>".$itxt;
inform (0,$enemysn,$mm);
// log_("$wd_username победил армию игрока $enemy");
} else echo mysql_error();
} else echo mysql_error();
}

if ($sum[1]<=0)
{
$i=2;

	$linf[$i]=round($linf[$i]);
	$hinf[$i]=round($hinf[$i]);
	$tank[$i]=round($tank[$i]);
	$rtank[$i]=round($rtank[$i]);
	$sard[$i]=round($sard[$i]);
	$deva[$i]=round($deva[$i]);
	$free[$i]=round($free[$i]);

$setwins=$wins[$i]+1;
$rang=$rang[$i]+3*($costall[1]/ $costall[2]);
if($rang>50) $rang=50;

$x=mysql_query("delete from `army` where `n`='$n1'");
if ($x==1)
{
$harv=$harv[1]+$harv[2];
$x2=mysql_query("update `army` set `rang`='$rang',`harv`='$harv',`wins`='$setwins',`linf`='$linf[$i]',`hinf`='$hinf[$i]',`tank`='$tank[$i]',`rtank`='$rtank[$i]',`spec1`='$sard[$i]',`spec2`='$deva[$i]',`spec3`='$free[$i]' where `n`='$army2_n'");
if ($x==1)
{

$mm="Ваша армия ".$armn[2]." одержала победу над атаковавшей ее армией ".$armn[1]." игрока ".$wd_username.". Ранг армии увеличен на 1.<br><br><b>Лог сражения</b>:<br><Br>".$itxt;
inform (0,$enemysn,$mm);

// log_("$wd_username проиграл в битве с армией игрока $enemy");

} else echo mysql_error();
} else echo mysql_error();
}
}
}
}

if ((rand(1,15)<=5) && ($nx<5000))
{

$res=mysql_query("select * from `day` limit 1");
$game_day=mysql_result($res,0,'n');

$x=rand(1,$dune_x);
$y=rand(1,$dune_y);

$res=mysql_query("select count(*) from base where `x`='$x' and `y`='$y'");
$res2=mysql_query("select count(*) from army where `x`='$x' and `y`='$y'");

$rn[1]="Воины песков";
$rn[2]="Защитники Дюны";
$rn[3]="Песчанники";
$rn[4]="Разведка фрименов";
$rn[5]="Посланники Муаддиба";
$rn[6]="Песчаный шторм";
$rn[7]="Патруль фрименов";
$rn[8]="Огненные демоны";
$rn[9]="Песчаный дозор";

$rnm=$rn[rand(1,9)]." [уровень ".ceil($game_day/100)."]";

$coef=rand(2,6);

$rcr=round($game_day*10)*10*$coef/4;
$rst=round($game_day*10)*$coef/4;
$rwl=round($game_day/500)*$coef/4;
$rtw=round($game_day/750)*$coef/4;
$rtn=round($game_day/100)*$coef/4;
$rfr=round($game_day/50)*$coef/4;
$rlf=round($game_day/6)*$coef/4;
$rhf=round($game_day/12)*$coef/4;
$rdv=round($game_day/1000)*$coef/4;

if (mysql_result($res2,0,'count(*)')==0) if (mysql_result($res,0,'count(*)')==0) if (rand(1,10)<=2)
{

mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` )
VALUES ('', '6', '$rnm', '$x', '$y', '0', '$rcr', '$rst', '10', '$rwl', '$rtw', '0', '1', '0', '1', '0', '0', '0', '0', '0', '0', '1', '0', '$rlf', '$rhf', '$rtn', '0', '0', '$rdv', '$rfr')");

echo "Создана база фрименов $rnm в квадрате $x:$y \n<br>";

}
else
{
$resbf=mysql_query("select * from `base` where `up`='6'");
$i=rand(0,mysql_num_rows($resbf)-1);

$x=mysql_result($resbf,$i,'x');
$y=mysql_result($resbf,$i,'y');

//$x=35;
//$y=35;

mysql_query("INSERT INTO `army` ( `n` , `up` , `name` , `x` , `y` , `wins` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` )
VALUES ('', '6', '$rnm', '$x', '$y', '0', '0', '$rlf', '$rhf', '$rtn', '0', '0', '$rdv', '$rfr')");

echo "Армия фрименов $rnm создана в квадрате $x:$y \n<br>";

}
}
//Атакуем врагов, кого видим!!!!!!!!!
$resa=mysql_query("SELECT * FROM `army` WHERE `up`='6'");
while($r=mysql_fetch_array($resa)){
	$x=$r['x'];
	$y=$r['y'];
	$n=$r['n'];
	$targ=$r['targ'];
	$resVa=mysql_query("SELECT * FROM `army` WHERE `x`='$x' and `y`='$y' and `up`!=6 and `up`!=1");
	if(@mysql_num_rows($resVa)!=0) {
		$an=mysql_result($resVa,0,'n');
		$aup=mysql_result($resVa,0,'up');
		if($aup==$targ&&$nx>=10000)	attack_army($n,$an);
	} else {
	$resb=mysql_query("SELECT * FROM `base` WHERE `x`='$x' and `y`='$y' and `up`!=6 and `up`!=1");
	if(@mysql_num_rows($resb)!=0) {
		$bn=mysql_result($resb,0,'n');
		$bup=mysql_result($resb,0,'up');
		//echo "<br>CHECK: $bn==$bup";
		if($bup==$targ&&$nx>=10000)	attack_base($n,$bn);
	}
  }
}
//Считаем развитость игроков, кто сколько потратил на строения
$res=mysql_query("SELECT * FROM `base` WHERE `up`!=1 and `up`!='6' ORDER BY `up`");
$i=0;
$oldup=0;
for($m=0;$m<5000;$m++) $rich[$m]=0;
while($r=mysql_fetch_array($res)){
	$up=$r['up'];
	$resu=mysql_query("SELECT * FROM `wduser` WHERE `n`='$up' and `typ`<>'0'");
	if(@mysql_num_rows($resu)>0) continue;

	if($up!=$oldup) $i++;
	$oldup=$up;
	$cred=5+1000*round(pow(2,$r['constr']/1.1))+20+20*round(pow(2,$r['wind']/1.4))+100*round(pow(2,$r['refin']/1.2))+15*round(pow(2,$r['silo']/1.1))+45*round(pow(2,$r['bar']/1.1))+125*round(pow(2,$r['fact']/1.1))+500*round(pow(2,$r['tech']/1.1))+5000*round(pow(2,$r['cosmo']/1.1))+1000000*round(pow(2,$r['palace']/1.1))+20*round(pow(2,$r['wall']/1.2))+25*round(pow(2,$r['tower']/1.2))+500*round(pow(2,$r['rtower']/1.2))+2500*round(pow(2,$r['trade']/1.1));
	$rich[$i]=$rich[$i]+$cred;
	$rn[$i]=$up;
}
//Сортируем игроков по убыванию
arsort($rich,SORT_NUMERIC);
$i=0;
foreach($rich as $key=>$val){
	$richi_cred[]=$val;
	$richi_n[]=$rn[$key];
	echo "<br>Враг номер ".($i+1)." - $val,".$rn[$key];
	$i++;
	if($i==10) break;
}
//Идем к тем, кто ближе к армии
$resa=mysql_query("SELECT * FROM `army` WHERE `up`='6'");
while($r=mysql_fetch_array($resa)){
	$n=$r['n'];
	$x=$r['x'];
	$y=$r['y'];
	for($i=0;$i<5;$i++){
		$up=$richi_n[$i];
		$resb=mysql_query("SELECT * FROM `base` WHERE `up`='$up'");
		$m=0;
		unset($baseway);
		while($r=mysql_fetch_array($resb)){
			$bn[$m]=$r['n'];
			$bx[$bn[$m]]=$r['x'];
			$by[$bn[$m]]=$r['y'];
			//echo "<br>X:".$bx[$r['n']]." Y:".$by[$r['n']];
			$baseway[$m]=(abs($r['x']-$x)+abs($r['y']-$y));
			$m++;
		}
		if(isset($baseway))
		{
			asort($baseway,SORT_NUMERIC);
		  foreach($baseway as $key=>$val){
 			  $bnn=$bn[$key];
	  		$bbx=$bx[$bnn];
		  	$bby=$by[$bnn];
			  $rx[$up]=$bbx;
			  $ry[$up]=$bby;
			  break;
		  }
		  $way[$i]=(abs($rx[$up]-$x)+abs($ry[$up]-$y));
		}
	}
	if(isset($way)){
	  asort($way,SORT_NUMERIC);
	  foreach($way as $key=>$var){
		  $up=$richi_n[$key];
	  	if($nx>=10000) goto($n,$rx[$up],$ry[$up],$up);
  	 	break;
    }
  }
}
// ########################## ПЕРЕСЧЕТ РАСШИРЕННОГО ИНТЕРФЕЙСА

$res=mysql_query("select * from `wduser` where `status`>'0'");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$n=mysql_result($res,$i,'n');
$status=mysql_result($res,$i,'status')-1;
mysql_query("update `wduser` set `status`='$status' where `n`='$n'");

if ($status==0)
{
mysql_query("update `base` set `spec1`='0' where `up`='$n'");
}

}

// ########################## ПЕРЕСЧЕТ РАСШИРЕННОГО ИНТЕРФЕЙСА

// Обновление активности
mysql_query("update `wduser` set `act`='$nx'");

$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START;

echo "<br>\n\n loaded in [".number_format($TIME_SCRIPT,3,'.','')."] sec";
?>
