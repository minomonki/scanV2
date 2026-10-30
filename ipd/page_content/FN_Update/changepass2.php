<?php
	
	session_start();
 
include("../../System_config/connection.php");

#$user = $_POST["username"];
$user	=$_SESSION["user_ipd"];
$pass = $_POST["password"];
$passnew = $_POST["passnew"];
$conpass = $_POST["conpass"];

#print $user."/".$pass."/".$passnew."/".$conpass."<br>";


if($passnew == $conpass){
	#print "ok"."<br>";
	$encryptpass = md5($pass);
	$sqlLogin = "SELECT * FROM tb_ipd_login WHERE username='$user' AND password='$pass'";
	//$sqlLogin = "SELECT * FROM tb_ipd_login WHERE username='$user' AND password='$encryptpass'";
	$resLogin = mysql_db_query($database,$sqlLogin);
	$numLogin = mysql_num_rows($resLogin);
	//print $numLogin."<br>";
	
		if($numLogin == '0'){	 
			$status = "fail";
			header("location:../changepass.php");
			exit();
		}
		else{
			$encryptpassnew = md5($passnew);
			$sqlupdate = "UPDATE  tb_ipd_login SET password='$passnew' WHERE username='$user'";
			//$sqlupdate = "UPDATE  tb_ipd_login SET password='$encryptpassnew' WHERE username='$user'";
			//print $sqlupdate."<br>";
			$resupdate = mysql_db_query($database,$sqlupdate);
			#print $resupdate."<br>";
				if($resupdate){
					#$status = "ok";
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_SESSION["logno"],"U","","");
$detail ="UPDATE  tb_ipd_login SET password=$passnew WHERE username=$user";
//$detail ="UPDATE  tb_ipd_login SET password=$encryptpassnew WHERE username=$user";
updatelogdetail2($_SESSION["logno"],$detail);
//////////////////////////////////////////////
					header("location:../changepass.php?status=1");
				}
		}// end if numLogin
}else{
	header("location:../changepass.php?status=0");
	exit();
}



?>