<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	
	include("../../System_config/connection.php");
	
$VALidipd 	= $_GET["IPDid"];
$txtDocType	= $_POST["txtDocType"];
$txtDocname	= $_POST["txtDocname"];

if(empty($txtDocname) || empty($txtDocType)){
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

//===========Add data ============================
$SQLaddDoc = "insert into  tb_ipd_doctype(DocID,DocTypeName,DocType) values('$VALidipd','$txtDocname','$txtDocType')";
//echo $SQLaddDoc."<br>";
$RESaddDoc = mysql_db_query($database,$SQLaddDoc);
$docnum = "doc".$VALidipd;
//========insert filed in tb_doctype===========
$SQLaddDoc = "ALTER TABLE tb_ipd_usergroup_detail ADD $docnum int(11) not null DEFAULT 0";
//echo $SQLaddDoc."<br>";
$RESaddDoc = mysql_db_query($database,$SQLaddDoc);
$SQLaddDoc = "update tb_ipd_usergroup_detail set $docnum=3 where groupID=99";
//echo $SQLaddDoc."<br>";
$RESaddDoc = mysql_db_query($database,$SQLaddDoc);



if($RESaddDoc){
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_REQUEST["logno"],"A","","");
$detail ="insert into  tb_ipd_doctype(DocID,DocTypeName,DocType) values($VALidipd,$txtDocname,$txtDocType)";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
savelogdetail2($_REQUEST["logno"],"AL","","");
$detail ="ALTER TABLE tb_ipd_usergroup_detail ADD $docnum int(11) not null DEFAULT 0";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
savelogdetail2($_REQUEST["logno"],"U","","");
$detail ="update tb_ipd_usergroup_detail set $docnum=3 where groupID=99";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
	print "<script language='javascript' >window.location='../show_document.php?status=1';</script>";
}
else{
	print "<script language='javascript' >window.location='../show_document.php?status=0';</script>";
}
?>