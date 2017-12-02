<? include "header.php"; ?>
<script type="text/javascript" src="/jquery.js"></script>
<script type="text/javascript" src="/swfobject.js"></script>
<script language="javascript">
$(document).ready(function() {
//swfobject.embedSWF("/uppod.swf", "player", "500", "375", "9.0.0", false, {st:'/uppod.txt',file:'/dune.flv',allowFullScreen:'true',allowScriptAccess:'always'}, {wmode:'transparent'});


var flashvars = {st:"/uppod.txt",file:"/dune.flv"};
var params = {bgcolor:"#fcbc80", allowFullScreen:"true", allowScriptAccess:"always"};
var attributes = {id:"player",name:"player"};
swfobject.embedSWF("/uppod.swf", "player", "500", "375", "9.0.0",false,flashvars, params,attributes);
});
</script>
<table width=100%>

<tr><td <?=$paramhead?>><b>Дюна / Dune (1984)</b></td></tr>

<tr valign=top>
<td>
	<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
		<tr valign="top">
			<td><img width="362" height="500" border="0" src="/pics/film_poster.jpg" /></td>
			<td width="100%" style="padding-left:15px;">
				<div><strong>Название:</strong>  Дюна *Расширенная версия*</div>
				<div><strong>Оригинальное название:</strong> Dune *Extended Edition*</div>
				<div><strong>Год выхода:</strong> 1984</div>
				<div><strong>Жанр:</strong> Фантастика, Боевик, Приключения</div>
				<div><strong>Продолжительность:</strong> 2:56</div>
				<div><strong>Режиссер:</strong> Дэвид Линч /David Lynch/</div>
				<div><strong>В ролях:</strong> Кайл МакЛаклэн /Kyle MacLachlan/, Стинг /Sting/, Макс Фон Сюдов /Max von Sydow/, Брэд Дуриф /Brad Dourif/, Юрген Прохнов /Jurgen Prochnow/, Шон Янг /Sean Young/</div>
				<div>&nbsp;</div>
				<div id="player" name="player"></div>
			</td>
		</tr>
	</table>
	<h2>О фильме</h2>
	<p>10191 год. В битву за планету пустыню - Дюну - вовлечены главные империи Галактики. Космос становится ареной ожесточенных сражений, враждующие стороны опутаны сетью интриг и предательства. Будущее Галактики зависит от мессии - идеального воина и ясновидящего, способного возглавить поход против сил зла. И Мессия является. Им становится юный Пол Атридес, сын герцога Лито, предательски убитого Харконненами с одобрения Императора. Полу предстоит великая миссия, которая навсегда изменит судьбу всей галактической империи...</p>
</td>
</tr>
</table>

<? include "footer.php"; ?>

