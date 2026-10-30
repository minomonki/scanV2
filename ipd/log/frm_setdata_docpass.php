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
	<link rel="stylesheet" href="../css/autocomplete.css"  type="text/css"/>
	<script type="text/javascript" src="../autocom/autocomplete.js"></script>

<title>:: IPD - Setup data2pass ::</title>
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
<form name="add" method="post" action="frm_setdata_docpass.php">
  <tr>
    <td class="lnku" align="center"><BR>:: Import data to tb_ipd_doc_pass :: </td>
  </tr>
  <tr>
	<td align="center"><BR>	<?php include("../System_config/func.php");echo getPassdata();?></td>
  </tr>
  <tr>
	<td align="center"><BR>	<input type="submit" name="cmd_setdata" value=" OK " /></td>
  </tr>
</form>
<tr><td>
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr valign="top">
<td><!--detail body -->
<br>
<?
if ($_REQUEST['cmd_setdata']<>''){
	include("../System_config/connect.php");
	////////// Check Exist AN
	$query ="select distinct password,foruser from tb_ipd_doc_setup where password not in (select password from tb_ipd_doc_pass)";
	//echo $query;
	$result = mysql_query($query);
	$total=mysql_num_rows($result);
	$id=1;
	if ($total>0) {
			echo "<table class='rowh' align='center' width='70%' cellspacing='2' cellpadding='2' border='0'>";
			echo "<tr>";
			echo "<td align='center' class='hdtable' colspan=3>import data to ตาราง tb_ipd_doc_pass จำนวน $total &nbsp;รายการ </td>";
			echo "</tr>";
			echo "<tr bgcolor='#a9a9a9'>";
			echo "<td align='center' class='hdtable' width='10%'>ลำดับ</td>";
			echo "<td class='listdetail' align='center'>password</td>";
			echo "<td class='listdetail'>&nbsp;&nbsp;ชื่อผู้ใช้</td>";
			echo "</tr>";
		while ($row = mysql_fetch_array($result)){
			$sql = "INSERT INTO tb_ipd_doc_pass (`password`,`userdocpass`,`foruser`,`lastupdate`) VALUES ('$row[0]','$row[0]','$row[1]',".CURRENT_TIMESTAMP.")";
			//echo $sql."<br>";
			$result2 = mysql_query($sql);
			if ($result2){
			echo "<tr>";
			echo "<td class='listdetail' align='center'>".$id."</td>";
			echo "<td class='listdetail' align='center'>".$row[0]."</td>";
			echo "<td class='listdetail'>&nbsp;&nbsp;".$row[1]."</td>";
			echo "</tr>";
			$id++;
			}
		}//while
		echo "</table><br>";
		//////////////////////////////////////////////////////////////
	}else{//no record found
		//echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล import ========</div>";
	}// end of if chk $result
}// end if chk cmd???
?>
<br>
	</td><!--end of detail body -->
</tr>
</table>
	<!-- central main -->  
</td></tr>
</table>
	
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