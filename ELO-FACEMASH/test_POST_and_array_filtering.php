<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_implicit_flush(true);
require_once('functions.php');

	$ar = array();
	$ar = array_push_a($ar, 'A', '(');
	$ar = array_push_a($ar, 'B', ')');
	$ar = array_push_a($ar, 'C', ',');
	$ar = array_push_a($ar, 'D', 4);

	echo '<pre>';
	echo '<br/>Print_r:<br/>';
	print_r($ar);
	echo '<br/>';
	echo '</pre>';
	echo '<br/>';
	if(filter_array($ar) == TRUE){
		echo 'filter_array output: TRUE';
	}else{
		if(filter_array($ar) === FALSE){
			echo 'filter_array output: FALSE (===)<br/>';
		}else{
			echo 'filter_array output: FALSE (==)<br/>';
		};
	};
	
?>