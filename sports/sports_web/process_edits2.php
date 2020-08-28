
<?php
	include 'includes/connection.php';

	$submit = $_POST['submit'];

// 	--------------ADD PLAYER--------------
	if($submit=='Add Player'){
		$first_name = trim(mysqli_real_escape_string($dbcon, $_POST['first_name']));
		$last_name = trim(mysqli_real_escape_string($dbcon, $_POST['last_name']));
		$street_num = trim(mysqli_real_escape_string($dbcon, $_POST['street_num']));
		$street_name = trim(mysqli_real_escape_string($dbcon, $_POST['street_name']));
		$suburb = trim(mysqli_real_escape_string($dbcon, $_POST['suburb']));
		$city = trim(mysqli_real_escape_string($dbcon, $_POST['city']));
		$team_id = $_POST['team'];
		$fees = $_POST['fees'];

		// Check if the player already exsists
		$check = sprintf("SELECT players.first_name, players.last_name, players.street_num, players.street_name FROM players WHERE players.first_name = '%s' AND players.last_name = '%s' AND players.street_num = '%s' AND players.street_name = '%s'", $first_name, $last_name, $street_num, $street_name);
		$check_result = mysqli_query($dbcon, $check);
		$rows = mysqli_num_rows($check_result);

		if($rows >= 1){
			echo "Already Added";
		}
		// else add the player  
		else{
			// Query to add info to database
			$add_player_query = sprintf("INSERT INTO players(first_name, last_name, street_num, street_name, suburb, city) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')", $first_name, $last_name, $street_num, $street_name, $suburb, $city);
			$add_player_result = mysqli_query($dbcon, $add_player_query);
	// Query to add team 
		$add_team_query = sprintf("INSERT INTO players_teams (player_id, team_id, fees)
		VALUES ((SELECT players.player_id FROM players WHERE players.first_name = '%s' AND players.last_name = '%s'), '%s', '%s')", $first_name, $last_name, $team_id, $fees);
		$add_team_result = mysqli_query($dbcon, $add_team_query);

		}
		if ($add_player_query and $add_team_query) {echo "<h2>Player ".$first_name." ".$last_name." Added!</h2>";;}
	// 	--------------ADD TEAM--------------
	}else if ($submit=='Add Team'){
		$team_name = trim(mysqli_real_escape_string($dbcon, $_POST['team_name']));
		$uniform = trim(mysqli_real_escape_string($dbcon, $_POST['uniform']));
		$division = trim(mysqli_real_escape_string($dbcon, $_POST['division']));
		$mascot = trim(mysqli_real_escape_string($dbcon, $_POST['mascot']));
		$coach_id = $_POST['coach_id'];

		// Check if the team already exsists
		$check = "SELECT teams.team_name FROM teams WHERE teams.team_name = '".$team_name."'";
		$check_result = mysqli_query($dbcon, $check);
		$rows = mysqli_num_rows($check_result);
		if($rows >= 1){ echo "Team Name Taken or Already Added";}
		else{//add the team if the name isn't taken
			$new_team_query = sprintf("INSERT INTO teams(team_name, uniform, division, mascot, coach_id) VALUES('%s', '%s', '%s', '%s', '%s')",$team_name, $uniform, $division, $mascot, $coach_id);
			$new_team_result = mysqli_query($dbcon, $new_team_query);
			echo "<h2>Team ".$team_name." Added!</h2>";
		}
	// --------------EDIT PLAYER--------------
		}else if ($submit=='Edit Infomation'){
			echo "Updating Info please wait...";
			$first_name = trim(mysqli_real_escape_string($dbcon, $_POST['first_name']));
			$last_name = trim(mysqli_real_escape_string($dbcon, $_POST['last_name']));
			$street_num = trim(mysqli_real_escape_string($dbcon, $_POST['street_num']));
			$street_name = trim(mysqli_real_escape_string($dbcon, $_POST['street_name']));
			$suburb = trim(mysqli_real_escape_string($dbcon, $_POST['suburb']));
			$city = trim(mysqli_real_escape_string($dbcon, $_POST['city']));
			$player_id = $_POST['player_id'];
		}
?>