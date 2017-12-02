<?
include "connect.php";

mysql_query("delete from `wduser` where n!=1 and n!=6");


mysql_query("delete from `base`");
mysql_query("delete from `army`");
mysql_query("delete from `mes`");
mysql_query("delete from `space`");
mysql_query("delete from `hod`");
mysql_query("delete from `al`");
mysql_query("delete from `bild`");
mysql_query("delete from `move`");
mysql_query("delete from `res`");
mysql_query("delete from `trade`");
mysql_query("delete from `tech`");

mysql_query("INSERT INTO `tech` ( `n` , `up` , `att` , `arm` , `engine` , `build` , `harv` , `hod` , `orb` , `spy` ) 
VALUES (NULL , '1', '5', '5', '3', '10', '10', '1', '3', '1')");

mysql_query("INSERT INTO `tech` ( `n` , `up` , `att` , `arm` , `engine` , `build` , `harv` , `hod` , `orb` , `spy` ) 
VALUES (NULL , '6', '0', '0', '1', '5', '3', '0', '0', '0')");

mysql_query("UPDATE `day` SET `n` = '1' LIMIT 1");

mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) 
VALUES (
NULL , '1', 'Cydonia', '50', '50', '0', '5000000', '100000', '100', '50', '30', '15', '15', '50', '25', '5', '15', '15', '10', '10', '5', '100', '0', '0', '0', '0', '0', '10000', '100', '0', '100', '5'
)");

mysql_query("INSERT INTO `base` ( `n` , `up` , `name` , `x` , `y` , `spice` , `cred` , `stone` , `place` , `wall` , `tower` , `rtower` , `constr` , `wind` , `refin` , `silo` , `bar` , `fact` , `tech` , `cosmo` , `palace` , `harv` , `mobconst` , `linf` , `hinf` , `tank` , `rtank` , `spec1` , `spec2` , `spec3` , `hod` , `trade` ) 
VALUES (
NULL , '6', 'Freemonia', '35', '35', '0', '100000', '10', '10', '10', '5', '0', '5', '10', '5', '2', '3', '3', '5', '5', '0', '50', '0', '0', '0', '0', '0', '0', '0', '10000', '0', '0'
)");

mysql_query("OPTIMIZE TABLE `al` , `army` , `base` , `bild` , `day` , `hod` , `mes` , `move` , `res` , `space` , `tech` , `trade` , `wdatr` , `wdobj` , `wduser` ");

mysql_query("update `wduser` set `spice`='0'");

echo mysql_error();

?>