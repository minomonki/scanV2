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
	
	$toolbar = "ZO,PA,_,BF,FW,FH,_,O4,O1,O2,O3,_,PG,PP,NP";
	
		if ($val==1){	$tbc=$toolbar;		}
		else if(($val==2) or ($val==3)){	$tbc=$toolbar;	}
		
	return $tbc;
} 

	
$group = 99;		//////////////////  for link 

$an=$_REQUEST['anID'];
$docid=$_REQUEST['docid'];
$fieldDoc = "doc".$docid;

//check secret status
include_once("../System_config/func.php");
if (chkSecret($an)==1){
		///////////////// add to log detail /////////////
		if ($_SESSION["logno"]==""){savelog2("B","By System");}
		savelogdetail($_SESSION["logno"],"F",$an,"");
		$detail=" Access deny AN=".$an;
		updatelogdetail($_SESSION["logno"],$detail);
		//////////////////////////////////////////////
	print "<script>alert ('AN : $anID นี้ถูกกำหนดเป็นข้อมูลลับ'); </script>";
	print "<script language='javascript' >window.location='show_message.php?msg=AN : $an นี้ถูกกำหนดเป็นข้อมูลลับ';</script>";
}
/*
print "an = ".$an."<br>";
print "docid= ".$docid."<br>";
print "fieldDoc= ".$fieldDoc."<br>";

print "SanID = ".$_SESSION['an']."<br>";
print "Spsw = ".$_SESSION['psw']."<br>";
print "Slogno = ".$_SESSION["logno2"]."<br>";
*/

$uc=alterna($group,$fieldDoc);

/////////////////  on standard process , in addition to keep log //////////////////////////
		///////////////// add to log detail /////////////
		include_once("../System_config/func.php");
		if ($_SESSION["logno2"]<>""){
			savelogdetail($_SESSION["logno2"],"V",$an,$docid);
		}else{
			$_SESSION["logno2"] = savelog_nonlogin("B","Bypass System");
			savelogdetail($_SESSION["logno2"],"V",$an,$docid);
		}
		//////////////////////////////////////////////
		echo "<table width='640' border='1' cellpadding='0' cellspacing='0'>";
		echo "<tr><td>";
		echo "<embed src='img_view.php?an=".$an."&docid=".$docid."&chkpass=1' width=640 height=800 access=512  type='image/tiff' negative=no toolbaritems=$uc>";
		echo "</td></tr></table>";
/////////////////   on standard process , in addition to keep log //////////////////////////
?>
<!--
<table width="640" border="1" cellpadding="0" cellspacing="0">
  <tr> 
    <td>
    
    <embed  
    src="img_view.php?an=<?=$an;?>&docid=<?=$docid?>" width=640 height=800 access=512 type="image/tiff"
    negative=no toolbaritems="<?=$uc;?>">
	
	</td>
  </tr>
</table>
-->