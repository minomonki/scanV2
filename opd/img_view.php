<? 
$Img_Id = $_GET['hnID'];
$vn = $_GET['vn'];
$docid = $_GET['docid'];
#$tmp = $_SESSION["tmp"];
$tmp = $_GET['tmp'];
if (is_numeric($docid)) {
		include ("System_config/connection.php");

		#$SQL = "SELECT * FROM  ib_ipd  WHERE an ='$Img_Id'";
		#$SQL = "SELECT * FROM  tb_ipd_doctype_detail  WHERE an ='$Img_Id'";
		$SQL = "SELECT * FROM tb_opd_detail  WHERE (hn ='$Img_Id' and vn ='$vn') and (doctype_id =$docid) ";

			#print $SQL;
			
		$Query = mysql_db_query($database,$SQL) or die ("Error Query [".$SQL."]");

		$Result = mysql_fetch_array($Query);

		$Type=$Result["FileType"];

		header("Content-type: $type ");

		#print $Result["firstname"];
		echo $Result["imagescan"];
}
?>