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
	print "<script>alert ('ERROR : '); </script>";
	print "<script language='javascript' >window.location='../show_user.php?status=0';</script>";
	exit();	
}
/////////////////////////  update data
	$SQLeditUser = "update tb_ipd_login set Fname='$fname', ";
	$SQLeditUser = $SQLeditUser."  Lname='$lname', ";
	$SQLeditUser = $SQLeditUser."  password='$password', ";
	$SQLeditUser = $SQLeditUser."  usergroup='$usergroup' ";
	$SQLeditUser = $SQLeditUser." where userID='$uid' ";
	$RESeditUser = mysql_db_query($database,$SQLeditUser);
	
	#print $SQLeditUser;
	

if($RESeditUser){
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_REQUEST["logno"],"U","","");
$detail ="update tb_ipd_login set Fname=$fname, Lname=$lname,password=$password,usergroup=$usergroup where userID=$uid ";
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
	print "<script language='javascript' >window.location='../show_user.php?status=1';</script>";
}
else{
	print "<script language='javascript' >window.location='../show_user.php?status=0';</script>";
}


?>