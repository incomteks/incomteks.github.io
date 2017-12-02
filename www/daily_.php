<?
function getmicrotime(){
list($usec, $sec) = explode(" ",microtime());
return ((float)$usec + (float)$sec);
}

function inform($ot,$to,$dsc)
{
$time=date("Y-m-d H:i:s");
$dsc = ereg_replace("\n","<br>",$dsc);
mysql_query("insert into `mes` values ('','$ot','$to','$dsc','$time','2','0','1')");
}

$TIME_START = getmicrotime();

$sys_dbhost="localhost";
$sys_dbname="dune";   
$sys_dbuser="dune";   
$sys_dbpass="dunepass"; 

// соединение с сервером MySQL   

if(!mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpass))    
{  
   echo "Не могу соединиться с базой !<br>";    
   echo mysql_error();   
   exit;    
}
// else echo "Соединение с базой прошло успешно !<br>";

mysql_select_db($sys_dbname);

//include("../connect.php");
$res=mysql_query("select * from `day` limit 1");
$n=mysql_result($res,0,'n');

$nx=$n+1;

mysql_query("update `day` set `n`='$nx' where `n`='$n'");

echo "R1 День $nx <br><br>\n\n";

// ДОБАВКА ГРАНИТА И КРЕДИТОВ ИЗ СБОР ДВОРОВ

echo "\n\n<br><br>Проверка Баз <br><br>\n\n";

$res=mysql_query("select * from base");
while($resarr=mysql_fetch_array($res)) {
$upcred=0;
$upstone=0;

$n=$resarr['n'];
$name=$resarr['name'];

$up=$resarr['up'];

$constr=$resarr['constr'];

$wind=$resarr['wind'];
$refin=$resarr['refin'];
$silo=$resarr['silo'];
$bar=$resarr['bar'];
$fact=$resarr['fact'];

$tech=$resarr['tech'];
$cosmo=$resarr['cosmo'];
$palace=$resarr['palace'];

$trade=$resarr['trade'];


$rest=mysql_query("select * from `tech` where `up`='$up'");
$resarrt=mysql_fetch_array($rest);
$t_harv=$resarrt['harv'];

$sumb=$constr+$wind+$refin+$silo+$bar+$fact+$tech+$cosmo+$palace+$trade-1;

$energy=5+$wind*5;

echo "База $n. Строений $sumb, энергии $energy. ";

$stone=$resarr['stone'];
$cred=$resarr['cred'];
$spice=$resarr['spice'];

$harv=$resarr['harv'];

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

mysql_query("update `base` set `stone`='$upstone',`cred`='$upcred',`spice`='$spice' where n='$n'");
}

// СТРОИТЕЛЬСТВО

echo "\n\n<br><br>Строительство <br><br>\n\n";

$res=mysql_query("select * from bild");
while($resarr=mysql_fetch_array($res))
{
$n=$resarr['n'];
$usr=$resarr['user'];

$res_u=mysql_query("select * from `wduser` where `n`='$usr'");
$status=@mysql_result($res_u,0,'status');

if ($status==0)
{

$dleft=$resarr['dleft'];
$base=$resarr['base'];
$struct=$resarr['struct'];

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
$col=$resarr['col'];
$bday=$resarr['bday'];
$col=$col-1;

$res2=mysql_query("select * from `base` where `n`='$base'");
$val=mysql_result($res2,0,$field);
$field2=$val+1;
mysql_query("update `base` set $field='$field2' where `n`='$base'");

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

if ($struct==1) $field2=$val+1+$t_build;
else $field2=$val+1;

mysql_query("update `base` set $field='$field2' where `n`='$base'");

mysql_query("delete from `bild` where n='$n'");

}
} else mysql_query("update `bild` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
} }


// Перемещения

echo "\n\n<br><br>Перемещения <br><br>\n\n";

$res=mysql_query("select * from `move`");
while($resarr=mysql_fetch_array($res))
{
$n=$resarr['n'];
$up=$resarr['up'];

$x=$resarr['x'];
$y=$resarr['y'];

$dleft=$resarr['dleft'];
$hday=$resarr['hday'];
$direct=$resarr['direct'];

$dleft2=$dleft-1;
echo "Армия $up перемещение в точку $x:$y срок: $dleft -> $dleft2 <br>\n";
if ($dleft2<=0)
{
if ($hday<=0)
{
mysql_query("update `army` set `x`='$x',`y`='$y' where `n`='$up'");
mysql_query("delete from `move` where n='$n'");
}
else
{
mysql_query("update `army` set `x`='$x',`y`='$y' where `n`='$up'");

if ($direct==5) $y++;
if ($direct==6) $x++;
if ($direct==7) $y--;
if ($direct==8) $x--;
if ($x<=0) $x=100;
if ($y<=0) $y=100;
if ($x>100) $x=1;
if ($y>100) $y=1;
mysql_query("update `move` set `x`='$x',`y`='$y',`dleft`='$hday' where n='$n'");
}
//inform("0",$up,"Ваша армия прибыла в пункт назначения [$x:$y] и готова выполнять дальнейшие указания.");

} else mysql_query("update `move` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
}


// Рука смерти

echo "\n\n<br><br>Ракетные атаки <br><br>\n\n";

$res=mysql_query("select * from `hod`");
while($resarr=mysql_fetch_array($res))
{
$n=$resarr['n'];
$up=$resarr['up'];
$x=$resarr['x'];
$y=$resarr['y'];
$dleft=$resarr['dleft'];

$dleft2=$dleft-1;
echo "Атака квадрата $x:$y срок: $dleft -> $dleft2 <br>\n";
if ($dleft2<=0)
{
mysql_query("delete from `hod` where n='$n'");

$res2=mysql_query("select * from `army` where `x`='$x' and `y`='$y'");
while($resarr2=mysql_fetch_array($res2))
{
$n2=$resarr2['n'];
$up2=$resarr2['up'];
$name2=$resarr2['name'];

inform("0",$up2,"Ваша армия $name2, находившаяся в квадрате [$x:$y] была уничтожена в результате ракетной атаки.");
inform("0",$up,"Ваша ракета уничтожила армию $name2 в квадрате [$x:$y].");

mysql_query("delete from `army` where `n`='$n2'");
}

// АТАКА БАЗ

$res2=mysql_query("select * from `base` where `x`='$x' and `y`='$y'");
while($resarr2=mysql_fetch_array($res2))
{
$n2=$resarr2['n'];
$up2=$resarr2['up'];
$name2=$resarr2['name'];

$constr=rand(floor($resarr2['constr']*0.75),$resarr2['constr']);
$wind=rand(floor($resarr2['wind']*0.75),$resarr2['wind']);
$refin=rand(floor($resarr2['refin']*0.75),$resarr2['refin']);
$bar=rand(floor($resarr2['bar']*0.75),$resarr2['bar']);
$fact=rand(floor($resarr2['fact']*0.75),$resarr2['fact']);
$tech=rand(floor($resarr2['tech']*0.75),$resarr2['tech']);
$cosmo=rand(floor($resarr2['cosmo']*0.75),$resarr2['cosmo']);

$silo=rand(floor($resarr2['silo']*0.75),$resarr2['silo']);

$wall=rand(floor($resarr2['wall']*0.75),$resarr2['wall']);
$tower=rand(floor($resarr2['tower']*0.5),$resarr2['tower']);
$rtower=rand(floor($resarr2['rtower']*0.5),$resarr2['rtower']);

$harv=rand(floor($resarr2['harv']*0.75),$resarr2['harv']);
$tank=rand(0,$resarr2['tank']);
$rtank=rand(0,$resarr2['rtank']);

$palace=rand(floor($resarr2['palace']*0.75),$resarr2['palace']);

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

echo "\n\n<br><br>Исследования <br><br>\n\n";

$res=mysql_query("select * from `res`");

while($resarr=mysql_fetch_array($res))
{
$n=$resarr['n'];
$up=$resarr['up'];

$struct=$resarr['struct'];
$dleft=$resarr['dleft'];

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
$val=mysql_result($res2,0,$field);

$field2=$val+1;

mysql_query("update `tech` set $field='$field2' where `up`='$up'");
mysql_query("delete from `res` where n='$n'");

inform("0",$up,"Вы завершили очередное исследование.\nОбратитесь в научный центр за дополнительной информацией.");

} else mysql_query("update `res` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
}



// Космопорт

echo "\n\n<br><br>Космопорт<br><br>\n\n";

$res=mysql_query("select * from `space`");
while($resarr=mysql_fetch_array($res))
{
$n=$resarr['n'];
$up=$resarr['up'];

$x=$resarr['x'];
$y=$resarr['y'];

$stone=$resarr['stone'];
$cred=$resarr['cred'];
$linf=$resarr['linf'];
$hinf=$resarr['hinf'];
$tank=$resarr['tank'];
$rtank=$resarr['rtank'];

$harv=$resarr['harv'];
$mobconst=$resarr['mobconst'];

$dleft=$resarr['dleft'];

$dleft2=$dleft-1;

echo "Отправка $n в квадрат $x:$y срок: $dleft -> $dleft2 <br>\n";

if ($dleft2<=0)
{

$res2=mysql_query("select * from `base` where `x`='$x' and `y`='$y' and `cosmo`>0");
$resarr2=mysql_fetch_array($res2);
$n2=$resarr2['n'];
$up2=$resarr2['up'];


$stone2=$resarr2['stone']+$stone;
$cred2=$resarr2['cred']+$cred;
$linf2=$resarr2['linf']+$linf;
$hinf2=$resarr2['hinf']+$hinf;
$tank2=$resarr2['tank']+$tank;
$rtank2=$resarr2['rtank']+$rtank;

$harv2=$resarr2['harv']+$harv;
$mobconst2=$resarr2['mobconst']+$mobconst;

mysql_query("update `base` set `stone`='$stone2',`cred`='$cred2',`linf`='$linf2',`hinf`='$hinf2',`tank`='$tank2',`rtank`='$rtank2',`harv`='$harv2',`mobconst`='$mobconst2' where `n`='$n2'");
mysql_query("delete from `space` where n='$n'");


$resu=mysql_query("select login from `wduser` where `n`='$up'");
$login=mysql_result($resu,0,'login');

inform("0",$up2,"Вам доставлен груз от игрока $login:\nКредиты: $cred \nГранит: $stone\nЛегкая пехота: $linf \nТяжелая пехота: $hinf \nТанки: $tank \nРакетные танки: $rtank \nХарвестеры: $harv \nМобильные командные центры: $mobconst ");
inform("0",$up,"Ваш груз доставлен в точку $x:$y.\n\n Груз содержал:\nКредиты: $cred \nГранит: $stone\nЛегкая пехота: $linf \nТяжелая пехота: $hinf \nТанки: $tank \nРакетные танки: $rtank \nХарвестеры: $harv \nМобильные командные центры: $mobconst ");


} else mysql_query("update `space` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
}





// Заказ войск

echo "\n\n<br><br>Заказ войск<br><br>\n\n";

$res=mysql_query("select * from `trade`");
while ($resarr=mysql_fetch_array($res))
{
$n=$resarr['n'];
$up=$resarr['up'];

$x=$resarr['x'];
$y=$resarr['y'];

$linf=$resarr['linf'];
$hinf=$resarr['hinf'];
$tank=$resarr['tank'];
$rtank=$resarr['rtank'];

$harv=$resarr['harv'];
$mobconst=$resarr['mobconst'];

$dleft=$resarr['dleft'];

$dleft2=$dleft-1;

echo "Доставка $n в квадрат $x:$y срок: $dleft -> $dleft2 <br>\n";

if ($dleft2<=0)
{

$res2=mysql_query("select * from `base` where `x`='$x' and `y`='$y' and `trade`>0");
$resarr2=mysql_fetch_array($res2);

$n2=$resarr2['n'];
$up2=$resarr2['up'];

$linf2=$resarr2['linf']+$linf;
$hinf2=$resarr2['hinf']+$hinf;
$tank2=$resarr2['tank']+$tank;
$rtank2=$resarr2['rtank']+$rtank;

$harv2=$resarr2['harv']+$harv;
$mobconst2=$resarr2['mobconst']+$mobconst;

mysql_query("update `base` set `linf`='$linf2',`hinf`='$hinf2',`tank`='$tank2',`rtank`='$rtank2',`harv`='$harv2',`mobconst`='$mobconst2' where `n`='$n2'");
mysql_query("delete from `trade` where n='$n'");

inform("0",$up2,"Торговая гильдия выполнила ваш заказ. На базу [$x:$y] доставлены:\n\nЛегкая пехота: $linf \nТяжелая пехота: $hinf \nТанки: $tank \nРакетные танки: $rtank \nХарвестеры: $harv \nМобильные командные центры: $mobconst ");

} else mysql_query("update `trade` set `dleft`='$dleft2' where n='$n'");
echo mysql_error();
}




//################################################ подсчёт лимита войск
$users=0;
$res=mysql_query("select * from wduser");
while($resarr=mysql_fetch_array($res))
{
$n=$resarr['n'];
$reso=mysql_query("select count(*) from base where up='$n'");
$baz=mysql_result($reso,0,'count(*)');

if ($baz>0) $users++;

}

$cost=0;

//гарнизоны баз
$res=mysql_query("select * from base");
while($resarr=mysql_fetch_array($res));
{
$linf=$resarr['linf'];
$hinf=$resarr['hinf'];
$tank=$resarr['tank'];
$rtank=$resarr['rtank'];  
$cost=($cost + $linf * 100 + $hinf * 250 + $tank * 3000 + $rtank * 7500);
}

//армии
$res=mysql_query("select * from army");
while($resarr=mysql_fetch_array($res));
{
$linf=$resarr['linf'];
$hinf=$resarr['hinf'];
$tank=$resarr['tank'];
$rtank=$resarr['rtank'];  
$cost=($cost + $linf * 100 + $hinf * 250 + $tank * 3000 + $rtank * 7500);
}

$limit= ceil($cost * 5 /$users) + 100;

$res=mysql_query("select * from `day`");
$n=mysql_result($res,0,'n');
mysql_query("update `day` set `limit`='$limit' where `n`='$n'");



//################################################ RANDOM BASES

echo "\n\n<br><br>Монстры<br><br>\n\n";

if (rand(1,25)==5)
{

$res=mysql_query("select * from `day` limit 1");
$game_day=mysql_result($res,0,'n');

$x=rand(1,100);
$y=rand(1,100);

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
$rtn=round($game_day/300)*$coef/4;
$rfr=round($game_day/50)*$coef/4;
$rlf=round($game_day/100)*$coef/4;
$rhf=round($game_day/200)*$coef/4;
$rdv=round($game_day/1000)*$coef/4;

if (mysql_result($res2,0,'count(*)')==0) if (mysql_result($res,0,'count(*)')==0) if (rand(1,20)==10)
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


// ########################## ПЕРЕСЧЕТ РАСШИРЕННОГО ИНТЕРФЕЙСА

$res=mysql_query("select * from `wduser` where `status`>'0'");
while($resarr=mysql_fetch_array($res))
{
$n=$resarr['n'];
$status=$resarr['status']-1;
mysql_query("update `wduser` set `status`='$status' where `n`='$n'");

if ($status==0)
{
mysql_query("update `base` set `spec1`='0' where `up`='$n'");
}

}

// ########################## ПЕРЕСЧЕТ РАСШИРЕННОГО ИНТЕРФЕЙСА








$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START;

echo "<br>\n\n loaded in [".number_format($TIME_SCRIPT,3,'.','')."] sec";
?>