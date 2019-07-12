<html>
<?php

function ELO($A, $B){ // From http://en.wikipedia.org/wiki/Elo_rating_system
        return (1/(1+pow(10,(($B-$A)/400))));
};

//Code below this written by Russell Rounds
echo '<h3><strong>Russells <a href="http://en.wikipedia.org/wiki/Elo_rating_system">ELO Rating Algorithm</a> Learning Experiment</strong><br/></h3>';

echo '<strong>The algorithm:</strong>';
echo '<font color=green><pre><strong>function ELO($A, $B){
        return <strong>(1/(1+pow(10,(($B-$A)/400))));</strong>
};</pre></font><br/></strong>';

echo '<strong>Same Inputs:</strong><br/>';
echo '• ELO(1,1) = ' . '<font color=red>' . ELO(1,1) . '</font><br/>';
echo '• ELO(1000,1000) = ' . '<font color=red>' . ELO(1000,1000) . '</font><br/>';
echo '• ELO(500,500) = ' . '<font color=red>' . ELO(500,500) . '</font><br/>';
echo '• ELO(100,100) = ' . '<font color=red>' . ELO(100,100) . '</font><br/>';
echo '• ELO(99999,99999) = ' . '<font color=red>' . ELO(99999,99999) . '</font><br/>';

echo '<br/>';

echo '<strong>Different Inputs:</strong><br/>';
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

echo '<strong>Incremental Inputs:</strong><br/>';
echo '• ELO(1,1000) = ' . '<font color=red>' . ELO(1,1000) . '</font><br/>';
echo '• ELO(2,1000) = ' . '<font color=red>' . ELO(2,1000) . '</font><br/>';
echo '• ELO(3,1000) = ' . '<font color=red>' . ELO(3,1000) . '</font><br/>';
echo '• ELO(4,1000) = ' . '<font color=red>' . ELO(4,1000) . '</font><br/>';
echo '• ELO(5,1000) = ' . '<font color=red>' . ELO(5,1000) . '</font><br/>';
echo '<strong>';
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
echo '</strong>';
?>
<br/><br/>
From these inputs and outputs, you should be able to see how it is predicting the score for one player (or both if part of the algorithm is reversed) based on the current ranking (how many games each player has previously won) for both players.  Each decimal number is actually a percentage which just hasn't been converted (.4985XXXX is just 49%, etc.).  From the raw data, it's hard to see that, but if you clean it up and break down the numbers being inputted and outputted for each player, it would be easy to see.<br/><br/>

<strong>For example:</strong><br/>
Player 1 has won 10 games.  Player 2 has won 100 games.  Based on this information alone, and using the ELO algorithm, we'll compute the percentage chance Player 1 has of winning against Player 2.<br/><br/>

The formula for calculating Player 1's chance of winning against Player 2 is: <strong><font color="green">1/(1+pow(10,(($B-$A)/400))).</strong></font><br/>
<strong><?php echo 'Chance Player 1 has of beating Player 2: ' . ELO(10,100) . ' (' . 100*ELO(10,100) . '%)'; ?></strong><br/><br/>

The formula for calculating Player 2's chance of winning against Player 1 is: <strong><font color="green">1/(1+pow(10,(($A-$B)/400))).</font></strong><br/>
<strong><?php echo 'Chance Player 2 has of beating Player 1: ' . ELO(100,10) . ' (' . 100*ELO(100,10) . '%)'; ?></strong><br/><br/>

Why is this important?  For the average web developer, it's not, but it is good to be able to implement a simple algorithm such as this into a program, and that's the only reason for this experiment (which I still haven't really done, so I guess I'll do that next).<br/><br/>


<br/><br/>
See also:<br/>
<a href="https://stackoverflow.com/questions/3848004/facemash-algorithm">https://stackoverflow.com/questions/3848004/facemash-algorithm</a><br/>
<a href="http://en.wikipedia.org/wiki/Elo_rating_system">http://en.wikipedia.org/wiki/Elo_rating_system</a><br/>
<a href="https://en.wikipedia.org/wiki/Elo_hell">https://en.wikipedia.org/wiki/Elo_hell</a><br/>
</html>