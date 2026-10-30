<?php
	echo "<form action='page_content/fn_chkpassword.php' method=post>";
	echo "<BR><BR><BR><div align=center>Enter Password : <input type=password name=pswtxt maxlength=20 size=15></div>";
	echo "<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div align=center><input type=submit value=' Ok ' name=comm></div>";
	echo "<input type=hidden name=an value=".$an." >";
	echo "</form>";
?>