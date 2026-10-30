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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
EmptyDir($exportdir); // delete all old export file
echo "<div class='blackb' align='center'>";
echo "ข้อมูล AN ทั้งหมดในระบบ ตั้งแต่วันที่ <span class=blue>".chkMinMaxDate("min(datescan)","tb_ipd","th")."</span> - <span class=blue>".chkMinMaxDate("max(datescan)","tb_ipd","th")."</span>";
echo "</div><br>";
//###################################
$colanreport=getValue("count(*)","tb_ipd ","");
$colpages=getValue("sum( pages )","tb_ipd_doctype_detail","");
$colsizes=getValue("sum( OCTET_LENGTH( imagescan ) /1048576 )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an");
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
echo "<td align='center' class='listdetail'>".number_format($colsizes,4)."</td>";
echo "</tr>";
echo "</table>";

//###################################
$pagesize=20;
$select="select year(datescan) as yr, count( * ) AS sum_an "; //, sum( pages ) as pages
$from=" from tb_ipd ";
//$where=" where ";
$groupby=" group by year(datescan)";

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
$query =$select.$from.$where.$groupby;
//$query2 =$query;
$query .=" order by yr desc LIMIT $start,$pagesize";
//echo $query."<br>";
$result=mysql_query($query);
//###################################
if ($totalpage>0) {
	include_once("../System_config/func.php");
	echo "<br>";
	echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#ffffff'>";
	echo "<td align='center' class='hdtable'>";
	echo "<div class='blackb' align='center'>พบข้อมูลทั้งหมด <span class=blue>".$total."</span> ปี";
	if ($totalpage>1){echo " ขณะนี้แสดงหน้าที่  ".$pageid."/".$totalpage;}
	echo "</div>";
	echo "</td>";
	echo "<td align='right' class='hdtable' width='35'>";//onMouseover='return hidestatus()' onMouseOut='return hidestatus()' 
	echo "<a title='Export to csv' target='_blank' href=anreport_export2csv.php?logno=".$_SESSION["logno"]."&sum_an=".$colanreport."&pages=".$colpages."&sizes=".$colsizes.">";
	echo "<img src='../images/export-excel-icon.png' border=0>";
	echo "</a>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
		while($row = mysql_fetch_array($result)){
if ($id==1){
	echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#a9a9a9'>";
	echo "<td align='center' class='hdtable' width='15%'>ปี</td>";
	echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ในระบบ </td>";
	echo "<td align='center' class='hdtable' width='20%'>จำนวนหน้า</td>";
	echo "<td align='center' class='hdtable' width='30%'>ขนาด (Mb)</td>";
	echo "</tr>";
}
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			$sizes=getValue("sum( OCTET_LENGTH( imagescan ) /1048576 )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and year(datescan)=".$row['yr']."");
			$pages=getValue("sum( b.pages )","tb_ipd a, `tb_ipd_doctype_detail` b","a.an = b.an and year(datescan)=".$row['yr']."");
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>";
			echo "<a target='_blank' title='ดูรายละเอียด' onMouseover='return hidestatus()' onMouseOut='return hidestatus()'  href=anreport_yeardetail.php?yr=".$row['yr']."&sum_an=".$row['sum_an']."&pages=".$pages."&sizes=".$sizes.">";
			echo $row['yr'];
			echo "</a>";
			echo "</td>";
			echo "<td align='center' class='listdetail'>".number_format($row['sum_an'],0)."</td>";
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
?><BR><BR>
<form name="search" method="post" action="anreport2.php">
<table align="center" width="70%" border="1" bordercolor="#C0C0C0" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
  <tr>
    <td colspan="4" class="head-topic" bgcolor="#C0C0C0">:: เงื่อนไขการแสดงผล ::</td>
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
<?php //################################### ?>
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