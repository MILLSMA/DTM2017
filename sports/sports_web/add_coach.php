
<?php
	include 'includes/connection.php';
	$get_coaches_query = "SELECT coaches.first_name, coaches.last_name, coaches.coach_id FROM coaches ORDER BY coaches.last_name ASC";
	$all_coaches_results = mysqli_query($dbcon, $get_coaches_query);
?>
<h1>Add a New Coach</h1>
<form name='add_team' method='post' action='process_edits2.php'>


	Team Name: 							<input type='text' name='team_name' required><br>
	Uniform Description: 		<input type='text' name='uniform' required><br>
	Division: 							<input type='text' name='division' required><br>
	Mascot: 								<input type='text' name='mascot' required><br>

	Coach: <select name='coach_id' required>
		<option>Select Coach</option>
		<?php
			// Use while loop to get display every record
			while($all_coaches_record = mysqli_fetch_assoc($all_coaches_results)){
				echo"<option value = '".$all_coaches_record['coach_id']."'";
				echo ">".$all_coaches_record['first_name']." ".$all_coaches_record['last_name']."</option>";
			}
		?>
	</select><br>
	<input type='submit' name='submit' value='Add Coach'>
</form>



<!-- INSERT DATE TYPE DATA: https://html5tutorial.info/html5-date.php -->