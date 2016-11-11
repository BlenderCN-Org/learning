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
// $days = range (1, 31);
// $years = range (2011, 2021);

echo '<select name="month">';
foreach ($months as $key => $value) {
	echo "<option value=\"$key\">$value</option>\n";
}
echo '</select>';

echo '<select name="day">';
for ($day = 1; $day <= 31;$day++) {
	echo "<option value=\"$day\">$day</option>";
}
echo '</select>';

echo '<select name="year">';
for ($year = 2016; $year <= 2031;$year++) {
	echo "<option value=\"$year\">$year</option>";
}
echo '</select>';
?>
</body>
</html>