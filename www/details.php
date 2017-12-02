<?
extract($_GET);
extract($_POST);
include "header.php";


if (isset($wd_base))
{

?>
<table width=100% <?=$paramtable?>><?

if (isset($getunit) && (($getunit>1 && $getunit<=13) || ($getunit>=21 && $getunit<=26) || $getunit==666 || $getunit==31 ))
{
$istart=$getunit;
$imax=$getunit;

if ($getunit==666)
{
$istart=2;
$imax=26;
}

$rest=mysql_query("select * from `tech` where `up`='$wd_usern'");
$tb=@mysql_result($rest,0,'build');

for ($i=$istart;$i<=$imax;$i++)
{
if ($i==14) $i=21;

$t_build=$tb;
include ("inc_units_dsc.php");
echo "<tr valign=top><td><img src=pics/unit".$i.".jpg border=1><br><br>".$name[$i]."<td width=500>";

?>
<table width=500 <?=$paramtable?>><tr>
<td <?=$paramhead?>>Уровень</td>
<td <?=$paramhead?>>Гранит</td>
<td <?=$paramhead?>>Кредиты</td>
<td <?=$paramhead?>>Фундамент</td>
<td <?=$paramhead?>>Постройка (дней)</td>
</tr>

<?

if ($i<20 || $i==31) $maxj=19;
else $maxj=1;

for ($j=0;$j<=$maxj;$j++)
{
$lvl[$i]=$j;

$jj=$j+1;

$t_build=$tb;
include ("inc_units_dsc.php");

if ($i<20 || $i==31) echo "<tr><td>".$jj."</td>";
else echo "<tr><td>-</td>";
echo "<td>".$stone[$i]."</td>";
echo "<td>".$cred[$i]."</td>";
echo "<td>".$site[$i]."</td>";
echo "<td>".$days[$i]."</td></tr>";
}

echo "</table></td></tr>";
}

}
?></table><?
}

include "footer.php";
?>