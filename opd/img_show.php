<?php
	session_start();
	$sid = session_id();
	$g  = $_SESSION["Usergroup"];


function alterna($ug,$fieldDoc) {
	
include ("System_config/connection.php");
	
	$SQLtoolbar = "select $fieldDoc from tb_opd_group_detail where groupID='$ug'";
	#print $SQLtoolbar;
	$REStoolbar = mysql_db_query($database,$SQLtoolbar);
	while($VALtoolbar=@mysql_fetch_array($REStoolbar)){
		$val = $VALtoolbar["$fieldDoc"];
	}
	
	#print "SQLtoolbar = ".$SQLtoolbar."<br>";
	#print "val= ".$val."<br>";

	$toolbar = "ZO,PA,_,BF,FW,FH,_,O4,O1,O2,O3,_,PG,PP,NP";
	
		$tbc=$toolbar;
		
		#print $tbc."<br>";
		
	return $tbc;
} 

	
$hnID=$_GET['hnID'];
$vn=$_GET['vn'];
$docid =$_GET['docid'];
$fieldDoc = "doc".$docid;

#print "anID = ".$anID."<br>";
#print "docid= ".$docid."<br>";
#print "fieldDoc= ".$fieldDoc."<br>";

$uc=alterna($g,$fieldDoc);

?>
<table width="640" border="1" cellpadding="0" cellspacing="0">
  <tr> 
    <td>
    <?php if (is_numeric($docid)) { ?>
    <embed  
  	  	src="img_view.php?hnID=<?=$hnID;?>&vn=<?=$vn?>&docid=<?=$docid?>" width=670 height=1000 access=512 type="image/tiff"
    	negative=no toolbaritems="<?=$uc;?>">
	<?php }
	   else{
		?>
		<tr><td bgcolor="#000000" width="670" height="1000"></td></tr><?php }?>
	</td>
  </tr>
</table>