<?
extract($_POST);
extract($_GET);
include "header.php";

if (isset($wd_usertyp) && ($wd_usertyp>0))
{
?>
<script>
var scroller=1;
var timerid;
</script>
<IFRAME SRC="chat_msg.php" name="viewmsg" WIDTH=100% HEIGHT=80% SCROLLING="auto" FRAMEBORDER=0>
</IFRAME>
<IFRAME SRC="chat_send.php" name="sendmsg" WIDTH=100% HEIGHT=20% SCROLLING="auto" FRAMEBORDER=0>
</IFRAME>
<?
} else echo "<h1>Доступ запрещен</h1>";
include "footer.php";
?>