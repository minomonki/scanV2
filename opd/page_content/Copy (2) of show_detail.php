<?php
	session_start();
	
	include ("../System_config/connection.php");

	$g  = $_SESSION["Usergroup"];

	//////////////   Qry permis
	$val[30];
	$y=1;
	$SQLper = "select * from tb_opd_group_detail where (groupID = '$g')";
	$RESper = mysql_db_query($database,$SQLper);
	while ($VALper = mysql_fetch_array($RESper))
	{
		$Xfile_Allowed  = $VALper['doc999'];
	}
	
	$SQLuserid1 = "select * from  tb_opd_doctype order by doctype_id desc";
	$RESuserid1 = mysql_db_query($database,$SQLuserid1);
	$ii =0;
	while ($VALuserid1 = mysql_fetch_array($RESuserid1))
	{
		$countid = $VALuserid1["doctype_id"];
		$ii = $ii+1;
		if ($ii==2) 
			break;
	}
	#print "countid = ".$countid;
	///////////////////////////  end qry permis
	
	$hnID  	= $_GET['hnID'];
	$bGroupBy = false;
	if($_GET['groupBy'] == "true")
		$bGroupBy = true;
	 
	#print "hnID=".$hnID."<br>";
    $SQLdoc = "	select vn,hn,doctype_id
				from tb_opd
				where  (hn = '$hnID') 
				order by doctype_id asc";
	#print $SQLdoc."<br>";
	$RESdoc = mysql_db_query($database,$SQLdoc);
	$NUMdoc = mysql_num_rows($RESdoc);
	#print "<br>num = ".$NUMdoc."<br>";
			
	$strpost[100];
	$i=0;
	#for ($i='1';$i=$NUMdoc;$i++){
	while($VALdoc = mysql_fetch_array($RESdoc))
	{
		$strpost[$i]=$VALdoc['doctype_id'];
		$i = $i+1;
		#print "i = ".$i."<br>";
		#print "<br>";
		#print "value =".$strpost[$i]=$VALdoc['doctype_id']."<br>";
	}
	#}
	
	/////////////  select Firstname and Lastname 
	$SQLperson = "SELECT * FROM tb_opd WHERE hn='$hnID'";
	$RESperson = mysql_db_query($database,$SQLperson);
	while ($VALperson = mysql_fetch_array($RESperson))
	{
		$hnID  = $VALperson['hn'];
		$Fname = $VALperson['firstname'];
		$Lname = $VALperson['lastname'];
		#$Xn = $VALperson['doctype_id'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>:: รายละเอียด ::</title>
	 	<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../jstree/_lib/jquery.js"></script>
	<script type="text/javascript" src="../jstree/_lib/jquery.cookie.js"></script>
	<script type="text/javascript" src="../jstree/_lib/jquery.hotkeys.js"></script>
	<script type="text/javascript" src="../jstree/jquery.jstree.js"></script>
	<script type="text/javascript" src="../jstree/_docs/syntax/!script.js"></script>
    <link type="text/css" rel="stylesheet" href="../jstree/_docs/syntax/!style.css"/>
	<link type="text/css" rel="stylesheet" href="../jstree/_docs/!style.css"/>
<script language="JavaScript">
var message="ไม่อนุญาตให้คลิกขวา.\n"; // Message for the alert box

// Don't edit below!
function click(e) 
{
	if (document.all) 
	{
		if (event.button == 2) 
		{
			alert(message);
			return false;
		}
	}

	if (document.layers) 
	{
		if (e.which == 3) 
		{
			alert(message);
			return false;
		}
	}
}

if (document.layers) 
{
	document.captureEvents(Event.MOUSEDOWN);
}

document.onmousedown=click;
</script>

</head>

<body>
<table width="800" height="232" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="258" valign="top">
	<table>
		<tr>
			<td>
				<input <?php if($bGroupBy == true) { echo "checked"; } ?> type="checkbox" name="groupCategory" value="groupCategory" onclick="if(this.checked == true){var url = document.URL + '&groupBy=true'; window.location = url;} else{var url = document.URL; url = url.replace('&groupBy=true',''); window.location = url;}"/> <?php if($bGroupBy == true) { echo ""; } ?> <br />
			</td>
		</tr>
		<tr>
			<td>
	<?php
		// If users want to group by category
		if($bGroupBy == true)
		{
	?>
				<div id="demo3" class="demo" style="height:700px;">
					<ul>
						<li id="shtml_1" class="jstree-open">
						<label><?=$hnID?> : <?=$Fname?>   <?=$Lname?></label>
						<ul>
	<?php
							$sqlCMD = "select doctype_id from tb_opd where hn = '$hnID' group by doctype_id";
							$records = mysql_db_query($database,$sqlCMD);
							while ($record = mysql_fetch_array($records))
							{
								// Lookup doctype_name and display.
								$doctypeID = $record["doctype_id"];
								$sqlCMD = "select * from tb_opd_doctype where doctype_id = $doctypeID";
								$recordDocs = mysql_db_query($database,$sqlCMD);
								$recordDoc = mysql_fetch_array($recordDocs);
	?>
								<li id="shtml_1-1" class="jstree-open">		<!--LI 2 -->
								<label><?php echo "[ " . $recordDoc["DocTypeName"] . " ]";?></label>
								<ul>
	<?php
									$sqlCMD = "select * from tb_opd where hn = '$hnID' and doctype_id = $doctypeID";
									$recordRows = mysql_db_query($database,$sqlCMD);
									while ($recordRow = mysql_fetch_array($recordRows))
									{
										//echo $recordRow["dater"] . ", " . $recordDoc["DocTypeName"] . ", VN : " . $recordRow["vn"];
										$day = $recordRow['dater'];
										$y = substr($day,0,4);
										$m = substr($day,5,2);
										$d = substr($day,8,2);
										
										if($m=="01"){ $m="ม.ค.";}
										else if($m=="02"){ $m="ก.พ.";}
										else if($m=="03"){ $m="มี.ค.";}
										else if($m=="04"){ $m="เม.ย.";}
										else if($m=="05"){ $m="พ.ค.";}
										else if($m=="06"){ $m="มิ.ย.";}
										else if($m=="07"){ $m="ก.ค.";}
										else if($m=="08"){ $m="ส.ค.";}
										else if($m=="09"){ $m="ก.ย.";}
										else if($m=="10"){ $m="ต.ค.";}
										else if($m=="11"){ $m="พ.ย.";}
										else { $m="ธ.ค.";}
								
										$Gday = $d." ".$m." ".$y;
	?>
										<li id="<?=$hnID?>" id2="<?=$recordRow["vn"]?>"  id3="<?=$doctypeID?> ">
										<a href="#"><?=$Gday?> [ <?=$recordDoc["DocTypeName"]?> ]  VN : <?=$recordRow["vn"]?></a>
										</li>
	<?php
									}
	?>
								</ul>
								</li>
	<?php
							}
	?>
						</ul>
						</li>
					</ul>
				</div>
	<?php
		}
		else
		{
	?>
				<div id="demo3" class="demo" style="height:700px;">
					<ul> <!-- UL 1-->
						<li id="shtml_1" class="jstree-open"> <!--LI 1 -->
						<label><?=$hnID?> : <?=$Fname?>   <?=$Lname?></label>
						<ul><!-- UL 2-->
	<?php
							$SQLmonth = "select left(dater,7) as montth,vn ,dater from tb_opd where hn = '$hnID'  GROUP BY  left(dater,7) order by left(dater,7) desc ";
							$SQLmonth = mysql_db_query($database,$SQLmonth);
							////////////////     while 1  main
							while ($VALmonth = mysql_fetch_array($SQLmonth))
							{   
								$mm = $VALmonth['montth'];
								$y = substr($mm,0,4);
								$m = substr($mm,5,2);
					
								if($m=="01"){ $m="ม.ค.";}
								else if($m=="02"){ $m="ก.พ.";}
								else if($m=="03"){ $m="มี.ค.";}
								else if($m=="04"){ $m="เม.ย.";}
								else if($m=="05"){ $m="พ.ค.";}
								else if($m=="06"){ $m="มิ.ย.";}
								else if($m=="07"){ $m="ก.ค.";}
								else if($m=="08"){ $m="ส.ค.";}
								else if($m=="09"){ $m="ก.ย.";}
								else if($m=="10"){ $m="ต.ค.";}
								else if($m=="11"){ $m="พ.ย.";}
								else { $m="ธ.ค.";}
						
								$Gmonth = $m."-".$y;
	?>
							
							<li id="shtml_1-1" class="jstree-open">		<!--LI 2 -->
							<label><?=$Gmonth?></label>
							<ul><!-- UL 3-->
	<?php
								$SQLdate = " SELECT vn,dater,hn,doctype_id FROM tb_opd WHERE (left(dater,7) = '$mm' ) and (hn='$hnID') order by dater desc  ";
								#print  $SQLdate;
								$RESdate = mysql_db_query($database,$SQLdate);
								////////////////     while 2 sub
								while ($VALdate = mysql_fetch_array($RESdate))
								{   
									$day = $VALdate['dater'];
									$y = substr($day,0,4);
									$m = substr($day,5,2);
									$d = substr($day,8,2);
										
									if($m=="01"){ $m="ม.ค.";}
									else if($m=="02"){ $m="ก.พ.";}
									else if($m=="03"){ $m="มี.ค.";}
									else if($m=="04"){ $m="เม.ย.";}
									else if($m=="05"){ $m="พ.ค.";}
									else if($m=="06"){ $m="มิ.ย.";}
									else if($m=="07"){ $m="ก.ค.";}
									else if($m=="08"){ $m="ส.ค.";}
									else if($m=="09"){ $m="ก.ย.";}
									else if($m=="10"){ $m="ต.ค.";}
									else if($m=="11"){ $m="พ.ย.";}
									else { $m="ธ.ค.";}
								
									$Gday = $d." ".$m." ".$y;
	?>
						
	<?php
									//////////////   Qry permis
									$val[100];
									$a=0;
									$SQLper = "select * from tb_opd_group_detail where (groupID = '$g')";
									#print $SQLper."<br>";
									$RESper = mysql_db_query($database,$SQLper);
									$VALper = mysql_fetch_array($RESper);
									///////////  loop for 1
									for($a=0;$a<=$countid;$a++)
									{	
										$val[$a] =	$VALper["doc$a"];
										#print "doc".$a."=".$VALper["doc$a"]."<br>";
										$y = $y+1;
									}///////  loop for 1
									$val[$a] =	$VALper["doc999"];
									///////////////////////////  end qry permis
									#print "TTTTYYYY<br>";
							
									$SQLshowdoc = "select * from tb_opd_doctype order by doctype_id";
							
									$RESshowdoc = mysql_db_query($database,$SQLshowdoc);
									$b =0;
									$chkOther = 0;
									$chkOk = "";
									$chkDoc ="";
									////////loop while 1
									while($VALshowdoc = mysql_fetch_assoc($RESshowdoc))
									{  
										$docid 		= $VALshowdoc["doctype_id"];
										$docname 	= $VALshowdoc["DocTypeName"];
										$doctype	= $VALshowdoc["DocType"];
									
										if ($val[$b] != 0) 
										{	//==-22					
											for ($c=0;$c<=($i-1);$c++)
											{//-11
												if($docid == $strpost[$c] )
												{//==00
													if ($docid <> 999)
													{//==11
														if(($docid == 0) &&($strpost[$c] ==0))
														{	
															$chkOther = 1;
															$tmpDocID =$docid;
															$tmpDocName =$docname;
															$tmpDocT =$doctype;
															$tmpVn=$VALdate['vn']; 
														}	
														else
														{//===22
															if ($VALdate['doctype_id'] ==$docid)
															{
	?>
																<!-- 31 ?.?. 2555 [ ????????? ]  VN : 550131142644 -->
																<li id="<?=$hnID?>" id2="<?=$VALdate['vn']?>"  id3="<?=$docid?> ">
																<a href="#"><?=$Gday?> [ <?=$docname?> ]  VN : <?=$VALdate['vn']?></a>
																</li>
	<?	
																$chkOk =$VALdate['vn'];
																$chkDoc =$doctype;
															}
														}//===end 22
														break;
													}//===11
													else
													{//==33
														if ($Xfile_Allowed ==3)
														{//==44
															#print "chkoK".$chkOk."=".$VALdate['vn']." :".$chkDoc."=".$doctype."<br>";
															if  ($VALdate['doctype_id'] ==$docid) 
															{ 
	?>
																<li id="<?=$hnID?>" id2="<?=$VALdate['vn']?>" id3="<?=$docid?> ">
																<a href="#"><?=$Gday?> [ <?=$docname?> ]  VN : <?=$VALdate['vn']?></a>
																</li>
	<?  
																$chkOk =$VALdate['vn']; 
																$chkDoc =$doctype;
															}
														}//===end44
														break;
													}//==end 33
												}//==end 00
											}//==end -11
										}	 ///// end loop if 	
										$b = $b+1;
										//if ($b==$countid+2) $b=0;
										#print "b=".$b."<br>";
									} ///// end loop while
								
									if ($chkOther == 1) 
									{
										if (($tmpVn ==$VALdate['vn'])and ($VALdate['doctype_id'] ==$tmpDocID)) 
										{	
	?>
											<li id="<?=$hnID?>" id2="<?=$VALdate['vn']?>" id3="<?=$tmpDocID?> ">
											<a href="#"><?=$Gday?> [ <?=$tmpDocName?> ]  VN : <?=$VALdate['vn']?></a>
											</li>
	<? 										
										}
									}
									//print "<li id=\"$anID\" id2=\"$tmpDocID\"><a href=\"#\">$tmpDocName</a></li>";}
								}///////////////////////////  while 2 sub
	?>
							</ul><!-- UL 3-->
							</li>  <!--LI 2 -->
	<?php
		 }////////////////     while 1  main
	?>
						</ul><!-- UL 2-->
						</li>	<!--LI 1 -->
					</ul><!-- UL 1-->
				</div>
	<?php
		}
	?>
			</td>
		</tr>
	</table>

<!--  Start Java Script -->
<script type="text/javascript" class="source below">
$(function () {
	$("#demo3")
		.jstree({ "plugins" : ["themes","html_data","ui"] })
		// 1) if using the UI plugin bind to select_node
		.bind("select_node.jstree", function (event, data) { 
			// `data.rslt.obj` is the jquery extended node that was clicked
			//alert(data.rslt.obj.attr("id"));
			
			var vn = data.rslt.obj.attr("id2");
			var id = data.rslt.obj.attr("id");
			var docid = data.rslt.obj.attr("id3");
			
//			alert(vn);
			
			//alert(data.rslt.obj.attr("id"));
			//var tmp = data.rslt.obj.attr("doctype");
//			
			//$ajax()
			$.ajax({
			  //url: "test.php?id="+id,
			  //url: "conf_inc_page.php?id="+id,
			  //alert("img_show.php?anID="+id + "&docid=" + vn + "&gid=" + <?$gg?>);
			    url: "img_show.php?hnID="+id + "&vn=" + vn + "&docid=" + docid,
				
			  success: function(data){
					$('#div_content').html(data);	
			  }
			})
			
		})
		// 2) if not using the UI plugin - the Anchor tags work as expected
		//    so if the anchor has a HREF attirbute - the page will be changed
		//    you can actually prevent the default, etc (normal jquery usage)
		.delegate("a", "click", function (event, data) { event.preventDefault(); })
});
</script>
<!-- End Java Script -->

    </td>
    <!-- The area to display ActiveX -->
	<td width="542" valign="top" id='div_content'>
	</td>
  </tr>
</table>

</body>
</html>