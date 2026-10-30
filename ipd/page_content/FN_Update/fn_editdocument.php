<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include ("../../System_config/connection.php");
	
	$docid 		= $_GET['docid'];
	$txtDocType = $_POST['txtDocType'];
	$txtDocname = $_POST['txtDocname'];

if((empty($txtDocname) || empty($txtDocType)) && ($docid <>0)){
	print "<script>alert ('กรุณาป้อนชื่อรหัสย่อเอกสารและชื่อประเภทเอกสารให้ครบก่อนการบันทึก..'); </script>";
	print "<script language='javascript' >window.location='../show_document.php?status=0';</script>";
	exit();
}
else{
	//==check Duplicate อักษรย่อ======
	$SQLdchk= "select * from tb_ipd_doctype where DocID ='$docid'";
	$RESdchk = mysql_db_query($database,$SQLdchk);
	while($VALdname = mysql_fetch_array($RESdchk)){
		$chkgname = $VALdname['DocType'];
	}
	if($txtDocType==$chkgname){
	}
	else{
		$SQLdchk= "select * from tb_ipd_doctype where DocType ='$txtDocType'";
		$RESdchk = mysql_db_query($database,$SQLdchk);
		while($VALdname = mysql_fetch_array($RESdchk)){
			$chkdname = $VALdname['DocType'];
		}
		if($txtDocType==$chkdname){
			print "<script>alert ('รหัสย่อเอกสารนี้มีอยู่แล้ว กรุณตรวจสอบก่อนการบันทึก..'); </script>";
			print "<script language='javascript' >window.location='../show_document.php?status=0';</script>";
			exit();
		}
	}
}

/////////////////////////  update data

	$SQLeditDoc = "update tb_ipd_doctype set DocType='$txtDocType',DocTypeName='$txtDocname' where DocID='$docid' ";
	$RESeditDoc = mysql_db_query($database,$SQLeditDoc);
	
	//print $SQLeditDoc."<br>";

if($RESeditDoc){
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_REQUEST["logno"],"U","","");
$detail ="update tb_ipd_doctype set DocType=$txtDocType,DocTypeName=$txtDocname where DocID=$docid";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
	print "<script language='javascript' >window.location='../show_document.php?status=1';</script>";
}
else{
	print "<script language='javascript' >window.location='../show_document.php?status=0';</script>";
}


?>