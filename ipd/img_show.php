<?php
	session_start();
	$sid = session_id();


function alterna($ug,$fieldDoc) {
	
	include ("System_config/connection.php");
	
	$SQLtoolbar = "select $fieldDoc from tb_ipd_usergroup_detail where groupID='$ug'";
	$REStoolbar = mysql_db_query($database,$SQLtoolbar);
	while($VALtoolbar=mysql_fetch_array($REStoolbar)){
		$val = $VALtoolbar["$fieldDoc"];
	}
	
	$toolbar = "ZO,PA,_,BF,FW,FH,_,O4,O1,O2,O3,_,PG,PP,NP";
	
			$tbc=$toolbar;		
		
		
	return $tbc;
} 

	
$group = 99;		//////////////////  for link 

$an=$_REQUEST['anID'];
$docid=$_REQUEST['docid'];
$fieldDoc = "doc".$docid;
/*
print "an = ".$an."<br>";
print "docid= ".$docid."<br>";
print "fieldDoc= ".$fieldDoc."<br>";

print "SanID = ".$_SESSION['an']."<br>";
print "Spsw = ".$_SESSION['psw']."<br>";
print "Slogno = ".$_SESSION["logno2"]."<br>";
*/

//$uc=alterna($group,$fieldDoc);

///////////////// check by user for each process //////////////////////////
	// show img
	if ($_SESSION['psw']<>"" ){
		//echo "1<br>";
		include_once("System_config/func.php");
		include_once("System_config/const.php");
		$chkpass = chkPass2show($an,$_SESSION['psw'],$today2);
		if ($chkpass==1){
					///////////////// add to log detail /////////////
					include_once("System_config/func.php");
					if ($_SESSION["logno2"]<>""){savelogdetail3($_SESSION["logno2"],"V",$an,$docid);}
					//////////////////////////////////////////////
					$uc = "ZO,PA,_,BF,FW,FH,_,O4,O1,O2,O3,_,PG,PP,NP";
					echo "<table width='640' border='1' cellpadding='0' cellspacing='0'>";
					echo "<tr><td>";
					echo "<embed src='img_view.php?an=".$an."&docid=".$docid."&chkpass=1' width=670 height=1000 access=512  type='image/tiff' negative=no toolbaritems=$uc>";
					echo "</td></tr></table>";
		}else{
				session_destroy();
				include_once("page_content/frm_chkpassword.php");
		}// end chkpass
	}else{
				//echo "2<br>";
				session_destroy();
				include_once("page_content/frm_chkpassword.php");
	}// end chk is pasword && show img
	///////////////// check by user for each process //////////////////////////
?>
<!--
<table width="640" border="1" cellpadding="0" cellspacing="0">
  <tr> 
    <td>
    
    <embed  
    src="img_view.php?an=<?=$an;?>&docid=<?=$docid?>" width=670 height=1000 access=512 type="image/tiff"
    negative=no toolbaritems="<?=$uc;?>">
	
	</td>
  </tr>
</table>
-->