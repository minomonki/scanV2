<?php
	session_start();
	
	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

	include ("../System_config/connection.php");

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
	
	$showTable = "0";
	
	$showTable = $_GET["status"];
	
#print "look = ".$showTable;	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: IPD - ADD Document ::</title>

<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif);	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold; background-color:#CCCCCC	}
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
    	<a href="show_document.php"><img src="../images/icon_wb4.gif" border="0" /></a><img src="../images/span.gif" width="10" />
    	<a href="frm_add_document.php"><img src="../images/icon_wb2.gif" border="0" /></a><img src="../images/span.gif" width="10" />
    </td>
  </tr>
</table>

<?php
/////////////////////// select Group ID
	$SQLdocid = "select DocID as id from tb_ipd_doctype  order by DocID desc";
	$RESdocid = mysql_db_query($database,$SQLdocid);
	$ii=0;
	while ($VALdocid = mysql_fetch_array($RESdocid)){
		$id = $VALdocid["id"];
		$ii++;
		if ($ii==2) break;
	}
#print "look = ".$SQLgid;
	if (($id == "") or ($id == "0")){	$id = "1";	}
	else {	$id = $id + "1";}
//////////////////////  end select Group ID

?>

<table align="center" width="839" border="0" cellspacing="2" cellpadding="0"><!--//////////////// Step 1.  Add Document name -->
<form name="addDoc_ipd" id="addDoc_ipd" action="FN_Insert/fn_adddocument.php?IPDid=<?=$id?>" method="post"> <!-- form 1 -->
  <tr>
    <td width="324"  align="right" class="topic">รหัสอักษรย่อ :</td>
 	<td colspan="2" align="left"> <input name="txtDocType" type="text"  size="10" /></td>  
</tr>
  <tr>
    <td align="right" class="topic">ชื่อเอกสาร  :</td>
    <td width="180" ><input name="txtDocname" type="text"  size="30" /></td>
    <td width="327"><input type="submit" value="..ADD Document.." /></td>
  </tr>
<input type="hidden" name="logno" value="<?=$_SESSION["logno"]?>" />
</form> <!-- form 1 -->
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