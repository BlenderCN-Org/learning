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
		$minlength = 0;
		$maxlength = 100;
		foreach($array as $key => $value){
			$info = 'Key: ' . $key . ' Value: ' . $value . '<br/>';
			if(ctype_alnum($value)){
				echo 'Completely letters and/or digits.<br/>';
			}else{
				echo 'NOT Completely letters and/or digits.<br/>';
				echo $info;
				if($value == ',' OR $value == '(' OR $value = ')'){ // Make exception for these
					echo 'Value is exception! <br/>';
					return TRUE;
				}else{
					echo 'Returning False...<br/>';
					return FALSE;
				};
			};
		};
	};
?>