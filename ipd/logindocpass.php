<?php

session_start();
#$logSID = session_id();

include("System_config/connection.php");
#include("connect.php");

$pass = $_POST["password"];
$pass2 = md5($_POST["password"]);

$sqlLogin = "SELECT * FROM tb_ipd_doc_pass WHERE userdocpass='$pass'";
//$sqlLogin = "SELECT * FROM tb_ipd_login WHERE username='$user' AND password='$pass2'";
$resLogin = mysql_db_query($database,$sqlLogin);
$numLogin = mysql_num_rows($resLogin);

	if($numLogin == '0'){	
		///////////////// add to log /////////////
		include_once("System_config/func.php");
		savelog("E",$user,$pass);
		//////////////////////////////////////////
		print "<script>alert ('Password Incorrect..'); </script>";
	    print "<script language='javascript' >window.location='frm_login_docpass.php';</script>";
	}else { 
			$_SESSION["userdocpass"] = $pass;
			$_SESSION["PID"] = session_id();
			//$_SESSION["UserType_ipd"] = $valType;
			//$_SESSION["Usergroup_ipd"] = $group;
			///////////////// add to log /////////////
			include_once("System_config/func.php");
			$_SESSION["lognodocpass"] =savelog_nonlogin2("N",$pass);
			//////////////////////////////////////////
			//header("location:page_content/frm_search.php");
		    print "<script language='javascript' >window.location='log/frm_show_docpass.php';</script>";
			session_write_close();
	}
?>