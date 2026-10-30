<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php
	//session_start();	
	if($_SESSION["PID"] == session_id()) {

	include ("../System_config/connection.php");
include("../System_config/connect.php");
include("../System_config/const.php");
include("../System_config/func.php");

////////////////////////////////////
$colan 	= $_GET["colan"];
$colyesan 	= $_GET["colyesan"];
$colnoan 	= $_GET["colnoan"];
///////////////////////////////////
$pathdir= "../exportfile/";
$filName = "anscancheck_monthdetail".$today3.".csv";  
$objWrite = fopen($pathdir.$filName, "w"); 
//write header title
$titleheader="ข้อมูล AN ทั้งหมดในระบบงาน เดือน ".$month[$_REQUEST["mon"]-1]." ปี ".$_REQUEST["thyr"];
fwrite($objWrite, "\"$titleheader\"\n"); 
//////////////////////////////////
fwrite($objWrite, "\"วดป.\",\"จำนวน AN ในระบบ\",\"จำนวน AN สแกนแล้ว\",\"จำนวน AN ที่สแกนไม่ครบ\"\n"); 
//////////////////////////////////
$total=0;
for ($i=1;$i<=31;$i++){
	$colan1_array[$i]=number_format(getValue("count(*)","hos.ipt","year(dchdate)= '".$_REQUEST["enyr"]."' and month(dchdate)='".$_REQUEST["mon"]."' and day(dchdate)='".$i."'"));
	$colyesan2_array[$i]=number_format(getValue("count(*)"," hos.ipt a, hdbms.tb_ipd b "," a.an=b.an and year(dchdate)='".$_REQUEST["enyr"]."' and month(dchdate)='".$_REQUEST["mon"]."' and day(dchdate)='".$i."'"));
	$colnoan3_array[$i]=number_format(getValue("count(*)","hos.ipt"," year(dchdate)= '".$_REQUEST["enyr"]."' and month(dchdate)='".$_REQUEST["mon"]."' and day(dchdate)='".$i."' and an not in (select an from hdbms.tb_ipd)"));
	if ($colan1_array[$i]<>0){$total++;}
}//end for
//////////////////////////////////
for ($i=1;$i<=31;$i++){
	if ($colan1_array[$i]>0){
		$dd=$i." ".$month[$_REQUEST["mon"]-1]." ".$_REQUEST["thyr"];
		$colan1=$colan1_array[$i]; $colyesan2=$colyesan2_array[$i]; $colnoan3=$colnoan3_array[$i];
		fwrite($objWrite, "\"$dd\",\"$colan1\",\"$colyesan2\",\"$colnoan3\"\n"); 
		unset($dd);unset($colan1);unset($colyesan2);unset($colnoan3);
	}//end if
} //end for
////////////////////////////////// SUM
fwrite($objWrite, "\"รวม\",\"$colan\",\"$colyesan\",\"$colnoan\"\n"); 
//////////////////////////////////
fclose($objWrite); 
//echo "<br>Generate CSV Done<br><a href=".$pathdir."".$filName.">Download</a>"; 
if(!is_null($_REQUEST["logno"])){
	savelogdetail($_REQUEST["logno"],"E","","");
	$detail ="Export to csv : anscancheck_monthdetail";
	updatelogdetail($_REQUEST["logno"],$detail);
	print "<script language='javascript' >window.location='".$pathdir."".$filName."';</script>";
}

}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>