<?php

session_start();
#$logSID = session_id();

include("System_config/connection.php");
#include("connect.php");


$user = $_POST["username"];
$pass = $_POST["password"];



$sqlLogin = "SELECT * FROM tb_opd_login WHERE username='$user' AND password='$pass'";
$resLogin = mysql_db_query($database,$sqlLogin);
$numLogin = mysql_num_rows($resLogin);

	if($numLogin == '0'){	
		print "<script>alert ('Username Or Password Incorrect..'); </script>";
	    print "<script language='javascript' >window.location='frm_login.php';</script>";
	}
	else { 
		$lastlogin = date('Y-m-d H:i:s');
		$sqllastlogin = "UPDATE tb_login SET lastLogin='$lastlogin' WHERE username='$user'";
		$reslastlogin = mysql_db_query($database,$sqllastlogin);
		
		while($typenum = mysql_fetch_array($resLogin)){
			$valType = $typenum["typeID"];
			$group = $typenum["usergroup"];
		}
			#header("location:chktype.php?type=$valType&logsid=$logSID");
			$_SESSION["user"] = $user;
			$_SESSION["PID"] = session_id();
			$_SESSION["UserType"] = $valType;
			$_SESSION["Usergroup"] = $group;
			header("location:page_content/frm_search.php");
			
			
			session_write_close();
	}
?>