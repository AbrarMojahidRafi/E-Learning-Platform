<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Account</title>
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
  
	<?php 
		session_start(); 
		$em = $_SESSION['e'];
		// echo $em;
		require_once "0_databaseConnection.php"; 
		$query = "SELECT * FROM users WHERE Email='$em'"; 
		$row = mysqli_query($conn, $query); 
		while ($r = mysqli_fetch_array($row)){
			$teacher_type = $r["TeacherType"];  // TeacherType stored. 
			$student_type = $r["StudentType"];  // StudentType stored. 
		}  
		if (isset($_POST['cancel'])){
			// echo "Cancel Clicked"; 
			if ($teacher_type){
				// echo "go teacher file"; 
				header('Location: 9_teacherProfile.php');
			} else{
				// echo "go student file";
				header('Location: 3_studentProfile.php');
			}
		} 
	?>
	<form action="19_accountDeleteOption.php" method="post">
		<div class="form-group">
			<div class="form-btn">
				<input type="submit" class="btn btn-primary" value="Cancel" name="cancel">
			</div>
		</div>
	</form>
	
	
	<div class="container">
	<?php
		if (isset($_POST["ok"])) {
			$email = $_POST["email"];
			$password = $_POST["password"];
			require_once "0_databaseConnection.php";
			$sql_email = "SELECT Email FROM users WHERE Email='$email'"; 
			$sql_password = "SELECT Password FROM users WHERE Password='$password'";
			$row_email = mysqli_query($conn, $sql_email); 
			$row_password = mysqli_query($conn, $sql_password); 
			// session_start(); 
			$em = $_SESSION['e'];
			// echo $em;
			if ((mysqli_num_rows($row_email) > 0) && (mysqli_num_rows($row_password) > 0) && ($email==$em)){    
				// echo "Email and Password Match";
				// echo 'Delete the account'; 
				$query = "DELETE FROM users WHERE Email='$email'";
				if (mysqli_query($conn, $query)){
					header('Location: 2_signin.php');
				} 
			} else{ // Email or Password is not in the database. 
				echo "<div class='alert alert-danger' role='alert'> Invalid Email or Password </div>";
			}
		}
	?>
		<form action="19_accountDeleteOption.php" method="post">
			<div class="form-group">
				<h1>Deleting Account Form</h1>
			</div>
			<div class="form-group">
				<input type="email" placeholder="Enter Email:" name="email" class="form-control">
			</div>
			<div class="form-group">
				<input type="password" placeholder="Enter Password:" name="password" class="form-control">
			</div>
			<div class="form-btn">
				<input type="submit" class="btn btn-primary" value="OK" name="ok">
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