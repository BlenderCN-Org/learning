<?php
	$RAW_postdata = file_get_contents("php://input");
	
	echo '<pre>';
	
	echo '$GLOBALS: <br/>';
	print_r($GLOBALS);	
	echo '<br/><br/>';
	
	echo '$_SERVER: <br/>';
	print_r($_SERVER);
	echo '<br/><br/>';
	
	if(isset($_SESSION)){
		echo '$_SESSION: <br/>';
		print_r($_SESSION);
		echo '<br/><br/>';
	};
	
	if(isset($_ENV)){
		echo '$_ENV: <br/>';
		print_r($_ENV);
		echo '<br/><br/>';
	};
	
	echo '$_REQUEST: <br/>';
	print_r($_REQUEST);
	echo '<br/><br/>';
	
	if(isset($RAW_postdata)){
		echo '$RAW_postdata:<br/>';
		echo $RAW_postdata;
	};
	
	echo '</pre>';
?>