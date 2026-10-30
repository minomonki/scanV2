<?php

include("../../System_config/connection.php");

$uid 			=$_GET["id"];

$usergroup		= $_POST["usergroup"];
$username 		= $_POST["txtuser"];
$password		= $_POST["txtpass"];
$conpassword	= $_POST["txtconpass"];

$fname 		= $_POST["txtfname"];
$lname 		= $_POST["txtlname"];



if (empty($username)||empty($password)||empty($conpassword)||empty($fname)||empty($lname)||empty($uid)){
	print "<script>alert ('กรุณากรอกข้อมูลให้ครบก่อนการบันทึก'); </script>";
	print "<script language='javascript' >window.location='../show_user.php?status=0';</script>";
	exit();	
}
else{
	//==check Duplicate userName======
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
///////////////////  chk  username
	$sqlchkuser = "SELECT username FROM tb_opd_login WHERE username='$username'";;
	$reschkuser = mysql_db_query($database,$sqlchkuser);
	$numchkuser = mysql_num_rows($reschkuser);
	#print $numchkuser;
		if($numchkuser > '0'){
			print "<script>alert ('ERROR : your username already exist in database '); </script>";
			print "<script language='javascript' >window.location='../frm_add_user.php';</script>";
			exit();
		}
//////////////// chk confirm password
if ($password <>$conpassword){
	print "<script>alert ('Password Mismatch!!  Please confirm again'); </script>";
	print "<script language='javascript' >window.location='../frm_add_user.php';</script>";
}
else{
		$createdate = date('Y-m-d H:i:s');
		$sqladd = "INSERT INTO tb_opd_login(userID,Fname,Lname,username,password,usergroup,createdate) 
	    		   VALUES('$uid','$fname','$lname','$username','$password','$usergroup','$createdate')";
		$resadd = mysql_db_query($database,$sqladd);
		if($resadd){
			print "<script>alert ('OK...Add data complete'); </script>";
			print "<script language='javascript' >window.location='../show_user.php';</script>";
		}
}

?>