<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php
	//session_start();	
	if($_SESSION["PID"] == session_id()) {

include ("../System_config/connection.php");
include("../System_config/connect.php");
include("../System_config/const.php");
include("../System_config/func.php");

////////////////////////////////////
$colall 	= $_GET["colall"];
$colallan 	= $_GET["colallan"];
$colallan0 	= $_GET["colallan0"];
$colallyesan 	= $_GET["colallyesan"];
$colallnoan 	= $_GET["colallnoan"];
///////////////////////////////////
$pathdir= "../exportfile/";
$filName = "anscancheck".$today3.".csv";  
$objWrite = fopen($pathdir.$filName, "w"); 
//write header title
$titleheader="สรุปเอกสารสแกน AN ทั้งหมด ตั้งแต่วันที่ ".$_REQUEST['iptmindate']." - ".$_REQUEST['iptmaxdate'];
fwrite($objWrite, "\"$titleheader\"\n"); 
fwrite($objWrite, "\"จำนวน AN ทั้งหมด\",\"จำนวน AN admitted\",\"จำนวน AN ในระบบ\",\"จำนวน AN สแกนแล้ว\",\"จำนวน AN ที่สแกนไม่ครบ\"\n"); 
fwrite($objWrite, "\"$colall\",\"$colallan0\",\"$colallan\",\"$colallyesan\",\"$colallnoan\"\n"); 
//////////////////////////////////
fwrite($objWrite, "\"ปี\",\"จำนวน AN ในระบบ\",\"จำนวน AN สแกนแล้ว\",\"จำนวน AN ที่สแกนไม่ครบ\"\n"); 
//////////////////////////////////
/*$thminyr=$_REQUEST['minyr']+543;
$thmaxyr=$_REQUEST['maxyr']+543;
$totalyear=$_REQUEST['maxyr']-$_REQUEST['minyr']+1;
//echo "total=".$totalyear."<br>";
for ($i=0;$i<$totalyear;$i++){
	if ($i==0){$enlist=$_REQUEST['maxyr'];$thlist=$thmaxyr;}else{$enlist=$enlist-$i;$thlist=$thlist-$i;}
	$enyr_array[$i]=$enlist;
	$thyr_array[$i]=$thlist;
	//echo $yr_array[$i];
}*/
$select="select year(dchdate) as yr, count( * ) AS sum_an "; //, sum( pages ) as pages
$from=" from hos.ipt ";
$where=" where dchdate is not null";
$groupby=" group by year(dchdate)";
$query =$select.$from.$where.$groupby;
//echo $query."<br>";
$result=mysql_query($query);
//////////////////////////////////
while($row = mysql_fetch_array($result)){
	$thyr=$row[0]+543;
	$colan=number_format($row[1]);
	$colyesan=number_format(getValue("count(*)"," hos.ipt a, hdbms.tb_ipd b "," a.an=b.an and year(dchdate)= '".$row[0]."'"));
	$colnoan=number_format(getValue("count(*)","hos.ipt"," year(dchdate)= '".$row[0]."' and an not in (select an from hdbms.tb_ipd)"));
	fwrite($objWrite, "\"$thyr\",\"$colan\",\"$colyesan\",\"$colnoan\"\n"); 
	unset($thyr);unset($colan);unset($colyesan);unset($colnoan);
} //end while loop
////////////////////////////////// SUM
fwrite($objWrite, "\"รวม\",\"$colallan\",\"$colallyesan\",\"$colallnoan\"\n"); 
//////////////////////////////////
fclose($objWrite); 
//echo "<br>Generate CSV Done<br><a href=".$pathdir."".$filName.">Download</a>"; 
if(!is_null($_REQUEST["logno"])){
	savelogdetail($_REQUEST["logno"],"E","","");
	$detail ="Export to csv : anscancheck";
	updatelogdetail($_REQUEST["logno"],$detail);
	print "<script language='javascript' >window.location='".$pathdir."".$filName."';</script>";
}

}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>