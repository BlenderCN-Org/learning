<div id="logo"></div>
<div id="cdate">
	<?php $DOW = $jd=cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
	$mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");
	$date = getdate();
	$month = $date['mon'];
	echo $mons[$month] . ' ' . date("d") . ', ' . date("Y") . ' [' . jddayofweek($jd,1) . ']';?>
</div>
<div id="navbar">
	<ul>
		<?php include 'nav.php';?>
	</ul>
</div>