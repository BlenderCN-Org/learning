<!DOCTYPE html>
<html lang="en">
<head>
	<title>Russell's ELO Experiment</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<h2>Russell's ELO Matching Example/Experiment</h2><br/>
<?php
include_once("functions.php");
ob_implicit_flush(true);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//Configurable Variables
$DEBUG = 1;
$Root_DIR = 'Actresses'; // Main/Root Directory (all other directories will go here)
$Score_DIR = $Root_DIR . '/Actress_Score/';
$TextName_DIR = $Root_DIR . '/Actress_Name/';
$Picture_DIR = $Root_DIR . '/Actress_Picture/';

if(isset($_POST['Winners']) and $_SERVER['REQUEST_METHOD'] === "POST"){
	$Previous_Winner = $_POST['Winners'][6];
	$Previous_Loser = $_POST['Winners'][8];
	$WinnerScoreFilename = $Score_DIR . $Previous_Winner . '.txt';
	$Winner_Old_Score = read($WinnerScoreFilename);
	$LoserScoreFilename = $Score_DIR . $Previous_Loser . '.txt';
	$Loser_Old_Score = read($LoserScoreFilename);
	$points_won_by_winner = ($Loser_Old_Score / 4) + 4; // My own creation
	$points_lost_by_loser = ($Winner_Old_Score / 4) - 4;
	
	//Update scores for both players
	$WinnerTotalPoints = $Winner_Old_Score + $points_won_by_winner;
	write($WinnerScoreFilename, $WinnerTotalPoints);
	echo '<font color="green"><strong>Winner score updated!</font></strong>';
	echo '<br/>';
	
	if($Loser_Old_Score > $points_lost_by_loser){
		$LoserTotalPoints = $Loser_Old_Score - $points_lost_by_loser;
		write($LoserScoreFilename, $LoserTotalPoints);
		echo '<font color="green"><strong>Loser score updated!</font></strong>';
		echo '<br/>';
	};
	
	//Debugging Info
	if($DEBUG == 1){
	echo '<strong>Last Game:</strong><br/>';
	echo '<br/>';
	echo 'Points: ' . $points_won_by_winner;
	echo '<br/>';
	echo 'Winner: ' . $Previous_Winner . ' (' . read($TextName_DIR . $Previous_Winner . '.txt') . ')';
	echo '<br/>';
	echo 'Loser: ' . $Previous_Loser . ' (' . read($TextName_DIR . $Previous_Loser . '.txt') . ')';
	echo '<br/>';
	echo 'Winner Score: ' . read($Score_DIR . $Previous_Winner . '.txt');
	echo '<br/>';
	echo 'Loser Score: ' . read($Score_DIR . $Previous_Loser . '.txt');
	echo '<br/>-----------<br/>';
	};
};

//New Game - Choose Players
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
echo 'Main DIR = /' . $Root_DIR;
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

//Read current scores, and calculate odds
$Player1_currentScore = read($Player1_filename);
$Player1_text = read($Player1_text_filename);

$Player2_currentScore = read($Player2_filename);
$Player2_text = read($Player2_text_filename);

$Player1_ELO = ELO($Player1_currentScore, $Player2_currentScore);
$Player2_ELO = ELO($Player2_currentScore, $Player1_currentScore);

$ELO_Link = '<a href="https://en.wikipedia.org/wiki/Elo_rating_system">ELO Rating</a>';
if($Player1_ELO === $Player2_ELO){
	$Prediction = '<font color="red"><strong>Both players have an equal chance to win</strong></font>, with both having an ' . $ELO_Link . ' of <strong><font color="red">' . $Player1_ELO . '</strong></font>, and <strong><font color="red">' . $Player2_ELO . '</font></strong>';
};
if($Player1_ELO > $Player2_ELO){
		$Prediction = '<font color="red"><strong>Player 1 will most likely win</font></strong>, with an ' . $ELO_Link . ' of <strong><font color="red">' . $Player1_ELO . '</font></strong>';
};
if($Player1_ELO < $Player2_ELO){
		$Prediction = '<font color="red"><strong>Player 2 will most likely win</font></strong>, with an ' . $ELO_Link . ' of <font color="red"><strong>' . $Player2_ELO . '</strong></font>';
};


//Display Scores
echo 'Player 1 (Left): ' . $Player1_text . ' (Score: ' . $Player1_currentScore . ')';
echo '<br/>';
echo 'Player 2 (Right): ' . $Player2_text . ' (Score: ' . $Player2_currentScore . ')';
echo '<br/>';
echo 'Player 1 ELO rating = ' . $Player1_ELO;
echo '<br/>';
echo 'Player 2 ELO rating = ' . $Player2_ELO;
echo '<br/>';
echo $Prediction;
echo '<br/><br/>';

//Display Players
echo '<img src="' . $Player1_picture_filename . '" width="15%" height="15%" />';
echo '<img src="' . $Player2_picture_filename . '" width="15%" height="15%" />';
echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
echo 'Who wins? <button name="Winners" type="submit" value="' . 'array(' . $Player1 . ',' . $Player2 . ')' . '">' . $Player1_text . '</button> ';
echo '<button name="Winners" type="submit" value="' . 'array(' . $Player2 . ',' . $Player1 . ')' . '">' . $Player2_text . '</button>';
echo '</form>';
?>
<br/>
</body></html>