<?php
    # !include 'counter.txt'; (Prints Counter.txt To Screen)
	$filename = 'counter.txt';
	$ip_filename = 'ip.txt';
		
	function inc_count() {
	$ip = $_SERVER['REMOTE_ADDR'];
	global $filename, $ip_filename;
	
    if (!in_array($ip, file($ip_filename, FILE_IGNORE_NEW_LINES))) 
    {
        $current_value = (file_exists($filename)) ? file_get_contents($filename)	: 0;
        file_put_contents($ip_filename, $ip."\n", FILE_APPEND);
        file_put_contents($filename, ++$current_value);
    }
	
	}
inc_count();
?>