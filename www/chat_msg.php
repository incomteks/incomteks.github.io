<?
extract($_POST);
extract($_GET);
include "connect.php";
if (isset($wd_usertyp) && ($wd_usertyp>0))
{
	echo "<html><head><META HTTP-EQUIV=Refresh CONTENT=\"10; URL=chat_msg.php\">
	<META HTTP-EQUIV=\"PRAGMA\" CONTENT=\"no-cache\">
	<link rel=\"stylesheet\" href=\"style.css\" type=\"text/css\">
	<script>
			function scrollmes() {
			scroll(1,10000000);
			clearTimeout(parent.timerid);
		}
	</script>
	</head><body>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">";
	echo "<table width=100% border=0>";
	$res=mysql_query("SELECT count(*) FROM `chat`");
	$max=mysql_result($res,0,'count(*)');
	$min=$max-50;
	if($min<0) $min=0;
	$res=mysql_query("SELECT * FROM `chat` ORDER BY `n` LIMIT $min,$max");
	while($r=@mysql_fetch_array($res)){
		$n=$r['n'];
		$time=$r['time'];
		$from=$r['from'];
		$color=$r['color'];
		$to=$r['to'];
		if($to!="") $to="$to, ";
		$msg=$r['msg'];
		echo "<tr><td><font color=#FFFFFF>[$time]</font><font color=$color>$from:$to$msg</font></td></tr>";
	}
	echo "<tr><td><script language=\"javascript\">if(parent.sendmsg.send.scr.checked) {parent.timerid=setInterval('scrollmes()',100);}</script></td></tr>";
	$wall=$n-100;
	mysql_query("DELETE FROM `chat` WHERE `n`<'$wall'");
	echo "</table></body></html>";
} else echo "<h1>Доступ запрещен</h1>";
?>