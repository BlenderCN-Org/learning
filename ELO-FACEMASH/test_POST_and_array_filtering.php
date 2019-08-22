<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_implicit_flush(true);
require_once('functions.php');

	$ar = array();
	$ar = array_push_a($ar, 'A', 'A');
	$ar = array_push_a($ar, 'B', ')');
	$ar = array_push_a($ar, 'C', '(');
	$ar = array_push_a($ar, 'D', '4');
	$ar = array_push_a($ar, 'E', 4); // Numbers are not considered alphanumeric? odd.
	$ar = array_push_a($ar, 'F', ',');
	$ar = array_push_a($ar, 'G', '?');

	echo '<pre>';
	echo '<br/>Print_r:<br/>';
	print_r($ar);
	echo '<br/>';
	echo '</pre>';
	echo '<br/>';
	$array_filtered = filter_array($ar);
	echo '<br/>';
	if($array_filtered == TRUE){
		echo 'filter_array output: TRUE';
	}else{
		if($array_filtered === FALSE){
			echo 'filter_array output: FALSE (===)<br/>';
		}else{
			echo 'filter_array output: FALSE (==)<br/>';
		};
	};
	
?>