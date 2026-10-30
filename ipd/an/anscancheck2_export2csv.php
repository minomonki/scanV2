<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />


<?php
	//session_start();	
	if($_SESSION["PID"] == session_id()) {

	include ("../System_config/connection.php");
include("../System_config/connect.php");
include("../System_config/const.php");
include("../System_config/func.php");

////////////////////////////////////
$fromdate 	= $_GET["fromdate"];
$todate 	= $_GET["todate"];
$colan 	= $_GET["colan"];
$colyesan 	= $_GET["colyesan"];
$colnoan 	= $_GET["colnoan"];
///////////////////////////////////
$pathdir= "../exportfile/";
$filName = "anscancheck2-".$today3.".csv";  
$objWrite = fopen($pathdir.$filName, "w"); 
//write header title
$thminyr=substr($fromdate,0,4)+543;
$thmaxyr=substr($todate,0,4)+543;
$titleheader="แสดงผลการค้นหาตั้งแต่วันที่ ".substr($fromdate,8,2)."-".substr($fromdate,5,2)."-".$thminyr." ถึง ".substr($todate,8,2)."-".substr($todate,5,2)."-".$thmaxyr;
fwrite($objWrite, "\"$titleheader\"\n"); 
fwrite($objWrite, "\"จำนวน AN ในระบบ\",\"จำนวน AN สแกนแล้ว\",\"จำนวน AN ที่สแกนไม่ครบ\"\n"); 
fwrite($objWrite, "\"$colan\",\"$colyesan\",\"$colnoan\"\n"); 
//////////////////////////////////
fclose($objWrite); 
//echo "<br>Generate CSV Done<br><a href=".$pathdir."".$filName.">Download</a>"; 
if(!is_null($_REQUEST["logno"])){
	savelogdetail($_REQUEST["logno"],"E","","");
	$detail ="Export to csv : anscancheck2-search";
	updatelogdetail($_REQUEST["logno"],$detail);
	print "<script language='javascript' >window.location='".$pathdir."".$filName."';</script>";
}

}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>