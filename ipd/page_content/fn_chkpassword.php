<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.style1 {color: #0000FF}
-->
</style>
</head>
<body>

<?php
$pswtxt=$_REQUEST['pswtxt'];
$an=$_REQUEST['an'];

include_once("../System_config/func.php");
include_once("../System_config/const.php");
$chkpass = chkPass2show2($an,$_REQUEST['pswtxt'],$today2);
if ($chkpass==1){
	$logno2=savelog_nonlogin("N",$pswtxt);
	echo "<meta http-equiv='refresh' content='0;URL=../show_detail.php?an=".$an."&okpass=".base64_encode(1)."&psw=".base64_encode($pswtxt)."&logno2=".base64_encode($logno2)."'>";
}else{
	//echo "4<br>";
	echo "<BR><BR><div align=center>";
	echo $chkpass;    //Wrong password ..
	echo "</div><BR>";
	echo "<form action=fn_chkpassword.php method=post>";
	echo "<BR><BR><BR><div align=center>Enter Password : <input type=password name=pswtxt maxlength=20 size=15></div>";
	echo "<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div align=center><input type=submit value=' Ok ' name=comm></div>";
	echo "<input type=hidden name=anID value=".$an." >";
	echo "</form>";
} // end if chkpass valid

?>
</body>
</html>