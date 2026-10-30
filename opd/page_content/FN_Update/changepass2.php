<?php
	
	session_start();
 
include("../../System_config/connection.php");

#$user = $_POST["username"];
$user	=$_SESSION["user"];
$pass = $_POST["password"];
$passnew = $_POST["passnew"];
$conpass = $_POST["conpass"];

#print $user."/".$pass."/".$passnew."/".$conpass."<br>";


if($passnew == $conpass){
	#print "ok"."<br>";
	$sqlLogin = "SELECT * FROM tb_opd_login WHERE username='$user' AND password='$pass'";
	$resLogin = mysql_db_query($database,$sqlLogin);
	$numLogin = mysql_num_rows($resLogin);
	#print $numLogin."<br>";
	
		if($numLogin == '0'){	 
			$status = "fail";
			header("location:../changepass.php");
			exit();
		}
		else{
			$sqlupdate = "UPDATE  tb_opd_login SET password='$passnew' WHERE username='$user'";
			#print $sqlupdate."<br>";
			$resupdate = mysql_db_query($database,$sqlupdate);
			#print $resupdate."<br>";
				if($resupdate){
					#$status = "ok";
					header("location:../changepass.php?status=1");
				}
		}
}
else{
	header("location:../changepass.php?status=0");
	exit();
}



?>