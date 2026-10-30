<?php

session_start();
#$logSID = session_id();

include("../ipd/System_config/connection.php");
#include("connect.php");

$pass = $_POST["password"];
$pass2 = md5($_POST["password"]);

$col ="left( userdocpass, 5 ) AS pas, substring( userdocpass, 6 ) AS usrdoc";
$sqlLogin = "SELECT ".$col." FROM tb_ipd_doc_pass WHERE substring(userdocpass,6)='$pass'";
//echo "s= ".$sqlLogin."<br>";
$resLogin = mysql_db_query($database,$sqlLogin);
$numLogin = mysql_num_rows($resLogin);
$row = mysql_fetch_array($resLogin);
	if($numLogin == '0'){	
		///////////////// add to log /////////////
		include_once("../ipd/System_config/func.php");
		savelog3("E",$user,$pass);
		//////////////////////////////////////////
		print "<script>alert ('Password Incorrect..'); </script>";
	    print "<script language='javascript' >window.location='frm_login_docpass.php';</script>";
	}else { 
			$syspass= $row[0];
			$_SESSION["userdocpass"] = $pass;
			///////////////// add to log /////////////
			include_once("../ipd/System_config/func.php");
			$_SESSION["lognodocpass"] =savelog_nonlogin3("L",$syspass);
			//////////////////////////////////////////
		    print "<script language='javascript' >window.location='frm_show_docpass.php?syspass=$syspass';</script>";
			session_write_close();
	}
?>