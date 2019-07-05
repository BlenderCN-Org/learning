<?php 
$AntePost = date("P"); 
$time = date("g:i:s"); 
if($AntePost == "AM"){ 
    echo 'Good Morning!'; 
}else{ 
    echo 'Good Evening!'; 
} 
?>