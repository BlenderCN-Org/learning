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
	 	
	if(preg_match_all($pattern, $subject, $matches)){ // See if regexp/pattern is true
		echo 'TRUE!</p>';
		echo '<pre>' . print_r($matches, 1) . '</pre>';
		}else{
			echo 'FALSE!</p>';
	}
}
?>
	<form action="matches.php" method="post">
	<p>Regular Expression Pattern:<input type="text" name="pattern" value="<?php if (isset($pattern)) echo htmlentities($pattern); ?>" size="40" />(include the delimiters)</p><p>Test Subject: <textarea name="subject" rows="5" cols="40"><?php if(isset($subject)) echo htmlentities($subject); ?></textarea></p>
	<input type="submit" name="submit" value="Test" />
</form>
</body>
</html>