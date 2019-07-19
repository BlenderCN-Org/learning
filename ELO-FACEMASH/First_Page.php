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
echo $MAXNUM_Files_in_DIR = count_files_in_DIR($DIR);
echo '<br/>';
$Player1 = RAND(1,$MAXNUM_Files_in_DIR);
echo 'Player 1 Name = ' . $Player1;


echo '<br/>';
$Player1_filename = $DIR . '/' . $Player1 . '.txt';
echo 'Player 1 File: ' . $Player1_filename;

echo '<br/>';

echo $Player1_currentScore = read($Player1_filename);


//Other Functions
function ELO($A, $B){
		return (1/(1+pow(10,(($B-$A)/400))));
};
?>
<br/>
</body></html>