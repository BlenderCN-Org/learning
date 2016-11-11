<!DOCTYPE html>
	 <html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Displaying Errors</title>
</head>
<body>
<h2>Testing Display Errors</h2>
<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL | E_STRICT); // Report any/all errors
//define('LIVE', FALSE);
define('LIVE', TRUE);
	
// Create custom error handler function
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
	$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";
	$message .= print_r ($e_vars, 1);
	
	if (!LIVE) {
		echo '<pre>' . $message . "\n";
		debug_print_backtrace();
		echo '</pre><br />';
	} else { // Don't show error, but display message
		echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
	}
}

// Use custom error handling function
set_error_handler ('my_error_handler');

// Create errors
foreach ($var as $v) {}
$result = 1/0;
?>
</body>
</html>