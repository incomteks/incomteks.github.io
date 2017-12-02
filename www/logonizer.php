<?
extract($_GET);
extract($_POST);
include "header.php";
if (isset($wd_usertyp) && ($wd_usertyp>=2))
{
	define('LOG_',true);
//Script by Anton Prokopenko 11.2006
$actions[]="Вошел в игру";										//0
$actions[]="Активировал свой аккаунт";				//1
$actions[]="Зарегистрировался";								//2
$actions[]="Начал строительство";							//3
$actions[]="Отменил строительство";						//4
$actions[]="Отправил сообщение";							//5
$actions[]="Удалил сообщение";								//6
$actions[]="Поставил в очередь постройки";		//7
$actions[]="Перевел армию в гарнизон";				//8
$actions[]="Создал армию";										//9
$actions[]="Атаковал армию";									//10
$actions[]="Победил армию";										//11
$actions[]="Проиграл армии";									//12
$actions[]="Армии разошлись";									//13
$actions[]="Начал исследование";							//14
$actions[]="Создал базу";											//15
$actions[]="Захватил базу";										//16
$actions[]="Провел шпионаж";									//17
$actions[]="Просмотрел карту";								//18
$actions[]="Поставил в игнор";								//19
$actions[]="Снял игнор";											//20
$actions[]="Атаковал базу";										//21
$actions[]="Потерпел поражение при атаке";		//22
$actions[]="Отправил груз";										//23
$actions[]="Отменил исследование";						//24
$actions[]="Сделал заказ в гильдии";					//25
$actions[]="Выслан забытый пароль";						//26
$actions[]="Ушел в отпуск";										//27
$actions[]="Сменил пароль";										//28
$actions[]="Сменил свой дом";									//29
$actions[]="Развернул базу из МКЦ";  					//30
$actions[]="Сгруппирвал армии";		  					//31
$actions[]="Разбил армии";		  							//32
$actions[]="Доукомплектовал армию";		 				//33
$actions[]="Уничтожил базу";					 				//34
$actions[]="Потерял все армии";				 				//35
$actions[]="Переименовал базу";				 				//36
$actions[]="Создал альянс";						 				//37
$actions[]="Уничтожил альянс";								//38
$actions[]="Покинул альянс";									//39
$actions[]="Включил в альянс игрока";					//40
$actions[]="Исключил из альянса игрока";			//41
$actions[]="Запустил ракету";									//42
$maxact=count($actions);

$name[1]="<b>Строительный фундамент</b>";
$name[2]="<b>Командный центр</b>";
$name[3]="<b>Ветряная энергоустановка</b>";
$name[4]="<b>Завод по переработке спайса</b>";
$name[5]="<b>Спайс-силос</b>";
$name[6]="<b>Казармы</b>";
$name[7]="<b>Фабрика тяжелой техники</b>";
$name[8]="<b>Научный центр</b>";
$name[9]="<b>Космопорт</b>";
$name[10]="<b>Дворец</b>";
$name[11]="<b>Защитная стена</b>";
$name[12]="<b>Оборонительные турели</b>";
$name[13]="<b>Ракетные турели</b>";
$name[21]="<b>Харвестер</b>";
$name[22]="<b>Мобильный Командный Центр</b>";
$name[23]="<b>Легкая пехота</b>";
$name[24]="<b>Тяжелая пехота</b>";
$name[25]="<b>Танк</b>";
$name[26]="<b>Ракетный танк</b>";
$name[27]="<b>Сардукар</b>";
$name[28]="<b>Разрушитель</b>";
$name[29]="<b>Фримен</b>";
$name[30]="<b>Рука смерти</b>";
$name[31]="<b>Представительство Торговой Гильдии</b>";

$tname[1]="<b>Улучшение вооружения</b>";
$tname[2]="<b>Улучшение брони и защиты</b>";
$tname[3]="<b>Передвижение по песку</b>";
$tname[4]="<b>Обработка гранита</b>";
$tname[5]="<b>Спайс-контейнеры</b>";
$tname[6]="<b>Боеголовка Рука Смерти</b>";
$tname[7]="<b>Межпланетная торговля</b>";
$tname[8]="<b>Шпионаж</b>";

?>
<center><h1>Анализатор логов</h1></center>
<form method=post>
День:
<select name=day>
<?
for($i=1;$i<=31;$i++){
	if(isset($day) && $day==$i) $sel="selected"; else $sel="";
	echo "<option value='$i' ".$sel.">$i</option>";
}
?>
</select>
Месяц:
<select name=month>
<?
for($i=1;$i<=12;$i++){
	if(isset($month) && $month==$i) $sel="selected"; else $sel="";
	echo "<option value='$i' ".$sel.">$i</option>";
}
?>
</select>
Год:
<select name=year>
<?
	if(isset($year) && $year==1) $sel="selected"; else $sel="";
	echo "<option value='1' ".$sel.">2006</option>";

    if(isset($year) && $year==2) $sel="selected"; else $sel="";
	echo "<option value='2' ".$sel.">2007</option>";

    if(isset($year) && $year==3) $sel="selected"; else $sel="";
	echo "<option value='3' ".$sel.">2008</option>";

    if(isset($year) && $year==4) $sel="selected"; else $sel="";
	echo "<option value='4' ".$sel.">2009</option>";

    if(isset($year) && $year==5) $sel="selected"; else $sel="";
	echo "<option value='5' ".$sel.">2010</option>";

    if(isset($year) && $year==6) $sel="selected"; else $sel="";
	echo "<option value='6' ".$sel.">2011</option>";
?>
</select>
<input type=submit name="viewlog" value="Смотреть">
</form><hr>
<?
if(isset($viewlog)){
	if($day<10) $day="0".$day;
	if($month<10) $month="0".$month;
	if($year==1) {
		$yearn="2006";
	}elseif($year==2) {
		$yearn="2007";
	}elseif($year==3) {
		$yearn="2008";
	}elseif($year==4) {
		$yearn="2009";
	}elseif($year==5) {
		$yearn="2010";
	}elseif($year==6) {
		$yearn="2011";
	}
	$fl="log/".$day.".".$month.".".$yearn.".log";
	if(file_exists($fl)) {
		$m=0;$attinf=0;
		$f=fopen($fl,"r") or die("Ошибка");
		for($i=0; $data=fgetcsv($f, 1000, ","); $i++) {
  		$num = count($data);
  		if($num==1 && $data[0]==="") continue;
  		if(!isset($data[1])) continue;
  		$user_time[]=$data[0];
  		if(!isset($user_ip)) $user_ip[]=$data[1]; else if(!in_array($data[1],$user_ip)) $user_ip[]=$data[1];
  		if(!isset($user_n)) $user_n[]=$data[2]; else if(!in_array($data[2],$user_n)) $user_n[]=$data[2];
  		if(!isset($user_login)) $user_login[]=$data[3]; else if(!in_array($data[3],$user_login)) $user_login[]=$data[3];
  		$user_action[]=$data[4];
  		$user_data[]=$data[5];
  		$user_url[]=$data[6];
  		$user_loginf[]=$data[7];
  		if($data[7]=="1") $attinf++;
  		$m++;
		}
		echo "<form method=post>";
		echo "<h3>Найдено $m записей, <font color=red>подозрительных $attinf</font></h3>";
		fclose($f);
		if($attinf>0) echo "<input type=submit name=viewwarn value='Смотреть подозрительные'>";
		?>
		<input type=hidden name=day value='<?=$day?>'>
		<input type=hidden name=month value='<?=$month?>'>
		<input type=hidden name=year value='<?=$year?>'>
		<input type=hidden name=fl value='<?=$fl?>'>
		<table border=1>
			<tr>
				<td colspan=2><b>Временной интервал</b></td>
				<td><b>IP</b></td>
				<td><b>Логин</b></td>
				<td><b>Действие</b></td>
				<td rowspan=2><input type=submit name=filterlog value='Выбрать данные'></td>
			</tr>
			<tr>
				<td>
				  С <select name=h1>
					<?					
					for($i=0;$i<=23;$i++){
						if($i<10) $i="0".$i;
						if($i=='00') $sel="selected"; else $sel="";
						echo "<option value='$i' ".$sel.">$i</option>";
					}
					?>
					</select>
					: <select name=m1>
					<?					
					for($i=0;$i<=59;$i++){
						if($i<10) $i="0".$i;
						if($i=='00') $sel="selected"; else $sel="";
						echo "<option value='$i' ".$sel.">$i</option>";
					}
					?>
					</select>
				</td>
				<td>
				  ПО <select name=h2>
					<?					
					for($i=0;$i<=23;$i++){
						if($i<10) $i="0".$i;
						if($i=='23') $sel="selected"; else $sel="";
						echo "<option value='$i' ".$sel.">$i</option>";
					}
					?>
					</select>
					: <select name=m2>
					<?					
					for($i=0;$i<=59;$i++){
						if($i<10) $i="0".$i;
						if($i=='59') $sel="selected"; else $sel="";
						echo "<option value='$i' ".$sel.">$i</option>";
					}
					?>
					</select>
				</td>
				<td>
				  <select name=ip_log>
				  <option value='*' selected>*</option>
					<?
sort($user_ip);
					for($i=0;$i<count($user_ip);$i++){
						if($user_ip[$i]!="")
						  echo "<option value='".$user_ip[$i]."'>".$user_ip[$i]."</option>";
					}
					?>
					</select>
				</td>
				<td>
				  <select name=userlogin>
				  <option value='*'>*</option>
					<?					
					for($i=0;$i<count($user_login);$i++){
						if($user_login[$i]!="")
						  echo "<option value='".$user_login[$i]."'>".$user_login[$i]."</option>";
					}
					?>
					</select>
				</td>
				<td>
				  <select name=useraction>
				  <option value='*'>*</option>
				  <?
					for($i=0;$i<$maxact;$i++) echo "<option value='".$i."'>".$actions[$i]."</option>";
					?>
					</select>
				</td>
			</tr>
		</table>
		</form>
		<?
	} else echo "Лог-файл $fl не найден!";
}
if(isset($filterlog)||isset($viewwarn)){
	if(file_exists($fl)) {
		$m=0;$attinf=0;
		$f=fopen($fl,"r") or die("Ошибка");
		for($i=0; $data=fgetcsv($f, 1000, ","); $i++) {
  		$num = count($data);
  		if($num==1 && $data[0]==="") continue;
  		if(isset($viewwarn) && $data[7]!="1") continue;
  		$currtime=strtotime($data[0]);
  		$starttime=mktime($h1,$m1,"00");
  		$endtime=mktime($h2,$m2,"59");
  		if(($currtime<$starttime) || ($currtime>$endtime)) continue;
  		if(($ip_log!="*") && ($ip_log!=$data[1])) continue;
  		if(($userlogin!="*") && ($userlogin!=$data[3])) continue;
  		if(($useraction!="*") && ($useraction!=$data[4])) continue;
  		$user_time[]=$data[0];
  		$user_ip[]=$data[1];
  		$user_n[]=$data[2];
  		$user_login[]=$data[3];
  		$user_action[]=$data[4];
  		$user_data[]=$data[5];
  		$user_url[]=$data[6];
  		$user_loginf[]=$data[7];
  		if($data[7]=="1") $attinf++;
  		$m++;
		}
		?>
		<table border=1>
			<tr>
				<td>
					<b>Время</b>
				</td>
				<td>
					<b>IP</b>
				</td>
				<td>
					<b>Пользователь</b>
				</td>
				<td>
					<b>Действие</b>
				</td>
				<td>
					<b>URL</b>
				</td>
			</tr>
		<?
		for($i=0;$i<$m;$i++){
			$fnt="<font size=2 color=blue>";$efnt="</font>";
			if($user_loginf[$i]=="1") {$fnt="<font color=red><b>";$efnt="</font></b>";}
			echo "<tr><td><font size=2>".$user_time[$i]."$efnt</td>";
			echo "<td><font size=2>".$user_ip[$i]."$efnt</td>";
			if($user_action[$i]!="1"&&$user_action[$i]!="2"&&$user_action[$i]!="26") {
			  echo "<td><font size=2>".$user_login[$i]."$efnt</td>";
		  }
			if($user_action[$i]=="17") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (просканированы координаты ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="21") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (атакована база ".$data[0]." игрока ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="16") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (захвачена база ".$data[0]." игрока ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="22") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (атакована база ".$data[0]." игрока ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="23") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (координаты назначения ".$data[0].":".$data[1]." груз - Камни: ".$data[2].", Кредиты: ".$data[3].", ЛП: ".$data[4].", ТП: ".$data[5].", Танки: ".$data[6].", РТанки: ".$data[7].", Харвы: ".$data[8].", МКЦ: ".$data[9].", срок доставки: ".$data[10].")$efnt</td>";
		  }elseif($user_action[$i]=="15") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (координаты новой базы ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="14") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (исследуется объект: ".$tname[$data[0]].", срок исследования: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="24") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (отменен объект: ".$tname[$user_data[$i]].")$efnt</td>";
		  }elseif($user_action[$i]=="25") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (заказнный груз - ЛП: ".$data[0].", ТП: ".$data[1].", Танки: ".$data[2].", РТанки: ".$data[3].", Харвы: ".$data[4].", МКЦ: ".$data[5].")$efnt</td>";
		  }elseif($user_action[$i]=="7") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (объект: ".$name[$data[0]].", количество: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="1") {
		  	echo "<td>$fnt".$user_data[$i]."$efnt</td>";
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (Активирован логин: ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="2") {
		  	echo "<td>$fnt".$user_data[$i]."$efnt</td>";
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (Зарегистрирован логин: ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="26") {
		  	$data=explode(":",$user_data[$i]);
		  	echo "<td>$fnt".$data[0]."$efnt</td>";
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (Email на который выслан пароль: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="27") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (отпуск на: ".$user_data[$i]." дней)$efnt</td>";
		  }elseif($user_action[$i]=="29") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (новый дом: ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="9") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (создана армия ".$data[6]." в координатах - ".$data[7].":".$data[8].", в составе - ЛП: ".$data[0].", ТП: ".$data[1].", Танки: ".$data[2].", РТанки: ".$data[3].", Харвы: ".$data[5].", МКЦ: ".$data[4].")$efnt</td>";
		  }elseif($user_action[$i]=="8") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (координаты базы в которую вошла армия - ".$data[6].":".$data[7].", состав армии - ЛП: ".$data[0].", ТП: ".$data[1].", Танки: ".$data[2].", РТанки: ".$data[3].", Харвы: ".$data[4].", МКЦ: ".$data[5].")$efnt</td>";
		  }elseif($user_action[$i]=="30") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (новая база ".$data[0].", координаты - ".$data[1].":".$data[2].")$efnt</td>";
		  }elseif($user_action[$i]=="31") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (новая армия ".$data[6]." в координатах - ".$data[7].":".$data[8].", в составе - ЛП: ".$data[0].", ТП: ".$data[1].", Танки: ".$data[2].", РТанки: ".$data[3].", Харвы: ".$data[4].", МКЦ: ".$data[5].")$efnt</td>";
		  }elseif($user_action[$i]=="32") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (координаты новых армий ".$data[12].":".$data[13].", армия1 - ЛП: ".$data[0].", ТП: ".$data[1].", Танки: ".$data[2].", РТанки: ".$data[3].", Харвы: ".$data[4].", МКЦ: ".$data[5].", армия2 - ЛП: ".$data[6].", ТП: ".$data[7].", Танки: ".$data[8].", РТанки: ".$data[9].", Харвы: ".$data[10].", МКЦ: ".$data[11].")$efnt</td>";
		  }elseif($user_action[$i]=="33") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (координаты - ".$data[6].":".$data[7].", новый состав - ЛП: ".$data[0].", ТП: ".$data[1].", Танки: ".$data[2].", РТанки: ".$data[3].", Харвы: ".$data[4].", МКЦ: ".$data[5].")$efnt</td>";
		  }elseif($user_action[$i]=="10") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (атакована армия ".$data[0]." игрока ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="11") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (уничтожена армия ".$data[0]." игрока ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="12") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (атакована армия ".$data[0]." игрока ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="34") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (уничтожена база ".$data[2].", координаты - ".$data[0].":".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="36") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (переименована база ".$data[0].", новое название - ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="3") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (строется объект: ".$name[$data[0]].", срок постройки: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="4") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (отменен объект: ".$name[$user_data[$i]].")$efnt</td>";
		  }elseif($user_action[$i]=="40") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (альянс: ".$data[0].", включенный игрок: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="41") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (альянс: ".$data[0].", исключенный игрок: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="42") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (координаты назначения: ".$user_data[$i].")$efnt</td>";
		  }
		  else
		    echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2>(".$user_data[$i].")$efnt</td>";
			echo "<td><font size=2>".$user_url[$i]."$efnt</td></tr>";
		}  
		?>
		</table>
		<?
	}
}
} else echo "<font color=red><h1>Доступ запрещен!</h1></font>";
//include "footer.php";
?>
</td></tr>
</table>
</body>
</html>