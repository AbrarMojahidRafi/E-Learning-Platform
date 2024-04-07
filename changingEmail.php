<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Changing Email</title>
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
				color: #0060B6;
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
			<form action="changingPassword.php">
				<?php 
					
				?>
				<button type="button" class="btn btn-outline-dark" name='logout_button'> <a href='logout.php' id="logoutButtonID">Logout</a> </button>
			</form>
		  </div>
		</nav>
		
		
		<?php 
			// session_start(); 
			// echo $_SESSION['em'];   // $_SESSION['em'] = LOGIN EMAIL
			// print_r($_POST);    // Array ( [email_old] => [email_new] => [typed_password] => [ok] => OK )
			if (isset($_POST["ok"])){
				// Storing forms value. 
				$oldEmail = $_POST["email_old"]; 
				$newEmail = $_POST["email_new"]; 
				$password_typed = $_POST["typed_password"]; 
				// Connecting with the database. 
				require_once "databaseConnection.php"; 
				// IS the oldEmail and password_typed matches with the databse's email and password?
				$sql_email = "SELECT Email FROM users WHERE Email='$oldEmail'"; 
				$row_email = mysqli_query($conn, $sql_email); 
				$sql_password = "SELECT Password FROM users WHERE Password='$password_typed'";
				$row_password = mysqli_query($conn, $sql_password); 
				if ((mysqli_num_rows($row_email) > 0) && (mysqli_num_rows($row_password) > 0)){   // means typed oldEmail and password_typed matches with the database's email and password
					// finding id of the email. 
					$id_query = "SELECT * FROM users WHERE Email='$oldEmail'"; 
					$id_row = mysqli_query($conn, $id_query); 
					while ($r = mysqli_fetch_array($id_row)){
						$id = $r["ID"];  // id stored. 
						$emailUpdateQuery = "UPDATE users SET Email='$newEmail' WHERE ID=$id";  // updating the email of the id.
						if (mysqli_query($conn, $emailUpdateQuery)){
							// echo "Email and Password Match";
							echo "<div class='alert alert-success' role='alert'> SUCCESSFULLY updated your Email! </div>";
						} 
					}
				} else{ // Email or Password is not in the database. 
					echo "<div class='alert alert-danger' role='alert'> Invalid Email or Password </div>";
				}
			}
		?>
		
		
		<div class="container"> 
			<form action="changingEmail.php" method="post">
				<div class="form-group">
					<h1>Email Changing form!</h1>
				</div>
				<div class="form-group">
					<input type="email" placeholder="Enter Previous Email:" name="email_old" class="form-control">
				</div>
				<div class="form-group">
					<input type="email" placeholder="Enter New Email:" name="email_new" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Enter Password:" name="typed_password" class="form-control">
				</div>
				<div class="form-btn">
					<input type="submit" class="btn btn-primary" value="OK" name="ok">
				</div>
			</form>
		</div>
		
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
	</body>
</html>