<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Teacher Profile</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<style>
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
					  <a class="nav-link active" aria-current="page" href="9_teacherProfile.php">  Teacher Profile</a>
					</li>
				  </ul>
				</div>
			<button type="button" class="btn btn-outline-dark" name='logout_button'> <a href='6_logout.php' id="logoutButtonID">Logout</a> </button>
		  </div>
		</nav>
		
		<?php 
			// collecting the signin's email.
			session_start(); 
			$em = $_SESSION['e'];
			// echo $em;
			//connecting the database. 
			require_once "0_databaseConnection.php"; 
			$sql_email = "SELECT * FROM users WHERE Email='$em'";
			$row = mysqli_query($conn, $sql_email); 
			// Fetching the data from database. 
			while ($r = mysqli_fetch_array($row)){
				// Updating the Name, ID, Email, and so on. 
				echo "<h1> Name: ".$r['Name']."</h1>"; 
				
				echo "<h1> ID: ".$r['ID']."</h1>";  
				
				echo "<h1> Email: ".$r['Email']."</h1>"; 
				echo "<h3> Do you wanna change your email? <a href='10_changingEmailForTeacher.php' class='text-danger'>CLICK HERE</a></h3>";
				
				echo "<h3> Do you wanna change your Password? <a href='11_changingPasswordForTeacher.php' class='text-danger'>CLICK HERE</a></h3>"; 
				
				echo "<hr>";
				
				echo "<h1><a href='13_providedCourses.php'>Provided Course</a></h1>";
				
				echo "<h1><a href='12_showAllCoursesForTeacher.php' class='text-success'>SHOW ALL COURSES</a></h1>";
				
			}
		?>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
	</body>
</html>