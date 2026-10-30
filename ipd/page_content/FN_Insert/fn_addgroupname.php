<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
	
	include("../../System_config/connection.php");
	
$VALgid 	= $_GET["gid"];
$txtGname	= $_POST["txtGname"];


if(empty($txtGname)){
	print "<script>alert ('กรุณากำหนดชื่อกลุ่มก่อนการบันทึก..'); </script>";
	print "<script language='javascript' >window.location='../show_usergroup.php?status=0';</script>";
	exit();
}
else{
	//==check Duplicate groupName======
	$SQLgchk= "select * from tb_ipd_usergroup where groupname ='$txtGname'";
	$RESgchk = mysql_db_query($database,$SQLgchk);
	while($VALgname = mysql_fetch_array($RESgchk)){
		$chkgname = $VALgname['groupname'];
	}
	if($txtGname==$chkgname){
		print "<script>alert ('ชื่อกลุ่มผู้ใช้นี้มีอยู่แล้ว กรุณตรวจสอบก่อนการบันทึก..'); </script>";
		print "<script language='javascript' >window.location='../show_usergroup.php?status=0';</script>";
		exit();
	}
}
////////////////////  add to  tb_ipd_group

$SQLaddG = "insert into  tb_ipd_usergroup(groupID,groupname) values('$VALgid','$txtGname')";
$RESaddG = mysql_db_query($database,$SQLaddG);

$SQLaddG = "insert into  tb_ipd_usergroup_detail(groupID) values('$VALgid')";
$RESaddG = mysql_db_query($database,$SQLaddG);

if($RESaddG){
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_REQUEST["logno"],"A","","");
$detail ="insert into  tb_ipd_usergroup(groupID,groupname) values($VALgid,$txtGname)/insert into  tb_ipd_usergroup_detail(groupID) values($VALgid)";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
	print "<script language='javascript' >window.location='../frm_add_usergroup.php?gid=$VALgid&status=1&message=$txtGname';</script>";
}


?>