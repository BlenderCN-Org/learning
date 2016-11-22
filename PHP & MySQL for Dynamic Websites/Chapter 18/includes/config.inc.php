<?php	
// ************ SETTINGS ************
define('LIVE', FALSE); // Production/Development status
define('EMAIL', 'rdoubleoc@aol.com'); // Admin email
define ('BASE_URL', 'http://www.example.com/'); // Base URL for redirections
define ('MYSQL', 'includes/mysqli_connect.php'); // Path to DB connection script
date_default_timezone_set ('US/Eastern'); // Adjust time zone for PHP 5.1 and >

// ************ ERROR MANAGEMENT ************
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
	$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";
	$message .= "Date/Time: " . date('nj-YH:i:s') . "\n"; // Append date/time
 	
	if(!LIVE){
		echo '<div class="error">' . nl2br($message);
	 	echo '<pre>' . print_r ($e_vars, 1) . "\n";
		debug_print_backtrace();
		echo '</pre></div>';	 	 	
	} else {
		// Send an email to the admin:
		$body = $message . "\n" . print_r($e_vars, 1);
		mail(EMAIL, 'Site Error!', $body, 'From: email@example.com');
	 	
		// Print error if not a notice
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	}
}

set_error_handler('my_error_handler'); // Use function my_error_handler() as error handler