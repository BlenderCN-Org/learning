<?php
	//Created On: 7-19-2019 By: Russell Rounds (https://github.com/netsider)
	
	function array_push_assoc($a, $k, $v){
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
		$fc = '<font color="red">';
		$efc = '</font>';
		foreach($array as $key => $value){
			if(strlen($value) < $minlength){
				// $a = $fc . 'Length of <b>' . $key . '</b> is <b>' . strlen($value) . '</b>' . $efc;
				// echo $a;
				return false;
			}
			if(strlen($value) > $maxlength){
				// echo $a;
				return false;
			}
			if(ctype_alnum($value)){
				// echo '<font color="green">The field(<b>' . $key . '</b>) is completely letters and/or digits.<br/>' . $efc;
			}else {
				// echo $fc . 'The field(<b>' . $key . '</b>) is not completely letters and/or digits.<br/>' . $efc;
				return false;
			};
		};
	return true;
	};
?>