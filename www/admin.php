<?
extract($_POST);
extract($_GET);

include "header.php";

if (isset($wd_usertyp) && ($wd_usertyp>=2))
{

//###########################################    ����� ������    ###########################################//
define('_ADM_',true);
if(isset($dosql)){
	mysql_query($sql);
	echo mysql_error();
}
if (isset($view) && ($view=="user")) {
  if (isset($mode) && ($mode=="����")){
  	echo "<table><tr><td colspan=2>";
  	$plr=intval($plr);
  	//���������� � ������
  	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`='$plr'");
  	$login=mysql_result($res,0,'login');
  	$pass=mysql_result($res,0,'password');
  	$email=mysql_result($res,0,'email');
  	$typ=mysql_result($res,0,'typ');
  	$delta=@mysql_result($res,0,'act')-@mysql_result($res,0,'reg');
    if ($delta<1000) $deft=1000-$delta; else $deft="������ �����";
  	$home=mysql_result($res,0,'home');
  	$notactiv=mysql_result($res,0,'notactiv');
  	$actcode=mysql_result($res,0,'actcode');
  	if($actcode==0) $actcode="�����������";
  	if ($home==1) $home="��������"; else if ($home==2) $home="�����";else if ($home==3) $home="���������";
  	$al=mysql_result($res,0,'al');if ($al=="") $al="---";
  	$ip=mysql_result($res,0,'ip');
  	echo "<b>������ ����������</b></td></tr>
  	<tr><td>�����</td><td>$login</td></tr>
  	<tr><td>������</td><td>$pass</td></tr>
  	<tr><td>Email</td><td>$email</td></tr>
  	<tr><td>������ ������</td><td>$typ</td></tr>
  	<tr><td>���</td><td>$home</td></tr>
  	<tr><td>������</td><td>$al</td></tr>
  	<tr><td>IP</td><td>$ip</td></tr>
  	<tr><td>���������</td><td>$notactiv</td></tr>
  	<tr><td>��� ���������</td><td>$actcode</td></tr>
  	<tr><td>������ ���. ������</td><td>$deft</td></tr>
  	<tr><td colspan=2>&nbsp;</td></tr>
  	<tr><td colspan=2><b>����</td></tr>";
  	//����
  	$res=mysql_query("SELECT * FROM `base` WHERE `up`='$plr'");
  	$max=mysql_num_rows($res);
  	if ($max>0) {
  	echo "<tr><td colspan=2><table border=1><tr><th>����.</th><th>�����.</th><th>����.</th><th>��-�</th><th>�</th><th>�</th><th>��</th><th>��</th><th>��</th><th>���</th><th>��</th><th>��</th><th>���</th><th>��</th><th>��</th><th>��</th><th>�</th><th>���</th><th>��</th><th>��</th><th>�</th><th>��</th><th>���</th><th>��</th></tr>";
  	for($i=0;$i<$max;$i++) {
  		$aname=mysql_result($res,$i,'name');
  	  $ax=mysql_result($res,$i,'x');
  	  $ay=mysql_result($res,$i,'y');
  	  $acred=mysql_result($res,$i,'cred');
  	  $astone=mysql_result($res,$i,'stone');
  	  $awall=mysql_result($res,$i,'wall');
  	  $atower=mysql_result($res,$i,'tower');
  	  $artower=mysql_result($res,$i,'rtower');
  	  $aconstr=mysql_result($res,$i,'constr');
  	  $awind=mysql_result($res,$i,'wind');
  	  $arefin=mysql_result($res,$i,'refin');
  	  $asilo=mysql_result($res,$i,'silo');
  	  $abar=mysql_result($res,$i,'bar');
  	  $afact=mysql_result($res,$i,'fact');
  	  $atech=mysql_result($res,$i,'tech');
  	  $acosmo=mysql_result($res,$i,'cosmo');
  	  $apalace=mysql_result($res,$i,'palace');
  	  $aharv=mysql_result($res,$i,'harv');
  	  $amobconst=mysql_result($res,$i,'mobconst');
  	  $alinf=mysql_result($res,$i,'linf');
  	  $ahinf=mysql_result($res,$i,'hinf');
  	  $atank=mysql_result($res,$i,'tank');
  	  $artank=mysql_result($res,$i,'rtank');
  	  $ahod=mysql_result($res,$i,'hod');
  	  $atrade=mysql_result($res,$i,'trade');
  	  echo "<tr><td>$aname</td><td>$ax:$ay</td><td>$acred</td><td>$astone</td><td>$awall</td><td>$atower</td>
  	  <td>$artower</td><td>$aconstr</td><td>$awind</td><td>$arefin</td><td>$asilo</td><td>$abar</td><td>$afact</td>
  	  <td>$atech</td><td>$acosmo</td><td>$apalace</td><td>$aharv</td><td>$amobconst</td><td>$alinf</td><td>$ahinf</td>
  	  <td>$atank</td><td>$artank</td><td>$ahod</td><td>$atrade</td></tr>";
  	}
  	echo "</table></td></tr>";
    }
  	echo"<tr><td colspan=2>&nbsp;</td></tr>
  	<tr><td colspan=2><b>�����</td></tr>";
  	//�����
  	$res=mysql_query("SELECT * FROM `army` WHERE `up`='$plr'");
  	$max=mysql_num_rows($res);
  	if ($max>0) {
  	echo "<tr><td colspan=2><table border=1><tr><th>��������</th><th>����������</th><th>����</th><th>������</th></tr>";
  	for($i=0;$i<$max;$i++) {
  		$aname=mysql_result($res,$i,'name');
  	  $ax=mysql_result($res,$i,'x');
  	  $ay=mysql_result($res,$i,'y');
  	  $awins=mysql_result($res,$i,'wins');
  	  $amob=mysql_result($res,$i,'mobconst');
  	  $alinf=mysql_result($res,$i,'linf');
  	  $ahinf=mysql_result($res,$i,'hinf');
  	  $atank=mysql_result($res,$i,'tank');
  	  $artank=mysql_result($res,$i,'rtank');
  	  $aspec1=mysql_result($res,$i,'spec1');
  	  $aspec2=mysql_result($res,$i,'spec2');
  	  $aspec3=mysql_result($res,$i,'spec3');
  	  echo "<tr><td>$aname</td><td>$ax:$ay</td><td>$awins</td><td>$alinf ��-$ahinf ��-$atank �-$artank ��-$amob ���</td></tr>";
  	}
  	echo "</table></td></tr>";
    }
  	echo "</table>";
  }
  if (isset($mode) && ($mode=="���")){
  	$plr=intval($plr);
  	$msg=htmlspecialchars($msg,ENT_NOQUOTES);
  	$dd=intval($dd);
  	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`='$plr'");
  	$resarr=mysql_fetch_array($res);
  	$ip=$resarr['ip'];
  	$res1=mysql_query("SELECT * FROM `wduser` WHERE `ip`='$ip'");
  	while($resarr1=mysql_fetch_array($res1)) {
  	  $login=$resarr1['login'];
  	  $banday=date("d.m.Y");
  	  mysql_query("INSERT INTO `banlist` (`n`,`ip`,`name`,`desc`,`days`,`banday`) VALUES ('','$ip','$login','$msg','$dd','$banday')");
    	echo mysql_error();
    	echo "����� $login ������� ������� �� $msg �� $dd �������� ����<br>";
    }
  }
  if (isset($mode) && ($mode=="����� ���")){
  	$plr=intval($plr);
  	$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  	$log=mysql_result($res,0,'login');
    $res2=mysql_query("SELECT `ip` FROM `banlist` WHERE `name`='$log'");
  	$ip=mysql_result($res2,0,'ip');
  	mysql_query("DELETE FROM `banlist` WHERE `name`='$log' or `ip`='$ip'");
  	echo "� ������ $log ������� ���� ���";
  }
  if (isset($mode) && ($mode=="�������")){
  	$plr=intval($plr);
  	$res=mysql_query("SELECT login FROM `wduser` where `n`='$plr'");
  	$login=mysql_result($res,0,'login');
  	if (!isset($contr)) {
  		echo "������������� �������� ������ $login?<br>";
  		echo "<form method=post><input type=hidden name=contr value=1><input type=hidden name=mode value=\"�������\"><input type=hidden name=plr value=$plr><input type=hidden name=view value=user><input type=submit value=\"����������!\"></form>";
  	} else {
  	  mysql_query("DELETE FROM `wduser` WHERE `n`='$plr'");
  	  mysql_query("DELETE FROM `base` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `army` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `space` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `hod` WHERE `up`='$plr'");
  	  $res=mysql_query("SELECT name FROM `al` where `up`='$plr'");
  	  if (mysql_num_rows($res)>0) {
    		$alname=mysql_result($res,0,'name');
  	    mysql_query("DELETE FROM `al` WHERE `up`='$plr'");
  	    mysql_query("UPDATE `wduser` SET `al`='' WHERE `al`='$alname'");
  	  }
  	  mysql_query("DELETE FROM `bild` WHERE `user`='$plr'");
  	  mysql_query("DELETE FROM `move` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `res` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `trade` WHERE `up`='$plr'");
  	  mysql_query("DELETE FROM `tech` WHERE `up`='$plr'");
  	  echo "����� $login ������� ������ �� ���� ������.";
  	}
  }
  if (isset($mode) && ($mode=="��������")){
  	$plr=intval($plr);
  	$res=mysql_query("SELECT * FROM `wduser` where `n`='$plr'");
  	$login=mysql_result($res,0,'login');
  	if (!isset($contr)) {
  		$pass=mysql_result($res,0,'password');
  	  $email=mysql_result($res,0,'email');
  	  $typ=mysql_result($res,0,'typ');
  	  $home=mysql_result($res,0,'home');
  	  $al=mysql_result($res,0,'al');
  	  $status=mysql_result($res,0,'status');
  	  $actcode=mysql_result($res,0,'actcode');
  	  if($actcode==0) $actcode="<input type=hidden name=actcode value=0>�����������"; else $actcode="<input type=text name=actcode value=$actcode>";
  		echo "�������� ������ ������ ������ $login<br>";
  		echo "<form method=post><input type=hidden name=contr value=1><input type=hidden name=mode value=\"��������\"><input type=hidden name=plr value=$plr><input type=hidden name=view value=user>
  		<table><tr><td>�����:</td><td><input type=text name=log value=\"$login\"><td></tr>
  		<tr><td>������</td><td><input type=text name=pass value=\"$pass\"></td></tr>
		<tr><td>����� ������</td><td><input type=text name=newpass value=\"\"></td></tr>
  		<tr><td>Email</td><td><input type=text name=email value=\"$email\"></td></tr>
  		<tr><td>������ ������</td><td><input type=text name=typ value=\"$typ\"></td></tr>
  		<tr><td>���</td><td><input type=text name=home value=\"$home\"></td></tr>
  		<tr><td>������</td><td><input type=text name=al value=\"$al\"></td></tr>
  		<tr><td>������� ������</td><td><input type=text name=status value=\"$status\"></td></tr>
  		<tr><td>��� ���������</td><td>$actcode</td></tr>
  		</table><input type=submit value=\"���������\"></form>";
  	} else {
	  if((isset($newpass)) & ($newpass!='')) $pass=md5($newpass);
  	  mysql_query("UPDATE `wduser` SET `login`='$log', `password`='$pass', `email`='$email', `typ`='$typ', `home`='$home', `al`='$al', `status`='$status', `actcode`='$actcode' WHERE `n`='$plr'");
  	  echo "������ ������ $login ������� ��������";
  	}
  }
}
if (isset($view) && ($view=="al")) {
	$al=intval($al);
  if (isset($mode) && ($mode=="�������")){
  	$res=mysql_query("SELECT * FROM `al` WHERE `n`='$al'");
  	$alname=mysql_result($res,0,'name');
    if (!isset($contr)) {
    	echo "�� ��������� ���������� ������ $alname, ����������� �����������";
    	echo "<form method=post>
    	<input type=hidden name=al value=\"$al\">
    	<input type=hidden name=view value=\"al\"><br>
			<input type=hidden name=mode value=\"�������\">
			<br><input type=submit name=contr value=\"�����������\">
			</form>";
    }
    else {
    	mysql_query("DELETE FROM `al` WHERE `n`='$al'");
    	mysql_query("UPDATE `wduser` SET `al`='' WHERE `al`='$alname'");
    	echo "������ $alname ������� ������.";
    }
  }
  if (isset($mode) && ($mode=="��������")){
  	$res=mysql_query("SELECT * FROM `al` WHERE `n`='$al'");
  	$alname=mysql_result($res,0,'name');
  	$up=mysql_result($res,0,'up');
    if (!isset($act)) {
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$up'");
  		$upname=mysql_result($res,0,'login');
  		$res=mysql_query("SELECT `n`,`login` FROM `wduser` WHERE `al`='$alname' order by `login` desc");
  		$max=mysql_num_rows($res);
  		echo "������ $alname, ����� ������� $upname<br>";
  		echo "����� �������<form method=post><select name=\"plr\">";
  		for($ii=0;$ii<$max;$ii++) {
  			$log=mysql_result($res,$ii,'login');
  			$n=mysql_result($res,$ii,'n');
  			echo "<option value=$n>$log";
  			if ($n==$up) echo " (�����)";
  			echo "</option>";
  		}
  		echo "</select><input type=hidden name=mode value=\"��������\"><input type=hidden name=al value=\"$al\"><input type=hidden name=view value=al><input type=submit name=act value=\"������� �������\"><input type=submit name=act value=\"��������� �� �������\"></form>";
  		echo "<br><form method=post><input type=hidden name=mode value=\"��������\"><input type=hidden name=al value=\"$al\"><input type=hidden name=view value=al><input type=text name=aln value=\"$alname\"><input type=submit name=act value=\"���������\"></form>";
  	} else if($act=="������� �������") {
  		  $plr=intval($plr);
  		  mysql_query("UPDATE `al` SET `up`='$plr' WHERE `n`='$al'");
  		  echo "����� ������� �������!";
  	} else if($act=="��������� �� �������") {
  		  $plr=intval($plr);
  		  if ($plr!=$up) {
  		  $res=mysql_query("SELECT login FROM `wduser` WHERE `n`='$plr'");
  		  $log=mysql_result($res,0,'login');
  		  mysql_query("UPDATE `wduser` SET `al`='' WHERE `n`='$plr'");
  		  echo "����� $log �������� �� ������� $alname!";
  		} else echo "�� �� ������ ��������� ������ �������!";
  	} else if($act=="���������") {
  		  $aln=filter($aln,"name");
  		  mysql_query("UPDATE `wduser` SET `al`='$aln' WHERE `al`='$alname'");
  		  mysql_query("UPDATE `al` SET `name`='$aln' WHERE `name`='$alname'");
  		  echo "������ $alname ������ �������� ��� $aln!";
  	}
  }
}
if (isset($view) && ($view=="news")) {
  if (isset($mode) && ($mode=="������������")){
    if (isset($index)){
    	 include("avnews.php");
    	//$file=fopen("/home/www/avnews.php","w+");
    	$txt=ereg_replace("\"","&quote;",$txt);
    	$news="<tr><td colspan=3><b>".date("d.m.Y")."</b> - ".$txt."</td></tr><tr><td colspan=3 align=right><i>".$wd_username."</i><hr></td></tr>\n".$news;
    	$file=fopen("avnews.php","w+");
    	fwrite($file,"<?php\n \$news=\"".$news."\";\n?".">");
   	fclose($file);
	mysql_query("INSERT INTO `news` (`date`,`author`,`title`,`text`,`showed`) VALUES ('".date("d.m.Y")."','$wd_username','$title','$txt','1')");
    }
    if (isset($privmes)){
    	$txt=ereg_replace("\"","&quote;",$txt);
    	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`!='$wd_usern'");
    	$max=intval(@mysql_num_rows($res));
      for($ii=0;$ii<$max;$ii++){
      	inform($wd_usern,mysql_result($res,$ii,'n'),$txt);
      }
    }
    if (isset($index) || isset($privmes)) echo "���� ������� ������� ������������"; else echo "�� �� �������, ���� ������������ �������";
  }
}
if (isset($view) && ($view=="restart")) {
  if (isset($mode) && ($mode=="�������")){
    if (isset($yes)){
    	$dt=htmlspecialchars($dt,ENT_NOQUOTES);
    	echo "������� ����� ��������: $dt";
    	mysql_query("INSERT INTO `tasks` (`n`,`name`,`parnum1`,`parnum2`,`parnum3`,`parchar1`,`parchar2`,`parchar3`) VALUES ('','restart','','','','$dt','','')");
		  mysql_query("UPDATE `day` SET `round`='$rnd'");
		  //��������� ������� ���������� � ��������
			$resu=mysql_query("SELECT * FROM `wduser`");
			while($resarr=mysql_fetch_array($resu)){
				if($resarr['sendmail']==1) {
					$login=$resarr['login'];
					$message="����������� ����� $login,\n\n �� ���� ��� ��������, ��� � ���� $dt ����� �������� �������,\n";
					$message.="� ��������� ���� ���������� ��� ������� ����� �����.\n ��� ���� ����������� ��������� � ����.\n\n";
					$message.="--\n� ��������� ������������� ���� Online DUNE2";
					$subject = "����� ������� � ����!";
					$from = "av_soft@localhost";
					$mailheaders = "Content-Type: text/plain; charset=\"1251\"\n";
					$mailheaders .= "From: dune-2.ru <av_soft@localhost>\n";
					if(!mail($resarr['email'], $subject, $message, $mailheaders)) echo "<br>������ �������� �����!";
				}
			}
    	echo mysql_error();
    } else {
    	$dt=htmlspecialchars($dt,ENT_NOQUOTES);
    	echo "�� ������������� ������ ������� �������?<br><form method=post>
    	<input type=hidden name=view value=\"restart\">
    	<input type=hidden name=mode value=\"�������\">
    	<input type=hidden name=dt value=\"$dt\">
		<input type=hidden name=rnd value=\"$rnd\">
    	<input type=submit name=yes value=\"��\">
    	</form>";
    }
  }
}
if (isset($view) && ($view=="mults")) {
  if (isset($mode) && ($mode=="�����")){
    $res=mysql_query("SELECT DISTINCT ip FROM `wduser`");
    echo "<table border=1 width=100%>";
    while($resarr=mysql_fetch_array($res)){
    	$ip=$resarr['ip'];
      $res1=mysql_query("SELECT * FROM `wduser` WHERE `ip`='$ip'");
      if(intval(@mysql_num_rows($res1))>1) {
        echo "<tr><td>$ip</td><td><table>";
        while($resarr1=mysql_fetch_array($res1)) {
      	  	$login=$resarr1['login'];
			$home=$resarr1['home'];
			if($home==0) $home="<font color=#666666>������</font>";
			if($home==1) $home="<font color=#000099>��������</font>";
			if($home==2) $home="<font color=#009900>�����</font>";
			if($home==3) $home="<font color=#990000>��������</font>";
			if($home==4) $home="<font color=#990099>������</font>";
        	$notactiv=$resarr1['notactiv'];
        	$n=$resarr1['n'];
        	echo "<tr><td width=200>�����: <a href=?view=user&mode=����&plr=$n>$login</a></td><td width=150>���������: $notactiv</td><td width=100>$home</td></tr>";
        }
        echo "</table></td></tr>";
      }
    }
  }
}
if (isset($view) && ($view=="cfg")) {
  if (isset($mode) && ($mode=="��������")){
     if(isset($cosmo_vr) && ($cosmo_vr==true)) $cfg_cosmo_vrag=1; else $cfg_cosmo_vrag=0;
  }
}
if (isset($view) && ($view=="activ")) {
  if (isset($mode) && ($mode=="��������")){
    echo "<table width=100% border=1>
    <tr><th>����� ������</th><th>���������</th></tr>";
    $notactiv=intval($notactiv);
    $res=mysql_query("SELECT * FROM `wduser` WHERE `notactiv`>$notactiv ORDER BY `notactiv` DESC");
    while($r=mysql_fetch_array($res)){
    	$login=$r['login'];
    	$notact=$r['notactiv'];
      echo "<tr><td>$login</td><td>$notact</td></tr>";
    }
    echo "</table>";
  }
}
if (isset($view) && ($view=="task")) {
  if (isset($mode) && ($mode=="del")){
  	 $task=intval($task);
     mysql_query("DELETE FROM `tasks` WHERE `n`='$task'");
     echo "������ � $task ������� �������";
  }
}
if (isset($view) && ($view=="armys")) {
  if (isset($mode) && ($mode=="������������")){
  	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`!=1");
  	while($r=mysql_fetch_array($res)){
  		$n=$r['n'];
  		$login=$r['login'];
  		$users[$n]=$login;
  	}
    echo "<hr color=red><table border=1 width=100%><tr><th>�</th><th>��������</th><th>��������</th><th>X:Y</th><th>����</th><th>������</th><th>��</th><th>��</th><th>�</th><th>��</th></tr>";

	$lpmax[]=0;
	$tpmax[]=0;
	$tmax[]=0;
	$rtmax[]=0;
    echo "<tr><td colspan=9 align=center>�����</td></tr>";
    $i=0;
    $res=mysql_query("SELECT * FROM `army` WHERE (`linf`>0 OR `hinf`>0 OR `tank`>0 OR `rtank`>0) AND `up`!=1 order by linf desc,hinf desc,tank desc,rtank desc,rang desc,wins desc");
    while($r=mysql_fetch_array($res)){
    	$i+=1;
     	$name=$r['name'];
     	$up=$r['up'];
     	$rang=$r['rang'];
     	$wins=$r['wins'];
     	$lp=$r['linf'];$lpmax[$up]=$lpmax[$up]+$lp;
     	$tp=$r['hinf'];$tpmax[$up]=$tpmax[$up]+$tp;
     	$t=$r['tank'];$tmax[$up]=$tmax[$up]+$t;
     	$rt=$r['rtank'];$rtmax[$up]=$rtmax[$up]+$rt;
		$x=$r['x'];
		$y=$r['y'];
     	$login=$users[$up];
     	echo "<tr><td>$i</td><td>$login</td><td>$name</td><td>$x:$y</td><td>$rang</td><td>$wins</td><td>$lp</td><td>$tp</td><td>$t</td><td>$rt</td></tr>";
    }

    echo "<tr><td colspan=9 align=center>���������</td></tr>";
    $i=0;
    $res=mysql_query("SELECT * FROM `base` WHERE (`linf`>0 OR `hinf`>0 OR `tank`>0 OR `rtank`>0) AND `up`!=1 order by linf desc,hinf desc,tank desc,rtank desc");
    while($r=mysql_fetch_array($res)){
    	$i+=1;
     	$name=$r['name'];
     	$up=$r['up'];
     	$lp=$r['linf'];$lpmax[$up]=$lpmax[$up]+$lp;
     	$tp=$r['hinf'];$tpmax[$up]=$tpmax[$up]+$tp;
     	$t=$r['tank'];$tmax[$up]=$tmax[$up]+$t;
     	$rt=$r['rtank'];$rtmax[$up]=$rtmax[$up]+$rt;
		$x=$r['x'];
		$y=$r['y'];
     	$login=$users[$up];
     	echo "<tr><td>$i</td><td>$login</td><td>$name</td><td>$x:$y</td><td>n/a</td><td>n/a</td><td>$lp</td><td>$tp</td><td>$t</td><td>$rt</td></tr>";
    }

	echo "<tr><td colspan=9 align=center>�����</td></tr>";
    $i=0;
    $res=mysql_query("SELECT * FROM `base` WHERE (`linf`>0 OR `hinf`>0 OR `tank`>0 OR `rtank`>0) AND `up`!=1  order by linf desc,hinf desc,tank desc,rtank desc");
    while($r=mysql_fetch_array($res)){
    	$i+=1;
     	$name=$r['name'];
     	$up=$r['up'];
     	$lp=$lpmax[$up];
     	$tp=$tpmax[$up];
     	$t=$tmax[$up];
     	$rt=$rtmax[$up];
     	$login=$users[$up];
     	echo "<tr><td>$i</td><td>$login</td><td>$name</td><td>n/a</td><td>n/a</td><td>$lp</td><td>$tp</td><td>$t</td><td>$rt</td></tr>";
    }
    echo "</table><hr color=red>";
  }
}
if (isset($view) && ($view=="fame")) {
  if (isset($mode) && ($mode=="���������")){
  	if(isset($ok) && ($ok=="��")) {
  		$plr=intval($plr);
  		$medal=intval($medal);
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  		$r=mysql_fetch_array($res);
  		$name=$r['login'];
  		$info=htmlspecialchars($info,ENT_NOQUOTES);
  		$uname=htmlspecialchars($uname,ENT_NOQUOTES);
  		if($uname!="") $name=$uname;
  		$res=mysql_query("SELECT `col` FROM `fame` WHERE `name`='$name'");
  		if(intval(@mysql_num_rows($res))>0){
  			if($medal!=9)
  		    $col=mysql_result($res,0,'col')+1;
  		  else
  		    $col=mysql_result($res,0,'col')-1;
  		}
  	  else {
  	  	if($medal!=9)
  		    $col=1;
  		  else
  		    $col=0;
  		}
  		if($col<0) $col=0;
    	if(mysql_query("INSERT INTO `fame` (`n`,`name`,`medal`,`about`,`col`) VALUES ('','$name','$medal','$info','$col')"))
    	{
    		mysql_query("UPDATE `fame` SET `col`='$col' WHERE `name`='$name'");
    	  echo "����� $name ������� ���������";
    	}
    	else
    	  echo "�������� �������� ��� �����������!";
  	} else {
  		$plr=intval($plr);
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  		$r=mysql_fetch_array($res);
  		$name=$r['login'];
  		$medal=intval($medal);
  		$res=mysql_query("SELECT `name` FROM `medales` WHERE `n`='$medal'");
  		$r=mysql_fetch_array($res);
  		$med_name=$r['name'];
  		$info=htmlspecialchars($info,ENT_NOQUOTES);
  		$uname=htmlspecialchars($uname,ENT_NOQUOTES);
  		if($uname!="") $name=$uname;
  		echo "�� �������, ��� ������ ��������� ������ $name �������: \"$med_name\", �� \"$info\"?<br>
  		<form method=post>
  		<input type=hidden name=plr value='$plr'>
  		<input type=hidden name=uname value='$uname'>
      <input type=hidden name=medal value='$medal'>
      <input type=hidden name=info value='$info'>
      <input type=hidden name=view value=\"fame\">
      <input type=hidden name=mode value=\"���������\">
      <input type=submit name=ok value=\"��\">
      </form>
  		";
  	}
  }
}
?>
<table width=100%>
<tr><td><b>��������� ������</b><hr></td></tr>
<tr><td colspan=2><form method=post><input type=text name=sql><input type=submit name=dosql value=Go></form></td></tr>
<tr><td><b>������</b><hr></td></tr>
<tr><td>
<form method=post name=uform>
<select name=plr>
<?
$res=mysql_query("select * from `wduser` order by `login`");
$max=mysql_num_rows($res);
for ($i=0;$i<$max;$i++)
{
$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'login');
$ip=mysql_result($res,$i,'ip');
$res1=mysql_query("SELECT * FROM `banlist` where `name`='$name' or `ip`='$ip'");
if (mysql_num_rows($res1)>0) $ban=" (�������)"; else $ban="";
echo "<option value=$n";
if (isset($plr) && ($plr==$n)) echo " SELECTED";
echo">$name$ban</option>";
}
?>
</select>
<script language="javascript">
function getban()
{
	s=prompt('�� ��� ���?','');
	if(s==null) s='������� �� �������';
	d=prompt('�� ������� ����?','1');
	if(d==null) d='1';
	w=window.document.uform;
	w.msg.value=s;
	w.dd.value=d;
}
</script>
<input type=hidden name=view value="user">
<input type=hidden name=msg><input type=hidden name=dd>
<input type=submit name=mode value="����"><input type=submit name=mode value="�������"><input type=submit name=mode value="��������"><input type=submit name=mode value="���" onclick="javascript:getban();"><input type=submit name=mode value="����� ���">
</form>
</td></tr>
<tr><td><b>�������</b><hr></td></tr>
<tr><td>
<form method=post>
<select name=al>
<?
$res=mysql_query("select * from `al` order by `name`");
$max=mysql_num_rows($res);
for ($i=0;$i<$max;$i++)
{
$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'name');
$up=mysql_result($res,$i,'up');
$res1=mysql_query("SELECT `login` FROM `wduser` where `n`='$up'");
$login=mysql_result($res1,0,'login');
$res1=mysql_query("SELECT * FROM `wduser` where `al`='$name'");
$max1=mysql_num_rows($res1);
echo "<option value=$n";
if (isset($al) && ($al==$n)) echo " SELECTED";
echo ">$name [$login] ($max1)</option>";
}
?>
</select>
<input type=hidden name=view value="al"><br>
<input type=submit name=mode value="��������"><input type=submit name=mode value="�������">
</form>
</td></tr>
<tr><td><b>�������</b><hr></td></tr>
<tr><td>
<form method=post>
���������: <input type=text name=title value=""><br>
����� ������� (����� ������������ HTML):<br>
<textarea name=txt rows=10 cols=100></textarea><br>
<input type=checkbox name=index checked> ���������� �� �������<br>
<input type=checkbox name=privmes> ��������� ���� �������<br>
<input type=hidden name=view value="news">
<input type=submit name=mode value="������������">
</form>
</td></tr>
<tr><td><b>�������</b><hr></td></tr>
<tr><td>
<form method=post>
<input type=hidden name=view value="restart">
���� � ����� �������� � �������: "��.��.�� - ��:��"<br>
<input type=text name=dt><br>����� ������<br>
<input type=text name=rnd>
<input type=submit name=mode value="�������">
</form>
</td></tr>
<?
$res=mysql_query("SELECT * FROM `tasks`");
if(intval(@mysql_num_rows($res))>0) {
	echo "<tr><td><b>������� ������</b><hr></td></tr><tr><td><table border=1>";
  echo "<tr><th>�</th><th>���</th><th>�����1</th><th>�����2</th><th>�����3</th><th>������1</th><th>������2</th><th>������3</th><th>������</th></tr>";
while($resarr=mysql_fetch_array($res)){
	echo "<tr><td>".$resarr['n']."</td><td>".$resarr['name']."</td><td>".$resarr['parnum1']."</td><td>".$resarr['parnum2']."</td><td>".$resarr['parnum3']."</td><td>&nbsp;".$resarr['parchar1']."</td><td>&nbsp;".$resarr['parchar2']."</td><td>&nbsp;".$resarr['parchar3']."</td><td align=center><a href=?view=task&mode=del&task=".$resarr['n'].">X</a></td></tr>";
}
  echo "</table></td></tr>";
}
?>
<tr><td><b>����� ������� � �������-��������</b><hr></td></tr>
<tr><td>
<form method=post>
<input type=hidden name=view value="mults">
<input type=submit name=mode value="�����">
</form>
</td></tr>
<tr><td><table width=100%><tr><td colspan=2><b>���������� �������</b><hr></td></tr>
<tr><td width=200>
�������� ������� ��� ������������ ������: </td><td align=left><form method=post><input type=hidden name=view value="activ"><input type=text name=notactiv value="0"> ����</td></tr>
<tr><td colspan=2><input type=submit name=mode value="��������"></form></td></tr>
</table>
</td></tr>
<tr><td><b>���������� �����</b><hr></td></tr>
<tr><td>
<form method=post>
<input type=hidden name=view value="armys">
<input type=submit name=mode value="������������">
</form>
</td></tr>
<tr><td>
<b>������ �������</b><hr><fieldset><legend>�������</legend>
<form method=post>
<table width=100%><tr><td colspan=2>�����<br><select name=plr style="width:220px">
<?
$res=mysql_query("select * from `wduser` order by `login`");
while($r=mysql_fetch_array($res)){
$n=$r['n'];
$name=$r['login'];
$ip=$r['ip'];
$res1=mysql_query("SELECT * FROM `banlist` where `name`='$name' or `ip`='$ip'");
if (mysql_num_rows($res1)>0) $ban=" (�������)"; else $ban="";
echo "<option value=$n";
if (isset($plr) && ($plr==$n)) echo " SELECTED";
echo">$name$ban</option>";
}
?>
</select><br>���� ��� � ������, ��������:<br><input type=text style="width:220px" name=uname maxlength=25><br>������<br><select style="width:220px" name=medal>
<?
$res=mysql_query("select * from `medales`");
while($r=mysql_fetch_array($res)){
$n=$r['n'];
$name=$r['name'];
echo "<option value=$n>$name</option>";
}
?>
</select> <a href=fame.php#about>?</a><br>�� ��� ������� (�� ������ ����� "��"):<br><input type=text name=info style="width:300px" maxlength=200></td>
<td><input type=hidden name=view value="fame"><input type=submit name=mode value="���������"></td></tr></table>
</form></fieldset>
</td></tr>
</table>
<?

//###########################################    ������������� ���    ###########################################//
} elseif (isset($wd_usertyp) && ($wd_usertyp==1)) {
/*  if(isset($wd_twopass)) define('_ADM_',true);
  else if(!isset($wd_twopass) && !isset($twopass)) {
		echo "<h1>����� ������ ������!</h1><br>
		<form method=post><input type=password name=twopass>
		<input type=submit value=\"�����������\"></form>
		<br>��� ��������� ������� ������ ���������� ���������� � dark_avenger'�";
		die();
	} else if(isset($twopass)){
		if(($twopass=="99doom58")&&($wd_username=="nightmind")) $_SESSION['wd_twopass']="ok";
		else if(($twopass=="51nba93")&&($wd_username=="Squaer")) $_SESSION['wd_twopass']="ok";
		else if(($twopass=="jo91ko")&&($wd_username=="ACE")) $_SESSION['wd_twopass']="ok";
		else if(($twopass=="kon666tin")&&($wd_username=="Ganima")) $_SESSION['wd_twopass']="ok";
		else {
			echo "�������� ������! ������ �����������.";
			log_("$wd_username �������� ��������� ������� ����� � �������!");
			die();
		}
	} else die();*/
if (isset($view) && ($view=="news")) {
  if (isset($mode) && ($mode=="������������")){
    if (isset($index)){
    	include("avnews.php");
    	//$file=fopen("/home/www/avnews.php","w+");
    	$txt=ereg_replace("\"","&quote;",$txt);
    	$news="<tr><td colspan=3><b>".date("d.m.Y")."</b> - ".$txt."</td></tr><tr><td colspan=3 align=right><i>".$wd_username."</i><hr></td></tr>\n".$news;
    	$file=fopen("avnews.php","w+");
    	fwrite($file,"<?php\n \$news=\"".$news."\";\n?>");
    	fclose($file);
    }
    if (isset($privmes)){
    	$txt=ereg_replace("\"","&quote;",$txt);
    	$res=mysql_query("SELECT * FROM `wduser` WHERE `n`!='$wd_usern'");
    	$max=intval(@mysql_num_rows($res));
      for($ii=0;$ii<$max;$ii++){
      	inform($wd_usern,mysql_result($res,$ii,'n'),$txt);
      }
    }
    if (isset($index) || isset($privmes)) echo "���� ������� ������� ������������"; else echo "�� �� �������, ���� ������������ �������";
  }
}
if (isset($view) && ($view=="mults")) {
  if (isset($mode) && ($mode=="�����")){
    $res=mysql_query("SELECT DISTINCT ip FROM `wduser`");
    echo "<table border=1 width=100%>";
    while($resarr=mysql_fetch_array($res)){
    	$ip=$resarr['ip'];
      $res1=mysql_query("SELECT * FROM `wduser` WHERE `ip`='$ip'");
      if(intval(@mysql_num_rows($res1))>1) {
        echo "<tr><td>$ip</td><td><table>";
        while($resarr1=mysql_fetch_array($res1)) {
      	  $login=$resarr1['login'];
        	$notactiv=$resarr1['notactiv'];
        	$n=$resarr1['n'];
        	echo "<tr><td width=200>�����: <a href=?view=user&mode=����&plr=$n>$login</a></td><td>���������: $notactiv</td></tr>";
        }
        echo "</table></td></tr>";
      }
    }
  }
}
if (isset($view) && ($view=="activ")) {
  if (isset($mode) && ($mode=="��������")){
    echo "<table width=100% border=1>
    <tr><th>����� ������</th><th>���������</th></tr>";
    $notactiv=intval($notactiv);
    $res=mysql_query("SELECT * FROM `wduser` WHERE `notactiv`>$notactiv ORDER BY `notactiv` DESC");
    while($r=mysql_fetch_array($res)){
    	$login=$r['login'];
    	$notact=$r['notactiv'];
      echo "<tr><td>$login</td><td>$notact</td></tr>";
    }
    echo "</table>";
  }
}
if (isset($view) && ($view=="fame")) {
  if (isset($mode) && ($mode=="���������")){
  	if(isset($ok) && ($ok=="��")) {
  		$plr=intval($plr);
  		$medal=intval($medal);
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  		$r=mysql_fetch_array($res);
  		$name=$r['login'];
  		$info=htmlspecialchars($info,ENT_NOQUOTES);
  		$uname=htmlspecialchars($uname,ENT_NOQUOTES);
  		if($uname!="") $name=$uname;
  		$res=mysql_query("SELECT `col` FROM `fame` WHERE `name`='$name'");
  		if(intval(@mysql_num_rows($res))>0){
  			if($medal!=9)
  		    $col=mysql_result($res,0,'col')+1;
  		  else
  		    $col=mysql_result($res,0,'col')-1;
  		}
  	  else {
  	  	if($medal!=9)
  		    $col=1;
  		  else
  		    $col=0;
  		}
  		if($col<0) $col=0;
    	if(mysql_query("INSERT INTO `fame` (`n`,`name`,`medal`,`about`,`col`) VALUES ('','$name','$medal','$info','$col')"))
    	{
    		mysql_query("UPDATE `fame` SET `col`='$col' WHERE `name`='$name'");
    	  echo "����� $name ������� ���������";
    	}
    	else
    	  echo "�������� �������� ��� �����������!";
  	} else {
  		$plr=intval($plr);
  		$res=mysql_query("SELECT `login` FROM `wduser` WHERE `n`='$plr'");
  		$r=mysql_fetch_array($res);
  		$name=$r['login'];
  		$medal=intval($medal);
  		$res=mysql_query("SELECT `name` FROM `medales` WHERE `n`='$medal'");
  		$r=mysql_fetch_array($res);
  		$med_name=$r['name'];
  		$info=htmlspecialchars($info,ENT_NOQUOTES);
  		$uname=htmlspecialchars($uname,ENT_NOQUOTES);
  		if($uname!="") $name=$uname;
  		echo "�� �������, ��� ������ ��������� ������ $name �������: \"$med_name\", �� \"$info\"?<br>
  		<form method=post>
  		<input type=hidden name=plr value='$plr'>
  		<input type=hidden name=uname value='$uname'>
      <input type=hidden name=medal value='$medal'>
      <input type=hidden name=info value='$info'>
      <input type=hidden name=view value=\"fame\">
      <input type=hidden name=mode value=\"���������\">
      <input type=submit name=ok value=\"��\">
      </form>
  		";
  	}
  }
}
?>
<table width=100%>
<tr><td><b>�������</b><hr></td></tr>
<tr><td>
����� ������� (����� ������������ HTML, �� ��� �������):
<form method=post>
<textarea name=txt rows=10 cols=100></textarea><br>
<input type=checkbox name=index checked> ���������� �� �������<br>
<input type=checkbox name=privmes> ��������� ���� �������<br>
<input type=hidden name=view value="news">
<input type=submit name=mode value="������������">
</form>
</td></tr>
<tr><td><b>����� ������� � �������-��������</b><hr></td></tr>
<tr><td>
<form method=post>
<input type=hidden name=view value="mults">
<input type=submit name=mode value="�����">
</form>
</td></tr>
<tr><td><table width=100%><tr><td colspan=2><b>���������� �������</b><hr></td></tr>
<tr><td width=200>
�������� ������� ��� ������������ ������: </td><td align=left><form method=post><input type=hidden name=view value="activ"><input type=text name=notactiv value="0"> ����</td></tr>
<tr><td colspan=2><input type=submit name=mode value="��������"></form></td></tr>
</table>
</td></tr>
<tr><td>
<b>������ �������</b><hr><fieldset><legend>�������</legend>
<form method=post>
<table width=100%><tr><td colspan=2>�����<br><select name=plr style="width:220px">
<?
$res=mysql_query("select * from `wduser` order by `login`");
while($r=mysql_fetch_array($res)){
$n=$r['n'];
$name=$r['login'];
$ip=$r['ip'];
$res1=mysql_query("SELECT * FROM `banlist` where `name`='$name' or `ip`='$ip'");
if (mysql_num_rows($res1)>0) $ban=" (�������)"; else $ban="";
echo "<option value=$n";
if (isset($plr) && ($plr==$n)) echo " SELECTED";
echo">$name$ban</option>";
}
?>
</select><br>���� ��� � ������, ��������:<br><input type=text style="width:220px" name=uname maxlength=25><br>������<br><select style="width:220px" name=medal>
<?
$res=mysql_query("select * from `medales`");
while($r=mysql_fetch_array($res)){
$n=$r['n'];
$name=$r['name'];
echo "<option value=$n>$name</option>";
}
?>
</select> <a href=fame.php#about>?</a><br>�� ��� ������� (�� ������ ����� "��"):<br><input type=text name=info style="width:300px" maxlength=200></td>
<td><input type=hidden name=view value="fame"><input type=submit name=mode value="���������"></td></tr></table>
</form></fieldset>
</td></tr>
</table>
<?
} else echo "<font color=red><h1>������ ��������!</h1></font>";
include "footer.php";
?>