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

<title>:: IPD - Secret Setup ::</title>
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

<table align="center" width="701" border="0" cellspacing="2" cellpadding="0">
  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<form name="search" method="post" action="frm_set_secret.php">
  <tr>
    <td class="head-topic"><BR>:: กำหนดสถานะความลับการใช้งาน AN  ::
		<input type="text" name="txt_an" size="15" maxlength="20"/>
		<input type="submit" name="cmd_create" value=" Create " />
    </td>
  </tr>
  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
</form>
</table>
	
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0" >
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->
<?
if ($_REQUEST['txt_an']<>''){
	include("../System_config/connect.php");
	////////// Check Exist AN
	$query ="select * from tb_ipd where an='".$_REQUEST['txt_an']."'";
	//echo $query;
	$result = mysql_query($query);
	if (mysql_num_rows($result)>0) {
		$row = mysql_fetch_array($result);
		echo "<table class='rowh' align='center' width='90%' cellspacing='2' cellpadding='2' border='0'>";
		echo "<tr>";
		echo "<td bgcolor='#a9a9a9' align='right' class='hdtable' width='10%'>HN :&nbsp; </td>";
		echo "<td class='listdetail'>&nbsp;&nbsp;&nbsp;&nbsp;".$row['hn']."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td bgcolor='#a9a9a9' align='right' class='hdtable' width='10%'>ชื่อ-สกุล :&nbsp; </td>";
		echo "<td class='listdetail'>&nbsp;&nbsp;&nbsp;&nbsp;".$row['firstname']."&nbsp;&nbsp;".$row['lastname']."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td bgcolor='#a9a9a9' align='right' class='hdtable' width='10%'>AN :&nbsp; </td>";
		echo "<td class='listdetail'>&nbsp;&nbsp;&nbsp;&nbsp;".$row['an']."</td>";
		echo "</tr>";
		echo "</table><br>";
		//////////////////////////////////////////////////////////////
		// Check Duplicated AN
		$query ="select count(*) from tb_ipd_doc_secret where an='".$_REQUEST['txt_an']."'";
		//echo $query;
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		if ($row[0]==1) {
			echo "<div class='blackb' align='center'>======== AN : ".$_REQUEST['txt_an']." นี้ถูกกำหนดสถานะความลับในระบบแล้ว ========</div>";
		}else{//no record found
			//////////////////////// Create new //////////////////////////
			echo "<div class='blackb' align='center'>###### การกำหนดสถานะความลับ  #####</div>";
			echo "<table class='rowh1' align='center' width='90%' cellspacing='0' cellpadding='0' bordercolor='#000000' border='1' style='border-collapse:collapse;'>";
			echo "<tr bgcolor='#a9a9a9'>";
			echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
			echo "<td align='center' class='hdtable' width='10%'>AN</td>";
			//echo "<td align='center' class='hdtable' width='20%'>ผู้มีสิทธิใช้งาน</td>";
			echo  "<td width='5%' align='center' class='hdtable'>บันทึก</td>";
			echo "</tr>";
			echo "<form name='dform' method='post' action='fn_setsecret.php' onSubmit='JavaScript:return validSubmit();'>";
			echo "<tr>";
			echo "<td align='center' class='listdetail'>1</td>";
			echo "<td align='center' class='listdetail'>".$_REQUEST['txt_an']."</td>";
			echo "<td align='center' class='listdetail'>";
			echo "<input type='submit' name='cmd_show' value=' กำหนดให้เป็นสถานะลับ ' />";
			echo "</td>";
			echo "</tr>";
			echo "<input type='hidden' name='txt_an' value='".$_REQUEST['txt_an']."'>";
			echo "<input type='hidden' name='txt_byuser' value='".$_SESSION["user_ipd"]."'>";
			echo "<input type='hidden' name='logno' value='".$_SESSION["logno"]."'>";
			echo "</table><br>";
			echo "<div align='center'></div>";
			echo "</form>";
			//////////////////////// End Create new ///////////////////////////
		}// end of if chk $result
	}else{//no record found
		echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล AN : ".$_REQUEST['txt_an']." ในระบบ ========</div>";
	}// end of if chk $result
}// end if chk txt_an
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