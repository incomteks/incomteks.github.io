<?
$a=$_SERVER['SCRIPT_NAME'];
extract($_GET);
extract($_POST);

if (isset($wd_loginform_key) && ($wd_loginform_key=="exit"))
{
session_unset();

unset($_SESSION['wd_usern']);
unset($wd_usern);

unset($_SESSION['wd_username']);
unset($wd_username);

unset($_SESSION['wd_usertyp']);
unset($wd_usertyp);

unset($_SESSION['wd_base']);
unset($wd_base);

unset($_SESSION['wd_home']);
unset($wd_home);

unset($_SESSION['wd_inplay']);
unset($wd_inplay);

unset($_SESSION['wd_chatcol']);
unset($wd_chatcol);

unset($_SESSION['wd_usern']);
unset($wd_usern);

unset($_SESSION['wd_usern']);
unset($wd_usern);

unset($_SESSION['wd_maxmess']);
unset($wd_maxmess);

unset($_SESSION['wd_twopass']);
unset($wd_twopass);

}

// ###################################################### 
if(isset($activeme)) {
	$stop="";
	$activeme = htmlspecialchars($activeme,ENT_NOQUOTES);
  if ((!$activeme) || ($activeme=="") || (ereg("[^a-zA-Z0-9А-Яа-я=_-]",$activeme))) $stop = "Недопустимые символы в имени.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
  if (strlen($activeme) > 25) $stop = "Слишком длинное имя.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
  if (strrpos($activeme,' ') > 0) "В имени нельзя использовать пробелы.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
  if (eregi("^((Emperor)|(emperror)|(root)|(admin)|(administrator)|(administrador)|(nobody)|(anonymous)|(anonimo)|(anуnimo)|(operator))$",$activeme)) $stop = "Это имя зарезервировано.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
  if($stop=="") {
  	if(!isset($btn)){
  		echo "<center><form method=post><table>
  		<tr><td>Логин:</td><td><input type=text name=activeme value=\"$activeme\"></td></tr>
  		<tr><td>Код активации:</td><td><input type=text name=actcode></td></tr>
  		<tr><td colspan=2 align=center><input type=submit name=btn value=\"Активировать\"></form></td></tr>
  		</table>"; 
	    exit;
	  }
	  else {
	  	$res=mysql_query("SELECT `actcode` FROM `wduser` WHERE `login`='$activeme'");
	  	if(intval(@mysql_num_rows($res))>0){
	    if(mysql_result($res,0,'actcode')==$actcode) {
	    	mysql_query("UPDATE `wduser` SET `actcode`='0' WHERE `login`='$activeme'");
        echo "Технологическое дерево построено.";
        echo "<br><a href=$a>Войти</a>";
        log_(1,$activeme);
        die();
      } else {
      	echo "Неверный код активации!";
      	die();
      }
    }else { echo "Такого пользователя нет в базе!"; die(); }
    }
  }
}
if (isset($wd_loginform_key) and ($wd_loginform_key=="register"))
{
if (!isset($btn) || ($btn!="Register"))
{
?>
<script language=javascript>
var g_wndCheck = null;
function check()
{
  var pw = 252;
  var ph = 195;
  var l = screen.width/2-pw/2;
  var t = screen.height/2-ph/2;
  if(g_wndCheck) g_wndCheck.close();
  var x = reg.cc_x.value;
  var y = reg.cc_y.value;
  g_wndCheck = window.open('check_xy.php?x='+x+'&y='+y, '', 'fullscreen=no, titlebar=no, scrollbars=auto, width='+pw+', height='+ph+', left='+l+', top='+t, true);
}
function getRandom(max) {return (Math.floor(Math.random()*max))+1;}
function home()
{
  if(reg.home.value==1){
  	var x=getRandom(15);
  	var y=getRandom(15);
  	var znakx=getRandom(2);
  	var znaky=getRandom(2);
  	var maxx=<?=$dune_x?>;
  	var maxy=<?=$dune_y?>;
  	if(znakx==2) x=-x;
  	if(znaky==2) y=-y;
  	x=maxx-15+x;
  	y=maxy-15+y;
  }
  if(reg.home.value==2){
  	var x=getRandom(15);
  	var y=getRandom(15);
  	var znakx=getRandom(2);
  	var znaky=getRandom(2);
  	var maxx=<?=$dune_x?>;
  	var maxy=<?=$dune_y?>;
  	if(znakx==2) x=-x;
  	if(znaky==2) y=-y;
  	x=maxx/2+x;
  	if(y<-14) y=-14;
  	y=15+y;
  }
  if(reg.home.value==3){
  	var x=getRandom(15);
  	var y=getRandom(15);
  	var znakx=getRandom(2);
  	var znaky=getRandom(2);
  	var maxx=<?=$dune_x?>;
  	var maxy=<?=$dune_y?>;
  	if(znakx==2) x=-x;
  	if(znaky==2) y=-y;
  	if(x<-14) x=-14;
  	x=15+x;
  	y=maxy-15+y;
  }
  reg.cc_x.value=x;
  reg.cc_y.value=y;
}
</script>
<b>Новый пользователь</b><br>
<form action='<?=$a?>' method=post name=reg>
<table>
<tr><td>Имя (логин):</td><td><input name=log></td></tr>
<tr><td>Дом:</td><td><select name=home onchange="javascript:home()">
<option value=1>дом Атрейдесов</option>
<option value=2>дом Ордосов</option>
<option value=3>дом Харконненов</option>
</select>
</td></tr>
<tr><td>e-mail:</td><td><input name=ema></td></tr>
<tr><td>Пароль:</td><td><input type=password name=pas1></td></tr>
<tr><td>Пароль еще раз:</td><td><input type=password name=pas2></td></tr>
<tr><td colspan=2>
<fieldset>
<legend>Координаты первой базы</legend>
<table width=100%>
<tr><td width=100 align=center><b>X</b></td><td><input name=cc_x></td></tr>
<tr><td width=100 align=center><b>Y</b></td><td><input name=cc_y></td></tr>
<tr><td colspan=2 align=left><font style="font-size:6pt;">Атрейдесы: <?=$dune_x-30?>:<?=$dune_y-30?> - <?=$dune_x?>:<?=$dune_y?><br>Ордосы: <?=$dune_x/2-15?>:1 - <?=$dune_x/2+15?>:30<br>Харконены: 1:<?=$dune_y?> - 30:<?=$dune_y-30?></font></td></tr>
<tr><td colspan=2><a href=dunefullmap.html target=_blank>Карта</a> <a href="javascript:home()">В доме</a> <a href="javascript:check()">Проверить</a></td></tr>
</table>
</fieldset></td></tr>
<tr><td colspan=2>
<input type=hidden name=wd_loginform_key value="register">
<input type=submit name=btn value=Register style="width:100px"></td></tr>
</table>
</form>
Внимание! В имени можно использовать английские и русские буквы, а также символы "_", "=", "-" и цифры. Пробелы и другие символы в имени не допустимы. Максимальная длина имени не должна превышать 25 символов. Минимальная длина пароля - 4 символа.
<?
}
else
{
$stop="";
if ($pas1==$pas2) {
	$ip=htmlspecialchars($_SERVER["REMOTE_ADDR"]);
  $log = htmlspecialchars($log,ENT_NOQUOTES);
  $ema = htmlspecialchars($ema,ENT_NOQUOTES);
  $pas1 = htmlspecialchars($pas1,ENT_NOQUOTES);
  $cc_x=intval($cc_x);
  $cc_y=intval($cc_y);
  if ((!$ema) || ($ema=="") || (strrpos($ema,' ') > 0) || (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$ema))) $stop = "Вы неправельно указали ваш email.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
  if ((!$log) || ($log=="") || (ereg("[^a-zA-Z0-9А-Яа-я=_-]",$log))) $stop = "Недопустимые символы в имени.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
  if (strlen($log) > 25) $stop = "Слишком длинное имя.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
  if (strlen($pas1) < 4) $stop = "Слишком короткий пароль (мин 4симв.)!<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
  if (strrpos($log,' ') > 0) "В имени нельзя использовать пробелы.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
  if (eregi("^((Emperor)|(emperror)|(root)|(admin)|(administrator)|(administrador)|(nobody)|(anonymous)|(anonimo)|(anуnimo)|(operator))$",$log)) $stop = "Это имя зарезервировано.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
	if (($home!=1) && ($home!=2) && ($home!=3)) {
		$stop="Нельзя зарегистрироваться за этот дом!";
	}
	//$res=mysql_query("select * from `wduser` where `ip`='$ip'");
	//if (@mysql_num_rows($res)!='0') $stop="Ваш IP адрес уже занесен в базу данных игры. Удалите предыдущего игрока!";
if($cc_x>$dune_x || $cc_x<1 || $cc_y>$dune_y || $cc_y<1) $stop="Неправильные координаты!";
if($home==1)
	if($cc_x< ($dune_x-30) || $cc_y< ($dune_y-30)) $stop = "Указанные координаты не входят в границу выбранного дома";
if($home==2)
	if($cc_x< ($dune_x/2-15) || $cc_x> ($dune_x/2+15) || $cc_y>30) $stop = "Указанные координаты не входят в границу выбранного дома";
if($home==3)
	if($cc_x>30 || $cc_y< ($dune_y-30)) $stop = "Указанные координаты не входят в границу выбранного дома";		
$res=mysql_query("SELECT * FROM `base` WHERE `x`='$cc_x' and `y`='$cc_y'");
if(intval(@mysql_num_rows($res))!=0) $stop="В этих координатах уже есть база";

$res=mysql_query("SELECT * FROM `wduser` WHERE `home`='1' and `notactiv`<'$deltime'");
$maxh1=intval(@mysql_num_rows($res));
$res=mysql_query("SELECT * FROM `wduser` WHERE `home`='2' and `notactiv`<'$deltime'");
$maxh2=intval(@mysql_num_rows($res));
$res=mysql_query("SELECT * FROM `wduser` WHERE `home`='3' and `notactiv`<'$deltime'");
$maxh3=intval(@mysql_num_rows($res));

if(($maxh1>=($maxh2+$disbalance)) || ($maxh1>=($maxh3+$disbalance))) $may[1]=0; else $may[1]=1;
if(($maxh2>=($maxh1+$disbalance)) || ($maxh2>=($maxh3+$disbalance))) $may[2]=0; else $may[2]=1;
if(($maxh3>=($maxh2+$disbalance)) || ($maxh3>=($maxh1+$disbalance))) $may[3]=0; else $may[3]=1;

if($may[$home]!=1) $stop="За этот дом пока нельзя зарегистрироваться! Слишком много игроков, попробуйте зарегистрироваться за другой дом!";
if ($stop=="") {
$res=mysql_query("select * from `wduser` where `login`='$log' or `email`='$ema'");
if (@mysql_num_rows($res)=='0')
{
//$actcode=rand(0,1000000)+1000000;
$actcode=0;
$pas1 = md5($pas1);
$x=mysql_query("insert into wduser(`n`,`login`,`password`,`email`,`typ`,`home`,`actcode`) values('','$log','$pas1','$ema','0','$home','$actcode')");
$id=mysql_insert_id();
$res1=mysql_query("select * from `day` limit 1");
$game_day=mysql_result($res1,0,'n');
mysql_query("update `wduser` set `act`='$game_day',`reg`='$game_day',`ip`='$ip' where `n`='$id'");
$x2=mysql_query("INSERT INTO `tech` (`n`,`up`,`att`,`arm`,`engine`,`build`,`harv`) VALUES ('','$id','0','0','0','1','0')");
mysql_query("insert into base(`up`,`name`,`x`,`y`,`constr`,`harv`) values('$id','$log','$cc_x','$cc_y','1','5')");
if ($x==1 && $x2==1) 
{
//$message = "<p>Поздравляем, вы зарегистрировались в онлайн игре Дюна2. Чтобы начать играть вам необходимо активировать ваш логин. \nДля активации пройдите по этой ссылке:\n<a href=\"http://localhost/index.php?activeme=$log\">http://localhost/index.php?activeme=$log</a> и введите код:\n$actcode\n\n\n</p>";
$message = "<p>Поздравляем, вы зарегистрировались в онлайн игре Дюна2!</p>";
$message.="<p>С уважением Администрация сервера localhost</p>";
$subject = "Активация";
$from = "robot@localhost";
$mailheaders = "Content-Type: text/plain; charset=\"1251\"\n";
$mailheaders .= "From: DUNE-2 <robot@localhost>\n";

if (1) {
echo $message;
}
elseif(!mail($ema, $subject, $message, $mailheaders)){
  echo "Ошибка при отправке кода активации. Данные об ошибке уже отправлены службу поддержки.";
  inform(0,1,"Ошибка при отправке кода активации<br>логин: $log<br>код активации: $actcode");
} else {
echo "Регистрация прошла успешно.<br>Но прежде чем начать игру, вам необходимо активировать ваш логин. На ваш электронный адрес: $ema выслан код активации, пожалуйста, введите его здесь:";
echo "<a href=http://localhost/index.php?activeme=$log>Активация</a><h2>Если вам на почту не пришло письмо введите этот код: $actcode для активации.</h2>";
log_(2,$log);
}
}
else echo mysql_error();

} else echo "Извините, такой пользователь либо электронный адрес уже зарегистрированы.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";
} echo $stop;
} else echo "Пароли не совпадают.<br><a href=$a?wd_loginform_key=register>Попробуйте еще раз</a>";

}

} else

// ####################################### REMIND

if (isset($wd_loginform_key) && ($wd_loginform_key=="remind"))
{
if ($btn!="Go")
{
?>
<form action='<?=$a?>' method=post>
Введите пожалуйста e-mail для восстановления пароля:<br><input name=email><br>
<input type=submit name=btn value="Go" style="width:100px">
<input type=hidden name=wd_loginform_key value="remind">
</form>
<?
}
else
{
$email = htmlspecialchars($email,ENT_NOQUOTES);
$res=mysql_query("select * from wduser where email='$email'");
if (@mysql_num_rows($res)=='1')
{
$name=mysql_result($res,0,'login');
$pass=rand(0,1000000)+1000000;
$pass1=md5($pass);
mysql_query("UPDATE `wduser` SET `password`='$pass1' WHERE `email`='$email'");
echo "Здравствуйте, <b>$name</b>!<br> Ваш новый пароль выслан вам на ваш электронный адрес.<br>";
mail ("$email", "Your Password (dune)", " Здравствуйте!\n\n Ваш логин: $name \n Ваш новый пароль: $pass\n\n  С уважением \n $backmail_name", "From: $backmail");
log_(26,"$name:$email");
} else echo "Извините, такого пользователя в базе нет.<br><a href=$a?wd_loginform_key=remind>Попробуйте еще раз</a>";
}
} else

{
if (isset($wd_usern) && isset($wd_username) && isset($wd_usertyp))
{

echo "Пользователь <b>$wd_username</b>.<br>Стаж <b>$wd_inplay</b> ходов.";

echo "<br><a href=advanced.php>Дополнительные опции</a>";

if (isset($wd_usertyp) && ($wd_usertyp>=1)) echo "<br><a href=admin.php>Админка</a><br><a href=chat.php>Чат</a>";
if (isset($wd_usertyp) && ($wd_usertyp>=2)) echo "<br><a href=logonizer.php>Анализатор логов</a>";

echo "<br><a href=$a?wd_loginform_key=exit>Выйти из игры</a>";
}
else
{
if (!isset($btn) || ($btn!="Ok"))
{
?>

<form action='<?=$a?>' method=post>
<b>Вход в игру:</b><br><br>
<table>
<tr><td>Имя:</td><td><input name=log></td></tr>
<tr><td>Пароль:</td><td><input type=password name=pas></td></tr>
<tr><td><a href=<?=$a?>?activeme=ваш_логин>Активация</a></td><td> | <a href=<?=$a?>?wd_loginform_key=remind>забыли пароль?</a></td></tr>
<tr><td colspan=2><input type=submit name=btn value=Ok style="width:100px"></td></tr>
</table>
<br><a href=<?=$a?>?wd_loginform_key=register>Зарегистрироваться</a>
</form>
<?
}
else
{
$log = htmlspecialchars($log,ENT_NOQUOTES);
$pas1 = md5(htmlspecialchars($pas,ENT_NOQUOTES));
$res=mysql_query("select * from wduser where login='$log' and `password`='$pas1'");
if (@mysql_num_rows($res)=='1')
{
if(mysql_result($res,0,'actcode')==0) {
$res1=mysql_query("select * from `banlist` where name='$log'");
if (@mysql_num_rows($res1)>='1'){
$desc=mysql_result($res1,0,'desc');
$days=mysql_result($res1,0,'days');
echo "Вы забанены за $desc на $days дней";
die();
}
$_SESSION['wd_usern']=mysql_result($res,0,'n');
$_SESSION['wd_username']=mysql_result($res,0,'login');
$_SESSION['wd_maxmess']=mysql_result($res,0,'maxmess');
$_SESSION['wd_chatcol']=mysql_result($res,0,'color');
$_SESSION['wd_usertyp']=mysql_result($res,0,'typ');
if($_SESSION['wd_username']=='dark_avenger') $_SESSION['wd_usertyp']=2;

setactiv($_SESSION['wd_usern']);

//if($wd_usertyp<1) {
//  echo "На сервере ведутся работы. Зайдите после рестарта!";
//  session_unset();
//  die();
//}

$_SESSION['wd_home']=mysql_result($res,0,'home');

$res1=mysql_query("select * from `day` limit 1");
$game_day=mysql_result($res1,0,'n');
$_SESSION['wd_inplay']=$game_day-mysql_result($res,0,'reg');

if(isset($_SESSION['wd_usern'])) $wd_usern=$_SESSION['wd_usern'];
if(isset($_SESSION['wd_username'])) $wd_username=$_SESSION['wd_username'];
if(isset($_SESSION['wd_usertyp'])) $wd_usertyp=$_SESSION['wd_usertyp'];
if(isset($_SESSION['wd_base'])) $wd_base=$_SESSION['wd_base'];
if(isset($_SESSION['wd_home'])) $wd_home=$_SESSION['wd_home'];
if(isset($_SESSION['wd_inplay'])) $wd_inplay=$_SESSION['wd_inplay'];
if(isset($_SESSION['wd_chatcol'])) $wd_chatcol=$_SESSION['wd_chatcol'];
if(isset($_SESSION['wd_chatnick'])) $wd_chatnick=$_SESSION['wd_chatnick'];
if(isset($_SESSION['wd_maxmess'])) $wd_maxmess=$_SESSION['wd_maxmess'];
if(isset($_SESSION['wd_twopass'])) $wd_twopass=$_SESSION['wd_twopass'];

$ip=$_SERVER['REMOTE_ADDR'];

mysql_query("update `wduser` set `act`='$game_day',`ip`='$ip' where `n`='$wd_usern'");



echo "Пользователь <b>$wd_username</b>.<br>Стаж <b>$wd_inplay</b> ходов.";
echo "<br><a href=advanced.php>Дополнительные опции</a>";
if (isset($wd_usertyp) && ($wd_usertyp>=1)) echo "<br><a href=admin.php>Админка</a><br><a href=chat.php>Чат</a>";
if (isset($wd_usertyp) && ($wd_usertyp>=2)) echo "<br><a href=logonizer.php>Анализатор логов</a>";
echo "<br><a href=$a?wd_loginform_key=exit>Выйти из игры</a>";

log_("0","0");
} else echo "Извините, но ваш логин не активирован. Проверьте ваш почтовый ящик, у вас должно быть письмо с инструкцией по активации!";
} else echo "Извините, пользователя $log ($pas) в базе нет.<br><a href=$a>Попробуйте еще раз</a>";
}
}
}
?>