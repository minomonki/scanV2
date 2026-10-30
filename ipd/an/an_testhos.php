<?php

/*$hostDB = "192.168.1.10";
$userDB = "sa";
$passDB = "sa";*/

$hostDB = "192.168.1.10";
$userDB = "sa";
$passDB = "sa";

//Open a connection to a MySQL Server
	$link = mysql_connect($hostDB,$userDB,$passDB); 
	if (!$link) {
		die('Could not connect: ' .mysql_errno($link) . " : ". mysql_error($link));
	}
else{
echo 'Connected successfully<br>';
}
//Database selection
	$db_selected = mysql_select_db('hos', $link);
	if (!$db_selected) {
		die('Can\'t use database: ' .mysql_errno($link) ." : ".mysql_error($link));
	}
else{
echo 'Connect DB<br>';
}

	$charset = "SET character_set_client=tis620";
	$charset2 = "SET character_set_results=tis620";
	$charset3 = "SET character_set_connection=tis620";
	mysql_query($charset) or die('Invalid query: ' . mysql_error()); 
	mysql_query($charset2) or die('Invalid query: ' . mysql_error()); 
	mysql_query($charset3) or die('Invalid query: ' . mysql_error()); 

#####################################################
$select="select * "; //, sum( pages ) as pages
$from=" from hos.ipt ";
$query =$select.$from.$where.$groupby;
$query .=" order by dchdate desc LIMIT 0,10";
//echo $query."<br>";
$result=mysql_query($query);$id=1;
if ($result) {
		if ($id==1){
		echo "<div align='center' class='hdtable'>TABLE HOS.IPT</div>";
		echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
		echo "<tr bgcolor='#a9a9a9'>";
		echo "<td align='center' class='hdtable' width='10%'>dchdate</td>";
		echo "<td align='center' class='hdtable' width='30%'>AN</td>";
		echo "<td align='center' class='hdtable' width='30%'>HN</td>";
		echo "</tr>";
		}
	while($row = mysql_fetch_array($result)){
	if (fmod($i,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
	echo "<tr".$rcolor.">";
	echo "<td align='center' class='listdetail'>".$row['dchdate']."</td>";
	echo "<td align='center' class='listdetail'>".$row['an']."</td>";
	echo "<td align='center' class='listdetail'>".$row['hn']."</td>";
	echo "</tr>";
			$id++;
}//end while
echo "</table>";
}else{//no record found
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
	echo "<BR><BR><div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div><BR>";
}// end of if chk $result

echo "<BR><BR>";
#####################################################
$select="select * "; //, sum( pages ) as pages
$from=" from hos.opduser ";
$query =$select.$from.$where.$groupby;
$query .=" order by loginname desc LIMIT 0,10";
//echo $query."<br>";
$result=mysql_query($query);$id=1;
if ($result) {
	while($row = mysql_fetch_array($result)){
		if ($id==1){
		echo "<div align='center' class='hdtable'>TABLE HOS.OPDUSER</div>";
		echo "<table class='rowh' align='center' width='70%' cellspacing='1' cellpadding='1' border='0'>";// create table title
		echo "<tr bgcolor='#a9a9a9'>";
		echo "<td align='center' class='hdtable' width='10%'>loginname</td>";
		echo "<td align='center' class='hdtable' width='30%'>name</td>";
		echo "<td align='center' class='hdtable' width='30%'>groupname</td>";
		echo "</tr>";
		}
	if (fmod($i,2)) {$rcolor=' bgcolor=#f5deb3';}else{$rcolor=' bgcolor=#ffbb77';}
	echo "<tr".$rcolor.">";
	echo "<td align='center' class='listdetail'>".$row['loginname']."</td>";
	echo "<td align='center' class='listdetail'>".$row['name']."</td>";
	echo "<td align='center' class='listdetail'>".$row['groupname']."</td>";
	echo "</tr>";
			$id++;
}//end while
echo "</table>";
}else{//no record found
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
	echo "<BR><BR><div class='blackb' align='center'>======== ไม่พบข้อมูล ========</div><BR>";
}// end of if chk $result


?>