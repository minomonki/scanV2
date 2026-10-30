<?php

$hostDB = "localhost";
$userDB = "root";
$passDB = "authen";

$database = "hdbms";

$connDB = @mysql_connect($hostDB,$userDB,$passDB);

mysql_query("SET NAMES tis620");

if(!$connDB){
	print "Cann't Connect to Database";	
}
?>