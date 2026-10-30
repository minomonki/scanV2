<?php
			///////////////// IMG VIEW //////////////////
			$Img_Id = $_GET['an'];
			$docid = $_GET['docid'];
			#$tmp = $_SESSION["tmp"];
			$tmp = $_GET['tmp'];
			include ("../System_config/connection.php");
			//echo "show";
			if ($_GET['chkpass']==1){
				header("Content-type: image/tiff");
				$SQL = "SELECT * FROM  tb_ipd_doctype_detail  WHERE an ='$Img_Id' and doctype ='$docid' ";
					#print $SQL;
				$Query = mysql_db_query($database,$SQL) or die ("Error Query [".$SQL."]");
				$Result = mysql_fetch_array($Query);
				//$Type=$Result["FileType"];
				//header("Content-type: $type ");
				echo $Result["imagescan"];
				///////////////////////////////////////////////
			}

?>