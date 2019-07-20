<!DOCTYPE html>
<html lang="en">
<head>
	<title>Russell's ELO Experiment</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- link rel="stylesheet" type="text/css" href="styles.css" -->
</head>
<body>
<h2>Russell's ELO Matching Example/Experiment</h2><br/>
<?php
$DEBUG = 1;
if(isset($_POST['Winners']) and $_SERVER['REQUEST_METHOD'] == "POST"){
	$Previous_Winner = $_POST['Winners'][6];
	$Previous_Loser = $_POST['Winners'][8];
	echo '<br/>';
	echo 'Winner: ' . $Previous_Winner;
	echo '<br/>';
	echo 'Loser: ' . $Previous_Loser;
	echo '<br/>-------';
	echo '<br/>';
};

require_once('functions.php');

//Configurable Variables

$Root_DIR = 'Actresses'; // Main/Root Directory (all other directories will go here)
$Score_DIR = $Root_DIR . '/Actress_Score/';
$TextName_DIR = $Root_DIR . '/Actress_Name/';
$Picture_DIR = $Root_DIR . '/Actress_Picture/';

//Choose Players
$NUM_Files_in_DIR = count_files_in_DIR($Score_DIR);
$Player1 = RAND(1,$NUM_Files_in_DIR);
$Player2 = RAND(1,$NUM_Files_in_DIR);
while ($Player1 === $Player2){
	$Player2 = RAND(1,$NUM_Files_in_DIR);
};

$Player1_filename = $Score_DIR . $Player1 . '.txt';
$Player2_filename = $Score_DIR . $Player2 . '.txt';

$Player1_picture_filename = $Picture_DIR . $Player1 . '.jpg';
$Player2_picture_filename = $Picture_DIR . $Player2 . '.jpg';

$Player1_text_filename = $TextName_DIR . $Player1 . '.txt';
$Player2_text_filename = $TextName_DIR . $Player2 . '.txt';

//For debugging, or experimentation
if ($DEBUG === 1){
echo 'Main DIR = ' . $Root_DIR;
echo '<br/>';
echo 'Picture DIR (Subdirectory) = ' . $Picture_DIR;
echo '<br/>';
echo 'Score DIR (Subdirectory) = ' . $Score_DIR . ' (Files in Dir: ' . $NUM_Files_in_DIR . ')';
echo '<br/>';
echo 'Text/Name DIR (Subdirectory) = ' . $TextName_DIR;
//echo '<br/>';echo 'Player 1 Random Number = ' . $Player1;
//echo '<br/>';echo 'Player 2 Random Number = ' . $Player2;
echo '<br/>';
echo 'Player 1 Score File: ' . $Player1_filename;
echo '<br/>';
echo 'Player 2 Score File: ' . $Player2_filename;
echo '<br/>';
echo 'Player 1 Picure Path: ' . $Player1_picture_filename;
echo '<br/>';
echo 'Player 2 Picure Path: ' . $Player2_picture_filename;
echo '<br/>';
echo 'Player 1 Text/Name Path: ' . $Player1_text_filename;
echo '<br/>';
echo 'Player 2 Text/Name Path: ' . $Player2_text_filename;
echo '<br/>';
};

//Read Scores from Files
$Player1_currentScore = read($Player1_filename);
$Player1_text = read($Player1_text_filename);

$Player2_currentScore = read($Player2_filename);
$Player2_text = read($Player2_text_filename);

$Player1_ELO = ELO($Player1_currentScore, $Player2_currentScore);
$Player2_ELO = ELO($Player2_currentScore, $Player1_currentScore);

//Display Scores
echo '<strong>';
echo 'Player 1 Name: ' . $Player1_text . ' (Score: ' . $Player1_currentScore . ')';
echo '<br/>';
echo 'Player 2 Name: ' . $Player2_text . ' (Score: ' . $Player2_currentScore . ')';
echo '<br/>';
echo 'Player 1 ELO rating = ' . $Player1_ELO;
echo '<br/>';
echo 'Player 2 ELO rating = ' . $Player2_ELO;
echo '<strong><br/><br/>';

//Display Players
echo '<img src="' . $Player1_picture_filename . '" width="15%" height="15%" />';
echo '<img src="' . $Player2_picture_filename . '" width="15%" height="15%" />';
echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
echo 'Who wins? <button name="Winners" type="submit" value="' . 'array(' . $Player1 . ',' . $Player2 . ')' . '">' . $Player1_text . '</button> ';
echo '<button name="Winners" type="submit" value="' . 'array(' . $Player2 . ',' . $Player1 . ')' . '">' . $Player2_text . '</button>';
echo '</form>';

//Other Functions
function ELO($A, $B){
		return (1/(1+pow(10,(($B-$A)/400))));
};
?>
<br/>
</body></html>