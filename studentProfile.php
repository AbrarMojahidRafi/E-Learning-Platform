<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E Learning Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
	  <div class="container-fluid">
		<a class="navbar-brand" href="studentProfile.php">E Learning Platform</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
		  <ul class="navbar-nav">
			<li class="nav-item">
			  <a class="nav-link active" aria-current="page" href="studentProfile.php">Profile</a>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
	
	<?php 
		session_start(); 
		$em = $_SESSION['e'];
		// echo $em;
		
		require_once "databaseConnection.php"; 
		$sql_email = "SELECT * FROM users WHERE Email='$em'";
		$row = mysqli_query($conn, $sql_email); 
		while ($r = mysqli_fetch_array($row)){
			echo "<h1> Name: ".$r['Name']."</h1>";  
			echo "<h1> ID: ".$r['ID']."</h1>";  
			echo "<h1> Email: ".$r['Email']."</h1>"; 
			echo "<h3> Do you wanna change your email? <a href='changingEmail.php'>CLICK HERE</a></h3>";
			echo "<h3> Do you wanna change your Password? <a href='changinPassword.php'>CLICK HERE</a></h3>"; 
			echo "<hr>";
			echo "<h1><a href='https://www.w3schools.com'>My Course List</a></h1>";
			echo "<h1><a href='https://www.w3schools.com'>ALL COURSES</a></h1>";
			
		}
		// echo $row['Name']; 
	?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>