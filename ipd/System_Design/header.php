<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr valign="bottom"  bgcolor="#99CCFF">
    <td><img src="<?=$imgpath_top;?>"></td>
  </tr>
  <tr>
  	<td background="../images/design_webIPD/web-IPDS01_02.jpg" align="center">
    
    	<table width="90%" border="0" cellspacing="0" cellpadding="0">
  		<tr bgcolor="#333333">
    		<td>
    
    
	<!-- Menu---->
<?php
if ($_SESSION["user_ipd"]!=""){
	
	$userG =  $_SESSION["Usergroup_ipd"];
	include("../System_config/connection.php");

	$SQLgroup = "select * from tb_ipd_usergroup_detail  where groupID='$userG'"	;
	$RESgroup = mysql_db_query($database,$SQLgroup);
	$VALgroup = mysql_fetch_array($RESgroup);
			$Mdoc =  $VALgroup['manage_doc'];
			$Muser =  $VALgroup['manage_user'];
			$Mlog =  $VALgroup['view_log'];
			$Mdocpass=  $VALgroup['set_docpass'];
			$Mdocsecret=  $VALgroup['set_docsecret'];
			$Mansummary=  $VALgroup['an_summary'];

	print "<ul id=\"css3menu\">";
	//if ($_SESSION['userdocpass']==""){
		print "		<li class=\"topfirst\"><a href=\"../page_content/frm_search.php\" style='cursor: hand'>สืบค้น</a></li>";
		print "		<li><a href=\"../page_content/changepass.php\" style='cursor: hand'>รหัสผ่าน</a></li>";
	//}
	#print $_SESSION["UserType_ipd"];
	
	if($Mdoc==1){
		print "		<li><a href=\"#\"><span>จัดการเอกสาร</span></a>";
		print "			<ul>";
		print "				<li><a href=\"../page_content/show_document.php\" style='cursor: hand'>เพิ่มประเภทเอกสาร</a></li>";
		print "			</ul>";
		print "		</li>";
	}
	if($Mdocpass==1){
		print "		<li><a href=\"../log/frm_list_docpass.php\" style='cursor: hand'>ระบบยืม</a></li>";
	}
	if($Muser==1){
		print "		<li><a href=\"#\"><span>จัดการผู้ใช้งาน</span></a>";
		print "			<ul>";
		print "				<li><a href=\"../page_content/show_usergroup.php\" style='cursor: hand'>กลุ่มผู้ใช้</a></li>";
		print "				<li><a href=\"../page_content/show_user.php\" style='cursor: hand'>เพิ่มผู้ใช้</a></li>";
		print "			</ul>";
		print "		</li>";
	}
		print "		<li><a href=\"#\"><span>รายงาน</span></a>";
		print "			<ul>";
	if($Mlog==1){
		print "				<li><a href=\"../log/logfilereport.php\" style='cursor: hand'>การใช้งานทั้งหมด</a></li>";
		print "				<li><a href=\"../log/logfilereport2.php\" style='cursor: hand'>การใช้งานตามเงื่อนไข</a></li>";
		print "				<li><a href=\"../log/logfilemanager.php\" style='cursor: hand'>Log Manager</a></li>";
	}
	$Mansummary=1;
	if($Mansummary==1){
		print "				<li><a href=\"../an/anreport.php\" style='cursor: hand'>เอกสารที่สแกน</a></li>";
		print "				<li><a href=\"../an/anscancheck.php\" style='cursor: hand'>เอกสารที่สแกนไม่ครบ</a></li>";
	}
		print "			</ul>";
		print "		</li>";
	if($Mdocsecret==1){
		print "		<li><a href=\"../log/frm_list_secret.php\" style='cursor: hand'>จัดการเอกสารลับ</a></li>";
	}

	$userG  = $_SESSION["user_ipd"];
	print "		<li class=\"toplast\"><a href=\"../logout.php\" style='cursor: hand'>ออกจากระบบ  [ $userG ]</a> </li>";
	print "	</ul>";
}
?>
    <!----------->
    		</td>
  		</tr>
		</table>

    </td>
  </tr>
 </table>  
