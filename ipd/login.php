<?php

session_start();
#$logSID = session_id();

include("System_config/connection.php");
#include("connect.php");

$user = $_POST["username"];
$pass = $_POST["password"];
$pass2 = md5($_POST["password"]);

$sqlLogin = "SELECT * FROM tb_ipd_login WHERE username='$user' AND password='$pass'";
//$sqlLogin = "SELECT * FROM tb_ipd_login WHERE username='$user' AND password='$pass2'";
$resLogin = mysql_db_query($database,$sqlLogin);
$numLogin = mysql_num_rows($resLogin);

	if($numLogin == '0'){	
		///////////////// add to log /////////////
		include_once("System_config/func.php");
		savelog("E",$user,$pass);
		//////////////////////////////////////////
		print "<script>alert ('Username Or Password Incorrect..'); </script>";
	    print "<script language='javascript' >window.location='frm_login.php';</script>";
	}
	else { 
		$lastlogin = date('Y-m-d H:i:s');
		$sqllastlogin = "UPDATE tb_ipd_login SET lastLogin='$lastlogin' WHERE username='$user'";
		$reslastlogin = mysql_db_query($database,$sqllastlogin);
		
		while($typenum = mysql_fetch_array($resLogin)){
			$valType = $typenum["typeID"];
			$group = $typenum["usergroup"];
		}
			#header("location:chktype.php?type=$valType&logsid=$logSID");
			$_SESSION["user_ipd"] = $user;
			$_SESSION["PID"] = session_id();
			$_SESSION["UserType_ipd"] = $valType;
			$_SESSION["Usergroup_ipd"] = $group;
			///////////////// add to log /////////////
			include_once("System_config/func.php");
			savelog("I",$user,"");
			//////////////////////////////////////////
			//header("location:page_content/frm_search.php");
		    print "<script language='javascript' >window.location='page_content/frm_search.php';</script>";
			session_write_close();
	}
?>