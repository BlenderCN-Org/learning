<!DOCTYPE html>
	 <html lang="en">
	 <head>
	 	 <meta charset="utf-8" />
	 	 <title>Widget	Cost Calculator</title>
	 </head>
	 <body>
<?php # Script 13.2 - calculator.php
	
if ($_SERVER['REQUEST_METHOD']	==	'POST') {
	// Cast variables to specific types
	$quantity = (int)$_POST['quantity'];
	$price = (float)$_POST['price'];
	$tax = (float)$_POST['tax'];
	
	// Ensure all varibles positive
	if(($quantity > 0) && ($price > 0) && ($tax > 0)){
		$total = $quantity * $price;
		$total += $total * ($tax/100);
	
		echo '<p>The total cost of purchasing ' . $quantity . ' widget(s) at $' . number_format ($price, 2) . ' each, plus tax, is $' . number_format($total, 2) . '.</p>';
		}else{ // Not positive
			echo '<p style="font-weight: bold; color: #C00">Please enter a valid quantity, price, and tax rate.</p>';
 	}
}
?>
	<h2>Widget Cost Calculator</h2>
	<form action="calculator.php" method="post">
	<p>Quantity: <input type="text" name="quantity" size="5" maxlength="10" value="<?php if (isset($quantity)) echo $quantity; ?>" /></p>
	<p>Price: <input type="text" name="price" size="5" maxlength="10" value="<?php if (isset($price)) echo $price; ?>" /></p>
	<p>Tax (%): <input type="text" name="tax" size="5" maxlength="10" value="<?php if (isset($tax)) echo $tax; ?>" /></p>
	<p><input type="submit" name="submit" value="Calculate!" /></p>
</form>
</body>
</html>