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

<table align="center" width="701" border="0" cellspacing="2" cellpadding="0">
<form name="searchan" method="post" action="frm_list_secret.php">
  <tr>
    <td class="head-topic" align=right width=350><BR>:: ดูสถานะความลับตาม AN ในระบบทั้งหมด ::</td>
	<td><BR>&nbsp;<input type="submit" name="cmd_showall" value=" OK " /></td>
  </tr>
</form>
<form name="searchan" method="post" action="frm_list_secret.php">
  <tr>
    <td class="head-topic" align=right width=350><BR>:: ดูสถานะความลับตาม AN ::</td>
<td><BR><input type="text" name="txt_an" size="25" maxlength="20"/>&nbsp;<input type="submit" name="cmd_show" value=" OK " /></td>
  </tr>
</form>
<form name="add" method="post" action="frm_set_secret.php">
<table align="center" width="701" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td class="head-topic" align=right width=350><BR>:: กำหนดสถานะความลับการใช้งาน AN ::</td>
<td><BR> <input type="text" name="txt_an" size="25" maxlength="20"/>&nbsp;<input type="submit" name="cmd_create" value=" Create " /></td>
  </tr>
  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>
</form>
	
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0" >
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->

<?
if ($_REQUEST['cmd_show']<>''){
	include("../System_config/connect.php");
	////////// Check Exist AN
	$query ="select * from tb_ipd where an='".$_REQUEST['txt_an']."'";
	//echo $query;
	$result = mysql_query($query);
	if (mysql_num_rows($result)>0) {
		$row = mysql_fetch_array($result);
		echo "<br><table class='rowh' align='center' width='90%' cellspacing='2' cellpadding='2' border='0'>";
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
		$comm ="select * from tb_ipd_doc_secret where an='".$_REQUEST['txt_an']."'";
		//echo $comm;
		$result=mysql_query($comm);
		if (mysql_num_rows($result)>0) {
		echo "<table class='rowh' align='center' width='90%' cellspacing='1' cellpadding='1' border='0'>";
		echo "<tr bgcolor='#a9a9a9'>";
		echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
		echo "<td align='center' class='hdtable' width='10%'>AN</td>";
		echo "<td align='center' class='hdtable' width='20%'>สถานะ</td>";
		echo  "<td width='5%' align='center' class='hdtable'>กำหนดโดย</td>";
		echo "<td align='center' class='hdtable' width='20%'>วดป.ที่กำหนด</td>";
		echo  "<td width='5%' align='center' class='hdtable'>ลบ</td>";
		echo "</tr>";$id=1;
		while($line = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>".$id."</td>";
			echo "<td align='center' class='listdetail'>".$line['an']."</td>";
			echo "<td align='center' class='listdetail'>ลับ</td>";
			echo "<td align='center' class='listdetail'>".$line['byuser']."</td>";
			echo "<td align='center' class='listdetail'>".$line['byupdate']."</td>";
 			echo "<td align='center' class='listdetail'>";
			echo "<a href='frm_del_secret.php?an=".$line['an']."'><img src='../images/icon_b_delete2.gif' border='0' /></a>";
			echo "</td>";
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table><br>";
		} //end if check result
		////////// List AN Scan
		$query ="select t.doctypename,t.doctype,d.an from tb_ipd_doctype t ,tb_ipd_doctype_detail d where t.docid=d.doctype";
		$query .=" and an='".$_REQUEST['txt_an']."'";
		$query .=" order by doctype";
		//echo $query;
		$result = mysql_query($query);
		if (mysql_num_rows($result)>0) {
			echo "<table class='rowh' align='center' width='90%' cellspacing='1' cellpadding='1' border='0'>";
			echo "<tr><td colspan=3> AN: ".$_REQUEST['txt_an']." มีข้อมูลเอกสาร Scan ในระบบทั้งหมด ".mysql_num_rows($result)." รายการ";
			echo "</td></tr>";
			echo "<tr bgcolor='#0080FF'>";
			echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
			//echo "<td align='center' class='hdtable' width='10%'>AN</td>";
			echo "<td align='center' class='hdtable' width='70%'>DocTypeName</td>";
			echo "<td align='center' class='hdtable' width='25%'>DocType</td>";
			echo "</tr>";$id=1;
			while($line = mysql_fetch_array($result)){
				if (fmod($id,2)) {$rcolor=' bgcolor=#99F8FD';}else{$rcolor=' bgcolor=#D3D3D3';}
				echo "<tr".$rcolor.">";
				echo "<td align='center' class='listdetail'>".$id."</td>";
				//echo "<td align='center' class='listdetail'>".$line['an']."</td>";
				echo "<td align='left' class='listdetail'> &nbsp;".$line['doctypename']."</td>";
				echo "<td align='center' class='listdetail'>".$line['doctype']."</td>";
				echo "</tr>";
				$id++;
			} //end of while loop
			echo "</table><br>";
		}else{//no record found
			echo "<div class='blackb' align='center'>======== ไม่พบข้อมูลเอกสาร Scan ของ AN : ".$_REQUEST['txt_an']."========</div>";
		}// end of if chk $result
			//////////////////////////////////////////////////////////////
	}else{//no record found tb_ipd
		echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล AN : ".$_REQUEST['txt_an']."========</div>";
	}// end of if chk $result

}elseif ($_REQUEST['cmd_showall']<>''){
		////////// List secreted AN ///////////////////
		$sqlcomm ="select * from tb_ipd_doc_secret ";
		$pagesize=20;
		$sql = $sqlcomm;
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
		$comm =$sqlcomm;
		$comm .=" order by byupdate LIMIT $start,$pagesize";
		//echo $comm;
		$result=mysql_query($comm);
		if ($totalpage>0) {
			echo "<div class='blackb' align='center'>แสดงข้อมูลที่กำหนดให้เป็นสถานะลับ ในระบบทั้งหมด ".$total." รายการ";
			if ($totalpage>1){echo " ขณะนี้แสดงหน้าที่  ".$pageid."/".$totalpage;}
			echo "</div>";
			echo "<table class='rowh' align='center' width='90%' cellspacing='1' cellpadding='1' border='0'>";
			echo "<tr bgcolor='#a9a9a9'>";
			echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
			echo "<td align='center' class='hdtable' width='10%'>AN</td>";
			echo "<td align='center' class='hdtable' width='20%'>สถานะ</td>";
			echo "<td align='center' class='hdtable' width='20%'>วดป.ที่กำหนด</td>";
			echo  "<td width='5%' align='center' class='hdtable'>กำหนดโดย</td>";
			echo  "<td width='5%' align='center' class='hdtable'>ลบ</td>";
			echo "</tr>";
			while($line = mysql_fetch_array($result)){
				if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
				echo "<tr".$rcolor.">";
				echo "<td align='center' class='listdetail'>".$id."</td>";
				echo "<td align='center' class='listdetail'>".$line['an']."</td>";
				echo "<td align='center' class='listdetail'>ลับ</td>";
				echo "<td align='center' class='listdetail'>".$line['byupdate']."</td>";
				echo "<td align='center' class='listdetail'>".$line['byuser']."</td>";
				echo "<td align='center' class='listdetail'>";
				echo "<a href='frm_del_secret.php?txt_an=".$line['an']."'><img src='../images/icon_b_delete2.gif' border='0' /></a>";
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
				echo "</td></tr></table><br>";
			}// end if list pages
	}else{//no record found
		echo "<div class='blackb' align='center'>======== ไม่มีข้อมูล AN ที่ถูกกำหนดเป็นสถานะลับ========</div>";
	}// end of if chk $result
		///////////////////////// End List secreted AN 
	
}// check cmd_show
	
?>

	</td><!--end of detail body -->
</tr>
</table>
	<!-- central main -->  
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
