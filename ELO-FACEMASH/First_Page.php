<!DOCTYPE html>
<html lang="en">
<head>
	<title>Russell's ELO Experiment</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- link rel="stylesheet" type="text/css" href="styles.css" -->
</head>
<body>
<h2>ELO Matching Example/Experiment</h2><br/>

<?php
include('functions.php');
$DIR = 'SampleData';
$MAXNUM_Files_in_DIR = count_files_in_DIR($DIR);
echo 'Max Files in Data Directory: ' . $MAXNUM_Files_in_DIR . '<br/>';

//Choose Player Files
$Player1 = RAND(1,$MAXNUM_Files_in_DIR);
$Player2 = RAND(1,$MAXNUM_Files_in_DIR);
while ($Player1 === $Player2){
	$Player2 = RAND(1,$MAXNUM_Files_in_DIR);
};

echo 'Player 1 Name = ' . $Player1;
echo '<br/>';
echo 'Player 2 Name = ' . $Player2;
echo '<br/>';

$Player1_filename = $DIR . '/' . $Player1 . '.txt';
$Player2_filename = $DIR . '/' . $Player2 . '.txt';

echo 'Player 1 File: ' . $Player1_filename;
echo '<br/>';
echo 'Player 2 File: ' . $Player2_filename;

echo '<br/>';echo '<br/>';


$Player1_currentScore = read($Player1_filename);
$Player2_currentScore = read($Player2_filename);
echo '<strong>Player 1 Score: ' . $Player1_currentScore . '</strong>';
echo '<br/>';
echo '<strong>Player 2 Score: ' . $Player2_currentScore . '</strong>';

//Other Functions
function ELO($A, $B){
		return (1/(1+pow(10,(($B-$A)/400))));
};
?>
<br/>
</body></html>