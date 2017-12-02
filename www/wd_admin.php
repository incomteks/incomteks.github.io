<?

function ObjList()
{
global $wd_admin_action;

echo "<br><b>Список объектов и атрибутов в базе:</b><br>";
$res=mysql_query("select * from wdobj order by n");
if (@mysql_num_rows($res)>0)
{
echo "<table border=1 bordercolor=#666666 cellpadding=3><tr><td>n</td><td>таблица</td><td>имя объекта</td><td>атрибуты";
if ($wd_admin_action=="tbl") echo "</td><td>Таблица";
echo "</td></tr>";
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$table=mysql_result($res,$i,'table');
$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'name');
echo "<tr valign=top><td>$n</td><td>$table</td><td>$name</td><td>";

$res2=mysql_query("select * from wdatr where up='$n' order by n");
if (@mysql_num_rows($res2)>0) for ($j=0;$j<mysql_num_rows($res2);$j++) echo "<a title='".mysql_result($res2,$j,'name')."'>".mysql_result($res2,$j,'field')."</a> (".mysql_result($res2,$j,'typ').")<br>";
else echo "нет";

if ($wd_admin_action=="tbl")
{
 echo "</td><td align=center><a href=$a?wd_admin_action=tbl_save&wd_n=$n>Создать</a><br><a href=$a?wd_admin_action=tbl_del&wd_n=$n>Удалить</a>";
}

echo "</td></tr>";
}
echo "</table>";
} else echo "В базе не сохранено ни одного объекта";

}

$a=$GLOBALS['SCRIPT_NAME'];

if ($wd_usertyp>=1)
{
if (!isset($wd_admin_action)) $wd_admin_action="menu";

//###################################################################3
if ($wd_admin_action=="menu")
{
echo "<b>Администрирование:</b><br>";
?>
<li><a href=<?=$a?>?wd_admin_action=obj>Объекты</a>
<li><a href=<?=$a?>?wd_admin_action=atr>Атрибуты объектов</a>
<li><a href=<?=$a?>?wd_admin_action=tbl>Создание / удаление таблиц</a>
<?
}

//###################################################################3
if ($wd_admin_action=="obj_save") if ($wd_name!="" && $wd_table!="")
{
echo "<b>Сохранение объекта</b><br><br>";

$x=mysql_query("insert into wdobj(`n`,`table`,`name`,`spec`) values('','$wd_table','$wd_name','$wd_spec')");
if ($x==1) echo "Новый объект сохранен.<br>";
else echo "Ошибка сохранения объекта. ".mysql_error()."<br>";
$wd_admin_action="obj";
} else echo "Не все поля заполнены!<br><a href=$a?wd_admin_action=obj>Попробуйте еще раз.</a>";

//###################################################################3
if ($wd_admin_action=="obj")
{
echo "<b>Объекты</b><br><br>";
?>
<b>Новый объект:</b><br>
<form action=<?$a?>>
<table>
<tr><td>таблица в базе</td><td><input name=wd_table></td></tr>
<tr><td>пользовательское имя</td><td><input name=wd_name></td></tr>
<tr><td>связь с другой таблицей<br>
<small>в формате: up.class.n.name (4 слова через точку, показывает, что поле up для выбраного объекта в форме должно быть взято как
значение из поля со списком в котором будут значения из поля n таблицы class, а текст который вместо n увидит пользователь
будет текстом из поля name той же таблицы class)</td><td><input name=wd_spec></td></tr>
<input type=hidden name=wd_admin_action value=obj_save>
<tr><td colspan=2><input type=submit value=Save></td></tr>
</table>
</form>
<? ObjList(); ?>
<br><a href=<?=$a?>?wd_admin_action=menu>Вернуться</a><br>
<?
}

//###################################################################3
if ($wd_admin_action=="atr_save") if ($wd_name!="" && $wd_field!="")
{
echo "<b>Добавление атрибута</b><br><br>";
$res=mysql_query("select * from wdatr where name='$wd_name' and up='$wd_up'");
if (mysql_num_rows($res)==0)
{
$x=mysql_query("insert into wdatr(`n`,`up`,`typ`,`field`,`name`,`mb`,`adm`,`spec`) values('','$wd_up','$wd_typ','$wd_field','$wd_name','$wd_mb','$wd_adm','0')");

if ($x==1) echo "Атрибут добавлен.<br>";
else echo "Ошибка добавления атрибута. ".mysql_error()."<br>";

$wd_admin_action="atr";
} else echo "Этот атрибут уже создан!<br><a href=$a?wd_admin_action=atr>Попробуйте еще раз.</a>";
} else echo "Не все поля заполнены!<br><a href=$a?wd_admin_action=atr>Попробуйте еще раз.</a>";

//###################################################################3
if ($wd_admin_action=="atr")
{
?>
<b>Атрибуты</b><br><br>
<b>Новый Атрибут:</b><br>
<form action=<?$a?>>
<table>

<tr><td>родительский объект (таблица)</td><td><select name=wd_up>
<?
$res=mysql_query("select * from wdobj order by n desc");
if (@mysql_num_rows($res)>0) for ($i=0;$i<mysql_num_rows($res);$i++)
{
$table=mysql_result($res,$i,'table');
$n=mysql_result($res,$i,'n');
$name=mysql_result($res,$i,'name');

echo "<option value='$n'>($n) $table</option>";
}
?>
</select></td></tr>

<tr><td>тип</td><td><select name=wd_typ>
<option value=TINYTEXT>TINYTEXT - 256 симв.</option>
<option value=TEXT>TEXT - 65535 симв.</option>
<option value=TINYINT>TINYINT - +/- 128</option>
<option value=MEDIUMINT>MEDIUMINT +/- 8388607</option>
<option value=INT>INT +/- 2147483647</option>
</select></td></tr>

<tr><td>имя атрибута в базе</td><td><input name=wd_field></td></tr>
<tr><td>пользовательское имя</td><td><input name=wd_name></td></tr>

<tr><td>обязательное для заполнения поле</td><td><select name=wd_mb>
<option value=0 selected>нет</option>
<option value=1>да</option>
</select></td></tr>


<tr><td>не доступно пользователю</td><td><select name=wd_adm>
<option value=0 selected>доступно пользователю</option>
<option value=1>доступно только администратору</option>
</select></td></tr>


<input type=hidden name=wd_admin_action value=atr_save>
<tr><td colspan=2><input type=submit value=Save></td></tr>
</table>
<i>Автоматически будут созданы атрибуты <b>n</b>, <b>up</b> (ссылка на пользователя), <b>fd</b> (дата создания записи), <b>td</b> (дата до которой запись актуальна).</i>
</form>

<? ObjList(); ?>
<br><a href=<?=$a?>?wd_admin_action=menu>Вернуться</a><br><?
}

//###################################################################3
if ($wd_admin_action=="tbl_save")
{
echo "<b>Сохранение таблиц</b><br><br>";
echo "Создается таблица для объекта номер <b>$wd_n</b><br>";

$res=mysql_query("select * from wdobj where n='$wd_n'");
$wd_table=mysql_result($res,0,'table');
$wd_name=mysql_result($res,0,'name');
echo "Имя таблицы <b>$wd_table</b>, имя объекта <b>$wd_name</b><br>";

$string="CREATE TABLE `obj_$wd_table` (
`n` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
`wd_up` MEDIUMINT NOT NULL,
`wd_fd` DATETIME NOT NULL,
`wd_td` DATETIME NOT NULL,
`wd_cd` DATETIME NOT NULL,
";

$res=mysql_query("select * from wdatr where up='$wd_n'");
$wd_num=mysql_numrows($res);
if ($wd_num!=0) 
for ($i=0;$i<$wd_num;$i++)
{
$wd_field=mysql_result($res,$i,'field');
$wd_typ=mysql_result($res,$i,'typ');

$string.="`$wd_field` $wd_typ NOT NULL,
";
}

$string.="PRIMARY KEY ( `n` ) ,
INDEX ( `wd_up` ) 
) CHARACTER SET = cp1251;";

echo "Строка запроса:<br><br><small><i>".nl2br($string)."</i></small><br><br>";

$x=mysql_query($string);
if ($x==1) echo "<b>Ок!</b>";
else echo "<b>Ошибка</b> ".mysql_error();

?><br><a href=<?=$a?>?wd_admin_action=tbl>Вернуться</a><br><?
}

//###################################################################3
if ($wd_admin_action=="tbl_del")
{
echo "<b>Удаление таблицы</b><br><br>";
echo "Удаляется таблица номер <b>$wd_n</b><br>";

$res=mysql_query("select * from wdobj where n='$wd_n'");
$wd_table=mysql_result($res,0,'table');
$wd_name=mysql_result($res,0,'name');
echo "Имя таблицы <b>$wd_table</b>, имя объекта <b>$wd_name</b><br>";

$string="DROP TABLE `obj_$wd_table`";

$x=mysql_query($string);
if ($x==1) echo "<b>Ок!</b>";
else echo "<b>Ошибка</b> ".mysql_error();

?><br><a href=<?=$a?>?wd_admin_action=tbl>Вернуться</a><br><?
}


//###################################################################3
if ($wd_admin_action=="tbl")
{
echo "<b>Создание таблиц</b><br><br>";

ObjList();

?><br><a href=<?=$a?>?wd_admin_action=menu>Вернуться</a><br><?
}

} else echo "Доступ запрещен.";
?>