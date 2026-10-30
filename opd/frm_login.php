<?php
session_start();
	$imgpath_top = "images/design_webOPD/web-OPDS01_01.jpg";
	$imgpath_botton = "images/design_webOPD/web-OPDS01_04.jpg";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/menu/style.css" type="text/css" />
<title>:: OPDS System ::</title>
</head>

<body>
<table align="center" width="314" border="0" cellspacing="0" cellpadding="0">
  <tr><td><?php if (isset($_SESSION["user"]) && $_SESSION["user"]!=""){							
	  print "<script language='javascript' >window.location='page_content/frm_search.php';</script>";}
			include ("System_Design/header.php");		?></td></tr>
  
 <tr>
  	<td height="337" background="images/design_webOPD/web-OPDS01_03.jpg">
		<form action="login.php" method="post" name="login">
		<table align="center" width="314" border="0" cellspacing="1" cellpadding="1">
  			<tr>
    			<td width="93">Username</td>
    			<td width="214"><input type="text" name="username" /></td>
  			</tr>
  			<tr>
    			<td>Password</td>
    			<td><input type="password" name="password"  /></td>
  			</tr>
  			<tr>
    			<td colspan="2" align="center"><input type="submit" value="Login.." /><input type="reset" value="Clear Form.." /></td>
  			</tr>
		</table>
		</form>    
    </td>
  </tr>
  
  <tr><td><?php  include ("System_Design/footer.php");		?></td></tr>
  
</table>


</body>
</html>