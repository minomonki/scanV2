<?php
	session_start();
	session_destroy();
	header("location:frm_login.php");
?>