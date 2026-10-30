<?php

function savelog($action,$username,$psw){

	include("System_config/connect.php");

	//get max logno
	$query="select max(logno) from tb_ipd_logfile";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log table --> logno,username,logtype,ldate,ipaddr
	$sql = "INSERT INTO tb_ipd_logfile VALUES ('".$maxno."'";
	$sql .=",'";
	if ($action==E){
		$struser=$username."/".$psw;
		$sql .=substr($struser,0,30);
	}else{
		$sql .=$username;
	}
	$sql .="'";
	$sql .=",'".$action."'";
	$sql .=",".CURRENT_TIMESTAMP;
	$sql .=",'".$_SERVER['REMOTE_ADDR']."'";
	$sql .= ")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	if ($psw<>"no"){$_SESSION["logno"] = $maxno;}
	//echo "<br>3.logno=".$_SESSION["logno"]."<br>";
	return;

}
function savelog2($action,$username){

	include("../System_config/connect.php");

	//get max logno
	$query="select max(logno) from tb_ipd_logfile";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log table --> logno,username,logtype,ldate,ipaddr
	$sql = "INSERT INTO tb_ipd_logfile VALUES ('".$maxno."'";
	$sql=$sql.",'";
	if ($action==E){
		$struser=$username."/".$psw;
		$sql=$sql.substr($struser,0,30);
	}else{
		$sql=$sql.$username;
	}
	$sql=$sql."'";
	$sql=$sql.",'".$action."'";
	$sql=$sql.",".CURRENT_TIMESTAMP;
	$sql=$sql.",'".$_SERVER['REMOTE_ADDR']."'";
	$sql = $sql.")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	$_SESSION["logno"] = $maxno;
	//echo "<br>3.logno=".$_SESSION["logno"]."<br>";
	return;

}
function savelog3($action,$username,$psw){

	include("../ipd/System_config/connect.php");

	//get max logno
	$query="select max(logno) from tb_ipd_logfile";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log table --> logno,username,logtype,ldate,ipaddr
	$sql = "INSERT INTO tb_ipd_logfile VALUES ('".$maxno."'";
	$sql=$sql.",'";
	if ($action==E){
		$struser=$username."/".$psw;
		$sql=$sql.substr($struser,0,30);
	}else{
		$sql=$sql.$username;
	}
	$sql=$sql."'";
	$sql=$sql.",'".$action."'";
	$sql=$sql.",".CURRENT_TIMESTAMP;
	$sql=$sql.",'".$_SERVER['REMOTE_ADDR']."'";
	$sql = $sql.")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	$_SESSION["logno"] = $maxno;
	//echo "<br>3.logno=".$_SESSION["logno"]."<br>";
	return;

}

function savelog_nonlogin($action,$psw){

	include("../System_config/connect.php");
	//$username="System";
	//get max logno
	$query="select max(logno) from tb_ipd_logfile";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log table --> logno,username,logtype,ldate,ipaddr
	$sql = "INSERT INTO tb_ipd_logfile VALUES ('".$maxno."'";
	$sql .= ",'".$psw."'";
	$sql=$sql.",'".$action."'";
	$sql=$sql.",".CURRENT_TIMESTAMP;
	$sql=$sql.",'".$_SERVER['REMOTE_ADDR']."'";
	$sql = $sql.")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";
	//echo "<br>3.logno=".$_SESSION["logno"]."<br>";
	return $maxno;

}
function savelog_nonlogin2($action,$psw){

	include("System_config/connect.php");
	//$username="System";
	//get max logno
	$query="select max(logno) from tb_ipd_logfile";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log table --> logno,username,logtype,ldate,ipaddr
	$sql = "INSERT INTO tb_ipd_logfile VALUES ('".$maxno."'";
	$sql .= ",'".$psw."'";
	$sql=$sql.",'".$action."'";
	$sql=$sql.",".CURRENT_TIMESTAMP;
	$sql=$sql.",'".$_SERVER['REMOTE_ADDR']."'";
	$sql = $sql.")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";
	//echo "<br>3.logno=".$_SESSION["logno"]."<br>";
	return $maxno;

}
function savelog_nonlogin3($action,$psw){

	include("../ipd/System_config/connect.php");
	//$username="System";
	//get max logno
	$query="select max(logno) from tb_ipd_logfile";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log table --> logno,username,logtype,ldate,ipaddr
	$sql = "INSERT INTO tb_ipd_logfile VALUES ('".$maxno."'";
	$sql .= ",'".$psw."'";
	$sql=$sql.",'".$action."'";
	$sql=$sql.",".CURRENT_TIMESTAMP;
	$sql=$sql.",'".$_SERVER['REMOTE_ADDR']."'";
	$sql = $sql.")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";
	//echo "<br>3.logno=".$_SESSION["logno"]."<br>";
	return $maxno;

}

function savelogdetail($logno,$pcode,$an,$doctype){

	include("../System_config/connect.php");

	//get max items
	$query="select max(items) from tb_ipd_logfile_detail where logno=$logno";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log detail table --> logno,items,pcode,an,doctype,ldate
	$sql = "INSERT INTO tb_ipd_logfile_detail (logno,items,pcode,an,doctype,ldate) VALUES ('".$logno."'";
	$sql=$sql.",'".$maxno."'";
	$sql=$sql.",'".$pcode."'";
	$sql=$sql.",'".$an."'";
	$sql=$sql.",'".$doctype."'";
	$sql=$sql.",".CURRENT_TIMESTAMP;
	$sql = $sql.")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	return;

}
function updatelogdetail($logno,$descr){

	include("../System_config/connect.php");

	//get max items
	$query="select max(items) from tb_ipd_logfile_detail where logno=$logno";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0];}else{$maxno=1;}

	//insert to log detail table --> logno,items,pcode,an,doctype,ldate
	$sql = "UPDATE tb_ipd_logfile_detail SET descr='".$descr."' WHERE logno=$logno AND items=$maxno";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	return;

}
function savelogdetail2($logno,$pcode,$an,$doctype){

	include("../../System_config/connect.php");

	//get max items
	$query="select max(items) from tb_ipd_logfile_detail where logno=$logno";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log detail table --> logno,items,pcode,an,doctype,ldate
	$sql = "INSERT INTO tb_ipd_logfile_detail (logno,items,pcode,an,doctype,ldate) VALUES ('".$logno."'";
	$sql=$sql.",'".$maxno."'";
	$sql=$sql.",'".$pcode."'";
	$sql=$sql.",'".$an."'";
	$sql=$sql.",'".$doctype."'";
	$sql=$sql.",".CURRENT_TIMESTAMP;
	$sql = $sql.")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	return;

}
function updatelogdetail2($logno,$descr){

	include("../../System_config/connect.php");

	//get max items
	$query="select max(items) from tb_ipd_logfile_detail where logno=$logno";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0];}else{$maxno=1;}

	//insert to log detail table --> logno,items,pcode,an,doctype,ldate
	$sql = "UPDATE tb_ipd_logfile_detail SET descr='".$descr."' WHERE logno=$logno AND items=$maxno";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	return;

}
function savelogdetail3($logno,$pcode,$an,$doctype){

	include("System_config/connect.php");

	//get max items
	$query="select max(items) from tb_ipd_logfile_detail where logno=$logno";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log detail table --> logno,items,pcode,an,doctype,ldate
	$sql = "INSERT INTO tb_ipd_logfile_detail (logno,items,pcode,an,doctype,ldate) VALUES ('".$logno."'";
	$sql=$sql.",'".$maxno."'";
	$sql=$sql.",'".$pcode."'";
	$sql=$sql.",'".$an."'";
	$sql=$sql.",'".$doctype."'";
	$sql=$sql.",".CURRENT_TIMESTAMP;
	$sql = $sql.")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	return;

}
function updatelogdetail3($logno,$descr){

	include("System_config/connect.php");

	//get max items
	$query="select max(items) from tb_ipd_logfile_detail where logno=$logno";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0];}else{$maxno=1;}

	//insert to log detail table --> logno,items,pcode,an,doctype,ldate
	$sql = "UPDATE tb_ipd_logfile_detail SET descr='".$descr."' WHERE logno=$logno AND items=$maxno";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	return;

}
function savelogdetail4($logno,$pcode,$an,$doctype){  //for ipdl

	include("../ipd/System_config/connect.php");

	//get max items
	$query="select max(items) from tb_ipd_logfile_detail where logno=$logno";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0]+1;}else{$maxno=1;}

	//insert to log detail table --> logno,items,pcode,an,doctype,ldate
	$sql = "INSERT INTO tb_ipd_logfile_detail (logno,items,pcode,an,doctype,ldate) VALUES ('".$logno."'";
	$sql=$sql.",'".$maxno."'";
	$sql=$sql.",'".$pcode."'";
	$sql=$sql.",'".$an."'";
	$sql=$sql.",'".$doctype."'";
	$sql=$sql.",".CURRENT_TIMESTAMP;
	$sql = $sql.")";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	return;

}
function updatelogdetail4($logno,$descr){ //for ipdl

	include("../ipd/System_config/connect.php");

	//get max items
	$query="select max(items) from tb_ipd_logfile_detail where logno=$logno";
	//echo "<br>1.query=".$query."<br>";
	$result=mysql_query($query);
	$row = mysql_fetch_array($result);
	if ($result) {$maxno=$row[0];}else{$maxno=1;}

	//insert to log detail table --> logno,items,pcode,an,doctype,ldate
	$sql = "UPDATE tb_ipd_logfile_detail SET descr='".$descr."' WHERE logno=$logno AND items=$maxno";
	mysql_query($sql);
	//echo "<br>2.sql=".$sql."<br>";

	return;

}

/*
function chkPass2show($an,$psw,$chkdate){
	include("System_config/connect.php");
	$sql = "SELECT password,startdate,expired FROM tb_ipd_doc_setup WHERE an='$an' AND password='$psw'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($psw<>$row[0]){
		return "Invalid Password";
	}else{
		if ($row[1]<=$chkdate && $row[2]>=$chkdate){
			return 1;
		}else{
			return "Password expired";
		}
	}
	//$defaultpass="pass";
	if ($psw<>$row[0]){return 0;}else{return 1;}
	//return 0;
}
function chkPass2show2($an,$psw,$chkdate){
	include("../System_config/connect.php");
	$sql = "SELECT password,startdate,expired FROM tb_ipd_doc_setup WHERE an='$an' AND password='$psw'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($psw<>$row[0]){
		return "Invalid Password";
	}else{
		if ($row[1]<=$chkdate && $row[2]>=$chkdate){
			return 1;
		}else{
			return "Password expired";
		}
	}
	//$defaultpass="pass";
	if ($psw<>$row[0]){return 0;}else{return 1;}
	//return 0;
}
*/
function chkPass2show($an,$psw,$chkdate){
	include("System_config/connect.php");
	$sql = "SELECT substring(b.userdocpass,6),startdate,expired";
	$sql .=" FROM tb_ipd_doc_setup a, tb_ipd_doc_pass b ";
	$sql .=" WHERE a.password=b.password and an='$an' AND substring(b.userdocpass,6)='$psw'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($psw<>$row[0]){
		return "Invalid Password";
	}else{
		if ($row[1]<=$chkdate && $row[2]>=$chkdate){
			return 1;
		}else{
			return "Password expired";
		}
	}
	//$defaultpass="pass";
	if ($psw<>$row[0]){return 0;}else{return 1;}
	//return 0;
}
function chkPass2show2($an,$psw,$chkdate){
	include("../System_config/connect.php");
	$sql = "SELECT substring(b.userdocpass,6),startdate,expired";
	$sql .=" FROM tb_ipd_doc_setup a, tb_ipd_doc_pass b ";
	$sql .=" WHERE a.password=b.password and an='$an' AND substring(b.userdocpass,6)='$psw'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($psw<>$row[0]){
		return "Invalid Password";
	}else{
		if ($row[1]<=$chkdate && $row[2]>=$chkdate){
			return 1;
		}else{
			return "Password expired";
		}
	}
	//$defaultpass="pass";
	if ($psw<>$row[0]){return 0;}else{return 1;}
	//return 0;
}
function chkPass2show3($an,$psw,$chkdate){
	include("../ipd/System_config/connect.php");
	$sql = "SELECT substring(b.userdocpass,6),startdate,expired";
	$sql .=" FROM tb_ipd_doc_setup a, tb_ipd_doc_pass b ";
	$sql .=" WHERE a.password=b.password and an='$an' AND substring(b.userdocpass,6)='$psw'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($psw<>$row[0]){
		return "Invalid Password";
	}else{
		if ($row[1]<=$chkdate && $row[2]>=$chkdate){
			return 1;
		}else{
			return "Password expired";
		}
	}
	//$defaultpass="pass";
	if ($psw<>$row[0]){return 0;}else{return 1;}
	//return 0;
}

function getDoctype($doctype){
	if ($doctype==""){
		return "";
	}else{
		include("../System_config/connect.php");
		$sql = "SELECT DocTypeName FROM tb_ipd_doctype WHERE DocID='$doctype'";
		//echo $sql."<br>";
		$result=mysql_query($sql);
		$row = mysql_fetch_array($result);
		if ($result){return $row[0];}else{return;}
	}	
}

function chkDocpass($an,$password){
	include("../System_config/connect.php");
	$sql = "SELECT COUNT(*) FROM tb_ipd_doc_setup WHERE an='$an' and password='$password'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){return 1;}else{return 0;}// check exist
}

function setDocpass($an){
	include("../System_config/connect.php");
	$docpass=rand(10000,99999);
	$sql = "SELECT COUNT(*) FROM tb_ipd_doc_setup WHERE an=$an";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){
		$sql = "INSERT INTO tb_ipd_doc_setup (an,byupdate) VALUES ('$an',".CURRENT_TIMESTAMP.")";
		//echo $sql."<br>";
		mysql_query($sql);
		$sql2 = "UPDATE tb_ipd_doc_setup SET password='$docpass',byuser='System assigned',byupdate=".CURRENT_TIMESTAMP." WHERE an='$an'";
		//echo $sql2."<br>";
		mysql_query($sql2);
	}// check exist
	return $docpass;
}

function chkMinMaxLogin($col,$tblname){
	include("../System_config/connect.php");
	if ($col=="min"){
		$sql = "SELECT day( min( ldate ) ) as d , month( min( ldate ) ) as m , year( min( ldate ) )+543 as y FROM ".$tblname;
	}elseif ($col=="max"){
		$sql = "SELECT day( max( ldate ) ) as d , month( max( ldate ) ) as m , year( max( ldate ) )+543 as y  FROM ".$tblname;
	}
	//echo $sql."<br>";
	$result=mysql_query($sql);
	if ($result){
		$row = mysql_fetch_array($result);
		if (is_null($row[0])){
			return "";
		}else{
			return $row[0]."/".$row[1]."/".$row[2];
		}
	}
}

function chkMinMaxDate($col,$tblname,$isyear){
	if ($tblname=="ipt"){
		include("../System_config/connecthos.php");
	}else{
		include("../System_config/connect.php");
	}
	if ($isyear=="th"){
		$sql = "SELECT day(".$col.") as d , month(".$col.") as m , year(".$col.") as y FROM ".$tblname;
	}elseif ($isyear=="en"){
		$sql = "SELECT day(".$col.") as d , month(".$col.") as m , year(".$col.")+543 as y  FROM ".$tblname;
	}
	//echo $sql."<br>";
	$result=mysql_query($sql);
	if ($result){
		$row = mysql_fetch_array($result);
		if (is_null($row[0])){
			return "";
		}else{
			return $row[0]."/".$row[1]."/".$row[2];
		}
	}
}

function chkMinMaxFormatDate($col,$tblname,$isyear){
	if ($tblname=="ipt"){
		include("../System_config/connecthos.php");
	}else{
		include("../System_config/connect.php");
	}
	if ($isyear=="th"){
		$sql = "SELECT ".$col.", year(".$col.") as y, year(".$col.")+543 as y2 FROM ".$tblname;
	}elseif ($isyear=="en"){
		$sql = "SELECT ".$col."  FROM ".$tblname;
	}
	//echo $sql."<br>";
	$result=mysql_query($sql);
	if ($result){
		$row = mysql_fetch_array($result);
		if (is_null($row[0])){
			return "";
		}else{
			if ($isyear=="th"){
				return str_replace($row[1],$row[2],$row[0]);
			}elseif ($isyear=="en"){
				return $row[0];
			}
		}
	}//result
}

function getValue($col,$tblname,$claus){
	//if (strpos($tblname,'ipt') === true) {
		include("../System_config/connecthos.php");
	//}
	include("../System_config/connect.php");
	$sql = "SELECT ".$col." FROM ".$tblname;
	if ($claus<>""){$sql .=" WHERE ".$claus;}
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	//echo "<br>count=".$row[0]."<br>";
	if ($row[0]==0){return 0;}else{return $row[0];}
}

function getForuser($pass){
	include("../System_config/connect.php");
	//$sql = "SELECT foruser FROM tb_ipd_doc_setup where password='$pass'";
	$sql = "SELECT foruser FROM tb_ipd_doc_pass where password='$pass'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	if ($result){
		$row = mysql_fetch_array($result);
		return $row[0];
	}
}

function chkSecret($an){
	include_once("../System_config/connect.php");
	$sql = "SELECT COUNT(*) FROM tb_ipd_doc_secret WHERE an='$an'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){return 0;}else{return 1;}// check if exist , is secreted
}

function chkSecret2($an){
	include("System_config/connect.php");
	$sql = "SELECT COUNT(*) FROM tb_ipd_doc_secret WHERE an='$an'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){return 0;}else{return 1;}// check if exist , is secreted
}

function countRow($tblname){
	include("../System_config/connect.php");
	$sql = "SELECT COUNT(*) FROM ".$tblname;
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){return 0;}else{return $row[0];}
}

function countGroup($tblname,$cond,$value,$cond2,$value2){
	include("../System_config/connect.php");
	$sql = "SELECT COUNT(*) FROM ".$tblname." WHERE ".$cond." = '".$value."'";
	if ($cond2<>""){$sql .= " AND ".$cond2." = '".$value2."'";}
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){return "-";}else{return $row[0];}
}

function countRowlog($tblname,$start,$end,$tblname2){
	include("../System_config/connect.php");
	$sql = "SELECT COUNT(*) FROM ".$tblname." m";
	if ($tblname2<>""){$sql .= ",".$tblname2." b";}
	$sql .=	" WHERE m.ldate BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:59'";
	if ($tblname2<>""){$sql .= " AND m.logno=b.logno";}
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){return 0;}else{return $row[0];}
}

function chkAllow2Secret($g){
	include("../System_config/connect.php");
	$sql = "SELECT doc999 FROM tb_ipd_usergroup_detail WHERE groupID='$g'";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){return 0;}else{return 1;}// check if exist , is secreted
}

function EmptyDir($dir) {
	$handle=opendir($dir);
	while (($file = readdir($handle))!==false) {
		//echo "$file <br>";
		@unlink($dir.'/'.$file);
	}
	closedir($handle);
}


function getFormatdate($isdate,$type){
	if ($type==1){//dd/mm/yy
		$fordate= substr($isdate,8,2)."/".substr($isdate,5,2)."/".substr($isdate,0,4);
	}elseif ($type==2){// + timestamp enyr to thyr
		$thyr=substr($isdate,0,4)+543;
		$fordate= substr($isdate,8,2)."/".substr($isdate,5,2)."/".$thyr;
		$fordate .= substr($isdate,10,9);
	}elseif ($type==3){// 
		if (substr($isdate,0,4)>2500){$yrth=substr($isdate,0,4);}else{$yrth=substr($isdate,0,4)+543;}
		$fordate= substr($isdate,8,2)."/".substr($isdate,5,2)."/".$yrth;
	}
	//echo "count=".$row[0].", an=".$an." / dupan=".$dupan."<br>";
	return $fordate;
}

function getANdetail($an){
	include("../System_config/connect.php");
	$sql = "SELECT hn,firstname,lastname FROM tb_ipd WHERE an='$an' ";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($result){
		$descr="HN : ".$row[0]." ".$row[1]."&nbsp;&nbsp;".$row[2];
	}else{
		$descr="";
	}//  check if exist 
	return $descr;
}
function getANdetail2($an){
	include("../ipd/System_config/connect.php");
	$sql = "SELECT hn,firstname,lastname FROM tb_ipd WHERE an='$an' ";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if ($result){
		$descr="HN : ".$row[0]." ".$row[1]."&nbsp;&nbsp;".$row[2];
	}else{
		$descr="";
	}//  check if exist 
	return $descr;
}

function getPass($userpass){
	include("../System_config/connect.php");
	$sql = "SELECT password FROM tb_ipd_doc_pass WHERE userdocpass='".$userpass."' ";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	if ($total>0){
		$descr=$row[0];
	}else{
		$descr="";
	}//  check if exist 
	return $descr;
}

function getPassbyForuser($foruser){
	include("../System_config/connect.php");
	$sql = "SELECT password FROM tb_ipd_doc_pass WHERE foruser ='".$foruser."' ";
	//echo $sql."<br>";
	$result=mysql_query($sql);
	$total=mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	if ($total>0){
		$descr=$row[0];
	}else{
		$descr="";
	}//  check if exist 
	return $descr;
}
function check2pass($foruser){
	include("../System_config/connect.php");
	$sql = "SELECT count(*) FROM tb_ipd_doc_pass WHERE foruser ='".$foruser."' ";//order by lastupdate
	//echo "check2pass= ".$sql."<br>";
	$result=mysql_query($sql);
	//$total=mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){
		$descr=0;
	}else{
		$descr=1;
	}//  check if exist 
	return $descr;
}

function check2anForuser($foruser,$an){
	include("../System_config/connect.php");
	$sql = "SELECT count(*) FROM tb_ipd_doc_setup WHERE foruser ='".$foruser."' and an='".$an."' ";//order by lastupdate
	//echo "check2anForuser= ".$sql."<br>";
	$result=mysql_query($sql);
	//$total=mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	if ($row[0]==0){
		$descr=0;
	}else{
		$descr=1;
	}//  check if exist 
	return $descr;
}

?>