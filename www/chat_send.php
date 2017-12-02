<?
extract($_GET);
extract($_POST);
include "connect.php";
include "av_func.php";
if (isset($wd_usertyp) && ($wd_usertyp>0))
{
	if(isset($ok)) {
		$msg=filter($msg,"message");
		$to=intval($to);
		$wd_chatcol=$textcol;
		mysql_query("UPDATE `wduser` SET `color`='$wd_chatcol' WHERE `n`='$wd_usern'");
		$wd_chatnick=$to;
		$textcol=intval($textcol)-1;
		if($to!=0) {
			$res=mysql_query("SELECT * FROM `wduser` WHERE `n`='$to'");
			if(@mysql_num_rows($res)>0)
				$toname=mysql_result($res,0,'login');
		} else $toname="Всем";
		$tm=date("H.i.s");
		$font="#000000";
		if($textcol==0) $font="#444444";
	    if($textcol==1) $font="#777777";
	    if($textcol==2) $font="#aaaaaa";
	    if($textcol==3) $font="#880000";
		if($textcol==4) $font="#aa0000";
		if($textcol==5) $font="#aa0055";
		if($textcol==6) $font="#bb6677";
		if($textcol==7) $font="#aa5500";
		if($textcol==8) $font="#bb7722";
		if($textcol==9) $font="#aa9900";
		if($textcol==10) $font="#aa9955";
		if($textcol==11) $font="#667700";
		if($textcol==12) $font="#006600";
		if($textcol==13) $font="#006655";
		if($textcol==14) $font="#337733";
		if($textcol==15) $font="#009900";
		if($textcol==16) $font="#559955";
		if($textcol==17) $font="#669988";
		if($textcol==18) $font="#5599aa";
		if($textcol==19) $font="#0088aa";
		if($textcol==20) $font="#0055aa";
		if($textcol==21) $font="#000099";
		if($textcol==22) $font="#0000bb";
		if($textcol==23) $font="#5500aa";
		if($textcol==24) $font="#665588";
		if($textcol==25) $font="#aa55aa";
		if($textcol==26) $font="#772277";
		mysql_query("INSERT INTO `chat` VALUES ('','$wd_username','$toname','$msg','$tm','$font')");		
	}
	echo "<html><head>
	<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\"></head><body>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">";
	echo "<hr><form name=send method=post><table width=100% border=0 valign=middle>";
	if(isset($to)){if(isset($scr)) $scr="checked"; else $scr="";} else $scr="checked";
	?>
	<tr><td valign=middle>Кому:</td><td valign=middle>Сообщение:</td><td valign=middle>Скроллинг: <input type="checkbox" name="scr" <?=$scr?> title="Скроллировать страничку"></td></tr>
	<tr><td valign=middle><select style="width:140px" name=to>
	<?
	echo "<option value=0>Всем</option>";
	$res=mysql_query("SELECT * FROM `wduser` WHERE `typ`>0 and `notactiv`<30");
	while($r=@mysql_fetch_array($res)){
		if(isset($wd_chatnick) && $wd_chatnick==$r['n']) $sel=" SELECTED"; else $sel="";
		echo "<option value=".$r['n']."$sel>".$r['login']."</option>";
	}
	?>
	</select></td><td valign=middle><input type=text name=msg style="width:380px" maxlength=200><script>send.msg.focus();</script>&nbsp;<input type=submit name=ok value='Отправить'></td><td valign=middle></td>
</tr>
	<tr><td valign=middle>
	Цвет: <select name=textcol size=1 style='color:#00000'>
	<option value=0 style='background:#000000' <? if(!isset($wd_chatcol) || $wd_chatcol==0) echo "SELECTED"; ?>>#000000
	<option value=1 style='background:#444444'<? if(isset($wd_chatcol) && $wd_chatcol==1) echo "SELECTED"; ?>>#444444
	<option value=2 style='background:#777777' <? if(isset($wd_chatcol) && $wd_chatcol==2) echo "SELECTED"; ?>>#777777
	<option value=3 style='background:#aaaaaa' <? if(isset($wd_chatcol) && $wd_chatcol==3) echo "SELECTED"; ?>>#aaaaaa
	<option value=4 style='background:#880000' <? if(isset($wd_chatcol) && $wd_chatcol==4) echo "SELECTED"; ?>>#880000
	<option value=5 style='background:#aa0000' <? if(isset($wd_chatcol) && $wd_chatcol==5) echo "SELECTED"; ?>>#aa0000
	<option value=6 style='background:#aa0055' <? if(isset($wd_chatcol) && $wd_chatcol==6) echo "SELECTED"; ?>>#aa0055
	<option value=7 style='background:#bb6677' <? if(isset($wd_chatcol) && $wd_chatcol==7) echo "SELECTED"; ?>>#bb6677
	<option value=8 style='background:#aa5500' <? if(isset($wd_chatcol) && $wd_chatcol==8) echo "SELECTED"; ?>>#aa5500
	<option value=9 style='background:#bb7722' <? if(isset($wd_chatcol) && $wd_chatcol==9) echo "SELECTED"; ?>>#bb7722
	<option value=10 style='background:#aa9900' <? if(isset($wd_chatcol) && $wd_chatcol==10) echo "SELECTED"; ?>>#aa9900
	<option value=11 style='background:#aa9955' <? if(isset($wd_chatcol) && $wd_chatcol==11) echo "SELECTED"; ?>>#aa9955
	<option value=12 style='background:#667700' <? if(isset($wd_chatcol) && $wd_chatcol==12) echo "SELECTED"; ?>>#667700
	<option value=13 style='background:#006600' <? if(isset($wd_chatcol) && $wd_chatcol==13) echo "SELECTED"; ?>>#006600
	<option value=14 style='background:#006655' <? if(isset($wd_chatcol) && $wd_chatcol==14) echo "SELECTED"; ?>>#006655
	<option value=15 style='background:#337733' <? if(isset($wd_chatcol) && $wd_chatcol==15) echo "SELECTED"; ?>>#337733
	<option value=16 style='background:#009900' <? if(isset($wd_chatcol) && $wd_chatcol==16) echo "SELECTED"; ?>>#009900
	<option value=17 style='background:#559955' <? if(isset($wd_chatcol) && $wd_chatcol==17) echo "SELECTED"; ?>>#559955
	<option value=18 style='background:#669988' <? if(isset($wd_chatcol) && $wd_chatcol==18) echo "SELECTED"; ?>>#669988
	<option value=19 style='background:#5599aa' <? if(isset($wd_chatcol) && $wd_chatcol==19) echo "SELECTED"; ?>>#5599aa
	<option value=20 style='background:#0088aa' <? if(isset($wd_chatcol) && $wd_chatcol==20) echo "SELECTED"; ?>>#0088aa
	<option value=21 style='background:#0055aa' <? if(isset($wd_chatcol) && $wd_chatcol==21) echo "SELECTED"; ?>>#0055aa
	<option value=22 style='background:#000099' <? if(isset($wd_chatcol) && $wd_chatcol==22) echo "SELECTED"; ?>>#000099
	<option value=23 style='background:#0000bb' <? if(isset($wd_chatcol) && $wd_chatcol==23) echo "SELECTED"; ?>>#0000bb
	<option value=24 style='background:#5500aa' <? if(isset($wd_chatcol) && $wd_chatcol==24) echo "SELECTED"; ?>>#5500aa
	<option value=25 style='background:#665588' <? if(isset($wd_chatcol) && $wd_chatcol==25) echo "SELECTED"; ?>>#665588
	<option value=26 style='background:#aa55aa' <? if(isset($wd_chatcol) && $wd_chatcol==26) echo "SELECTED"; ?>>#aa55aa
	<option value=27 style='background:#772277' <? if(isset($wd_chatcol) && $wd_chatcol==27) echo "SELECTED"; ?>>#772277
	</select></td><td></td></tr>
	</table></form></body></html>
<?
} else echo "<h1>Доступ запрещен</h1>";
?>