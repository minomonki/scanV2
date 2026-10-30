<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php

include("../../System_config/connection.php");

	$hn 		= $_GET['hn'];
	$an 		= $_GET['an'];
	#print $docid;
	
if((empty($hn)) and (empty($an))){
	print "<script>alert ('กรุณาตรวจสอบรายการที่เลือกอีกครั้ง..'); </script>";
	print "<script language='javascript' >window.location='../frm_search.php?status=0';</script>";
	exit();
}	
///////////////////////////////  delete opd
	$SQLdelUser = "delete from tb_ipd where an='$an' ";
	$RESdelUser = mysql_db_query($database,$SQLdelUser);
////////////////////////////////  delete opd_detail
	$SQLdelUser = "delete from tb_ipd_doctype_detail   where an='$an' ";
	$RESdelUser = mysql_db_query($database,$SQLdelUser);
	
	if($RESdelUser){
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_REQUEST["logno"],"D","$an","");
$detail ="delete from tb_ipd_doctype_detail where an=$an ";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
		print "<script>alert ('ลบรายการสำเร็จ ...'); </script>";
		print "<script language='javascript' >window.location='../frm_search.php';</script>";
	}
	else{
		print "<script>alert ('กรุณาตรวจสอบรายการที่เลือกอีกครั้ง ...'); </script>";
		print "<script language='javascript' >window.location='../frm_search.php';</script>";
	}	

?>