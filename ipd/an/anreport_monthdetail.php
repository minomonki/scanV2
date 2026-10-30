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

<title>:: IPD - AN Report ::</title>
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
	
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0" >
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->
<br>
<?php
include("../System_config/connect.php");
include_once("../System_config/func.php");
echo "<div class='blackb' align='center'>";
echo "ข้อมูล AN ทั้งหมดในระบบ เดือน <span class=blue>".$month[$_REQUEST["mon"]-1]."</span> ปี <span class=blue>".$_REQUEST["yr"]."</span>";
echo "</div><br>";
//###################################
echo "<table class='rowh' align='center' width='60%' cellspacing='1' cellpadding='1' border='0'>";// create table title
echo "<tr bgcolor='#3399CC'>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ในระบบ</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวนหน้า</td>";
echo "<td align='center' class='hdtable' width='30%'>ขนาด (Mb)</td>";
echo "</tr>";
if (fmod($id,2)) {$rcolor=' bgcolor=#99FF99';}else{$rcolor=' bgcolor=#FFFF5B';}
echo "<tr".$rcolor.">";
echo "<td align='center' class='listdetail'>". number_format($_REQUEST["sum_an"],0)."</td>";
echo "<td align='center' class='listdetail'>".number_format($_REQUEST["pages"],0)."</td>";
echo "<td align='center' class='listdetail'>".number_format($_REQUEST["sizes"],4)."</td>";
echo "</tr>";
echo "</table>";

//###################################
$pagesize=20;
$select="select year(datescan) as yr,month(datescan) as mon,day(datescan) as d, count( * ) AS sum_an";
$from=" from tb_ipd ";
$where=" where year(datescan)=".$_REQUEST["yr"]." and month(datescan)=".$_REQUEST["mon"];
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
	include_once("../System_config/func.php");
	echo "<br>";
	if ($totalpage>1){echo " ขณะนี้แสดงหน้าที่  ".$pageid."/".$totalpage;}
	echo "</div><br>";
	echo "<table class='rowh' align='center' width='60%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#ffffff'>";
	echo "<td align='center' class='hdtable'>";
	echo "<div class='blackb' align='center'>พบข้อมูลทั้งหมด <span class=blue>".$total."</span> วัน";
	echo "</div>";
	echo "</td>";
	echo "<td align='right' class='hdtable' width='35'>";//onMouseover='return hidestatus()' onMouseOut='return hidestatus()' 
	echo "<a title='Export to csv' target='_blank' href=anreport_monthdetail_export2csv.php?logno=".$_SESSION["logno"]."&sum_an=".$_REQUEST["sum_an"]."&pages=".$_REQUEST["pages"]."&sizes=".$_REQUEST["sizes"]."&yr=".$_REQUEST["yr"]."&mon=".$_REQUEST["mon"].">";
	echo "<img src='../images/export-excel-icon.png' border=0>";
	echo "</a>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
echo "<table class='rowh' align='center' width='60%' cellspacing='1' cellpadding='1' border='0'>";// create table title
echo "<tr bgcolor='#a9a9a9'>";
echo "<td align='center' class='hdtable' width='15%'>วดป.</td>";
echo "<td align='center' class='hdtable' width='25%'>จำนวน AN ในระบบ</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวนหน้า</td>";
echo "<td align='center' class='hdtable' width='30%'>ขนาด (Mb)</td>";
echo "</tr>";
		while($row = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			$sizes=getValue("sum( OCTET_LENGTH( imagescan ) /1048576 )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and year(datescan)=".$row['yr']." and month(datescan)=".$row['mon']." and day(datescan)=".$row['d']."");
			$pages=getValue("sum( b.pages )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and year(datescan)=".$row['yr']." and month(datescan)=".$row['mon']." and day(datescan)=".$row['d']."");
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>";
			echo $row['d']." ".$month[$row['mon']-1]." ".$row['yr'];
			echo "</td>";
			echo "<td align='center' class='listdetail'>";
			echo "<a target='_blank' title='ดูรายละเอียด' onMouseover='return hidestatus()' onMouseOut='return hidestatus()' target='_blank' href=anreport_dailydetail.php?yr=".$row['yr']."&mon=".$row['mon']."&d=".$row['d']."&sum_an=".$row['sum_an']."&pages=".$pages."&sizes=".$sizes.">";
			echo number_format($row['sum_an'],0);
			echo "</a>";
			echo "</td>";
			echo "<td align='center' class='listdetail'>".number_format($pages,0)."</td>";
			echo "<td align='center' class='listdetail'>".number_format($sizes,4)."</td>";
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table>";
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
				echo "[<a href='?start=".$start."&pageid=".$i;
				echo "'>$i</a>]&nbsp;";
			}//end if
		}//end for
	echo "</td></tr></table>";
	}//end if totalpage

//###################################

?>
<br>
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