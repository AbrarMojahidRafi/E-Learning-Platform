<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Changing Password</title>
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
		
		
		<div class="container"> 
			<?php 
				// print_r($_POST);   // Array ( [password_old] => [password_new] => [retype_new_password] => [ok] => OK )
				session_start(); 
				$signinMail = $_SESSION['e'];   // $_SESSION['em'] = LOGIN EMAIL
				if (isset($_POST["ok"])){
					$oldPassword = $_POST['password_old'];
					$newPassword = $_POST['password_new']; 
					$retypePassword = $_POST['retype_new_password']; 
					require_once "databaseConnection.php";
					
					// Is database's password Matches with the user's typed password. 
					$errors = Array();
					// Checking that the user fillup all the fields or not. 
					if (empty($oldPassword) OR empty($newPassword) OR empty($retypePassword)){
						array_push($errors,"All fields are required");
					}
					// Checking that the users provided password length is grather than 8 characters or not. 
					if (strlen($newPassword)<8) {
						array_push($errors,"Password must be at least 8 characters long");
					}
					// Checking that the users typed the equal password or not, in the password and repeatPassword section. 
					if ($newPassword!==$retypePassword) {
						array_push($errors,"Password does not match");
					}
					
					if (count($errors) > 0){ // If error occurs, then showing that. 
						foreach ($errors as  $error) {
							echo "<div class='alert alert-danger' role='alert'> $error </div>";
						}
					} else { // Means NO ERRORS occurs.. 
						// finding the id of the signin email. 
						$id_query = "SELECT * FROM users WHERE Email='$signinMail'"; 
						$id_row = mysqli_query($conn, $id_query); 
						while ($r = mysqli_fetch_array($id_row)){
							$id = $r["ID"]; // id stored. 
							$passwordUpdateQuery = "UPDATE users SET Password='$newPassword' WHERE ID=$id";  // SWAPPING the old password with respect to new password, of id. 
							if (mysqli_query($conn, $passwordUpdateQuery)){   // success message. 
								echo "<div class='alert alert-success' role='alert'> SUCCESSFULLY updated your Password! </div>";
							}
						}
					}
				}
			?>
			
			
			<form action="changingPassword.php" method="post">
				<div class="form-group">
					<h1>Password Changing form!</h1>
				</div>
				<div class="form-group">
					<input type="password" placeholder="Enter Previous Password:" name="password_old" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Enter New Password:" name="password_new" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Retype New Password:" name="retype_new_password" class="form-control">
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