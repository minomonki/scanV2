<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

	include("../System_config/connect.php");
	
	$an 		= $_REQUEST['an'];
	$psw = $_REQUEST['psw'];
$txtforuser= $_REQUEST["txtforuser"];
$txtstartdate= $_REQUEST["txtstartdate"];
$txtexpired= $_REQUEST["txtexpired"];
/*
echo "txtforuser=".$txtforuser."<br>";
echo "txtstartdate=".$txtstartdate."<br>";
echo "txtexpired=".$txtexpired."<br>";
echo "R_txtforuser=".$_REQUEST['txtforuser']."<br>";
echo "R_txtstartdate=".$_REQUEST['txtstartdate']."<br>";
echo "R_txtexpired=".$_REQUEST['txtexpired']."<br>";
*/
if(empty($txtforuser) && empty($txtstartdate) && empty($txtexpired)){
	print "<script>alert ('กรุณาระบุข้อมูลให้ครบถ้วนก่อนการบันทึก..'); </script>";
	print "<script language='javascript' >window.location='frm_edit_docpass.php?an=$an&psw=$psw';</script>";
	exit();
}else{
		//check date
		$chks_y=substr($txtstartdate,0,4);$chks_m=substr($txtstartdate,5,2);$chks_d=substr($txtstartdate,8,2);
		$chke_y=substr($txtexpired,0,4);$chke_m=substr($txtexpired,5,2);$chke_d=substr($txtexpired,8,2);
		//echo $chks_y."-".$chks_m."-".$chks_d."<br>";
		//echo $chke_y."-".$chke_m."-".$chke_d."<br>";
		//echo "start= ".checkdate ( $chks_m, $chks_d, $chks_y)."<br>";
		//echo "end= ".checkdate ( $chke_m, $chke_d, $chke_y)."<br>";
		if (substr($txtstartdate,0,4)<2500){
			print "<script>alert ('วดป.เริ่มการใช้งาน ต้องระบุข้อมูลเป็นปี พ.ศ. กรุณตรวจสอบก่อนการบันทึก..'); </script>";
			print "<script language='javascript' >window.location='frm_edit_docpass.php?an=$an&psw=$psw';</script>";
			exit();
		}elseif  (substr($txtexpired,0,4)<2500){
			print "<script>alert ('วดป.สิ้นสุดการใช้งาน ต้องระบุข้อมูลเป็นปี พ.ศ. กรุณตรวจสอบก่อนการบันทึก..'); </script>";
			print "<script language='javascript' >window.location='frm_edit_docpass.php?an=$an&psw=$psw';</script>";
			exit();
		}elseif  (checkdate ( $chks_m, $chks_d, $chks_y)<>1){
			print "<script>alert ('รูปแบบข้อมูล วดป.เริ่มการใช้งาน ไม่ถูกต้อง ปีพ.ศ.-เดือน-วัน (yyyy-mm-dd) กรุณตรวจสอบก่อนการบันทึก..'); </script>";
			print "<script language='javascript' >window.location='frm_edit_docpass.php?an=$an&psw=$psw';</script>";
			exit();
		}elseif  (checkdate ( $chke_m, $chke_d, $chke_y)<>1){
			print "<script>alert ('รูปแบบข้อมูล วดป.สิ้นสุดการใช้งาน ไม่ถูกต้อง ปีพ.ศ.-เดือน-วัน (yyyy-mm-dd) กรุณตรวจสอบก่อนการบันทึก..'); </script>";
			print "<script language='javascript' >window.location='frm_edit_docpass.php?an=$an&psw=$psw';</script>";
			exit();
		}elseif  ($txtexpired<$txtstartdate){
			print "<script>alert ('วดป.สิ้นสุดการใช้งาน ต้องมากกว่า วดป.เริ่มการใช้งาน กรุณตรวจสอบก่อนการบันทึก..'); </script>";
			print "<script language='javascript' >window.location='frm_edit_docpass.php?an=$an&psw=$psw';</script>";
			exit();
		}
} // end if check empty value

/////////////////////////  update data
	$query = "update tb_ipd_doc_setup set foruser='$txtforuser',startdate='$txtstartdate',expired='$txtexpired',byuser='".$_REQUEST["byuser"]."',byupdate=".CURRENT_TIMESTAMP." where an='$an' and password='$psw' ";
	$result = mysql_query($query);
	
	//print $query."<br>";

if($result){
///////////////// add to log detail /////////////
include_once("../System_config/func.php");
savelogdetail($_REQUEST["logno"],"U",$an,"");
$detail ="update tb_ipd_doc_setup/ foruser=$txtforuser/startdate=$txtstartdate/expired=$txtexpired/byuser=".$_REQUEST["byuser"]."/byupdate=CURRENT_TIMESTAMP/ where an=$an and password=$psw";
updatelogdetail($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
	if ($_REQUEST['returnurl']<>""){
		print "<script language='javascript' >window.location='frm_set_docpass.php?cmd_addan=1&txt_addan=$psw';</script>";
	}else{
		print "<script language='javascript' >window.location='frm_list_docpass.php?txt_an=$an&txt_foruser=$txtforuser';</script>";
	}
}

?>