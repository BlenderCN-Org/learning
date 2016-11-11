<!DOCTYPE html>
<html lang="en">
<head><meta charset=utf-8" /><title>PHP Template</title></head>
<body>
<p>This is standard HTML.</p>
<?php
$quantity = 30;
$price = 119.95;
$tax = .05;
// Calculate the total:
$total = $quantity * $price;
$total = $total + ($total * $tax);
// Calculate and add the tax.
	
// Format the total:
$total = number_format ($total, 2);

// Print the results using double quotes instead
echo "You are purchasing $quantity widgets at a cost of \$$price each.  With tax, the total comes to \$$total";
?>
</body>
</html>