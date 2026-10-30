<?php

$hostDB = "localhost";
$userDB = "root";
$passDB = "authen";
//$userDB = "root";
//$passDB = "password";
//$passDB = "1234";

//Open a connection to a MySQL Server
	$link = mysql_connect($hostDB,$userDB,$passDB); 
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
//else{
//echo 'Connected successfully<br>';
//}
//Database selection
	$db_selected = mysql_select_db('hdbms', $link);
	if (!$db_selected) {
		die('Can\'t use database: ' . mysql_error());
	}
//else{
//echo 'Connect DB<br>';
//}

	$charset = "SET character_set_client=tis620";
	$charset2 = "SET character_set_results=tis620";
	$charset3 = "SET character_set_connection=tis620";
	mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
	mysql_query($charset2) or die('Invalid query: ' . mysql_error()); 
	mysql_query($charset3) or die('Invalid query: ' . mysql_error()); 

?>