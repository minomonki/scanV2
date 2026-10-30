<? 
//if ($_GET['chkpass']==1){
$Img_Id = $_GET['an'];
$docid = $_GET['docid'];
#$tmp = $_SESSION["tmp"];
$tmp = $_GET['tmp'];
//check secret status
include_once("../System_config/func.php");
if (chkSecret($Img_Id)==1){
		///////////////// add to log detail /////////////
		if ($_SESSION["logno"]==""){savelog2("B","Bypass System");}
		savelogdetail($_SESSION["logno"],"F",$Img_Id,$docid);
		$detail=" Access deny AN=".$Img_Id." and ".$docid;
		updatelogdetail($_SESSION["logno"],$detail);
		//////////////////////////////////////////////
	print "<script>alert ('AN : $anID นี้ถูกกำหนดเป็นข้อมูลลับ'); </script>";
	print "<script language='javascript' >window.location='show_message.php?msg=AN : $Img_Id นี้ถูกกำหนดเป็นข้อมูลลับ';</script>";
}

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

//}
?>