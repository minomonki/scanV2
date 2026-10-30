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
//###################################
//getdatescan,count doctype,pages, sizes
//$claus="an='".$_REQUEST["an"]."'";
//." and outdate='".$_REQUEST["oyr"]."-".$_REQUEST["omon"]."-".$_REQUEST["od"]."'";
//$getdatescan=getValue("datescan","tb_ipd",$claus);
//$getpages=getValue("sum( pages ) as pages"," tb_ipd a, tb_ipd_doctype_detail b"," a.an = b.an and datescan=");
//echo $getdatescan;
//$getdatescan=getValue($col,$tblname,$claus);
//$getdatescan=getValue($col,$tblname,$claus);

if ($_REQUEST["sum_an"]<>0){
//###################################
echo "<div class='blackb' align='center'>";
echo "ข้อมูล AN : <span class=blue>".$_REQUEST["an"]."</span> เมื่อ วันที่ <span class=blue>".$_REQUEST["d"]." ".$month[$_REQUEST["mon"]-1]." ".$_REQUEST["yr"]."</span>";
echo "</div><br>";
//###################################
echo "<table class='rowh' align='center' width='60%' cellspacing='1' cellpadding='1' border='0'>";// create table title
echo "<tr bgcolor='#3399CC'>";
echo "<td align='center' class='hdtable' width='30%'>จำนวนเอกสาร</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวนหน้า</td>";
echo "<td align='center' class='hdtable' width='30%'>ขนาด (Mb)</td>";
echo "</tr>";
if (fmod($id,2)) {$rcolor=' bgcolor=#99FF99';}else{$rcolor=' bgcolor=#FFFF5B';}
echo "<tr".$rcolor.">";
echo "<td align='center' class='listdetail'>".number_format($_REQUEST["sum_an"],0)."</td>";
echo "<td align='center' class='listdetail'>".$_REQUEST["pages"]."</td>";
echo "<td align='center' class='listdetail'>".number_format($_REQUEST["sizes"],4)."</td>";
echo "</tr>";
echo "</table>";
//###################################
}// end if chk value
$pagesize=20;
$select="select a.an,hn,firstname,lastname,doctype,year(datescan) as yr,month(datescan) as mon,day(datescan) as d, b.pages , (OCTET_LENGTH( imagescan ) /1048576 ) as sizes, cast(doctype  as SIGNED) as doctypeno";
$from=" from tb_ipd a, `tb_ipd_doctype_detail` b";
$where=" where a.an = b.an and a.an='".$_REQUEST["an"]."'";
$where .=" and year(datescan)=".$_REQUEST["yr"]." and month(datescan)=".$_REQUEST["mon"]." and day(datescan)=".$_REQUEST["d"] ;
//$groupby=" group by a.an";
$orderby .=" order by cast(doctype  as SIGNED)";

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
	echo "<div class='blackb' align='center'>";
	//echo "HN : ";
	echo "</div><br>";
	echo "<div class='blackb' align='center'>พบข้อมูลทั้งหมด <span class=blue>".$total."</span> รายการ";
	if ($totalpage>1){echo " ขณะนี้แสดงหน้าที่  ".$pageid."/".$totalpage;}
	echo "</div><br>";
$id=1;
		while($row = mysql_fetch_array($result)){
			if ($id==1){
				echo "<table class='rowh' align='center' width='80%' cellspacing='1' cellpadding='1' border='0'>";// create table title
				echo "<tr><td colspan=4>HN : ".$row['hn']."&nbsp;&nbsp;".$row['firstname']." &nbsp;".$row['lastname']."</td></tr>";
				echo "<tr bgcolor='#a9a9a9'>";
				echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
				echo "<td align='center' class='hdtable' width='10%'>DocType</td>";
				echo "<td align='center' class='hdtable' width='30%'>Name</td>";
				echo "<td align='center' class='hdtable' width='20%'>จำนวนหน้า</td>";
				echo "<td align='center' class='hdtable' width='20%'>ขนาด (Mb)</td>";
				echo "</tr>";
			}
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>".$id."</td>";
			echo "<td align='center' class='listdetail'>".$row['doctype']."</td>";
			echo "<td align='left' class='listdetail'> ".getDoctype($row['doctype'])."</td>";
			echo "<td align='center' class='listdetail'>".$row['pages']."</td>";
			echo "<td align='center' class='listdetail'>".number_format($row['sizes'],4)."</td>";
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table>";
}else{//no record found
	echo "<BR><BR><div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div><BR>";
}// end of if chk $result

	//header table pages row 
	if ($totalpage>1){
		echo "<table align='center' width='80%'><tr><td>";
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