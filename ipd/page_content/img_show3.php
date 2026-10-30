<html><body>
<?php
//onload="window.print();"
$an = $_REQUEST['an'];$j=1;
foreach($_POST as $Arrs => $value) {  
	$p[$Arrs] = $value; 
	//echo $p[$Arrs] ."<br>";
	if ($Arrs>=0 || $Arrs<=55){
		if (is_numeric($Arrs)){
			$docid[$j]=$p[$Arrs];
			//echo "docid=".$docid[$j]."<br>";
			$j++;
		}
	}
}
//echo count($docid)."<br>";
///////////////// add to log detail /////////////
include_once("../System_config/func.php");
savelogdetail($_REQUEST["logno"],"PA",$an,"");
//////////////////////////////////////////////
for ($i=1;$i<=count($docid);$i++){
					//echo "<div>".$docid[$i]."</div>";
					echo "<br><table align=center width='100%' border='0' cellpadding='0' cellspacing='0'>";
					echo "<tr><td>";
					echo "<embed src='img_view.php?an=".$an."&docid=".$docid[$i]."&chkpass=1' width=1167 height=1637  autoprint=4  type='image/tiff' negative=no toolbar=off>";
					echo "</td></tr></table><br>";
}//end for
?>
</body></html>