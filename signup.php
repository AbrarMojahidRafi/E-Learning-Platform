<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign UP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link href="style.css" rel = "stylesheet">
  </head>
  <body>
		<div class="container"> 
		
		<?php
			// echo "<pre>";
			// print_r($_POST);     // Array ( [firstName] => Abrar [lastName] => Rafi [email] => rafi.cse.bracu@gmail.com [password] => [repeat_password] => [submit] => Register )
			// echo "</pre>";
			if (isset($_POST["submit"])){
				$name = $_POST["firstName"]." ".$_POST["lastName"];
				$email = $_POST["email"];
				$password = $_POST["password"];
				$repeatPassword = $_POST["repeat_password"]; 
				
				$errors = Array();
				if (empty($name) OR empty($email) OR empty($password) OR empty($repeatPassword)){
					array_push($errors,"All fields are required");
				}
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					array_push($errors, "Email is not valid");
				}
			    if (strlen($password)<8) {
					array_push($errors,"Password must be at least 8 charactes long");
			    }
			    if ($password!==$repeatPassword) {
					array_push($errors,"Password does not match");
			    }
				
				if (count($errors) > 0){
					foreach ($errors as  $error) {
						echo "<div class='alert alert-danger' role='alert'> $error </div>";
					}
				} else { // Means NO ERRORS occurs.. 
					
					// Now connect the Database
					
					// Insert the name, email, password into the Database
					
					// Showing that the registration/insertion SUCCESSFULLY completed... 
					echo "<div class='alert alert-success' role='alert'> SUCCESSFULLY Registered! </div>";
				}
			}
		?>
			<form action="signup.php" method="post">
				<div class="form-group"> 
					<input type="text" class="form-control" placeholder="First name" aria-label="First name" name="firstName">
					<input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name="lastName">
				</div>
				<div class="form-group">
					<input type="emamil" class="form-control" name="email" placeholder="Email:">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password:">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
				</div>
				<div class="form-btn">
					<input type="submit" class="btn btn-primary" value="Register" name="submit">
				</div>
			</form>
			
			<div>
				<div><p>Already Registered <a href="signin.php">Sign in Here</a></p></div>
			</div>
			
		</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>




