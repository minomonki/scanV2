<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<?php
	if($_SESSION["PID"] == session_id()) {
	
	include ("../System_config/connection.php");
include("../System_config/connect.php");
include_once("../System_config/const.php");
include_once("../System_config/func.php");

///////////////////////////////////
$pathdir= "../exportfile/";
$filName = $filename.$today3.".csv"; 
$objWrite = fopen($pathdir.$filName, "w"); 
///////////////////////////////////
//write header title
$titleheader="ข้อมูลทั้งหมด ".$total." รายการ"; 
fwrite($objWrite, "\"$titleheader\"\n"); 
//////////////////////////////////
/// assign column
$col ="l.logno,l.username,l.logtype,l.ipaddr";
//if ($_REQUEST['txtusername']<>"" || $_REQUEST['txtipaddr']<>"" || $_REQUEST['txtloginname'] <>"" ||  $_REQUEST['txtloginlname'] <>"" || $_REQUEST['txtdocpassforuser']<>""){
	$col .=",day(l.ldate) as dd , month(l.ldate) as mm , year(l.ldate)+543 as yy, hour(l.ldate) as hh, minute(l.
ldate) as mn, second(l.ldate) as ss";
//}
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
	$col .=",d.an,d.pcode,d.doctype,day(d.ldate) as d , month(d.ldate) as m , year(d.ldate)+543 as y, hour(d.ldate) as h, minute(d.ldate) as mn2, second(d.ldate) as s, d.descr";
}
	$tbl = " tb_ipd_logfile as l ";
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
	$tbl .= ", tb_ipd_logfile_detail as d ";
}
$where =" username is not null ";
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
	$where .=" and l.logno=d.logno ";
}
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
	$orderby = " d.ldate desc ";
}else{
	$orderby = " ldate desc ";
}
$sql  ="select ".$col;
$sql .= " from ".$tbl;
$sql .= " where ".$where;
if ($_REQUEST['txtusername']<>""){$sql .=" and username like '%".$_REQUEST['txtusername']."%'";}
if ($_REQUEST['txtlogtype']<>""){$sql .=" and logtype='".$_REQUEST['txtlogtype']."'";}
if ($_REQUEST['txtipaddr']){$sql .=" and ipaddr='".$_REQUEST['txtipaddr']."'";}
if ($_REQUEST['txtpcode']<>""){$sql .=" and pcode='".$_REQUEST['txtpcode']."'";}
if ($_REQUEST['txtan']<>""){$sql .=" and an='".$_REQUEST['txtan']."'";}

if ($fromdate<>"" && $todate<>""){
	if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){//tb_ipd_logfile_detail
			if ($fromdate==$todate) {
				$sql .=" and d.ldate like '%".$fromdate."%'";
				//$sql .=" and day(l.ldate )='".$fd."' and month(l.ldate)='".$fm."' and year(l.ldate)='".$fy."'";
			}else{
				$sql .=" and d.ldate between '".$fromdate." 00:00:00'";
				$sql .=" and '".$todate." 23:59:59'";
			}
	}else{
			if ($fromdate==$todate) {
				$sql .=" and l.ldate like '%".$fromdate."%'";
				//$sql .=" and day(l.ldate )='".$fd."' and month(l.ldate)='".$fm."' and year(l.ldate)='".$fy."'";
			}else{
				$sql .=" and l.ldate between '".$fromdate." 00:00:00'";
				$sql .=" and '".$todate." 23:59:59'";
			}
	}//pcode,an
}else{
}

if ($_REQUEST['txtloginname']<>""){$sql .=" and username in (select username from tb_ipd_login where fname like '%".$_REQUEST['txtloginname']."%')";}
if ($_REQUEST['txtloginlname']<>""){$sql .=" and username in (select username from tb_ipd_login where lname like '%".$_REQUEST['txtloginlname']."%')";}
if ($_REQUEST['txtdocpassforuser']<>""){$sql .=" and username in (select password from tb_ipd_doc_pass where foruser like '%".$_REQUEST['txtdocpassforuser']."%')";}
//////////////////////////////////
//echo $sql."<br>";
$result=mysql_query($sql);
//$total=mysql_num_rows($result);
fwrite($objWrite, "\"ลำดับ\",\"การเข้าใช้งาน\",\"Username\",\"ชื่อ-สกุล\","); 
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
	fwrite($objWrite, "\"AN\",\"Doc Type\",\"การใช้เอกสาร\","); 
}
fwrite($objWrite, "\"วดป.-เวลา\",\"IP ADDRESS\""); 
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
	fwrite($objWrite, ",\"หมายเหตุ\""); 
}
fwrite($objWrite, "\n"); 

$id=1;
while($row = mysql_fetch_array($result)){
	if (!is_null($row['logtype'])){
		$key = array_search($row['logtype'], $logtypes_array);
		//echo $key;
		if ($key==5){$logtype="HosXP";}else{$logtype=$logtype_array[$key];}
	}			
	if ($row['logtype']=="E"){	
		$u_array = split('/', $row['username']);
		$usrname= $u_array[0]."/****";
	}elseif ($row['logtype']=="B"){
		$usrname= "HosXP";
	}elseif ($row['logtype']=="N" || $row['logtype']=="L" || $row['logtype']=="Q"){
		$usrname= "ระบบยืม";
	}else{
		$usrname= $row['username'];
	}
	if ($row['logtype']=="N" || $row['logtype']=="L" || $row['logtype']=="Q"){
		$name= getForuser($row['username']);
	}else{
		$comm="select fname,lname from tb_ipd_login where username='".$row['username']."'";
		$ans=mysql_query($comm);
		if ($ans){
			$line=mysql_fetch_array($ans);
			$name= $line['fname']."  ".$line['lname'];
		}
	}// end if name
	fwrite($objWrite, "\"$id\",\"$logtype\",\"$usrname\",\"$name\","); 
	if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
		$doctype= getDoctype($row['doctype']);
		if (!is_null($row['pcode'])){
			$key = array_search($row['pcode'], $pcodes_array);
			$pcode= $pcode_array[$key];
		}
		$an=$row['an'];
		fwrite($objWrite, "\"$an\",\"$doctype\",\"$pcode\","); 
	}
	if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
		$fdate=$row['d']."/".$row['m']."/".$row['y']." ".$row['h'].":".$row['mn2'].":".$row['s'];
	}else{
		$fdate=$row['dd']."/".$row['mm']."/".$row['yy']." ".$row['hh'].":".$row['mn'].":".$row['ss'];
	}
	$ipaddr=$row['ipaddr'];
	fwrite($objWrite, "\"$fdate\",\"$ipaddr\""); 
	if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
		$descr=$row['descr'];
		fwrite($objWrite, ",\"$descr\""); 
	}
	fwrite($objWrite, "\n"); 
	$id++;
	unset($logtype);unset($usrname);unset($name);unset($doctype);unset($pcode);unset($an);unset($ipaddr);unset($descr);
} //end of while loop
//////////////////////////////////
fclose($objWrite); 
//echo "<br>Generate CSV Done<br><a href=".$pathdir."".$filName.">Download</a>"; 

if($result){
	savelogdetail($_REQUEST["logno"],"E","","");
	$detail ="Export to csv : logfilereport2 - search/result";
	updatelogdetail($_REQUEST["logno"],$detail);
	print "<script language='javascript' >window.location='".$pathdir."".$filName."';</script>";
}


}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>