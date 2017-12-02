<?
extract($_GET);
extract($_POST);
// Настройки

$backmail="support@localhost";
$backmail_name="Администрация онлайн игры ДЮНА";
$tablelistprop="border=1";
$listperpage=10;
$wd_textarea_params=" rows=10 cols=40 ";
$wd_input_params=" style=\"width:200px;\" ";

// #####################################
$a=$_SERVER['SCRIPT_NAME'];


// #####################################
function FormNew($table)
{
global $a;
global $wd_usertyp;
global $wd_usern;
global $wd_formnew_mode;
global $td;
global $wd_input_params;
global $wd_textarea_params;


if ($wd_formnew_mode!="save")
{
$res=mysql_query("select * from wdobj where `table`='$table'");

if (@mysql_num_rows($res)==1) {
$n=mysql_result($res,0,'n');
$name=mysql_result($res,0,'name');
$spec=mysql_result($res,0,'spec');

if (isset($spec))
{
$sp=explode(".",$spec,4);
$spec1=$sp[0];
$spec2=$sp[1];
$spec3=$sp[2];
$spec4=$sp[3];
}

echo "<b>$name</b><br>создание новой записи<br>";
?>
<form action=<?=$a?> method=post>
<table>
<?
$res=mysql_query("select * from wdatr where up='$n' order by n");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$fname=mysql_result($res,$i,'name');
$ffield=mysql_result($res,$i,'field');
$fadm=mysql_result($res,$i,'adm');
$ftyp=mysql_result($res,$i,'typ');
$fmb=mysql_result($res,$i,'mb');

if (($fadm==0) or (($fadm==1) and ($wd_usertyp>0)))
{
echo "<tr valign=top><td align=right>$fname";

if ($fmb==1) echo "<font color=#ff0000>*</font>";
if ($fadm==1) echo "<font color=#0000ff>*</font>";

if ($ffield!=$spec1)
{
if ($ftyp!="TEXT") echo "</td><td><input type=input name='wd_$ffield' $wd_input_params></td></tr>";
else echo "</td><td><textarea name='wd_$ffield' $wd_textarea_params ></textarea></td></tr>";
}
else
{
echo "</td><td><select name='wd_$ffield'>";

if (strpos($spec2,"wd")==0) $res2=mysql_query("select `$spec3`,`$spec4` from `$spec2` order by `$spec3`");
else $res2=mysql_query("select `$spec3`,`$spec4` from `obj_$spec2` order by `$spec3`");

for ($j=0;$j<mysql_num_rows($res2);$j++)
{
$spec3v=mysql_result($res2,$j,$spec3);
$spec4v=mysql_result($res2,$j,$spec4);

echo "<option value='$spec3v'>$spec4v</option>";
}
echo "</select></td></tr>";
}


}
}
?>
<tr><td colspan=2><font color=#ff0000>*</font> поля обязательные для заполнения</td></tr>
<tr><td colspan=2>
<input type=hidden name=wd_formnew_mode value=save>
<input type=submit value=Сохранить></td></tr>
</table>
</form>
<?
} else echo "Неверное имя объекта.";
}
else
{
// СОХРАНЕНИЕ ДАННЫХ
$string="insert into `obj_$table`(n,wd_up,wd_fd,wd_td,wd_cd";

$fd=date("Y-m-d H:i:s");
if (!isset($td)) $td="2200-01-01 00:00:00";
$cd=date("Y-m-d H:i:s");

$res=mysql_query("select * from wdobj where `table`='$table'");

if (@mysql_num_rows($res)==1)
{
$n=mysql_result($res,0,'n');
$name=mysql_result($res,0,'name');

$res=mysql_query("select * from wdatr where up='$n' order by n");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$ffield=mysql_result($res,$i,'field');
$string.=",`$ffield`";
}
$string.=") values('','$wd_usern','$fd','$td','$cd'";

$error="";

for ($i=0;$i<mysql_num_rows($res);$i++)
{
$ffield=mysql_result($res,$i,'field');
$fnam=mysql_result($res,$i,'name');
$fmb=mysql_result($res,$i,'mb');
$name="wd_$ffield";
global $$name;

if ($fmb==1 && $$name=="") $error.="<br>Ошибка! Не заполнено обязательное поле <b>$fnam</b>";

$string.=",'".$$name."'";
}

$string.=")";
//echo $string."<br>";
if ($error=="") 
{
$x=mysql_query($string);

if ($x==1) echo "<br>Информация успешно сохранена!";
else echo "<br>".mysql_error();
} echo $error."<br>";
echo "<br><br><a href=$a>Вернуться</a>";
}
}
}

// #####################################
function ListTable($table,$param="")
{

global $a;
global $wd_page;
global $wd_usertyp;
global $wd_usern;
global $tablelistprop;
global $listperpage;
global $wd_list_action;
global $wd_nn;

if ($wd_list_action!="edit")
{

if ($wd_list_action=="del")
{
$x=mysql_query("delete from `obj_$table` where n=$wd_nn");

if ($x==1) echo "Информация успешно удалена!";
else echo "Ошибка удаления".mysql_error();
echo "<br>";
}

if (!isset($wd_page) || $wd_page=="") $wd_page=1;

$res=mysql_query("select * from wdobj where `table`='$table'");

if (@mysql_num_rows($res)==1)
{
$n=mysql_result($res,0,'n');
$name=mysql_result($res,0,'name');
$spec=mysql_result($res,0,'spec');

if (isset($spec))
{
$sp=explode(".",$spec,4);
$spec1=$sp[0];
$spec2=$sp[1];
$spec3=$sp[2];
$spec4=$sp[3];
}

$res=mysql_query("select count(*) from `obj_$table` $param");
$cnt=@mysql_result($res,0,'count(*)');
$start=$listperpage*($wd_page-1);

echo "<b>$name</b> (всего <b>$cnt</b> записей)<br>Страница <b>$wd_page</b>, навигация: ";

for ($i=1;$i<=ceil($cnt/$listperpage);$i++) echo " <a href=$a?wd_page=$i>$i</a> ";


echo "<table width=100% $tablelistprop><tr><th>N</th>";

$res=mysql_query("select * from wdatr where up='$n' order by n");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$name=mysql_result($res,$i,'name');
$field[$i]=mysql_result($res,$i,'field');
$fadm[$i]=mysql_result($res,$i,'adm');
if (($fadm[$i]==0) or (($fadm[$i]==1) and ($wd_usertyp>0))) echo "<th>$name</th>";
}
if ($wd_usertyp>0) echo "<th>Дата последнего изменения</th>";
if ($wd_usertyp>0) echo "<th>Действия</th>";
echo "</tr>";

$res=mysql_query("select * from `obj_$table` $param order by n limit $start, $listperpage");
for ($j=0;$j<@mysql_num_rows($res);$j++)
{
$jj=$j+1;

$n=mysql_result($res,$j,'n');
$up=mysql_result($res,$j,'wd_up');

$res2=mysql_query("select login from wduser where n=$up");
$login=@mysql_result($res2,0,'login');

if ($login=="") $login="-";

$fd=mysql_result($res,$j,'wd_fd');
$td=mysql_result($res,$j,'wd_td');
$cd=mysql_result($res,$j,'wd_cd');

echo "<tr><td><a title='Системный номер: $n
Запись создана: $login'>$jj</a></td>";

for ($k=0;$k<$i;$k++)
{
if (($fadm[$k]==0) or (($fadm[$k]==1) and ($wd_usertyp>0)))
{
	echo "<td>";
	{
	if ($field[$k]!=$spec1) echo mysql_result($res,$j,$field[$k]);
	else
		{
		$var=mysql_result($res,$j,$field[$k]);

if (strpos($spec2,"wd")==0) $res2=mysql_query("select `$spec3`,`$spec4` from `$spec2` where `$spec3`='$var' order by `$spec3`");
else $res2=mysql_query("select `$spec3`,`$spec4` from `obj_$spec2` where `$spec3`='$var' order by `$spec3`");

		echo mysql_result($res2,0,$spec4);
		}
	}
	echo "</td>";
}
}
if ($wd_usertyp>0)
{
echo "<td><a title='от $fd до $td'>$cd</a></td><td align=center> ";
if ($up==$wd_usern || $wd_usertyp==2)
{
echo "<a href=$a?wd_page=$wd_page&wd_list_action=edit&wd_nn=$n>редактировать</a><br>";
echo "<a href=$a?wd_page=$wd_page&wd_list_action=del&wd_nn=$n>удалить</a>";
} else echo "-";
echo "</td>";
}
echo "</tr>";

}
echo "</table>";

}
} else FormEdit($table,$wd_nn);
}

// #####################################
function FormEdit($table,$n)
{
global $a;
global $wd_usertyp;
global $wd_usern;
global $wd_formedit_mode;
global $td;
global $wd_input_params;
global $wd_textarea_params;

$ncef=$n;

if ($wd_formedit_mode!="save")
{
$res=mysql_query("select * from wdobj where `table`='$table'");

$resx=mysql_query("select * from `obj_$table` where `n`='$n'");

if (@mysql_num_rows($res)==1) {
$n=mysql_result($res,0,'n');
$name=mysql_result($res,0,'name');
$spec=mysql_result($res,0,'spec');

if (isset($spec))
{
$sp=explode(".",$spec,4);
$spec1=$sp[0];
$spec2=$sp[1];
$spec3=$sp[2];
$spec4=$sp[3];
}

echo "<b>$name</b><br>Изменение записи<br>";
?>
<form action=<?=$a?> method=post>
<table>
<?
$res=mysql_query("select * from wdatr where up='$n' order by n");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$fname=mysql_result($res,$i,'name');
$ffield=mysql_result($res,$i,'field');
$fadm=mysql_result($res,$i,'adm');
$fmb=mysql_result($res,$i,'mb');
$ftyp=mysql_result($res,$i,'typ');
$value=mysql_result($resx,0,$ffield);

if (($fadm==0) or (($fadm==1) and ($wd_usertyp>0)))
{
echo "<tr valign=top><td align=right>$fname";

if ($fmb==1) echo "<font color=#ff0000>*</font>";
if ($fadm==1) echo "<font color=#0000ff>*</font>";

if ($ffield!=$spec1)
{
if ($ftyp!="TEXT")  echo "</td><td><input type=input name='wd_$ffield' value='$value' $wd_input_params></td></tr>";
else echo "</td><td><textarea name='wd_$ffield' $wd_textarea_params>$value</textarea></td></tr>";
}
else
{
echo "</td><td><select name='wd_$ffield'>";

if (strpos($spec2,"wd")==0) $res2=mysql_query("select `$spec3`,`$spec4` from `$spec2` order by `$spec3`");
else $res2=mysql_query("select `$spec3`,`$spec4` from `obj_$spec2` order by `$spec3`");

for ($j=0;$j<mysql_num_rows($res2);$j++)
{
$spec3v=mysql_result($res2,$j,$spec3);
$spec4v=mysql_result($res2,$j,$spec4);

echo "<option value='$spec3v'";
if ($value==$spec3v) echo " selected ";
echo ">$spec4v</option>";
}
echo "</select></td></tr>";
}


}
}
?>
<tr><td colspan=2><font color=#ff0000>*</font> поля обязательные для заполнения</td></tr>
<tr><td colspan=2>
<input type=hidden name=wd_nn value=<?=$ncef?>>
<input type=hidden name=wd_list_action value=edit>
<input type=hidden name=wd_formedit_mode value=save>
<input type=submit value=Сохранить></td></tr>
</table>
</form>
<?
} else echo "Неверное имя объекта.";
}
else
{
// СОХРАНЕНИЕ ДАННЫХ
$cd=date("Y-m-d H:i:s");

$string="update `obj_$table` set `wd_cd`='$cd'";

$res=mysql_query("select * from wdobj where `table`='$table'");

if (@mysql_num_rows($res)==1)
{
$n=mysql_result($res,0,'n');
$name=mysql_result($res,0,'name');

$res=mysql_query("select * from wdatr where up='$n'");

for ($i=0;$i<mysql_num_rows($res);$i++)
{
$ffield=mysql_result($res,$i,'field');
$fnam=mysql_result($res,$i,'name');

$fmb=mysql_result($res,$i,'mb');
$name="wd_$ffield";

$string.=",`$ffield`='".$GLOBALS[$name]."'";

if ($fmb==1 && $GLOBALS[$name]=="") $error.="<br>Ошибка! Не заполнено обязательное поле <b>$fnam</b>";
}
$string.=" WHERE n='$ncef'";

//echo "<br>$string";
if ($error=="")
{
$x=mysql_query($string);

if ($x==1) echo "<br>Информация успешно сохранена!";
else echo "<br>".mysql_error();
}  echo $error."<br>";
echo "<br><br><a href=$a>Вернуться</a>";
}
}
}


// #####################################
function LVC_Start($table,$param="")
{

global $a;
global $wd_page;
global $wd_usertyp;
global $wd_usern;
global $tablelistprop;
global $listperpage;
global $wd_list_action;
global $wd_nn;

if ($wd_list_action!="edit")
{

if ($wd_list_action=="del")
{
$x=mysql_query("delete from `obj_$table` where n=$wd_nn");

if ($x==1) echo "Информация успешно удалена!";
else echo "Ошибка удаления".mysql_error();
echo "<br>";
}

if (!isset($wd_page) || $wd_page=="") $wd_page=1;

$res=mysql_query("select * from wdobj where `table`='$table'");

if (@mysql_num_rows($res)==1)
{
$n=mysql_result($res,0,'n');
$name=mysql_result($res,0,'name');
$spec=mysql_result($res,0,'spec');

if (isset($spec))
{
$sp=explode(".",$spec,4);
$spec1=$sp[0];
$spec2=$sp[1];
$spec3=$sp[2];
$spec4=$sp[3];
}

$res=mysql_query("select count(*) from `obj_$table` $param");
$cnt=@mysql_result($res,0,'count(*)');
$start=$listperpage*($wd_page-1);

echo "<b>$name</b> (всего <b>$cnt</b> записей)<br>Страница <b>$wd_page</b>, навигация: ";

for ($i=1;$i<=ceil($cnt/$listperpage);$i++) echo " <a href=$a?wd_page=$i>$i</a> ";

echo "<br><br>";

$res=mysql_query("select * from wdatr where up='$n' order by n");
for ($i=0;$i<mysql_num_rows($res);$i++)
{
$name=mysql_result($res,$i,'name');
$field[$i]=mysql_result($res,$i,'field');
$fadm[$i]=mysql_result($res,$i,'adm');
}

$res=mysql_query("select * from `obj_$table` $param limit $start, $listperpage");

// НАЧАЛО ЦИКЛА 

for ($j=0;$j<@mysql_num_rows($res);$j++)
{
$jj=$j+1;

$mass[$j]['n']=mysql_result($res,$j,'n');
$mass[$j]['wd_up']=mysql_result($res,$j,'wd_up');
$ma=$mass[$j]['wd_up'];

$res2=mysql_query("select login from wduser where n=$ma");
$mass[$j]['wd_login']=@mysql_result($res2,0,'login');

if ($login=="") $login="-";

$mass[$j]['wd_fd']=mysql_result($res,$j,'wd_fd');
$mass[$j]['wd_td']=mysql_result($res,$j,'wd_td');
$mass[$j]['wd_cd']=mysql_result($res,$j,'wd_cd');

for ($k=0;$k<$i;$k++)
{

if (($fadm[$k]==0) or (($fadm[$k]==1) and ($wd_usertyp>0)))
{
	if ($field[$k]!=$spec1) $aaa=mysql_result($res,$j,$field[$k]);
	else
		{
		$var=mysql_result($res,$j,$field[$k]);

if (strpos($spec2,"wd")==0) $res2=mysql_query("select `$spec3`,`$spec4` from `$spec2` where `$spec3`='$var' order by `$spec3`");
else $res2=mysql_query("select `$spec3`,`$spec4` from `obj_$spec2` where `$spec3`='$var' order by `$spec3`");

		$aaa=mysql_result($res2,0,$spec4);
		}
$mass[$j][$field[$k]]=$aaa;
}
}

}
}

return $mass;

} else FormEdit($table,$wd_nn);
}
?>