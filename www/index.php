<? 
extract($_GET);
extract($_POST);
include "header.php"; 

$res=mysql_query("select count(*) from wduser");
$cnt1=mysql_result($res,0,'count(*)');
$res=mysql_query("select count(*) from base");
$cnt2=mysql_result($res,0,'count(*)');
$res=mysql_query("select count(*) from army");
$cnt3=mysql_result($res,0,'count(*)');
$res=mysql_query("select * from `day` limit 1");
$day=mysql_result($res,0,'n');

$res=mysql_query("select count(*) from wduser where `home`='1'");
$hm1=mysql_result($res,0,'count(*)');
$res=mysql_query("select count(*) from wduser where `home`='2'");
$hm2=mysql_result($res,0,'count(*)');
$res=mysql_query("select count(*) from wduser where `home`='3'");
$hm3=mysql_result($res,0,'count(*)');

?>

<table width=100%>

<tr><td <?=$paramhead?> colspan=4><b>Распределение игроков: </b></td></tr>

<tr valign=top>
<td align=center bgcolor=#e5ac77 width=25%>
<b>дом Атрейдесов</b><br>
<img src=pics/logo1.gif width=88 height=94>
<br>
игроков: <b><?=$hm1?></b></td>
<td align=center bgcolor=#e5ac77 width=25%>
<b>дом Ордосов</b><br>
<img src=pics/logo2.gif width=88 height=94>
<br>игроков: <b><?=$hm2?></b></td>
<td align=center bgcolor=#e5ac77 width=25%>
<b>дом Харконненов</b><br>
<img src=pics/logo3.gif width=88 height=94>
<br>игроков: <b><?=$hm3?></b></td>
</tr>

<tr><td <?=$paramhead?> colspan=3><b>О игре</b></td></tr>

<tr><td colspan=3>
<table width=100% height=100%><tr valign=top>
<td style="padding:15px">

<!--h2>Начинается бета-тестирование новой версии игры</h2>
<p>Всех желающих приглашаем <a target="_blank" href="http://localhost/">принять участие</a> в тестировании.</p>
<p>&nbsp;</p>
<p>&nbsp;</p-->

<b>Вступайте в битву за Дюну сейчас!</b><br>
*не забудьте прочитать <a href=rules.php>правила игры</a> перед регистрацией.
<br><br>
Настоятельно рекомендуем ознакомиться с технологией развития в <a href=easy_faq.php><b>браузерной онлайн игре Dune 2</b></a> от =Easy= и <a href=manual.php>руководством по игре</a>.
<br><br>
<b>Открылась наша собственная социальная сеть - <a href=http://localhost/ target=_blank>Заходите, Там весело! ;)</a></b>
<br><br>
<b>Если у вас есть вопросы или предложения по игре - добро пожаловать на форум!</b>

<br><br><b>Статистика:</b> <a href=stat_1.php>Дома и Игроки</a>, <a href=stat_2.php>Базы top100</a></td><td width=150 bgcolor=#ecac70 style="padding:15px">

<?
$res=mysql_query("SELECT count(*) FROM `wduser` WHERE `notactiv`<1000");
$act=mysql_result($res,0,'count(*)');
echo "<b>Сейчас в игре:</b><br><br>
Игроков: <b>$cnt1</b><br>
Активных: <b>$act</b><br>
Построено баз: <b>$cnt2</b><br>
Создано армий: <b>$cnt3</b><br>
Идет <b>$day</b> игровой день.";

$res=mysql_query("select sum(constr) from `base`");
$all_constr=mysql_result($res,0,'sum(constr)');
echo "<br>Баланс:<br> ";
for ($i=0;$i<=4;$i++)
{
$sum[$i]=0;
$res=mysql_query("select * from `wduser` where `home`='$i'");
$max=@mysql_num_rows($res);

for ($j=0;$j<$max;$j++)
{
$n=mysql_result($res,$j,'n');

$res2=mysql_query("select sum(constr) from `base` where `up`='$n'");
$sum[$i]+=mysql_result($res2,0,'sum(constr)');
}

if ($i==0) echo " <font color=#666666>";
if ($i==1) echo " <font color=#000099>";
if ($i==2) echo " <font color=#009900>";
if ($i==3) echo " <font color=#990000>";
if ($i==4) echo " <font color=#990099>";

if($all_constr>0)
  $perc=round($sum[$i]*100/ $all_constr);
else
  $perc=0;
echo $sum[$i]." ($perc%)</font><br>";
}

$res=mysql_query("select sum(spice) from `wduser`");
$all_spice=mysql_result($res,0,'sum(spice)');
echo "<br>Добыто спайса:<br>";
for ($i=0;$i<=4;$i++)
{
$sum[$i]=0;

$res=mysql_query("select sum(spice) from `wduser` where `home`='$i'");
$sum[$i]+=@mysql_result($res,0,'sum(spice)');

if ($i==0) echo " <font color=#666666>";
if ($i==1) echo " <font color=#000099>";
if ($i==2) echo " <font color=#009900>";
if ($i==3) echo " <font color=#990000>";
if ($i==4) echo " <font color=#990099>";

if($all_spice>0)
  $perc=round($sum[$i]*100/ $all_spice);
else
  $perc=0;
echo $sum[$i]." ($perc%)</font><br>";
}
?>
<br>
<b>>></b> <a href="/best_dune.php">Достоинства онлайн стратегии Дюна 2</a><br>
<b>>></b> <a href="/about_dune.php">Немного о самой онлайн игре Dune2</a><br></td>
</tr></table>
</td></tr>
<tr><td <?=$paramhead?> colspan=3> Фильм "Дюна" </td></tr>
<tr>
  <td colspan=3>
<table cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td><a href="#" onclick="window.location.href='/film.php';return false;"><img width="109" height="150" border="0" src="/pics/film_poster_sm.jpg" /></a></td>
		<td width="100%" style="padding-left:15px;">
	    <p>Уважаемые игроки! Аминистрация игры Dune II On-Line поздравляет всех с возобновлением работ над игрой и предлагает всем посмотреть старую версию фильма Дюна.</p>
	    <p><a href="#" onclick="window.location.href='/film.php';return false;">Смотреть</a></p>
		</td>
	</tr>
</table>
    </td>
</tr>
<tr><td <?=$paramhead?> colspan=3> Фан-арт </td></tr>
<tr>
  <td colspan=3>
    <p><strong>Игроки! Дюна нуждается в вашей помощи.    </strong></p>
    <p>Как все уже успели заметить, в нашу замечательную браузерную стратегию приходит очень мало новых игроков. Этому есть вполне логичное объяснение - с точки зрения поисковиков онлайн стратегия Дюна является тематически &quot;пустым&quot; сайтом, поскольку все интересные события происходят после авторизации, а туда поисковые роботы не могут попасть.</p>
    <p>Собственно предложение для патриотов Дюны - написать небольшие описания игры, либо вольные рассказы о собственных подвигах на онлайн песках Дюны объемом не менее 1 страницы и прислать их на e-mail - help@localhost либо support@localhost либо в личку на форуме. Лучшие тексты будут опубликованы на сайте (возможно подвергнутые корректировке). Поверьте, это действительно поможет нашей онлайн стратегии.</p>
    <p>P.S. желательно в текстах употреблять время от времени следующие ключевые слова:</p>
    <p>браузерная стратегия<br />
        игры стратегии<br />
        стратегии игры<br />
        on line стратегии<br />
        онлайн стратегии<br />
        онлайн игры стратегии<br />
        бесплатная онлайн стратегия<br />
        браузерные онлайн стратегии<br />
        экономическая онлайн стратегия<br />
        стратегия онлайн бесплатно<br />
        онлайн рпг стратегии<br />
    новая онлайн стратегия</p>
    <p>&nbsp;</p></td>
</tr>
<tr><td <?=$paramhead?> colspan=3> Новости </td></tr>
<tr><td colspan=3>
<? include("avnews.php"); ?>
</td></tr>
</table>

<br><br><br>

<? include "footer.php"; ?>

