<?php
	include ("../System_config/connection.php");
	
	//////// uid
	$sqluid = "SELECT MAX(userID) as userID FROM tb_opd_login";
	$resuid = mysql_db_query($database,$sqluid);
	$valuid = mysql_fetch_array($resuid);
	$uid = $valuid["userID"];
	if ($uid == '0'){ $uid = '1';	}
	else { $uid = $uid + '1'; }
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="fn_adduser.php" method="post">
<table width="743" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="146">UserID</td>
    <td colspan="3"><input name="uid" type="text" size="10" maxlength="10" value="<?=$uid?>" /></td>
  </tr>
  <tr>
    <td>Name</td>
    <td width="144"><input name="fname" type="text" size="40" maxlength="40" /></td>
    <td width="103">Surname</td>
    <td width="170"><input name="lname" type="text" size="40" maxlength="40" /></td>
  </tr>
  <tr>
    <td>Username </td>
    <td colspan="3"><input name="username" type="text" size="20" maxlength="20"  /></td>
  </tr>
  <tr>
    <td>Password</td>
    <td colspan="3"><input name="password" type="password" size="20" maxlength="20" /></td>
  </tr>
  <tr>
    <td>ยืนยัน Password</td>
    <td colspan="3"><input name="conpassword" type="password" size="20" maxlength="20" /></td>
  </tr>
  <tr>
    <td>กลุ่มผู้ช้งาน</td>
    <td colspan="3">
    	
        <?php
			$sqltype = "SELECT * FROM tb_opd_type";
			$restype = mysql_db_query($database,$sqltype);
			$numtype = mysql_num_rows($restype);
			print "<select name='type'>";
			while ($valtype = mysql_fetch_array($restype)){
				$typeid = $valtype['TypeID'];
				$type 	= $valtype['Type'];
				print "<option value='$typeid '>$type</option>";
			}
			print "</select>";
		?>
    </td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" value="Save.." /><input type="reset" value="Clear.." /></td>
  </tr>
</table>
</form>
</body>
</html>