<?php
	session_start();
	$sid = session_id();
//echo "sid=".$sid."<br>";

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

/*print "anID = ".$anID."<br>";
print "docid= ".$docid."<br>";
print "fieldDoc= ".$fieldDoc."<br>";

print "SanID = ".$_SESSION['an']."<br>";
print "Spsw = ".$_SESSION['psw']."<br>";
print "Slogno = ".$_SESSION["logno2"]."<br>";
*/
?>
<?php
if ($_SESSION['user_ipd']==""){
	///////////////// check by user for each process //////////////////////////
	// show img
	if ($_SESSION['psw']<>"" ){
		include_once("../System_config/func.php");
		include_once("../System_config/const.php");
		$chkpass = chkPass2show($an,$_SESSION['psw'],$today2);
		if ($chkpass==1){
					///////////////// add to log detail /////////////
					include_once("../System_config/func.php");
					if ($_SESSION["logno2"]<>""){savelogdetail($_SESSION["logno2"],"V",$an,$docid);}
					//////////////////////////////////////////////
					$uc = "ZO,PA,_,BF,FW,FH,_,O4,O1,O2,O3,_,PG,PP,NP";
					echo "<table width='640' border='1' cellpadding='0' cellspacing='0'>";
					echo "<tr><td>";
					echo "<embed src='img_view.php?an=".$an."&docid=".$docid."&chkpass=1' width=670 height=1000 access=512  type='image/tiff' negative=no toolbaritems=$uc>";
					echo "</td></tr></table>";
		}else{
				session_destroy();
				include_once("frm_chkpassword.php");
		}// end chkpass
	}else{
				session_destroy();
				include_once("frm_chkpassword.php");
	}// end chk is pasword && show img
	///////////////// check by user for each process //////////////////////////
}else{ //others user
		//echo "0<br>";
		$uc=alterna($group,$fieldDoc);
		//echo "uc=".$uc."<br>";
		///////////////// add to log detail /////////////
		include_once("../System_config/func.php");
		savelogdetail($_SESSION["logno"],"V",$an,$docid);
		//////////////////////////////////////////////
		if ($uc==1){
			$uc = "ZO,PA,_,BF,FW,FH,_,O4,O1,O2,O3,_,PG,PP,NP";
			//echo "<a href='img_view.php?an=".$an."&docid=".$docid."&chkpass=1' target='_blank' >Print</a>";
			//echo "<form action=frm_prn_all.php method=post>";
			//echo "<input type='submit' name='prnall' value='Print all AN'>";
			//echo "<input type=hidden name=anID value=".$an." >";
			//echo "</form>";
			echo "<form action=img_show2.php method=post>";
			echo "<input type='submit' name='prnall' value='Print All'>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<input type='submit' name='prn' value='Print'>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<input type='submit' name='save' value='Save as'>";
			echo "<input type=hidden name=anID value=".$an." >";
			echo "<input type=hidden name=docid value=".$docid." >";
			echo "</form>";
		echo "<table width='640' border='1' cellpadding='0' cellspacing='0'>";
			echo "<tr><td>";
			echo "<embed src='img_view.php?an=".$an."&docid=".$docid."&chkpass=1' width=640 height=800 access=512  type='image/tiff' negative=no toolbaritems=$uc>";
			echo "</td></tr></table>";
		}else{
			echo "<table width='640' border='1' cellpadding='0' cellspacing='0'>";
			echo "<tr><td>";
			echo "<embed src='img_view.php?an=".$an."&docid=".$docid."&chkpass=1' width=640 height=800 access=512  type='image/tiff' negative=no toolbaritems=$uc>";
			echo "</td></tr></table>";
		}//end chk toolbar
}// end if form user default
?>
