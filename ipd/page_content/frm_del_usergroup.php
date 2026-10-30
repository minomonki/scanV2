<?php
	session_start();
	
	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
		
	include ("../System_config/connection.php");
	
		$gid = $_GET["gid"];

	$SQLdelG = "select * from tb_ipd_usergroup where groupID = '$gid'";
	$RESdelG = mysql_db_query($database,$SQLdelG);
	$VALdelG = mysql_fetch_array($RESdelG)

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: _PD - DELETE  Group  ::</title>

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
        
        <form name="DelDoc" id="DelDoc" action="FN_Delete/fn_delgroup.php?gid=<?=$gid?>" method="post">
    	<table align="center"width="500" border="0" cellspacing="0" cellpadding="0">
  			<tr class="head-tb"><td> ยืนยันการลบข้อมูล </td></tr>
  			<tr bgcolor="#FFFFFF">
    			<td align="left">
                	<img src="../images/span.gif" height="10" /><br />
                    	<img src="../images/span.gif"  width="100"/><br />
                		<img src="../images/span.gif"  width="100"/><span class="topic">Group Name : </span><span class="note"><?=$VALdelG["groupname"]?></span><br />
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