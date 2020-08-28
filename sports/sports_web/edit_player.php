<?php
	include 'includes/connection.php';

	$all_players_query = "SELECT * FROM players ORDER BY last_name ASC";
	$all_players_result = mysqli_query($dbcon, $all_players_query);
?>

<!-- Select player to edit -->
<h1>Edit Player Infomation</h1>
<form name='select_player' action='edit_player.php' method='get' id='player'>
	<select name='player'>
		<option>Select Player</option>
		<?php
			// Use while loop to get display every record
			while($all_players_record = mysqli_fetch_assoc($all_players_result)){
				echo"<option value = '".$all_players_record['player_id']."'";
				// Show current pl;ayer as firts option if already selected
					if($_GET['player'] == $all_players_record['player_id']){
						echo " selected='selected' ";
					}
				echo ">".$all_players_record['first_name']." ".$all_players_record["last_name"]."</option>";
			}
		?>
	</select>
	<input type='submit' name='submit' value="Edit Player">
</form>

<?php
	if (isset($_GET['player'])){
		$player_id = $_GET['player'];
		$select_player_query = sprintf("SELECT * FROM players WHERE player_id = '%s'", $player_id);
		$player_result = mysqli_query($dbcon, $select_player_query);
		$player_record = mysqli_fetch_assoc($player_result);
?>
<!-- Edit slected player infomation form -->
		<form name='edit_player' method="post" action='process_edits2.php'>
<?php
		// include player_id but hidden. Needed to pass into update query
			echo sprintf("<input style='display: none;' type='text'
			name='player_id' value='%s'>",$player_record['player_id']);

			echo"<h2>Edit Infomation: </h2>";
			echo sprintf("First Name: <input type='text' name='first_name' required value='%s'><br>
			Last Name: <input type='text' name='last_name' required value='%s'><br>
			Street Number: <input type='text' name='street_num' required value='%s'><br>
			Street Name: <input type='text' name='street_name' required value='%s'><br>
			Suburb: <input type='text' name='suburb' required value='%s'><br>
			City: <input type='text' name='city' required value='%s'><br>",$player_record['first_name'], $player_record['last_name'], $player_record['street_num'], $player_record['street_name'], $player_record['suburb'], $player_record['city']);

		echo"<input type='submit' name='submit' value='Edit Infomation'>
		</form>";
	}
?>
