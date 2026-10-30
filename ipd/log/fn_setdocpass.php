<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
 /////  check session_id ของหน้า
if($_SESSION["PID"] == session_id()) {

$txt_an	= $_REQUEST["txt_an"];
$txt_password= $_REQUEST["txt_password"];
$txt_foruser= $_REQUEST["txt_foruser"];
$admit_s= $_REQUEST["admit_s"];
$admit_e= $_REQUEST["admit_e"];
$txt_byuser= $_REQUEST["txt_byuser"];
$logno= $_REQUEST["logno"];

$errmsg="ข้อมูลไม่ครบถ้วน ";
$flag = 0;

////////// check to complete data
if(empty($txt_foruser)){
	$flag = 1;
	$errmsg .=" ต้องระบุข้อมูลผู้ใช้งานเอกสาร";
	print "<script>alert ('$errmsg'); </script>";
	print "<script language='javascript' >window.location='frm_list_docpass.php';</script>";
}elseif (empty($admit_s)){
	$flag = 1;
	$errmsg .=" , ต้องระบุข้อมูล วดป.เริ่มการใช้งาน";
	print "<script>alert ('$errmsg'); </script>";
	print "<script language='javascript' >window.location='frm_list_docpass.php';</script>";
}elseif (empty($admit_e)){
	$flag = 1;
	$errmsg .=" , ต้องระบุข้อมูล วดป.สิ้นสุดการใช้งาน";
	print "<script>alert ('$errmsg'); </script>";
	print "<script language='javascript' >window.location='frm_list_docpass.php';</script>";
}
//
include_once("../System_config/func.php");
$gotopass=getPassbyForuser($txt_foruser);
////////// check to complete data
if (check2anForuser($txt_foruser,$txt_an)==1){
	$flag = 1;
	$errmsg ="มี AN นี้ในระบบยืมของชื่อผู้ใช้งานนี้แล้ว";
	//echo $errmsg;
	print "<script>alert ('$errmsg'); </script>";
	print "<script language='javascript' >window.location='frm_set_docpass.php?cmd_addan=1&txt_addan=$gotopass';</script>";
}elseif (check2pass($txt_foruser)==1){
	$flag = 1;
	$errmsg ="มีชื่อผู้ใช้งานนี้ในระบบแล้ว";
	//echo $errmsg;
	print "<script>alert ('$errmsg'); </script>";
	print "<script language='javascript' >window.location='frm_set_docpass.php?cmd_addan=1&txt_addan=$gotopass';</script>";
}
/*echo "2pass= ".getPassbyForuser($txt_foruser)."<br>";
echo "c2an= ".check2anForuser($txt_foruser,$txt_an)."<br>";
echo "c2pass= ".check2pass($txt_foruser)."<br>";
echo "f=".$flag."<br>";
*/
if ($flag == 0){
		//echo "f1=".$flag."<br>";
		print "<script language='javascript' >window.location='fn_addnewdocpass.php?logno=$logno&flag=0&txt_an=$txt_an&txt_password=$txt_password&txt_foruser=$txt_foruser&admit_s=$admit_s&admit_e=$admit_e&txt_byuser=$txt_byuser';</script>";
}else{
		//echo "f2=".$flag."<br>";
		print "<script language='javascript' >window.location='frm_list_docpass.php';</script>";
}//end if flag

//////////////////////////////////////////////////////////////////
}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>