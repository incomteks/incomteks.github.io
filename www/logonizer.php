<?
extract($_GET);
extract($_POST);
include "header.php";
if (isset($wd_usertyp) && ($wd_usertyp>=2))
{
	define('LOG_',true);
//Script by Anton Prokopenko 11.2006
$actions[]="����� � ����";										//0
$actions[]="����������� ���� �������";				//1
$actions[]="�����������������";								//2
$actions[]="����� �������������";							//3
$actions[]="������� �������������";						//4
$actions[]="�������� ���������";							//5
$actions[]="������ ���������";								//6
$actions[]="�������� � ������� ���������";		//7
$actions[]="������� ����� � ��������";				//8
$actions[]="������ �����";										//9
$actions[]="�������� �����";									//10
$actions[]="������� �����";										//11
$actions[]="�������� �����";									//12
$actions[]="����� ���������";									//13
$actions[]="����� ������������";							//14
$actions[]="������ ����";											//15
$actions[]="�������� ����";										//16
$actions[]="������ �������";									//17
$actions[]="���������� �����";								//18
$actions[]="�������� � �����";								//19
$actions[]="���� �����";											//20
$actions[]="�������� ����";										//21
$actions[]="�������� ��������� ��� �����";		//22
$actions[]="�������� ����";										//23
$actions[]="������� ������������";						//24
$actions[]="������ ����� � �������";					//25
$actions[]="������ ������� ������";						//26
$actions[]="���� � ������";										//27
$actions[]="������ ������";										//28
$actions[]="������ ���� ���";									//29
$actions[]="��������� ���� �� ���";  					//30
$actions[]="����������� �����";		  					//31
$actions[]="������ �����";		  							//32
$actions[]="��������������� �����";		 				//33
$actions[]="��������� ����";					 				//34
$actions[]="������� ��� �����";				 				//35
$actions[]="������������ ����";				 				//36
$actions[]="������ ������";						 				//37
$actions[]="��������� ������";								//38
$actions[]="������� ������";									//39
$actions[]="������� � ������ ������";					//40
$actions[]="�������� �� ������� ������";			//41
$actions[]="�������� ������";									//42
$maxact=count($actions);

$name[1]="<b>������������ ���������</b>";
$name[2]="<b>��������� �����</b>";
$name[3]="<b>�������� ���������������</b>";
$name[4]="<b>����� �� ����������� ������</b>";
$name[5]="<b>�����-�����</b>";
$name[6]="<b>�������</b>";
$name[7]="<b>������� ������� �������</b>";
$name[8]="<b>������� �����</b>";
$name[9]="<b>���������</b>";
$name[10]="<b>������</b>";
$name[11]="<b>�������� �����</b>";
$name[12]="<b>�������������� ������</b>";
$name[13]="<b>�������� ������</b>";
$name[21]="<b>���������</b>";
$name[22]="<b>��������� ��������� �����</b>";
$name[23]="<b>������ ������</b>";
$name[24]="<b>������� ������</b>";
$name[25]="<b>����</b>";
$name[26]="<b>�������� ����</b>";
$name[27]="<b>��������</b>";
$name[28]="<b>�����������</b>";
$name[29]="<b>������</b>";
$name[30]="<b>���� ������</b>";
$name[31]="<b>����������������� �������� �������</b>";

$tname[1]="<b>��������� ����������</b>";
$tname[2]="<b>��������� ����� � ������</b>";
$tname[3]="<b>������������ �� �����</b>";
$tname[4]="<b>��������� �������</b>";
$tname[5]="<b>�����-����������</b>";
$tname[6]="<b>���������� ���� ������</b>";
$tname[7]="<b>������������ ��������</b>";
$tname[8]="<b>�������</b>";

?>
<center><h1>���������� �����</h1></center>
<form method=post>
����:
<select name=day>
<?
for($i=1;$i<=31;$i++){
	if(isset($day) && $day==$i) $sel="selected"; else $sel="";
	echo "<option value='$i' ".$sel.">$i</option>";
}
?>
</select>
�����:
<select name=month>
<?
for($i=1;$i<=12;$i++){
	if(isset($month) && $month==$i) $sel="selected"; else $sel="";
	echo "<option value='$i' ".$sel.">$i</option>";
}
?>
</select>
���:
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
<input type=submit name="viewlog" value="��������">
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
		$f=fopen($fl,"r") or die("������");
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
		echo "<h3>������� $m �������, <font color=red>�������������� $attinf</font></h3>";
		fclose($f);
		if($attinf>0) echo "<input type=submit name=viewwarn value='�������� ��������������'>";
		?>
		<input type=hidden name=day value='<?=$day?>'>
		<input type=hidden name=month value='<?=$month?>'>
		<input type=hidden name=year value='<?=$year?>'>
		<input type=hidden name=fl value='<?=$fl?>'>
		<table border=1>
			<tr>
				<td colspan=2><b>��������� ��������</b></td>
				<td><b>IP</b></td>
				<td><b>�����</b></td>
				<td><b>��������</b></td>
				<td rowspan=2><input type=submit name=filterlog value='������� ������'></td>
			</tr>
			<tr>
				<td>
				  � <select name=h1>
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
				  �� <select name=h2>
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
	} else echo "���-���� $fl �� ������!";
}
if(isset($filterlog)||isset($viewwarn)){
	if(file_exists($fl)) {
		$m=0;$attinf=0;
		$f=fopen($fl,"r") or die("������");
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
					<b>�����</b>
				</td>
				<td>
					<b>IP</b>
				</td>
				<td>
					<b>������������</b>
				</td>
				<td>
					<b>��������</b>
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
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (�������������� ���������� ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="21") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (��������� ���� ".$data[0]." ������ ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="16") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (��������� ���� ".$data[0]." ������ ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="22") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (��������� ���� ".$data[0]." ������ ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="23") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (���������� ���������� ".$data[0].":".$data[1]." ���� - �����: ".$data[2].", �������: ".$data[3].", ��: ".$data[4].", ��: ".$data[5].", �����: ".$data[6].", ������: ".$data[7].", �����: ".$data[8].", ���: ".$data[9].", ���� ��������: ".$data[10].")$efnt</td>";
		  }elseif($user_action[$i]=="15") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (���������� ����� ���� ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="14") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (����������� ������: ".$tname[$data[0]].", ���� ������������: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="24") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (������� ������: ".$tname[$user_data[$i]].")$efnt</td>";
		  }elseif($user_action[$i]=="25") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (��������� ���� - ��: ".$data[0].", ��: ".$data[1].", �����: ".$data[2].", ������: ".$data[3].", �����: ".$data[4].", ���: ".$data[5].")$efnt</td>";
		  }elseif($user_action[$i]=="7") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (������: ".$name[$data[0]].", ����������: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="1") {
		  	echo "<td>$fnt".$user_data[$i]."$efnt</td>";
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (����������� �����: ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="2") {
		  	echo "<td>$fnt".$user_data[$i]."$efnt</td>";
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (��������������� �����: ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="26") {
		  	$data=explode(":",$user_data[$i]);
		  	echo "<td>$fnt".$data[0]."$efnt</td>";
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (Email �� ������� ������ ������: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="27") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (������ ��: ".$user_data[$i]." ����)$efnt</td>";
		  }elseif($user_action[$i]=="29") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (����� ���: ".$user_data[$i].")$efnt</td>";
		  }elseif($user_action[$i]=="9") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (������� ����� ".$data[6]." � ����������� - ".$data[7].":".$data[8].", � ������� - ��: ".$data[0].", ��: ".$data[1].", �����: ".$data[2].", ������: ".$data[3].", �����: ".$data[5].", ���: ".$data[4].")$efnt</td>";
		  }elseif($user_action[$i]=="8") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (���������� ���� � ������� ����� ����� - ".$data[6].":".$data[7].", ������ ����� - ��: ".$data[0].", ��: ".$data[1].", �����: ".$data[2].", ������: ".$data[3].", �����: ".$data[4].", ���: ".$data[5].")$efnt</td>";
		  }elseif($user_action[$i]=="30") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (����� ���� ".$data[0].", ���������� - ".$data[1].":".$data[2].")$efnt</td>";
		  }elseif($user_action[$i]=="31") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (����� ����� ".$data[6]." � ����������� - ".$data[7].":".$data[8].", � ������� - ��: ".$data[0].", ��: ".$data[1].", �����: ".$data[2].", ������: ".$data[3].", �����: ".$data[4].", ���: ".$data[5].")$efnt</td>";
		  }elseif($user_action[$i]=="32") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (���������� ����� ����� ".$data[12].":".$data[13].", �����1 - ��: ".$data[0].", ��: ".$data[1].", �����: ".$data[2].", ������: ".$data[3].", �����: ".$data[4].", ���: ".$data[5].", �����2 - ��: ".$data[6].", ��: ".$data[7].", �����: ".$data[8].", ������: ".$data[9].", �����: ".$data[10].", ���: ".$data[11].")$efnt</td>";
		  }elseif($user_action[$i]=="33") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (���������� - ".$data[6].":".$data[7].", ����� ������ - ��: ".$data[0].", ��: ".$data[1].", �����: ".$data[2].", ������: ".$data[3].", �����: ".$data[4].", ���: ".$data[5].")$efnt</td>";
		  }elseif($user_action[$i]=="10") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (��������� ����� ".$data[0]." ������ ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="11") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (���������� ����� ".$data[0]." ������ ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="12") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (��������� ����� ".$data[0]." ������ ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="34") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (���������� ���� ".$data[2].", ���������� - ".$data[0].":".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="36") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (������������� ���� ".$data[0].", ����� �������� - ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="3") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (�������� ������: ".$name[$data[0]].", ���� ���������: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="4") {
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (������� ������: ".$name[$user_data[$i]].")$efnt</td>";
		  }elseif($user_action[$i]=="40") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (������: ".$data[0].", ���������� �����: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="41") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (������: ".$data[0].", ����������� �����: ".$data[1].")$efnt</td>";
		  }elseif($user_action[$i]=="42") {
				$data=explode(":",$user_data[$i]);
			  echo "<td>$fnt".$actions[$user_action[$i]]."</font><font size=2> (���������� ����������: ".$user_data[$i].")$efnt</td>";
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
} else echo "<font color=red><h1>������ ��������!</h1></font>";
//include "footer.php";
?>
</td></tr>
</table>
</body>
</html>