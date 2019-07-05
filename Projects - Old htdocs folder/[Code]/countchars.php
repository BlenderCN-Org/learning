<?php
/**
* Counts character occurences in a multibyte string
* @param string $input UTF-8 data
* @return array associative array of characters.
*/
function mb_count_chars($input) {
    $l = mb_strlen($input, 'UTF-8');
    $unique = array();
    for($i = 0; $i < $l; $i++) {
        $char = mb_substr($input, $i, 1, 'UTF-8');
        if(!array_key_exists($char, $unique))
            $unique[$char] = 0;
        $unique[$char]++;
    }
    return $unique;
}

$input = "Russell";
print_r( mb_count_chars($input) );
//returns: Array ( [L] => 1 [e] => 7 [t] => 4 ['] => 1 [s] => 5 [ ] => 9 [r] => 3 [y] => 1 [o] => 1 [m] => 1 [G] => 1 [k] => 1 [l] => 1 [:] => 3 [α] => 5 [Ε] => 1 [ε] => 1 [Ι] => 1 [ι] => 1 [Μ] => 1 [μ] => 1 [Ψ] => 1 [ψ] => 1 [,] => 2 [R] => 1 [u] => 1 [i] => 1 [a] => 1 [n] => 1 [Й] => 2 [Ы] => 2 [Щ] => 1 [Н] => 1 [C] => 1 [z] => 1 [c] => 1 [h] => 1 [ě] => 1 [š] => 1 [č] => 1 [ř] => 1 [ž] => 1 [ý] => 1 [á] => 1 [í] => 1 [é] => 1 )
?>