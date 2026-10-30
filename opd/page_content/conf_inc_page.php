<?php

include ("../System_config/connection.php");


$pageContent = $_GET['id'];
print $pageContent."<br>";

#$SQLan = "SELECT an FROM ipt_local WHERE an='500002609']'";
#print $SQLan."<br>";
#$RESan = mysql_db_query($database,$SQLan);
#$VALan = mysql_fetch_array($RESan);
#$pagecontent = $VALan['an'];
/*
if(isset($id)){
	switch($id){
		case 'shtml_1-1-1'		:	$pageContent = "http://www.google.com";			break;
		case 'shtml_1-1-2'		:	$pageContent = "http://www.kapook.com";			break;
		case 'shtml_1-1-3'		:	$pageContent = "http://www.sanook.com";			break;
		case 'shtml_1-1-4'		:	$pageContent = "http://www.yahoo.co.th";		break;
	}
}
else{
	$pageContent = "http://www.rmutsb.ac.th";
}

*/
?>

<iframe name="frame" src="img_view.php?anID=<?=$pageContent;?>" scrolling="auto" frameborder="1" width="600" height="600"></iframe>