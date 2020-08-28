<!-- Connect to database -->
<?php
	include 'includes/connection.php';

// PLAYERS SECTION

	// Set up a query to get all player data
	$all_players_query = "SELECT players.first_name, players.last_name, players.player_id 
		FROM players
		ORDER BY last_name ASC";
	$all_players_result = mysqli_query($dbcon, $all_players_query);	
// query to get all team names
	$all_teams_query = "SELECT teams.team_name, teams.team_id FROM teams ORDER BY teams.team_name ASC";
	$all_teams_results = mysqli_query($dbcon, $all_teams_query);
?>

<!-- HTML FORM For teams and players -->
<h1>Search</h1>
<form name='players_teams' action='index.php' method='get' id='player'>
	<select name='player'>

		<option>Select Player</option>
		<?php
			// Use while loop to get display every record
			while($all_players_record = mysqli_fetch_assoc($all_players_result)){
				echo"<option value = '".$all_players_record['player_id']."'";
				// if a player is already selected, preset menu
					if($_GET['player'] == $all_players_record['player_id']){
						echo " selected='selected' ";
					}
				echo ">".$all_players_record['first_name']." ".$all_players_record["last_name"]."</option>";
			}
		?>
	</select>
	<input type='submit' value="Search">
	<select name='team'>
		<option>Select Team</option>
		<?php
			// Use while loop to get display every record
			while($all_teams_record = mysqli_fetch_assoc($all_teams_results)){
				echo"<option value = '".$all_teams_record['team_id']."'";
				// if team already selected, set menu option
					if($_GET['team'] == $all_teams_record['team_id']){
						echo " selected='selected' ";
					}
				echo ">".$all_teams_record['team_name']."</option>";
			}
		?>
	</select>
	<input type='submit' value="Search">
</form>

<?php
	// Set up a query to get select player data
	if(isset($_GET[player])){
		$player = $_GET[player];
			$select_player_query = "SELECT players.first_name, players.last_name, players.street_num, players.street_name, players.suburb, teams.team_name 
				FROM players, players_teams, teams 
				WHERE players.player_id = players_teams.player_id 
				AND teams.team_id = players_teams.team_id 
				AND players.player_id = '".$player."'";
			$select_player_result = mysqli_query($dbcon, $select_player_query);
?>

<?php
// Use while loop to get display selected record
		$first = 1;
		while($select_player_record = mysqli_fetch_assoc($select_player_result)){
			if($first == 1){ // displays the first items (name) first
				echo"<h2> ".$select_player_record['first_name']." ".$select_player_record['last_name']."</h2>";
				$first = 0;	
				echo "<button><a href='update_fees.php?player=".$_GET['player']."'>Edit Fees</a></button>";
				echo "<ul>";
			}
			echo "<li>".$select_player_record["team_name"]."</li>";
		}
		echo "</ul>";
	}
?>

<?php
	// Set up a query to get select team data
	if(isset($_GET[team])){
		$team = $_GET[team];
			$select_team_query = "SELECT teams.team_name, teams.uniform, teams.mascot, teams.coach_id, coaches.first_name, coaches.last_name
				FROM teams, coaches
				WHERE teams.coach_id = coaches.coach_id
				AND teams.team_id = '".$team."'";
			$select_team_result = mysqli_query($dbcon, $select_team_query);
// Use while loop to get display selected record
		while($select_team_record = mysqli_fetch_assoc($select_team_result)){
			echo"<h2> ".$select_team_record["team_name"]."</h2>";
			echo "<b>Uniform: </b>".$select_team_record['uniform']."<br><b>Mascot: </b>".$select_team_record['mascot']."<br><b>Coach: </b>".$select_team_record['first_name']." ".$select_team_record['last_name'];
		}
	}
?>
<br>
