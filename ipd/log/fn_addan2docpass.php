<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
///// check data before delete
$txt_plusan	= $_REQUEST["txt_plusan"];
$txt_password= $_REQUEST["txt_password"];
$txt_foruser= $_REQUEST["txt_foruser"];
$admit_s= $_REQUEST["admit_s"];
$admit_e= $_REQUEST["admit_e"];
$txt_byuser= $_REQUEST["txt_byuser"];
//echo "plusan=".$txt_plusan."<br>";
//echo "password=".$txt_password."<br>";
//$errmsg="ข้อมูลไม่ครบถ้วน ";
//$flag = 0;

////////// check to complete data
if(empty($txt_plusan)){
	$errmsg .=" ต้องระบุข้อมูล AN";
	$flag = 1;
}elseif (empty($admit_s)){
	$errmsg .=" , ต้องระบุข้อมูล วดป.เริ่มการใช้งาน";
	$flag = 1;
}elseif (empty($admit_e)){
	$errmsg .=" , ต้องระบุข้อมูล วดป.สิ้นสุดการใช้งาน";
	$flag = 1;
}
if ($flag == 1){
	print "<script>alert ('".$errmsg."'); </script>";
	print "<script language='javascript' >window.location='frm_set_docpass.php?cmd_addan=1&txt_addan=".$txt_password."';</script>";
}

////////// check duplicate 
include("../System_config/connect.php");
$query = "SELECT count(*) FROM tb_ipd_doc_setup WHERE an='".$txt_plusan."' and password='".$txt_password."'";
//echo $query."<br>";
$result=mysql_query($query);
$row = mysql_fetch_array($result);
$countan=$row[0];
//echo $row[0]."<br>";
if ($countan>0){
	print "<script>alert ('AN : ".$txt_plusan." is duplicated'); </script>";
	print "<script language='javascript' >window.location='frm_set_docpass.php?cmd_addan=1&txt_addan=".$txt_password."';</script>";
}else{
	print "<script language='javascript' >window.location='fn_addan2docpass2.php?cmd_addan=1&txt_password=".$txt_password."&txt_plusan=".$txt_plusan."&txt_foruser=".$txt_foruser."&admit_s=".$admit_s."&admit_e=".$admit_e."&txt_byuser=".$txt_byuser."';</script>";
}//end if countan

?>