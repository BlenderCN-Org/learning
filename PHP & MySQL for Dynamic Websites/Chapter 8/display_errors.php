<!DOCTYPE html>
	 <html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Displaying Errors</title>
</head>
<body>
<h2>Testing Display Errors</h2>
<?php
ini_set('display_errors', 1);

// Create errors
foreach ($var as $v) {}
$result = 1/0;
?>
</body>
</html>