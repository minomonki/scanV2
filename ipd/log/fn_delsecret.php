<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$txt_an	= $_REQUEST["txt_an"];
$txt_byuser= $_REQUEST["logno"];

include("../System_config/connect.php");
//////////////////// Delete  tb_ipd_doc_secret
$sql = "DELETE FROM tb_ipd_doc_secret WHERE an='$txt_an'";
//echo $sql."<br>";
mysql_query($sql);

///////////////// add to log detail /////////////
include_once("../System_config/func.php");
savelogdetail($_REQUEST["logno"],"D",$txt_an,"");
$detail="DELETE AN=$txt_an is not secret list";
updatelogdetail($_REQUEST["logno"],$detail);
//////////////////////////////////////////////

print "<script>alert ('ลบข้อมูลเรียบร้อยแล้ว'); </script>";
print "<script language='javascript' >window.location='frm_list_secret.php';</script>";

?>