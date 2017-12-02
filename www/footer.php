<?
extract($_GET);
extract($_POST);
?>
</td>

<td width=250 height=500 align=center bgcolor=#e5ac77 valign=top style='padding:5px'>

<? include "inc_units.php"; ?>
<? include "startup.php"; ?>
<? include "base_info.php"; ?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</td>

</tr>
<tr><td colspan=2 bgcolor=#e8ae77>
<?
if(isset($wd_usern)) sess_off($wd_usern);
$TIME_END = getmicrotime();
$TIME_SCRIPT = $TIME_END - $TIME_START;

echo "loaded in ".number_format($TIME_SCRIPT,5,'.','')." sec";
?>
</td></tr>
</table>