<?php
		//session_start();
?>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr valign="bottom" >
    <td><img src="<?php echo $imgpath_top; ?>"></td>
  </tr>
  <tr>
  	<td background="../images/design_webOPD/web-OPDS01_03.jpg" align="center">
    
    	<table width="900" border="0" cellspacing="0" cellpadding="0">
  		<tr bgcolor="#333333">
    		<td>

    
	<!-- Menu---->
<?php
#print $_SESSION["user"];
if (isset($_SESSION["user"]) && $_SESSION["user"]!="")  {			////////////////////////////////  user null
	$userG =  $_SESSION["Usergroup"];
	include("../System_config/connection.php");

	$SQLgroup = "select * from tb_opd_group_detail  where groupID='$userG'"	;
	$RESgroup = mysql_db_query($database,$SQLgroup);
	$VALgroup = mysql_fetch_array($RESgroup);
			$Mdoc =  $VALgroup['manage_doc'];
			$Muser =  $VALgroup['manage_user'];

	print "<ul id=\"css3menu\">";
	print "		<li class=\"topfirst\"><a href=\"../page_content/frm_search.php\">สืบค้น</a></li>";
	print "		<li><a href=\"../page_content/changepass.php\">เปลี่ยนรหัสผ่าน</a></li>";
	
	if($Mdoc==1){		///////////////////////////  มีสิทธ์ จัดการเมนู เอกสาร
		print "		<li><a href=\"#\"><span>จัดการเอกสาร</span></a>";
		print "			<ul>";
		print "				<li><a href=\"../page_content/show_document.php\">เพิ่มประเภทเอกสาร</a></li>";
		print "			</ul>";
		print "		</li>";
	}				///////////////////////////  มีสิทธ์ จัดการเมนู เอกสาร
	if($Muser==1){				///////////////////////////  มีสิทธ์ จัดการเมนู ผู้ใช้
		print "		<li><a href=\"#\"><span>จัดการผู้ใช้งาน</span></a>";
		print "			<ul>";
		print "				<li><a href=\"../page_content/show_usergroup.php\">กลุ่มผู้ใช้</a></li>";
		print "				<li><a href=\"../page_content/show_user.php\">เพิ่มผู้ใช้</a></li>";
		print "			</ul>";
		print "		</li>";
	}///////////////////////////  มีสิทธ์ จัดการเมนู ผู้ใช้	

		$userG  = $_SESSION["user"];

	print "		<li class=\"toplast\"><a href=\"../logout.php\">ออกจากระบบ  [ $userG ]</a> </li>";
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
