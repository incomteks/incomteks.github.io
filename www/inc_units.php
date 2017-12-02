<?
extract($_GET);
extract($_POST);
if (!isset($wd_base) && isset($wd_usern))
{
$res=mysql_query("select * from `base` where `up`='$wd_usern' limit 1");
$max=@mysql_num_rows($res);

if ($max==1) $wd_base=@mysql_result($res,0,'n');
}

if (isset($wd_base))
{
$res=mysql_query("select * from `base` where `n`='$wd_base' and `up`='$wd_usern'");

$res_name=@mysql_result($res,0,'name');
$res_x=@mysql_result($res,0,'x');
$res_y=@mysql_result($res,0,'y');


$res_cred=@mysql_result($res,0,'cred');
$res_stone=@mysql_result($res,0,'stone');
$res_spice=@mysql_result($res,0,'spice');

$lvl[1]=@mysql_result($res,0,'place');

$lvl[2]=@mysql_result($res,0,'constr');

$lvl[3]=@mysql_result($res,0,'wind');
$lvl[4]=@mysql_result($res,0,'refin');
$lvl[5]=@mysql_result($res,0,'silo');
$lvl[6]=@mysql_result($res,0,'bar');
$lvl[7]=@mysql_result($res,0,'fact');
$lvl[8]=@mysql_result($res,0,'tech');
$lvl[9]=@mysql_result($res,0,'cosmo');
$lvl[10]=@mysql_result($res,0,'palace');

$lvl[11]=@mysql_result($res,0,'wall');
$lvl[12]=@mysql_result($res,0,'tower');
$lvl[13]=@mysql_result($res,0,'rtower');

$lvl[21]=@mysql_result($res,0,'harv');
$lvl[22]=@mysql_result($res,0,'mobconst');

$lvl[23]=@mysql_result($res,0,'linf');
$lvl[24]=@mysql_result($res,0,'hinf');

$lvl[25]=@mysql_result($res,0,'tank');
$lvl[26]=@mysql_result($res,0,'rtank');

$lvl[27]=@mysql_result($res,0,'spec1');
$lvl[28]=@mysql_result($res,0,'spec2');
$lvl[29]=@mysql_result($res,0,'spec3');

$lvl[30]=@mysql_result($res,0,'hod');
$lvl[31]=@mysql_result($res,0,'trade');

//Заполняем приоритеты
$prior[1]=@mysql_result($res,0,'prplace');
$prior[2]=@mysql_result($res,0,'prconstr');
$prior[3]=@mysql_result($res,0,'prwind');
$prior[4]=@mysql_result($res,0,'prrefin');
$prior[5]=@mysql_result($res,0,'prsilo');
$prior[6]=@mysql_result($res,0,'prbar');
$prior[7]=@mysql_result($res,0,'prfact');
$prior[8]=@mysql_result($res,0,'prtech');
$prior[9]=@mysql_result($res,0,'prcosmo');
$prior[10]=@mysql_result($res,0,'prpalace');
$prior[11]=@mysql_result($res,0,'prwall');
$prior[12]=@mysql_result($res,0,'prtower');
$prior[13]=@mysql_result($res,0,'prrtower');
$prior[21]=@mysql_result($res,0,'prharv');
$prior[22]=@mysql_result($res,0,'prmobconst');
$prior[23]=@mysql_result($res,0,'prlinf');
$prior[24]=@mysql_result($res,0,'prhinf');
$prior[25]=@mysql_result($res,0,'prtank');
$prior[26]=@mysql_result($res,0,'prrtank');
$prior[30]=@mysql_result($res,0,'prhod');
$prior[31]=@mysql_result($res,0,'prtrade');



$bar=@mysql_result($res,0,'bar');
$fact=@mysql_result($res,0,'fact');
$refin=@mysql_result($res,0,'refin');

$rest=mysql_query("select * from `tech` where `up`='$wd_usern'");

$t_att=@mysql_result($rest,0,'att');
$t_arm=@mysql_result($rest,0,'arm');
$t_engine=@mysql_result($rest,0,'engine');
$t_build=@mysql_result($rest,0,'build');
$t_harv=@mysql_result($rest,0,'harv');
$t_hod=@mysql_result($rest,0,'hod');
$t_orb=@mysql_result($rest,0,'orb');
$t_spy=@mysql_result($rest,0,'spy');

unset ($stone);
unset ($cred);
unset ($site);
unset ($days);
unset ($name);

include "inc_units_dsc.php";

$sumb=$lvl[2]+$lvl[12]+$lvl[13]+$lvl[31];
$sumu=0;

for ($i=4;$i<=10;$i++) $sumb=$sumb+$lvl[$i];
for ($i=21;$i<=26;$i++) $sumu=$sumu+$lvl[$i];

}
?>