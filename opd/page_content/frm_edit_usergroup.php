<?php
	session_start();
	
	$imgpath_top = "../images/design_webOPD/web-OPDS01_01.jpg";
	$imgpath_botton = "../images/design_webOPD/web-OPDS01_04.jpg";

	
	include ("../System_config/connection.php");

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
	
	$gid = $_GET["gid"];

	$SQLuserid1 = "select * from  tb_opd_doctype order by doctype_id desc";
	$RESuserid1 = mysql_db_query($database,$SQLuserid1);
	$ii =0;
	while ($VALuserid1 = mysql_fetch_array($RESuserid1)){
		$countid = $VALuserid1["doctype_id"];
		$ii = $ii+1;
		if ($ii==2) break;
	}

$SQLeditG = "select * from tb_opd_group where groupID = '$gid'";
$RESeditG = mysql_db_query($database,$SQLeditG);
$VALeditG = mysql_fetch_array($RESeditG)
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: OPD - EDIT Usergroup ::</title>

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


<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>
  
  <tr>
    <td background="../images/design_webOPD/web-OPDS01_03.jpg">
    
     <img src="../images/span.gif" height="20" />  
<table align="center" width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="900" align="right">
    	<a href="show_usergroup.php"><img src="../images/icon_wb4.gif" border="0" /></a><img src="../images/span.gif" width="10" />
    	<a href="frm_add_usergroup.php"><img src="../images/icon_wb2.gif" border="0" /></a><img src="../images/span.gif" width="10" />
    </td>
  </tr>
</table>

<table align="center" width="839" border="0" cellspacing="2" cellpadding="0"><!--//////////////// Step 1.  Add group name -->
<form name="addGroup" id="addGroup" action="FN_Update/fn_editgroupname.php?gid=<?=$gid?>" method="post"> <!-- form 1 -->
  <tr>
    
  </tr>
  <tr>
    <td align="right" class="topic">Group Name :</td>
    <td width="180" ><input name="txtGname" type="text" value="<?=$VALeditG["groupname"]?>" size="30" /></td>
    <td width="327"><input type="submit" value="..ADD Group.." /></td>
  </tr>
</form> <!-- form 1 -->
  <tr>
    <td colspan="3"><img src="../images/span.gif" /></td>
  </tr>
</table>

<!-- ตารางเลือก DocType -->

<?php
#if($showTable != "0" and $showTable != ""  ){
	$SQLdoctype = "select * from  tb_opd_doctype order by doctype_id asc";
	$RESdoctype = mysql_db_query($database,$SQLdoctype);
	$NUMeodtype = mysql_num_rows($RESdoctype);
?>



<form name="update_G_detail" id="update_G_detail" action="FN_Insert/fn_add_detail_group.php?gid=<?=$gid?>" method="post" 
onSubmit="JavaScript:return fncSubmit();"> 
 <!-- form 2 -->
<table align="center" width="900" border="0" cellspacing="0" cellpadding="0">

<?php
$SQLeditGdetail = "select * from tb_opd_group_detail where groupID = '$gid'";
$RESeditGdetail = mysql_db_query($database,$SQLeditGdetail);
$VALeditGdetail = mysql_fetch_array($RESeditGdetail);


///////////////////  permission menu
if($VALeditGdetail['manage_doc'] ==1 )		{  $checkdoc = "checked=\"checked\"/";}
if($VALeditGdetail['manage_user'] ==1 )		{  $checkuser = "checked=\"checked\"/";}
if($VALeditGdetail['del_list'] ==1 )		{  $checkdel = "checked=\"checked\"/";}
if($VALeditGdetail['doc999'] ==3 )		{  $readXfile= "checked=\"checked\"/";}


?>
  <tr>
  	<td colspan="4" align="center" bgcolor="#CCCCCC"> 
    <span class="style5">สิทธิ์การเข้าถึงเมนูระบบ</span><br />
	<input type="checkbox" name="manage_doc" value="1" id="manage_doc" <?=$checkdoc?> /><label>จัดการเอกสาร</label>
    <input type="checkbox" name="manage_user" value="1" id="manage_user" <?=$checkuser?>/><label>จัดการผู้ใช้งานระบบ</label>
    <input type="checkbox" name="del_list" value="1" id="del_list" <?=$checkdel?>/><label>ลบข้อมูล</label>
	<input type="checkbox" name="readXfile" value="3" id="readXfile" <?=$readXfile?>/><label>อ่านเอกสารความลับ</label>
    </td>
  </tr>
  <tr>
  	<td colspan="2"><img src="../images/span.gif" height="10" /></td>
    </tr>
  <tr>
  	<td width="589" align="left">&nbsp;&nbsp;&nbsp;กำหนดสิทธิ์การเข้าถึงประเภทเอกสาร</td>
    <td width="211" colspan="3"><span class="style3">จำนวนประเภทเอกสาร <strong>
      <?=$NUMeodtype-1?> 
      </strong>รายการ</span></td>
  </tr>
</table>


<table align="center" width="875" border="1" cellspacing="0" cellpadding="0">
  <tr class="head-tb">
    <td width="618" height="37" align="center">ประเภทเอกสาร</td>
    <td width="135" align="center">อ่าน</td>
    <td width="115" align="center">พิมพ์</td>
    <!--td width="92" align="center">เลือกทั้งหมด</td-->
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="center"><label>
      &nbsp;&nbsp;
      <input type="checkbox" name="checkbox" value="checkbox" id ="CheckAllR" onClick="
	 var ij;
	 if(document.getElementById('CheckAllR').checked){
		for(ij=0;ij<=<?=$countid?>;ij++){
			if (('chkRead'+ij) != null){
				document.getElementById('chkRead'+ij).checked = true;}
		}
		}
	else{
		for(ij=0;ij<=<?=$countid?>;ij++){
		if (('chkPrint'+ij) != null){
		document.getElementById('chkRead'+ij).checked = false;
		document.getElementById('chkPrint'+ij).checked = false;
		document.getElementById('CheckAllP').checked = false;
		}
		}
	}
	"/>
      <span class="topitem style2">      All </span></label></td>
    <td align="center"><label>
      &nbsp;&nbsp;
      <input type="checkbox" name="checkbox2" value="checkbox" id ="CheckAllP" onClick="
	 var ij;
	 if(document.getElementById('CheckAllP').checked){
		for(ij=0;ij<=<?=$countid?>;ij++){
			if (('chkPrint'+ij) != null){
			document.getElementById('chkPrint'+ij).checked = true;
			document.getElementById('chkRead'+ij).checked = true;
			document.getElementById('CheckAllR').checked = true;
			}
		}
	}
	else{
		for(ij=0;ij<=<?=$countid?>;ij++){
		if (('chkPrint'+ij) != null){
			document.getElementById('chkPrint'+ij).checked = false;}
		}
	}
	"/>
      <span class="topitem style2">All</span></label></td>
    
  </tr>
<?php
$i=0;
$j=0;
	while($VALdoctype = mysql_fetch_array($RESdoctype)){ //////////////////////// while 1
		$docid 			= $VALdoctype["doctype_id"];
		$doctypename	= $VALdoctype["DocTypeName"];
		$docm = "doc".$docid;
	//==============REturn Check Value ================================
	$SQLeditGdetail2 = "select  $docm from tb_opd_group_detail where groupID = '$gid'";
	$RESeditGdetail2 = mysql_db_query($database,$SQLeditGdetail2);
	$VALeditGdetail2 = mysql_fetch_array($RESeditGdetail2);	
	if ($VALeditGdetail2[$docm]=="") { $docm=0;}
	if($VALeditGdetail2[$docm] ==1 )		{
			$checkdocR = "checked=\"checked\"/";
			$checkdocP = "";}
	if($VALeditGdetail2[$docm] ==2 )		{  
			$checkdocR = "checked=\"checked\"/";
			$checkdocP = "checked=\"checked\"/";}	
	if($VALeditGdetail2[$docm] ==3 )		{  
								$checkdocR = "checked=\"checked\"/";
								$checkdocP = "checked=\"checked\"/";;}	
	if($VALeditGdetail2[$docm] ==0 )		{  
								$checkdocR = "";
								$checkdocP = "";}						
?>

  <?
  		if ($docid!=999){?>
  <tr>
    	<td align="left"><?=$doctypename?></td>
    	<td align="center"><input type="checkbox" name="chkPermission<?=$i?>[]"  value="1" id="chkRead<?=$i?>" <?=$checkdocR?>  onclick="
        " /></td>
        
    	<td align="center"><input type="checkbox" name="chkPermission<?=$i?>[]"  value="2" id="chkPrint<?=$i?>"  <?=$checkdocP?> onclick="
        if(document.getElementById('chkPrint<?=$i?>').checked){
			document.getElementById('chkRead<?=$i?>').checked = true;
        }
        "  /></td>
  </tr>
<?php
	}//endif check doc
			$i = $i+1;
	}	//////////////////////// while 1
?>
</table>

<table align="center" width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="right"><input type="submit" value="SAVE..." /></td>
  </tr>
</table>
</form> <!-- form 2 -->


    
        <img src="../images/span.gif" height="20" />  	<?php //print "22 = ".$chkR;?>
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