<?php
	session_start();
	
	$imgpath_top = "../images/design_webOPD/web-OPDS01_01.jpg";
	$imgpath_botton = "../images/design_webOPD/web-OPDS01_04.jpg";

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
		
	include ("../System_config/connection.php");
	
		$uid = $_GET["userid"];

	$SQLdelUser = "select * from tb_opd_login where userID = '$uid'";
	$RESdelUser = mysql_db_query($database,$SQLdelUser);
	$VALdelUser = mysql_fetch_array($RESdelUser);
				$groupID = $VALdelUser['usergroup'];
						$SQLG = "select * from tb_opd_group where groupID='$groupID'";
						$RESG = mysql_db_query($database,$SQLG);
						$VALG = mysql_fetch_array($RESG);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: OPD - DELETE  User Account ::</title>

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
    <td align="center" background="../images/design_webOPD/web-OPDS01_03.jpg">
    	<img src="../images/span.gif" height="20" />
        
        <form name="DelDoc" id="DelDoc" action="FN_Delete/fn_deluser.php?userid=<?=$uid?>" method="post">
    	<table  width="500" border="0" cellspacing="0" cellpadding="0">
  			<tr class="head-tb"><td height="38"> ยืนยันการลบข้อมูล </td></tr>
  			<tr bgcolor="#FFFFFF">
    			<td align="left">
                	<img src="../images/span.gif" height="10" /><br />
                    	<img src="../images/span.gif"  width="100"/><br />
                		<img src="../images/span.gif"  width="100"/><span class="topic">User Account : </span><span class="note"><?=$VALdelUser["username"]?></span><br />
						<img src="../images/span.gif" width="100" /><span class="topic">ชื่อ - นามสกุล : </span><span class="note"><?=$VALdelUser["Fname"]?>  <?=$VALdelUser["Lname"]?></span><br />
                        <img src="../images/span.gif" width="100" /><span class="topic">กลุ่มผู้ใช้ : </span><span class="note"><?=$VALG["groupname"]?></span><br />
                   <img src="../images/span.gif" height="10" />
                </td>
  			</tr>
  			<tr bgcolor="#FFFFFF">
            	<td align="center">
               		<img src="../images/span.gif" height="10" /><br />
                	<span class="memo">ยืนยันการลบข้อมูล</span><br />
            		<input type="submit" value=".. DELETE Document .." />
                    <br /><img src="../images/span.gif" height="10" />
                </td>
            </tr>
		</table>
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