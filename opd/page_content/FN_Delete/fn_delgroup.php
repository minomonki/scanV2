<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

include("../../System_config/connection.php");

	$gid 		= $_GET['gid'];
	#print $gid;
	
if(empty($gid)){
	print "<script>alert ('กรุณาตรวจสอบรายการกลุ่มผู้ใช้อีกครั้ง..'); </script>";
	print "<script language='javascript' >window.location='../show_usergroup.php?status=0';</script>";
	exit();
}	

////////////////////  table   tb_opd_group
	$SQLdelG= "delete from tb_opd_group where groupID='$gid' ";
	#print $SQLdelG;
	$RESdelG = mysql_db_query($database,$SQLdelG);
////////////////////  table   tb_opd_group_detail	
	$SQLdelG= "delete from tb_opd_group_detail where groupID='$gid' ";
	$RESdelG = mysql_db_query($database,$SQLdelG);
	
	if($RESdelG){
		print "<script language='javascript' >window.location='../show_usergroup.php?status=1';</script>";
	}
	else{
		print "<script language='javascript' >window.location='../show_usergroup.php?status=0';</script>";
	}	
	
?>