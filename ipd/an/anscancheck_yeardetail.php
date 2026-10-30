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

<title>:: IPD - AN scan check ::</title>
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
echo "ข้อมูล AN ทั้งหมดในระบบ ปี <span class=blue>".$_REQUEST["thyr"]."</span>";
echo "</div><br>";
//###################################
echo "<table class='rowh' align='center' width='60%' cellspacing='1' cellpadding='1' border='0'>";// create table title
echo "<tr bgcolor='#3399CC'>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ในระบบ</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN สแกนแล้ว</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ที่สแกนไม่ครบ</td>";
echo "</tr>";
if (fmod($id,2)) {$rcolor=' bgcolor=#99FF99';}else{$rcolor=' bgcolor=#FFFF5B';}
echo "<tr".$rcolor.">";
echo "<td align='center' class='listdetail'>".number_format($_REQUEST["colan"])."</td>";
echo "<td align='center' class='listdetail'>".$_REQUEST["colyesan"]."</td>";
echo "<td align='center' class='listdetail'>".$_REQUEST["colnoan"]."</td>";
echo "</tr>";
echo "</table>";

//###################################
$total=0;
for ($i=1;$i<=12;$i++){
	$colan_array[$i]=number_format(getValue("count(*)","hos.ipt","year(dchdate)= '".$_REQUEST["enyr"]."' and month(dchdate)='".$i."'"));
	$colyesan_array[$i]=number_format(getValue("count(*)"," hos.ipt a, hdbms.tb_ipd b "," a.an=b.an and year(dchdate)='".$_REQUEST["enyr"]."' and month(dchdate)='".$i."'"));
	$colnoan_array[$i]=number_format(getValue("count(*)","hos.ipt"," year(dchdate)= '".$_REQUEST["enyr"]."' and month(dchdate)='".$i."' and an not in (select an from hdbms.tb_ipd)"));
	if ($colan_array[$i]<>0){$total++;}
	//echo "$i colan=".$col1."/".$colan_array[$i]."<br>";
	//echo "$i colyesan=".$colyesan_array[$i]."<br>";
	//echo "$i colnoan=".$colnoan_array[$i]."<br>";
}
if ($total>0) {
	include_once("../System_config/func.php");
	echo "<br>";
	echo "<table class='rowh' align='center' width='60%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#ffffff'>";
	echo "<td align='center' class='hdtable'>";
	echo "<div class='blackb' align='center'>พบข้อมูลทั้งหมด <span class=blue>".$total."</span> เดือน</div>";
	echo "</td>";
	echo "<td align='right' class='hdtable' width='35'>";//onMouseover='return hidestatus()' onMouseOut='return hidestatus()' 
	echo "<a title='Export to csv' target='_blank' href=anscancheck_yeardetail_export2csv.php?logno=".$_SESSION['logno']."&colan=".number_format($_REQUEST["colan"])."&colyesan=".$_REQUEST["colyesan"]."&colnoan=".$_REQUEST["colnoan"]."&enyr=".$_REQUEST['enyr']."&thyr=".$_REQUEST['thyr'].">";
	echo "<img src='../images/export-excel-icon.png' border=0>";
	echo "</a>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
echo "<table class='rowh' align='center' width='60%' cellspacing='1' cellpadding='1' border='0'>";// create table title
echo "<tr bgcolor='#a9a9a9'>";
echo "<td align='center' class='hdtable' width='10%'>เดือน</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ในระบบ</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN สแกนแล้ว</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ที่สแกนไม่ครบ</td>";
echo "</tr>";
	for ($i=1;$i<=12;$i++){
			if ($colan_array[$i]>0){
				if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
				echo "<tr".$rcolor.">";
				echo "<td align='center' class='listdetail'>";
				echo "<a target='_blank' title='ดูรายละเอียด' onMouseover='return hidestatus()' onMouseOut='return hidestatus()'  href=anscancheck_monthdetail.php?enyr=".$_REQUEST["enyr"]."&thyr=".$_REQUEST["thyr"]."&mon=".$i."&colan=".$colan_array[$i]."&colyesan=".$colyesan_array[$i]."&colnoan=".$colnoan_array[$i].">";
				echo $month[$i-1];
				echo "</a>";
				echo "</td>";
				echo "<td align='center' class='listdetail'>".$colan_array[$i]."</td>";
				echo "<td align='center' class='listdetail'>";
				if ($colyesan_array[$i]==0){
					echo $colyesan_array[$i];
				}else{
					echo "<a href='anscancheck_list.php?status=5&enyr=".$_REQUEST["enyr"]."&thyr=".$_REQUEST["thyr"]."&mon=$i'>";
					echo $colyesan_array[$i];
					echo "</a>";
				}
				echo "</td>";
				echo "<td align='center' class='listdetail'>";
				if ($colnoan_array[$i]==0){
					echo $colnoan_array[$i];
				}else{
					echo "<a href='anscancheck_list.php?status=6&enyr=".$_REQUEST["enyr"]."&thyr=".$_REQUEST["thyr"]."&mon=$i'>";
					echo $colnoan_array[$i];
					echo "</a>";
				}
				echo "</td>";
				echo "</tr>";
				$id++;
			}//end if >0
		} //end of for
		echo "</table>";
}else{//no record found
	echo "<BR><BR><div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div><BR>";
}// end of if chk $result

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