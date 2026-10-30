<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include("../../System_config/connection.php");

	$docid 		= $_GET['docid'];
	#print $docid;
	
if(empty($docid)){
	print "<script>alert ('กรุณาตรวจสอบเอกสารอีกครั้ง..'); </script>";
	print "<script language='javascript' >window.location='../show_document.php?status=0';</script>";
	exit();
}	


	$SQLdelDoc = "delete from tb_opd_doctype where doctype_id=$docid";
	$RESdelDoc = mysql_db_query($database,$SQLdelDoc);
	
	if($RESdelDoc){
		print "<script language='javascript' >window.location='../show_document.php?status=1';</script>";
	}
	else{
		print "<script language='javascript' >window.location='../show_document.php?status=0';</script>";
	}	
	
?>