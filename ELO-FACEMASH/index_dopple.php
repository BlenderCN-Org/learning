<!DOCTYPE html>
<html lang="en">
<head>
	<title>Russell's ELO Experiment</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<center>
<h2>Russell's ELO Matching Example/Experiment</h2><br/>
<?php
	ob_implicit_flush(true);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	require_once('functions.php');
	
	//To Do:
	// - Randomize Predictions, because they actually give away who is the winner.
	// - Option/variable to hide 2nd prediction, to give user less information.
	
	//Configurable Variables
	$DEBUG = 0;
	$Root_DIR = 'Dopples';
	$Score_DIR = $Root_DIR . '/Actress_Score/';
	$TextName_DIR = $Root_DIR . '/Actress_Name/';
	$Picture_DIR = $Root_DIR . '/Actress_Picture/';

if(isset($_POST) AND $_SERVER['REQUEST_METHOD'] === "POST"){
	if(isset($_POST['Display']) AND $_POST['Display'] === "1"){ // Display Scores
		echo '<div id="Player_Scores" style="position: fixed;border: 1;border-style: dashed;width: 20%;min-height: 10%;left: 7.5%;">';
		echo '</div>';
	};

	if(isset($_POST['Reset']) AND $_POST['Reset'] === "1"){ // Reset Scores
		$number_of_scores_to_reset = count_files_in_DIR($Score_DIR) / 2;
		if($DEBUG){ 
			echo 'Reset Pressed!<br/>';
			echo 'Number of scores to reset = ' . $number_of_scores_to_reset . '<br/>';
		};
		
		for($x = 1; $x <= $number_of_scores_to_reset; $x++){
			$current_filename = $Score_DIR . $x . '.txt';
			$current_D_filename = $Score_DIR . $x . 'D.txt';
			
			if(file_exists($current_filename)){
				if($DEBUG){ echo 'Overwriting ' . $current_filename . ' ...<br/>'; };
				write($current_filename, 1500);
			};
			if(file_exists($current_D_filename)){
				if($DEBUG){ echo 'Overwriting ' . $current_D_filename . ' ...<br/>'; };
				write($current_D_filename, 1500);
			};
			
		};
		if($DEBUG){ echo 'Scores Reset.<br/>'; };
	};

	if(isset($_POST['Winners'])){ // Winner chosen
		
		if($_POST['Winners'][8] === ","){ // Bug fix for "D Player" array-error. Will need update whenever player #s are in triple digits (To fully fix, send different values for each Winner's button instead of an array, and separate winners via if statements after/in the $_POST request).
			if ($DEBUG){ echo 'First element is "D" Player<br/>'; };
			$winner = $_POST['Winners'][6] . $_POST['Winners'][7];
			$Loser = $_POST['Winners'][9];
		}else{
			if ($DEBUG){ echo 'Second element is "D" Player<br/>'; };
			$winner = $_POST['Winners'][6];
			$Loser = $_POST['Winners'][8] . $_POST['Winners'][9];
		};
		
		$WinnerScoreFilename = $Score_DIR . $winner . '.txt';
		$Winner_Old_Score = read($WinnerScoreFilename);
		$LoserScoreFilename = $Score_DIR . $Loser . '.txt';
		$Loser_Old_Score = read($LoserScoreFilename);
		
		//FIDE's Implementation of score distribution:
		$k = 32; // ELO K value
		$Winner_Previous_ELO_Expected_Score = ELO($Winner_Old_Score, $Loser_Old_Score);
		$Loser_Previous_ELO_Expected_Score = ELO($Loser_Old_Score, $Winner_Old_Score);
		
		$WinnerTotalPoints = $Winner_Old_Score + $k * (1 - $Winner_Previous_ELO_Expected_Score); 
		$LoserTotalPoints = $Loser_Old_Score + $k * (0 - $Loser_Previous_ELO_Expected_Score);
		
		//Update scores for both players
		if(write($WinnerScoreFilename, $WinnerTotalPoints)){
			echo '<font color="green"><strong>Winner score updated! (Old Score: ' . $Winner_Old_Score . ') (New Score: ' . $WinnerTotalPoints . ')' . '</font></strong><br/>';
			
			if($LoserTotalPoints > 0){ // Make loser not go negative - Not needed anymore
				write($LoserScoreFilename, $LoserTotalPoints);
				echo '<font color="green"><strong>Loser score updated! (Old Score: ' . $Loser_Old_Score . ') (New Score: ' . $LoserTotalPoints . ')' . '</font></strong><br/>';
			}else{
				echo '<font color="red"><strong>Loser score would be negative and was NOT UPDATED!' . ' (New Score: ' . $LoserTotalPoints . ')'. '</font></strong><br/>';
			};
		}; 

		if($DEBUG){
			echo '<br/><strong>Last Round:</strong><br/>';
			echo 'Winner: ' . $winner . ' (' . read($TextName_DIR . $winner . '.txt') . ') ' . ' (Score: ' . read($Score_DIR . $winner . '.txt') . ')';
			echo ' (Old Score: ' . $Winner_Old_Score . ')<br/>';
			echo 'Loser: ' . $Loser . ' (' . read($TextName_DIR . $Loser . '.txt') . ') ' . ' (Score: ' . read($Score_DIR . $Loser . '.txt') . ')';
			echo ' (Old Score: ' . $Loser_Old_Score . ')<br/>';
			echo '<br/>-----------------------------------------<br/>';
		};
	};
		if($DEBUG){
			echo '<pre>';
			echo '$_POST DATA: ';
			print_r($_POST);
			echo '</pre>';
		};
			
};// --------------------------------- End $_POSTs

	//New Game - Choose Players
	$NUM_Files_in_DIR = count_files_in_DIR($TextName_DIR);
	$NUM_Sets_of_Dopples = $NUM_Files_in_DIR / 2; // Divide by 2 since we're doing "sets" of numbers now
	
	//Randomize Player Pictures
	$Designated = 1; // Choose which of the two players (D or Numbered/Non-D) is designated player: 1 for Non-D/Numbered Player, 0 or 2 for D-Player
	if(RAND(1,2) === 1){
		$Player1 = RAND(1,$NUM_Sets_of_Dopples);
		$Player2 = $Player1 . 'D';
		
		if($Designated === 1){ // Must have designated player or people won't know who they're voting for
			$Designated_Player = $Player1; // Non-D Player will be designated player
		}else{
			$Designated_Player = $Player2; // D Player will be designated
		}
	}else{
		$Player2 = RAND(1,$NUM_Sets_of_Dopples);
		$Player1 = $Player2 . 'D'; // Switch players
		
		if($Designated === 1){
			$Designated_Player = $Player2; // Non-D Player will be designated player
		}else{
			$Designated_Player = $Player1; // D Player will be designated player
		}
	};
	
	if($DEBUG){
		echo 'Players Chosen!<br/>';
		echo 'Player 1: ' . $Player1 . '<br/>';
		echo 'Player 2: ' . $Player2 . '<br/>';
	};
	
	$Player1_filename = $Score_DIR . $Player1 . '.txt';
	$Player2_filename = $Score_DIR . $Player2 . '.txt';

	$Player1_picture_filename = $Picture_DIR . $Player1 . '.jpg';
	$Player2_picture_filename = $Picture_DIR . $Player2 . '.jpg';

	$Player1_name_filename = $TextName_DIR . $Player1 . '.txt';
	$Player2_name_filename = $TextName_DIR . $Player2 . '.txt';
	
	if(isset($Designated_Player)){
		$Designated_Player_Text = read($TextName_DIR . $Designated_Player . '.txt');
	};

	//Check and/or create score file for Player 1
	if(file_exists($Player1_filename) != TRUE){
		if($DEBUG){ echo '<br/><font color="red">Player 1 Score File Not Found.</font><br/>'; };
		
		if(write($Player1_filename, 1500)){
			if($DEBUG){ echo '<font color="green">Player 1 Score File Written!</font><br/>'; };
		}else{
			if($DEBUG){ echo '<br/><font color="red">Player 1 Score File <strong>creation</b> also failed.</strong><br/>'; };
		}
	}else{
		if($DEBUG){ echo 'Player 1 Score File Exists!<br/>'; };
	};
	
	//Check and/or create score file for Player 2
	if(file_exists($Player2_filename) != TRUE){
		if($DEBUG){ echo '<br/><font color="red">Player 2 Score File Not Found.</font><br/>'; };
		
		if(write($Player2_filename, 1500)){
			if($DEBUG){ echo '<font color="green">Player 2 Score File Written!</font><br/>'; };
		}else{
			if($DEBUG){ echo '<br/><font color="red">Player 2 Score File <strong>creation</b> also failed.</strong><br/>'; };
		}
	}else{
		if($DEBUG){ echo 'Player 2 Score File Exists!<br/>'; };
	};
	
	//Debugging output
	if ($DEBUG){
		echo 'Main DIR = /' . $Root_DIR;
		echo '<br/>';
		echo '$Score_DIR (Subdirectory) = ' . $Score_DIR . ' (Files in Dir: ' . count_files_in_DIR($Score_DIR) . ')<br/>';
		echo '$TextName_DIR (Subdirectory) = ' . $TextName_DIR . ' (Files in Dir: ' . count_files_in_DIR($TextName_DIR) . ')<br/>';
		echo '$Picture_DIR (Subdirectory) = ' . $Picture_DIR . ' (Files in Dir: ' . count_files_in_DIR($Picture_DIR) . ')<br/>';
		echo 'Player 1 Score File: ' . $Player1_filename;
		echo '<br/>';
		echo 'Player 2 Score File: ' . $Player2_filename;
		echo '<br/>';
		echo 'Player 1 Picure Path: ' . $Player1_picture_filename;
		echo '<br/>';
		echo 'Player 2 Picure Path: ' . $Player2_picture_filename;
		echo '<br/>';
		echo 'Player 1 Text/Name Path: ' . $Player1_name_filename;
		echo '<br/>';
		echo 'Player 2 Text/Name Path: ' . $Player2_name_filename;
		echo '<br/>-----------------------------------------<br/>';
	};

	//Read current scores, and calculate ELO
	$Player1_currentScore = read($Player1_filename);
	$Player1_name = read($Player1_name_filename);

	$Player2_currentScore = read($Player2_filename);
	$Player2_name = read($Player2_name_filename);

	$Player1_ELO = ELO($Player1_currentScore, $Player2_currentScore);
	$Player2_ELO = ELO($Player2_currentScore, $Player1_currentScore);

	//Make Prediction
	$ELO_Link = '<a href="https://en.wikipedia.org/wiki/Elo_rating_system">ELO Rating</a>';
	if($Player1_ELO === $Player2_ELO){
		$Prediction = '<font color="red"><strong>Both players have an <strong>equal chance</strong> to win</strong></font>, with both having an ' . $ELO_Link . ' of <strong><font color="red">' . $Player1_ELO . ' (' . Round(100 * $Player2_ELO, 3) . '%)' . '</strong></font>';
	}else{
		if($Player1_ELO > $Player2_ELO){
				$Prediction = 'Based on previous user input, <font color="green"><strong>Player 1</font></strong> is most likely <strong>' . $Designated_Player_Text . '</strong>, with an ' . $ELO_Link . ' of <font color="green"><strong>' . Round(100 * $Player1_ELO, 3) . '%.' . '</strong></font>';
				$Prediction_2 = 'Based on previous user input, <font color="red"><strong>Player 2</font></strong> is most likely <strong>NOT ' . $Designated_Player_Text . '</strong>, with an ' . $ELO_Link . ' of <font color="red"><strong>' . Round(100 * $Player2_ELO, 3) . '%.' . '</strong></font>';
		};
		if($Player1_ELO < $Player2_ELO){
				$Prediction = 'Based on previous user input, <font color="green"><strong>Player 2</font></strong> is most likely <strong>' . $Designated_Player_Text . '</strong>, with an ' . $ELO_Link . ' of <font color="green"><strong>' . Round(100 * $Player2_ELO, 3) . '%.' . '</strong></font>';
				$Prediction_2 = 'Based on previous user input, <font color="red"><strong>Player 1</font></strong> is most likely <strong>NOT ' . $Designated_Player_Text . '</strong>, with an ' . $ELO_Link . ' of <font color="red"><strong>' . Round(100 * $Player1_ELO, 3) . '%.' . '</strong></font>';
		};
	};
	//Display Score/Info for both players for debug
	if($DEBUG){
		echo '<br/>Player 1 (Left): ' . $Player1_name . ' (<strong>Score: ' . $Player1_currentScore . '</strong>) ' . '(<strong>ELO: ' . $Player1_ELO . ' ---<font color="red"> ' . (100 * $Player1_ELO) . '%</font></strong>)';
		echo '<br/>Player 2 (Right): ' . $Player2_name . ' (<strong>Score: ' . $Player2_currentScore . '</strong>) ' . '(<strong>ELO: ' . $Player2_ELO . ' ---<font color="red"> ' . (100 * $Player2_ELO) . '%</font></strong>)';
	};
	
	//Display Prediction
	echo '<br/><br/>' . $Prediction;
	if(isset($Prediction_2)){ 
		echo '<br/>' . $Prediction_2;
	};
	echo '<br/><br/>';

	//Display Player Pictures
	$Picture_Width_Percentage = '20%';
	$Picture_Height_Percentage = '20%';
	echo '<img src="' . $Player1_picture_filename . '" width="' . $Picture_Width_Percentage . '" height="' . $Picture_Height_Percentage . '" />';
	echo '<img src="' . $Player2_picture_filename . '" width="' . $Picture_Width_Percentage . '" height="' . $Picture_Height_Percentage . '" /><br/>';
	
	//Display Buttons/Form
	echo 'Choose below:';
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
	echo '<button name="Winners" type="submit" value="' . 'array(' . $Player1 . ',' . $Player2 . ')' . '">This is ';
	if(isset($Designated_Player_Text)){
		echo $Designated_Player_Text . '</button> ';
	}else{
		echo $Player1_name . '</button> '; // To display if not using randomized version
	};
	echo '<button name="Winners" type="submit" value="' . 'array(' . $Player2 . ',' . $Player1 . ')' . '">No, this is ';
	if(isset($Designated_Player_Text)){
		echo $Designated_Player_Text . '</button> ';
	}else{
		echo $Player1_name . '</button> '; // To display if not using randomized version
	};
	echo '<br/><br/>';
	echo '<button name="Reveal" type="button" value="1">Reveal the True ' . $Designated_Player_Text . '</button>';
	echo '<br/><br/>';
	echo '<button name="Display" type="submit" value="1">Display All Scores</button>';
	echo '<br/><br/>';
	echo '<button name="Reset" type="submit" value="1">Reset All Scores</button>';
	echo '</form>';
?>
</center><br/>
</body></html>