<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
 /////  check session_id ของหน้า
if($_SESSION["PID"] == session_id()) {
$flag	= $_REQUEST["flag"];
if ($flag == 0){

$txt_an	= $_REQUEST["txt_an"];
$txt_password= $_REQUEST["txt_password"];
$txt_foruser= $_REQUEST["txt_foruser"];
$admit_s= $_REQUEST["admit_s"];
$admit_e= $_REQUEST["admit_e"];
$txt_byuser= $_REQUEST["txt_byuser"];

include_once("../System_config/func.php");
$gotopass=getPassbyForuser($txt_foruser);
require_once("../System_config/connect.php");
////////////////////  add to  tb_ipd_doc_setup
		$sql = "INSERT INTO tb_ipd_doc_setup (an,password,startdate,expired,foruser,byupdate,byuser) VALUES ('$txt_an','$txt_password','$admit_s','$admit_e','$txt_foruser',".CURRENT_TIMESTAMP.",'$txt_byuser')";
		//echo $sql."<br>";
		mysql_query($sql);
////////////////////  add to  tb_ipd_doc_pass
		$userdocpass=$txt_password.$txt_password;
		$sql2 = "INSERT INTO tb_ipd_doc_pass (password,userdocpass,foruser,lastupdate) VALUES ('$txt_password','$userdocpass','$txt_foruser',".CURRENT_TIMESTAMP.")";
		//echo $sql2."<br>";
		mysql_query($sql2);
///////////////// add to log detail /////////////
savelogdetail($_REQUEST["logno"],"A",$txt_an,"");
$detail=$sql." / ".$sql2;
updatelogdetail($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
		print "<script>alert ('บันทึกการกำหนดสิทธิเรียบร้อยแล้ว'); </script>";
		print "<script language='javascript' >window.location='frm_set_docpass.php?cmd_addan=1&txt_addan=$txt_password';</script>";
}//end if flag

//////////////////////////////////////////////////////////////////
}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>