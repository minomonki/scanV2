<?php
	session_start();
	
	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

	include("../System_config/connect.php");

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
	
	$an = $_REQUEST["an"];
	$psw = $_REQUEST['psw'];

		$sql ="select * from tb_ipd_doc_setup where an='".$an."'";
		$sql .=" and password='".$psw."'";
		//echo $sql."<br>";
		$result=mysql_query($sql);
		$row = mysql_fetch_array($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
	<link rel="stylesheet" href="../css/autocomplete.css"  type="text/css"/>
	<script type="text/javascript" src="../autocom/autocomplete.js"></script>
<title>:: IPD - EDIT Doc Password ::</title>

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
    <td background="../images/design_webIPD/web-IPDS01_03.jpg">
    <!--------------------------->
<table align="center" width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="600" align="right">
    	<a href="frm_list_docpass.php"><img src="../images/icon_wb4.gif" border="0" /></a><img src="../images/span.gif" width="10" />
    </td>
  </tr>
</table>

<table align="center" width="625" border="0" cellspacing="2" cellpadding="0"><!--//////////////// Step 1.  Add group name -->
  <form name="editDocpass" id="editDocpass" action="fn_editdocpass.php" method="post">
  <tr>
    <td width="201" align="right" class="topic">ผู้ใช้งาน :</td>
	<td colspan="2" align="left">
	<!--<input name="txtforuser" type="text"  value="<?=$row["foruser"]?>" size="15" />-->
	<?php 
		echo "<input type='text' name='txtforuser' id='s_txt_foruser' value='".$row["foruser"]."'/>";
		echo "<input name='h_txt_foruser' type='hidden' id='h_txt_foruser' value=''/>";
	?>
	</td> 
  </tr>
  <tr>
    <td align="right" class="topic">วดป.เริ่มการใช้งาน :</td>
	<td colspan="2" align="left"> <input name="txtstartdate" type="text"  value="<?=$row["startdate"]?>" size="15" /></td> 
  </tr>
  <tr>
    <td align="right" class="topic">วดป.สิ้นสุดการใช้งาน :</td>
	<td colspan="2" align="left"> <input name="txtexpired" type="text"  value="<?=$row["expired"]?>" size="15" /></td> 
  </tr>
  <tr>
    <td colspan="3" align="center">
	<input type="submit" value=" ..SAVE.. " /> &nbsp;<input type="button" value="CANCEL" onclick="window.location='frm_set_docpass.php?cmd_addan=1&txt_addan=<?=$psw?>';" />
	</td>
  </tr>
  <input type="hidden" name="an" value="<?=$row["an"]?>">
  <input type="hidden" name="psw" value="<?=$row["password"]?>">
   <input type="hidden" name="logno" value="<?=$_SESSION["logno"]?>">
   <input type="hidden" name="byuser" value="<?=$_SESSION["user_ipd"]?>">
   <input type="hidden" name="returnurl" value="<?=$_REQUEST["returnurl"]?>">
  </form>
  <tr>
    <td colspan="3"><img src="../images/span.gif" /></td>
  </tr>
</table>

    </td>
  </tr>
	<tr><td><?php include ("../System_Design/footer.php"); ?></td></tr>
</table>

<script type="text/javascript">
function make_autocom(autoObj,showObj){
	var mkAutoObj=autoObj; 
	var mkSerValObj=showObj; 
	new Autocomplete(mkAutoObj, function() {
		this.setValue = function(id) {		
			document.getElementById(mkSerValObj).value = id;
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick ) 
			return ;	
		//return "data.php?q=" +encodeURIComponent(this.value);
		return "../autocom/get_opduser_name.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom("s_txt_foruser","h_txt_foruser");
</script>

</body>
</html>



<?php
}		//////////////// end check session
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>