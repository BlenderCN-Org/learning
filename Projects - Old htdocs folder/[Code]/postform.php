<!DOCTYPE html>
<html lang="en">
<head>
<title>Books</title>
</head>
<body>
<center>
<h2>Russell's Experimental Password Form</h2>
<form method="post">
<table border="1" width="25%" bordercolor="green">
	<tr>
		<td>Password:</td>
		<td align=center><input type="text" name="password" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align=center><input type="submit" name="submit" value="Submit" /></td>
	</tr>
</table>
</form>
	<?php
	if (isset($_POST['submit']))
	{	  
			$userinput=$_POST['password'];
			echo $userinput;
	}
	
	?>
	
	
	
	
	
	
</body>
</html>