<?php
	session_start();
	
	include ("../System_config/connection.php");

	$g  = $_SESSION["Usergroup"];

//////////////   Qry permis
	$val[30];
	$y=1;
	$SQLper = "select * from tb_opd_group_detail where (groupID = '$g')";
	$RESper = mysql_db_query($database,$SQLper);
	while ($VALper = mysql_fetch_array($RESper)){/////
		$Xfile_Allowed  = $VALper['doc999'];
	} ////////////  while
	$SQLuserid1 = "select * from  tb_opd_doctype order by doctype_id desc";
	$RESuserid1 = mysql_db_query($database,$SQLuserid1);
	$ii =0;
	while ($VALuserid1 = mysql_fetch_array($RESuserid1)){
		$countid = $VALuserid1["doctype_id"];
		$ii = $ii+1;
		if ($ii==2) break;
	}
	#print "countid = ".$countid;
///////////////////////////  end qry permis
	
	 $hnID  	= $_GET['hnID'];
	 
#	print "hnID=".$hnID."<br>";
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
				while($VALdoc = mysql_fetch_array($RESdoc)){
					$strpost[$i]=$VALdoc['doctype_id'];
					$i = $i+1;
					#print "i = ".$i."<br>";
#					print "<br>";
				#	print "value =".$strpost[$i]=$VALdoc['doctype']."<br>";
				}///////////  while
			#}

	
	/////////////  select Firstname and Lastname 
	$SQLperson = "SELECT * FROM tb_opd WHERE hn='$hnID'";
	$RESperson = mysql_db_query($database,$SQLperson);
	while ($VALperson = mysql_fetch_array($RESperson)){/////
		$hnID  = $VALperson['hn'];
		$Fname = $VALperson['firstname'];
		$Lname = $VALperson['lastname'];
		#$Xn = $VALperson['doctype_id'];
	} ////////////  while

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>:: ? ::</title>
	 	<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="../jstree/_lib/jquery.js"></script>
	<script type="text/javascript" src="../jstree/_lib/jquery.cookie.js"></script>
	<script type="text/javascript" src="../jstree/_lib/jquery.hotkeys.js"></script>
	<script type="text/javascript" src="../jstree/jquery.jstree.js"></script>
	<script type="text/javascript" src="../jstree/_docs/syntax/!script.js"></script>
    <link type="text/css" rel="stylesheet" href="../jstree/_docs/syntax/!style.css"/>
	<link type="text/css" rel="stylesheet" href="../jstree/_docs/!style.css"/>
<script language="JavaScript"> <!--
var message="????.\n"; // Message for the alert box

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
// --> </script>

</head>

<body>
<table width="800" height="232" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="258" valign="top">

<div id="demo3" class="demo" style="height:400px;">
	<ul> <!-- UL 1-->
		<li id="shtml_1" class="jstree-open"> <!--LI 1 -->
			<label><?=$hnID?> : <?=$Fname?>   <?=$Lname?></label>
			<ul><!-- UL 2-->
     <?php
	 $SQLmonth = "select left(dater,7) as montth,vn ,dater from tb_opd where hn = '$hnID'  GROUP BY  left(dater,7) order by left(dater,7) desc ";
	 $SQLmonth = mysql_db_query($database,$SQLmonth);
	 while ($VALmonth = mysql_fetch_array($SQLmonth)){   ////////////////     while 1  main
	 		$mm = $VALmonth['montth'];
				$y = substr($mm,0,4);
				$m = substr($mm,5,2);
				
					if($m=="01"){ $m="..";}
					else if($m=="02"){ $m="..";}
					else if($m=="03"){ $m="..";}
					else if($m=="04"){ $m="..";}
					else if($m=="05"){ $m="..";}
					else if($m=="06"){ $m="..";}
					else if($m=="07"){ $m="..";}
					else if($m=="08"){ $m="..";}
					else if($m=="09"){ $m="..";}
					else if($m=="10"){ $m="..";}
					else if($m=="11"){ $m="..";}
					else { $m="..";}
					
			$Gmonth = $m."-".$y;
   ?>          
				<li id="shtml_1-1" class="jstree-open">		<!--LI 2 -->
					<a href="#"><?=$Gmonth?></a>
                    	<ul><!-- UL 3-->
     				<?php
							$SQLdate = " SELECT vn,dater,hn FROM tb_opd WHERE (left(dater,7) = '$mm' ) and (hn='$hnID') group by dater order by dater desc  ";
							#print  $SQLdate;
							$RESdate = mysql_db_query($database,$SQLdate);
							while ($VALdate = mysql_fetch_array($RESdate)){   ////////////////     while 2 sub
								$day = $VALdate['dater'];
									$y = substr($day,0,4);
									$m = substr($day,5,2);
									$d = substr($day,8,2);
									
										if($m=="01"){ $m="..";}
										else if($m=="02"){ $m="..";}
										else if($m=="03"){ $m="..";}
										else if($m=="04"){ $m="..";}
										else if($m=="05"){ $m="..";}
										else if($m=="06"){ $m="..";}
										else if($m=="07"){ $m="..";}
										else if($m=="08"){ $m="..";}
										else if($m=="09"){ $m="..";}
										else if($m=="10"){ $m="..";}
										else if($m=="11"){ $m="..";}
										else { $m="..";}
							
								$Gday = $d." ".$m." ".$y;
							
                    ?>
                    
                                  		<?php
													#$doctmp = doctype($hnID, $VALdate['vn']);
													#print  "doctmp = ".$doctmp;		
									//////////////////////////////////////////////////////////////////////// Get  Doctype
														$vn = $VALdate['vn'];
														$SQL= "	select doctype_id  from tb_opd where (hn='$hnID')  and (vn='$vn') ";
														#print $SQL;
														$RES = mysql_db_query($database,$SQL);
														#print  "res = ".$RES;
														while ($VAL = mysql_fetch_array($RES)){
														#print  $VAL['doctype_id'];
																$docID = $VAL['doctype_id'];
														}
														if  ($docID  <>999){//=======if 555
														$SQLdocname= "	select *  from  tb_opd_doctype  where  (doctype_id = '$docID ')";
														$RESdocname = mysql_db_query($database,$SQLdocname);
														while ($VALdocname= mysql_fetch_array($RESdocname)){
																	$doctype = $VALdocname['DocTypeName'];
														}
//===========================================================                                        
										?>
										
										
										
										
										
<!------------------------------------------------------------------------------------------------------------>										
                    									<li id="<?=$hnID?>" id2="<?=$VALdate['vn']?>">
														<a href="#"><?=$Gday?> [ <?=$doctype?> ]  VN : <?=$VALdate['vn']?></a>
														</li>
													<? }//===if
														else{
																if ($Xfile_Allowed ==1){
																$SQLdocname= "	select *  from  tb_opd_doctype  where  (doctype_id = '$docID ')";
																$RESdocname = mysql_db_query($database,$SQLdocname);
																while ($VALdocname= mysql_fetch_array($RESdocname)){
																	$doctype = $VALdocname['DocTypeName'];
																}
														?>		
                    											<li id="<?=$hnID?>" id2="<?=$VALdate['vn']?>">
																<a href="#"><?=$Gday?> [ <?=$doctype?> ]  VN : <?=$VALdate['vn']?></a>
																</li>
														<?		}//===else
														} //========end if 555?>
					<?php
	 						}    ///////////////////////////  while 2 sub
					?>
                    </ul><!-- UL 3-->
				</li>  <!--LI 2 -->
  <?php
	 }			////////////////     while 1  main
  ?>
			</ul><!-- UL 2-->
		</li>	<!--LI 1 -->
	</ul><!-- UL 1-->
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
			
			var vn = data.rslt.obj.attr("id2");
			var id = data.rslt.obj.attr("id");
			
//			alert(vn);
			
			//alert(data.rslt.obj.attr("id"));
			//var tmp = data.rslt.obj.attr("doctype");
//			
			//$ajax()
			$.ajax({
			  //url: "test.php?id="+id,
			  //url: "conf_inc_page.php?id="+id,
			  //alert("img_show.php?anID="+id + "&docid=" + vn + "&gid=" + <?$gg?>);
			    url: "img_show.php?hnID="+id + "&vn=" + vn,
				
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
    <td width="542" valign="top" id='div_content'></td>
  </tr>
</table>

</body>
</html>