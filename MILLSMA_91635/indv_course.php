<?php include 'header.php'; 

#query to get course information
$course_query = sprintf("SELECT * FROM courses where course_id = %s", $_GET['course']);
$course_results = mysqli_query($dbc, $course_query);

#query  to get prereq information
$prereq_query = sprintf("SELECT * FROM prerequisites, courses WHERE courses.course_id = prerequisites.primary_course_id and primary_course_id=%s
",$_GET['course']);
$prereq_results = mysqli_query($dbc, $prereq_query);
$prereq_rowcount=mysqli_num_rows($prereq_results);



echo '<article class="indv_course">';
if($course_record = mysqli_fetch_assoc($course_results)){
	echo '<button onclick="goBack()">Go Back</button>';
	echo "<h2 class='content_title'>".$course_record['name']."</h2>";
	echo "<p>".$course_record['info']."</p>";
	
#display prereqs if courses has any
if($prereq_rowcount > 0){
	echo '<h3>Prerequisites</h3>';
	while($prereq_record = mysqli_fetch_assoc($prereq_results)){ 
		$select_course_code_query = "SELECT level, code, course_id FROM `courses` WHERE course_id =".$prereq_record['course_id_pre'];
		$code_result = mysqli_query($dbc, $select_course_code_query);
		echo $prereq_record['prereq_info']." ";
			if($code_row = mysqli_fetch_assoc($code_result)){
				echo "<a class='prereq_link' href = 'indv_course.php?course=".$code_row['course_id']."'>";
				echo $code_row['level'].$code_row['code'].'</a><br>';	}
	}
}
	
	
	
	#display standards if course has any
#query to get standard information
$standard_query = sprintf("select * from course_std, standards where course_std.standard_id = standards.standard_id and course_std.course_id =%s ORDER BY type DESC",$_GET['course']);
$standard_result = mysqli_query($dbc, $standard_query);
$standard_rowcount=mysqli_num_rows($standard_result);
		
$internal_count = 0;
$external_count = 0;
if($standard_rowcount > 0){#if there are NZQA standards for this course:
	echo '<h3>Standards</h3>';
	while($standard_record = mysqli_fetch_assoc($standard_result)){#while there are standards
			if($standard_record['type'] == 'i' && $internal_count == 0){echo '<h4>Internally Assessed:</h4>';$internal_count = 1;}
			else if($standard_record['type'] == 'e' && $external_count == 0){echo '<h4>Externally Assessed:</h4>';$external_count = 1;}
			echo "<div class='standard'><p class='std_num'>".$standard_record['std_num']." </p><p>".$standard_record['name']."				</p>";
			echo "<br><p class='std_num'>Credits: </p>".$standard_record['credits']."</div>";
		echo"<br>";
	}
}
}
echo '</article>';
?>
<!-- Footer -->
		<footer>
			<hr>
			<p class='footer_left'><a href='https://www.onslow.school.nz/'>Onslow College Site</a></p>
			<p class='footer_right'>Onslow College | Madeleine Mills 2018
			<a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons Licence" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />
			</p>
		</footer>		
</body>
</html>

