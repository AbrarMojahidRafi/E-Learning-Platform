<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Course Purchase</title>
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
		<div class="container">
		
			<?php
				session_start(); 
				$em = $_SESSION['e'];
				// echo $em;
				
				
			?>
			
			<form action="15_purchase.php" method="post">
				<div class="form-group">
					<h1>Purchasing Form</h1>
				</div>
				<div class="form-group"> 
					<input type="text" class="form-control" placeholder="Enter Your Name" name="name">
				</div>
				<div class="form-group"> 
					<input type="text" class="form-control" placeholder="Enter Your ID" name="user_id">
				</div>
				<div class="form-group">
					<input type="email" placeholder="Enter Your Email:" name="email" class="form-control">
				</div>
				
				
				<div class="input-group mb-3">
				  <label class="input-group-text" for="inputGroupSelect01">Course Code</label>
				  <select class="form-select" id="inputGroupSelect01">
					<option selected>Choose...</option>
					<?php
						require_once('0_databaseConnection.php');
						$query = "SELECT CourseCode, CourseTitle FROM courses"; 
						$row = mysqli_query($conn, $query); 
						while ($r = mysqli_fetch_array($row)){
							$cc = $r['CourseCode']; 
							$ct = $r['CourseTitle']; 
							echo '<option value="$cc">'.$cc.' - '.$ct.'</option>';
						}
						
					?>
				  </select>
				</div>
				
				
				<div class="form-btn">
					<input type="submit" class="btn btn-primary" value="Purchase" name="purchase">
				</div>
			</form>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
	</body>
</html>