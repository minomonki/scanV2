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

<title>:: IPD - AN scan check Search ::</title>
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
<?php //################################### ?>
<form name="search" method="post" action="anscancheck2.php">
<table align="center" width="70%" border="0" bordercolor="#C0C0C0" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
  <tr>
    <td colspan="4" class="head-topic">:: เงื่อนไขการแสดงผล ::</td>
  </tr>
  <tr>
    <td width="38%" align="right" bgcolor="#CCCCCC" class="topic">ตรวจสอบเอกสารที่สแกน ตั้งแต่วันที่ :</td>
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
	
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0" >
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->
<?php 
//################################### RESULT SEARCH
if (!is_null($_REQUEST['cmd_show'])){
include("../System_config/connect.php");
include("../System_config/connecthos.php");
include("../System_config/func.php");
//################################### 
$fromdate=$_REQUEST['admit_s'];
$todate=$_REQUEST['admit_e'];
//echo "<br>".substr($fromdate,0,4)."/".$fromdate."<br>";
if (substr($fromdate,0,4)<2500){
	$enminyear=substr($fromdate,0,4);
	$thminyear=substr($fromdate,0,4)+543;
}else{
	$enminyear=substr($fromdate,0,4)-543;
	$thminyear=substr($fromdate,0,4);
}
//echo "<br>".$enminyear."<br>";
//echo "<br>".substr($fromdate,0,4)."/".$fromdate."<br>";
if (substr($todate,0,4)<2500){
	$enmaxyear=substr($todate,0,4);
	$thmaxyear=substr($todate,0,4)+543;
}else{
	$enmaxyear=substr($fromdate,0,4)-543;
	$thmaxyear=substr($fromdate,0,4);
}

//2000-01-01
$s_enmaxdate=$enmaxyear."-".substr($todate,5,2)."-".substr($todate,8,2);
$s_enmindate=$enminyear."-".substr($fromdate,5,2)."-".substr($fromdate,8,2);
$s_thmaxdate=$thmaxyear."-".substr($todate,5,2)."-".substr($todate,8,2);
$s_thmindate=$thminyear."-".substr($fromdate,5,2)."-".substr($fromdate,8,2);
//###################################
	$colan=number_format(getValue("count(*)","hos.ipt","dchdate between '".$s_enmindate."' and '".$s_enmaxdate."'"));
	$colyesan=number_format(getValue("count(*)"," hos.ipt a, hdbms.tb_ipd b "," a.an=b.an and dchdate between '".$s_enmindate."' and '".$s_enmaxdate."'"));
	$colnoan=number_format(getValue("count(*)","hos.ipt"," dchdate between '".$s_enmindate."' and '".$s_enmaxdate."' and an not in (select an from hdbms.tb_ipd)"));
//###################################
	echo "<br>";
	echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#ffffff'>";
	echo "<td align='center' class='hdtable'>";
	echo "<div class='blackb' align='center'>";
	echo "แสดงผลการค้นหาตั้งแต่วันที่ <span class=blue>".substr($fromdate,8,2)."/".substr($fromdate,5,2)."/".$thminyear."</span> ถึง <span class=blue>".substr($todate,8,2)."/".substr($todate,5,2)."/".$thmaxyear."</span>";
	if ($totalpage>1){echo " ขณะนี้แสดงหน้าที่  ".$pageid."/".$totalpage;}
	echo "</div>";
	echo "</td>";
	echo "<td align='right' class='hdtable' width='35'>";//onMouseover='return hidestatus()' onMouseOut='return hidestatus()' 
	echo "<a title='Export to csv' target='_blank' href=anscancheck2_export2csv.php?logno=".$_SESSION['logno']."&fromdate=".$fromdate."&todate=".$todate."&colan=".$colan."&colyesan=".$colyesan."&colnoan=".$colnoan.">";
	echo "<img src='../images/export-excel-icon.png' border=0>";
	echo "</a>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
echo "<tr bgcolor='#a9a9a9'>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ในระบบ</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN สแกนแล้ว</td>";
echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ที่สแกนไม่ครบ</td>";
echo "</tr>";
if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
echo "<tr".$rcolor.">";
	echo "<td align='center' class='listdetail'>".$colan."</td>";
	echo "<td align='center' class='listdetail'>";
	if ($colyesan==0){
		echo $colyesan;
	}else{
		echo "<a target='_blank' href='anscancheck_list.php?status=9&enmindate=$s_enmindate&enmaxdate=$s_enmaxdate&thmindate=$s_thmindate&thmaxdate=$s_thmaxdate'>";
		echo $colyesan;
		echo "</a>";
	}//end if colyesan
	echo "</td>";
	echo "<td align='center' class='listdetail'>";
	if ($colnoan==0){
		echo $colnoan;
	}else{
		echo "<a target='_blank'  href='anscancheck_list.php?status=10&enmindate=$s_enmindate&enmaxdate=$s_enmaxdate&thmindate=$s_thmindate&thmaxdate=$s_thmaxdate'>";
		echo $colnoan;
		echo "</a>";
	}//end if col3
	echo "</td>";
echo "</tr>";
echo "</table>";

//################################### 
	}// end if cmd_show
//################################### 

?>
<br><br>

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