<?php

	session_start();
include ("../System_config/const.php");
	#print $_SESSION["Usergroup_ipd"];

	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";

	include ("../System_config/connection.php");
	
  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../datepick/css/smoothness/jquery-ui-1.7.2.custom.css">
	<link rel="stylesheet" href="../css/autocomplete.css"  type="text/css"/>
	<script type="text/javascript" src="../autocom/autocomplete.js"></script>

<title>:: IPD - Setup ::</title>
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
<script language="javascript"> 
function validSubmit() { 
//valid dform values
	if(document.dform.txt_foruser.value == ""){ 
		alert('กรุณาระบุข้อมูลผู้ใช้งานเอกสาร'); 
		document.dform.txt_foruser.focus(); 
		return false; 
	}    
	if(document.dform.admit_s.value == ""){ 
		alert('กรุณากรอกข้อมูล วดป. เริ่มต้นการใช้งาน'); 
		document.dform.admit_s.focus(); 
		return false; 
	}    
	if(document.dform.admit_e.value == ""){ 
		alert('กรุณากรอกข้อมูล วดป. สิ้นสุดการใช้งาน'); 
		document.dform.admit_e.focus();         
		return false; 
	}    
//dform constraints
	document.dform.submit(); 
} 
</script> 
<script language="javascript"> 
function validSubmit2() { 
//valid dform values
	if(document.dform.txt_plusan.value == ""){ 
		alert('กรุณาระบุข้อมูล AN');
		document.dform.txt_plusan.focus(); 
		return false; 
	}    
	if(document.dform.admit_s.value == ""){ 
		alert('กรุณากรอกข้อมูล วดป. เริ่มต้นการใช้งาน'); 
		document.dform.admit_s.focus(); 
		return false; 
	}    
	if(document.dform.admit_e.value == ""){ 
		alert('กรุณากรอกข้อมูล วดป. สิ้นสุดการใช้งาน'); 
		document.dform.admit_e.focus();         
		return false; 
	}    
//dform constraints
	document.dform.submit(); 
} 
</script> 


</head>

<body>


<table align="center" width="999" border="0" cellspacing="0" cellpadding="0">
  <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  
  <tr>
    <td background="../images/design_webIPD/web-IPDS01_03.jpg">

<table align="center" width="701" border="0" cellspacing="2" cellpadding="0">
<form name="search" method="post" action="frm_set_docpass.php">
  <tr>
    <td class="head-topic"><BR>:: กำหนดรหัสผ่านการยืมใช้งาน AN :: </td>
	<td><BR><!--<input type="text" name="txt_an" size="15" maxlength="20"/>-->
		<input type="text" name="txt_an" id="s_txt_an" />
		<input name="h_txt_an" type="hidden" id="h_txt_an" value="" />
&nbsp;<input type="submit" name="cmd_create" value=" Create " /></td>
    </td>
  </tr>
</form>
<form name="add" method="post" action="frm_set_docpass.php">
  <tr>
    <td class="head-topic" align=right width=250><BR>:: เพิ่มการยืม AN ในรหัสผ่าน :: </td>
	<td><BR><!-- <input type="text" name="txt_an" size="25" maxlength="20"/>-->
				<input type="text" name="txt_addan" id="s_txt_addan" />
				<input name="h_txt_addan" type="hidden" id="h_txt_addan" value="" />
&nbsp;<input type="submit" name="cmd_addan" value=" OK " /></td>
  </tr>
</form>
<form name="add" method="post" action="frm_set_docpass.php">
  <tr>
    <td class="head-topic" align=right width=250><BR>:: เพิ่มการยืม AN ในผู้ใช้งาน :: </td>
	<td><BR><!-- <input type="text" name="txt_an" size="25" maxlength="20"/>-->
				<input type="text" name="txt_addanbyuser" id="s_txt_addanbyuser" />
				<input name="h_txt_addanbyuser" type="hidden" id="h_txt_addanbyuser" value="" />
&nbsp;<input type="submit" name="cmd_addan" value=" OK " /></td>
  </tr>
</form>
</table>
	
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0" >
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->
<br>
<?
if ($_REQUEST['cmd_create']<>''){
	include("../System_config/connect.php");
	////////// Check Exist AN
	$query ="select * from tb_ipd where an='".$_REQUEST['txt_an']."'";
	//echo $query;
	$result = mysql_query($query);
	if (mysql_num_rows($result)>0) {
		$row = mysql_fetch_array($result);
		echo "<table class='rowh' align='center' width='90%' cellspacing='2' cellpadding='2' border='0'>";
		echo "<tr>";
		echo "<td bgcolor='#a9a9a9' align='right' class='hdtable' width='10%'>HN :&nbsp; </td>";
		echo "<td class='listdetail'>&nbsp;&nbsp;&nbsp;&nbsp;".$row['hn']."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td bgcolor='#a9a9a9' align='right' class='hdtable' width='10%'>ชื่อ-สกุล :&nbsp; </td>";
		echo "<td class='listdetail'>&nbsp;&nbsp;&nbsp;&nbsp;".$row['firstname']."&nbsp;&nbsp;".$row['lastname']."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td bgcolor='#a9a9a9' align='right' class='hdtable' width='10%'>AN :&nbsp; </td>";
		echo "<td class='listdetail'>&nbsp;&nbsp;&nbsp;&nbsp;".$row['an']."</td>";
		echo "</tr>";
		echo "</table><br>";
		//////////////////////////////////////////////////////////////
		//////////////////////// Create new password //////////////////////////
		echo "<div class='blackb' align='center'>###### เพิ่มการกำหนดสิทธิ  #####</div>";
		echo "<table class='rowh1' align='center' width='90%' cellspacing='0' cellpadding='0' bordercolor='#000000' border='1' style='border-collapse:collapse;'>";
		echo "<tr bgcolor='#a9a9a9'>";
		echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
		echo "<td align='center' class='hdtable' width='10%'>Password</td>";
		echo "<td align='center' class='hdtable' width='15%'>ผู้ใช้งานเอกสาร</td>";
		echo "<td align='center' class='hdtable' width='70%'>วดป.เริ่มการใช้งาน   ถึง วดป.สิ้นสุดการใช้งาน </td>";
		echo "</tr>";
		echo "<form name='dform' method='post' action='fn_setdocpass.php' onSubmit='JavaScript:return validSubmit();'>";
		echo "<tr>";
		echo "<td align='center' class='listdetail'>1</td>";
		$chkpass = 0;
		while ($chkpass==0){
			$docpass=rand(10000,99999);
			include_once("../System_config/func.php");
			$validpass=chkDocpass($_REQUEST['txt_an'],$docpass);
			if ($validpass==1){$chkpass=1;} 
		//echo $docpass."=".$validpass."<br>";
		}
		//echo "<input type='text' name='txt_password' size='15' value='".rand(10000,99999)."' disabled />";
		echo "<td align='center' class='listdetail'>".$docpass."</td>";
		echo "<td align='center' class='listdetail'>";
		//echo "<input type='text' name='txt_foruser' size='25' maxlength='30' />";
		echo "<input type='text' name='txt_foruser' id='s_txt_foruser' />";
		echo "<input name='h_txt_foruser' type='hidden' id='h_txt_foruser' value=''/>";
		echo "</td>";
		echo "<td align='center' class='listdetail'>";
 ?>      
    	<strong>เริ่มต้นวันที่</strong>
		<input type="text" name="admit_s" id="admit_s" />
        <img src="../images/span.gif" width="10" />   
        <strong>สิ้นสุดวันที่</strong>
        <img src="../images/span.gif" width="10" />   
        <input type="text" name="admit_e" id="admit_e" />
        <script type="text/javascript" src="../datepick/js/jquery-1.3.2.min.js"></script>
  		<script type="text/javascript" src="../datepick/js/jquery-ui-1.7.2.custom.min.js"></script>
<?php
    	include("../datepick/datepick.php");
		echo "</td>";
		echo "</tr>";
		echo "<input type='hidden' name='txt_an' value='".$_REQUEST['txt_an']."'>";
		echo "<input type='hidden' name='txt_password' value='".$docpass."'>";
		echo "<input type='hidden' name='txt_byuser' value='".$_SESSION["user_ipd"]."'>";
		echo "<input type='hidden' name='logno' value='".$_SESSION["logno"]."'>";
		echo "</table><br>";
		echo "<div align='center'><input type='submit' name='cmd_show' value=' กำหนดสิทธิ ' /></div>";
		echo "</form>";
		//////////////////////// End Create new ///////////////////////////
	
	}else{//no record found
		echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div>";
	}// end of if chk $result
}elseif ($_REQUEST['cmd_addan']<>''){
	include("../System_config/connect.php");
	include("../System_config/func.php");
	////////// Check Exist an on this Password
	if ($_REQUEST['txt_addan']<>""){
		$query ="select * from tb_ipd_doc_setup where password='".$_REQUEST['txt_addan']."'";
	}else{
		$query ="select * from tb_ipd_doc_setup where password='".getPassbyForuser($_REQUEST['txt_addanbyuser'])."'";
	}
	$query .=" order by byupdate";
	//echo $query;
	$result = mysql_query($query);
	$totalan=mysql_num_rows($result);
	if ($totalan>0) {
		$id=1;
		while($row = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
		if ($id==1){
			$txt_password=$row['password'];
			$txt_foruser=$row['foruser'];
			echo "<table class='rowh' align='center' width='90%' cellspacing='2' cellpadding='2' border='0'>";
			echo "<tr>";
			echo "<td bgcolor='#a9a9a9' align='right' class='hdtable' width='13%'>Password Ref. :&nbsp; </td>";
			echo "<td class='listdetail' colspan=7>&nbsp;&nbsp;&nbsp;&nbsp;".$txt_password."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td bgcolor='#a9a9a9' align='right' class='hdtable'>ชื่อ-สกุล :&nbsp; </td>";
			echo "<td class='listdetail' colspan=7>&nbsp;&nbsp;&nbsp;&nbsp;".$row['foruser']."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td align='right' class='hdtable' bgcolor='#ffffff' >&nbsp; </td>";
			echo "<td class='hdtable' align='center' width=5%>ลำดับ</td>";
			echo "<td class='hdtable' align='center' width=16%>AN</td>";
			echo "<td class='hdtable' align='center'>วดป.เริ่มการใช้งาน</td>";
			echo "<td class='hdtable' align='center'>วดป.สิ้นสุดการใช้งาน</td>";
			echo "<td class='hdtable' align='center'>ปรับปรุงล่าสุด เมื่อ</td>";
			echo "<td class='hdtable' align='center'>แก้ไข</td>";
			echo "<td class='hdtable' align='center'>ลบ</td>";
			echo "</tr>";
		}// end  if did
			echo "<tr".$rcolor.">";
			echo "<td bgcolor='#ffffff' align='right' class='hdtable' >&nbsp; </td>";
			echo "<td class='listdetail' align='center'>".$id."</td>";
			echo "<td class='listdetail' align='center'>".$row['an']."</td>";
			echo "<td class='listdetail' align='center'>".getFormatdate($row['startdate'],1)."</td>";//$row['startdate'].", ".
			echo "<td class='listdetail' align='center'>".getFormatdate($row['expired'],1)."</td>";//$row['expired'].", ".
			echo "<td class='listdetail' align='center'>".getFormatdate($row['byupdate'],2)."</td>";//$row['byupdate'].", ".
			echo "<td align='center'>";
			echo "<a href='frm_edit_docpass.php?an=".$row['an']."&psw=".$row['password']."&returnurl=".$filename."'><img src='../images/icon_n_edit.gif' border='0' /></a>";
			echo "</td>";
			echo "<td align='center'>";
			echo "<a href='frm_delan_docpass.php?txt_an=".$row['an']."&psw=".$row['password']."&totalan=".$totalan."'><img src='../images/icon_b_delete2.gif' border='0' /></a>";
			echo "</td>";
			echo "</tr>";
				$id++;
		} //end of while loop
		echo "</table><br>";
		//////////////////////////////////////////////////////////////
	}// end if num_rows
		////////////////////////Add New AN//////////////////////////
		echo "<div class='blackb' align='center'></div>";//###### กำหนด AN เพิ่ม  #####
		echo "<table class='rowh' align='center' width='90%' cellspacing='2' cellpadding='2' bordercolor='#000000' border='0' >";
		echo "<form name='dform' method='post' action='fn_addan2docpass.php' onSubmit='JavaScript:return validSubmit2();'>";
		echo "<tr>";
		echo "<td align='center' class='hdtable' width='13%' bgcolor='#ffffff'></td>";
		echo "<td class='listdetail' align='center' bgcolor='#D9D9FF' width=5%>".$id."</td>";
		echo "<td align='center' class='listdetail' bgcolor='#D9D9FF'>";
		//input type guide as google
		echo "<input type='text' size=15 name='txt_plusan' id='s_txt_plusan' />";
		echo "<input name='h_txt_plusan' type='hidden' id='h_txt_plusan' value=''/>";
		echo "&nbsp;&nbsp;<div id='status'></div>";
		echo "</td>";
		echo "<td align='left' class='listdetail' colspan=3 bgcolor='#D9D9FF'>";
 ?>      
    	<strong>เริ่มต้นวันที่</strong>
		<input type="text" name="admit_s" id="admit_s" />
        <img src="../images/span.gif" width="10" />   
        <strong>สิ้นสุดวันที่</strong>
        <img src="../images/span.gif" width="10" />   
        <input type="text" name="admit_e" id="admit_e" />
        <script type="text/javascript" src="../datepick/js/jquery-1.3.2.min.js"></script>
  		<script type="text/javascript" src="../datepick/js/jquery-ui-1.7.2.custom.min.js"></script>
<?php
    	include("../datepick/datepick.php");
		echo "</td>";
		echo "<td align='center' class='listdetail' bgcolor='#D9D9FF'>";
		echo "<input type='submit' name='cmd_addan' value=' Add ' /><img src='../images/Plus-1-icon.png' border='0' />";
		echo "</td>";
		echo "</tr>";
		echo "<input type='hidden' name='txt_password' value='".$txt_password."'>";
		echo "<input type='hidden' name='txt_foruser' value='".$txt_foruser."'>";
		echo "<input type='hidden' name='txt_byuser' value='".$_SESSION["user_ipd"]."'>";
		echo "<input type='hidden' name='logno' value='".$_SESSION["logno"]."'>";
		echo "</table><br>";
		echo "</form>";
		//////////////////////// End Create new ///////////////////////////

}// end if chk cmd???
?>
<br>
	</td><!--end of detail body -->
</tr>
</table>
	<!-- central main -->  

    <img src="../images/span.gif" height="20" />
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
<script type="text/javascript">
function make_autocom2(autoObj,showObj){
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
		return "../autocom/get_tb_ipd_an.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom2("s_txt_an","h_txt_an");
</script>
<script type="text/javascript">
function make_autocom3(autoObj,showObj){
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
		return "../autocom/get_tb_ipd_doc_setup_password.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom3("s_txt_addan","h_txt_addan");
</script>

<script type="text/javascript">
function make_autocom4(autoObj,showObj){
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
		return "../autocom/get_tb_ipd_an.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom4("s_txt_plusan","h_txt_plusan");
</script>
<script type="text/javascript">
function make_autocom6(autoObj,showObj){
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
		return "../autocom/get_tb_ipd_doc_pass_foruser.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom6("s_txt_addanbyuser","h_txt_addanbyuser");
</script>

</body>
</html>

<?php
}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>