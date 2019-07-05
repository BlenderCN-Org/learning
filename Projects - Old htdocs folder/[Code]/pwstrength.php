 <?php
/**
 * 
 * @param String $string
 * @return float
 * 
 * Returns a float between 0 and 100. The closer the number is to 100 the
 * the stronger password is; further from 100 the weaker the password is.
 */
 function password_strength($string){
    $h    = 0;
    $size = strlen($string);
	echo '$size = ' . $size . '<br/>';
    foreach(count_chars($string, 1) as $v){
		echo $v . ':';
        $p = $v / $size;
		echo '<br/>$p = ' . $p . '<br/>';
        $h -= $p * log($p) / log(2);
    }
    $strength = ($h / 4) * 100;
    if($strength > 100){
        $strength = 100;
    }
    return $strength;
}password_strength("Russell");
echo "<br>";
/* var_dump(password_strength("Super Monkey Ball"));
echo "<br>";
var_dump(password_strength("Tr0ub4dor&3"));
echo "<br>";
var_dump(password_strength("abc123"));
echo "<br>";
var_dump(password_strength("sweet"));   */
	
	
	
/* 	$h    = 0;
	$string = 'Russell';
	$size = strlen($string);
    echo '<br/>';
	foreach(count_chars($string, 1) as $v){
        $p = $v / $size;
        $h -= $p * log($p) / log(2);
		echo $v . ":";
    }
	echo '<br>'; */

	

	/* $stringa = "Russell";
	$h    = 0;
    $size = strlen($stringa);
    foreach(count_chars($stringa, 1) as $v){
		echo $v;
        $p = $v / $size;
        $h -= $p * log($p) / log(2);
    }
    $strength = ($h / 4) * 100;
    if($strength > 100){
        $strength = 100;
    } 
 */
	
	


$bytes2 = bin2hex(openssl_random_pseudo_bytes(200, $cstrong));
$bytes2 = bin2hex(openssl_random_pseudo_bytes(100, $cstrong));
echo 'Bytes :' . $bytes2;
echo '</pre>';

	
	
?>