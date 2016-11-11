<!DOCTYPE html>
	<html lang="en">
	<head>
	 	<meta charset="utf-8" />
	 	<title>PCRE</title>
	</head>
	<body>
<?php
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$pattern = trim($_POST['pattern']);
	$subject = trim($_POST['subject']);
	 	 	 	
	echo "<p>The result of checking<br /><b>$pattern</b><br />against<br />$subject<br />is ";
	 	
	if (preg_match ($pattern, $subject) ) { // See if regexp/pattern is true
		echo 'TRUE!</p>';
		}else{
			echo 'FALSE!</p>';
	}
}
?>
	<form action="pcre.php" method="post">
	<p>Regular Expression Pattern:<input type="text" name="pattern" value="<?php if (isset($pattern)) echo htmlentities($pattern); ?>" size="40" />(include the delimiters)</p><p>Test Subject: <input type="text" name="subject" value="<?php if (isset($subject)) echo htmlentities($subject);?>" size="40" /></p>
	<input type="submit" name="submit" value="Test" />
</form>
</body>
</html>