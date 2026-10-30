<?php
	session_start();
	
	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

	include ("../System_config/connection.php");

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {

	////  query data user
	
	$id = $_GET["userid"];
	
$SQLeditUser = "select * from tb_ipd_login where userID = '$id'";
$RESeditUser = mysql_db_query($database,$SQLeditUser);
$VALeditUser = mysql_fetch_array($RESeditUser);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: IPD - EDIT User Account ::</title>

<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif);	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold; background-color:#CCCCCC	}
.star		{	font-family: "mS Sans Serif"; font-size:14; color:#F00  }
.note		{	font-family: "mS Sans Serif"; font-size:14;  }
-->
</style>
<script language="javascript">
function fncSubmit()
{
	if(confirm('ยืนยันการบันทึกข้อมูล')==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>

</head>

<body>


<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  
  <tr>
    <td background="../images/design_webIPD/web-IPDS01_03.jpg">
    
     <img src="../images/span.gif" height="20" />  
<table align="center" width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="900" align="right">
    	<a href="show_user.php"><img src="../images/icon_wb4.gif" border="0" /></a><img src="../images/span.gif" width="10" />
    	<a href="frm_add_user.php"><img src="../images/icon_wb2.gif" border="0" /></a><img src="../images/span.gif" width="10" />
    </td>
  </tr>
</table>

<table align="center" width="839" border="0" cellspacing="2" cellpadding="0"><!--//////////////// Step 1.  Add Document name -->
<form name="addUser" id="editUser" action="FN_Update/fn_edituser.php?id=<?=$id?>&usr=<?=$VALeditUser["username"]?>" method="post">
  	<tr>
    		<td colspan="3"  align="left" >User Account :</td>
 	</tr>
    <tr>
    
  </tr>
  <tr>
    <td width="324"  align="right" class="topic">User Group :</td>
    <td colspan="2" align="left"><select name="usergroup">
      <option value="0">::  เลือกกลุ่มผู้ใช้งาน ::</option>
    	<?php
			$SQLgroup = "select * from tb_ipd_usergroup order by groupID asc";
			$RESgroup = mysql_db_query($database,$SQLgroup);
			while($VALgroup = mysql_fetch_array($RESgroup)){
				$groupID =  $VALgroup['groupID'];
				$groupname =  $VALgroup['groupname'];
				$strTmp = "<option value='$groupID'";

				if($groupID == $_GET["gid"]){
					$strTmp .=  "  selected=select>$groupname </option>";
				}
				else{
					$strTmp .=  "  >$groupname </option>";
				}
				print $strTmp;
			}		
		?>
    </select></td>
  </tr>
  <tr>
    <td width="324"  align="right" class="topic">Username <span class="star">*</span> :</td>
    <td colspan="2" align="left"><input type="text" name="txtuser" value="<?=$VALeditUser["username"]?>" disabled="disabled"/></td>
  </tr>
  <tr>
    <td align="right" class="topic">Password <span class="star">*</span> :</td>
    <td colspan="2" align="left"><input type="password" name="txtpass" value="<?=$VALeditUser["password"]?>" /></td>
  	</tr>
  <tr>
    <td align="right" class="topic">ยืนยัน Password <span class="star">*</span> :</td>
    <td colspan="2" align="left"><input type="password" name="txtconpass" value="<?=$VALeditUser["password"]?>" /></td>
  	</tr>
    <tr>
    		<td colspan="3"  align="left">User Profile :</td>
 	</tr>
   <tr>
    <td align="right" class="topic">ชื่อ  <span class="star">*</span> :</td>
    <td colspan="2" align="left"><input type="text" name="txtfname" value="<?=$VALeditUser["Fname"]?>" /></td>
  	</tr>
     <tr>
    <td align="right" class="topic">นามสกุล <span class="star">*</span> :</td>
    <td colspan="2" align="left"><input type="text" name="txtlname" value="<?=$VALeditUser["Lname"]?>" /></td>
  	</tr>
    <tr>
    	<td colspan="3" align="center">
        	<img src="../images/span.gif" /><br />
    		<input type="submit" value="... EDIT User Account ..." />
     	</td>
    </tr>
        <input type="hidden" name="logno" value="<?=$_SESSION["logno"]?>" />
</form>
  <tr>
    <td colspan="3"><img src="../images/span.gif" /></td>
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
}		//////////////// end check session
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>