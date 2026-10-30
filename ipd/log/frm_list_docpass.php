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
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

	<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../datepick/css/smoothness/jquery-ui-1.7.2.custom.css">
	<link rel="stylesheet" href="../css/autocomplete.css"  type="text/css"/>
	<script type="text/javascript" src="../autocom/autocomplete.js"></script>

<title>:: IPD - List Doc Password ::</title>
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
  <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  
  <tr>
    <td background="../images/design_webIPD/web-IPDS01_03.jpg">

<form name="searchan" method="post" action="frm_list_docpass.php">
	<table align="center" width="701" border="0" cellspacing="2" cellpadding="0">
	  <tr>
		<td class="head-topic" align=right width=250><BR>:: ดูประวัติการใช้งานตาม AN ::</td>
		<td><BR><!--<input type="text" name="txt_an" size="25" maxlength="20"/>-->
				<input type="text" name="txt_an" id="s_txt_an" />
				<input name="h_txt_an" type="hidden" id="h_txt_an" value="" />
	&nbsp;<input type="submit" name="cmd_show" value=" OK " />
		</td>
	  </tr>
	</form>
	<form name="searchforuser" method="post" action="frm_list_docpass.php">
	  <tr>
		<td class="head-topic" align=right><BR>:: ดูประวัติการใช้งานตามผู้ใช้งาน ::</td>
	<td><BR><!--<input type="text" name="txt_foruser" size="25" maxlength="30"/>-->
				<input type="text" name="txt_foruser" id="s_txt_foruser" />
				<input name="h_txt_foruser" type="hidden" id="h_txt_foruser" value="" />
	&nbsp;<input type="submit" name="cmd_show" value=" OK " /></td>
	  </tr>
</form>
<form name="searchforuser" method="post" action="frm_list_docpass.php">
  <tr>
    <td class="head-topic" align=right><BR>:: ดูประวัติการใช้งานตาม วันที่ :: <BR><span class='red'>(DD/MM/YYYY)</span></td>
<td><BR><!--<input type="text" name="txt_byupdate" size="25" maxlength="30"/>-->
				<input type="text" name="txt_byupdate" id="s_txt_byupdate" />
				<input name="h_txt_byupdate" type="hidden" id="h_txt_byupdate" value="" />
&nbsp;<input type="submit" name="cmd_showbydate" value=" OK " /></td>
  </tr>
</form>
<form name="add" method="post" action="frm_set_docpass.php">
  <tr>
    <td class="head-topic" align=right width=250><BR>:: กำหนดรหัสผ่านการยืมใช้งาน AN :: </td>
	<td><BR><!-- <input type="text" name="txt_an" size="25" maxlength="20"/>-->
				<input type="text" name="txt_an" id="s_txt_an2" />
				<input name="h_txt_an" type="hidden" id="h_txt_an2" value="" />
&nbsp;<input type="submit" name="cmd_create" value=" Create " /></td>
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
  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
	
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->
<?
	include("../System_config/func.php");
if ($_REQUEST['txt_an']<>''){
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
		////////// List used AN ///////////////////
		$pagesize=20;
		$sql ="select * from tb_ipd_doc_setup where an='".$_REQUEST['txt_an']."'";
		if ($_REQUEST['txt_password']<>""){$sql .=" and password='".$_REQUEST['txt_password']."'";}
		if ($_REQUEST['txt_foruser']<>""){$sql .=" and foruser='".$_REQUEST['txt_foruser']."'";}
		$ans=mysql_query($sql);
		$total=mysql_num_rows($ans);
		$totalpage=ceil($total/$pagesize);
		if (isset($_GET['pageid'])){
			$start=$pagesize*($_GET['pageid']-1);
			$id=$pagesize*($_GET['pageid']-1)+1;//items no.
		}else{
			$start=0;$pageid=1;$id=1;
		}
		//echo "sql: $sql";
		//echo "totalpage: $totalpage<br>";
		//echo "start: $start<br>";
		//echo "pageid: $pageid<br>";
		//echo "id: $id<br>";
		$comm =$sql;
		$comm .=" order by startdate desc LIMIT $start,$pagesize";
		//echo $comm;
		$result=mysql_query($comm);
		if (mysql_num_rows($result)>0) {
		echo "<div class='blackb' align='center'>มีข้อมูลรายการกำหนดสิทธิใช้งาน ".$total." รายการ";
		echo "</div><br>";
		echo "<table class='rowh' align='center' width='90%' cellspacing='1' cellpadding='1' border='0'>";
		echo "<tr bgcolor='#a9a9a9'>";
		echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
		echo "<td align='center' class='hdtable' width='10%'>AN</td>";
		echo "<td align='center' class='hdtable' width='10%'>Password</td>";
		echo "<td align='center' class='hdtable' width='20%'>ผู้ใช้งาน</td>";
		echo "<td align='center' class='hdtable' width='20%'>วดป.เริ่มการใช้งาน</td>";
		echo "<td align='center' class='hdtable' width='20%'>วดป.สิ้นสุดการใช้งาน</td>";
		echo  "<td width='5%' align='center' class='hdtable'>แก้ไข</td>";
		echo "</tr>";
		while($line = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>".$id."</td>";
			echo "<td align='center' class='listdetail'>".$line['an']."</td>";
			echo "<td align='center' class='listdetail'>";
			echo "<a href=frm_set_docpass.php?cmd_addan=1&txt_addan=".$line['password'].">";
			echo $line['password'];
			echo "</a></td>";
			echo "<td align='center' class='listdetail'>".$line['foruser']."</td>";
			echo "<td align='center' class='listdetail'>".getFormatdate($line['startdate'],1)."</td>";
			echo "<td align='center' class='listdetail'>".getFormatdate($line['expired'],1)."</td>";
			//echo "<td align='center' class='listdetail'>".$line['byuser']."</td>";
			//echo "<td align='center' class='listdetail'>".$line['byupdate']."</td>";
 			echo "<td align='center' class='listdetail'>";
			echo "<a href='frm_edit_docpass.php?an=".$line['an']."&psw=".$line['password']."'><img src='../images/icon_n_edit.gif' border='0' /></a>";
			echo "</td>";
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table>";
		//header table pages row 
		if ($totalpage>1){
			echo "<table align='center' width='90%'><tr><td>";
			// write link each no.page
			for ($i = 1; $i <= $totalpage; $i++){
				if ($i==$pageid){//this is a current page
					echo "<b>$i</b>&nbsp;";
				}else{
					echo "[<a href='?start=".$start."&pageid=".$i."&txt_an=".$_REQUEST['txt_an']."'>$i</a>]&nbsp;";
				}//end if
			}//end for
		echo "</td></tr></table>";
		}// end if list pages
		}//end chk result $comm
		///////////////////////// End List used AN 
	
	}else{//no record found
		echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล AN : ".$_REQUEST['txt_an']."========</div>";
	}// end of if chk $result
}elseif ($_REQUEST['txt_foruser']<>''){
		//////////////////////////////////////////////////////////////
		////////// List used foruser ///////////////////
		$pagesize=20;
		$sql ="select * from tb_ipd_doc_setup where foruser like '%".$_REQUEST['txt_foruser']."%'";
		if ($_REQUEST['txt_password']<>""){$sql .=" and password='".$_REQUEST['txt_password']."'";}
		$ans=mysql_query($sql);
		$total=mysql_num_rows($ans);
		$totalpage=ceil($total/$pagesize);
		if (isset($_GET['pageid'])){
			$start=$pagesize*($_GET['pageid']-1);
			$id=$pagesize*($_GET['pageid']-1)+1;//items no.
		}else{
			$start=0;$pageid=1;$id=1;
		}
		//echo "sql: $sql";
		//echo "totalpage: $totalpage<br>";
		//echo "start: $start<br>";
		//echo "pageid: $pageid<br>";
		//echo "id: $id<br>";
		$comm =$sql;
		$comm .=" order by startdate desc LIMIT $start,$pagesize";
		//echo $comm;
		$result=mysql_query($comm);
		if (mysql_num_rows($result)>0) {
		echo "<div class='blackb' align='center'>มีข้อมูลรายการกำหนดสิทธิใช้งาน  แก่".$_REQUEST['txt_foruser']." จำนวน ".$total." รายการ";
		echo "</div><br>";
		echo "<table class='rowh' align='center' width='90%' cellspacing='1' cellpadding='1' border='0'>";
		echo "<tr bgcolor='#a9a9a9'>";
		echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
		echo "<td align='center' class='hdtable' width='10%'>an</td>";
		echo "<td align='center' class='hdtable' width='10%'>Password</td>";
		echo "<td align='center' class='hdtable' width='20%'>ผู้ใช้งาน</td>";
		echo "<td align='center' class='hdtable' width='20%'>วดป.เริ่มการใช้งาน</td>";
		echo "<td align='center' class='hdtable' width='20%'>วดป.สิ้นสุดการใช้งาน</td>";
		echo  "<td width='5%' align='center' class='hdtable'>แก้ไข</td>";
		echo "</tr>";
		while($line = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>".$id."</td>";
			echo "<td align='center' class='listdetail'>".$line['an']."</td>";
			echo "<td align='center' class='listdetail'>".$line['password']."</td>";
			echo "<td align='center' class='listdetail'>".$line['foruser']."</td>";
			echo "<td align='center' class='listdetail'>".getFormatdate($line['startdate'],1)."</td>";
			echo "<td align='center' class='listdetail'>".getFormatdate($line['expired'],1)."</td>";
			//echo "<td align='center' class='listdetail'>".$line['byuser']."</td>";
			//echo "<td align='center' class='listdetail'>".$line['byupdate']."</td>";
 			echo "<td align='center' class='listdetail'>";
			echo "<a href='frm_edit_docpass.php?an=".$line['an']."&psw=".$line['password']."'><img src='../images/icon_n_edit.gif' border='0' /></a>";
			echo "</td>";
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table>";
		//header table pages row 
		if ($totalpage>1){
			echo "<table align='center' width='90%'><tr><td>";
			// write link each no.page
			for ($i = 1; $i <= $totalpage; $i++){
				if ($i==$pageid){//this is a current page
					echo "<b>$i</b>&nbsp;";
				}else{
					echo "[<a href='?start=".$start."&pageid=".$i."&txt_an=".$_REQUEST['txt_an']."&txt_foruser".$_REQUEST['txt_foruser']."'>$i</a>]&nbsp;";
				}//end if
			}//end for
		echo "</td></tr></table>";
		}// end if list pages
		}else{//no record found
			echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล ผู้ใช้งานเอกสาร ".$_REQUEST['txt_foruser']."  ========</div>";
		}// end of if chk $result
		///////////////////////// End List foruser
	
	
}elseif ($_REQUEST['txt_byupdate']<>''){
		//////////////////////////////////////////////////////////////
		////////// List used byupdate ///////////////////
		$byupdate=substr($_REQUEST['txt_byupdate'],6,4)-543;
		$byupdate .="-".substr($_REQUEST['txt_byupdate'],3,2)."-".substr($_REQUEST['txt_byupdate'],0,2);
		$pagesize=20;
		$sql ="select * from tb_ipd_doc_setup where byupdate like '%".$byupdate."%'";
		$ans=mysql_query($sql);
		$total=mysql_num_rows($ans);
		$totalpage=ceil($total/$pagesize);
		if (isset($_GET['pageid'])){
			$start=$pagesize*($_GET['pageid']-1);
			$id=$pagesize*($_GET['pageid']-1)+1;//items no.
		}else{
			$start=0;$pageid=1;$id=1;
		}
		//echo "sql: $sql";
		//echo "totalpage: $totalpage<br>";
		//echo "start: $start<br>";
		//echo "pageid: $pageid<br>";
		//echo "id: $id<br>";
		$comm =$sql;
		$comm .=" order by startdate desc LIMIT $start,$pagesize";
		//echo $comm;
		$result=mysql_query($comm);
		if (mysql_num_rows($result)>0) {
		echo "<div class='blackb' align='center'>มีข้อมูลรายการกำหนดสิทธิใช้งาน วันที่ ".substr($_REQUEST['txt_byupdate'],0,10)." จำนวน ".$total." รายการ";
		echo "</div><br>";
		echo "<table class='rowh' align='center' width='90%' cellspacing='1' cellpadding='1' border='0'>";
		echo "<tr bgcolor='#a9a9a9'>";
		echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
		echo "<td align='center' class='hdtable' width='10%'>an</td>";
		echo "<td align='center' class='hdtable' width='10%'>Password</td>";
		echo "<td align='center' class='hdtable' width='20%'>ผู้ใช้งาน</td>";
		echo "<td align='center' class='hdtable' width='20%'>วดป.เริ่มการใช้งาน</td>";
		echo "<td align='center' class='hdtable' width='20%'>วดป.สิ้นสุดการใช้งาน</td>";
		echo  "<td width='5%' align='center' class='hdtable'>แก้ไข</td>";
		echo "</tr>";
		while($line = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>".$id."</td>";
			echo "<td align='center' class='listdetail'>".$line['an']."</td>";
			echo "<td align='center' class='listdetail'>".$line['password']."</td>";
			echo "<td align='center' class='listdetail'>".$line['foruser']."</td>";
			echo "<td align='center' class='listdetail'>".getFormatdate($line['startdate'],1)."</td>";
			echo "<td align='center' class='listdetail'>".getFormatdate($line['expired'],1)."</td>";
			//echo "<td align='center' class='listdetail'>".$line['byuser']."</td>";
			//echo "<td align='center' class='listdetail'>".$line['byupdate']."</td>";
 			echo "<td align='center' class='listdetail'>";
			echo "<a href='frm_edit_docpass.php?an=".$line['an']."&psw=".$line['password']."'><img src='../images/icon_n_edit.gif' border='0' /></a>";
			echo "</td>";
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table>";
		//header table pages row 
		if ($totalpage>1){
			echo "<table align='center' width='90%'><tr><td>";
			// write link each no.page
			for ($i = 1; $i <= $totalpage; $i++){
				if ($i==$pageid){//this is a current page
					echo "<b>$i</b>&nbsp;";
				}else{
					echo "[<a href='?start=".$start."&pageid=".$i."&txt_byupdate=".$_REQUEST['txt_byupdate']."'>$i</a>]&nbsp;";
				}//end if
			}//end for
		echo "</td></tr></table>";
		}// end if list pages
		}else{//no record found
			echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div>";
		}// end of if chk $result
		///////////////////////// End List byupdate
}// end if chk txt_an
?><BR>
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
		return "../autocom/get_tb_ipd_doc_setup_an.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom("s_txt_an","h_txt_an");
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
make_autocom2("s_txt_an2","h_txt_an2");
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
		return "../autocom/get_tb_ipd_doc_setup_foruser.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom3("s_txt_foruser","h_txt_foruser");
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
		return "../autocom/get_tb_ipd_doc_setup_byupdate.php?q=" +encodeURIComponent(this.value);
    });	
}	
 
// การใช้งาน
// make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");
make_autocom4("s_txt_byupdate","h_txt_byupdate");
</script>
<script type="text/javascript">
function make_autocom5(autoObj,showObj){
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
make_autocom5("s_txt_addan","h_txt_addan");
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
