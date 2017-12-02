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

<tr><td <?=$paramhead?> colspan=3><span style="padding:15px"><strong>Немного о самой онлайн игре Dune2</strong></span></td></tr>

<tr><td colspan=3>
<table width=100% height=100%><tr valign=top>
<td style="padding:15px"><p>А теперь  немного о самой <strong>онлайн игре Dune2</strong>.  <br>
  <br>
  В игре выделяются 5 игровых домов: Атрейдесы, Ордосы, Харконены, Фримены и  Карину, причем игроки могут регистрировать в один из первых трех Домов,  четвертый используется искусственным интеллектом, пятый как я понимаю, для  слежения за порядком в игровом пространстве. <br>
  Но собственно вся война и  разворачивается среди игроков первых трех домов. <br>
  <br>
  Для начала у каждого есть 1000  игровых дней для стартового развития под защитой «Молодой игрок»,  продолжительность игрового дня определяется 3-мя минутами реального времени.  Поначалу этого может показаться слишком долго, и не всегда находишь себе  занятие, если уже успел освоиться. А вот с течением времени этого может  оказаться и слишком мало, что бы успеть провести действия на всех фронтах и при  этом не забывать про особенности экономического развития и военного оснащения  вновь занятых или отвоеванных гарнизонов (баз).<br>
  <br>
  Каждую базу  можно оснастить как военными, так и гражданскими зданиями, первые обеспечивают  заказ и строительство юнитов, вторые обеспечивают экономическое развитие, а  также есть возможность перелета юнитов и ресурсов через космопорт после его  постройки. <br>
  <br>
  В качестве основного ресурса выступает спайс, которые добывают  специальные юниты – харвестеры. Далее завод по переработке спайса переводит его  в кредиты, на которые собственно и уже можно производить постройку зданий и  заказ юнитов. <br>
  <br>
  Есть еще гранит, его добыча производится автоматически и прирост  увеличивается с уровнем командного центра самой базы.<br>
  <br>
  Сам бой  происходит в автоматическом режиме, и нет необходимости ожидать ответного хода  противника, если он, грубо говоря, тормозит или колеблется в принятии решении.  Тут на все его действия не более трех минут в каждом игровом дне. <br>
  <br>
  В ходе боя  можно не только уничтожить армию потенциального врага, но и захватить его базу,  если вести на нее нападение. А далее в случае успеха поступать с так называемым  трофеем на свое усмотрение и либо уничтожить ее, либо пытаться оснастить так,  что бы она не была захвачена врагом.<br>
  <br>
  <strong>Есть  возможность действовать сообща в команде</strong>: вести параллельные или совместные  боевые действия, помогать друг другу экономически, единственно делать это на  первых порах после рестарта слегка дороговато так как взимается 75% сверх  пересылаемой суммы ресурсов или стоимости пересылаемых юнитов. Все это  добавляет интерес к такой увлекательной on line стратегии, как Dune2.<br>
  <br>
  Собственно  всего рассказать не возможно, попробуйте самостоятельно зарегистрироваться и  ознакомиться с особенностями этой <strong>бесплатной браузерной онлайн стратегии</strong>.</p>
  <p class="MsoNormal" style="text-align: justify;"><br><br>
</p>
  <div style="text-align: right;"><span
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
    <p>Собственно предложение для патриотов Дюны - написать небольшие описания игры, либо вольные рассказы о собственных подвигах на онлайн песках Дюны объемом не менее 1 страницы и прислать их на e-mail - help@dune-2.ru либо support@neo-teh.ru либо в личку на форуме. Лучшие тексты будут опубликованы на сайте (возможно подвергнутые корректировке). Поверьте, это действительно поможет нашей онлайн стратегии.</p>
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

