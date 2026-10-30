<?php
	session_start();
	//echo $_SESSION["user_ipd"]
	///////////////// add to log /////////////
	include("../ipd/System_config/func.php");
	savelog3("Q",$_SESSION["userdocpass"],"");
	//////////////////////////////////////////
	session_destroy();
    print "<script language='javascript' >window.location='frm_login_docpass.php';</script>";

?>