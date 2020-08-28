<!-- Connect to database -->
<link href="css/styles.css" rel="stylesheet">
<?php
	$dbcon = mysqli_connect('localhost', 'root', '', 'sports_db');
	if(!$dbcon){
		echo"<h3>Error: Connection Unsuccessful</h3>";
		exit();
	}else{
		// echo"<h3>Connection Successful</h3>";
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title></title>

		<meta name="description" content="">
		<link href="css/styles.css" rel="stylesheet">

	</head>
	<body>
		<button><a href="index.php">Search</a></button>
		<button><a href="fees.php">Fees</a></button>
		<button><a href="add_player.php">Add Player</a></button>
		<button><a href="add_team.php">Add Team</a></button>
		<button><a href="edit_player.php">Edit Players</a></button>

		<!--<script src="js/rename-me.js"></script>-->
	</body>
</html>