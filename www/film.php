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

<tr><td <?=$paramhead?>><b>���� / Dune (1984)</b></td></tr>

<tr valign=top>
<td>
	<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:10px;">
		<tr valign="top">
			<td><img width="362" height="500" border="0" src="/pics/film_poster.jpg" /></td>
			<td width="100%" style="padding-left:15px;">
				<div><strong>��������:</strong>  ���� *����������� ������*</div>
				<div><strong>������������ ��������:</strong> Dune *Extended Edition*</div>
				<div><strong>��� ������:</strong> 1984</div>
				<div><strong>����:</strong> ����������, ������, �����������</div>
				<div><strong>�����������������:</strong> 2:56</div>
				<div><strong>��������:</strong> ����� ���� /David Lynch/</div>
				<div><strong>� �����:</strong> ���� ��������� /Kyle MacLachlan/, ����� /Sting/, ���� ��� ����� /Max von Sydow/, ���� ����� /Brad Dourif/, ����� ������� /Jurgen Prochnow/, ��� ��� /Sean Young/</div>
				<div>&nbsp;</div>
				<div id="player" name="player"></div>
			</td>
		</tr>
	</table>
	<h2>� ������</h2>
	<p>10191 ���. � ����� �� ������� ������� - ���� - ��������� ������� ������� ���������. ������ ���������� ������ ������������ ��������, ���������� ������� ������� ����� ������ � �������������. ������� ��������� ������� �� ������ - ���������� ����� � ������������, ���������� ���������� ����� ������ ��� ���. � ������ ��������. �� ���������� ���� ��� �������, ��� ������� ����, ������������ ������� ������������ � ��������� ����������. ���� ��������� ������� ������, ������� �������� ������� ������ ���� ������������� �������...</p>
</td>
</tr>
</table>

<? include "footer.php"; ?>

