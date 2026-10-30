<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

include("../../System_config/connection.php");

	$hn 		= $_GET['hn'];
	$vn 			= $_GET['vn'];
	$docid			=	$_GET['docid'];
	print $docid;
	
if((empty($hn)) and (empty($vn))){
	print "<script>alert ('กรุณาตรวจสอบรายการที่เลือกอีกครั้ง..'); </script>";
	print "<script language='javascript' >window.location='../frm_search.php?status=0';</script>";
	exit();
}	
///////////////////////////////  delete opd
	$SQLdelUser = "delete from tb_opd where (hn='$hn' and vn='$vn')and  doctype_id='$docid' ";
	$RESdelUser = mysql_db_query($database,$SQLdelUser);
////////////////////////////////  delete opd_detail
	$SQLdelUser = "delete from tb_opd_detail  where (hn='$hn' and vn='$vn') and doctype_id='$docid' ";
	$RESdelUser = mysql_db_query($database,$SQLdelUser);
	
	if($RESdelUser){
		print "<script language='javascript' >window.location='../delete_list_opd.php?uid=$hn';</script>";
	}
	else{
		print "<script>alert ('กรุณาตรวจสอบรายการที่เลือกอีกครั้ง..'); </script>";
		print "<script language='javascript' >window.location='../delete_list_opd.php?uid=$hn';</script>";
	}	

?>