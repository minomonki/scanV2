<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("../../System_config/connection.php");

	$uid 		= $_GET['userid'];
	#print $docid;
	
if(empty($uid)){
	print "<script>alert ('กรุณาตรวจสอบเอกสารอีกครั้ง..'); </script>";
	print "<script language='javascript' >window.location='../show_document.php?status=0';</script>";
	exit();
}	


	$SQLdelUser = "delete from tb_ipd_login where userID=$uid";
	$RESdelUser = mysql_db_query($database,$SQLdelUser);
	
	if($RESdelUser){
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_REQUEST["logno"],"D","","");
$detail ="delete from tb_ipd_login where userID=$uid ";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
		print "<script language='javascript' >window.location='../show_user.php?status=1';</script>";
	}
	else{
		print "<script language='javascript' >window.location='../show_user.php?status=0';</script>";
	}	
	
?>