<?php include 'header.php'; ?>
<aside>
	<button onclick="show_filters()" id="show_button">Show Filters</button>
</aside>
		<aside id='filer_side'>
			<div id='filter_content'>
			<section id='filter_header'>
			<p id='page_header'>COURSES</p>
			<button onclick="hide_filters()" id='hide_button'>Hide Filters</button>
			</section>
			<form action="index.php" method="GET">
				<!--Search Box, refresh form on when enter press (faster), calls variable to be saved-->
				<?php
				echo "<section class='filter_type'><input type='text' name='course_search' id='course_search' placeholder='Search' onblur='this.form.submit()' value='";
					   if(isset($_GET['course_search'])){
						$search=trim(mysqli_real_escape_string($dbc, $_GET['course_search']));
					echo $search;}else{echo '';} echo "'>";?>
				</section>
				
				<!-- dropdown for year level-->
				<?php $year_array = array('11', '12', '13') ?>
				<section class='filter_type'><select name="year" onchange="this.form.submit()" style="width:200px;">
				<?php 
				#change content of first item depending on what is currently selected
				if(!isset($_GET['year']) or $_GET['year'] == '0'){$year_display = 'Year:';}
				else{$year_display = 'All Levels';}
				echo'<option value= 0 >'.$year_display.'</option>';
				foreach ($year_array as $value){
					echo'<option value = "'.$value.'"';
					#if the value is already set, continue to be set
					if(isset($_GET['year'])){if($_GET['year'] == $value){echo " selected='selected' ";}}
					echo "> Year ".$value."</option>";}
	?>
					
	</select></section>
		<!-- dropdown for learning area - must first be called from DB -->
		<?php $la_query = "SELECT * FROM learning_areas";
		$la_results = mysqli_query($dbc, $la_query); ?>
		<section class='filter_type'><select name="learning_area" onchange="this.form.submit()" style="width:200px;">
		<?php if(!isset($_GET['learning_area']) or $_GET['learning_area'] == 0){$la_display = 'Learning Area:';}
		else{$la_display = 'All Learnign Areas';}	
		echo'<option value= "none" >'.$la_display.'</option>';
		while($la_record = mysqli_fetch_assoc($la_results)){
			echo'<option value = "'.$la_record["la_id"].'"';
			if(isset($_GET['learning_area'])){if($_GET['learning_area'] == $la_record['la_id']){echo " selected='selected' ";}}
			#display option as difficulty title
			echo ">".$la_record['learning_area']."</option>";
		}
		echo"</select>";?></section>
			</form>
		</div></aside>
		<?php
		#generate a query depending on filters selection
		$level_where_addition = ''; $la_where_addition = ''; $search_additon = '';
		$addition_array = array();
		#search results
		if(isset($_GET['course_search'])){if($_GET['course_search'] != ''){$search_addition = 'name like "'.$search.'%"';
																		 array_push($addition_array, $search_addition);}}
												   
		#year level drop down results
		if(isset($_GET['year'])){if($_GET['year'] != 0){$level_where_addition = 'level = '.$_GET["year"];
														array_push($addition_array, $level_where_addition);}}
												   
		#learning area drop dwown results
		if(isset($_GET['learning_area'])){if($_GET['learning_area'] != 'none'){$la_where_addition = 'la_id = '.$_GET["learning_area"];
																			  array_push($addition_array, $la_where_addition);}}
				
		#generate query based on number of where conditions
		$courses_query = "SELECT * FROM courses ORDER BY name ASC";
		if((count($addition_array)) == 1){$courses_query =sprintf("SELECT * FROM courses WHERE %s ORDER BY name ASC", $addition_array[0]);}
		else if((count($addition_array)) == 2){$courses_query =sprintf("SELECT * FROM courses WHERE %s and %s ORDER BY name ASC", $addition_array[0], $addition_array[1]);}
		else if((count($addition_array)) == 3){$courses_query =sprintf("SELECT * FROM courses WHERE %s and %s and %s ORDER BY name ASC", $addition_array[0], $addition_array[1], $addition_array[2]);}
		

		$courses_result = mysqli_query($dbc, $courses_query);
		?>

		<div class='page_content'>
			<?php
			while($course=mysqli_fetch_assoc($courses_result)){
				#get information about each course
				if ($course['course_id'] != 0){
					echo '<a class="course_link" href="indv_course.php?course='.$course['course_id'].'">';
					$prereq_query= "SELECT * FROM prerequisites, courses WHERE courses.course_id = prerequisites.primary_course_id and primary_course_id=".$course['course_id'];
					$prereq_result = mysqli_query($dbc, $prereq_query);
															  
				echo '<article class="subject_box"><p class="content_title">'.$course['level'].$course['code'].'</p><br>'.$course['name'].'<br><p class="prereq_container">';
				echo 'Prerequisites:<br>';
					
					#check if the current course has prereqs, use query to get information about prereqs
					$rowcount=mysqli_num_rows($prereq_result);
					while($prereq=mysqli_fetch_assoc($prereq_result)){
						$select_course_code_query = "SELECT level, code FROM `courses` WHERE course_id =".$prereq['course_id_pre'];
						$code_result = mysqli_query($dbc, $select_course_code_query);
						$rowcount=mysqli_num_rows($code_result);
						
						if($code_row = mysqli_fetch_assoc($code_result)) {	
							echo $code_row['level'].$code_row['code'].'<br>';	
						}}
					if($rowcount == 0){
						echo 'None';
					}
					
			echo '</p></article></a>';}}
			?>
		<!-- Footer -->
		<footer>
			<hr>
			<p class='footer_left'><a href='https://www.onslow.school.nz/'>Onslow College Site</a></p>
			<p class='footer_right'>Onslow College | Madeleine Mills 2018
			<a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons Licence" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />
			</p>
		</footer>	
		</div>
</body>
</html>
				