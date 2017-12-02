<? 
extract($_GET);
extract($_POST);
include "header.php";

if (isset($wd_usern))
{
include "inc_war_dsc.php";

?>
<table width=100% <?=$paramtable?>>
<tr>
<td <?=$paramhead?> width=20%>Боевая единица</td>
<td <?=$paramhead?> width=80%>Боевые качества</td>
</tr>
<?

for ($i=12;$i<=29;$i++)
{
if ($i==14) $i=21;

if ($war_c[$i]==1) $war_c[$i]="Пехота";
if ($war_c[$i]==2) $war_c[$i]="Техника";

$war_a1[$i]=round($war_a1[$i]*0.5)."-".round($war_a1[$i]*1.5);
$war_a2[$i]=round($war_a2[$i]*0.5)."-".round($war_a2[$i]*1.5);

?>
<tr valign=top>
<td>
<?=$war_n[$i]?>
<br><br>
<img src=pics/unit<?=$i?>.jpg width=100 height=100 border=1>
</td>
<td>
Класс: <b><?=$war_c[$i]?></b><br>
Атака против пехоты: <b><?=$war_a1[$i]?></b><br>
Атака против техники: <b><?=$war_a2[$i]?></b><br>
Броня: <b><?=$war_hp[$i]?></b><br><br>Условия производства:<br>
<?
if ($i==12) echo "Защитная стена уровень 1";
if ($i==13) echo "Оружейная башня уровень 5, Научный центр уровень 5";

if ($i==21) echo "Завод по переработке спайса уровень 1";
if ($i==22) echo "Фабрика тяжелой техники уровень 5";
if ($i==23) echo "Казармы уровень 1";
if ($i==24) echo "Казармы уровень 3";
if ($i==25) echo "Фабрика тяжелой техники уровень 1";
if ($i==26) echo "Фабрика тяжелой техники уровень 5";
if ($i==27) echo "не определены";
if ($i==28) echo "не определены";
if ($i==29) echo "не определены";

?>
</td>
</tr>
<?
}
?></table><?
}
include "footer.php";
?>