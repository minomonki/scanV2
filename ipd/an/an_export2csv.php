<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<?php
	
	include ("../System_config/connection.php");
include("../System_config/connect.php");
include_once("../System_config/const.php");

$returnurl 	= $_GET["returnurl"];
$sum_an 	= $_GET["sum_an"];
$pages 	= $_GET["pages"];
$sizes 	= $_GET["sizes"];
////////////////////////////////////
//print "sql = ".$sql."<br>";
print "returnurl = ".$returnurl."<br>";
print "sum_an = ".$sum_an."<br>";
print "pages = ".$pages."<br>";
print "sizes = ".$sizes."<br>";
///////////////////////////////////
/* example
SELECT 'ปี', 'จำนวน AN ในระบบ', 'จำนวนหน้า', 'ขนาด(Mb)'
UNION (

SELECT year( datescan ) , count( * ) AS sum_an, sum( pages ) AS pages, sum( OCTET_LENGTH( imagescan ) /1024 ) AS sizes
INTO OUTFILE 'd:\userdata.csv'
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
FROM tb_ipd a, `tb_ipd_doctype_detail` b
WHERE a.an = b.an
GROUP BY year( datescan ) 
) 
*/
//////////////////////////////////
$titlecsv="SELECT 'ปี', 'จำนวน AN ในระบบ', 'จำนวนหน้า', 'ขนาด(Mb)' UNION (";
$into=" INTO OUTFILE ";
$path="'C:\AppServ\www\ipd\exportfile\ ";
//$path="'../exportfile/";
$exportname="allandata".$today3.".csv'";
$field=" FIELDS TERMINATED BY ',' ";
$char='"';
$enclosed=" ENCLOSED BY '".$char."' ";
$lines=" LINES TERMINATED BY '\n' ";
if ($returnurl=="anreport"){
	$select=" select year(datescan) as yr, count( * ) AS sum_an, sum( pages ) as pages , sum( OCTET_LENGTH( imagescan ) /1048576 ) as sizes ";
	$from=" from tb_ipd a, tb_ipd_doctype_detail b";
	$where=" where a.an = b.an";
	$groupby=" group by year(datescan)";
	$sqlcmd=$titlecsv.$select.$into.trim($path).$exportname.$field.$enclosed.$lines.$from.$where.$groupby;
	print "sqlcmd = ".$sqlcmd."<br>";
	//$result=mysql_query($sqlcmd);
	/*$list=array('รวม,$sum_an,$pages,$sizes');
	$fp = fopen($path.$exportname, 'a+');
foreach ($list as $line) {
    fputcsv($fp, split(',', $line));
}
	fclose($fp);
*/
}

if($result){
	print "<script language='javascript' >window.location='$path.$exportname.csv';</script>";
	//print "<script language='javascript' >window.location='$returnurl.php';</script>";
}



?>