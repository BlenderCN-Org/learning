<?php
	$filename = 'counter.txt';
	$ip_filename = 'ip.txt';
	$ips = 'allips.txt';
	function inc_count()
		{
		$ip = $_SERVER['REMOTE_ADDR']; 
		global $filename, $ip_filename, $ips;
		$input = $ip . "aa";
		file_put_contents($ips, $input."\n", FILE_APPEND);
		echo $ip;
		}
	inc_count();
?>