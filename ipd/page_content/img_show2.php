<?php
	session_start();
	$sid = session_id();


function alterna($ug,$fieldDoc) {
	
	include ("../System_config/connection.php");
	
	$SQLtoolbar = "select $fieldDoc from tb_ipd_usergroup_detail where groupID='$ug'";
	$REStoolbar = mysql_db_query($database,$SQLtoolbar);
	while($VALtoolbar=mysql_fetch_array($REStoolbar)){
		$val = $VALtoolbar["$fieldDoc"];
	}
	
	#print "SQLtoolbar = ".$SQLtoolbar."<br>";
	#print "val= ".$val."<br>";

	$toolbar = "ZO,PA,_,BF,FW,FH,_,O4,O1,O2,O3,_,PG,PP,NP";
	
		if ($val==1){
			$tbc=$toolbar;		
		}else if(($val==2) or ($val==3)){
			//$tbc="PR,QP,SA,".$toolbar;		
			$tbc=1;
		}
		
		#print $tbc."<br>";
		
	return $tbc;
} 

	
$group  = $_SESSION["Usergroup_ipd"];
#print "group = ".$group."<br>";

//$an=$_GET['anID'];
//$docid=$_GET['docid'];
$an=$_REQUEST['anID'];
$docid=$_REQUEST['docid'];
$fieldDoc = "doc".$docid;

#print "anID = ".$anID."<br>";
#print "docid= ".$docid."<br>";
#print "fieldDoc= ".$fieldDoc."<br>";


?>
<?php
		//$uc=alterna($group,$fieldDoc);
		//echo "uc=".$uc."<br>";
if ($_REQUEST['prn']=="Print"){
		///////////////// add to log detail /////////////
		include_once("../System_config/func.php");
		savelogdetail($_SESSION["logno"],"P",$an,$docid);
		//////////////////////////////////////////////
		$uc="PR,QP";
		echo "<html><body >";
		//if ($_REQUEST['prn']=="Print"){echo "onload=window.print()>";}
			echo "<br><br><div align='center'><a href=show_detail.php?anID=".base64_encode($an).">Back</a></div><br><br>";
		echo "<table width='640' border='1' cellpadding='0' cellspacing='0'>";
			echo "<tr><td>";
			echo "<embed src='img_view.php?an=".$an."&docid=".$docid."&chkpass=1' width=640 height=800 access=512  type='image/tiff' negative=no toolbaritems=$uc>";
			echo "</td></tr></table>";
		echo "<body></html>";
}elseif ($_REQUEST['save']=="Save as"){
		///////////////// add to log detail /////////////
		include_once("../System_config/func.php");
		savelogdetail($_SESSION["logno"],"S",$an,$docid);
		//////////////////////////////////////////////
		$uc="SA";
		echo "<html><body >";
			echo "<br><br><div align='center'><a href=show_detail.php?anID=".base64_encode($an).">Back</a></div><br><br>";
		echo "<table width='640' border='1' cellpadding='0' cellspacing='0'>";
			echo "<tr><td>";
			echo "<embed src='img_view.php?an=".$an."&docid=".$docid."&chkpass=1' width=640 height=800 access=512  type='image/tiff' negative=no toolbaritems=$uc>";
			echo "</td></tr></table>";
		echo "<body></html>";

}elseif ($_REQUEST['prnall']=="Print All"){
		echo "<script language='javascript' >window.location='frm_prn_all.php?anID=".base64_encode($an)."';</script>";
}
?>
