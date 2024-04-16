<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Provided Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<style>
		.container{
			max-width: 600px;
			margin:0 auto;
			padding:50px;
			box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
		}
		.form-group{
			margin-bottom:30px;
		}
		#logoutButtonID{
			color: #000000;
			text-decoration: none;
		}

		#logoutButtonID:hover {
			color:#FFFFFF; 
			text-decoration:none; 
			cursor:pointer;  
		}
	</style>
  </head>
  <body>
		
		
	<!--Navigation Bar-->
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
		  <div class="container-fluid">
			<a class="navbar-brand" href="9_teacherProfile.php">E Learning Platform</a>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
				  <ul class="navbar-nav">
					<li class="nav-item">
					  <a class="nav-link active" aria-current="page" href="9_teacherProfile.php">Teacher Profile</a>
					</li>
				  </ul>
				</div>
			<button type="button" class="btn btn-outline-dark" name='logout_button'> <a href='6_logout.php' id="logoutButtonID">Logout</a> </button>
		  </div>
		</nav>
		
		<br>
		
		<div class="container">
		<?php 
			// echo "<pre>";
			// print_r($_POST);
			/*
			Array
			(
				[course_code_name] => 
				[course_title_name] => 
				[course_description_name] => 
				[course_video_name] => 
				[add_course_button] => Add Course
			) */
			// echo "</pre>";
			
			if (isset($_POST["add_course_button"])){
				$courseCode = $_POST["course_code_name"];
				$courseTitle = $_POST["course_title_name"];
				$courseDescription = $_POST["course_description_name"];
				$courseVideoLink = $_POST["course_video_name"];
				
				$errors_addCourse = Array();
				// Checking that the user fillup all the fields or not. 
				if (empty($courseCode) OR empty($courseTitle) OR empty($courseDescription) OR empty($courseVideoLink)){
					array_push($errors_addCourse,"All fields are required");
				}
				
				
				session_start(); 
				$em = $_SESSION['e'];
				// echo $em;
				require_once('0_databaseConnection.php'); 
				// Getting the provider id 
				$queryForID = "SELECT ID FROM users WHERE Email='$em'"; 
				$row = mysqli_query($conn, $queryForID); 
				// Fetching the data from database. 
				while ($r = mysqli_fetch_array($row)){
					$provider_id = $r['ID']; 
				}
				
				
				if (count($errors_addCourse) > 0){ // If error occurs, then showing that. 
					foreach ($errors_addCourse as  $error) {
						echo "<div class='alert alert-danger' role='alert'> $error </div>";
					}
				} else { // Means NO ERRORS occurs.. 
					$query = "INSERT INTO courses (CourseCode, CourseTitle, CourseDescription, CourseVideo, ID_CourseProvider) VALUES ('$courseCode', '$courseTitle', '$courseDescription', '$courseVideoLink', $provider_id)";
					if (mysqli_query($conn, $query)) {
					  // Showing that the registration/insertion SUCCESSFULLY completed... 
						echo "<div class='alert alert-success' role='alert'> Course Added SUCCESSFULLY! </div>";
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				}
				
			}
			
		?>
			<form action="14_addCourse.php" method="post">
				<div class="form-group">
					<h1>Course Add Form!</h1>
				</div>
				<div class="form-group">
					<input type="text" placeholder="Enter Course Code:" name="course_code_name" class="form-control">
				</div>
				<div class="form-group">
					<input type="text" placeholder="Enter Course Title:" name="course_title_name" class="form-control">
				</div>
				<div class="form-group">
					<input type="text" placeholder="Enter Course Description:" name="course_description_name" class="form-control">
				</div>
				<div class="form-group">
					<input type="text" placeholder="Enter Course Video Link:" name="course_video_name" class="form-control">
				</div>
				<div class="form-btn">
					<input type="submit" class="btn btn-primary" value="Add Course" name="add_course_button">
				</div>
			</form>
		</div>
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>