<?
extract($_GET);
extract($_POST);
?>
<script type="text/javascript" language="JavaScript" 
  src="lib/JsHttpRequest/JsHttpRequest.js"></script>
<script type="text/javascript" language="JavaScript">
function Ywindow()
{
	var scrollY = 0;
	if ( document.documentElement && document.documentElement.scrollTop )
	{
		scrollY = document.documentElement.scrollTop;
	}
	else if ( document.body && document.body.scrollTop )
	{
		scrollY = document.body.scrollTop;
	}
	else if ( window.pageYOffset )
	{
		scrollY = window.pageYOffset;
	}
	else if ( window.scrollY )
	{
		scrollY = window.scrollY;
	}
	return scrollY;
}
function loaddiv(n){
	this.divobj=document.getElementById('ll');
	
	if(n==1) {
	var my_width  = 0;
	var my_height = 0;
	if ( typeof( window.innerWidth ) == 'number' )
	{
		my_width  = window.innerWidth;
		my_height = window.innerHeight;
	}
	else if ( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) )
	{
		my_width  = document.documentElement.clientWidth;
		my_height = document.documentElement.clientHeight;
	}
	else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) )
	{
		my_width  = document.body.clientWidth;
		my_height = document.body.clientHeight;
	}
	this.divobj.style.position = 'absolute';
	this.divobj.style.zIndex   = 99;
	var divheight = parseInt( this.divobj.style.Height );
	var divwidth  = parseInt( this.divobj.style.Width );
	divheight = divheight ? divheight : 50;
	divwidth  = divwidth  ? divwidth  : 200;
	var scrolly = Ywindow();
	var setX = ( my_width  - divwidth  ) / 2;
	var setY = ( my_height - divheight ) / 2 + scrolly;
	setX = ( setX < 0 ) ? 0 : setX;
	setY = ( setY < 0 ) ? 0 : setY;
	this.divobj.style.left = setX + "px";
	this.divobj.style.top  = setY + "px";
	this.divobj.style.display  = 'block';
}
	if(n==0) {
		this.divobj.style.display  = 'none';
	}
	//alert('a');
}
function upinfo() {
    var info = new JsHttpRequest();
    info.onreadystatechange = function() {
        if (info.readyState == 4) {
            document.getElementById('info').innerHTML = info.responseText;
            loaddiv(0);
        }
    }
    info.open(null, 'ajaxinfo.php', true);
    info.send( {n:1} );
}
function build(elem,value,s) {
    var build = new JsHttpRequest();
    build.onreadystatechange = function() {
        if (build.readyState == 4) {
            document.getElementById(elem.id).innerHTML = build.responseJS.result;
            upinfo();
        }
    }
    build.open(null, 'ajaxbuild.php', true);
    build.send( {n: value, stop: s} );
    loaddiv(1);
}
function zakaz(elem,value,s) {
    var zakaz = new JsHttpRequest();
    zakaz.onreadystatechange = function() {
        if (zakaz.readyState == 4) {
            document.getElementById(elem.id).innerHTML = zakaz.responseJS.result;
            upinfo();
        }
    }
    zakaz.open(null, 'ajaxzakaz.php', true);
    zakaz.send( {n: value, col: s} );
    loaddiv(1);
}
function movearmy(elem,army_,shift_,dir_) {
    var movearmy = new JsHttpRequest();
    movearmy.onreadystatechange = function() {
        if (movearmy.readyState == 4) {
            document.getElementById(elem.id).innerHTML = movearmy.responseJS.result;
            upinfo();
        }
    }
    movearmy.open(null, 'ajaxmovearmy.php', true);
    movearmy.send( {army: army_, shift: shift_,direction: dir_} );
    loaddiv(1);
}
function setprior(elem,i,pr) {
    var setpr = new JsHttpRequest();
    setpr.onreadystatechange = function() {
        if (setpr.readyState == 4) {
            document.getElementById(elem.id).innerHTML = setpr.responseJS.result;
        }
        loaddiv(0);
    }
    setpr.open(null, 'ajaxsetpr.php', true);
    setpr.send( {n: i, p: pr} );
    loaddiv(1);
}
</script>
<?php
echo "<script language=javascript>
function confdel(url){
	var conf=confirm('Вы действительно хотите удалить все сообщения в этом разделе?');
	if(conf) document.location=url;
} 
function confdel_one(url){
	var conf=confirm('Вы действительно хотите удалить это сообщение?');
	if(conf) document.location=url;
} 
</script>
";
?>
<div id='ll' style='display:none;font-family: Verdana;font-size: 11px;width:200px;height:50px;background:#e5ac77;padding:10px;text-align:center;border:1px solid #000'><div style='font-weight:bold' id='loading-layer-text'>Отправка запроса. Пожалуйста, подождите...</div><br><img src='/pics/loader.gif'  border='0'></div>