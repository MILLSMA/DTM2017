<!-- Connect to database -->
<?php
	include 'includes/connection.php';

// PLAYERS SECTION

	// Set up a query to get all team names
	$all_teams_query = "SELECT teams.team_name, teams.team_id
	FROM teams
	ORDER BY teams.team_name ASC";
	$all_teams_results = mysqli_query($dbcon, $all_teams_query);
?>
<h1>Fees Check</h1>

<h3>Teams:</h3>
<form name='teams' action='fees.php' method='get' id='player'>
	<select name='team'>
		<option>Select Team</option>
		<?php
			// Use while loop to get display every record
			while($all_teams_record = mysqli_fetch_assoc($all_teams_results)){
				echo"<option value = '".$all_teams_record['team_id']."'";
					if($_GET['team'] == $all_teams_record['team_id']){
						echo " selected='selected' ";
					}
				echo ">".$all_teams_record['team_name']."</option>";
			}
		?>
	</select>
	<br>
	<h3>Fees:</h3>
<!-- Radio buttons for fees -->
	<?php
		echo "<input type='radio' name='fees' value='Y' ";
		if($_GET['fees']=='Y'){ 
			echo "checked";
		}
		echo "> Yes";
		
	  echo "<input type='radio' name='fees' value='N' ";
	  if($_GET['fees']=='N'){
	  	echo "checked";
	  }
	  echo "> No"
	 ?>
	<input type='submit' value="Search">
</form>

<!-- Display players from select teams with or without teams -->

<?php
	if(isset($_GET['team']) AND isset($_GET['fees'])){
		$team = $_GET[team];
		$fees = $_GET[fees];
		$fees_query = "SELECT players.first_name, players.last_name
		FROM players, teams, players_teams
		WHERE players.player_id = players_teams.player_id
		AND teams.team_id = players_teams.team_id
		AND teams.team_id = '".$team."'
		AND players_teams.fees = '".$fees."'";

		$fees_result = mysqli_query($dbcon, $fees_query);
		$fees_num = mysqli_num_rows($fees_result);

		if($fees_num > 0){
			echo "<h2>Players:</h2>";
			while($fees_record = mysqli_fetch_assoc($fees_result)){
				echo $fees_record['first_name']." ".$fees_record['last_name']."<br>";
			}
		}
		else{
			echo "<h2>No Results </h2>";
		}
	}
?>

