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
	<link rel="shortcut icon" type="image/x-icon" href="favicon_trash.ico">
<title>:: IPD - TRASH -  Log File Detail ::</title>
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
	<!-- central main -->  
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->
<br>
<?
$col ="logno,items,pcode,an,doctype,day(ldate) as d , month(ldate) as m , year(ldate)+543 as y, hour(ldate) as h, minute(ldate) as mn, second(ldate) as s, descr";
include("../System_config/connect.php");
$pagesize=20;
$sql="select ".$col." from tb_ipd_logfile_detail_bak ";
$sql=$sql." where logno=".$_REQUEST['logno'];
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
//link to years
$query="select ".$col." from tb_ipd_logfile_detail_bak";
$query=$query." where logno=".$_REQUEST['logno'];
$query=$query." order by ldate desc LIMIT $start,$pagesize";
//echo "q=".$query."<br>";
$result=mysql_query($query);
if ($totalpage>0) {
	echo "<div class='blackb' align='center'><img src='../images/trash_full.gif' border='0' />&nbsp;&nbsp;";
	echo "ชื่อผู้ใช้ : <span class=blue>".$_REQUEST['getname']."</span>";
	echo "</div><br>";
	echo "<table class='rowh' align='center' width='90%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#a9a9a9'>";
	echo "<td align='center' class='hdtable' width='5%'>ลำดับ</td>";
	echo "<td align='center' class='hdtable' width='10%'>AN</td>";
	echo "<td align='center' class='hdtable' width='20%'>Doc Type</td>";
	echo "<td align='center' class='hdtable' width='15%'>การใช้เอกสาร</td>";
	echo "<td align='center' class='hdtable' width='20%'>วดป.-เวลา</td>";
	echo "<td align='center' class='hdtable' width='10%'>หมายเหตุ</td>";
	echo "</tr>";
		while($row = mysql_fetch_array($result)){
			if (fmod($id,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
			echo "<tr".$rcolor.">";
			echo "<td align='center' class='listdetail'>".$id."</td>";
			echo "<td align='center' class='listdetail'>".$row['an']."</td>";
			echo "<td align='center' class='listdetail'>";
			include_once("../System_config/func.php");
			echo getDoctype($row['doctype']);
			echo "</td>";
				//echo "<td align='center' class='listdetail'>".$row['pcode']."</td>";
			echo "<td align='center' class='listdetail'>";
			$key = array_search($row['pcode'], $pcodes_array);
			echo $pcode_array[$key];
			echo "</td>";
			echo "<td align='center' class='listdetail'>".$row['d']."/".$row['m']."/".$row['y']." ".$row['h'].":".$row['mn'].":".$row['s']." "."</td>";
			echo "<td align='center' class='listdetail'>";
			if ($row['pcode']=="V" || $row['pcode']=="P" || $row['pcode']=="S" || $row['pcode']=="F" || $row['pcode']=="PA"){
				echo "";
			}else{
?>			
<a href="javascript:popup('show_descr.php?descr=<?=$row['descr'];?>','null',640,360);"onMouseover="return hidestatus()" onMouseOut="return hidestatus()"><?=substr($row['descr'],0,80);?>...</a>
<?php
			}// end check pcode view,print,save as
			echo "</td>";
			echo "</tr>";
			$id++;
		} //end of while loop
		echo "</table>";
}else{//no record found
	echo "<BR><BR><div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div><BR><BR>";
}// end of if chk $result

//header table pages row 
if ($totalpage>1){
	echo "<table align='center' width='90%'><tr><td>";
	// write link each no.page
	for ($i = 1; $i <= $totalpage; $i++){
		if ($i==$pageid){//this is a current page
			echo "<b>$i</b>&nbsp;";
		}else{
			echo "[<a href='?start=".$start."&pageid=".$i."&logno=".$_REQUEST['logno']."&username=".$_REQUEST['username']."&getname=".$_REQUEST['getname']."'>$i</a>]&nbsp;";
		}//end if
	}//end for
echo "</td></tr></table>";
}// end if
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


</body>
</html>


<?php
}
else{
	print "<script language='javascript' >window.location='../frm_login.php';</script>";
}
?>