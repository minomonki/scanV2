<?php
	session_start();
	
	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";
	
$Status=$_GET["status"];
	#print  $StatusAdd;
	if($Status == 1){
			$bgcolor = "#66FF66";
			$showstatus = "ดำเนินการสำเร็จ";
	}
	else if (($Status == 0) and ($Status != "")){
			$bgcolor = "#FF0000";
			$showstatus = "ไม่สามารถดำเนินการได้ กรุณาลองอีกครั้ง";
	}
	else {
			$bgcolor = "";
			$showstatus = "";
	}
	

	include ("../System_config/connection.php");
	
  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: IPD SHOW Usergroup ::</title>

<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif)	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold; background-color:#CCCCCC	}
.note		{	font-family: "mS Sans Serif"; font-size:14;  }
-->
</style>
</head>

<body>

<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
  <td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  <img src="../images/span.gif" height="20" />
  
  <tr>
    <td background="../images/design_webIPD/web-IPDS01_03.jpg">
    
 
<table align="center" width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="600"  height="40" align="left" bgcolor="<?=$bgcolor?>"><strong><?=$showstatus?></strong></td>
  </tr>
  <tr>
    <td width="600" align="right"><a href="frm_add_usergroup.php"><img src="../images/icon_wb2.gif" border="0" /></a></td>
  </tr>
</table>

<table align="center" width="800" border="1" cellspacing="0" cellpadding="0">
  <tr class="head-tb">
    <td width="62" height="38" align="center">ลำดับที่</td>
    <td width="635" align="center">ชื่อกลุ่มผู้ใช้งาน</td>
    <td width="59" align="center">แก้ไข</td>
    <td width="44" align="center">ลบ</td>
  </tr>
<?php
$SQLshowG = "select * from tb_ipd_usergroup order by groupID asc";
$RESshowG = mysql_db_query($database,$SQLshowG);
$Rcount = 0;
while($VALshowG = mysql_fetch_array($RESshowG)){
 if (($VALshowG["groupID"])<>"") $Rcount = $Rcount + 1;
?>
 <?php if ($VALshowG["groupID"] !=99){ //Chk GroupAdmin Not show in table?>
  <tr>
    <td align="center"><?=$Rcount?></td>
    <td><?=$VALshowG["groupname"]?></td>
    <td align="center"><a href="frm_edit_usergroup.php?gid=<?=$VALshowG["groupID"]?>"><img src="../images/icon_n_edit.gif" border="0" /></a></td>
    <td align="center"><a href="frm_del_usergroup.php?gid=<?=$VALshowG["groupID"]?>"><img src="../images/icon_b_delete2.gif" border="0" /></a></td>
  </tr>
<?php
}
} //End if Chk GroupAdmin Not show in table?>
</table>   
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