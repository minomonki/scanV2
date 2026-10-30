<?php
	session_start();
#print $_SESSION["Usergroup"];

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
		
	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: IPD - ระบบยืม Change Password ::</title>
<style type="text/css">
<!--
.star		{	font-family: "mS Sans Serif"; font-size:14; color:#F00  }
-->
</style>
<script language="javascript"> 
function validSubmit() { 
//valid dform values
	if(document.dform.password.value == ""){ 
		alert('กรุณาระบุข้อมูล password เดิม'); 
		document.dform.password.focus(); 
		return false; 
	}    
	if(document.dform.passnew.value == ""){ 
		alert('กรุณาระบุข้อมูล password ใหม่'); 
		document.dform.passnew.focus(); 
		return false; 
	}    
	if(document.dform.conpass.value == ""){ 
		alert('กรุณาระบุข้อมูลยืนยัน password ใหม่'); 
		document.dform.conpass.focus();         
		return false; 
	}    
	if(document.dform.conpass.value != document.dform.passnew.value ){ 
		alert('ข้อมูล password ใหม่ ไม่ตรงกัน'); 
		document.dform.conpass.focus();         
		return false; 
	}    
//dform constraints
	document.dform.submit(); 
} 
</script> 
</head>

<body>



<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
  <td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  <img src="../images/span.gif" height="20" />
  <tr>
    <td background="../images/design_webOPD/web-OPDS01_03.jpg">
    
  
	<?php
		$tmp = $_GET['status'];
		if($tmp=="1"){
			$message 	= "ดำเนินการเรียบร้อย";
			$image 		= "accept.gif";
			$bgcolor	= "#CCFFFF";
		}
		else{
			$message 	= "ดำเนินการไม่สำเร็จ กรุณาลองอีกครั้ง";
			$image 		= "cancel.gif";
			$bgcolor	= "#F46A5B";
		}
if($tmp!=""){		
	?>
  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  	<tr bgcolor="<?=$bgcolor?>">
    	<td width="53" align="right"><img src="../images/<?=$image?>" /></td>
        <td width="747" align="left"><?=$message ?></td>
    </tr>
  </table>
<?php
}
?>

 <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#ececec">
 <tr bgcolor="#ececec">
  <td>
  	<img src="../images/span.gif" height="10" />
  </td>
 </tr>
   <tr><td bordercolor="#FFFFCC" bgcolor="#ececec">
<center>
<form action="fn_change2docpass.php" method="post" name="dform" onSubmit='JavaScript:return validSubmit();'>
<table width="339" border="0" cellspacing="1" cellpadding="1" bgcolor="#ececec" >
  <tr>
    <td align="right">Password  เดิม <span class="star">*</span> : </td>
    <td width="168" align="left"><input type="password" name="password" maxlength=5 /></td>
  </tr>
  <tr>
    <td align="right">Password  ใหม่ <span class="star">*</span> : </td>
    <td width="168" align="left"><input type="password" name="passnew" maxlength="10"/></td>
  </tr>
  <tr>
    <td align="right">ยืนยัน Password ใหม่<span class="star">*</span> : </td>
    <td width="168" align="left"><input type="password" name="conpass"  maxlength="10"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    	<input type="submit" value="Update" /><input type="reset" value="Clear" /><br><br>
        <a href='../frm_login_docpass.php'>Goto login page</a>
    </td>
  </tr>
</table>
</form>
</center>
</td>
</tr>

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