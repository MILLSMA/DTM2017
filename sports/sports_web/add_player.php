
<?php
	include 'includes/connection.php';
	$get_teams_query = "SELECT teams.team_name, teams.team_id FROM teams ORDER BY teams.team_name ASC";
	$all_teams_results = mysqli_query($dbcon, $get_teams_query);
?>
<h1>Add a New Player</h1>
<form name='add_player' method="post" action='process_edits2.php'>

	First Name: 	<input type='text' name='first_name' required><br>
	Last Name: 		<input type='text' name='last_name' required><br>
	Street Number: 	<input type='text' name='street_num' required><br>
	Street Name: 	<input type='text' name='street_name' required><br>
	Suburb: 		<input type='text' name='suburb' required><br>
	City: 			<input type='text' name='city' required><br>

	Team: <select name='team' required>
		<option>Select Team</option>
		<?php
			// Use while loop to get display every record
			while($all_teams_record = mysqli_fetch_assoc($all_teams_results)){
				echo"<option value = '".$all_teams_record['team_id']."'";
				echo ">".$all_teams_record['team_name']."</option>";
			}
		?>
	</select><br>
	Fees Paid: 
	<input type='radio' name='fees' value='Y'> Yes
	<input type='radio' name='fees' value='N'> No
	<br>
	<input type='submit' name='submit' value='Add Player'>
</form>
