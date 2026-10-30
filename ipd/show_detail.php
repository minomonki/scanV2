<?php
	session_start();
	$anID = $_GET['an'];

//check secret status
/*
include_once("System_config/func.php");
if (chkSecret2($anID)==1){
		///////////////// add to log detail /////////////
		if ($_SESSION["logno"]==""){savelog("N","HosXP");}
		savelogdetail3($_SESSION["logno"],"F",$anID,"");
		$detail=" Access deny AN=$anID ";
		updatelogdetail3($_SESSION["logno"],$detail);
		//////////////////////////////////////////////
	print "<script>alert ('AN : $anID นี้ถูกกำหนดเป็นข้อมูลลับ'); </script>";
	print "<script language='javascript' >window.location='show_message.php?msg=AN : $anID นี้ถูกกำหนดเป็นข้อมูลลับ';</script>";
}
*/
if (base64_decode($_REQUEST['okpass'])==1){
		$_SESSION['an']= $_REQUEST['an'];
		$_SESSION['psw']=base64_decode($_REQUEST['psw']);
		$_SESSION["logno2"] = base64_decode($_REQUEST['logno2']);
}	
//print "Spsw = ".$_SESSION['psw']."<br>";
	
	include ("System_config/connection.php");
	

	$g =99;
	$Xfile_Allowed  = 0;
	$SQLuserid1 = "select * from  tb_ipd_doctype order by DocID desc";
	$RESuserid1 = mysql_db_query($database,$SQLuserid1);
	$ii =0;
	while ($VALuserid1 = mysql_fetch_array($RESuserid1)){
		$countid = $VALuserid1["DocID"];
		$ii = $ii+1;
		if ($ii==2) break;
	}
	//print "g = ".$g;

    		$SQLdoc = "	select an,doctype 
						from tb_ipd_doctype_detail 
						where  (an = '$anID')
						order by doctype asc";

			$RESdoc = mysql_db_query($database,$SQLdoc);
			$NUMdoc = mysql_num_rows($RESdoc);

			
			$strpost[100];
			$i=0;
				while($VALdoc = mysql_fetch_array($RESdoc)){
					$strpost[$i]=$VALdoc['doctype'];
					$i = $i+1;
				}///////////  while
			#print "i=".$i."<br>";
	/////////////  select Firstname and Lastname 
	$SQLperson = "SELECT * FROM tb_ipd WHERE an='$anID'";
	$RESperson = mysql_db_query($database,$SQLperson);
	while ($VALperson = mysql_fetch_array($RESperson)){/////
		$hnID  = $VALperson['hn'];
		$Fname = $VALperson['firstname'];
		$Lname = $VALperson['lastname'];
	} ////////////  while
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<script type="text/javascript" src="jstree/_lib/jquery.js"></script>
	<script type="text/javascript" src="stree/_lib/jquery.cookie.js"></script>
	<script type="text/javascript" src="jstree/_lib/jquery.hotkeys.js"></script>
	<script type="text/javascript" src="jstree/jquery.jstree.js"></script>
	<script type="text/javascript" src="jstree/_docs/syntax/!script.js"></script>
    <link type="text/css" rel="stylesheet" href="jstree/_docs/syntax/!style.css"/>
	<link type="text/css" rel="stylesheet" href="jstree/_docs/!style.css"/>
<script type="text/javascript">  
var statusmsg=""

function hidestatus(){
window.status=statusmsg
return true
}

</script>
<script language="JavaScript"> <!--
var message="ไม่อนุญาตให้คลิกขวา.\n"; // Message for the alert box

// Don't edit below!

function click(e) {
if (document.all) {
if (event.button == 2) {
alert(message);
return false;
}
}
if (document.layers) {
if (e.which == 3) {
alert(message);
return false;
}
}
}
if (document.layers) {
document.captureEvents(Event.MOUSEDOWN);
}
document.onmousedown=click;
// --> 
</script>
</head>
<body>
<table width="800" height="232" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="258" valign="top">


<div id="demo3" class="demo" style="height:550px;">
	<ul>
		<li id="1" class="jstree-open">
			<label><?=$hnID?> : <?=$Fname?> <?=$Lname?></label>
			<ul>
				<li id="<?=$anID?>" class="jstree-open">
					<label>AN : <?=$anID?></a></label
                    ><ul>
                   	<?php  
//////////////   Qry permis
	$val[30];
	$a=0;
	$SQLper = "select * from tb_ipd_usergroup_detail where (groupID = '$g')";
	#print $SQLper."<br>";
	$RESper = mysql_db_query($database,$SQLper);
	$VALper = mysql_fetch_array($RESper);
	for($a='0';$a<=$countid;$a++){	///////////  loop for 1
		$val[$a] =	$VALper["doc$a"];
		#print "doc".$a."=".$VALper["doc$a"]."<br>";
	  	$y = $y+1;
	}///////  loop for 1
	$val[$a] =	$VALper["doc999"];
///////////////////////////  end qry permis
					#print "TTTTYYYY<br>";
					
					$SQLshowdoc = "select * from tb_ipd_doctype order by DocID";
					$RESshowdoc = mysql_db_query($database,$SQLshowdoc);
						
							#print "v$y = ".$val[$y]."<br>";
				$b =0;
						#while($b<=$y){ 
						#$b=$b+1;
							#print "b=".$b."<br>";
						#}
						$chkOther = 0;
						while($VALshowdoc = mysql_fetch_assoc($RESshowdoc)){  ////////loop while 1
					      
						  	$docid 		= $VALshowdoc["DocID"];
							$docname 	= $VALshowdoc["DocTypeName"];
							$doctype	= $VALshowdoc["DocType"];
							if (strlen($doctype)>3){
								$rest = substr($doctype, -1);
								$stru = strtoupper($rest);
								if ($stru=='S')
									{$chksec = 1;}
								else
									{$chksec = 0;}
							}
							else{
								 $chksec = 0;
							}							
							if ($val[$b] != 0) {						
								for ($c=0;$c<=($i-1);$c++){
								if($docid == $strpost[$c] ){ #$strpost[$c]
								if ($docid <> 999){
										if(($docid == 0) &&($strpost[$c] ==0))
										{	$chkOther = 1;
											$tmpDocID =$docid;
											$tmpDocName =$docname;
										 }	
										else{
											if ($chksec != 1){
											print "<li id=\"$anID\" id2=\"$docid\"><a onMouseover='return hidestatus()' onMouseOut='return hidestatus()' href=\"#\">$docname</a></li>";
											} 
									 		}
									}
									else{
										if ($Xfile_Allowed ==3){
										  if ($chksec != 1){
										  print "<li id=\"$anID\" id2=\"$docid\"><a onMouseover='return hidestatus()' onMouseOut='return hidestatus()' href=\"#\">$docname</a></li>";	}							
										}
									}
									#else {print "aaaa";}
									}
								}
							} ///// end loop if 	
						  #}//// end loop for 
						  $b = $b+1;
						  //if ($b==$countid+2) $b=0;
						  #print "b=".$b."<br>";
						} ///// end loop while
						if ($chkOther == 1) {
							if ($chksec != 1){
							print "<li id=\"$anID\" id2=\"$tmpDocID\"><a onMouseover='return hidestatus()' onMouseOut='return hidestatus()' href=\"#\">$tmpDocName</a></li>";}
							}
					?>
                    </ul>
				</li>
			</ul>
		</li>
	</ul>
</div>


<!--  Start Java Script -->
<script type="text/javascript" class="source below">
$(function () {
	$("#demo3")
		.jstree({ "plugins" : ["themes","html_data","ui"] })
		// 1) if using the UI plugin bind to select_node
		.bind("select_node.jstree", function (event, data) { 
			// `data.rslt.obj` is the jquery extended node that was clicked
			//alert(data.rslt.obj.attr("id"));
			
			var id = data.rslt.obj.attr("id");
			var id2 = data.rslt.obj.attr("id2");
			//var tmp = data.rslt.obj.attr("doctype");
			//alert(data.rslt.obj.attr("id2"));
			//$ajax()
			$.ajax({
			  //url: "test.php?id="+id,
			  //url: "conf_inc_page.php?id="+id,
	      	    url: "img_show.php?anID="+id+"&docid="+id2,
			  success: function(data){
					$('#div_content').html(data);	
					
			  }
			});
			
		})
		// 2) if not using the UI plugin - the Anchor tags work as expected
		//    so if the anchor has a HREF attirbute - the page will be changed
		//    you can actually prevent the default, etc (normal jquery usage)
		.delegate("a", "click", function (event, data) { event.preventDefault(); })
});
</script>
<!-- End Java Script -->
    </td>
    <td width="542" valign="top" id='div_content'></td>
  </tr>
</table>

</body>
</html>