
<?php
	include 'includes/connection.php';
	$player = $_GET['player'];
	
// select all the infomation about the player
	$player_query = "SELECT players.first_name, players.last_name, teams.team_name, players_teams.team_id, players_teams.fees FROM players, teams, players_teams WHERE players.player_id = players_teams.player_id 
		AND teams.team_id = players_teams.team_id 
		AND players.player_id = '".$player."' ORDER BY team_name ASC";
		$player_results = mysqli_query($dbcon, $player_query);
		$rows = mysqli_num_rows($player_results);

		$player_record = mysqli_fetch_assoc($player_results);
		echo "<br>";
		echo "<h3>";
		echo $player_record['first_name']." ".$player_record['last_name'];
		echo "</h3>";

		// select team	
		while($rows > 0){
			echo $rows;
			$rows -= 1;
		}
	?>
	<form name='edit_fees' method='post' action='update_fees.php'>

		<option>Select Team</option>
		<?php
			// Use while loop to get display every record
			while($player_record = mysqli_fetch_assoc($player_results)){
				echo"<option value = '".$player_record['team_id']."'";
				echo ">".$player_record['team_name']."</option>";
			}
		?>
	</select><br>
	<input type='submit' name='submit' value='Add Team'>
</form>



