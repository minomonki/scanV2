<?php
$ug=1;

	include ("../System_config/connection.php");
	
	$SQLtoolbar = "select * from tb_ipd_usergroup_detail where groupID='$ug'";
	$REStoolbar = mysql_db_query($database,$SQLtoolbar);

	while($VALtoolbar=mysql_fetch_array($REStoolbar)){
		$val = $VALtoolbar["doc4"];
	}
	
	print "SQLtoolbar = ".$SQLtoolbar."<br>";
	print "VALtoolbar= ".$val."<br>";
?>