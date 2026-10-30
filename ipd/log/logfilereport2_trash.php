<?php

	session_start();
include ("../System_config/const.php");
	#print $_SESSION["Usergroup_ipd"];

	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

	include ("../System_config/connection.php");
	
  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

	<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../datepick/css/smoothness/jquery-ui-1.7.2.custom.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon_trash.ico">
	<link rel="stylesheet" href="../css/autocomplete.css"  type="text/css"/>
	<script type="text/javascript" src="../autocom/autocomplete.js"></script>
<title>:: IPD - TRASH -  Log File Search::</title>
<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif);	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold;	}
-->
</style>

<script type="text/javascript">  
function popup(url,name,windowWidth,windowHeight){       
    myleft=(screen.width)?(screen.width-windowWidth)/2:100;    
    mytop=(screen.height)?(screen.height-windowHeight)/2:100;      
    properties = "width="+windowWidth+",height="+windowHeight;   
    properties +=",scrollbars=yes,toolbar=no,menubar=no"
	properties +=",location=no, top="+mytop+",left="+myleft;      
    window.open(url,name,properties); 
}   
</script> 
<script type="text/javascript">  
var statusmsg=""

function hidestatus(){
window.status=statusmsg
return true
}

</script>

</head>

<body>

<table align="center" width="999" border="0" cellspacing="0" cellpadding="0">
  <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  
  <tr>
    <td background="../images/design_webIPD/web-IPDS01_03.jpg">
<form name="search" method="post" action="logfilereport2_trash.php">
<table align="center" width="701" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td colspan="4" class="head-topic"><img src='../images/trash_full.gif' border='0' />&nbsp;&nbsp;:: เงื่อนไขการแสดงผล ::</td>
  </tr>
  <tr>
    <td width="25%" align="right" bgcolor="#CCCCCC" class="topic">Username :</td>
    <td width="25%">
				<input type="text" name="txtusername" id="s_txtusername"  value="<?=$_REQUEST['txtusername'];?>" maxlength="30"/>
				<input name="h_txtusername" type="hidden" id="h_txtusername" value="" />
	</td>
    <td width="25%" align="right" bgcolor="#CCCCCC" class="topic">การเข้าใช้งาน :</td>
    <td width="25%">
	<select name="txtlogtype">
	<option value=""></option>
<?php
for ($i = 1; $i <= count($logtype_array); $i++){
	if ($i<>5){
	echo "<option value=".$logtypes_array[$i];
	if ($logtypes_array[$i]==$_REQUEST['txtlogtype']){echo " selected";}
	echo ">".$logtype_array[$i]."</option>";
	}
}
 ?>
	</select>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC" class="topic">ชื่อผู้ใช้งาน :</td>
    <td>
				<input type="text" name="txtloginname" id="s_txtloginname"  value="<?=$_REQUEST['txtloginname'];?>" maxlength="50"/>
				<input name="h_txtloginname" type="hidden" id="h_txtloginname" value="" />
	</td>
    <td align="right" bgcolor="#CCCCCC" class="topic">นามสกุลผู้ใช้งาน :</td>
    <td>
				<input type="text" name="txtloginlname" id="s_txtloginlname"  value="<?=$_REQUEST['txtloginlname'];?>" maxlength="50"/>
				<input name="h_txtloginlname" type="hidden" id="h_txtloginlname" value="" />
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC" class="topic">AN :</td>
    <td>
				<input type="text" name="txtan" id="s_txtan"  value="<?=$_REQUEST['txtan'];?>" maxlength="50"/>
				<input name="h_txtan" type="hidden" id="h_txtan" value="" />
	</td>
    <td align="right" bgcolor="#CCCCCC" class="topic">การใช้เอกสาร :</td>
    <td>
	<select name="txtpcode">
	<option value=""></option>
<?php
for ($i = 1; $i <= count($pcode_array); $i++){
	echo "<option value=".$pcodes_array[$i];
	if ($pcodes_array[$i]==$_REQUEST['txtpcode']){echo " selected";}
	echo ">".$pcode_array[$i]."</option>";
}
 ?>
	</select>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC" class="topic">ชื่อผู้ใช้งาน ระบบยืม :</td>
    <td>
				<input type="text" name="txtdocpassforuser" id="s_txtdocpassforuser"  value="<?=$_REQUEST['txtdocpassforuser'];?>" maxlength="50"/>
				<input name="h_txtdocpassforuser" type="hidden" id="h_txtdocpassforuser" value="" />
	</td>
    <td align="right" bgcolor="#CCCCCC" class="topic">IP Address :</td>
    <td>
				<input type="text" name="txtipaddr" id="s_txtipaddr"  value="<?=$_REQUEST['txtipaddr'];?>" maxlength="30"/>
				<input name="h_txtipaddr" type="hidden" id="h_txtipaddr" value="" />
	</td>
  </tr>
  <tr>
    <td width="158" align="right" bgcolor="#CCCCCC" class="topic">ตั้งแต่วันที่ :</td>
    <td colspan="3">
    	<input type="text" name="admit_s" id="admit_s" />
        
        <img src="../images/span.gif" width="10" />   
        <strong>ถึงวันที่.</strong>
        <img src="../images/span.gif" width="10" />   
        
        <input type="text" name="admit_e" id="admit_e" />
        <script type="text/javascript" src="../datepick/js/jquery-1.3.2.min.js"></script>
  	<script type="text/javascript" src="../datepick/js/jquery-ui-1.7.2.custom.min.js"></script>
	<?php
    	include("../datepick/datepick.php");
	?>

    </td>
  </tr>
  <tr>
    <td colspan="4" align="center">
    	<input type="submit" name="cmd_show" value="Show" />
        <input type="reset" name="cmd_reset_frm" value="Reset" />
    </td>
  </tr>
</table>
</form>
	
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0" >
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->
<?php
if (!is_null($_REQUEST['cmd_show'])){

/*
$fromdate=split("-",$_REQUEST['admit_s']);
$todate=split("-",$_REQUEST['admit_e']);
if ($fromdate[0]>2400){$fy=$fromdate[0]-543;}else{$fy=$fromdate[0];}
$fm=$fromdate[1];
$fd=$fromdate[2];
if ($todate[0]>2400){$ty=$todate[0]-543;}else{$ty=$todate[0];}
$tm=$todate[1];
$td=$todate[2];
*/
$fromdate=$_REQUEST['admit_s'];
$todate=$_REQUEST['admit_e'];
//echo "<br>".substr($fromdate,0,4)."/".$fromdate."<br>";
if (substr($fromdate,0,4)>2500){
	$yeardate=substr($fromdate,0,4)-543;
	$fromdate=str_replace(substr($fromdate,0,4),$yeardate,$fromdate);
}
//echo "<br>".$yeardate."<br>";
//echo "<br>".substr($fromdate,0,4)."/".$fromdate."<br>";
if (substr($todate,0,4)>2500){
	$yeardate=substr($todate,0,4)-543;
	$todate=str_replace(substr($todate,0,4),$yeardate,$todate);
}

include("../System_config/connect.php");
include_once("../System_config/func.php");
$pagesize=20;
/// assign column
	$col ="l.logno,l.username,l.logtype,l.ipaddr";
//if ($_REQUEST['txtusername']<>"" || $_REQUEST['txtlogtype']<>"" || $_REQUEST['txtipaddr']<>"" || $_REQUEST['txtloginname'] <>"" ||  $_REQUEST['txtloginlname'] <>"" || $_REQUEST['txtdocpassforuser']<>""){
	$col .=",day(l.ldate) as dd , month(l.ldate) as mm , year(l.ldate)+543 as yy, hour(l.ldate) as hh, minute(l.
ldate) as mn, second(l.ldate) as ss";
//}
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
	$col .=",d.an,d.pcode,d.doctype,day(d.ldate) as d , month(d.ldate) as m , year(d.ldate)+543 as y, hour(d.ldate) as h, minute(d.ldate) as mn2, second(d.ldate) as s, d.descr";
}
	$tbl = " tb_ipd_logfile_bak as l ";
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
	$tbl .= ", tb_ipd_logfile_detail_bak as d ";
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
	}
}else{
}

if ($_REQUEST['txtloginname']<>""){$sql .=" and username in (select username from tb_ipd_login where fname like '%".$_REQUEST['txtloginname']."%')";}
if ($_REQUEST['txtloginlname']<>""){$sql .=" and username in (select username from tb_ipd_login where lname like '%".$_REQUEST['txtloginlname']."%')";}
if ($_REQUEST['txtdocpassforuser']<>""){$sql .=" and username in (select password from tb_ipd_doc_pass where foruser like '%".$_REQUEST['txtdocpassforuser']."%')";}
$ans=mysql_query($sql);
$total=mysql_num_rows($ans);
$totalpage=ceil($total/$pagesize);
if (isset($_GET['pageid'])){
	$start=$pagesize*($_GET['pageid']-1);
	$id=$pagesize*($_GET['pageid']-1)+1;//items no.
}else{
	$start=0;$pageid=1;$id=1;
}
//echo "sql: $sql<br><br>";
//echo "totalpage: $totalpage<br>";
//echo "start: $start<br>";
//echo "pageid: $pageid<br>";
//echo "id: $id<br>";
//link to years
$query = $sql;
$query .=" order by ".$orderby." LIMIT $start,$pagesize";
//echo $query."<br>";
$result=mysql_query($query);
if ($result) {
	if ($fromdate<>"" && $todate<>""){
		$yrfrom=substr($fromdate,0,4)+543;
		$yrto=substr($todate,0,4)+543;
		echo "<br><div class=blue align=center>ตั้งแต่วันที่ ".substr($fromdate,8,2)."/".substr($fromdate,5,2)."/".$yrfrom." - ".substr($todate,8,2)."/".substr($todate,5,2)."/".$yrto."</div>";
	
	}
	echo "<div class='blackb' align='center'>แสดงข้อมูลทั้งหมด ".$total." รายการ";
	if ($totalpage>1){echo " ขณะนี้แสดงหน้าที่  ".$pageid."/".$totalpage;}
	echo "</div>";
	echo "<table class='rowh' align='center' width='90%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#a9a9a9'>";
	echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
	echo "<td align='center' class='hdtable' width='10%'>การเข้าใช้งาน</td>";
	echo "<td align='center' class='hdtable' width='10%'>Username</td>";
	echo "<td align='center' class='hdtable' width='15%'>ชื่อ-สกุล</td>";
	if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
		echo "<td align='center' class='hdtable' width='10%'>AN</td>";
		echo "<td align='center' class='hdtable' width='15%'>Doc Type</td>";
		echo "<td align='center' class='hdtable' width='10%'>การใช้เอกสาร</td>";
	}	
	echo "<td align='center' class='hdtable' width='15%'>วดป.-เวลา</td>";
	echo "<td align='center' class='hdtable' width='10%'>IP ADDRESS</td>";
	if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
		echo "<td align='center' class='hdtable' width='10%'>หมายเหตุ</td>";
	}	
	echo "</tr>";
		while($row = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>".$id."</td>";
			echo "<td align='center' class='listdetail'>";
			 if (!is_null($row['logtype'])){
			$key = array_search($row['logtype'], $logtypes_array);
			//echo $key;
			if ($key==5){echo "HosXP";}else{echo $logtype_array[$key];}
			}			
			echo "</td>";
			echo "<td align='center' class='listdetail'>";
			if ($row['logtype']=="E"){	
				$u_array = split('/', $row['username']);
				echo $u_array[0]."/****";
			}elseif ($row['logtype']=="B"){
				echo "HosXP";
			}elseif ($row['logtype']=="N" || $row['logtype']=="L" || $row['logtype']=="Q"){
				echo "ระบบยืม";
			}else{
				echo $row['username'];
			}
			echo "</td>";
			echo "<td align='left' class='listdetail'>&nbsp;";
			if ($row['logtype']=="N" || $row['logtype']=="L" || $row['logtype']=="Q"){
				echo getForuser($row['username']);
			}else{
				$comm="select fname,lname from tb_ipd_login where username='".$row['username']."'";
				$ans=mysql_query($comm);
				if ($ans){
					$line=mysql_fetch_array($ans);
					echo $line['fname']."&nbsp;&nbsp;".$line['lname'];
				}
			}// end if name
			echo "</td>";
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
			echo "<td align='center' class='listdetail'>".$row['an']."</td>";
			echo "<td align='center' class='listdetail'>";
			echo getDoctype($row['doctype']);
			echo "</td>";
			echo "<td align='center' class='listdetail'>&nbsp;";
			if (!is_null($row['pcode'])){
			$key = array_search($row['pcode'], $pcodes_array);
			echo $pcode_array[$key];
			}
			echo "</td>";
} // end if pcode,an	
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
			echo "<td align='center' class='listdetail'>".$row['d']."/".$row['m']."/".$row['y']." ".$row['h'].":".$row['mn2'].":".$row['s']." "."</td>";
}else{
			echo "<td align='center' class='listdetail'>".$row['dd']."/".$row['mm']."/".$row['yy']." ".$row['hh'].":".$row['mn'].":".$row['ss']." "."</td>";
}
			echo "<td align='center' class='listdetail'>".$row['ipaddr']."</td>";
if ($_REQUEST['txtpcode']<>"" || $_REQUEST['txtan']<>""){
			echo "<td align='center' class='listdetail'>";
if ($row['descr']==""){
}else{
?>			
<a href="javascript:popup('show_descr.php?descr=<?=$row['descr'];?>','null',640,360);"onMouseover="return hidestatus()" onMouseOut="return hidestatus()"><?=substr($row['descr'],0,80);?>...</a>
<?php
}//end if descr
			echo "</td>";
}// end if pcode,an
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table>";
}else{//no record found
	echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div>";
}// end of if chk $result

	//header table pages row 
	if ($totalpage>1){
		echo "<table align='center' width='90%'><tr><td>";
		// write link each no.page
		for ($i = 1; $i <= $totalpage; $i++){
			if ($i==$pageid){//this is a current page
				echo "<b>$i</b>&nbsp;";
			}else{
				echo "[<a href='?start=".$start."&pageid=".$i;
				if ($_REQUEST['cmd_show']<>""){echo "&cmd_show=".$_REQUEST['cmd_show'];}
				if ($_REQUEST['txtusername']<>""){echo "&txtusername=".$_REQUEST['txtusername'];}
				if ($_REQUEST['txtloginname']<>""){echo "&txtloginname=".$_REQUEST['txtloginname'];}
				if ($_REQUEST['txtloginlname']<>""){echo "&txtloginlname=".$_REQUEST['txtloginlname'];}
				if ($_REQUEST['txtdocpassforuser']<>""){echo "&txtdocpassforuser=".$_REQUEST['txtdocpassforuser'];}
				if ($_REQUEST['txtlogtype']<>""){echo "&txtlogtype=".$_REQUEST['txtlogtype'];}
				if ($_REQUEST['txtpcode']<>""){echo "&txtpcode=".$_REQUEST['txtpcode'];}
				if ($_REQUEST['txtan']<>""){echo "&txtan=".$_REQUEST['txtan'];}
				if ($_REQUEST['admit_s']<>""){echo "&admit_s=".$_REQUEST['admit_s'];}
				if ($_REQUEST['admit_e']<>""){echo "&admit_e=".$_REQUEST['admit_e'];}
				if ($_REQUEST['txtipaddr']){echo "&ipaddr=".$_REQUEST['txtipaddr'];}
				echo "'>$i</a>]&nbsp;";
			}//end if
		}//end for
	echo "</td></tr></table>";
	}//end if totalpage
}//end show table
?>
	</td><!--end of detail body -->
</tr>
</table>
	<!-- central main -->
    <img src="../images/span.gif" height="20" />
    </td>
  </tr>
  <tr><td><?php include ("../System_Design/footer.php"); ?></td></tr>
</table>

<script type="text/javascript">
function make_autocom(autoObj,showObj){
	var mkAutoObj=autoObj; 
	var mkSerValObj=showObj; 
	new Autocomplete(mkAutoObj, function() {
		this.setValue = function(id) {		
			document.getElementById(mkSerValObj).value = id;
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick ) 
			return ;	
		//return "data.php?q=" +encodeURIComponent(this.value);
		return "../autocom/get_tb_ipd_logfile_bak_username.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom("s_txtusername","h_txtusername");
</script>
<script type="text/javascript">
function make_autocom2(autoObj,showObj){
	var mkAutoObj=autoObj; 
	var mkSerValObj=showObj; 
	new Autocomplete(mkAutoObj, function() {
		this.setValue = function(id) {		
			document.getElementById(mkSerValObj).value = id;
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick ) 
			return ;	
		//return "data.php?q=" +encodeURIComponent(this.value);
		return "../autocom/get_tb_ipd_logfile_detail_bak_an.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom2("s_txtan","h_txtan");
</script>
<script type="text/javascript">
function make_autocom3(autoObj,showObj){
	var mkAutoObj=autoObj; 
	var mkSerValObj=showObj; 
	new Autocomplete(mkAutoObj, function() {
		this.setValue = function(id) {		
			document.getElementById(mkSerValObj).value = id;
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick ) 
			return ;	
		//return "data.php?q=" +encodeURIComponent(this.value);
		return "../autocom/get_tb_ipd_logfile_bak_ip.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom3("s_txtipaddr","h_txtipaddr");
</script>
<script type="text/javascript">
function make_autocom4(autoObj,showObj){
	var mkAutoObj=autoObj; 
	var mkSerValObj=showObj; 
	new Autocomplete(mkAutoObj, function() {
		this.setValue = function(id) {		
			document.getElementById(mkSerValObj).value = id;
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick ) 
			return ;	
		//return "data.php?q=" +encodeURIComponent(this.value);
		return "../autocom/get_tb_ipd_login_name.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom4("s_txtloginname","h_txtloginname");
</script>
<script type="text/javascript">
function make_autocom5(autoObj,showObj){
	var mkAutoObj=autoObj; 
	var mkSerValObj=showObj; 
	new Autocomplete(mkAutoObj, function() {
		this.setValue = function(id) {		
			document.getElementById(mkSerValObj).value = id;
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick ) 
			return ;	
		//return "data.php?q=" +encodeURIComponent(this.value);
		return "../autocom/get_tb_ipd_login_lname.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom5("s_txtloginlname","h_txtloginlname");
</script>
<script type="text/javascript">
function make_autocom6(autoObj,showObj){
	var mkAutoObj=autoObj; 
	var mkSerValObj=showObj; 
	new Autocomplete(mkAutoObj, function() {
		this.setValue = function(id) {		
			document.getElementById(mkSerValObj).value = id;
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick ) 
			return ;	
		//return "data.php?q=" +encodeURIComponent(this.value);
		return "../autocom/get_tb_ipd_doc_pass_foruser.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom6("s_txtdocpassforuser","h_txtdocpassforuser");
</script>

</body>
</html>


<?php
}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>