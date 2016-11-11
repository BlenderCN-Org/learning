<!DOCTYPE html>
<html lang="en">
<head>
	 	<meta charset="utf-8" />
	 	<title></title>
	 	<style type="text/css" media="screen">
	 	body {
			font-family: Verdana, Arial, Helvetica, sans-serif;
	 	 	font-size: 12px;
	 	 	margin: 10px;
	 	}
	 	label { font-weight: bold; }
	 	.error { color: #F00; }
	 	</style>
</head>
<body>
<?php
// Set the start and end date as today and tomorrow by default:
$start = new DateTime();
$end = new DateTime();
$end->modify('+1 day');

$format = 'm/d/Y';

function validate_date($date) {	// Validates a date string and returns an array of the three parts, if valid.
	$date_array = explode('/', $date); // Break up the date into separate parts
	
	if(count($date_array) != 3){ // Return FALSE if not 3 items
		return false;
	}

	if (!checkdate($date_array[0], $date_array[1], $date_array[2])){ // Return FALSE if it's not a valid date
		return false;
	};
	
	return $date_array; // Return the date as an array of 3 items
}
	
if (isset($_POST['start_date'])) { // Check for POST submission
	if ((list($sm, $sd, $sy) = validate_date($_POST['start'])) && (list($em, $ed, $ey) = validate_date($_POST['end']))){
		$start->setDate($sy, $sm, $sd);
	 	$end->setDate($ey, $em, $ed);
	 	 	
	 	if ($start < $end) {
			$interval = $start->diff($end);

			echo "<p>The event has been planned starting on {$start->format($format)} and ending on {$end->format($format)}, which is a period of $interval->days day(s).</p>";
		}else{ // Start date later than end date
			echo '<p class="error">The starting date must precede the ending date.</p>';
	 	}
	}else{ // Invalid date
	 	 echo '<p class="error">One or both of the submitted dates was invalid.</p>';
	}	 	
}
?>
<h2>Set the Start and End Dates for the Thing</h2>
<form action="datetime.php" method="post">
<p><label for="start_date">Start Date:</label><input type="text" name="start_date" value="<?php echo $start->format($format); ?>" /> (MM/DD/YYYY)</p>
<p><label for="end_date">End Date:</label><input type="text" name="end_date" value="<?php echo $end->format($format); ?>" /> (MM/DD/YYYY)</p>
<p><input type="submit" value="Submit" /></p>
</form>
</body>
</html>