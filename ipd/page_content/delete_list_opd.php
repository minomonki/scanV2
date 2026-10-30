<?php
	session_start();
	
	$imgpath_top = "../images/design_webOPD/web-OPDS01_01.jpg";
	$imgpath_botton = "../images/design_webOPD/web-OPDS01_04.jpg";

  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {
		
	include ("../System_config/connection.php");
	
		$uid = $_GET["uid"];

	$SQLdelUser = "select * from opd  where hn='$uid' ";
	$RESdelUser = mysql_db_query($database,$SQLdelUser);
	$VALdelUser = mysql_fetch_array($RESdelUser);
#	print $SQLdelUser;
#	print $num = mysql_num_rows($RESdelUser);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
<title>:: OPD - DELETE  User Account ::</title>

<style type="text/css">
<!--
.head-tb	 {	font-family: "mS Sans Serif"; font-size:16; font-weight:bold; color:#FFF; background-image:url(../images/asset.gif)	}
.topic		{	font-family: "mS Sans Serif"; font-size:14; font-weight:bold;	}
.note		{	font-family: "mS Sans Serif"; font-size:14;  }
.memo		{	font-family: "mS Sans Serif"; font-size:12; color:#00F;  }
-->
</style>

</head>

<body>

<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr><td width="999"><?php include ("../System_Design/header.php"); ?></td></tr>

  <tr>
<td align="center" background="../images/design_webOPD/web-OPDS01_03.jpg">
    	<img src="../images/span.gif" height="20" />
        
       <!-- <form name="DelDoc" id="DelDoc" action="FN_Delete/fn_deluser.php?userid=<?$uid?>" method="post"> -->
    	<table width="610" border="0" cellspacing="0" cellpadding="0">
  			<tr class="head-tb">
            		<td width="610" height="38" align="left"> 	ลบรายการข้อมูล ของ HN : <?=$uid?> [<?=$VALdelUser['firstname']?>  <?=$VALdelUser['lastname']?> ]         </td>
            </tr>
  			<tr bgcolor="#FFFFFF">
    			<td align="center">
<!------------------------------------------------------------------- -->
<table width="500" border="1" cellspacing="0" cellpadding="0">
  							<tr bgcolor="#FFFFCC" align="center" >
    								<td>VN</td>
    								<!--<td>dater </td> -->
    								<td>ประเภทเอกสาร</td>
    								<td>ลบ</td>
  							</tr>
                <?php
							$SQLdelUser = "select * from opd  where hn='$uid' ";
							$RESdelUser = mysql_db_query($database,$SQLdelUser);
						while ($VALdetail = mysql_fetch_array($RESdelUser)){		///////////////  while
								$docid = $VALdetail['doctype_id'];
								$SQLdocid = "select * from tb_opd_doctype  where doctype_id ='$docid'"	;
								$RESdocid = mysql_db_query($database,$SQLdocid);
								$VALdocid = mysql_fetch_array($RESdocid);
										$docname =  $VALdocid['DocType_name'];
				?>
  							<tr>
    								<td align="center"><?=$VALdetail['vn'];?></td>
    								<!--<td align="center"><?$VALdetail['dater'];?></td> -->
    								<td align="center"><?=$docname?></td>
    								<td align="center">
                                    			<a href="FN_Delete/fn_deluserdetail.php?hn=<?=$uid?>&vn=<?=$VALdetail['vn'];?>">
                                    				<img src="../images/icon_b_delete2.gif" width="25" height="25" border="0" />
                                             	</a>
                                   	</td>
  							</tr>
                         <? 
						 		} //////////////////////  while
						?>
                		</table>
<!------------------------------------------------------------------- -->
                </td>
		  </tr>
		</table>
     <!--   </form> -->
     	<br>
     		<a href="frm_search.php?showTable=1"><<< กลับหน้าสืบค้น >>></a>
        <br>
        <img src="../images/span.gif" height="20" /></td>
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