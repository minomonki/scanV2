<?php
	session_start();
	//echo $_SESSION["user_ipd"]
	///////////////// add to log /////////////
	include("System_config/func.php");
	savelog("O",$_SESSION["userdocpass"],"");
	//////////////////////////////////////////
	session_destroy();
    print "<script language='javascript' >window.location='frm_login_docpass.php';</script>";

?>