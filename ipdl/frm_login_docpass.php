<?php
	$imgpath_top = "../ipd/images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../ipd/images/design_webIPD/web-IPDS01_04.jpg";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<link rel="stylesheet" href="../ipd/css/menu/style.css" type="text/css" />
<title>:: IPDL System ::</title>
</head>

<body>
<table align="center" width="314" border="0" cellspacing="0" cellpadding="0">
  <tr><td><?php  include ("header.php");		?></td></tr>
  
  <tr>
  	<td height="337" background="../ipd/images/design_webIPD/web-IPDS01_03.jpg">
		<form action="logindocpass.php" method="post" name="login">
		<table align="center" width="314" border="0" cellspacing="1" cellpadding="1">
  			<tr bgcolor="#C0C0C0">
    			<td colspan="2" align="center"><div class="lnku">ระบบยืม</div></td>
  			</tr>
  			<tr>
    			<td colspan="2" align="center"><BR> </td>
  			</tr>
  			<tr>
    			<td>Password</td>
    			<td><input type="password" name="password"  maxlength="20" /></td>
  			</tr>
  			<tr>
    			<td colspan="2" align="center"><BR><input type="submit" value="Login.." /></td>
  			</tr>
		</table>
		</form>    
    </td>
  </tr>
  
  <tr><td><?php  include ("../ipd/System_Design/footer.php");		?></td></tr>
  
</table>


</body>
</html>