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

<tr><td <?=$paramhead?> colspan=3><b>Достоинства онлайн стратегии Дюна 2</b></td></tr>

<tr><td colspan=3>
<table width=100% height=100%><tr valign=top>
<td style="padding:15px"><p class="MsoNormal" style="text-align: justify;"><strong>Всем
привет!</strong>&nbsp;<br>
</p><p class="MsoNormal" style="text-align: justify;">Хотел
бы поведать
свою историю ознакомления с <span style="font-weight: bold;">on
line
стратегией &ndash; Дюна2</span>. Я долго плутал по всемирной
сети Интернет в поисках
браузерной <span style="" lang="EN-US">on</span><span
 lang="EN-US"> </span><span style=""
 lang="EN-US">line</span>
игры. Все, что находил, было по принципу бесконечной игры без
победителей. А
первое, что меня привлекло в Дюне, так это то, что все игроки играют на
одном
сервере и раз в 2-3 недели делают рестарт. Многие могут задать вопрос:
&laquo;И что
это дает?&raquo; На который я могу дать следующий ответ:</p>
<p class="MsoNormal" style="text-align: justify;">1.
Игровые <span style="font-weight: bold;">аккаунты всех
игроков
находятся в едином игровом пространстве</span> бесплатной <span
 style="" lang="EN-US">on</span><span
 lang="EN-US"> </span><span style=""
 lang="EN-US">line</span> стратегии и могут
контактировать друг с другом, а не разделены различными серверами,
игровые
процессы в которых ни коим образом не пересекаются.</p>
<p class="MsoNormal" style="text-align: justify;">2.
<span style="font-weight: bold;">Нет постоянной
зависимости от
нахождения в Интернете</span> в попытках вычисления наилучшего
пути развития в этой
онлайн стратегии, хотя это не возбраняется для игроков, особо
увлеченных игрой,
но все же не обязательно играть все раунды подряд.</p>
<p class="MsoNormal" style="text-align: justify;">3.
Начав игру в новом раунде этой
браузерной стратегии, <span style="font-weight: bold;">у
каждого игрока есть шанс привести свой Дом к победе</span>,
отличившись при этом в любом из игровых моментов, а не пытаться вести
гонку с
давно устроившейся группой лидеров, которая так и ждет, когда же с тебя
снимется так называемая нуб-защита.</p>
<p class="MsoNormal" style="text-align: justify;">4.
Дюна является прекрасной <span style="" lang="EN-US">on</span><span
 lang="EN-US"> </span><span style=""
 lang="EN-US">line</span> стратегией и с точки
зрения военных действий и с точки зрения экономической стратегии. При
равномерном распределении между игровыми Домами, чего стараются достичь
модераторы игры Дюна2, на счету будет каждый юнит и каждая единица
ресурсов,
каждая база, так как потенциальный противник не предсказуем, и в каждом
из
раундов может использовать самую разнообразную комбинацию
военно-экономических
приемов этой стратегии.</p>
<p class="MsoNormal" style="text-align: justify;">5.
<span style="font-weight: bold;">В начале каждого раунда
этой
онлайн стратегии все игроки находятся в равных стартовых условиях,
изменять
которые за счет реальных денежных ресурсов нет возможности</span>
и нет смысла, так
как игровой раунд не столь продолжителен.</p>
<p class="MsoNormal" style="text-align: justify;">6.
Даже если все базы и армии
определенного игрового аккаунта были уничтожены в этом раунде, что
показывает
проигрыш в текущем раунде, а игрок, управляющий им не смог достигнуть
выдающегося мастерства, у него есть шанс проанализировать свои действия
и
исправить свои потенциальные ошибки в новом раунде, или просто
использовать
другую военно-экономическую стратегию развития и победы.<br>
<br><br>
</p><div style="text-align: right;"><span
 style="font-style: italic;">Игрок</span><span
 style="font-weight: bold; font-style: italic;"> -Roman-SPb-</span></div>
<p class="MsoNormal" style="text-align: justify;"></p><br>
</td><td width=150 bgcolor=#ecac70 style="padding:15px">

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

