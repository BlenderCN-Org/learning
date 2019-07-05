<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Experimental Form</title>
</head>
<body>
<center>
<h2>Russell's Experimental Password Form</h2>
<form method="post">
<table border="1" width="25%" bordercolor="green">
	<tr>
		<td>Username:</td>
		<td align=center><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td align=center><input type="text" name="password" /></td>
	</tr>
	<tr>
		<td align=center>&nbsp</td>
		<td align=center><input type="submit" name="submit" value="Submit" /></td>
	</tr>
</table>
</form>
<br/>
	<?php // ONLY salt needs to be stored in DB!
	if (isset($_POST['submit']))
	{
	$userinput=$_POST['password'];
	$username=$_POST['username'];
		$iterations = 100000;
		$salt = mcrypt_create_iv(75, MCRYPT_DEV_URANDOM);
			$algorithm = 'whirlpool';
		$pbkdf2_hash = hash_pbkdf2($algorithm, $userinput, $salt, $iterations, 100);
		echo '<br/>pbkdf2 hash:';
		echo $pbkdf2_hash;
		echo '<br/>salt:';
		echo $salt;
		echo '<br/>crypt:';
		echo crypt($pbkdf2_hash, $username); // user username as salt for 2nd hashing, since it'll make every hash unique
	}
	?>
</body>
</html>