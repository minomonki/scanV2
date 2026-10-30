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

<title>:: IPD - AN Checked List ::</title>
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
include("../System_config/connecthos.php");
include("../System_config/connect.php");
include_once("../System_config/func.php");

//###################################
$pagesize=50;
if ($_REQUEST["status"]==0){ // list all dchdate is null
	$titledetail=" จำนวน AN admitted ตั้งแต่ <span class=blue>".getFormatdate($_REQUEST["thmindate"],1)." ถึง ".getFormatdate($_REQUEST["thmaxdate"],1)."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where dchdate is null or dchdate=''";
}elseif ($_REQUEST["status"]==1){ // list all yesan
	$titledetail=" จำนวน AN สแกนแล้ว ตั้งแต่ <span class=blue>".getFormatdate($_REQUEST["thmindate"],1)." ถึง ".getFormatdate($_REQUEST["thmaxdate"],1)."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(datescan) as dd , month(datescan) as mm , year(datescan) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an= b.an";
}elseif ($_REQUEST["status"]==2){ // list all noan
	$titledetail=" จำนวน AN ที่สแกนไม่ครบ  ตั้งแต่ <span class=blue>".getFormatdate($_REQUEST["thmindate"],1)." ถึง ".getFormatdate($_REQUEST["thmaxdate"],1)."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where an not in (select an from hdbms.tb_ipd)";
}elseif ($_REQUEST["status"]==3){ // list yesan by year
	$titledetail=" จำนวน AN สแกนแล้ว ปี <span class=blue>".$_REQUEST["thyr"]."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(outdate) as dd , month(outdate) as mm , year(outdate) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an=b.an and year(dchdate)='".$_REQUEST["enyr"]."'";
}elseif ($_REQUEST["status"]==4){ // list noan by year
	$titledetail=" จำนวน AN ที่สแกนไม่ครบ ปี <span class=blue>".$_REQUEST["thyr"]."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where year(dchdate)='".$_REQUEST["enyr"]."' and an not in (select an from hdbms.tb_ipd)";
}elseif ($_REQUEST["status"]==5){ // list yesan by month
	$titledetail=" จำนวน AN สแกนแล้ว เดือน <span class=blue>".$month[$_REQUEST["mon"]-1]."</span> ปี <span class=blue>".$_REQUEST["thyr"]."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(outdate) as dd , month(outdate) as mm , year(outdate) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an=b.an and year(dchdate)='".$_REQUEST["enyr"]."' and month(dchdate)='".$_REQUEST["mon"]."'";
}elseif ($_REQUEST["status"]==6){ // list noan by month
	$titledetail=" จำนวน AN ที่สแกนไม่ครบ เดือน <span class=blue>".$month[$_REQUEST["mon"]-1]."</span> ปี <span class=blue>".$_REQUEST["thyr"]."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where year(dchdate)='".$_REQUEST["enyr"]."' and month(dchdate)='".$_REQUEST["mon"]."' and an not in (select an from hdbms.tb_ipd)";
}elseif ($_REQUEST["status"]==7){ // list yesan by day/month/year
	$titledetail=" จำนวน AN สแกนแล้ว วันที่ <span class=blue>".$_REQUEST["day"]." ".$month[$_REQUEST["mon"]-1]." ".$_REQUEST["thyr"]."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(outdate) as dd , month(outdate) as mm , year(outdate) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an=b.an and dchdate='".$_REQUEST["enyr"]."-".$_REQUEST["mon"]."-".$_REQUEST["day"]."'";
}elseif ($_REQUEST["status"]==8){ // list noan by day/month/year
	$titledetail=" จำนวน AN ที่สแกนไม่ครบวันที่ <span class=blue>".$_REQUEST["day"]." ".$month[$_REQUEST["mon"]-1]." ".$_REQUEST["thyr"]."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where dchdate='".$_REQUEST["enyr"]."-".$_REQUEST["mon"]."-".$_REQUEST["day"]."' and an not in (select an from hdbms.tb_ipd)";
}elseif ($_REQUEST["status"]==9){ // list yesan by search from-to
	$titledetail=" จำนวน AN สแกนแล้ว ตั้งแต่ <span class=blue>".getFormatdate($_REQUEST["thmindate"],1)." - ".getFormatdate($_REQUEST["thmaxdate"],1)."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y,day(outdate) as dd , month(outdate) as mm , year(outdate) as yy ";
	$select .=" ,b.hn,b.firstname,b.lastname,b.pages";
	$from=" from hos.ipt a, hdbms.tb_ipd b ";
	$where=" where a.an=b.an and dchdate between '".$_REQUEST["enmindate"]."' and '".$_REQUEST["enmaxdate"]."'";
}elseif ($_REQUEST["status"]==10){ // list noan by search from-to
	$titledetail=" จำนวน AN ที่สแกนไม่ครบ  ตั้งแต่ <span class=blue>".getFormatdate($_REQUEST["thmindate"],1)." - ".getFormatdate($_REQUEST["thmaxdate"],1)."</span>";
	$select="select a.an,dchdate,day(dchdate) as d , month(dchdate) as m , year(dchdate) as y, year(dchdate)+543 as thy ";
	$select .=" ,hn";
	$from=" from hos.ipt a";
	$where=" where dchdate between '".$_REQUEST["enmindate"]."' and '".$_REQUEST["enmaxdate"]."' and an not in (select an from hdbms.tb_ipd)";
}
//$groupby=" group by a.an";
//$orderby .=" order by cast(doctype)";

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
	echo "<table class='rowh' align='center' width='80%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#ffffff'>";
	echo "<td align='center' class='hdtable'>";
	echo "<div class='blackb' align='center'>พบข้อมูล";
	echo $titledetail;
	echo " ทั้งหมด <span class=blue>".number_format($total)."</span> รายการ";
	if ($totalpage>1){echo "<BR> ขณะนี้แสดงหน้าที่  <span class=red>".$pageid."</span>/".$totalpage;}
	echo "</div>";
	echo "</td>";
	echo "<td align='right' class='hdtable' width='35'>";//onMouseover='return hidestatus()' onMouseOut='return hidestatus()' 
	echo "<a title='Export to csv' target='_blank' href=anscancheck_list_export2csv.php?status=".$_REQUEST["status"]."&logno=".$_SESSION['logno']."&enmindate=".$_REQUEST["enmindate"]."&enmaxdate=".$_REQUEST["enmaxdate"]."&thmindate=".$_REQUEST["thmindate"]."&thmaxdate=".$_REQUEST["thmaxdate"];
	echo "&enyr=".$_REQUEST["enyr"]."&thyr=".$_REQUEST["thyr"];
	echo "&mon=".$_REQUEST["mon"]."&day=".$_REQUEST["day"];
	echo ">";
	echo "<img src='../images/export-excel-icon.png' border=0>";
	echo "</a>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
$id=1;
		while($row = mysql_fetch_array($result)){
			if ($id==1){
				echo "<table class='rowh' align='center' width='80%' cellspacing='1' cellpadding='1' border='0'>";// create table title
				//echo "<tr><td colspan=4>HN : ".$row['hn']."&nbsp;&nbsp;".$row['firstname']." &nbsp;".$row['lastname']."</td></tr>";
				echo "<tr bgcolor='#a9a9a9'>";
				echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
				echo "<td align='center' class='hdtable' width='15%'>AN</td>";
				echo "<td align='center' class='hdtable' width='15%'>HN</td>";
				if ($_REQUEST["status"]%2<>0){ 
					echo "<td align='center' class='hdtable' width='20%'>ชื่อ</td>";
					echo "<td align='center' class='hdtable' width='20%'>นามสกุล</td>";
					echo "<td align='center' class='hdtable' width='15%'>dchdate</td>";
					echo "<td align='center' class='hdtable' width='15%'>datescan</td>";
				}
				echo "</tr>";
			}
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>".number_format($id)."</td>";
			echo "<td align='center' class='listdetail'>";
			if ($_REQUEST["status"]%2<>0){ // make an link
				echo "<a title='ดูรายละเอียด' onMouseover='return hidestatus()' onMouseOut='return hidestatus()' target='_blank' href=anreport_listdetail2.php?yr=".$row['yy']."&mon=".$row['mm']."&d=".$row['dd']."&an=".$row['an'].">";
				echo $row['an'];
				echo "</a>";
			}else{
				echo $row['an'];
			}
			echo "</td>";
			echo "<td align='center' class='listdetail'>".$row['hn']."</td>";
			if ($_REQUEST["status"]%2<>0){ 
				echo "<td align='left' class='listdetail'> ".$row['firstname']."</td>";
				echo "<td align='left' class='listdetail'> ".$row['lastname']."</td>";
				echo "<td align='center' class='listdetail'>".$row['d']."/".$row['m']."/".$row['y']."</td>";
				echo "<td align='center' class='listdetail'>".$row['dd']."/".$row['mm']."/".$row['yy']."</td>";
			}
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table>";
}else{//no record found
	echo "<BR><BR><div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div><BR>";
}// end of if chk $result
//echo $totalpage
	//header table pages row 
if ($totalpage>1){
		echo "<table align='center' width='80%'><tr><td>";
		// write link each no.page
		for ($i = 1; $i <= $totalpage; $i++){
			if ($i==$pageid){//this is a current page
				echo "<b>$i</b>&nbsp;";
			}else{
				echo "[<a  href='?start=".$start."&pageid=".$i."&status=".$_REQUEST['status']."&enmindate=".$_REQUEST['enmindate']."&enmaxdate=".$_REQUEST['enmaxdate']."&thmindate=".$_REQUEST['thmindate']."&thmaxdate=".$_REQUEST['thmaxdate'];
				echo "'>$i</a>]&nbsp;";
			}//end if
			if (($i%15)==0){echo "<br>";}
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