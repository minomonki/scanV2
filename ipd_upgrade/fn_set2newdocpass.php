<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
/////////////////////// FUNCTION ///////////////////
function insertAN2pass($an,$pass,$startdate,$expired,$foruser,$byuser,$byupdate){
	include("../ipd/System_config/connect.php");
	$sql = "INSERT INTO tb_ipd_doc_setup (an,password,startdate,expired,foruser,byuser,byupdate) VALUES ('$an','$pass','$startdate','$expired','$foruser','Clean data/$byuser','$byupdate')";
	//echo $sql."<br>";
	mysql_query($sql);
	return;
}//func
function delete2clearPass($pass){
	include("../ipd/System_config/connect.php");
	//////////////////// Delete  tb_ipd_doc_setup
	$sql = "DELETE FROM tb_ipd_doc_setup WHERE password='$pass'";
	//echo $sql."<br>";
	mysql_query($sql);
	//////////////////// Delete  tb_ipd_doc_pass
	$sql = "DELETE FROM tb_ipd_doc_pass WHERE password='$pass'";
	//echo $sql."<br>";
	mysql_query($sql);
	return ;
}//func
///////////////////////////////////////////////////////////

/////  check process
if ($_POST["cmd_man_password"] <> '') {

//
require_once("../ipd/System_config/connect.php");
//include_once("../ipd/System_config/func.php");

////////// Check Exist Foruser and keep password list to array
$query ="select foruser,count(*) as total from tb_ipd_doc_pass group by foruser having total>1 order by 2 desc";
//echo $query;
$result = mysql_query($query);
$total=mysql_num_rows($result);
$item=0;
if ($total>0) {
	while ($row = mysql_fetch_array($result)){
		$foruser[$item]= $row[0];
		$item++;
	}//end while foruser  to get password
}//end if total > 0 
//////////////////////////////////////////////////////////////////
for ($i=0;$i<=count($foruser)-1;$i++){
	$sql = "SELECT distinct password FROM tb_ipd_doc_setup WHERE foruser ='".$foruser[$i]."' order by byupdate desc ";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	//$total=mysql_num_rows($result);
	$id = 0;
	while ($row = mysql_fetch_array($result)){
		$pass[$id] = $row['password'];
		//////////////// Get AN ////////////
			$sql2 = "SELECT * FROM tb_ipd_doc_setup WHERE password ='".$pass[$id]."' ";
			//echo $sql2."<br>";
			$result2=mysql_query($sql2);$no=0;
			while ($row2 = mysql_fetch_array($result2)){
				if ($id==0 & $no==0){$an1=$row2[0];}//echo "an1= ".$an1."<br>";
				//////////////// INSERT AN TO GROUP ////////////
				if ($an1 != $row2['an']){
					insertAN2pass($row2['an'],$pass[0],$row2['startdate'],$row2['expired'],$row2['foruser'],$row2['byuser'],$row2['byupdate']);
				}// end if
				////////////////////////////
				$no++;
			}// while an
	//////////////// DELETE TO CLEAR PASS ////////////
		if ($id>0){
			delete2clearPass($pass[$id]);}
		$id++;
	echo "<br><br>";
	}// while password
}//end for foruser
	
print "<script>alert ('ดำเนินการเรียบร้อยแล้ว'); </script>";
print "<script language='javascript' >window.location='frm_setdata_docpass.php';</script>";

//////////////////////////////////////////////////////////////////
}
else{
	print "<script language='javascript' >window.location='frm_setdata_docpass.php';</script>";
}
?>