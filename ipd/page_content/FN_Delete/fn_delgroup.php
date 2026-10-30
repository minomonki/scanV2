<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("../../System_config/connection.php");

	$gid 		= $_GET['gid'];
	#print $gid;
	
if(empty($gid)){
	print "<script>alert ('กรุณาตรวจสอบรายการกลุ่มผู้ใช้อีกครั้ง..'); </script>";
	print "<script language='javascript' >window.location='../show_usergroup.php?status=0';</script>";
	exit();
}	

////////////////////  table   tb_ipd_group
	$SQLdelG= "delete from tb_ipd_usergroup where groupID='$gid' ";
	#print $SQLdelG;
	$RESdelG = mysql_db_query($database,$SQLdelG);
////////////////////  table   tb_ipd_group_detail	
	$SQLdelG= "delete from tb_ipd_usergroup_detail where groupID='$gid' ";
	$RESdelG = mysql_db_query($database,$SQLdelG);
	
	if($RESdelG){
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_REQUEST["logno"],"D","","");
$detail ="delete from tb_ipd_usergroup where groupID=$gid/delete from tb_ipd_usergroup_detail where groupID=$gid ";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
		print "<script language='javascript' >window.location='../show_usergroup.php?status=1';</script>";
	}
	else{
		print "<script language='javascript' >window.location='../show_usergroup.php?status=0';</script>";
	}	
	
?>