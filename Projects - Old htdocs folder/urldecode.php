<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Login</title>
	</head>
	<body>
	<form method="post">
	<table border="1" width="25%" bordercolor="green">
		<tr>
			<td>Title:</td>
			<td align=center><input type="text" name="title" /></td>

			<tr><td colspan=2 align=center><input type="submit" name="submit" value="URLdecode" /></td></tr>
			<tr><td colspan=2 align=center><input type="submit" name="submit2" value="URLencode" /></td></tr>
		</tr>
	</table>
	</form>
	</body>
</html>
<?php

if(isset($_POST['submit'])){
$input = $_POST['title'];
echo urldecode($input);

}

if(isset($_POST['submit2'])){
$input = $_POST['title'];
echo urlencode($input);

}



?>