<?
$ema = "vit@localhost";
$message = "Поздравляем, вы зарегистрировались в онлайн игре Дюна2. Чтобы начать играть вам необходимо активировать ваш логин. \nДля активации пройдите по этой ссылке:\nhttp://localhost/index.php?activeme=$log и введите код:\n";
$message.="111\n\n\n";
$message.="С уважением Администрация сервера localhost";
$subject = "Активация";
$from = "robot@localhost";
$mailheaders = "Content-Type: text/plain; charset=\"1251\"\n";
$mailheaders .= "From: DUNE-2 <robot@localhost>\n";
/*
echo '<p>'.$ema.'</p>';
echo '<p>'.$subject.'</p>';
echo '<p>'.$message.'</p>';
echo '<p>'.$mailheaders.'</p>';
*/
if(!mail($ema, $subject, $message, $mailheaders)){
  echo "Ошибка при отправке кода активации. Данные об ошибке уже отправлены службу поддержки.";
} else {
echo "Регистрация прошла успешно.<br>Но прежде чем начать игру, вам необходимо активировать ваш логин. На ваш электронный адрес: $ema выслан код активации, пожалуйста, введите его здесь:";
echo "<a href=http://localhost/index.php?activeme=$log>Активация</a><h2>Если вам на почту не пришло письмо введите этот код: $actcode для активации.</h2>";
}

exit;
function output($string) {
	$string = str_replace( array( '\\' , '\'' ), array('\\\\', '\\\'') , $string); //-> for javascript array
	$string = str_replace(  array("\r\n", "\r", "\n") , '<br>' , $string);    //nl2br
	return $string;
}

function arrayToJS4($array,$baseName) {
	$output = $baseName . " = new Array(); \r\n ";
	reset($array);
	while (list($key, $value) = each($array)) {
		if (is_numeric($key)) $outKey = "[" . $key . "]";
		else $outKey = "['" . $key . "']";

		if (is_array($value)) $output .= arrayToJS4($value, $baseName . $outKey);
		else {
			$output .= $baseName . $outKey . " = ";

			if (is_string($value)) $output .= "'" . output($value) . "'; \r\n ";
			else if ($value === false) $output .= "false; \r\n";
			else if ($value === NULL) $output .= "null; \r\n";
			else if ($value === true) $output .= "true; \r\n";
			else $output .= $value . "; \r\n";
		}
	}
	return $output;
}


function getmicrotime(){
list($usec, $sec) = explode(" ",microtime());
return ((float)$usec + (float)$sec);
}
$TIME_START = getmicrotime();
include "config.php";

// соединение с сервером MySQL

if(!mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpass))
{
   echo "Не могу соединиться с базой !<br>";
   echo mysql_error();
   exit;
}
// else echo "Соединение с базой прошло успешно !<br>";

mysql_select_db($sys_dbname);



################################################################################

	$cell_size = 32;
	$xmax = $ymax = 150;
	$res_file = '/home/www/dunefullmap2.html';

	$query = "
		SELECT
			`wduser`.`login`,
			`wduser`.`home`,
			`base`.`name`,
			`base`.`x`,
			`base`.`y`,
			`base`.`constr`
		FROM `base` LEFT JOIN `wduser`
		ON `base`.`up`=`wduser`.`n`
		WHERE `base`.`name`!='*GOLD PALACE*'
	;";
	$res = mysql_query($query);
	$base = array();
	while ($data = mysql_fetch_assoc($res)) $base[$data['x']][$data['y']] = $data;


	$query = "
		SELECT
			`wduser`.`login`,
			`wduser`.`home`,
			`army`.`name`,
			`army`.`x`,
			`army`.`y`,
			`army`.`wins`,
			`army`.`rang`
		FROM `army` LEFT JOIN `wduser`
		ON `army`.`up`=`wduser`.`n`
	;";
	$res = mysql_query($query);
	$army = array();
	while ($data = mysql_fetch_assoc($res)) $army[$data['x']][$data['y']][] = $data;

echo arrayToJS4($base,'base');
echo arrayToJS4($army,'army');

	$TIME_END = getmicrotime();
	$TIME_SCRIPT = $TIME_END - $TIME_START;
	echo '<p>loaded: '.$TIME_SCRIPT.'</p>';
exit;

	$html = '';
	for ($y = $ymax; $y >= 1; $y--) {
		$html .= '<tr>';
		for ($x = 1; $x <= $xmax; $x++) {
			$td_param = '';
			$img = '';

			if (isset($base[$x][$y]) && count($base[$x][$y])) {
				switch ($base[$x][$y]['home']) {
					case 0: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'База фрименов '.$base[$x][$y]['name'].'"'; break;
					case 1: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'База Атрейдесов '.$base[$x][$y]['name']."\n".'Игрок '.$base[$x][$y]['login']."\n".'уровень '.$base[$x][$y]['constr'].'"'; break;
					case 2: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'База Ордосов '.$base[$x][$y]['name']."\n".'Игрок '.$base[$x][$y]['login']."\n".'уровень '.$base[$x][$y]['constr'].'"'; break;
					case 3: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'База Харконненов '.$base[$x][$y]['name']."\n".'Игрок '.$base[$x][$y]['login']."\n".'уровень '.$base[$x][$y]['constr'].'"'; break;
					case 4: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'База Карину '.$base[$x][$y]['name']."\n".'уровень '.$base[$x][$y]['constr'].'"'; break;
					default: $td_param = '';
				}
			}

			if (isset($army[$x][$y]) && $num = count($army[$x][$y])) {
				if ($num === 1) {
					switch ($army[$x][$y][0]['home']) {
						case 0: $img = '<img src="pics/map_army_o.gif" title="['.$x.':'.$y.']'."\n".'Армия фрименов '.$army[$x][$y][0]['name']."\n".'ранг '.round($army[$x][$y][0]['rang'],1)."\n".'одержано побед: '.$army[$x][$y][0]['wins'].'" >'; break;
						case 1: $img = '<img src="pics/map_army_b.gif" title="['.$x.':'.$y.']'."\n".'Армия Атрейдесов '.$army[$x][$y][0]['name']."\n".'Игрок: '.$army[$x][$y][0]['login']."\n".'ранг '.round($army[$x][$y][0]['rang'],1)."\n".'одержано побед: '.$army[$x][$y][0]['wins'].'" >'; break;
						case 2: $img = '<img src="pics/map_army_g.gif" title="['.$x.':'.$y.']'."\n".'Армия Ордосов '.$army[$x][$y][0]['name']."\n".'Игрок: '.$army[$x][$y][0]['login']."\n".'ранг '.round($army[$x][$y][0]['rang'],1)."\n".'одержано побед: '.$army[$x][$y][0]['wins'].'" >'; break;
						case 3: $img = '<img src="pics/map_army_r.gif" title="['.$x.':'.$y.']'."\n".'Армия Харконненов '.$army[$x][$y][0]['name']."\n".'Игрок: '.$army[$x][$y][0]['login']."\n".'ранг '.round($army[$x][$y][0]['rang'],1)."\n".'одержано побед: '.$army[$x][$y][0]['wins'].'" >'; break;
						case 4: $img = '<img src="pics/map_army_b.gif" title="['.$x.':'.$y.']'."\n".'Армия Карину '.$army[$x][$y][0]['name']."\n".'ранг '.round($army[$x][$y][0]['rang'],1)."\n".'одержано побед: '.$army[$x][$y][0]['wins'].'" >'; break;
						default: $img = '';
					}
				}
				else {
					$armies = array();
					foreach ($army[$x][$y] as $key=>$item) $armies[] = $item['name'];
					$img = '<img src="pics/map_army_w.gif" title="['.$x.':'.$y.']'."\n".'В квадрате армии:'."\n".implode("\n",$armies).'" />';
				}
			}

			$html .= '<td'.$td_param.'>'.$img.'</td>';
		}
		$html .= '</tr>';
	}

	$html = '
<html>
<head><title>Карта Дюны</title><meta http-equiv="Content-Type" content="text/html; charset=windows-1251" /></head>
<style>
td {
	width:'.$cell_size.'px;
	height:'.$cell_size.'px;
}
.b0 {background:url(pics/map_base_o.gif) center center no-repeat;}
.b1 {background:url(pics/map_base_b.gif) center center no-repeat;}
.b2 {background:url(pics/map_base_g.gif) center center no-repeat;}
.b3 {background:url(pics/map_base_r.gif) center center no-repeat;}
.b4 {background:url(pics/map_base_p.gif) center center no-repeat;}
</style>
<p>Полная карта Дюны на '.date("Y-m-d H:i:s").'</p>
<table width="'.($xmax * $cell_size).'" height="'.($ymax * $cell_size).'" cellpadding="0" cellspacing="0" background="pics/map_sand.gif">
'.$html.'
</table>
<p>*наведите курсор мышки на квадрат, чтобы получить подсказку.</p>
</html>
	';

	if (!file_put_contents($res_file,$html)) die('Не удалось записать в файл!');

	echo $html;

	$TIME_END = getmicrotime();
	$TIME_SCRIPT = $TIME_END - $TIME_START;
	echo '<p>loaded: '.$TIME_SCRIPT.'</p>';
?>