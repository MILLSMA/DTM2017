<!-- Check if player already entered -->
<!-- Add new teams so also add coach page-->
<!-- One player in multiple teams -->


<?php
	include 'includes/connection.php';


	$first_name = trim(mysqli_real_escape_string($dbcon, $_POST['first_name']));
	$last_name = trim(mysqli_real_escape_string($dbcon, $_POST['last_name']));
	$street_num = trim(mysqli_real_escape_string($dbcon, $_POST['street_num']));
	$street_name = trim(mysqli_real_escape_string($dbcon, $_POST['street_name']));
	$suburb = trim(mysqli_real_escape_string($dbcon, $_POST['suburb']));
	$city = trim(mysqli_real_escape_string($dbcon, $_POST['city']));
	$team_id = $_POST['team'];
	$fees = $_POST['fees'];

	// Check data received correctly
	// echo $first_name;
	// echo $last_name;
	// echo $street_num;
	// echo $street_name;
	// echo $suburb;
	// echo $city;

	// Check if the player already exsists
	$check = sprintf("SELECT players.first_name, players.last_name, players.street_num, players.street_name FROM players WHERE players.first_name = '%s' AND players.last_name = '%s' AND players.street_num = '%s' AND players.street_name = '%s'", $first_name, $last_name, $street_num, $street_name);
	$check_result = mysqli_query($dbcon, $check);

	if($check_result){
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

	




	// Check Query
	// echo $add_player_query;
		

	if ($add_player_query and $add_team_query) {echo"Player Added";}
?>








