<?php

	session_start();

	#print $_SESSION["Usergroup_ipd"];

	$imgpath_top = "../images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../images/design_webIPD/web-IPDS01_04.jpg";


	include ("../System_config/connection.php");
	
  /////  check session_id ของหน้า
	if($_SESSION["PID"] == session_id()) {

	$showTable = $_GET['showTable'];

$usertype = $_SESSION["Usergroup_ipd"];

$un = $usertype;

		$SQLgroup = "select * from tb_ipd_usergroup_detail  where groupID='$un'"	;
		$RESgroup = mysql_db_query($database,$SQLgroup);
		$VALgroup = mysql_fetch_array($RESgroup);
			$del =  $VALgroup['del_list'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

	<link rel="stylesheet" href="../css/menu/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../datepick/css/smoothness/jquery-ui-1.7.2.custom.css">

<title>:: IPD - SEARCH ::</title>
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
    properties +=",scrollbars=yes,toolbar=no,menubar=no,statusbar=no,location=no"
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
 

<form name="search" method="post" action="?showTable=1">
<table align="center" width="701" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td colspan="4" class="head-topic">:: ค้นหา ::</td>
  </tr>
  <tr>
    <td width="158" align="right" bgcolor="#CCCCCC" class="topic">HN :</td>
    <td width="187"><input type="text" name="txtSearchHN" value="<?=$_POST['txtSearchHN'];?>" /></td>
    <td width="144" align="right" bgcolor="#CCCCCC" class="topic">AN :</td>
    <td width="202"><input type="text" name="txtSearchAN" value="<?=$_POST['txtSearchAN'];?>" /></td>
  </tr>
  <tr>
    <td width="158" align="right" bgcolor="#CCCCCC" class="topic">ชื่อ :</td>
    <td><input type="text" name="txtFname" value="<?=$_POST['txtFname'];?>" /></td>
    <td width="144" align="right" bgcolor="#CCCCCC" class="topic">นามสกุล :</td>
    <td><input type="text" name="txtLname" value="<?=$_POST['txtLname'];?>" /></td>
  </tr>
  <tr>
    <td width="158" align="right" bgcolor="#CCCCCC" class="topic">Admit Date :</td>
    <td colspan="3">
    	<input type="text" name="admit_s" id="admit_s" />
        
        <img src="../images/span.gif" width="10" />   
        <strong>To.</strong>
        <img src="../images/span.gif" width="10" />   
        
        <input type="text" name="admit_e" id="admit_e" />
        <script type="text/javascript" src="../datepick/js/jquery-1.3.2.min.js"></script>
  	<script type="text/javascript" src="../datepick/js/jquery-ui-1.7.2.custom.min.js"></script>
	<?php
    	include("../datepick/datepick.php");
	?>

    </td>
  </tr>
  <tr>
    <td width="158" align="right" bgcolor="#CCCCCC" class="topic">Dis Date :</td>
    <td colspan="3">
    	<input type="text" name="dis_s" id="dis_s" />
        
        <img src="../images/span.gif" width="10" />   
       	<strong> To.</strong>
        <img src="../images/span.gif" width="10" />     
        
    	<input type="text" name="dis_e" id="dis_e" />
    </td>
  </tr>
  <tr>
    <td colspan="4" align="center">
    	<input type="submit" name="cmd_search" value="Search" />
        <input type="reset" name="cmd_reset_frm" value="Reset" />
    </td>
  </tr>
</table>
</form>

<?php
/////  SEARCH ////////////
$chkw			=	"1";
$chkd			=	"1";
$chkdd			=	"0";
$txtSearchHN	=	$_POST["txtSearchHN"];
$txtSearchAN	=	$_POST["txtSearchAN"];
$txtFname		=	$_POST["txtFname"];
$txtLname		=	$_POST["txtLname"];
$admit_s		=	$_POST["admit_s"];
$admit_e		=	$_POST["admit_e"];
$dis_s			=	$_POST["dis_s"];
$dis_e			=	$_POST["dis_e"];

///////////  default
if ((empty($txtSearchHN) or empty($txtSearchAN))){
		$sql_show = "	select tb_ipd.an,tb_ipd.hn,tb_ipd.firstname,tb_ipd.lastname,tb_ipd.indate,tb_ipd.outdate 
						from tb_ipd,tb_ipd_doctype_detail  
						where (tb_ipd.an = tb_ipd_doctype_detail.an) ";
	if  ((trim($admit_s)!= "") or 
		(trim($admit_e)!= "")or 
		(trim($dis_s)!= "") or	
	    (trim($dis_e)!= "")){
	
		$sql_show = "	select tb_ipd.an,tb_ipd.hn,tb_ipd.firstname,tb_ipd.lastname,tb_ipd.indate,tb_ipd.outdate 
						from tb_ipd,tb_ipd_doctype_detail";
	$chkdd = 1;
	$chkw = 0;
	}
}
		
///////////  ? AN
if (trim($txtSearchAN)!= "") {
  		$sql_show = " 	select tb_ipd.an,tb_ipd.hn,tb_ipd.firstname,tb_ipd.lastname,tb_ipd.indate,tb_ipd.outdate 
						from tb_ipd,tb_ipd_doctype_detail  
						where (tb_ipd.an = tb_ipd_doctype_detail.an)  
						and (tb_ipd.an = '$txtSearchAN' )";
		$chkw = 0;
		$chkd = 0;
}
///////////// ? HN
if (trim($txtSearchHN)!= ""){
  		if ($chkw ==0) {	
			$sql_show = $sql_show."  and (hn = '$txtSearchHN')" ;	
		}
		else {	
			$sql_show =	"	select tb_ipd.an,tb_ipd.hn,tb_ipd.firstname,tb_ipd.lastname,tb_ipd.indate,tb_ipd.outdate 
							from tb_ipd,tb_ipd_doctype_detail  
							where (tb_ipd.an = tb_ipd_doctype_detail.an) 
							and (tb_ipd.hn = '$txtSearchHN' )";
			$chkw = 0;
			$chkd = 0;
		}
}


////////////////// ?  
if (trim( $txtFname)!= ""){
  		if ($chkw ==0) {
			if ($chkdd==1){
				$sql_show = $sql_show." where (firstname like '$txtFname%' )";
			}
			else{
			$sql_show = $sql_show." and (firstname like '$txtFname%' )";
			}
		}
		else {
			$sql_show =	"	select tb_ipd.an,tb_ipd.hn,tb_ipd.firstname,tb_ipd.lastname,tb_ipd.indate,tb_ipd.outdate 
							from tb_ipd,tb_ipd_doctype_detail  
							where (firstname like '$txtFname%' )";
			$chkw = 0;
			$chkd = 0;
		}
  }
////////////////// ? ?
if (trim( $txtLname)!= ""){
			#print $txtLname."<br>";
		if ($chkw ==0) {
			if ($chkdd==1){
				$sql_show = $sql_show." where (lastname like '$txtLname%' )";
			}
			else{
				$sql_show = $sql_show." and (lastname like '$txtLname%' )";
			}
		}
		else {

			$sql_show =	"	select tb_ipd.an,tb_ipd.hn,tb_ipd.firstname,tb_ipd.lastname,tb_ipd.indate,tb_ipd.outdate 
							from tb_ipd,tb_ipd_doctype_detail 
							where (lastname like '$txtLname%' )";
			$chkw = 0;
			$chkd = 0;
				}
  
}	  
/////////////  searchadmit
if ((trim($admit_s)!= "") and (trim($admit_e)!= "")){
	if ($chkw ==0) {
		if (($chkdd==1) or ($chkd = 0)){
			$sql_show = $sql_show." where tb_ipd.indate between('$admit_s') 
						 and ('$admit_e')";
						 
		}
		else{
			$sql_show = $sql_show." between tb_ipd.indate between('$admit_s') 
						 and ('$admit_e')";
		}
		$chkdate = "0";
	}
}
//////////////////////////
if ((trim($admit_s)!= "") and (trim($admit_e)== "")){
	if ($chkw ==0) {
		if (($chkdd==1) or ($chkd = 0)){
			$sql_show = $sql_show." where (tb_ipd.indate='$admit_s')"; 
		}
		else{
			$sql_show = $sql_show." and(tb_ipd.indate='$admit_s') ";
		}
		$chkdate = "0";
	}
}
//////////////////////////
if ((trim($admit_s)== "") and (trim($admit_e)!= "")){
	if ($chkw ==0) {
		if (($chkdd==1) or ($chkd = 0)){
			$sql_show = $sql_show." where (tb_ipd.indate='$admit_e')"; 
		}
		else{
			$sql_show = $sql_show." and(tb_ipd.indate='$admit_e') ";
		}
		$chkdate = "0";
	}
}
/////////////  searchdis date
if ((trim($admit_s)== "") and (trim($admit_e)== "")){
if ((trim($dis_s)!= "") and (trim($dis_e)!= "")){
	if ($chkw ==0) {
		if (($chkdd==1) or ($chkd = 0)){
			$sql_show = $sql_show." where tb_ipd.outdate between('$dis_s') 
						 and ('$dis_e')";
						 
		}
		else{
			$sql_show = $sql_show." between tb_ipd.outdate between('$dis_s') 
						 and ('$dis_e')";
		}
		$chkdate = "0";
	}
}
//////////////////////////
if ((trim($dis_s)!= "") and (trim($dis_e)== "")){
	if ($chkw ==0) {
		if (($chkdd==1) or ($chkd = 0)){
			$sql_show = $sql_show." where (tb_ipd.outdate='$dis_s')"; 
		}
		else{
			$sql_show = $sql_show." and(tb_ipd.outdate='$dis_s') ";
		}
		$chkdate = "0";
	}
}
//////////////////////////
if ((trim($dis_s)== "") and (trim($dis_e)!= "")){
	if ($chkw ==0) {
		if (($chkdd==1) or ($chkd = 0)){
			$sql_show = $sql_show." where (tb_ipd.outdate='$dis_e')"; 
		}
		else{
			$sql_show = $sql_show." and(tb_ipd.outdate='$dis_e') ";
		}
		$chkdate = "0";
	}
}
//////////////////////////
}//dis date
	$sql_show = $sql_show." group by tb_ipd.an order by tb_ipd.an,tb_ipd.datescan desc limit 0,100";
#print 	$sql_show;
#	print "sql_show = ".$sql_show."<br>";

 if(($showTable ==1) or ($showTable !="")){		///////////////////////// showTable
?>
    	<img src="../images/span.gif" height="20" />
        
<table align="center" width="88%" border="1" cellspacing="0" cellpadding="0">

  <tr class="head-tb">
    <td width="10%" height="37" align="center">AN</td>
    <td width="11%" align="center">HN</td>
    <td width="18%" align="center">ชื่อ</td>
    <td width="14%" align="center">นามสกุล</td>
    <td width="12%" align="center">รับการรักษา</td>
    <td width="12%" align="center">สิ้นสุดการรักษา</td>
    <!--<td width="8%" align="center">pages</td> -->
    <!--<td width="9%" align="center">datescan</td> -->
   	<!--<td width="8%" align="center">doctype</td> -->
    <td width="16%" align="center">imagescan</td>
  <?php 	
  		#print "<td width=7% >   ";
		if ($del==1){
    	print "<td width=\"9%\" ><div align=\"center\">ลบ</div></td>";}?>
  </tr>

<?php
///////////// while //////////////
	$RESsearch = mysql_db_query($database,$sql_show);
	while ($VALsearch=mysql_fetch_array($RESsearch)){
?>

  <tr>
    <td><?=$VALsearch['an'];?></td>
    <td><?=$VALsearch['hn'];?></td>
    <td><?=$VALsearch['firstname'];?></td>
    <td><?=$VALsearch['lastname'];?></td>
    <td><?=$VALsearch['indate'];?></td>
    <td><?=$VALsearch['outdate'];?></td>
    <!--<td><?$VALsearch['pages'];?></td> -->
    <!--<td><?$VALsearch['datescan'];?></td> -->
   	<!--<td><?$VALsearch['doctype'];?></td> -->
    <td align="center">
    <!--<a href="javascript:popup('show_detail.php?anID=<?$VALsearch['an'];?>&doctype=<?$VALsearch['doctype']?>','null',800,500);">รายละเอียด</a>  -->
     <a href="javascript:popup('show_detail.php?anID=<?=base64_encode($VALsearch['an']);?>&logno=<?=base64_encode($_SESSION['logno']);?>','null',950,500);"onMouseover="return hidestatus()" onMouseOut="return hidestatus()"><img src="../images/icon_showinfo.gif" border="0"/></a>
    </td>

	    <?php
		
		
		if ($del==1){
			print "<td><div align=\"center\"><a href=\"frm_del_userdetail.php?anID=".$VALsearch['an'];
	 		print "\"><img src=\"../images/icon_b_delete2.gif\" border=\"0\"/></a></div></td>";
		}
		?>

  </tr>
<?php
}
?>
</table> 
<?php  }  ///////////////////////  	showTable ?>
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