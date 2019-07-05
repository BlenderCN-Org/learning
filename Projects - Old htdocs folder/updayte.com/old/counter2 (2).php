<?php
	$filename = 'counter.log';
	$ip_filename = 'ip.log';
	$ips = 'all.log';
	function inc_count()
		{
		$ip = $_SERVER['REMOTE_ADDR']; 
		if ($ip != "10.0.0.10" AND $ip != "10.0.0.53" AND $ip != "127.0.0.1")
		{	
			global $filename, $ip_filename, $ips;
			if (!in_array($ip, file($ip_filename, FILE_IGNORE_NEW_LINES)))
			{
			$current_value = (file_exists($filename)) ? file_get_contents($filename)	: 0; 
			file_put_contents($ip_filename, $ip."\n", FILE_APPEND);
			file_put_contents($filename, ++$current_value); // Increments Counter if IP isn't contained in file.
			}
			if (in_array($ip, file($ip_filename, FILE_IGNORE_NEW_LINES)))
			{
			$DOW = $jd=cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
			$dayt = (jddayofweek($jd,1)) . ", " . date("m/d/Y");
			$put = $ip . '<-->' . $dayt;
			file_put_contents($ips, $put . "\n", FILE_APPEND);
			}
		}
		}
	inc_count();
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','analytics.js','ga');

  ga('create', 'UA-51230816-1', 'updayte.com');
  ga('send', 'pageview');
</script>