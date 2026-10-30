<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$txt_an	= $_REQUEST["txt_an"];
$txt_byuser= $_REQUEST["txt_byuser"];

include("../System_config/connect.php");
////////////////////  add to  tb_ipd_doc_secret
$sql = "INSERT INTO tb_ipd_doc_secret (an,byuser,byupdate) VALUES ('$txt_an','$txt_byuser',".CURRENT_TIMESTAMP.")";
//echo $sql."<br>";
mysql_query($sql);

///////////////// add to log detail /////////////
include_once("../System_config/func.php");
savelogdetail($_REQUEST["logno"],"A",$txt_an,"");
$detail="INSERT AN=$txt_an is secreted";
updatelogdetail($_REQUEST["logno"],$detail);
//////////////////////////////////////////////

print "<script>alert ('บันทึกข้อมูลเรียบร้อยแล้ว'); </script>";
print "<script language='javascript' >window.location='frm_list_secret.php?txt_an=$txt_an&cmd_show=1';</script>";

?>