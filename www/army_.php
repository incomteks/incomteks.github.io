<?
/*
include "header.php";

if (isset($wd_base))
{


if ($mode=="newarmy" && $btn=="Создать армию")
{

$linf_left=$lvl[23]-$armylinf;
$hinf_left=$lvl[24]-$armyhinf;
$tank_left=$lvl[25]-$armytank;
$rtank_left=$lvl[26]-$armyrtank;
$mobconst_left=$lvl[22]-$armymobconst;

if ($linf_left<0 || $hinf_left<0 || $tank_left<0 || $rtank_left<0 || $mobconst_left<0) echo "Ошибка! Вы пытаетесь создать армию с большим числом боевых единиц, чем у вас есть.";
else
{
if ($armylinf<0 || $armyhinf<0 || $armytank<0 || $armyrtank<0 || $armymobconst<0) echo "Ошибка! Вы пытаетесь создать армию с отрицательным количеством боевых единиц.";
else
{
if ($armylinf+$armyhinf+$armytank+$armyrtank>0)
{

// #########################
$res=mysql_query("select sum(constr) from `base` where `up`='$wd_usern'");
$maxarmy=mysql_result($res,0,'sum(constr)')*10;

$res=mysql_query("select count(*) from `base` where `up`='$wd_usern'");
$numbases=mysql_result($res,0,'count(*)');

$res=mysql_query("select count(*) from `army` where `up`='$wd_usern'");
$numarmies=mysql_result($res,0,'count(*)');

if ($numbases>$numarmies)
{

if ($armylinf<=500) {
if ($armyhinf<=250) {
if ($armytank<=100) {
if ($armyrtank<=50) {

// #########################


if ($armyname=="" || !isset($armyname)) $armyname="Храбрая Армия";

$x=mysql_query("insert into army (`up`,`name`,`x`,`y`,`mobconst`,`linf`,`hinf`,`tank`,`rtank`) values ('$wd_usern','$armyname','$res_x','$res_y','$armymobconst','$armylinf','$armyhinf','$armytank','$armyrtank')");
if ($x==1)
{

$x2=mysql_query("update base set `hinf`='$hinf_left',`linf`='$linf_left',`tank`='$tank_left',`rtank`='$rtank_left',`mobconst`='$mobconst_left' where `up`='$wd_usern' and `n`='$wd_base' ");
if ($x2!=1) echo mysql_error();
else
{
echo "Армия <b>$armyname</b> успешно создана.";
?><script>window.location.href="army.php?mode=view";</script><?
} 

} else echo mysql_error();

// #########################

} else echo "Ошибка! Превышен лимит ракетных танков в армии!</a>";
} else echo "Ошибка! Превышен лимит танков в армии!</a>";
} else echo "Ошибка! Превышен лимит тяжелых пехотинцев в армии!</a>";
} else echo "Ошибка! Превышен лимит легких пехотинцев в армии!</a>";

} else echo "Ошибка! У вас уже $numbases баз и $numarmies армий, вы не сможете обеспечивать большее количество армий.<br><a href=$a>Вернуться.</a>";
// #########################
} else echo "В армии должен быть хотябы один боевой юнит. Повторите попытку создания армии.";
} // закрытие детекта отрицательных значений
} // закрытие славиного глюка


}
else
{



if ($btn=="В гарнизон" && $army>0)
{
$res=mysql_query("select * from `base` where `n`='$wd_base'");
	$bx=@mysql_result($res,0,'x');
	$by=@mysql_result($res,0,'y');

$res=mysql_query("select * from `army` where `n`='$army' and `up`='$wd_usern'");
if (mysql_num_rows($res)==1)
{
	$ax=mysql_result($res,0,'x');
	$ay=mysql_result($res,0,'y');

if ($bx==$ax && $by==$ay)
{

	$armylinf=mysql_result($res,0,'linf');
	$armyhinf=mysql_result($res,0,'hinf');
	$armytank=mysql_result($res,0,'tank');
	$armyrtank=mysql_result($res,0,'rtank');
	$armymobconst=mysql_result($res,0,'mobconst');
        $armysard=mysql_result($res,0,'spec1');
        $armydeva=mysql_result($res,0,'spec2');
        $armyfree=mysql_result($res,0,'spec3');
	
	$linf_left=$lvl[23]+$armylinf;
	$hinf_left=$lvl[24]+$armyhinf;
	$tank_left=$lvl[25]+$armytank;
	$rtank_left=$lvl[26]+$armyrtank;
	$mobconst_left=$lvl[22]+$armymobconst;
        $sard_left=$lvl[27]+$armysard;
        $deva_left=$lvl[28]+$armydeva;
        $free_left=$lvl[29]+$armyfree;
	
        $x=mysql_query("update base set
`hinf`='$hinf_left',`linf`='$linf_left',`tank`='$tank_left',`rtank`='$rtank_left',`mobconst`='$mobconst_left',`spec1`='$sard_left',`spec2`='$deva_left',`spec3`='$free_left'
where `up`='$wd_usern' and `n`='$wd_base' ");
	
	if ($x==1)
			{
			$x2=mysql_query("delete from `army` where `n`='$army'");
			if ($x2!=1) echo mysql_error();
			else
				{
				echo "Армия Успешно переведена в гарнизон";
				?><script>window.location.href="army.php?mode=view";</script><?
				}
		} 

} else echo "Армия может переходить в гарнизон только той базы в квадрате которой она находится.";
}
}
else


if ($btn=="Строить базу" && $army>0)
{
$res=mysql_query("select * from `army` where `n`='$army' and `up`='$wd_usern' and `mobconst`>0");
if (mysql_num_rows($res)==1)
{

	$arm_name=mysql_result($res,0,'name');
	$arm_m=mysql_result($res,0,'mobconst');
	$arm_x=mysql_result($res,0,'x');
	$arm_y=mysql_result($res,0,'y');
	
	$mcl=$arm_m-1;
	$bn="База ".$arm_name;
	
	$x=mysql_query("insert into base(`up`,`name`,`x`,`y`,`constr`) values('$wd_usern','$bn','$arm_x','$arm_y','1')");

	if ($x==1)
			{
			$x2=mysql_query("update `army` set `mobconst`='$mcl' where `up`='$wd_usern' and `n`='$army' ");
			if ($x2!=1) echo mysql_error();
			else
				{
				echo "База Успешно создана.";
				?><script>window.location.href="army.php?mode=view";</script><?
				}
		} 
}
}
else


if ($btn=="Атаковать армию" && $army>0)
{
include "attack.php";
}
else

if ($btn=="Атаковать базу" && $army>0)
{
include "siege.php";
}
else



if ($mode=="movearmy" && $army>0 && $direction>=1 && $direction<=4)
{

$res=mysql_query("select * from `army` where `n`='$army' and `up`='$wd_usern'");
if (mysql_num_rows($res)==1)
{

$arm_x=mysql_result($res,0,'x');
$arm_y=mysql_result($res,0,'y');

if ($direction==1) $arm_y++;
if ($direction==2) $arm_x++;
if ($direction==3) $arm_y--;
if ($direction==4) $arm_x--;

if ($arm_x<=0) $arm_x=100;
if ($arm_y<=0) $arm_y=100;
if ($arm_x>100) $arm_x=1;
if ($arm_y>100) $arm_y=1;


$dleft=5-$t_engine;
if ($dleft<1) $dleft=1;

$x=mysql_query("insert into `move` (`up`,`x`,`y`,`dleft`) values ('$army','$arm_x','$arm_y','$dleft')");

if ($x!=1) echo mysql_error();
else
{
echo "Маневр армии <b>$armyname</b> успешно начат.";
?><script>window.location.href="army.php?mode=view";</script><?
}
}
}
else
{






?><table width=100% <?=$paramtable?>>

<tr align=center>
<td <?=$paramhead?>>Армия</td>
<td <?=$paramhead2?> width=50><img src=pics/sm/unit23.jpg border=1 alt='Легкая пехота'></td>
<td <?=$paramhead2?> width=50><img src=pics/sm/unit24.jpg border=1 alt='Тяжелая пехота'></td>
<td <?=$paramhead2?> width=50><img src=pics/sm/unit25.jpg border=1 alt='Танк'></td>
<td <?=$paramhead2?> width=50><img src=pics/sm/unit26.jpg border=1 alt='Ракетный танк'></td>
<td <?=$paramhead2?> width=50><img src=pics/sm/unit22.jpg border=1 alt='ПКЦ'></td>

</tr>

<tr align=center>
<td bgcolor=#e2a267 align=left>Гарнизон базы <b><?=$res_name?></b>
<?
if ($lvl[27]>0) echo "<br>Саудукары: ".$lvl[27];
if ($lvl[28]>0) echo "<br>Разрушители: ".$lvl[28];
if ($lvl[29]>0) echo "<br>Фримены: ".$lvl[29];
?>
</td>
<td bgcolor=#e2a267><b><?=$lvl[23]?></b></td>
<td bgcolor=#e2a267><b><?=$lvl[24]?></b></td>
<td bgcolor=#e2a267><b><?=$lvl[25]?></b></td>
<td bgcolor=#e2a267><b><?=$lvl[26]?></b></td>
<td bgcolor=#e2a267><b><?=$lvl[22]?></b></td>

</tr>

</table>

<? 
$res=mysql_query("select * from `wduser` where `n`='$wd_usern'");
$status=mysql_result($res,0,'status');

if ($status==0) 
{ 
?>

<br><br>
<table width=100% <?=$paramtable?>>
<?
$res=mysql_query("select * from `army` where `up`='$wd_usern' order by `x`,`y`");
$max=@mysql_num_rows($res);

$btnparam='style="width:150;background-color:#d29257"';

for ($i=0;$i<$max;$i++)
{
$arm_n=mysql_result($res,$i,'n');

$arm_name=mysql_result($res,$i,'name');
$wins=mysql_result($res,$i,'wins');

$arm_x=mysql_result($res,$i,'x');
$arm_y=mysql_result($res,$i,'y');

$arm[23]=mysql_result($res,$i,'linf');
$arm[24]=mysql_result($res,$i,'hinf');
$arm[25]=mysql_result($res,$i,'tank');
$arm[26]=mysql_result($res,$i,'rtank');
$arm[22]=mysql_result($res,$i,'mobconst');

$arm[27]=mysql_result($res,$i,'spec1');
$arm[28]=mysql_result($res,$i,'spec2');
$arm[29]=mysql_result($res,$i,'spec3');

?>
<tr align=center>
<td align=left bgcolor=#e2a267 valign=top><b><?=$arm_name?></b>
<br>
Ранг: <b><?=$wins?></b><br>
Координаты: <b><? echo "[$arm_x:$arm_y]"; ?></b>

<?
if ($arm[27]>0) echo "<br>Саудукары: ".$arm[27];
if ($arm[28]>0) echo "<br>Разрушители: ".$arm[28];
if ($arm[29]>0) echo "<br>Фримены: ".$arm[29];
?>

</td>




<td width=200>
<center>
<form action=army.php method=post style="margin:0;" <? if ($wd_home==9) echo "target=_blank"; ?> >
<input type=hidden name=army value="<?=$arm_n?>">

<?
$text="Атаковать базу";

$res_b=mysql_query("select count(*) from `base` where `x`='$arm_x' and `y`='$arm_y' and `up`!='$wd_usern'");
if (mysql_result($res_b,0,'count(*)')>=1)
{
$res_b=mysql_query("select `up` from `base` where `x`='$arm_x' and `y`='$arm_y' and `up`!='$wd_usern'");
$up=mysql_result($res_b,0,'up');

$res_b=mysql_query("select * from `wduser` where `n`='$up'");
$delta=@mysql_result($res_b,0,'act')-@mysql_result($res_b,0,'reg');

if ($delta>=1000) $param="";
else
{
$param="disabled";
$text="Нельзя атаковать. Нуб.";
}

} else $param="disabled";
?>


<input type=submit name=btn value="<?=$text?>" <?=$btnparam?> <?=$param?>>

<?
$res_b=mysql_query("select count(*) from `army` where `x`='$arm_x' and `y`='$arm_y' and `up`!='$wd_usern'");
if (mysql_result($res_b,0,'count(*)')>=1) $param="";
else $param="disabled";
?>


<input type=submit name=btn value="Атаковать армию" <?=$btnparam?> <?=$param?>>

<?
$res_b=mysql_query("select count(*) from `base` where `x`='$arm_x' and `y`='$arm_y' and `up`='$wd_usern'");

if (mysql_result($res_b,0,'count(*)')==1)
{
$res_b=mysql_query("select `n` from `base` where `x`='$arm_x' and `y`='$arm_y' and `up`='$wd_usern'");
if (mysql_result($res_b,0,'n')==$wd_base)
{
$res_b=mysql_query("select * from `move` where `up`='$arm_n'");
if (@mysql_num_rows($res_b)==0)  $param="";

  else $param="disabled";
} else $param="disabled";
} else $param="disabled";
?>

<input type=submit name=btn value="В гарнизон" <?=$btnparam?> <?=$param?>>

<?
$name="Строить базу";

$res_b=mysql_query("select count(*) from `base` where `up`='$wd_usern'");

$res_b=mysql_query("select count(*) from `base` where `x`='$arm_x' and `y`='$arm_y'");
if (mysql_result($res_b,0,'count(*)')==0 && $arm[22]>=1)
{
$res_b=mysql_query("select * from `move` where `up`='$arm_n'");
if (@mysql_num_rows($res_b)!=0)
{
$param="disabled";
$name="Отряд в движении";
}
else $param="";
}
else $param="disabled";

?>

<input type=submit name=btn value="<?=$name?>" <?=$btnparam?> <?=$param?>>
</form></center>
</td>
<td align=left width=60 align=center>

<?
$res_b=mysql_query("select * from `move` where `up`='$arm_n'");

if (mysql_num_rows($res_b)==1)
{
$x=mysql_result($res_b,0,'x');
$y=mysql_result($res_b,0,'y');
$dleft=mysql_result($res_b,0,'dleft');

echo "<center>маршрут<br><b>[".$x.":".$y."]</b><br>дней<br><b>$dleft</b></center>";
}
else
{
?>

<table width=60 height=60 cellspacing=1 cellpadding=0 border=1 bordercolor=#e2a267>
<tr>
<td width=20 height=20>&nbsp;</td>
<td width=20 height=20><a href=army.php?mode=movearmy&army=<?=$arm_n?>&direction=1><img src=pics/ar_u.gif border=0></a></td>
<td width=20 height=20>&nbsp;</td>
</tr>
<tr>
<td width=20 height=20><a href=army.php?mode=movearmy&army=<?=$arm_n?>&direction=4><img src=pics/ar_l.gif border=0></a></td>
<td width=20 height=20></td>
<td width=20 height=20><a href=army.php?mode=movearmy&army=<?=$arm_n?>&direction=2><img src=pics/ar_r.gif border=0></a></td>
</tr>
<tr>
<td width=20 height=20>&nbsp;</td>
<td width=20 height=20><a href=army.php?mode=movearmy&army=<?=$arm_n?>&direction=3><img src=pics/ar_d.gif border=0></a></td>
<td width=20 height=20>&nbsp;</td>
</tr>
</table>
<? } ?>
</td>
<td width=52><?=$arm[23]?></td>
<td width=52><?=$arm[24]?></td>
<td width=52><?=$arm[25]?></td>
<td width=52><?=$arm[26]?></td>
<td width=52><?=$arm[22]?></td>
</tr>
<? } ?>

</table>
<br><br>
<form action=<?=$a?> method=post>
<center>
<table <?=$paramtable?>>

<tr><td colspan=3 <?=$paramhead?>>Новая армия</td></tr>

<tr><td>Название армии</td>
<td colspan=2><input name=armyname style="width:230px"></td></tr>

<tr><td>Легкая пехота</td>
<td><input name=armylinf>
 в гарнизоне: <?=$lvl[23]?>
</td><td>max: 500</td></tr>

<tr><td>Тяжелая пехота</td>
<td><input name=armyhinf>
 в гарнизоне: <?=$lvl[24]?>
</td><td>max: 250</td></tr>

<tr><td>Танки</td>
<td><input name=armytank>
 в гарнизоне: <?=$lvl[25]?>
</td><td>max: 100</td></tr>

<tr><td>Ракетные танки</td>
<td><input name=armyrtank>
 в гарнизоне: <?=$lvl[26]?>
</td><td>max: 50</td></tr>

<tr><td>Передвижные командные центры</td>
<td><input name=armymobconst>
 в гарнизоне: <?=$lvl[22]?>
</td><td>max: -</td></tr>

<tr><td colspan=3><input type=hidden name=mode value=newarmy><input type=submit name=btn value='Создать армию'></td></tr>

</table>
</center>
</form>

<? } else echo "<br><br>Вы не можете управлять армиями в режиме отпуска.<br><br>";?>

<?
// #########################
$res=mysql_query("select sum(constr) from `base` where `up`='$wd_usern'");
$maxarmy=mysql_result($res,0,'sum(constr)')*10;

$res=mysql_query("select count(*) from `base` where `up`='$wd_usern'");
$numbases=mysql_result($res,0,'count(*)');

echo "<br>* Вы можете создать максимум <b>$numbases</b> армий. (Количество армий игрока равняется количеству его баз.)";
// #########################
?>


<?
}
} 
}

include "footer.php";
*/
?>