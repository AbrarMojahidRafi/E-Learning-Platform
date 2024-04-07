<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Signin</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		<link href="0_style.css" rel = "stylesheet">
	</head>
	
	<body>
		<div class="container">
		<?php
			if (isset($_POST["login"])) {
				$email = $_POST["email"];
				$password = $_POST["password"];
				require_once "0_databaseConnection.php";
				$sql_email = "SELECT Email FROM users WHERE Email='$email'"; 
				$sql_password = "SELECT Password FROM users WHERE Password='$password'";
				$row_email = mysqli_query($conn, $sql_email); 
				$row_password = mysqli_query($conn, $sql_password); 
				if ((mysqli_num_rows($row_email) > 0) && (mysqli_num_rows($row_password) > 0)){
					// echo "Email and Password Match";
					session_start(); 
					$_SESSION['e'] = $email; 
					header('Location: 3_studentProfile.php');
				} else{ // Email or Password is not in the database. 
					echo "<div class='alert alert-danger' role='alert'> Invalid Email or Password </div>";
				}
			}
		?>
			<form action="2_signin.php" method="post">
				<div class="form-group">
					<h1>Signin Form</h1>
				</div>
				<div class="form-group">
					<input type="email" placeholder="Enter Email:" name="email" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Enter Password:" name="password" class="form-control">
				</div>
				<div class="form-btn">
					<input type="submit" class="btn btn-primary" value="login" name="login">
				</div>
			</form>
			<div>
				<p>Don't have an account yet <a href="1_signup.php">Sign Up</a></p>
			</div>
		</div>
	</body>
</html>