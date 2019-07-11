
<?php
header('content-type: application/json; charset=utf-8');
print "<html>";

function ELO($A, $B){ // From http://en.wikipedia.org/wiki/Elo_rating_system
        return (1/(1+pow(10,(($B-$A)/400))));
};

//All code below this written by Russell Rounds
$eloResult = ELO(100,200);
echo '<br/>' . 'Value of $eloResult: ' . print_r($eloResult);
?>