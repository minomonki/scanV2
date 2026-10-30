<?php
require_once dirname(__DIR__, 2) . '/mysql_compat.php';

$hostDB   = DB_HOST;
$userDB   = DB_USER;
$passDB   = DB_PASS;
$database = DB_NAME;

// Open a connection to a MySQL Server
$link = mysql_connect($hostDB, $userDB, $passDB); 
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

// Database selection
$db_selected = mysql_select_db($database, $link);
if (!$db_selected) {
    die("Can't use database: " . mysql_error());
}

if (defined('DB_CHARSET') && DB_CHARSET) {
    mysql_query("SET character_set_client=" . DB_CHARSET);
    mysql_query("SET character_set_results=" . DB_CHARSET);
    mysql_query("SET character_set_connection=" . DB_CHARSET);
}
?>
