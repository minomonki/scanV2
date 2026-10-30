<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include ("../../System_config/connection.php");
	
$gid 						= $_GET["gid"];
$txtGname				= $_POST["txtGname"];

////////////////////////  check from
if (empty($txtGname)){
	print "<script>alert ('กรุณากรอกชื่อกลุ่มผู้ใช้ก่อนการบันทึก'); </script>";
	print "<script language='javascript' >window.location='../show_usergroup.php?status=0';</script>";
	exit();	
}


$SQLaddG = "update tb_ipd_usergroup  set  groupname='$txtGname'  ";
$SQLaddG = $SQLaddG." where groupID='$gid' ";
$RESaddG = mysql_db_query($database,$SQLaddG);

#print  $SQLaddG;


if($RESaddG){
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_REQUEST["logno"],"U","","");
$detail ="update tb_ipd_usergroup  set  groupname=$txtGname where groupID=$gid ";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
	print "<script language='javascript' >window.location='../frm_edit_usergroup.php?gid=$gid';</script>";
}

?>