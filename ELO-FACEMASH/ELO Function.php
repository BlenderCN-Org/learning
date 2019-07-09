<?php 
function ELO($A, $B){ // the ELO formula taken from http://en.wikipedia.org/wiki/Elo_rating_system
        return (1/(1+pow(10,(($B-$A)/400))));
}
?>