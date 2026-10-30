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

<title>:: IPD - AN scan check ::</title>
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
<table align="left" width="100%" cellspacing="0" cellpadding="0" border="0" >
<tr valign="top">
<td bgcolor="#ffffff"><!--detail body -->
<br>
<?php
include("../System_config/connect.php");
include("../System_config/func.php");
EmptyDir($exportdir); // delete all old export file
echo "<div class='blackb' align='center'>";
$iptmaxdate=chkMinMaxDate("min(dchdate)","hos.ipt","en");
$iptmindate=chkMinMaxDate("max(dchdate)","hos.ipt","en");
echo "สรุปเอกสารสแกน AN ทั้งหมด ตั้งแต่วันที่ <span class=blue>".$iptmaxdate."</span> ถึง <span class=blue>".$iptmindate."</span>";
echo "</div><br>";
$enmaxdate=chkMinMaxFormatDate("max(dchdate)","hos.ipt","en");
$enmindate=chkMinMaxFormatDate("min(dchdate)","hos.ipt","en");
$thmaxdate=chkMinMaxFormatDate("max(dchdate)","hos.ipt","th");
$thmindate=chkMinMaxFormatDate("min(dchdate)","hos.ipt","th");
//###################################
$colall=number_format(getValue("count(*)","hos.ipt",""));
$colallan0=number_format(getValue("count(*)","hos.ipt","dchdate is null or dchdate=''"));
$colallan=number_format(getValue("count(*)","hos.ipt","dchdate is not null or dchdate<>''"));
$colallyesan=number_format(getValue("count(*)"," hos.ipt a, hdbms.tb_ipd b "," a.an=b.an"));
$colallnoan=number_format(getValue("count(*)","hos.ipt"," dchdate is not null and an not in (select an from hdbms.tb_ipd)"));
//echo "an0=".$colallan0."<br>";
//###################################
echo "<table class='rowh' align='center' width='80%' cellspacing='1' cellpadding='1' border='0'>";// create table title
echo "<tr bgcolor='#3399CC'>";
echo "<td align='center' class='hdtable' width='20%'>จำนวน AN ทั้งหมด</td>";
if ($colallan0>0){echo "<td align='center' class='hdtable' width='20%'>จำนวน AN admitted </td>";}
echo "<td align='center' class='hdtable' width='20%'>จำนวน AN ในระบบ</td>";
echo "<td align='center' class='hdtable' width='20%'>จำนวน AN สแกนแล้ว</td>";
echo "<td align='center' class='hdtable' width='20%'>จำนวน AN ที่สแกนไม่ครบ</td>";
echo "</tr>";
if (fmod($id,2)) {$rcolor=' bgcolor=#99FF99';}else{$rcolor=' bgcolor=#FFFF5B';}
echo "<tr".$rcolor.">";
echo "<td align='center' class='listdetail'>".$colall."</td>";
if ($colallan0>0){
	echo "<td align='center' class='listdetail'>";
	echo "<a target='_blank' href='anscancheck_list.php?status=0&enmindate=$enmindate&enmaxdate=$enmaxdate&thmindate=$thmindate&thmaxdate=$thmaxdate'>";
	echo $colallan0;
	echo "</a>";
	echo "</td>";
}
echo "<td align='center' class='listdetail'>".$colallan."</td>";
echo "<td align='center' class='listdetail'>";
if ($colallyesan==0){
	echo $colallyesan;
}else{
	echo "<a target='_blank'  href='anscancheck_list.php?status=1&enmindate=$enmindate&enmaxdate=$enmaxdate&thmindate=$thmindate&thmaxdate=$thmaxdate'>";
	echo $colallyesan;
	echo "</a>";
}
echo "</td>";
echo "<td align='center' class='listdetail'>";
if ($colallnoan==0){
	echo $colallnoan;
}else{
	echo "<a target='_blank' href='anscancheck_list.php?status=2&enmindate=$enmindate&enmaxdate=$enmaxdate&thmindate=$thmindate&thmaxdate=$thmaxdate'>";
	echo $colallnoan;
	echo "</a>";
}
echo "</td>";
echo "</tr>";
echo "</table>";
//###################################
//################################### LIST BY YEAR
$minyr=substr($enmindate,0,4); 
$maxyr=substr($enmaxdate,0,4);
/*//echo $minyr."/".$maxyr."<br>";
$thminyr=$minyr+543;
$thmaxyr=$maxyr+543;
$totalyear=$maxyr-$minyr+1;
//echo "total=".$totalyear."<br>";
for ($i=0;$i<$totalyear;$i++){
	if ($i==0){$enlist=$maxyr;$thlist=$thmaxyr;}else{$enlist=$enlist-$i;$thlist=$thlist-$i;}
	$enyr_array[$i]=$enlist;
	$thyr_array[$i]=$thlist;
	//echo $yr_array[$i];
}*/
echo "<BR>";
//###################################
$pagesize=20;
$select="select year(dchdate) as yr, count( * ) AS sum_an "; //, sum( pages ) as pages
$from=" from hos.ipt ";
$where=" where dchdate is not null";
$groupby=" group by year(dchdate)";

$sql =$select.$from.$where.$groupby;
$ans=mysql_query($sql);
$total=mysql_num_rows($ans);
$totalpage=ceil($total/$pagesize);
if (isset($_GET['pageid'])){
	$start=$pagesize*($_GET['pageid']-1);
	$id=$pagesize*($_GET['pageid']-1)+1;//items no.
}else{
	$start=0;$pageid=1;$id=1;
}
$query =$select.$from.$where.$groupby;
$query .=" order by yr desc LIMIT $start,$pagesize";
//echo $query."<br>";
$result=mysql_query($query);
//###################################
if ($totalpage>0) {
	echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
	echo "<tr bgcolor='#ffffff'>";
	echo "<td align='center' class='hdtable'>";
	echo "<div class='blackb' align='center'>พบข้อมูลทั้งหมด <span class=blue>".$total."</span> ปี </div>";
	echo "</td>";
	echo "<td align='right' class='hdtable' width='35'>";//onMouseover='return hidestatus()' onMouseOut='return hidestatus()' 
	echo "<a title='Export to csv' target='_blank' href=anscancheck_export2csv.php?logno=".$_SESSION["logno"]."&colall=".$colall."&colallan0=".$colallan0."&colallan=".$colallan."&colallyesan=".$colallyesan."&colallnoan=".$colallnoan."&iptmaxdate=".$iptmaxdate."&iptmindate=".$iptmindate."&minyr=".$minyr."&maxyr=".$maxyr.">";
	echo "<img src='../images/export-excel-icon.png' border=0>";
	echo "</a>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	while($row = mysql_fetch_array($result)){
		if ($id==1){
		echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
		echo "<tr bgcolor='#a9a9a9'>";
		echo "<td align='center' class='hdtable' width='10%'>ปี</td>";
		echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ในระบบ</td>";
		echo "<td align='center' class='hdtable' width='30%'>จำนวน AN สแกนแล้ว</td>";
		echo "<td align='center' class='hdtable' width='30%'>จำนวน AN ที่สแกนไม่ครบ</td>";
		echo "</tr>";
		}
	//$colan=number_format(getValue("count(*)","hos.ipt","year(dchdate)= '".$enyr_array[$i]."'"));
	$thyr=$row[0]+543;
	$colyesan=number_format(getValue("count(*)"," hos.ipt a, hdbms.tb_ipd b "," a.an=b.an and year(dchdate)= '".$row[0]."'")); //enyr
	$colnoan=number_format(getValue("count(*)","hos.ipt"," year(dchdate)= '".$row[0]."' and an not in (select an from hdbms.tb_ipd)")); //enyr
	if (fmod($i,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
	echo "<tr".$rcolor.">";
	echo "<td align='center' class='listdetail'>";
	echo "<a title='ดูรายละเอียด' onMouseover='return hidestatus()' onMouseOut='return hidestatus()'  href=anscancheck_yeardetail.php?enyr=".$row[0]."&thyr=".$thyr."&colan=".$row[1]."&colyesan=".$colyesan."&colnoan=".$colnoan.">";
	echo $thyr;
	echo "</a>";
	echo	"</td>";
	echo "<td align='center' class='listdetail'>".number_format($row[1])."</td>";
	echo "<td align='center' class='listdetail'>";
	if ($colyesan==0){
		echo $colyesan;
	}else{
		echo "<a target='_blank' href='anscancheck_list.php?status=3&enyr=".$row[0]."&thyr=".$thyr."'>";
		echo $colyesan;
		echo "</a>";
	}//end if colyesan
	echo "</td>";
	echo "<td align='center' class='listdetail'>";
	if ($colnoan==0){
		echo $colnoan;
	}else{
		echo "<a target='_blank' href='anscancheck_list.php?status=4&enyr=".$row[0]."&thyr=".$thyr."'>";
		echo $colnoan;
		echo "</a>";
	}//end if col3
	echo "</td>";
	echo "</tr>";
			$id++;
	unset($thyr);unset($colyesan);unset($colnoan);
}//end while
echo "</table>";
}else{//no record found
	echo "<BR><BR><div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div><BR>";
}// end of if chk $result

	//header table pages row 
	if ($totalpage>1){
		echo "<table align='center' width='90%'><tr><td>";
		// write link each no.page
		for ($i = 1; $i <= $totalpage; $i++){
			if ($i==$pageid){//this is a current page
				echo "<b>$i</b>&nbsp;";
			}else{
				echo "[<a href='?start=".$start."&pageid=".$i;
				echo "'>$i</a>]&nbsp;";
			}//end if
		}//end for
	echo "</td></tr></table>";
	}//end if totalpage
//################################### 
?><BR>
<form name="search" method="post" action="anscancheck2.php">
<table align="center" width="70%" border="1" bordercolor="#C0C0C0" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
  <tr>
    <td colspan="4" class="head-topic" bgcolor="#C0C0C0">:: เงื่อนไขการแสดงผล ::</td>
  </tr>
  <tr>
    <td width="38%" align="right" bgcolor="#CCCCCC" class="topic">ตรวจสอบเอกสารที่สแกน ตั้งแต่วันที่ :</td>
    <td colspan="3">
    	<input type="text" name="admit_s" id="admit_s" />
        
        <img src="../images/span.gif" width="10" />   
        <strong>ถึงวันที่.</strong>
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
    <td colspan="4" align="center"><BR>
    	<input type="submit" name="cmd_show" value="Show" />
        <input type="reset" name="cmd_reset_frm" value="Reset" />
    </td>
  </tr>
</table>
</form>
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