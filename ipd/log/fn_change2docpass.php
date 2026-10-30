<?php
	
	session_start();
 
include("../System_config/connect.php");

$pass = $_POST["password"];
$passnew = $_POST["passnew"];
$conpass = $_POST["conpass"];

//print $user."/".$pass."/".$passnew."/".$conpass."<br>";


if($passnew == $conpass){
	#print "ok"."<br>";
	$encryptpass = md5($pass);
	$sqlLogin = "SELECT * FROM tb_ipd_doc_pass WHERE userdocpass='$pass'";
	//$sqlLogin = "SELECT * FROM tb_ipd_login WHERE username='$user' AND password='$encryptpass'";
	print $sqlLogin."<br>";
	//$resLogin = mysql_db_query($database,$sqlLogin);
	$resLogin = mysql_query($sqlLogin);
	$numLogin = mysql_num_rows($resLogin);
	//print $numLogin."<br>";
	
		if($numLogin == '0'){	 
			$status = "fail";
			//header("location:frm_change_docpass.php");
		    print "<script>alert (' Fail : Unknown password  '); </script>";
			print "<script language='javascript' >window.location='frm_login_docpass.php';</script>";
			exit();
		}else{
			$encryptpassnew = md5($passnew);
			$sqlupdate = "UPDATE  tb_ipd_doc_pass SET userdocpass='$passnew' , lastupdate=".CURRENT_TIMESTAMP." WHERE userdocpass='$pass'";
			//$sqlupdate = "UPDATE  tb_ipd_login SET password='$encryptpassnew' WHERE username='$user'";
			print $sqlupdate."<br>";
			//$resupdate = mysql_db_query($database,$sqlupdate);
			$resupdate = mysql_query($sqlupdate);
			#print $resupdate."<br>";
				if($resupdate){
					#$status = "ok";
///////////////// add to log detail /////////////
include_once("../System_config/func.php");
savelogdetail($_SESSION["logno"],"U","","");
$detail =$sqlupdate;
//$detail ="UPDATE  tb_ipd_login SET password=$encryptpassnew WHERE username=$user";
updatelogdetail($_SESSION["logno"],$detail);
//////////////////////////////////////////////
					//header("location:../changepass.php?status=1");
					print "<script>alert ('บันทึกเรียบร้อยแล้ว'); </script>";
				    //print "<script language='javascript' >window.location='../frm_login_docpass.php';</script>";

				}// end if resupdate
		}// end if numLogin
}else{
	//header("location:../changepass.php?status=0");
	print "<script>alert (' Fail : A new password does not match '); </script>";
	//print "<script language='javascript' >window.location='frm_show_docpass.php';</script>";
	//exit();
}// end if chk passnew==conpass



?>