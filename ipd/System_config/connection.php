<?php
require_once dirname(__DIR__, 2) . '/mysql_compat.php';

$hostDB   = DB_HOST;
$userDB   = DB_USER;
$passDB   = DB_PASS;
$database = DB_NAME;

$connDB = @mysql_connect($hostDB, $userDB, $passDB);

if ($connDB) {
    if (defined('DB_CHARSET') && DB_CHARSET) {
        mysql_query("SET NAMES " . DB_CHARSET);
    }
} else {
    print "Cann't Connect to Database";
}
?>
