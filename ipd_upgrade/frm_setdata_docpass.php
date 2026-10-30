<?php
	$imgpath_top = "../ipd/images/design_webIPD/web-IPDS01_01.jpg";
	$imgpath_botton = "../ipd/images/design_webIPD/web-IPDS01_04.jpg";
/////////////////////////// function ///////////////////////
function getPassdata(){
	include("../ipd/System_config/connect.php");
	$sql = "SELECT distinct password FROM tb_ipd_doc_setup WHERE password not in (select password from tb_ipd_doc_pass) ";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	//$row = mysql_fetch_array($result);
	if ($total>0){
		$descr="password ที่ยังไม่ได้ import เข้าตาราง tb_ipd_doc_pass มีจำนวน ".$total." รายการ";
	}else{
		$descr="<span class='redb'>ไม่มีรายการ import data เข้าตาราง table tb_ipd_doc_pass </span>";
	}//  check if exist 
	return $descr;
}
function getForuserdata(){
	include("../ipd/System_config/connect.php");
	$sql = "SELECT foruser,count(*) as total FROM tb_ipd_doc_pass group by foruser having total>1 order by 2 desc";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	//$row = mysql_fetch_array($result);
	if ($total>0){
		$descr="ชื่อผู้ใช้งานที่มี password ในระบบยืมมากกว่าหนึ่ง มีจำนวน ".$total." รายการ";
	}else{
		$descr="<span class='redb'>ไม่มีรายการ ชื่อผู้ใช้งานที่มี password ในระบบยืมมากกว่าหนึ่ง </span>";
	}//  check if exist 
	return $descr;
}
function showforuser($foruser){
	include("../ipd/System_config/connect.php");
	$sql = "SELECT password,an,byupdate FROM tb_ipd_doc_setup WHERE foruser ='".$foruser."' order by byupdate desc";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$descr="<table align=center width=100% border=0  cellspacing='2' cellpadding='2' >";
	$item=1;
	while ($row = mysql_fetch_array($result)){
		$descr .="<tr valign=top><td width=24%>";
		if ($item==1){$descr .="<img src='../ipd/images/accept.gif' border=0> ";}else{$descr .="<img src='../ipd/images/cancel.gif' border=0> ";}
		$descr .="&nbsp;".$row[0]."</td><td width=33%>".$row[1]."</td><td>".getFormatdate($row[2],2)."</td></tr>";
		$item++;
	} // while
	$descr .="</table>";
	return $descr;
}
/////////////////////////////////////////////
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../ipd/css/menu/style.css" type="text/css" />
<title>:: IPD : Upgrade System ::</title>
</head>

<body>
<table align="center" width="314" border="0" cellspacing="0" cellpadding="0">
  <tr><td><?php  include ("../ipd/System_Design/header.php");		?></td></tr>
  
  <tr>
  	<td height="337" background="../ipd/images/design_webIPD/web-IPDS01_03.jpg">
<!-- ############################# -->
<table align="center" width="701" border="0" cellspacing="2" cellpadding="0">
<form name="add" method="post" action="frm_setdata_docpass.php">
  <tr>
    <td class="lnku" align="center"><BR>:: Import data to tb_ipd_doc_pass :: </td>
  </tr>
  <?php $passdata= getPassdata();?>
  <tr>
	<td align="center"><BR>	<?=$passdata?></td>
  </tr>
  <?php 
if (substr($passdata,0,1)<>"<"){ 
	echo "<tr>";
	echo	"<td align='center'><BR>	<input type='submit' name='cmd_setdata' value=' Import ' /></td>";
	echo  "</tr>";
}?>
</form>
<form name="check" method="post" action="frm_setdata_docpass.php">
  <tr>
    <td class="lnku" align="center"><BR>:: ตรวจสอบชื่อผู้ใช้งานซ้ำในระบบ :: </td>
  </tr>
  <?php $foruserdata= getForuserdata();?>
  <tr>
	<td align="center"><BR>	<?=$foruserdata?></td>
  </tr>
  <?php 
if (substr($foruserdata,0,1)<>"<"){ 
	echo "<tr>";
	echo	"<td align='center'><BR><input type='submit' name='cmd_foruserdata' value=' List ' /></td>";
	echo  "</tr>";
}?>
</form>
<tr><td>
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr valign="top">
<td><!--detail body -->
<br>
<?
if ($_REQUEST['cmd_setdata']<>''){
	include("../ipd/System_config/connect.php");
	////////// Check Exist AN
	$query ="select distinct password,foruser from tb_ipd_doc_setup where password not in (select password from tb_ipd_doc_pass)";
	//echo $query;
	$result = mysql_query($query);
	$total=mysql_num_rows($result);
	$id=1;
	if ($total>0) {
			echo "<table class='rowh' align='center' width='70%' cellspacing='2' cellpadding='2' border='0'>";
			echo "<tr>";
			echo "<td align='center' class='hdtable' colspan=3>import data to ตาราง tb_ipd_doc_pass จำนวน $total &nbsp;รายการ </td>";
			echo "</tr>";
			echo "<tr bgcolor='#a9a9a9'>";
			echo "<td align='center' class='hdtable' width='10%'>ลำดับ</td>";
			echo "<td class='hdtable' align='center'>password</td>";
			echo "<td class='hdtable' align='center'>&nbsp;&nbsp;ชื่อผู้ใช้</td>";
			echo "</tr>";
		while ($row = mysql_fetch_array($result)){
			$userdocpass=$row[0].$row[0];
			$sql = "INSERT INTO tb_ipd_doc_pass (`password`,`userdocpass`,`foruser`,`lastupdate`) VALUES ('$row[0]','$userdocpass','$row[1]',".CURRENT_TIMESTAMP.")";
			//echo $sql."<br>";
			$result2 = mysql_query($sql);
			if ($result2){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			echo "<td class='listdetail' align='center'>".$id."</td>";
			echo "<td class='listdetail' align='center'>".$row[0]."</td>";
			echo "<td class='listdetail'>&nbsp;&nbsp;".$row[1]."</td>";
			echo "</tr>";
			$id++;
			}
		}//while
		echo "</table><br>";
		//////////////////////////////////////////////////////////////
	}else{//no record found
		//echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล import ========</div>";
	}// end of if chk $result
}// end if chk cmd???
?>
<br>
<?
if ($_REQUEST['cmd_foruserdata']<>''){
	include("../ipd/System_config/connect.php");
	include("../ipd/System_config/func.php");
	////////// Check Exist Foruser
	$query ="select foruser,count(*) as total from tb_ipd_doc_pass group by foruser having total>1 order by 2 desc";
	//echo $query;
	$result = mysql_query($query);
	$total=mysql_num_rows($result);
	$id=1;
	if ($total>0) {
			echo "<div align=center>ข้อมูลชื่อผู้ใช้ซ้ำ ในระบบยืม จำนวน $total &nbsp;รายการ</div>";
			echo "<table class='rowh' align='center' width='100%' cellspacing='0' cellpadding='0' border='1' bordercolor='#000000' style='border-collapse: collapse'>";
			echo "<tr bgcolor='#a9a9a9'>";
			echo "<td align='center' class='hdtable' width='10%' rowspan=2>ลำดับ</td>";
			echo "<td class='hdtable' align='center' rowspan=2>ชื่อผู้ใช้</td>";
			echo "<td class='hdtable' align='center' rowspan=2>จำนวน</td>";
			echo "<td class='hdtable' align='center' colspan=3>รายละเอียด</td>";
			echo "</tr>";
			echo "<tr bgcolor='#a9a9a9'>";
			echo "<td class='hdtable' width=15% align='center'>password</td>";
			echo "<td class='hdtable' width=20% align='center'>an</td>";
			echo "<td class='hdtable'  align='center'>lastupdate</td>";
			echo "</tr>";
		while ($row = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor." valign=top>";
			echo "<td class='listdetail' align='center'>".$id."</td>";
			echo "<td class='listdetail'>&nbsp;&nbsp;".$row[0]."</td>";
			echo "<td class='listdetail' align='center'>".$row[1]."</td>";
			echo "<td class='listdetail' colspan=3 align='center'>";
			echo showforuser($row[0]);
			echo "</td>";
			echo "</tr>";
			$id++;
		}//while
		echo "</table><br>";
		echo "<div align=center><form action='fn_set2newdocpass.php' method='post'>";
		echo "<input type='submit' name='cmd_man_password' value=' Process '>";
		echo "</form></div>";
		//////////////////////////////////////////////////////////////
	}else{//no record found
		//echo "<div class='blackb' align='center'>======== ไม่พบข้อมูล import ========</div>";
	}// end of if chk $result
}// end if chk cmd???
?>
	</td><!--end of detail body -->
</tr>
</table>
	<!-- central main -->  
</td></tr>
</table>
<!-- ############################# -->
    </td>
  </tr>
  
  <tr><td><?php  include ("../ipd/System_Design/footer.php");		?></td></tr>
  
</table>


</body>
</html>