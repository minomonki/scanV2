<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	if($_SESSION["PID"] == session_id()) {
	
	include ("../System_config/connection.php");
include("../System_config/connect.php");
include_once("../System_config/const.php");
include_once("../System_config/func.php");

////////////////////////////////////
$sum_an 	= $_GET["sum_an"];
$sum_pages 	= $_GET["pages"];
$sum_sizes 	= $_GET["sizes"];
///////////////////////////////////
$pathdir= "../exportfile/";
$filName = $filename.$today3.".csv"; 
$objWrite = fopen($pathdir.$filName, "w"); 
//write header title
$titleheader="ข้อมูล AN ทั้งหมดในระบบ ปี ".$_REQUEST["yr"]; 
fwrite($objWrite, "\"$titleheader\"\n"); 
//////////////////////////////////
$select="select year(datescan) as yr,month(datescan) as mon , count( * ) AS sum_an";
$from=" from tb_ipd ";
$where=" where year(datescan)=".$_REQUEST["yr"];
$groupby=" group by year(datescan),month(datescan)";
$orderby .=" order by mon";
$query =$select.$from.$where.$groupby.$orderby;
$result=mysql_query($query);
//$total=mysql_num_rows($result);
fwrite($objWrite, "\"เดือน\",\"จำนวน AN ในระบบ\",\"จำนวนหน้า\","); 
fwrite($objWrite, "\"ขนาด (Mb)\"\n"); 
while($row = mysql_fetch_array($result)){
	$moname=$month[$row[1]-1];
	$sizes=getValue("sum( OCTET_LENGTH( imagescan ) /1048576 )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and year(datescan)=".$row['yr']." and month(datescan)=".$row['mon']."");
	$pages=getValue("sum( b.pages )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and year(datescan)=".$row['yr']." and month(datescan)=".$row['mon']."");
	fwrite($objWrite, "\"$moname\",\"$row[2]\",\"$pages\","); 
	fwrite($objWrite, "\"$sizes\"\n"); 
	unset($moname);
	unset($sizes);unset($pages);
} //end of while loop
////////////////////////////////// SUM
fwrite($objWrite, "\"รวม\",\"$sum_an\",\"$sum_pages\","); 
fwrite($objWrite, "\"$sum_sizes\"\n"); 
//////////////////////////////////
fclose($objWrite); 
//echo "<br>Generate CSV Done<br><a href=".$pathdir."".$filName.">Download</a>"; 

if($result){
	savelogdetail($_REQUEST["logno"],"E","","");
	$detail ="Export to csv : anreport_yeardetail";
	updatelogdetail($_REQUEST["logno"],$detail);
	print "<script language='javascript' >window.location='".$pathdir."".$filName."';</script>";
}


}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>