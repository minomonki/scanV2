<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$txt_an	= $_REQUEST["txt_an"];
$txt_password= $_REQUEST["txt_password"];

include("../System_config/connect.php");
//////////////////// Delete  tb_ipd_doc_setup
$sql = "DELETE FROM tb_ipd_doc_setup WHERE an='$txt_an' and password='$txt_password'";
//echo $sql."<br>";
mysql_query($sql);

if ($_REQUEST['totalan']==1){
//////////////////// Delete  tb_ipd_doc_pass
$sql = "DELETE FROM tb_ipd_doc_pass WHERE password='$txt_password'";
//echo $sql."<br>";
mysql_query($sql);
///////
}
///////////////// add to log detail /////////////
include_once("../System_config/func.php");
savelogdetail($_REQUEST["logno"],"D",$txt_an,"");
$detail="DELETE AN=$txt_an from password=$txt_password list";
if ($_REQUEST['totalan']==1){$detail .=" and this password is cleared ";}
updatelogdetail($_REQUEST["logno"],$detail);
//////////////////////////////////////////////

if ($_REQUEST['totalan']==1){
	print "<script>alert ('ลบข้อมูล an ในระบบยืมเรียบร้อยแล้ว'); </script>";
	print "<script language='javascript' >window.location='frm_list_docpass.php';</script>";
}else{
	print "<script>alert ('ลบข้อมูล an ในระบบยืมเรียบร้อยแล้ว'); </script>";
	print "<script language='javascript' >window.location='frm_set_docpass.php?cmd_addan=1&txt_addan=".$txt_password."';</script>";
}
?>