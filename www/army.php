<?
extract($_POST);
extract($_GET);
include "header.php";

if (isset($wd_base))
{
$res=mysql_query("select * from `day`");
$limit=mysql_result($res,0,'limit');


if (isset($btn2) && $btn2=="Собрать"){
	if(!isset($mode) || ($mode!="Выполнить")){
		$arm_x=intval($arm_x);
		$arm_y=intval($arm_y);
		$arm_n=intval($arm_n);
		$arm_name=htmlspecialchars($arm_name,ENT_NOQUOTES);
		$res_a=mysql_query("SELECT * FROM `army` WHERE `x`='$arm_x' and `y`='$arm_y' and `n`='$arm_n' and `up`='$wd_usern'");
		$resarr=mysql_fetch_array($res_a);
		$armylinf=$resarr['linf'];
    $armyhinf=$resarr['hinf'];
    $armytank=$resarr['tank'];
    $armyrtank=$resarr['rtank'];
    $armymobconst=$resarr['mobconst'];
    $armyharv=$resarr['harv'];
		?>
<p align=left>Внимание! Новая армия получает ранг, определяемый опытом составных армий. <br>
Состояние армии будет "Отдых" если хоть одна из армий имеет такое состояние.<br>
Количество побед будет суммировано.
<form method=post>
<input type=hidden name=arm_x value=<?=$arm_x?>>
<input type=hidden name=arm_y value=<?=$arm_y?>>
<center>
<table <?=$paramtable?>>

<tr><td colspan=3 <?=$paramhead?>>Формирование новой армии<?=$arm_name?></td></tr>
<tr><td>Название новой армии</td>
<td><input name=armyname></td></tr>
<tr><td colspan=3>
<input type=hidden name=arm_x value=<?=$arm_x?>>
<input type=hidden name=arm_y value=<?=$arm_y?>>
<input type=hidden name=btn2 value="Собрать">
<input type=submit name=mode value='Выполнить'></td></tr>

</table>
		<?
	} else if($mode=="Выполнить") { //mode isset
    if (isset($arm_x)) $arm_x=intval($arm_x);
    if (isset($arm_y)) $arm_y=intval($arm_y);
    if (isset($armyname) && $armyname=="") $armyname="по_умолчанию";
    $res_a=mysql_query("SELECT * FROM `army` WHERE `x`='$arm_x' and `y`='$arm_y' and `up`='$wd_usern'");
    if(intval(@mysql_num_rows($res_a))>1) {
        $stoparmy=0;
	while($resarr=mysql_fetch_array($res_a)) {
	  $res_m=mysql_query("SELECT * FROM `move` WHERE `up`='".$resarr['n']."'");
  	  if(intval(@mysql_num_rows($res_m))>0) {$stoparmy=1;break;}
	}
        if($stoparmy==0)
         {
  	    	$armylinf=0;
  	    	$armyhinf=0;
  	    	$armytank=0;
  	    	$armyrtank=0;
  	    	$armymobconst=0;
  	    	$armyharv=0;
  	    	$rang=0;
  	    	$wins=0;
  	    	$round_=0;
		$res_a=mysql_query("SELECT * FROM `army` WHERE `x`='$arm_x' and `y`='$arm_y' and `up`='$wd_usern'");
  	    	while($resarr=mysql_fetch_array($res_a)) {
  	    		$n=$resarr['n'];

//Подсчёт стоимоти армий.
$cost1=100*$armylinf+250*$armyhinf+3000*$armytank+7500*$armyrtank;
$cost2=100*$resarr['linf']+250*$resarr['hinf']+3000*$resarr['tank']+7500*$resarr['rtank'];

						$armylinf=$armylinf+$resarr['linf'];
    				$armyhinf=$armyhinf+$resarr['hinf'];
    				$armytank=$armytank+$resarr['tank'];
    				$armyrtank=$armyrtank+$resarr['rtank'];
    				$armymobconst=$armymobconst+$resarr['mobconst'];
    				$armyharv=$armyharv+$resarr['harv'];

//				Нормальный пересчёт ранга
$rang=($rang*$cost1+$resarr['rang']*$cost2)/($cost1+$cost2);

    				$wins=$resarr['wins']+$wins;
    				if($resarr['round']>$round_) $round_=$resarr['round'];
    				mysql_query("DELETE FROM `army` WHERE `n`='$n'");
    			}
					mysql_query("INSERT INTO `army` (`up`,`x`,`y`,`name`,`round`,`rang`,`wins`,`linf`,`hinf`,`tank`,`rtank`,`mobconst`,`harv`) VALUES ('$wd_usern','$arm_x','$arm_y','$armyname','$round_','$rang','$wins','$armylinf','$armyhinf','$armytank','$armyrtank','$armymobconst','$armyharv')");
					log_(31,"$armylinf:$armyhinf:$armytank:$armyrtank:$armyharv:$armymobconst:$armyname:$arm_x:$arm_y");
    		  echo "<script>document.location='$a?mode=view';</script>";
				} else {echo "Одна из армии на клетке находится в движении. Невозможно сгруппировать армии в движении.";}
    }
  }
}
else
if (isset($btn1) && $btn1=="Разбить"){
	if(!isset($mode) || ($mode!="Готово")){
		$arm_x=intval($arm_x);
		$arm_y=intval($arm_y);
		$arm_n=intval($arm_n);
		$arm_name=htmlspecialchars($arm_name,ENT_NOQUOTES);
		$res_a=mysql_query("SELECT * FROM `army` WHERE `x`='$arm_x' and `y`='$arm_y' and `n`='$arm_n' and `up`='$wd_usern'");
		$resarr=mysql_fetch_array($res_a);
		$armylinf=$resarr['linf'];
    	$armyhinf=$resarr['hinf'];
   		$armytank=$resarr['tank'];
    	$armyrtank=$resarr['rtank'];
    	$armymobconst=$resarr['mobconst'];
    	$armyharv=$resarr['harv'];
		?>
<p align=left>При делении армий, новые армии имеют тот же ранг, что исходная.
<form method=post>
<input type=hidden name=arm_x value=<?=$arm_x?>>
<input type=hidden name=arm_y value=<?=$arm_y?>>
<center>
<table <?=$paramtable?>>

<tr><td colspan=3 <?=$paramhead?>>Расформирование армии <?=$arm_name?></td></tr>

<tr><td>Легкая пехота</td>
<td><input name=armylinf>
 в отряде: <?=$armylinf?>
</td></tr>

<tr><td>Тяжелая пехота</td>
<td><input name=armyhinf>
 в отряде: <?=$armyhinf?>
</td></tr>

<tr><td>Танки</td>
<td><input name=armytank>
 в отряде: <?=$armytank?>
</td></tr>

<tr><td>Ракетные танки</td>
<td><input name=armyrtank>
 в отряде: <?=$armyrtank?>
</td></tr>

<tr><td>Передвижные командные центры</td>
<td><input name=armymobconst>
 в отряде: <?=$armymobconst?>
</td></tr>

<tr><td>Харвестеры</td>
<td><input name=armyharv>
 в отряде: <?=$armyharv?>
</td></tr>


<tr><td colspan=3>
<input type=hidden name=arm_x value=<?=$arm_x?>>
<input type=hidden name=arm_y value=<?=$arm_y?>>
<input type=hidden name=arm_n value=<?=$arm_n?>>
<input type=hidden name=btn1 value="Разбить">
<input type=submit name=mode value='Готово'></td></tr>

</table>
		<?
	} else if($mode=="Готово") { //mode isset
	if (isset($armylinf)) $armylinf=intval($armylinf); else $armylinf=0;
    if (isset($armyhinf)) $armyhinf=intval($armyhinf); else $armyhinf=0;
    if (isset($armytank)) $armytank=intval($armytank); else $armytank=0;
    if (isset($armyrtank)) $armyrtank=intval($armyrtank); else $armyrtank=0;
    if (isset($armymobconst)) $armymobconst=intval($armymobconst); else $armymobconst=0;
    if (isset($armyharv)) $armyharv=intval($armyharv); else $armyharv=0;
    if (isset($arm_x)) $arm_x=intval($arm_x);
    if (isset($arm_y)) $arm_y=intval($arm_y);
    if (isset($arm_n)) $arm_n=intval($arm_n);
    if ($armylinf<0) $armylinf=0;
	if ($armyhinf<0) $armyhinf=0;
	if ($armytank<0) $armytank=0;
	if ($armyrtank<0) $armyrtank=0;
	if ($armymobconst<0) $armymobconst=0;
	if ($armyharv<0) $armyharv=0;
    $res_all=mysql_query("SELECT * FROM `army` WHERE `up`='$wd_usern'");
    $tmp=intval(@mysql_num_rows($res_all))+1;
    $res_a=mysql_query("SELECT * FROM `army` WHERE `x`='$arm_x' and `y`='$arm_y' and `n`='$arm_n' and `up`='$wd_usern'");
    if(intval(@mysql_num_rows($res_a))>0) {
        $res_m=mysql_query("SELECT * FROM `move` WHERE `up`='$arm_n'");
  	    if(intval(@mysql_num_rows($res_m))==0) {
  	    	  $resarr=mysql_fetch_array($res_a);
						$armylinf1=$resarr['linf'];
    				$armyhinf1=$resarr['hinf'];
    				$armytank1=$resarr['tank'];
    				$armyrtank1=$resarr['rtank'];
    				$armymobconst1=$resarr['mobconst'];
    				$armyharv1=$resarr['harv'];
    				$armyname=$resarr['name']."_$tmp";

  	      	$linf_left=$armylinf1-$armylinf;
						$hinf_left=$armyhinf1-$armyhinf;
						$tank_left=$armytank1-$armytank;
						$rtank_left=$armyrtank1-$armyrtank;
						$mobconst_left=$armymobconst1-$armymobconst;
						$harv_left=$armyharv1-$armyharv;
						if ($linf_left<0 || $hinf_left<0 || $tank_left<0 || $rtank_left<0 || $mobconst_left<0 || $harv_left<0)
						{ echo "Ошибка! Вы пытаетесь создать армию большую чем у вас есть.";}
						else {
  	      	$rang=$resarr['rang'];
  	      	$round_=$resarr['round'];
    		    //$cost1=$resarr['linf']*100+$resarr['hinf']*250+$resarr['tank']*3000+$resarr['rtank']*7500;
    		    //$cost2=$armylinf*100+$armyhinf*250+$armytank*3000+$armyrtank*7500;
    		    //$rang=($cost1*(1+$rang)+$cost2)/($cost1+$cost2)-1;
    		    //if($rang<0) $rang=0;
    		    //if($cost1<$cost2) $round_=0;
if (($linf_left+$hinf_left+$tank_left+$rtank_left)<=0)
{ echo "Ошибка! Вы пытаетесь перевести всю старую армию в новую.";}
else {

if ( ($armylinf+$armyhinf+$armytank+$armyrtank)==0 )
{
 echo "Ошибка! В новой армии нет ни одного боевого юнита";
}
else
{
						mysql_query("INSERT INTO `army` (`up`,`x`,`y`,`name`,`round`,`rang`,`linf`,`hinf`,`tank`,`rtank`,`mobconst`,`harv`) VALUES ('$wd_usern','$arm_x','$arm_y','$armyname','$round_','$rang','$armylinf','$armyhinf','$armytank','$armyrtank','$armymobconst','$armyharv')");
    		    mysql_query("UPDATE `army` SET `linf`='$linf_left',`hinf`='$hinf_left',`tank`='$tank_left',`rtank`='$rtank_left',`mobconst`='$mobconst_left',`harv`='$harv_left' WHERE `n`='$arm_n'");
    		     echo "<script>document.location='$a?mode=view';</script>";
}
    		  log_(32,"$armylinf:$armyhinf:$armytank:$armyrtank:$armymobconst:$armyharv:$linf_left:$hinf_left:$tank_left:$rtank_left:$harv_left:$mobconst_left:$arm_x:$arm_y");
}    		  }
    	    }
      }
    }
}
else
if (isset($btn) && $btn=="Доукомплектовать"){
	if(!isset($mode) || ($mode!="Готово")){
		$arm_x=intval($arm_x);
		$arm_y=intval($arm_y);
		$arm_n=intval($arm_n);
		$arm_name=htmlspecialchars($arm_name,ENT_NOQUOTES);
		?>
<p align=left>Внимание! При добавлении войск в армию, текущий ранг армии уменьшается, в зависимости от количества добовляемых войск.
<form method=post>
<input type=hidden name=arm_x value=<?=$arm_x?>>
<input type=hidden name=arm_y value=<?=$arm_y?>>
<center>
<table <?=$paramtable?>>

<tr><td colspan=3 <?=$paramhead?>>Подкрепление армии <?=$arm_name?></td></tr>

<tr><td>Легкая пехота</td>
<td><input name=armylinf>
 в гарнизоне: <?=$lvl[23]?>
</td></tr>

<tr><td>Тяжелая пехота</td>
<td><input name=armyhinf>
 в гарнизоне: <?=$lvl[24]?>
</td></tr>

<tr><td>Танки</td>
<td><input name=armytank>
 в гарнизоне: <?=$lvl[25]?>
</td></tr>

<tr><td>Ракетные танки</td>
<td><input name=armyrtank>
 в гарнизоне: <?=$lvl[26]?>
</td></tr>

<tr><td>Передвижные командные центры</td>
<td><input name=armymobconst>
 в гарнизоне: <?=$lvl[22]?>
</td></tr>

<tr><td>Харвестеры</td>
<td><input name=armyharv>
 в гарнизоне: <?=$lvl[21]?>
</td></tr>


<tr><td colspan=3>
<input type=hidden name=arm_x value=<?=$arm_x?>>
<input type=hidden name=arm_y value=<?=$arm_y?>>
<input type=hidden name=arm_n value=<?=$arm_n?>>
<input type=hidden name=btn value="Доукомплектовать">
<input type=submit name=mode value='Готово'></td></tr>

</table>
		<?
	} else if($mode=="Готово") { //mode isset
		if (isset($armylinf)) $armylinf=intval($armylinf); else $armylinf=0;
    if (isset($armyhinf)) $armyhinf=intval($armyhinf); else $armyhinf=0;
    if (isset($armytank)) $armytank=intval($armytank); else $armytank=0;
    if (isset($armyrtank)) $armyrtank=intval($armyrtank); else $armyrtank=0;
    if (isset($armymobconst)) $armymobconst=intval($armymobconst); else $armymobconst=0;
    if (isset($armyharv)) $armyharv=intval($armyharv); else $armyharv=0;
    if (isset($arm_x)) $arm_x=intval($arm_x);
    if (isset($arm_y)) $arm_y=intval($arm_y);
    if (isset($arm_n)) $arm_n=intval($arm_n);
    if ($armylinf<0) $armylinf=0;
		if ($armyhinf<0) $armyhinf=0;
		if ($armytank<0) $armytank=0;
		if ($armyrtank<0) $armyrtank=0;
		if ($armymobconst<0) $armymobconst=0;
		if ($armyharv<0) $armyharv=0;
    $res_a=mysql_query("SELECT * FROM `army` WHERE `x`='$arm_x' and `y`='$arm_y' and `n`='$arm_n' and `up`='$wd_usern'");
    if(intval(@mysql_num_rows($res_a))>0) {
      $res_b=mysql_query("SELECT * FROM `base` WHERE `x`='$arm_x' and `y`='$arm_y' and `up`='$wd_usern'");
      if(intval(@mysql_num_rows($res_b))>0) {
       	if(mysql_result($res_b,0,'n')==$wd_base){
      	  $res_m=mysql_query("SELECT * FROM `move` WHERE `up`='$arm_n'");
  	      if(intval(@mysql_num_rows($res_m))==0) {
  	      	$linf_left=$lvl[23]-$armylinf;
						$hinf_left=$lvl[24]-$armyhinf;
						$tank_left=$lvl[25]-$armytank;
						$rtank_left=$lvl[26]-$armyrtank;
						$mobconst_left=$lvl[22]-$armymobconst;
						$harv_left=$lvl[21]-$armyharv;
						if ($linf_left<0 || $hinf_left<0 || $tank_left<0 || $rtank_left<0 || $mobconst_left<0 || $harv_left<0)
						{ echo "Ошибка! Вы пытаетесь добавить в армию больше боевых единиц чем у вас есть.";}
						else {
  	      	$resarr=mysql_fetch_array($res_a);
  	      	$rang=$resarr['rang'];
  	      	$round_=$resarr['round'];
    		    $cost1=$resarr['linf']*100+$resarr['hinf']*250+$resarr['tank']*3000+$resarr['rtank']*7500;
    		    $cost2=$armylinf*100+$armyhinf*250+$armytank*3000+$armyrtank*7500;
    		    $rang=($cost1*(1+$rang)+$cost2)/($cost1+$cost2)-1;
    		    if($rang<0) $rang=0;
    		    if($cost1<$cost2) $round_=0;
    		    $armylinf=$resarr['linf']+$armylinf;
    		    $armyhinf=$resarr['hinf']+$armyhinf;
    		    $armytank=$resarr['tank']+$armytank;
    		    $armyrtank=$resarr['rtank']+$armyrtank;
    		    $armymobconst=$resarr['mobconst']+$armymobconst;
    		    $armyharv=$resarr['harv']+$armyharv;
if ($armylinf<0 || $armyhinf<0 || $armytank<0 || $armyrtank<0 || $armymobconst<0 || $armyharv<0)
{ echo "Ошибка! Вы пытаетесь оставить на базе больше боевых единиц чем у вас есть.";}
else {

if ( ($armylinf+$armyhinf+$armytank+$armyrtank+$armymobconst+$armyharv)==0 )
{
mysql_query("delete from `army` where `n`='$arm_n'");
}
else
{
    		    mysql_query("UPDATE `army` SET `round`='$round_',`rang`='$rang',`linf`='$armylinf',`hinf`='$armyhinf',`tank`='$armytank',`rtank`='$armyrtank',`mobconst`='$armymobconst',`harv`='$armyharv' WHERE `n`='$arm_n'");
}
    		    mysql_query("update base set `hinf`='$hinf_left',`linf`='$linf_left',`tank`='$tank_left',`rtank`='$rtank_left',`mobconst`='$mobconst_left',`harv`='$harv_left' where `up`='$wd_usern' and `n`='$wd_base' ");
    		    log_(33,"$armylinf:$armyhinf:$armytank:$armyrtank:$armyharv:$armymobconst:$arm_x:$arm_y");
    		    echo "Армия доукомплектована";
    		    echo "<script>document.location='$a?mode=view';</script>";
}    		  }
    	    }
    	  }
      }
    }
	}
}
else

if (isset($mode) && isset($btn) && ($mode=="newarmy" && $btn=="Создать армию"))
{
if (isset($armylinf)) $armylinf=intval($armylinf);
if (isset($armyhinf)) $armyhinf=intval($armyhinf);
if (isset($armytank)) $armytank=intval($armytank);
if (isset($armyrtank)) $armyrtank=intval($armyrtank);
if (isset($armymobconst)) $armymobconst=intval($armymobconst);
if (isset($armyharv)) $armyharv=intval($armyharv);

$linf_left=$lvl[23]-$armylinf;
$hinf_left=$lvl[24]-$armyhinf;
$tank_left=$lvl[25]-$armytank;
$rtank_left=$lvl[26]-$armyrtank;
$mobconst_left=$lvl[22]-$armymobconst;
$harv_left=$lvl[21]-$armyharv;

$cena=$armylinf*100+$armyhinf*250+$armytank*3000+$armyrtank*7500+$armyharv*300;

if ($linf_left<0 || $hinf_left<0 || $tank_left<0 || $rtank_left<0 || $mobconst_left<0 || $harv_left<0) echo "Ошибка! Вы пытаетесь создать армию с большим числом боевых единиц, чем у вас есть.";
else
{
if ($armylinf<0 || $armyhinf<0 || $armytank<0 || $armyrtank<0 || $armymobconst<0 || $armyharv<0) echo "Ошибка! Вы пытаетесь создать армию с отрицательным количеством боевых единиц.";
else
{
if ($armylinf+$armyhinf+$armytank+$armyrtank>0)
{



// #########################


if ($armyname=="" || !isset($armyname)) $armyname="по умолчанию";

$x=mysql_query("insert into army (`up`,`name`,`x`,`y`,`mobconst`,`linf`,`hinf`,`tank`,`rtank`,`harv`) values ('$wd_usern','$armyname','$res_x','$res_y','$armymobconst','$armylinf','$armyhinf','$armytank','$armyrtank','$armyharv')");
if ($x==1)
{

$x2=mysql_query("update base set `hinf`='$hinf_left',`linf`='$linf_left',`tank`='$tank_left',`rtank`='$rtank_left',`mobconst`='$mobconst_left',`harv`='$harv_left' where `up`='$wd_usern' and `n`='$wd_base' ");
if ($x2!=1) echo mysql_error();
else
{
setactiv($wd_usern);
echo "Армия <b>$armyname</b> стоимостью <b>$cena</b> успешно создана.";
log_(9,"$armylinf:$armyhinf:$armytank:$armyrtank:$armymobconst:$armyharv:$armyname:$res_x:$res_y");
?><script>window.location.href="army.php?mode=view";</script><?
}

} else echo mysql_error();

} else echo "В армии должен быть хотябы один боевой юнит. Повторите попытку создания армии.";
} // закрытие детекта отрицательных значений
} // закрытие славиного глюка


}
else
{


if (isset($army)) $army=intval($army);
if (isset($direction)) $direction=intval($direction);

if (isset($btn) && ($btn=="В гарнизон" && $army>0))
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
        $armyharv=mysql_result($res,0,'harv');

	$linf_left=$lvl[23]+$armylinf;
	$hinf_left=$lvl[24]+$armyhinf;
	$tank_left=$lvl[25]+$armytank;
	$rtank_left=$lvl[26]+$armyrtank;
	$mobconst_left=$lvl[22]+$armymobconst;
        $sard_left=$lvl[27]+$armysard;
        $deva_left=$lvl[28]+$armydeva;
        $free_left=$lvl[29]+$armyfree;
        $harv_left=$lvl[21]+$armyharv;

        $x=mysql_query("update base set `hinf`='$hinf_left',`linf`='$linf_left',`tank`='$tank_left',`rtank`='$rtank_left',`mobconst`='$mobconst_left',`spec1`='$sard_left',`spec2`='$deva_left',`spec3`='$free_left',`harv`='$harv_left' where `up`='$wd_usern' and `n`='$wd_base' ");
	if ($x==1)
			{
			setactiv($wd_usern);
			$x2=mysql_query("delete from `army` where `n`='$army'");
			if ($x2!=1) echo mysql_error();
			else
				{
				echo "Армия Успешно переведена в гарнизон";
			  log_(8,"$armylinf:$armyhinf:$armytank:$armyrtank:$armyharv:$armymobconst:$ax:$ay");
				?><script>window.location.href="army.php?mode=view";</script><?
				}
		}

} else echo "Армия может переходить в гарнизон только той базы в квадрате которой она находится.";
}
}
else

if (isset($btn) && ($btn=="Строить базу" && $army>0))
{
$res=mysql_query("select * from `army` where `n`='$army' and `up`='$wd_usern' and `mobconst`>0");
if (mysql_num_rows($res)==1)
{
	$arm_name=mysql_result($res,0,'name');
	$arm_m=mysql_result($res,0,'mobconst');
	$arm_h=mysql_result($res,0,'harv');
	$arm_x=mysql_result($res,0,'x');
	$arm_y=mysql_result($res,0,'y');

	$mcl=$arm_m-1;
	$bn="База ".$arm_name;
	$harv=$arm_h+1;

	$x=mysql_query("SELECT * FROM `base` WHERE `x`='".$arm_x."' AND `y`='".$arm_y."';");
// mysql_num_rows($x)
	if (mysql_num_rows($x)) echo 'Здесь уже есть база!';
	else {
		$x=mysql_query("insert into base(`up`,`name`,`x`,`y`,`constr`,`harv`) values('$wd_usern','$bn','$arm_x','$arm_y','1','$harv')");

		if ($x==1)
				{
				setactiv($wd_usern);
				$x2=mysql_query("update `army` set `mobconst`='$mcl',`harv`='0' where `up`='$wd_usern' and `n`='$army' ");
				if ($x2!=1) echo mysql_error();
				else
					{
					echo "База Успешно создана.";
					log_(30,"$bn:$arm_x:$arm_y");
					?><script>window.location.href="army.php?mode=view";</script><?
					}
			}
	}
}
}
else

if (isset($btn) && ($btn=="Напасть на армию" && $army>0))
{
setactiv($wd_usern);
include "attack.php";
}
else

if (isset($btn) && ($btn=="Атаковать армию" && $army>0))
{
unset($armynumber);
$res1=mysql_query("select * from `army` where `n`='$army' and `up`='$wd_usern'");
if (mysql_num_rows($res1)==1)
{
	$x=mysql_result($res1,0,'x');
	$y=mysql_result($res1,0,'y');
}

$reso=mysql_query("select count(*) from `army` where `x`='$x' and `y`='$y' and `up`!='$wd_usern'");
$arm=mysql_result($reso,0,'count(*)');
if ($arm>1)
{
?>
<form>
<center>
<select name=armynumber style="width:200px">
<?
$res2=mysql_query("select * from `army` where `x`='$x' and `y`='$y' and `up`!='$wd_usern'");
$reso=mysql_query("select n,name from army where `x`='$x' and `y`='$y' and up!='$wd_usern' order by n");
for ($i=0;$i<mysql_num_rows($reso);$i++)
{
echo "<option value=".mysql_result($reso,$i,'n')." ";
echo " >".mysql_result($reso,$i,'name')."</option>";
}
?>
</select><br><br>
<input type=hidden name=army value=<?=$army?> >
<input type=submit name=btn value="Напасть на армию" <? if (isset($btnparam)) echo "$btnparam"; ?> <? if (isset($param)) echo "$param"; ?>>
</center>
</form>
<?
}
else {
setactiv($wd_usern);
include "attack.php";
}
}
else if (isset($btn) && ($btn=="Атаковать базу" && $army>0))
{
setactiv($wd_usern);
include "siege.php";
}
else if (isset($mode) && ($mode=="movearmy" && $army>0 && $direction==0))
{
$x=mysql_query("delete from `move` where up='$army'");
if ($x!=1) echo mysql_error();
else
{
setactiv($wd_usern);
?><script>window.location.href="army.php?mode=view";</script><?
}
}
else

if (isset($mode) && ($mode=="movearmy" && $army>0 && $shift>0 && $direction>=1 && $direction<=4))
{

$res=mysql_query("select * from `army` where `n`='$army' and `up`='$wd_usern'");
if (mysql_num_rows($res)==1)
{
$res2=mysql_query("SELECT * FROM `move` WHERE `up`='$army'");
if (@mysql_num_rows($res2)==0) {
$arm_x=mysql_result($res,0,'x');
$arm_y=mysql_result($res,0,'y');
if (isset($shift)) $shift=intval($shift);
else $shift=0;

if ($direction==1) $arm_y+=$shift;
if ($direction==2) $arm_x+=$shift;
if ($direction==3) $arm_y-=$shift;
if ($direction==4) $arm_x-=$shift;

if(!$granica) {
if ($arm_x<=0) $arm_x=$dune_x;
if ($arm_y<=0) $arm_y=$dune_y;
if ($arm_x>$dune_x) $arm_x=1;
if ($arm_y>$dune_y) $arm_y=1;
} else {
if ($arm_x<=0) $arm_x=1;
if ($arm_y<=0) $arm_y=1;
if ($arm_x>$dune_x) $arm_x=$dune_x;
if ($arm_y>$dune_y) $arm_y=$dune_y;
}

$dleft=5-$t_engine;
if ($dleft<1) $dleft=1;

$x=mysql_query("insert into `move` (`up`,`x`,`y`,`dleft`,`hday`,`direct`) values ('$army','$arm_x','$arm_y','$dleft','$dleft','$direction')");

if ($x!=1) echo mysql_error();
else
{
setactiv($wd_usern);
echo "Маневр армии <b>$armyname</b> успешно начат.";
?><script>window.location.href="army.php?mode=view";</script><?
}
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
<?
$res=mysql_query("SELECT * FROM `base` WHERE `up`='$wd_usern' AND `n`='$wd_base'");
$max=intval(@mysql_num_rows($res));
for($ii=0;$ii<$max;$ii++) {
$lp=mysql_result($res,$ii,'linf');
$tp=mysql_result($res,$ii,'hinf');
$t=mysql_result($res,$ii,'tank');
$rt=mysql_result($res,$ii,'rtank');
$sd=mysql_result($res,$ii,'spec1');
$dv=mysql_result($res,$ii,'spec2');
$fr=mysql_result($res,$ii,'spec3');
$mkc=mysql_result($res,$ii,'mobconst');
$harv=mysql_result($res,$ii,'harv');
$bname=mysql_result($res,$ii,'name');
?>
<tr align=center>
<td bgcolor=#e2a267 align=left>Гарнизон базы <b><?=$bname?></b>
<?
if ($sd>0) echo "<br>Саудукары: ".$sd;
if ($dv>0) echo "<br>Разрушители: ".$dv;
if ($fr>0) echo "<br>Фримены: ".$fr;
?>
</td>
<td bgcolor=#e2a267><b><?=$lp?></b></td>
<td bgcolor=#e2a267><b><?=$tp?></b></td>
<td bgcolor=#e2a267><b><?=$t?></b></td>
<td bgcolor=#e2a267><b><?=$rt?></b></td>
<td bgcolor=#e2a267><b><?=$mkc?></b></td>

</tr>
<? } ?>
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
$btnparam2='style="width:70;background-color:#d29257"';

for ($i=0;$i<$max;$i++)
{
$arm_n=mysql_result($res,$i,'n');

$arm_name=mysql_result($res,$i,'name');
$wins=mysql_result($res,$i,'wins');
$rang=round(mysql_result($res,$i,'rang'),1);

$arm_x=mysql_result($res,$i,'x');
$arm_y=mysql_result($res,$i,'y');
$round_=mysql_result($res,$i,'round');

$arm[23]=mysql_result($res,$i,'linf');
$arm[24]=mysql_result($res,$i,'hinf');
$arm[25]=mysql_result($res,$i,'tank');
$arm[26]=mysql_result($res,$i,'rtank');
$arm[21]=mysql_result($res,$i,'harv');
$arm[22]=mysql_result($res,$i,'mobconst');

$arm[27]=mysql_result($res,$i,'spec1');
$arm[28]=mysql_result($res,$i,'spec2');
$arm[29]=mysql_result($res,$i,'spec3');

?>
<tr align=center>
<td align=left bgcolor=#e2a267 valign=top><b><?=$arm_name?></b>
<br>
Ранг: <b><?=$rang?></b><br>
Победы: <b><?=$wins?></b><br>
Координаты: <b><? echo "[$arm_x:$arm_y]"; ?></b><br>
Состояние: <? if($round_==0) echo "Готов. "; else echo "Отдых $round_ д. " ?>
<? if($wd_usern==6) echo "Цель: ".mysql_result($res,$i,'targ'); ?>

<?
if ($arm[27]>0) echo "<br>Сардукары: ".$arm[27];
if ($arm[28]>0) echo "<br>Разрушители: ".$arm[28];
if ($arm[29]>0) echo "<br>Фримены: ".$arm[29];
if ($arm[21]>0) echo "<br>Харвестеры: ".$arm[21];
?>

</td>

<td width=100>



<table border=0 cellpadding=0 cellspacing=1 bordercolor=#e2a267><?

for ($y1=$arm_y+1;$y1>=$arm_y-1;$y1--)
{
?><tr><?
for ($x1=$arm_x-1;$x1<=$arm_x+1;$x1++)
{

if(!$granica) {
echo "<td width=32 height=32";
if ($x1<=0) $x=$x1+$dune_x;
else if ($x1>$dune_x) $x=$x1-$dune_x;
else $x=$x1;

if ($y1<=0) $y=$y1+$dune_y;
else if ($y1>$dune_y) $y=$y1-$dune_y;
else $y=$y1;
} else {
	$x=$x1;
	$y=$y1;
	if($x<=0 || $x>$dune_x || $y<=0 || $y>$dune_y) echo "<td width=32 height=32 bgcolor=#e2a267 ";
	else echo "<td width=32 height=32";
}

{

$resm=mysql_query("select * from `base` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($resm)==0) {
	if($granica && ($x<=0 || $x>$dune_x || $y<=0 || $y>$dune_y)) echo " title='Граница мира'";
	else echo " background=pics/map_sand.gif title='[$x:$y]\nПустыня'";
}
else
{
$up=mysql_result($resm,0,'up');
$name=mysql_result($resm,0,'name');
$constr=mysql_result($resm,0,'constr');

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uname=@mysql_result($res2,0,'login');
$uhome=@mysql_result($res2,0,'home');
$al=@mysql_result($res2,0,'al');
$status=@mysql_result($res2,0,'status');

$delta=@mysql_result($res2,0,'act')-@mysql_result($res2,0,'reg');

$sd="";
if(($delta<1500) && ($uhome!=0))
{
$deft=1500-$delta;
$sd="Атака базы невозможна, это молодой игрок. $deft игровых дней до окончания статус молодого игрока.\n\n";
}

if ($al!="") $uname="[".$al."] ".$uname;

if ($status>0) $awaytext="Отпуск: $status игровых дней\n"; else $awaytext="";
if ($uhome==0) echo " background=pics/map_base_o.gif  title='[$x:$y]\n$awaytext $sd База фрименов $name \nИгрок: $uname\nуровень $constr' ";
if ($uhome==4) echo " background=pics/map_base_p.gif  title='[$x:$y]\n$awaytext $sd База Карину $name \nИгрок: $uname\nуровень $constr' ";
if ($uhome==1) echo " background=pics/map_base_b.gif  title='[$x:$y]\n$awaytext $sd База Атрейдесов $name\nИгрок: $uname\nуровень $constr' ";
if ($uhome==2) echo " background=pics/map_base_g.gif  title='[$x:$y]\n$awaytext $sd База Ордосов $name\nИгрок: $uname\nуровень $constr' ";
if ($uhome==3) echo " background=pics/map_base_r.gif  title='[$x:$y]\n$awaytext $sd База Харконненов $name\nИгрок: $uname\nуровень $constr' ";

}


}
echo ">";


$resm2=mysql_query("select * from `army` where `x`='$x' and `y`='$y'");
if (mysql_num_rows($resm2)==1)
{
$up=mysql_result($resm2,0,'up');
$name=mysql_result($resm2,0,'name');
$wins=mysql_result($resm2,0,'wins');
$rang=round(mysql_result($resm2,0,'rang'),1);

$res2=mysql_query("select * from `wduser` where `n`='$up'");
$uname=@mysql_result($res2,0,'login');
$uhome=@mysql_result($res2,0,'home');
$al=@mysql_result($res2,0,'al');

if ($al!="") $uname="[".$al."] ".$uname;

if ($uhome==0) echo "<img src=pics/map_army_o.gif title='[$x:$y] \nАрмия фрименов $name \nИгрок: $uname\nранг $rang\nодержано побед: $wins' >";
if ($uhome==4) echo "<img src=pics/map_army_p.gif title='[$x:$y] \nАрмия Карину $name  \nИгрок: $uname\nранг $rang\nодержано побед: $wins' >";
if ($uhome==1) echo "<img src=pics/map_army_b.gif title='[$x:$y] \nАрмия Атрейдесов $name \nИгрок: $uname\nранг $rang\nодержано побед: $wins' >";
if ($uhome==2) echo "<img src=pics/map_army_g.gif title='[$x:$y] \nАрмия Ордосов $name \nИгрок: $uname\nранг $rang\nодержано побед: $wins' >";
if ($uhome==3) echo "<img src=pics/map_army_r.gif title='[$x:$y] \nАрмия Харконненов $name \nИгрок: $uname\nранг $rang\nодержано побед: $wins'>";

}
else
if (mysql_num_rows($resm2)>1)
{
$qname="";

for ($ii=0;$ii<mysql_num_rows($resm2);$ii++)
{

$qname.=$name=mysql_result($resm2,$ii,'name');

if ($ii!=mysql_num_rows($resm2)-1) $qname.="\n";
}

echo "<img src=pics/map_army_w.gif title='[$x:$y]\n В квадрате армии:\n$qname'>";
}



echo "</td>";
}
?></tr><?
}


?>
</table>
</td>











<td width=150>
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

if ($delta>=1500) $param="";
else
{
$param="disabled";
$text="Нельзя атаковать. Нуб.";
}

} else $param="disabled";
?>


<input type=submit name=btn value="<?=$text?>" <?=$btnparam?> <?=$param?>>

<?
$param="disabled";
$res_b=mysql_query("select * from `army` where `x`='$arm_x' and `y`='$arm_y' and `up`!='$wd_usern'");
if (@mysql_num_rows($res_b)>=1) {
	while($r=mysql_fetch_array($res_b)){
		$up=$r['up'];
		$reshome=mysql_query("select home from `wduser` where `n`='$up'");
		if(mysql_result($reshome,0,'home')!=$wd_home) $param="";
	}
}
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

</form>
<form method=post>
<?
  $param="disabled";
  $res_a=mysql_query("SELECT * FROM `base` WHERE `x`='$arm_x' and `y`='$arm_y' and `up`='$wd_usern'");
  if(intval(@mysql_num_rows($res_a))>0) {
  	if(mysql_result($res_a,0,'n')==$wd_base){
  	  $res_m=mysql_query("SELECT * FROM `move` WHERE `up`='$arm_n'");
  	  if(intval(@mysql_num_rows($res_m))==0) {
  		  $param="";
  	  }
  	}
  }
?>
<input type=hidden name=arm_x value=<?=$arm_x?>>
<input type=hidden name=arm_y value=<?=$arm_y?>>
<input type=hidden name=arm_n value=<?=$arm_n?>>
<input type=hidden name=arm_name value="<?=$arm_name?>">
<input type=submit name=btn value="Доукомплектовать" <?=$btnparam?> <?=$param?>>

<?
  $param="disabled";
  $res_a=mysql_query("SELECT * FROM `army` WHERE `x`='$arm_x' and `y`='$arm_y' and `up`='$wd_usern'");
  if(@mysql_num_rows($res_a)>1) {
  	$res_m=mysql_query("SELECT * FROM `move` WHERE `up`='$arm_n'");
  	if(@mysql_num_rows($res_m)==0) {
  		$param="";
  	}
  }
?>
<input type=submit name=btn2 value="Собрать" <?=$btnparam2?> <?=$param?>>
<?
  $param="disabled";
  if(($arm[23]+$arm[24]+$arm[25]+$arm[26]+$arm[27]+$arm[28]+$arm[29])>1) $param="";
?>
<input type=submit name=btn1 value="Разбить" <?=$btnparam2?> <?=$param?>>
</form>

</center>
</td>
<td align=left width=60 align=center>

<?
$res_b=mysql_query("select * from `move` where `up`='$arm_n'");

if (mysql_num_rows($res_b)>=1)
{
$x=mysql_result($res_b,0,'x');
$y=mysql_result($res_b,0,'y');
$dleft=mysql_result($res_b,0,'dleft');
$direct=mysql_result($res_b,0,'direct');

if ($direct==1) $alldleft=(5-$t_engine)*($y-$arm_y);
if ($direct==2) $alldleft=(5-$t_engine)*($x-$arm_x);
if ($direct==3) $alldleft=(5-$t_engine)*($arm_y-$y);
if ($direct==4) $alldleft=(5-$t_engine)*($arm_x-$x);

echo "<div id=\"marmy$arm_n\" style=\"border:0px solid #000; padding:0px\">";
echo "<table width=60 height=60 cellspacing=1 cellpadding=0 border=1 bordercolor=#e2a267>";
echo "<tr>";
echo "<td width=60 height=40>";
echo "<center>маршрут<br><b>[".$x.":".$y."]</b><br>дней <b>$dleft</b><br>всего <b>$alldleft</b></center>";
echo "</td></tr><tr><td><center>";
echo "<a href=\"javascript:movearmy(marmy$arm_n,$arm_n,0,0)\"><img src=pics/ar_st.gif border=0></a></center>";
echo "</td>";
echo "</tr>";
echo "</table></div>";
}
else
{
echo "<div id=\"marmy$arm_n\" style=\"border:0px solid #000; padding:0px\">";
$resecho="<table width=60 height=60 cellspacing=0 cellpadding=0 border=0 bordercolor=#e2a267>";
$resecho.="<tr height=20>";
$resecho.="<td width=20 height=20>&nbsp;</td>";
$resecho.="<td width=20 height=20><a href=\"javascript:movearmy(marmy$arm_n,$arm_n,document.sh$arm_n.shift.value,1)\"><img src=pics/ar_u.gif border=0></a></td>";
$resecho.="<td width=20 height=20>&nbsp;</td>";
$resecho.="</tr>";
$resecho.="<tr height=20 valign=middle>";
$resecho.="<td width=20 height=20><a href=\"javascript:movearmy(marmy$arm_n,$arm_n,document.sh$arm_n.shift.value,4)\"><img src=pics/ar_l.gif border=0></a></td>";
$resecho.="<td width=20 height=20><form name=sh$arm_n><input class=\"shift\" name=shift type=text value=1 maxlength=3></form></td>";
$resecho.="<td width=20 height=20><a href=\"javascript:movearmy(marmy$arm_n,$arm_n,document.sh$arm_n.shift.value,2)\"><img src=pics/ar_r.gif border=0></a></td>";
$resecho.="</tr>";
$resecho.="<tr height=20>";
$resecho.="<td width=20 height=20>&nbsp;</a></td>";
$resecho.="<td width=20 height=20><a href=\"javascript:movearmy(marmy$arm_n,$arm_n,document.sh$arm_n.shift.value,3)\"><img src=pics/ar_d.gif border=0></a></td>";
$resecho.="<td width=20 height=20>&nbsp;</td>";
$resecho.="</tr>";
$resecho.="</table>";
echo $resecho;
echo "</div>";
} ?>
</td>
<td width=52><?=$arm[23]?></td>
<td width=52><?=$arm[24]?></td>
<td width=52><?=$arm[25]?></td>
<td width=52><?=$arm[26]?></td>
<td width=52><?=$arm[22]?></td>
</tr>
<? } ?>

</table>
<form method=post name=data>
<input type=hidden name=shift>
<input type=hidden name=army>
<input type=hidden name=mode value=movearmy>
<input type=hidden name=direction>
</form>
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
</td></tr>

<tr><td>Тяжелая пехота</td>
<td><input name=armyhinf>
 в гарнизоне: <?=$lvl[24]?>
</td></tr>

<tr><td>Танки</td>
<td><input name=armytank>
 в гарнизоне: <?=$lvl[25]?>
</td></tr>

<tr><td>Ракетные танки</td>
<td><input name=armyrtank>
 в гарнизоне: <?=$lvl[26]?>
</td></tr>

<tr><td>Передвижные командные центры</td>
<td><input name=armymobconst>
 в гарнизоне: <?=$lvl[22]?>
</td></tr>

<tr><td>Харвестеры</td>
<td><input name=armyharv>
 в гарнизоне: <?=$lvl[21]?>
</td></tr>

<tr><td colspan=3><input type=hidden name=mode value=newarmy><input type=submit name=btn value='Создать армию'></td></tr>

</table>
</center>
</form>

<? } else echo "<br><br>Вы не можете управлять армиями в режиме отпуска.<br><br>";?>

<?

echo "<br>* Средняя стоимость войск на игрока <b>$limit</b> кредитов.";
// #########################
?>


<?
}
}
}

include "footer.php";
?>