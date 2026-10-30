<?php

	session_start();
include ("../System_config/const.php");
	#print $_SESSION["Usergroup_ipd"];

	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

	include ("../System_config/connection.php");
	include_once("../System_config/func.php");
	
  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../datepick/css/smoothness/jquery-ui-1.7.2.custom.css">
	<link rel="shortcut icon" type="image/x-icon" href="../images/favicon_trash.ico">
<title>:: IPD - Log File Manager ::</title>
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
<script language="javascript"> 
function validSubmit() { 
//valid dform values
	if(document.dellog.admit_s.value == ""){ 
		alert('กรุณากรอกข้อมูล วดป. ลบข้อมูลตั้งแต่วันที่'); 
		document.dellog.admit_s.focus(); 
		return false; 
	}    
	if(document.dellog.admit_e.value == ""){ 
		alert('กรุณากรอกข้อมูล วดป. ลบข้อมูลถึงวันที่'); 
		document.dellog.admit_e.focus();         
		return false; 
	}    
//dform constraints
	document.dellog.submit(); 
} 
</script> 
<script language="javascript"> 
function validSubmit2() { 
//valid dform values
	if(document.emptytrash.dis_s.value == ""){ 
		alert('กรุณากรอกข้อมูล วดป. Empty Trash ตั้งแต่วันที่'); 
		document.emptytrash.dis_s.focus(); 
		return false; 
	}    
	if(document.emptytrash.dis_e.value == ""){ 
		alert('กรุณากรอกข้อมูล วดป. Empty Trash ถึงวันที่'); 
		document.emptytrash.dis_e.focus();         
		return false; 
	}    
//dform constraints
	document.emptytrash.submit(); 
} 
</script> 

</head>

<body>


<table align="center" width="999" border="0" cellspacing="0" cellpadding="0">
  <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  
  <tr>
    <td background="../images/design_webIPD/web-IPDS01_03.jpg">
<!-- ############### Sum Table ################## -->
<table align="center" width="90%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td colspan="2" class="head-topic">:: รายงานการใช้งาน - ข้อมูลสรุป ::</td>
  </tr>
  <tr>
    <td width="30%" align="right" bgcolor="#98E6F3" class="topic">วดป. ข้อมูลการใช้งาน :</td>
    <td width="70%"> &nbsp;
<?php 
		$m_minlog=chkMinMaxLogin("min","tb_ipd_logfile");
		$m_maxlog=chkMinMaxLogin("max","tb_ipd_logfile");
		if ($m_minlog=="") {echo "ไม่มีข้อมูล";}else{echo $m_minlog." - ".$m_maxlog;}
?>
	</td>
  </tr>
  <tr>
    <td align="right" bgcolor="#98E6F3" class="topic">จำนวนการเข้าใช้งานทั้งหมด (ครั้ง) :</td>
    <td > &nbsp;<?php echo countRow("tb_ipd_logfile");?></td>
  </tr>
  <tr>
    <td colspan=2>
<?php
	echo "<table class='rowh' align='center' width='100%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#a9a9a9'>";
	for ($i=1;$i<=count($logtype_array);$i++){
		echo "<td align='center' class='hdtable' width='10%'>".$logtype_array[$i]."</td>";
	}
	echo "</tr>";
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			//echo "<td align='center' class='listdetail'>&nbsp;".$row['username']."</td>";
	for ($i=1;$i<=count($logtype_array);$i++){
		echo "<td align='center' class='listdetail'>".countGroup("tb_ipd_logfile","logtype",$logtypes_array[$i],"","")."</td>";
	}

			echo "</tr></table>";
?>
	</td>
  </tr>
   <tr>
    <td align="right" bgcolor="#98E6F3" class="topic">ประเภทการเข้าใช้งานทั้งหมด (ครั้ง) :</td>
    <td colspan=2> &nbsp;<?php echo countRow("tb_ipd_logfile_detail");?></td>
  </tr>
   <tr>
    <td colspan=2>
	<?php
	echo "<table class='rowh' align='center' width='100%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#a9a9a9'>";
	for ($i=1;$i<=count($pcode_array);$i++){
		echo "<td align='center' class='hdtable' width='10%'>".$pcode_array[$i]."</td>";
	}
	echo "</tr>";
			echo "<tr".$rcolor.">";
	for ($i=1;$i<=count($pcode_array);$i++){
			echo "<td align='center' class='listdetail' >".countGroup("tb_ipd_logfile_detail","pcode",$pcodes_array[$i],"","")."</td>";
	}
			echo "</tr></table>";
?>
	</td>
  </tr>
</table>
<!-- ############### Sum Table ################## -->
<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body --><BR>
<form name="dellog" method="post" action="frm_del_log2trash.php"  onSubmit='JavaScript:return validSubmit();'>
<table align="center" width="90%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan=2 bgcolor="#008000" style="line-height: 2px">&nbsp;</td>
  </tr>
  <tr>
    <td width="200">&nbsp;<img src='../images/trash_full.gif' border='0' /> :: <span style="color: #008000;font-weight: bold;text-decoration: underline;">Delete Log file</span> :: </td>
	<td valign="bottom">&nbsp;</td>
  </tr>
</table>
<table align="center" width="90%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="100" align="right" bgcolor="#CCCCCC" class="topic">ตั้งแต่วันที่ :</td>
    <td colspan="3">
    	<input type="text" name="admit_s" id="admit_s" />
        
        <img src="../images/span.gif" width="10" />   
        <strong>To.</strong>
        <img src="../images/span.gif" width="10" />   
        
        <input type="text" name="admit_e" id="admit_e" />
        <script type="text/javascript" src="../datepick/js/jquery-1.3.2.min.js"></script>
  	<script type="text/javascript" src="../datepick/js/jquery-ui-1.7.2.custom.min.js"></script>
	<?php
    	include("../datepick/datepick.php");
	?>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="cmd_del" value=" Move to Trash" />
    </td>
  </tr>
<input type="hidden" name="minlog" value="<?=$m_minlog?>">
<input type="hidden" name="maxlog" value="<?=$m_maxlog?>">
</table>
</form>
<form name="emptytrash" method="post" action="frm_del_logemptytrash.php"  onSubmit='JavaScript:return validSubmit2();'>
<table align="center" width="90%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan=2 bgcolor="#ff0000" style="line-height: 2px">&nbsp;</td>
  </tr>
  <tr>
    <td width="200">&nbsp;<img src='../images/trash_empty.gif' border='0' /> :: <span style="color: #ff0000;font-weight: bold;text-decoration: underline;">Clear Log file</span> :: </td>
	<td valign="bottom"> Trash :: &nbsp;
	<?php
		$b_minlog=chkMinMaxLogin("min","tb_ipd_logfile_bak");
		$b_maxlog=chkMinMaxLogin("max","tb_ipd_logfile_bak");
		if ($b_minlog=="") {echo "ไม่มีข้อมูล";}else{echo $b_minlog." - ".$b_maxlog; echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='logfilereport_trash.php' title='ดูข้อมูล Log ในถังขยะทั้งหมด'><img border=0 src='../images/bin.png' width=28></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='logfilereport2_trash.php' title='ดูข้อมูล Log ในถังขยะ ตามเงื่อนไข'><img border=0 src='../images/search.png' width=28></a>";}
	?>
	</td>
  </tr>
</table>
<table align="center" width="90%" border="0" cellspacing="2" cellpadding="1">
  <tr>
    <td width="100" align="right" bgcolor="#CCCCCC" class="topic">ตั้งแต่วันที่ :</td>
    <td colspan="3">
    	<input type="text" name="dis_s" id="dis_s" />
        
        <img src="../images/span.gif" width="10" />   
        <strong>To.</strong>
        <img src="../images/span.gif" width="10" />   
        
        <input type="text" name="dis_e" id="dis_e" />
        <script type="text/javascript" src="../datepick/js/jquery-1.3.2.min.js"></script>
  	<script type="text/javascript" src="../datepick/js/jquery-ui-1.7.2.custom.min.js"></script>
	<?php
    	include("../datepick/datepick.php");
	?>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="cmd_empty" value=" Empty Trash" />
    </td>
  </tr>
  <tr>
    <td colspan="4" align="center">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="minlog" value="<?=$b_minlog?>">
<input type="hidden" name="maxlog" value="<?=$b_maxlog?>">
</form>

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
