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
	$replace = trim($_POST['replace']);
	 	 	 	
	//echo "<p>The result of checking<br /><b>$pattern</b><br />against<br />$subject<br />is ";
	echo "<p>The result of replacing<br /><b>$pattern</b><br />with<br />$replace <br />in<br />$subject<br /><br />";
 	
	if(preg_match ($pattern, $subject)){
		echo preg_replace($pattern, $replace, $subject) . '</p>';
	}else{
		echo 'The pattern was not found!</p>';
	}
}
?>
	<form action="replace.php" method="post">
	<p>Regular Expression Pattern:<input type="text" name="pattern" value="<?php if(isset($pattern)) echo htmlentities($pattern); ?>" size="40" />(include the delimiters)</p>
	<p>Replacement: <input type="text" name="replace" value="<?php if(isset($replace)) echo htmlentities($replace); ?>" size="40" /></p>
	<p>Test Subject: <textarea name="subject" rows="5" cols="40"><?php if(isset($subject)) echo htmlentities($subject); ?></textarea></p>
	<input type="submit" name="submit" value="Test" />
</form>
</body>
</html>