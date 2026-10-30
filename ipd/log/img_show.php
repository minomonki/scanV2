<?php
	session_start();
	$sid = session_id();


function alterna($ug,$fieldDoc) {
	
	include ("../System_config/connection.php");
	/*
	$SQLtoolbar = "select $fieldDoc from tb_ipd_usergroup_detail where groupID='$ug'";
	$REStoolbar = mysql_db_query($database,$SQLtoolbar);
	while($VALtoolbar=mysql_fetch_array($REStoolbar)){
		$val = $VALtoolbar["$fieldDoc"];
	}
	
	$toolbar = "ZO,PA,_,BF,FW,FH,_,O4,O1,O2,O3,_,PG,PP,NP";
	
		if ($val==1){	$tbc=$toolbar;		}
		else if(($val==2) or ($val==3)){	$tbc=$toolbar;	}*/
	$toolbar = "ZO,PA,_,BF,FW,FH,_,O4,O1,O2,O3,_,PG,PP,NP";
	$tbc=$toolbar;	
	return $tbc;
} 

	
$group = 99;		//////////////////  for link 

$an=$_GET['anID'];
$docid=$_GET['docid'];
$fieldDoc = "doc".$docid;


$uc=alterna($group,$fieldDoc);

///////////////// add to log detail /////////////
include_once("../System_config/func.php");
if ($_SESSION["lognodocpass"]<>""){
	savelogdetail($_SESSION["lognodocpass"],"V",$an,$docid);
}
//////////////////////////////////////////////
?>
<table width="640" border="1" cellpadding="0" cellspacing="0">
  <tr> 
    <td>
    
    <embed  
    src="img_view.php?an=<?=$an;?>&docid=<?=$docid?>" width=640 height=800 access=512 type="image/tiff"
    negative=no toolbaritems="<?=$uc;?>">
	
	</td>
  </tr>
</table>