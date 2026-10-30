<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	
	include("../../System_config/connection.php");


$gid 	= $_GET["gid"];
#$did 	= $_GET["did"];
print "gid = ".$gid."<br>";
#print "did = ".$did."<br>";

$i=0;
$j=0;
	$SQLdoctype = "select * from  tb_ipd_doctype order by DocID asc";
	$RESdoctype = mysql_db_query($database,$SQLdoctype);
	$NUMdoctype = mysql_num_rows($RESdoctype);
	
	print $NUMdoctype."<br>";
	
	for($start=1;$start<=$NUMdoctype;$start++){
		
		$i=$i+1;
		$j=$j+1;
		#print $i."/".$j."<br>";

	$chkread.$i		= $_POST["chkRead$i"];
	$chkPrint.$j	= $_POST["chkPrint$j"];
	
	print "chkread[$i] = ".$_POST["chkRead$i"];
	print "chkPrint[$j] = ".$_POST["chkPrint$j"]."<br>";
	
/*
$SQLaddG = "insert into  tb_ipd_usergroup(groupID,groupname) values('$VALgid','$txtGname')";
$RESaddG = mysql_db_query($database,$SQLaddG);
if($RESaddG){
	print "<script language='javascript' >window.location='../frm_add_usergroup.php?gid=$VALgid&status=1&message=$txtGname';</script>";
}
*/

}
?>