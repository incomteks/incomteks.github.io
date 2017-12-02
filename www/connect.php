<?
extract($_GET);
extract($_POST);

include "config.php";

// соединение с сервером MySQL   

if(!mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpass))    
{  
   echo "Ќе могу соединитьс€ с базой !<br>";    
   echo mysql_error();   
   exit;    
}
// else echo "—оединение с базой прошло успешно !<br>";

mysql_select_db($sys_dbname);
mysql_query('SET NAMES cp1251');
session_name("wd");
session_start();

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

?>