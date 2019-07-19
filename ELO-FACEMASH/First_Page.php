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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('functions.php');

//Configurable Variables
$Score_DIR = 'Actress_Scores';
$Info_DIR = 'Actress_Info';

//Choose Players
$MAX_NUM_Files_in_DIR = count_files_in_DIR($Score_DIR);
$Player1 = RAND(1,$MAX_NUM_Files_in_DIR);
$Player2 = RAND(1,$MAX_NUM_Files_in_DIR);
while ($Player1 === $Player2){ // To avoid players being the same
	$Player2 = RAND(1,$MAX_NUM_Files_in_DIR);
};

//Print Initial Output (before ELO applied)
echo 'Data DIR Name = ' . $Score_DIR;
echo '<br/>';
echo 'Max Files in Data Directory: ' . $MAX_NUM_Files_in_DIR;
echo '<br/>';
echo 'Player 1 Name = ' . $Player1;
echo '<br/>';
echo 'Player 2 Name = ' . $Player2;
echo '<br/>';

$Player1_filename = $Score_DIR . '/' . $Player1 . '.txt';
$Player2_filename = $Score_DIR . '/' . $Player2 . '.txt';

echo 'Player 1 File: ' . $Player1_filename;
echo '<br/>';
echo 'Player 2 File: ' . $Player2_filename;
echo '<br/>';echo '<br/>';

//Read scores from text files
$Player1_currentScore = read($Player1_filename);
$Player2_currentScore = read($Player2_filename);
echo '<strong>Player 1 Score: ' . $Player1_currentScore . '</strong>';
echo '<br/>';
echo '<strong>Player 2 Score: ' . $Player2_currentScore . '</strong>';
echo '<br/>';
echo $Player1_picture_filename = $Info_DIR . '/' . 'Pictures/' . $Player1 . '.jpg';
echo '<br/>';
echo '<img src="' . $Player1_picture_filename . '">';

//Other Functions
function ELO($A, $B){
		return (1/(1+pow(10,(($B-$A)/400))));
};
?>
<br/>
</body></html>