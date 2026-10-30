<?php
	session_start();
	//echo $_SESSION["user_ipd"]
	///////////////// add to log /////////////
	include("System_config/func.php");
	savelog("O",$_SESSION["user_ipd"],"");
	//////////////////////////////////////////
	session_destroy();
	//header("location:frm_login.php");
    print "<script language='javascript' >window.location='frm_login.php';</script>";

?>