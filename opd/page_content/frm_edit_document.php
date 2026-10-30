<?php
	session_start();
	
	$imgpath_top = "../images/design_webOPD/web-OPDS01_01.jpg";
	$imgpath_botton = "../images/design_webOPD/web-OPDS01_04.jpg";

	include ("../System_config/connection.php");

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
	
	$docid = $_GET["docid"];

$SQLeditDoc = "select * from tb_opd_doctype where doctype_id = '$docid'";
$RESeditDoc = mysql_db_query($database,$SQLeditDoc);
$VALeditDoc = mysql_fetch_array($RESeditDoc)

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: OPD - EDIT Document ::</title>

<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif);	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold; background-color:#CCCCCC	}
.note		{	font-family: "mS Sans Serif"; font-size:14;  }
-->
</style>

</head>
<body>

<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
   <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  <tr>
    <td background="../images/design_webOPD/web-OPDS01_03.jpg">
    <!--------------------------->
<table align="center" width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="600" align="right">
    	<a href="show_document.php"><img src="../images/icon_wb4.gif" border="0" /></a><img src="../images/span.gif" width="10" />
    	<a href="frm_add_usergroup.php"><img src="../images/icon_wb2.gif" border="0" /></a><img src="../images/span.gif" width="10" />
    </td>
  </tr>
</table>

<table align="center" width="625" border="0" cellspacing="2" cellpadding="0"><!--//////////////// Step 1.  Add group name -->
  <form name="editDoc" id="editDoc" action="FN_Update/fn_editdocument.php?docid=<?=$docid?>" method="post">
  <tr>
    <td width="201" align="right" class="topic">รหัสอักษรย่อ :</td>
	<td colspan="2" align="left"> <input name="txtDocType" type="text"  value="<?=$VALeditDoc["DocType"]?>" size="10" /></td> 
  </tr>
  <tr>
    <td align="right" class="topic">ชื่อเอกสาร :</td>
    <td width="180"><input name="txtDocname" type="text" value="<?=$VALeditDoc["DocTypeName"]?>" size="30" /></td>
    <td width="236"><input type="submit" value="..SAVE Document.." /></td>
  </tr>
  </form>
  <tr>
    <td colspan="3"><img src="../images/span.gif" /></td>
  </tr>
</table>

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