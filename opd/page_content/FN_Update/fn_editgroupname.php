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
else{
	//==check Duplicate groupName======
	$SQLgchk= "select * from tb_opd_group where groupID ='$gid'";
	$RESgchk = mysql_db_query($database,$SQLgchk);
	while($VALgname = mysql_fetch_array($RESgchk)){
		$chkgname = $VALgname['groupname'];
	}
	if($txtGname==$chkgname){
	}
	else{
		$SQLgchk= "select * from tb_opd_group where groupname ='$txtGname'";
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
}

//=============Updategroup======
$SQLaddG = "update tb_opd_group  set  groupname='$txtGname'  ";
$SQLaddG = $SQLaddG." where groupID='$gid' ";
$RESaddG = mysql_db_query($database,$SQLaddG);

#print  $SQLaddG;


if($RESaddG){
	print "<script language='javascript' >window.location='../frm_edit_usergroup.php?gid=$gid';</script>";
}

?>