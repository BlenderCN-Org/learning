<?php
	$filename = 'counter.txt';
	$ip_filename = 'ip.txt';
	$ips = 'allips.txt';
	function inc_count()
		{
		$ip = $_SERVER['REMOTE_ADDR']; 
		if ($ip != "98.211.122.129" AND $ip != "10.0.0.10" AND $ip != "10.0.0.53")
		{	
			global $filename, $ip_filename, $ips;
			if (!in_array($ip, file($ip_filename, FILE_IGNORE_NEW_LINES)))
			{
			$current_value = (file_exists($filename)) ? file_get_contents($filename)	: 0; 
			file_put_contents($ip_filename, $ip."\n", FILE_APPEND);
			file_put_contents($filename, ++$current_value);
			}
				if (in_array($ip, file($ip_filename, FILE_IGNORE_NEW_LINES)))
			{
				file_put_contents($ips, $ip."\n", FILE_APPEND);
			}
		}
	}
	inc_count();
?>