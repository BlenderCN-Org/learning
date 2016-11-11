<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset=utf-8" /><title>PHP Template</title>
</head>
<body>
<p>This is standard HTML.</p>
<?php
// Assign variables
$file = $_SERVER['SCRIPT_FILENAME'];
$user = $_SERVER['HTTP_USER_AGENT'];
$server = $_SERVER['SERVER_SOFTWARE'];

// Print variables
echo 'The current file is: ' . $file;
echo '<br/>';
echo 'The current user agent is: ' . $user;
echo '<br/>';
echo 'The current server software is: ' . $server;
?>
</body>
</html>