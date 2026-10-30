<?php 
$Img_Id = $_GET['an'];
$docid = $_GET['docid'];
#$tmp = $_SESSION["tmp"];
$tmp = $_GET['tmp'];

include ("../System_config/connection.php");

#$SQL = "SELECT * FROM  tb_ipd  WHERE an ='$Img_Id'";
#$SQL = "SELECT * FROM  tb_ipd_doctype_detail  WHERE an ='$Img_Id'";
$SQL = "SELECT * FROM  tb_ipd_doctype_detail  WHERE an ='$Img_Id' and doctype ='$docid' ";
	#print $SQL;
	
$Query = mysql_db_query($database,$SQL) or die ("Error Query [".$SQL."]");

$Result = mysql_fetch_array($Query);

$Type=$Result["FileType"];

header("Content-type: $type ");

#print $Result["firstname"];
echo $Result["imagescan"];

?>