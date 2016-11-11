<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset=utf-8" />
	<title>PHP Template</title>
</head>
<body>
<p>This is standard HTML.</p>
<?php
// Create self-incrementing array for months
$months = array (1 => 'January','February','March','April','May','June','July','August','September','October','November','December');

// Create arrays using range() function
$days = range (1, 31);
$years = range (2011, 2021);

// Print arrays
echo '<select name="month">';
foreach ($months as $key => $value) {
	echo "<option value=\"$key\">$value</option>";
}
echo '</select>';

echo '<select name="day">';
foreach ($days as $value) {
	echo "<option value=\"$value\">$value</option>";
}
echo '</select>';

echo '<select name="year">';
foreach ($years as $value) {
	echo "<option value=\"$value\">$value</option>";
}
echo '</select>';
?>
</body>
</html>