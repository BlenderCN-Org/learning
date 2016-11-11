<!DOCTYPE html>
<html lang="en">
<head><meta charset=utf-8" /><title>PHP Template</title></head>
<body>
<p>This is standard HTML.</p>
<?php
// Create variables
$first_name = 'Larry';
$last_name = 'Ulman';
$book = 'PHP and MySQL for Dynamic Web Sites';
$author = $first_name . " " . $last_name;

// Print the variables
echo "The book <u>" . $book . "</u> was printed by " . $author;
?>
</body>
</html>