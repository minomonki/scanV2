<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include ("../../System_config/connection.php");
	
$uid 					=$_GET["id"];
$username		=$_GET["usr"];
$usergroup		= $_POST["usergroup"];
//$username 		= $_POST["txtuser"];
$password		= $_POST["txtpass"];
$conpassword	= $_POST["txtconpass"];
$fname 				= $_POST["txtfname"];
$lname 				= $_POST["txtlname"];
////////////////////////  check from
if (empty($username)||empty($password)||empty($conpassword)||empty($fname)||empty($lname)||empty($uid)){
	print "<script>alert ('กรุณากรอกข้อมูลให้ครบก่อนการบันทึก'); </script>";
	print "<script language='javascript' >window.location='../show_user.php?status=0';</script>";
	exit();	
}
else{
	//==check Duplicate userName======
	$SQLgchk= "select * from tb_opd_login where userID ='$uid'";
	$RESgchk = mysql_db_query($database,$SQLgchk);
	while($VALgname = mysql_fetch_array($RESgchk)){
		$chkuname = $VALgname['username'];
	}
	if($username==$chkuname){
	}
	else{
		$SQLgchk= "select * from tb_opd_login where username ='$username'";
		$RESgchk = mysql_db_query($database,$SQLgchk);
		while($VALgname = mysql_fetch_array($RESgchk)){
			$chkuname = $VALgname['username'];
		}
		if($username==$chkuname){
			print "<script>alert ('ชื่อผู้ใช้นี้มีอยู่แล้ว กรุณตรวจสอบก่อนการบันทึก..'); </script>";
			print "<script language='javascript' >window.location='../show_user.php?status=0';</script>";
			exit();
		}
	}
}

/////////////////////////  update data
	$SQLeditUser = "update tb_opd_login set Fname='$fname', ";
	$SQLeditUser = $SQLeditUser."  Lname='$lname', ";
	$SQLeditUser = $SQLeditUser."  password='$password', ";
	$SQLeditUser = $SQLeditUser."  usergroup='$usergroup' ";
	$SQLeditUser = $SQLeditUser." where userID='$uid' ";
	$RESeditUser = mysql_db_query($database,$SQLeditUser);
	
	#print $SQLeditUser;
	

if($RESeditUser){
	print "<script language='javascript' >window.location='../show_user.php?status=1';</script>";
}
else{
	print "<script language='javascript' >window.location='../show_user.php?status=0';</script>";
}


?>