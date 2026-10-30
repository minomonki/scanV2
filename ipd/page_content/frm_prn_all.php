<?php
	session_start();
	
	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

	
	include ("../System_config/connect.php");
	include ("../System_config/func.php");

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
	
	$an = base64_decode($_REQUEST["anID"]);//echo $an;
	if ($an==""){print "<script language='javascript' >window.close()';</script>";}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: IPD - Print All ::</title>

<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif);	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold; background-color:#CCCCCC	}
.note		{	font-family: "mS Sans Serif"; font-size:14;  }
.style2 {font-size: 14px}
.style3 {
	font-family: "mS Sans Serif";
	font-size: 16px;
}
.style5 {font-family: "mS Sans Serif"; font-size: 16px; font-weight: bold; background-color: #CCCCCC; }
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
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
function checkAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}
//  End -->
</script>



</head>

<body>
<table align="center" width="90%" border="0" cellspacing="2" cellpadding="0" style="line-height: 25px">
<tr><td colspan=1><u>Print List selected AN</u> : <b><?=$an?></b></td></tr>
<form name="doprint" id="doprint" action="img_show3.php" method="post"> <!-- form 1 -->
<?php
	//$maxdocid=getMaxdocid($an)	;
	$sql = "select a.docid,a.doctypename from  tb_ipd_doctype a,tb_ipd_doctype_detail b where a.docid=b.doctype";
	$sql .= " and an='".$an."'";
	$sql .= " order by DocID asc";
	$result=mysql_query($sql);
	//$countd=mysql_num_rows($result);
	if ($result){
		while ($row = mysql_fetch_array($result)){
		echo "<tr><td>&nbsp;&nbsp;";
		echo "<input type='checkbox' name='".$row[0]."'  value='".$row[0]."' checked='checked'>".$row[1];
		echo "</td></tr>";
		}//end while
	}//end if result
	$anencode=base64_encode($an);
?>
  <tr>
    <td width="180" ><BR>
	<input type="submit" name="cmd_print"  value="    OK    " />&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" value="CANCEL" onclick="javascript:window.location='show_detail.php?anID=<?=$anencode?>'" />
	</td>
  </tr>
<input type="hidden" name="logno" value="<?=$_SESSION["logno"]?>" />
<input type="hidden" name="an" value="<?=$an?>" />
</table>
</form> <!-- form 1 -->
    
</body>
</html>



<?php
}		//////////////// end check session
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>