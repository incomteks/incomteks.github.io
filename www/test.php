<?
$ema = "vit@localhost";
$message = "�����������, �� ������������������ � ������ ���� ����2. ����� ������ ������ ��� ���������� ������������ ��� �����. \n��� ��������� �������� �� ���� ������:\nhttp://localhost/index.php?activeme=$log � ������� ���:\n";
$message.="111\n\n\n";
$message.="� ��������� ������������� ������� localhost";
$subject = "���������";
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
  echo "������ ��� �������� ���� ���������. ������ �� ������ ��� ���������� ������ ���������.";
} else {
echo "����������� ������ �������.<br>�� ������ ��� ������ ����, ��� ���������� ������������ ��� �����. �� ��� ����������� �����: $ema ������ ��� ���������, ����������, ������� ��� �����:";
echo "<a href=http://localhost/index.php?activeme=$log>���������</a><h2>���� ��� �� ����� �� ������ ������ ������� ���� ���: $actcode ��� ���������.</h2>";
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

// ���������� � �������� MySQL

if(!mysql_connect($sys_dbhost,$sys_dbuser,$sys_dbpass))
{
   echo "�� ���� ����������� � ����� !<br>";
   echo mysql_error();
   exit;
}
// else echo "���������� � ����� ������ ������� !<br>";

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
					case 0: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'���� �������� '.$base[$x][$y]['name'].'"'; break;
					case 1: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'���� ���������� '.$base[$x][$y]['name']."\n".'����� '.$base[$x][$y]['login']."\n".'������� '.$base[$x][$y]['constr'].'"'; break;
					case 2: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'���� ������� '.$base[$x][$y]['name']."\n".'����� '.$base[$x][$y]['login']."\n".'������� '.$base[$x][$y]['constr'].'"'; break;
					case 3: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'���� ����������� '.$base[$x][$y]['name']."\n".'����� '.$base[$x][$y]['login']."\n".'������� '.$base[$x][$y]['constr'].'"'; break;
					case 4: $td_param = ' class="b'.$base[$x][$y]['home'].'" title="['.$x.':'.$y.']'."\n".'���� ������ '.$base[$x][$y]['name']."\n".'������� '.$base[$x][$y]['constr'].'"'; break;
					default: $td_param = '';
				}
			}

			if (isset($army[$x][$y]) && $num = count($army[$x][$y])) {
				if ($num === 1) {
					switch ($army[$x][$y][0]['home']) {
						case 0: $img = '<img src="pics/map_army_o.gif" title="['.$x.':'.$y.']'."\n".'����� �������� '.$army[$x][$y][0]['name']."\n".'���� '.round($army[$x][$y][0]['rang'],1)."\n".'�������� �����: '.$army[$x][$y][0]['wins'].'" >'; break;
						case 1: $img = '<img src="pics/map_army_b.gif" title="['.$x.':'.$y.']'."\n".'����� ���������� '.$army[$x][$y][0]['name']."\n".'�����: '.$army[$x][$y][0]['login']."\n".'���� '.round($army[$x][$y][0]['rang'],1)."\n".'�������� �����: '.$army[$x][$y][0]['wins'].'" >'; break;
						case 2: $img = '<img src="pics/map_army_g.gif" title="['.$x.':'.$y.']'."\n".'����� ������� '.$army[$x][$y][0]['name']."\n".'�����: '.$army[$x][$y][0]['login']."\n".'���� '.round($army[$x][$y][0]['rang'],1)."\n".'�������� �����: '.$army[$x][$y][0]['wins'].'" >'; break;
						case 3: $img = '<img src="pics/map_army_r.gif" title="['.$x.':'.$y.']'."\n".'����� ����������� '.$army[$x][$y][0]['name']."\n".'�����: '.$army[$x][$y][0]['login']."\n".'���� '.round($army[$x][$y][0]['rang'],1)."\n".'�������� �����: '.$army[$x][$y][0]['wins'].'" >'; break;
						case 4: $img = '<img src="pics/map_army_b.gif" title="['.$x.':'.$y.']'."\n".'����� ������ '.$army[$x][$y][0]['name']."\n".'���� '.round($army[$x][$y][0]['rang'],1)."\n".'�������� �����: '.$army[$x][$y][0]['wins'].'" >'; break;
						default: $img = '';
					}
				}
				else {
					$armies = array();
					foreach ($army[$x][$y] as $key=>$item) $armies[] = $item['name'];
					$img = '<img src="pics/map_army_w.gif" title="['.$x.':'.$y.']'."\n".'� �������� �����:'."\n".implode("\n",$armies).'" />';
				}
			}

			$html .= '<td'.$td_param.'>'.$img.'</td>';
		}
		$html .= '</tr>';
	}

	$html = '
<html>
<head><title>����� ����</title><meta http-equiv="Content-Type" content="text/html; charset=windows-1251" /></head>
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
<p>������ ����� ���� �� '.date("Y-m-d H:i:s").'</p>
<table width="'.($xmax * $cell_size).'" height="'.($ymax * $cell_size).'" cellpadding="0" cellspacing="0" background="pics/map_sand.gif">
'.$html.'
</table>
<p>*�������� ������ ����� �� �������, ����� �������� ���������.</p>
</html>
	';

	if (!file_put_contents($res_file,$html)) die('�� ������� �������� � ����!');

	echo $html;

	$TIME_END = getmicrotime();
	$TIME_SCRIPT = $TIME_END - $TIME_START;
	echo '<p>loaded: '.$TIME_SCRIPT.'</p>';
?>