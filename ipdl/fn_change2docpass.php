<?php
session_start();
///// check authorized
if($_SESSION['userdocpass']<>"") {

include("../ipd/System_config/connect.php");

$pass = $_POST["password"];
$passnew = $_POST["passnew"];
$conpass = $_POST["conpass"];

//print $user."/".$pass."/".$passnew."/".$conpass."<br>";
/////  CHECK VALID PASSWORD
if($pass <> $_SESSION["userdocpass"]){
	print "<script>alert (' กรุณาระบุข้อมูล password เดิมให้ถูกต้อง '); </script>";
	print "<script language='javascript' >window.location='frm_change_docpass.php?syspass=".$_REQUEST['syspass']."';</script>";
	exit();
}// end if chk passnew==conpass


if($passnew == $conpass){
	$setpassnew=$_REQUEST['syspass'].$passnew;
	$sqlupdate = "UPDATE  tb_ipd_doc_pass SET userdocpass='$setpassnew' , lastupdate=".CURRENT_TIMESTAMP." WHERE password='".$_REQUEST['syspass']."'";
	//print $sqlupdate."<br>";
	$resupdate = mysql_query($sqlupdate);
	if($resupdate){
///////////////// add to log detail /////////////
include_once("../ipd/System_config/func.php");
savelogdetail4($_SESSION["logno"],"U","","");
$detail =$sqlupdate;
updatelogdetail4($_SESSION["logno"],$detail);
//////////////////////////////////////////////
					print "<script>alert ('บันทึกเรียบร้อยแล้ว'); </script>";
				    print "<script language='javascript' >window.location='logoutdocpass.php';</script>";
				}// end if resupdate
}else{
	print "<script>alert (' Fail : A new password does not match '); </script>";
	print "<script language='javascript' >window.location='frm_change_docpass.php?syspass=".$_REQUEST['syspass']."';</script>";
	exit();
}// end if chk passnew==conpass

////////////// check authorized
}else{
	print "<script language='javascript' >window.location='frm_login.php';</script>";
}
?>