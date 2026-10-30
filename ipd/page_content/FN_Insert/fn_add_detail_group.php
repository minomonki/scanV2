<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />

<?php
	
	include("../../System_config/connection.php");


$gid 	= $_GET["gid"];
$manage_doc		= $_POST["manage_doc"];
$manage_user	= $_POST["manage_user"];
$del_list		= $_POST["del_list"];
$readXfile		= $_POST["readXfile"];
$view_log		= $_POST["view_log"];
$set_docpass		= $_POST["set_docpass"];
$set_docsecret		= $_POST["set_docsecret"];
$view_ansum		= $_POST["view_ansum"];

if($manage_doc==""){ $manage_doc = 0;}
if($manage_user==""){ $manage_user = 0;}
if($del_list==""){ $del_list = 0;}
if($readXfile==""){ $readXfile = 0;}

//===Get CountDOcID========
	$SQLuserid1 = "select * from  tb_ipd_doctype order by DocID desc";
	$RESuserid1 = mysql_db_query($database,$SQLuserid1);
	$ii =0;
	while ($VALuserid1 = mysql_fetch_array($RESuserid1)){
		$countid = $VALuserid1["DocID"];
		$ii = $ii+1;
		if ($ii==2) break;
	}
#print "gid = ".$gid."<br>";

$SQLaddpermiss = "update tb_ipd_usergroup_detail set manage_doc='$manage_doc',manage_user='$manage_user',del_list='$del_list',doc999='$readXfile',view_log='$view_log',set_docpass='$set_docpass',set_docsecret='$set_docsecret',view_ansum='$view_ansum',  ";
	
for($start=0;$start<=$countid;$start++){
	$SQLaddpermiss =  $SQLaddpermiss."Doc$start='".returnPermission($_POST["chkPermission$start"])."'";#,";
	$xlog .="Doc$start=".returnPermission($_POST["chkPermission$start"])."";
		if($start<$countid){
			$SQLaddpermiss = $SQLaddpermiss.",";
			$xlog .= ",";
		}
}
$SQLaddpermiss =  $SQLaddpermiss." where groupID='$gid'";
$xlog .=  " where groupID=$gid";

$RESaddpermiss = mysql_db_query($database,$SQLaddpermiss);
if($RESaddpermiss){
///////////////// add to log detail /////////////
include_once("../../System_config/func.php");
savelogdetail2($_REQUEST["logno"],"U","","");
$detail ="update tb_ipd_usergroup_detail set manage_doc=$manage_doc,manage_user=$manage_user,del_list=$del_list,doc999=$readXfile,view_log=$view_log,view_ansum=$view_ansum, ".$xlog;
updatelogdetail2($_REQUEST["logno"],$detail);
//////////////////////////////////////////////
	//print "(1)";
	print "<script language='javascript' >window.location='../show_usergroup.php?status=1';</script>";
}
else{
	//print "(0)";
	print "<script language='javascript' >window.location='../show_usergroup.php?status=0';</script>";	
}


#print "manage_doc = ".$manage_doc."<br>";
#print "manage_user = ".$manage_user."<br>";
#print "del_list = ".$del_list."<br>";
#print "query is ".$SQLaddpermiss;

function returnPermission($input){
	#print "count = ".count($input);
	
	$count = count($input);
	
	if($count == 0){
		#print " return 0"."<br>";
		return "0";
	}
	else if($count == 2){
		#print " return 3"."<br>";
		return "3";		
	}
	else{
		#print " return ".$input[0]."<br>";
		return $input[0];		
	}
}
?>