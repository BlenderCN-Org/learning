 <?php
function is_prime($num){
    for($i=$num;$i > 0;$i--){
        $v = $num / $i;
        if(!is_float($v)){
            if($v != $num && $v != 1)
                return FALSE;
        }
    }
    return TRUE;
}

for($i = 1;$i<=100;$i++){
    if(is_prime($i))
        echo $i.' is prime<br>';
    else
        echo $i.' is not prime<br>';
}
?> 