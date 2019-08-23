<?php
	//Created On: 7-19-2019 By: Russell Rounds (https://github.com/netsider)
	
	function array_push_a($a, $k, $v){
		$a[$k] = $v;
		return $a;
	};
	function write($fn, $text){
		$file = fopen($fn, 'w');
		fwrite($file, $text);
		fclose($file);
		return TRUE;
	};
	function write_a($fn, $text){
		$file = fopen($fn, 'a');
		fwrite($file, $text . "\r\n");
		fclose($file);
		return TRUE;
	};
	function read($fn){
		$f = fopen($fn,"r");
		$contents = fread($f,filesize($fn));
		fclose($f);
		return $contents;
	};
	function count_files_in_current_DIR(){
		$fi = new FilesystemIterator(__DIR__, FilesystemIterator::SKIP_DOTS);
		return iterator_count($fi);
	};
	function count_files_in_DIR($DIR){
		$fi = new FilesystemIterator($DIR, FilesystemIterator::SKIP_DOTS);
		return iterator_count($fi);
	};
	function ELO($A, $B){ 
		return (1/(1+pow(10,(($B-$A)/400)))); // https://en.wikipedia.org/wiki/Elo_rating_system
	};
	function filter_array($array){
		$no_problems = TRUE;
		$exception_array = ['=', ')', '(', ','];
		foreach($array as $key => $value){
			if(ctype_alnum($value)){
				// echo 'Key: ' . $key . ' Value: ' . $value . ' is alphanumeric.<br/>';
			}else{
				if(in_array($value, $exception_array)){ // Exceptions
					// echo 'Key: ' . $key . ' Value: ' . $value . ' is exception!<br/>';
				}else{
					if(is_numeric($value)){
						// echo 'Key: ' . $key . ' Value: ' . $value . ' is NUMERIC!<br/>';
					}else{
						$string_array = str_split($value);
						foreach($string_array as $char) {
							if(in_array($char, $exception_array) OR ctype_alnum($char)){
								// echo 'Value(' . $value . ') not alphanumeric, but Character(' . $char . ') is, or is in exception array!<br/>';
							}else{
								echo '<b>Key(' . $key . ')</b> <b>Value(' . $value . ')</b> is NOT alphanumeric, NOT exception. <b>Odd character(' . $char . ')</b>.<br/>';
								$no_problems = FALSE;
							};
						};
					};
				};
			};
		};
		
		if($no_problems === TRUE){
			return TRUE;
		}else{
			return FALSE;
		};
	};
?>