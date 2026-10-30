<?php
	session_start();
	
	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
		
	include ("../System_config/connection.php");
	include ("../System_config/func.php");
	$yrth=substr($_REQUEST["dis_s"],0,4);
	$yreng=$yrth-543;
	$start = $_REQUEST["dis_s"];
	$startd = str_replace($yrth,$yreng,$start);
	$end = $_REQUEST["dis_e"];
	$endd = str_replace($yrth,$yreng,$end);
	$minlog = $_REQUEST["minlog"];
	$maxlog = $_REQUEST["maxlog"];
////////// check to complete data
if ($start <=$minlog && $end>=$maxlog){
	$notemsg .="*** ต้องการลบข้อมูล Log ทั้งหมด ";
	//print "<script>alert ('บันทึกการกำหนดสิทธิเรียบร้อยแล้ว'); </script>";
	//print "<script language='javascript' >window.location='frm_set_docpass.php?errmsg=$errmsg';</script>";
	//exit();	
}
$note="ข้อมูลการเข้าใช้งาน : ".countRowlog("tb_ipd_logfile_bak",$startd,$endd,"")." รายการ ";
$note2="ข้อมูลประเภทการใช้งาน : ".countRowlog("tb_ipd_logfile_bak",$startd,$endd,"tb_ipd_logfile_detail_bak")." รายการ ";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: IPD - DELETE LOG ::</title>

<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif)	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold;	}
.note		{	font-family: "mS Sans Serif"; font-size:14;  }
.memo		{	font-family: "mS Sans Serif"; font-size:12; color:#00F;  }
-->
</style>

</head>

<body>

<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>

  <tr>
   <td background="../images/design_webIPD/web-IPDS01_03.jpg">
    	<img src="../images/span.gif" height="20" />
        
        <form name="DelDoc" id="DelDoc" action="fn_dellogemptytrash.php" method="post">
    	<table  align="center" width="500" border="0" cellspacing="0" cellpadding="0">
  			<tr class="head-tb"><td height="38"> ยืนยันการลบข้อมูลลงถังขยะ </td></tr>
  			<tr bgcolor="#FFFFFF">
    			<td align="left">
                	<img src="../images/span.gif" height="10" /><br />
                    	<img src="../images/span.gif"  width="100"/><br />
                		<img src="../images/span.gif"  width="100"/>
						<table align=center>
						<tr><td><img src='../images/trash_empty.gif' border='0' /> 
						<span class="topic">ตั้งแต่วันที่ : </span><span class="note"><?=$start?></span> ถึง <span class="note"><?=$end?></span>
						</td></tr>
						<tr><td>
						<span class="note"><?=$note?></span><br />
						</td></tr>
						<tr><td>
						<span class="note"><?=$note2?></span><br />
						</td></tr>
						</table>
<img src="../images/span.gif" height="10" />
                </td>
  			</tr>
  			<tr bgcolor="#FFFFFF">
            	<td align="center">
               		<img src="../images/span.gif" height="10" /><br />
 					<?php if ($notemsg<>""){echo $notemsg."<br>";}?>
               	<span style="color:#ff0000">Confirming empty log !!!</span><br />
            		<input type="submit" value=" DELETE " />&nbsp;&nbsp;<input type="button" value=" CANCEL " onclick="javascript:window.location='logfilemanager.php'" />
                    <br /><img src="../images/span.gif" height="10" />
                </td>
            </tr>
		</table>
        <input type="hidden" name="startd" value="<?=$startd?>" />
        <input type="hidden" name="endd" value="<?=$endd?>" />
        <input type="hidden" name="logno" value="<?=$_SESSION["logno"]?>" />
        </form>
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