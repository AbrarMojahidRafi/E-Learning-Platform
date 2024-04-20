<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enrolled Courses</title>
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
			<a class="navbar-brand" href="3_studentProfile.php">E Learning Platform</a>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
				  <ul class="navbar-nav">
					<li class="nav-item">
					  <a class="nav-link active" aria-current="page" href="3_studentProfile.php">Student Profile</a>
					</li>
				  </ul>
				</div>
			<button type="button" class="btn btn-outline-dark" name='logout_button'> <a href='6_logout.php' id="logoutButtonID">Logout</a> </button>
		  </div>
		</nav>
		
		
		<h1 class="text-center">My Enrolled Course.</h1>
	
		<?php 
			require_once('0_databaseConnection.php'); 
			session_start(); 
			$em = $_SESSION['e'];
			$id_query = "SELECT * FROM users WHERE Email='$em'"; 
			$id_row = mysqli_query($conn, $id_query); 
			while ($r = mysqli_fetch_array($id_row)){
				$id = $r["ID"];  // id stored. 
			}  
			
			// working onnnnnn........................
			$query = "SELECT * FROM purchasers where PurchasersID ='$id'"; 
			$row = mysqli_query($conn, $query); 
			// Fetching the data from database. 
			while ($r = mysqli_fetch_array($row)){
				echo '<div class="card" style="width: 18rem;">
							<div class="card-body">
								<h5 class="card-title">'.$r["CourseCode"].'</h5>
								<h3 class="card-title">'.$r["CourseTitle"].'</h3>
								<p class="card-text">'.$r["CourseDescription"].'</p>'.
								'<a href="'.$r["CourseVideo"].'" class="btn btn-primary">Video Link</a>
								<a href="15_purchase.php" class="btn btn-primary">Purchase</a>
							</div>
						</div>
						<br>';
			}
		?>
		
		
		<div class="card" style="width: 18rem;">
		  <img src="..." class="card-img-top" alt="Course Image">
		  <div class="card-body">
			<h5 class="card-title">Card title</h5>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			<a href="#" class="btn btn-primary">Purchase</a>
		  </div>
		</div>
		
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>