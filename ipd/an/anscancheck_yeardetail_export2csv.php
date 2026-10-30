<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />


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
$filName = "anscancheck_yeardetail".$today3.".csv";  
$objWrite = fopen($pathdir.$filName, "w"); 
//write header title
$titleheader="เอกสารสแกน AN ทั้งหมดในระบบ ปี ".$_REQUEST["thyr"];
fwrite($objWrite, "\"$titleheader\"\n"); 
//////////////////////////////////
fwrite($objWrite, "\"เดือน\",\"จำนวน AN ในระบบ\",\"จำนวน AN สแกนแล้ว\",\"จำนวน AN ที่สแกนไม่ครบ\"\n"); 
//////////////////////////////////
$total=0;
for ($i=1;$i<=12;$i++){
	$colan_array[$i]=number_format(getValue("count(*)","hos.ipt","year(dchdate)= '".$_REQUEST["enyr"]."' and month(dchdate)='".$i."'"));
	$colyesan_array[$i]=number_format(getValue("count(*)"," hos.ipt a, hdbms.tb_ipd b "," a.an=b.an and year(dchdate)='".$_REQUEST["enyr"]."' and month(dchdate)='".$i."'"));
	$colnoan_array[$i]=number_format(getValue("count(*)","hos.ipt"," year(dchdate)= '".$_REQUEST["enyr"]."' and month(dchdate)='".$i."' and an not in (select an from hdbms.tb_ipd)"));
	if ($colan_array[$i]<>0){$total++;}
}
//////////////////////////////////
for ($i=1;$i<=12;$i++){
	if ($colan_array[$i]>0){
		$thmon=$month[$i-1];
		$colan2=$colan_array[$i]; $colyesan2=$colyesan_array[$i]; $colnoan2=$colnoan_array[$i];
		fwrite($objWrite, "\"$thmon\",\"$colan2\",\"$colyesan2\",\"$colnoan2\"\n"); 
		unset($thmon);unset($colan2);unset($colyesan2);unset($colnoan2);
	}//end if
} //end for loop
////////////////////////////////// SUM
fwrite($objWrite, "\"รวม\",\"$colan\",\"$colyesan\",\"$colnoan\"\n"); 
//////////////////////////////////
fclose($objWrite); 
//echo "<br>Generate CSV Done<br><a href=".$pathdir."".$filName.">Download</a>"; 
if(!is_null($_REQUEST["logno"])){
	savelogdetail($_REQUEST["logno"],"E","","");
	$detail ="Export to csv : anscancheck_yeardetail";
	updatelogdetail($_REQUEST["logno"],$detail);
	print "<script language='javascript' >window.location='".$pathdir."".$filName."';</script>";
}

}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>