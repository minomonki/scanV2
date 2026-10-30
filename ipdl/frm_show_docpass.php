<?php

	session_start();
include ("../ipd/System_config/const.php");
	#print $_SESSION["Usergroup_ipd"];

	$imgpath_top = "../ipd/images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../ipd/images/design_webIPD/web-IPDS01_04.jpg";

	include ("../ipd/System_config/connection.php");
	
  /////  check authorized
if($_SESSION['userdocpass']<>"") {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" href="../ipd/css/menu/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../ipd/datepick/css/smoothness/jquery-ui-1.7.2.custom.css">
	<link rel="stylesheet" href="../ipd/css/autocomplete.css"  type="text/css"/>

<title>:: IPDL - Show AN List  ::</title>
<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif);	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold;	}
-->
</style>

<script type="text/javascript">  
function popup(url,name,windowWidth,windowHeight){       
    myleft=(screen.width)?(screen.width-windowWidth)/2:100;    
    mytop=(screen.height)?(screen.height-windowHeight)/2:100;      
    properties = "width="+windowWidth+",height="+windowHeight;   
    properties +=",scrollbars=yes,toolbar=no,menubar=no"
	properties +=",location=no, top="+mytop+",left="+myleft;      
    window.open(url,name,properties); 
}   
</script> 
<script type="text/javascript">  
var statusmsg=""

function hidestatus(){
window.status=statusmsg
return true
}

</script>

</head>

<body>


<table align="center" width="999" border="0" cellspacing="0" cellpadding="0">
  <tr><td width="999"><?php include ("header.php"); ?></td></tr>
  
  <tr>
    <td background="../ipd/images/design_webIPD/web-IPDS01_03.jpg">

	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->
<br>
<?
if ($_SESSION['userdocpass']<>''){
	include("../ipd/System_config/connect.php");
	include("../ipd/System_config/func.php");
	$syspass=$_REQUEST['syspass'];
	////////// Check Exist an on this Password
	$query ="select * from tb_ipd_doc_setup where password='".$syspass."'";
	$query .=" order by byupdate";
	//echo $query;
	$result = mysql_query($query);
	$totalan=mysql_num_rows($result);
	if ($totalan>0) {
		$id=1;
		while($row = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
		if ($id==1){
			//$txt_password=$row['password'];
			//$txt_foruser=$row['foruser'];
			echo "<table class='rowh' align='center' width='90%' cellspacing='2' cellpadding='2' border='0'>";
			echo "<tr>";
			echo "<td bgcolor='#a9a9a9' align='right' class='hdtable' width='14%'>Password ref. :&nbsp; </td>";
			echo "<td class='listdetail' colspan=4>&nbsp;&nbsp;&nbsp;&nbsp;".$syspass;
			echo "</td>";
			echo "<td>";
			echo "<a href=frm_change_docpass.php?syspass=$syspass title='เปลี่ยนรหัสผ่าน ระบบยืม'><img src='../ipd/images/key.jpg' border=0 width=30></a>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<a href=logoutdocpass.php title='logout ระบบยืม'><img src='../ipd/images/logout-icon.png' border=0 width=30></a>";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td bgcolor='#a9a9a9' align='right' class='hdtable'>ชื่อ-สกุล :&nbsp; </td>";
			echo "<td class='listdetail' colspan=5>&nbsp;&nbsp;&nbsp;&nbsp;".$row['foruser']."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td align='right' class='hdtable' bgcolor='#ffffff' >&nbsp; </td>";
			echo "<td class='hdtable' align='center' width=5%>ลำดับ</td>";
			echo "<td class='hdtable' align='center'>AN</td>";
			echo "<td class='hdtable' align='center'>รายละเอียด</td>";
			echo "<td class='hdtable' align='center'>ระยะเวลาใช้งาน</td>";
			echo "<td class='hdtable' align='center'>imagescan</td>";
			echo "</tr>";
		}// end  if did
			echo "<tr".$rcolor.">";
			echo "<td bgcolor='#ffffff' align='right' class='hdtable' >&nbsp; </td>";
			echo "<td class='listdetail' align='center'>".$id."</td>";
			echo "<td class='listdetail' align='center'>".$row['an']."</td>";
			echo "<td class='listdetail' align='left'> &nbsp;".getANdetail2($row['an'])."</td>";
			echo "<td class='listdetail' align='center'>".getFormatdate($row['startdate'],1)." - ".getFormatdate($row['expired'],1)."</td>";
			echo "<td align='center'>";
//check valid start,expire to show
$chkpass = chkPass2show3($row['an'],$_SESSION["userdocpass"],$today2);
if ($chkpass==1){
?>     <a title='View' href="javascript:popup('show_detail.php?an=<?=$row['an'];?>&logno=<?=$_SESSION['lognodocpass'];?>','null',950,500);"onMouseover="return hidestatus()" onMouseOut="return hidestatus()"><img src="../ipd/images/icon_showinfo.gif" border="0"/></a>
<?
}else{
	echo "<span title='Expired' style='cursor: hand'><img  src='../ipd/images/cancel-icon.png' border='0' alt='Expired'/></span>";
}
			echo "</td>";
			echo "</tr>";
				$id++;
		} //end of while loop
		echo "</table><br>";
		//////////////////////////////////////////////////////////////
	}else{//no record found
		echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div>";
	}// end if num_rows

}// end if chk cmd???
?>
<br>
	</td><!--end of detail body -->
</tr>
</table>
	<!-- central main -->  

    <img src="../ipd/images/span.gif" height="20" />
    </td>
  </tr>
  <tr><td><?php include ("../ipd/System_Design/footer.php"); ?></td></tr>
</table>

</body>
</html>

<?php
}
else{
	print "<script language='javascript' >window.location='frm_login_docpass.php';</script>";
}
?>