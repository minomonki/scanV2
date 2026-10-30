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
	<link rel="stylesheet" href="../datepick/css/base/jquery.ui.all.css">
<title>:: IPD - AN Report by search::</title>
<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif);	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold;	}
-->
</style>
<script src="../datepick/jquery-1.7.1.js"></script>
<script src="../datepick/js/jquery.ui.core.js"></script>
<script src="../datepick/js/jquery.ui.widget.js"></script>
<script src="../datepick/js/jquery.ui.datepicker.js"></script>
<script src="../datepick/js/jquery.ui.datepicker-th.js"></script>
<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			showOn: "button",
			buttonImage: "../datepick/calendar.gif",
			buttonImageOnly: true
		});
	});
</script>
<script>
	$(function() {
		$.datepicker.setDefaults( $.datepicker.regional[ "th" ] );
		$( "#datepicker" ).datepicker( $.datepicker.regional[ "th" ] );
		$( "#locale" ).change(function() {
			$( "#datepicker" ).datepicker( "option",
				$.datepicker.regional[ $( this ).val() ] );
		});
	});
</script>

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
<form name="search" method="post" action="anreport2.php">
<table align="center" width="70%" border="0" bordercolor="#C0C0C0" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
  <tr>
    <td colspan="4" class="head-topic">:: เงื่อนไขการแสดงผล ::</td>
  </tr>
  <tr>
    <td width="35%" align="right" bgcolor="#CCCCCC" class="topic">เอกสารที่สแกน ตั้งแต่วันที่ :</td>
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
    <td colspan="4" align="center"><BR>
    	<input type="submit" name="cmd_show" value="Show" />
        <input type="reset" name="cmd_reset_frm" value="Reset" />
    </td>
  </tr>
</table>
</form>
<!--##################################-->
	
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
		if (substr($fromdate,0,4)<2500){
			$yeardate=substr($fromdate,0,4)-543;
			$fromdate=str_replace(substr($fromdate,0,4),$yeardate,$fromdate);
		}
		//echo "<br>".$yeardate."<br>";
		//echo "<br>".substr($fromdate,0,4)."/".$fromdate."<br>";
		if (substr($todate,0,4)<2500){
			$yeardate=substr($todate,0,4)-543;
			$todate=str_replace(substr($todate,0,4),$yeardate,$todate);
		}

include("../System_config/connect.php");
include_once("../System_config/func.php");
echo "<BR><div class='blackb' align='center'>";
echo "สรุปข้อมูล AN ในระบบ ตามการค้นหา ตั้งแต่ <span class=blue>".substr($fromdate,8,2)."/".substr($fromdate,5,2)."/".substr($fromdate,0,4)."</span> ถึง <span class=blue>".substr($todate,8,2)."/".substr($todate,5,2)."/".substr($todate,0,4)."</span>";
//###################################
//$colanreport=getValue("count(a.an)","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and datescan between '$fromdate' and '$todate'");
//$colpages=getValue("sum( pages )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and datescan between '$fromdate' and '$todate'");
//$colsizes=getValue("sum( OCTET_LENGTH( imagescan ) /1048576 )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and datescan between '$fromdate' and '$todate'");
$colanreport=getValue("count(*)","tb_ipd "," datescan between '$fromdate' and '$todate'");
//$colpages=getValue("sum( pages )","tb_ipd "," datescan between '$fromdate' and '$todate'");
$colpages=getValue("sum( b.pages )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and datescan between '$fromdate' and '$todate'");
$colsizes=getValue("sum( OCTET_LENGTH( imagescan ) /1048576 )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and datescan between '$fromdate' and '$todate'");
echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
echo "<tr bgcolor='#3399CC'>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ในระบบ</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวนหน้า</td>";
echo "<td align='center' class='hdtable' width='30%'>ขนาด (Mb)</td>";
echo "</tr>";
if (fmod($id,2)) {$rcolor=' bgcolor=#99FF99';}else{$rcolor=' bgcolor=#FFFF5B';}
echo "<tr".$rcolor.">";
echo "<td align='center' class='listdetail'>".number_format($colanreport,0)."</td>";
echo "<td align='center' class='listdetail'>".number_format($colpages,0)."</td>";
echo "<td align='center' class='listdetail'>".$colsizes."</td>";
echo "</tr>";
echo "</table>";

//###################################
//###################################
$pagesize=20;
$select="select year(datescan) as yr,month(datescan) as mon,day(datescan) as d , count( * ) AS sum_an";
$from=" from tb_ipd ";
$where=" where "; // a.an = b.anand year(datescan)=".$_REQUEST["yr"]." and month(datescan)=".$_REQUEST["mon"];
if ($fromdate<>"" && $todate<>""){
	if ($fromdate==$todate) {
		$where .=" datescan like '%".$fromdate."%'";
		//$sql .=" and day(l.ldate )='".$fd."' and month(l.ldate)='".$fm."' and year(l.ldate)='".$fy."'";
	}else{
		$where .=" datescan between '".$fromdate."'";
		$where .=" and '".$todate."'";
	}
}
$groupby=" group by year(datescan),month(datescan),day(datescan)";
$orderby .=" order by d";

$sql =$select.$from.$where.$groupby;
$ans=mysql_query($sql);
$total=mysql_num_rows($ans);
$totalpage=ceil($total/$pagesize);
if (isset($_GET['pageid'])){
	$start=$pagesize*($_GET['pageid']-1);
	$id=$pagesize*($_GET['pageid']-1)+1;//items no.
}else{
	$start=0;$pageid=1;$id=1;
}

//link to years
$query =$select.$from.$where.$groupby.$orderby;
$query .=" LIMIT $start,$pagesize";
//echo $query."<br>";
$result=mysql_query($query);
if ($totalpage>0) {
	echo "<br>";
	echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#ffffff'>";
	echo "<td align='center' class='hdtable'>";
	echo "<div class='blackb' align='center'>รายละเอียดการค้นหา พบข้อมูลทั้งหมด <span class=blue>".$total."</span> รายการ";
	if ($totalpage>1){echo " ขณะนี้แสดงหน้าที่  ".$pageid."/".$totalpage;}
	echo "</div>";
	echo "</td>";
	echo "<td align='right' class='hdtable' width='35'>"; 
	echo "<a title='Export to csv' target='_blank' href=anreport2_export2csv.php?logno=".$_SESSION["logno"]."&sum_an=".$colanreport."&pages=".$colpages."&sizes=".$colsizes."&fromdate=".$fromdate."&todate=".$todate.">";
	echo "<img src='../images/export-excel-icon.png' border=0>";
	echo "</a>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
echo "<tr bgcolor='#a9a9a9'>";
echo "<td align='center' class='hdtable' width='15%'>วดป.</td>";
echo "<td align='center' class='hdtable' width='25%'>จำนวน AN ในระบบ</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวนหน้า</td>";
echo "<td align='center' class='hdtable' width='30%'>ขนาด (Mb)</td>";
echo "</tr>";
		while($row = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			$sizes=getValue("sum( OCTET_LENGTH( imagescan ) /1048576 )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and year(datescan)=".$row['yr']." and month(datescan)=".$row['mon']." and day(datescan)=".$row['d']."");
			$pages=getValue("sum(b.pages)","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and year(datescan)=".$row['yr']." and month(datescan)=".$row['mon']." and day(datescan)=".$row['d']."");
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>";
			//echo "<a title='ดูรายละเอียด' onMouseover='return hidestatus()' onMouseOut='return hidestatus()' target='_blank' href=anreport_monthdetail.php?yr=".$row['yr']."&mon=".$row['mon']."&sum_an=".$row['sum_an']."&pages=".$row['pages']."&sizes=".$row['sizes'].">";
			echo $row['d']." ".$month[$row['mon']-1]." ".$row['yr'];
			//echo "</a>";
			echo "</td>";
			echo "<td align='center' class='listdetail'>".number_format($row['sum_an'],0)."</td>";
			echo "<td align='center' class='listdetail'>".number_format($pages,0)."</td>";
			echo "<td align='center' class='listdetail'>".$sizes."</td>";
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table><BR><BR>";
}else{//no record found
	echo "<BR><BR><div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div><BR>";
}// end of if chk $result

	//header table pages row 
	if ($totalpage>1){
		echo "<table align='center' width='90%'><tr><td>";
		// write link each no.page
		for ($i = 1; $i <= $totalpage; $i++){
			if ($i==$pageid){//this is a current page
				echo "<b>$i</b>&nbsp;";
			}else{
				echo "[<a href='?start=".$start."&pageid=".$i."&admit_s=".$_REQUEST['admit_s']."&admit_e=".$_REQUEST['admit_e'];
				echo "'>$i</a>]&nbsp;";
			}//end if
		}//end for
	echo "</td></tr></table>";
	}//end if totalpage

//###################################


}else{
} // end if cmd_show
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


</body>
</html>


<?php
}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>