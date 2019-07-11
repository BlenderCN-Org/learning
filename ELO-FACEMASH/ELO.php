<html>
<?php
function ELO($A, $B){ // From http://en.wikipedia.org/wiki/Elo_rating_system
        return (1/(1+pow(10,(($B-$A)/400))));
};


//All code below this written by Russell Rounds
echo '<strong>Russells <a href="http://en.wikipedia.org/wiki/Elo_rating_system">ELO Rating Algorithm</a> Learning Experiment</strong><br/><br/>';

echo 'The algorithm:';
echo '<font color=green><pre><strong>function ELO($A, $B){
        return (1/(1+pow(10,(($B-$A)/400))));
};</pre></font><br/></strong>';

echo 'Now, lets run some numbers through it:<br/>';
echo 'These are all for Player A (algorithm will be different for Player B)<br/><br/>';

echo 'Same numbers:<br/>';
echo '• ELO(1,1) = ' . '<font color=red>' . ELO(1,1) . '</font><br/>';
echo '• ELO(1000,1000) = ' . '<font color=red>' . ELO(1000,1000) . '</font><br/>';
echo '• ELO(500,500) = ' . '<font color=red>' . ELO(500,500) . '</font><br/>';
echo '• ELO(100,100) = ' . '<font color=red>' . ELO(100,100) . '</font><br/>';
echo '• ELO(99999,99999) = ' . '<font color=red>' . ELO(99999,99999) . '</font><br/>';

echo '<br/>';

echo 'Different Inputs:<br/>';
echo '• ELO(500,1000) = ' . '<font color=red>' . ELO(500,1000) . '</font><br/>';
echo '• ELO(1000,500) = ' . '<font color=red>' . ELO(1000,500) . '</font><br/>';
echo '• ELO(50,100) = ' . '<font color=red>' . ELO(50,100) . '</font><br/>';
echo '• ELO(100,50) = ' . '<font color=red>' . ELO(100,50) . '</font><br/>';
echo '• ELO(200,400) = ' . '<font color=red>' . ELO(200,400) . '</font><br/>';
echo '• ELO(400,200) = ' . '<font color=red>' . ELO(400,200) . '</font><br/>';
echo '• ELO(4,2) = ' . '<font color=red>' . ELO(4,2) . '</font><br/>';
echo '• ELO(2,4) = ' . '<font color=red>' . ELO(2,4) . '</font><br/>';
echo '• ELO(1,100) = ' . '<font color=red>' . ELO(1,100) . '</font><br/>';
echo '• ELO(100,1) = ' . '<font color=red>' . ELO(100,1) . '</font><br/>';
echo '• ELO(1,1000) = ' . '<font color=red>' . ELO(1,1000) . '</font><br/>';
echo '• ELO(1000,1) = ' . '<font color=red>' . ELO(1000,1) . '</font><br/>';

echo '<br/>';

echo 'Incremental Inputs:<br/>';
echo '• ELO(1,1000) = ' . '<font color=red>' . ELO(1,1000) . '</font><br/>';
echo '• ELO(2,1000) = ' . '<font color=red>' . ELO(2,1000) . '</font><br/>';
echo '• ELO(3,1000) = ' . '<font color=red>' . ELO(3,1000) . '</font><br/>';
echo '• ELO(4,1000) = ' . '<font color=red>' . ELO(4,1000) . '</font><br/>';
echo '• ELO(5,1000) = ' . '<font color=red>' . ELO(5,1000) . '</font><br/>';
echo '• ELO(1,100) = ' . '<font color=red>' . ELO(1,100) . '</font><br/>';
echo '• ELO(2,100) = ' . '<font color=red>' . ELO(2,100) . '</font><br/>';
echo '• ELO(3,100) = ' . '<font color=red>' . ELO(3,100) . '</font><br/>';
echo '• ELO(4,100) = ' . '<font color=red>' . ELO(4,100) . '</font><br/>';
echo '• ELO(5,100) = ' . '<font color=red>' . ELO(5,100) . '</font><br/>';
echo '• ELO(10,100) = ' . '<font color=red>' . ELO(10,100) . '</font><br/>';
echo '• ELO(25,100) = ' . '<font color=red>' . ELO(25,100) . '</font><br/>';
echo '• ELO(50,100) = ' . '<font color=red>' . ELO(50,100) . '</font><br/>';
echo '• ELO(75,100) = ' . '<font color=red>' . ELO(75,100) . '</font><br/>';
echo '• ELO(90,100) = ' . '<font color=red>' . ELO(90,100) . '</font><br/>';
echo '• ELO(99,100) = ' . '<font color=red>' . ELO(99,100) . '</font><br/>';

echo '<br/>';

?>
See also:<br/>

<a href="https://en.wikipedia.org/wiki/Elo_hell">https://en.wikipedia.org/wiki/Elo_hell</a>
</html>