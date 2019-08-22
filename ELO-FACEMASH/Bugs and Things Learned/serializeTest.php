<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	echo '<pre>';
	$some_array = ["1", 2, 3];
	
	echo 'Serialize/Unserialize: <br/><br/>';
	echo '<b>Original Array:</b><br/>';
	print_r($some_array);
	echo '<br/>';
	echo '<b>print_r (while serialized):</b><br/>';
	print_r(serialize($some_array));
	echo '<br/><br/>';
	$new_array = serialize($some_array);
	echo '<b>Serialized:</b><br/>';
	print_r($new_array);
	echo '<br/><b>Original Array</b><br/>';
	print_r(unserialize($new_array));
	
	echo '<br/><br/>';
	$new_array2 = json_encode($some_array);
	echo '<b>JSON Encode/Decode:</b><br/>';
	echo '<b>JSON Encoded:</b><br/>';
	print_r($new_array2);
	echo '<br/><br/>';
	echo '<b>JSON Decoded:</b><br/>';
	print_r(json_decode($new_array2));
	
?>