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
<title>:: IPD - SHOW User_Account ::</title>

<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif)	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold; background-color:#CCCCCC	}
.usermain		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold  }
.userdetail		{	font-family: "mS Sans Serif"; font-size:14;  }
-->
</style>
</head>

<body>

<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  <img src="../images/span.gif" height="20" />
  
  <tr>
    <td background="../images/design_webIPD/web-IPDS01_03.jpg">
    
 
<table align="center" width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="600"  height="40" align="left" bgcolor="<?=$bgcolor?>"><strong><?=$showstatus?></strong></td>
  </tr>
  <tr align="right">
    <td width="600" align="right"><a href="frm_add_user.php"><img src="../images/icon_wb2.gif" border="0" /></a></td>
  </tr>
</table>

<table align="center" width="800" border="1" cellspacing="0" cellpadding="0">
  <tr class="head-tb">
    <td width="62" height="36" align="center">ลำดับที่</td>
    <td width="635" align="center">รายละเอียดผู้ใช้งาน</td>
    <td width="59" align="center">แก้ไข</td>
    <td width="44" align="center">ลบ</td>
  </tr>
<?php
$SQLshowUser = "select * from tb_ipd_login order by userID asc";
$RESshowUser = mysql_db_query($database,$SQLshowUser);
$RCount = 0;
while($VALshowUser = mysql_fetch_array($RESshowUser)){
			$groupID = $VALshowUser['usergroup'];
						$SQLG = "select * from tb_ipd_usergroup where groupID='$groupID'";
						$RESG = mysql_db_query($database,$SQLG);
						$VALG = mysql_fetch_array($RESG);
						if (($VALshowUser["userID"])<>"") $RCount  = $RCount +1;
?>
 <?php if ($VALshowUser["userID"] !=999){ //Chk Admin Not show in table?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?=$RCount?></td>
    <td>
    		<span class="usermain"> ชื่อ - นามสกุล : </span>  <span class="userdetail"><?=$VALshowUser["Fname"]?>   <?=$VALshowUser["Lname"]?></span><br>
            <span class="usermain">Username : </span>	<span class="userdetail"><?=$VALshowUser["username"]?></span><br>
            <span class="usermain">กลุ่มผู้ใช้ : </span>  <span class="userdetail"><?=$VALG["groupname"];?></span><br>
    </td>
    <?php
		if($_SESSION["user_ipd"] != $VALshowUser["username"]){			///////////////////////////////////////// if chk show list
	?>
    <td align="center"><a href="frm_edit_user.php?userid=<?=$VALshowUser["userID"]?>&gid=<?=$groupID?>"><img src="../images/icon_n_edit.gif" border="0" /></a></td>
    <td align="center"><a href="frm_del_user.php?userid=<?=$VALshowUser["userID"]?>"><img src="../images/icon_b_delete2.gif" border="0" /></a></td>
  </tr>
 <?php
	}  ///////////////////////////////////////// if chk show list
	else {			///////////////////////////////////////// else  chk show list
		print "<td>&nbsp;</td>";
		print "<td>&nbsp;</td>";
	}			///////////////////////////////////////// else  chk show list
}
}//end Chk Admin Not show in table?>

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