<?php
// $auth_db_array = array();
// function array_push_assoc($array, $key, $value){
// $array[$key] = $value;
// return $array;
// }

// for($i=0;$i <= 3;$i++){
// $valuename = ['One', 'Two', 'Three', 'Four'];
// echo $key_name = 'author' . $i;
// $auth_db_array = array_push_assoc($auth_db_array, $key_name, $valuename[$i]);
// echo '<br/>';
// }
// echo '<pre>';
// print_r($auth_db_array);
// echo '</pre>';


// $pattern = '/[$url]/';
// preg_match_all($pattern, $contents, $matches, PREG_SET_ORDER);

?>



<?php


// echo file_get_contents('links.txt');
// $url = 'http://www.amazon.com/?/Q/&/write.php';
// $fp = fopen('links.txt', 'a+');
// $contents = fread($fp, filesize('links.txt'));
// fwrite($fp, $url . "\r\n");
// echo '<br/>';

// if (strpos($contents, $url)){
	// echo 'FOUND';
	// echo '<br/>';
	// echo strrpos($contents, $url);
// }else {
	// echo 'NOT FOUND';
	// echo '<br/>';
// }
// echo '<br/><br/>';

// fclose($fp);
?>


<?php
    // $stack = array("fruit1", "fruit2", "fruit3", "fruit4");
    // $fruit = array_shift($stack);
	// echo '<pre>';
    // print_r($stack);
// echo '</pre>';
// echo '<br/>';
    // echo $fruit;
	
	// echo '<br/><br/>';

	
	$stack = array("fruit1", "fruit2", "fruit3", "fruit4");
	$val2 = array_search('fruit4', $stack);
	echo $val2;
	echo '<br/>';
	echo '<pre>';
	  print_r($stack);
	  echo '</pre>';
	
?>



