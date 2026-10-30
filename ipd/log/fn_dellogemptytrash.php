<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<?php
$startd	= $_REQUEST["startd"]." 00:00:00";
$endd= $_REQUEST["endd"]." 23:59:59";

include("../System_config/connect.php");

///////////////////// get logno to logno_array
$sql = "SELECT logno FROM tb_ipd_logfile_bak WHERE ldate between '$startd' and '$endd'";
//echo $sql."<br><br>";
$result=mysql_query($sql);$j=1;
while ($row = mysql_fetch_array($result)){
	$logno_array[$j]=$row[0];
	$j++;
}

//////////////////// Delete  tb_ipd_logfile
$sql = "DELETE FROM tb_ipd_logfile_bak WHERE ldate between '$startd' and '$endd'";
mysql_query($sql);
//echo $sql."<br><br>";
//////////////////// Delete  tb_ipd_logfile_detail
for ($i=1;$i<=count($logno_array);$i++){
$sql2 = "DELETE FROM tb_ipd_logfile_detail_bak WHERE logno=".$logno_array[$i];
mysql_query($sql2);
//echo $sql2."<br><br>";
}
///////////////// add to log detail /////////////
include_once("../System_config/func.php");
savelogdetail($_REQUEST["logno"],"D","","");
$detail="Empty Log start=$startd to end=$endd";
updatelogdetail($_REQUEST["logno"],$detail);

//////////////////////////////////////////////

print "<script>alert ('ลบข้อมูลเรียบร้อยแล้ว'); </script>";
print "<script language='javascript' >window.location='logfilemanager.php';</script>";

?>