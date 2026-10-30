<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<?php
	//session_start();	
	if($_SESSION["PID"] == session_id()) {

	include ("../System_config/connection.php");
include("../System_config/connect.php");
include("../System_config/const.php");
include("../System_config/func.php");

////////////////////////////////////
//$status 	= $_GET["status"];
//$enmindate 	= $_GET["enmindate"];
//$enmaxdate 	= $_GET["enmaxdate"];
//$thmindate 	= $_GET["thmindate"];
//$thmaxdate 	= $_GET["thmaxdate"];
///////////////////////////////////
$pathdir= "../exportfile/";
$filName = "anscancheck_list".$today3.".csv";  
$objWrite = fopen($pathdir.$filName, "w"); 
//////////////////////////////////
if ($_REQUEST["status"]==0){ // list all dchdate is null
	$titledetail=" จำนวน AN admitted ตั้งแต่ ".getFormatdate($_REQUEST["thmindate"],1)." ถึง ".getFormatdate($_REQUEST["thmaxdate"],1);
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where dchdate is null or dchdate=''";
}elseif ($_REQUEST["status"]==1){ // list all yesan
	$titledetail=" จำนวน AN สแกนแล้ว ตั้งแต่ ".getFormatdate($_REQUEST["thmindate"],1)." ถึง ".getFormatdate($_REQUEST["thmaxdate"],1);
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(datescan) as dd , month(datescan) as mm , year(datescan) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an= b.an";
}elseif ($_REQUEST["status"]==2){ // list all noan
	$titledetail=" จำนวน AN ที่สแกนไม่ครบ  ตั้งแต่ ".getFormatdate($_REQUEST["thmindate"],1)." ถึง ".getFormatdate($_REQUEST["thmaxdate"],1);
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where an not in (select an from hdbms.tb_ipd)";
}elseif ($_REQUEST["status"]==3){ // list yesan by year
	$titledetail=" จำนวน AN สแกนแล้ว ปี ".$_REQUEST["thyr"];
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(outdate) as dd , month(outdate) as mm , year(outdate) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an=b.an and year(dchdate)='".$_REQUEST["enyr"]."'";
}elseif ($_REQUEST["status"]==4){ // list noan by year
	$titledetail=" จำนวน AN ที่สแกนไม่ครบ ปี ".$_REQUEST["thyr"];
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where year(dchdate)='".$_REQUEST["enyr"]."' and an not in (select an from hdbms.tb_ipd)";
}elseif ($_REQUEST["status"]==5){ // list yesan by month
	$titledetail=" จำนวน AN สแกนแล้ว เดือน ".$month[$_REQUEST["mon"]-1]." ปี ".$_REQUEST["thyr"];
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(outdate) as dd , month(outdate) as mm , year(outdate) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an=b.an and year(dchdate)='".$_REQUEST["enyr"]."' and month(dchdate)='".$_REQUEST["mon"]."'";
}elseif ($_REQUEST["status"]==6){ // list noan by month
	$titledetail=" จำนวน AN ที่สแกนไม่ครบ เดือน ".$month[$_REQUEST["mon"]-1]." ปี ".$_REQUEST["thyr"];
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where year(dchdate)='".$_REQUEST["enyr"]."' and month(dchdate)='".$_REQUEST["mon"]."' and an not in (select an from hdbms.tb_ipd)";
}elseif ($_REQUEST["status"]==7){ // list yesan by day/month/year
	$titledetail=" จำนวน AN สแกนแล้ว วันที่ ".$_REQUEST["day"]." ".$month[$_REQUEST["mon"]-1]." ".$_REQUEST["thyr"];
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(outdate) as dd , month(outdate) as mm , year(outdate) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an=b.an and dchdate='".$_REQUEST["enyr"]."-".$_REQUEST["mon"]."-".$_REQUEST["day"]."'";
}elseif ($_REQUEST["status"]==8){ // list noan by day/month/year
	$titledetail=" จำนวน AN ที่สแกนไม่ครบวันที่ ".$_REQUEST["day"]." ".$month[$_REQUEST["mon"]-1]." ".$_REQUEST["thyr"];
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where dchdate='".$_REQUEST["enyr"]."-".$_REQUEST["mon"]."-".$_REQUEST["day"]."' and an not in (select an from hdbms.tb_ipd)";
}elseif ($_REQUEST["status"]==9){ // list yesan by search from-to
	$titledetail=" จำนวน AN สแกนแล้ว ตั้งแต่ ".getFormatdate($_REQUEST["thmindate"],1)." - ".getFormatdate($_REQUEST["thmaxdate"],1);
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(outdate) as dd , month(outdate) as mm , year(outdate) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an=b.an and dchdate between '".$_REQUEST["enmindate"]."' and '".$_REQUEST["enmaxdate"]."'";
}elseif ($_REQUEST["status"]==10){ // list noan by search from-to
	$titledetail=" จำนวน AN ที่สแกนไม่ครบ  ตั้งแต่ ".getFormatdate($_REQUEST["thmindate"],1)." - ".getFormatdate($_REQUEST["thmaxdate"],1);
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where dchdate between '".$_REQUEST["enmindate"]."' and '".$_REQUEST["enmaxdate"]."' and an not in (select an from hdbms.tb_ipd)";
}
//////////////////////////////////
$query =$select.$from.$where.$groupby.$orderby;
//echo $query."<br>";
$result=mysql_query($query);
$id=1;
//////////////////////////////////
//write header title
fwrite($objWrite, "\"$titledetail\"\n"); 
//////////////////////////////////
while($row = mysql_fetch_array($result)){
			//////// table header ////////
			if ($id==1){
				if ($_REQUEST["status"]%2==0){
					fwrite($objWrite, "\"ลำดับ\",\"AN\",\"HN\"\n"); 
				}else{
					fwrite($objWrite, "\"ลำดับ\",\"AN\",\"HN\",\"ชื่อ\",\"นามสกุล\",\"dchdate\",\"datescan\"\n"); 
				}
			}
			/////////////////////////////
			if ($_REQUEST["status"]%2==0){
					$andata=$row['an'];$hndata=$row['hn'];
					fwrite($objWrite, "\"$id\",\"$andata\",\"$hndata\"\n"); 
			}else{
					$andata=$row['an'];$hndata=$row['hn']; $firstnamedata=$row['firstname'];$lastnamedata=$row['lastname']; $dchdatedata=$row['d']."/".$row['m']."/".$row['y'];$datescandata=$row['dd']."/".$row['mm']."/".$row['yy'];;
					fwrite($objWrite, "\"$id\",\"$andata\",\"$hndata\",\"$firstnamedata\",\"$lastnamedata\",\"$dchdatedata\",\"$datescandata\"\n"); 
			}
			//////////////////////////////
			$id++;
} //end of while loop
////////////////////////////////// SUM
//fwrite($objWrite, "\"รวม\",\"$colallan\",\"$colallyesan\",\"$colallnoan\"\n"); 
//////////////////////////////////
fclose($objWrite); 
//echo "<br>Generate CSV Done<br><a href=".$pathdir."".$filName.">Download</a>"; 
if(!is_null($_REQUEST["logno"])){
	savelogdetail($_REQUEST["logno"],"E","","");
	$detail ="Export to csv : anscancheck_list";
	if ($_REQUEST["status"]==0){
		$detail .="_an-admitted";
	}elseif ($_REQUEST["status"]==1){
		$detail .="_all-an-scanned";
	}elseif ($_REQUEST["status"]==2){
		$detail .="_all-an-no-scanned";
	}elseif ($_REQUEST["status"]==3){
		$detail .="_an-scanned-by-year";
	}elseif ($_REQUEST["status"]==4){
		$detail .="_an-no-scanned-by-year";
	}elseif ($_REQUEST["status"]==5){
		$detail .="an-scanned-by-month";
	}elseif ($_REQUEST["status"]==6){
		$detail .="an-no-scanned-by-month";
	}elseif ($_REQUEST["status"]==7){
		$detail .="an-scanned-by-date";
	}elseif ($_REQUEST["status"]==8){
		$detail .="an-no-scanned-by-date";
	}elseif ($_REQUEST["status"]==9){
		$detail .="an-scanned-by-search";
	}elseif ($_REQUEST["status"]==10){
		$detail .="an-no-scanned-by-search";
	}
	updatelogdetail($_REQUEST["logno"],$detail);
	print "<script language='javascript' >window.location='".$pathdir."".$filName."';</script>";
}

}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>