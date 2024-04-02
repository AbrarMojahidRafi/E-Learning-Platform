<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
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
				
				if (isset($_POST['flexRadioDefault'])){ // Checking that any checkbox is checked or not.
					if ($_POST['flexRadioDefault'] == "Teacher"){ // It means -> Teacher checkbox clicked.
						$type = $_POST["flexRadioDefault"];
					} else{ // It means -> Student checkbox clicked.
						$type = $_POST["flexRadioDefault"];
					}
				}
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
					
					// Now connect the Database.
					
					// Insert the name, email, password into the Database.
					
					// Showing that the registration/insertion SUCCESSFULLY completed... 
					echo "<div class='alert alert-success' role='alert'> SUCCESSFULLY Registered! </div>";
				}
			}
		?>
		
		<!-- Signup form -->
			<form action="signup.php" method="post">
				<!-- First Name section -->
				<div class="form-group"> 
					<input type="text" class="form-control" placeholder="First name" aria-label="First name" name="firstName">
				</div>
				<!-- Second Name section -->
				<div class="form-group"> 
					<input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name="lastName">
				</div>
				<!-- Email Section -->
				<div class="form-group">
					<input type="emamil" class="form-control" name="email" placeholder="Email:">
				</div>
				<!-- Pasword Section -->
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password:">
				</div>
				<!-- Repeat Password Section -->
				<div class="form-group">
					<input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
				</div>
				<!-- Checkbox: Teacher or Student -->
				<div class="form-group"> 
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Teacher">
					  <label class="form-check-label" for="flexRadioDefault1">
						Teacher
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Student" checked>
					  <label class="form-check-label" for="flexRadioDefault2">
						Student
					  </label>
					</div>
				</div>
				<!-- Submit Button -->
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



