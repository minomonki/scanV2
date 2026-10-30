<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

include ("../../System_config/connection.php");
	
$gid 				= $_GET["gid"];
$manage_doc			= $_POST["manage_doc"];
$read_secret		= $_POST["xfile"];
$manage_user		= $_POST["manage_user"];
$del_list			= $_POST["del_list"];
$print				= $_POST["print"];

if ($manage_doc==''){$manage_doc=0;}
if ($read_secret==''){$read_secret=0;}
if ($manage_user==''){$manage_user=0;}
if ($del_list==''){$del_list=0;}
if ($print==''){$print=0;}

#print "gid = ".$gid."<br>";
#print "$read_secret = ".$read_secret."<br>";
#print "manage_user = ".$manage_user."<br>";
#print "del_list = ".$del_list."<br>";


$SQLaddG = "update tb_opd_group_detail set manage_doc='$manage_doc', ";
$SQLaddG = $SQLaddG." read_secret='$read_secret', ";
$SQLaddG = $SQLaddG." manage_user='$manage_user', ";
$SQLaddG = $SQLaddG." del_list='$del_list', ";
$SQLaddG = $SQLaddG." printdoc='$print' ";
$SQLaddG = $SQLaddG." where groupID='$gid'";
$RESaddG = mysql_db_query($database,$SQLaddG);

#print  $SQLaddG;


if($RESaddG){
	print "<script language='javascript' >window.location='../show_usergroup.php';</script>";
}

?>