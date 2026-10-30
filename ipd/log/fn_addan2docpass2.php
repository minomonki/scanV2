<?php
$txt_plusan	= $_REQUEST["txt_plusan"];
$txt_password= $_REQUEST["txt_password"];
$txt_foruser= $_REQUEST["txt_foruser"];
$admit_s= $_REQUEST["admit_s"];
$admit_e= $_REQUEST["admit_e"];
$txt_byuser= $_REQUEST["txt_byuser"];

if ($txt_plusan<>"" && $txt_password<>""){
	//////////////////// no duplicated,  add to  tb_ipd_doc_setup
		include("../System_config/connect.php");
		$sql = "INSERT INTO tb_ipd_doc_setup (an,password,startdate,expired,foruser,byupdate,byuser) VALUES ('$txt_plusan','$txt_password','$admit_s','$admit_e','$txt_foruser',".CURRENT_TIMESTAMP.",'$txt_byuser')";
		//echo $sql."<br>";
		//if($countan==0){
		mysql_query($sql);
		//}
		///////////////// add to log detail /////////////
		//savelogdetail($_REQUEST["logno"],"A",$txt_plusan,"");
		$detail="Add AN : INSERT INTO tb_ipd_doc_setup/(an,password,startdate,expired,foruser,byupdate,byuser)/VALUES/$txt_plusan/$txt_password/$admit_s/$admit_e/$txt_foruser/CURRENT_TIMESTAMP/$txt_byuser/";
		//updatelogdetail($_REQUEST["logno"],$detail);
	//////////////////////////////////////////////
	print "<script>alert ('บันทึกเรียบร้อยแล้ว'); </script>";

}else{
	print "<script>alert ('มีข้อผิดพลาด'); </script>";
}//end if 

print "<script language='javascript' >window.location='frm_set_docpass.php?cmd_addan=1&txt_addan=".$txt_password."';</script>";

?>
