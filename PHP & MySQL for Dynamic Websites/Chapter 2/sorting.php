<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset=utf-8" />
	<title>PHP Template</title>
</head>
<body>
<p>This is standard HTML.</p>
<table border="1">
<?php
// Create array
$movies = array ('Casablanca' => 10,
	'To Kill a Mockingbird' => 10,
	'The English Patient' => 2,
	'Stranger Than Fiction' => 9,
	'Story of the Weeping Camel' => 5,
	'Donnie Darko' => 7
);

// Print in original order
echo '<tr><td colspan="2"><b>In their original order:</b></td></tr>';
foreach ($movies as $title => $rating) {
	echo "<tr><td>$rating</td><td>$title</td></tr>";
}

// Sort and Display by title:
ksort($movies); // sort array alphabetically/by key
echo '<tr><td colspan="2"><b>Sorted by title:</b></td></tr>';
foreach ($movies as $title => $rating) {
	echo "<tr><td>$rating</td><td>$title</td></tr>";
}

// Sort and Display by rating/number
arsort($movies); // reverse's array
echo '<tr><td colspan="2"><b>Sorted by rating:</b></td></tr>';
foreach ($movies as $title => $rating) {
	echo "<tr><td>$rating</td><td>$title</td></tr>";
}
?>
</table>
</body>
</html>