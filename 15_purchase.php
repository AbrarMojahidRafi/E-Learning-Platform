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
		
		
		<div class="container">
		
			<?php
				session_start(); 
				$em = $_SESSION['e'];
				// echo $em;
				require_once "0_databaseConnection.php"; 
				$id_query = "SELECT * FROM users WHERE Email='$em'"; 
				$id_row = mysqli_query($conn, $id_query); 
				while ($r = mysqli_fetch_array($id_row)){
					$id = $r["ID"];  // id stored. 
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
				
				if (isset($_POST['purchase'])){
					// echo "Purchase Clicked"; 
					// print_r($_POST);     // Array ( [name] => ABRAR MOJAHID RAFI [user_id] => 40 [email] => rafi.cse.bracu@gmail.com [selected_course] => CSE111-42 [payment_option] => mobile_banking [payment_option_number] => [purchase] => Purchase )
					
					$purchaser_name = $_POST['name'];
					$purchaser_id = $_POST['user_id']; 
					$purchaser_email = $_POST['email']; 
					$purchaser_course = $_POST['selected_course']; 
					$purchaser_payment_option = $_POST['payment_option']; 
					$purchaser_payment_option_number = $_POST['payment_option_number']; 
					if ($purchaser_payment_option == 'cash'){
						$sql = "INSERT INTO purchasers (PurchasersID, PurchasersName, PurchasersEmail, PurchasersCourseCode, Cash) VALUES ('$purchaser_id', '$purchaser_name', '$purchaser_email', '$purchaser_course', true)";
					} else if ($purchaser_payment_option == 'mobile_banking'){
						$sql = "INSERT INTO purchasers (PurchasersID, PurchasersName, PurchasersEmail, PurchasersCourseCode, MobileBanking) VALUES ('$purchaser_id', '$purchaser_name', '$purchaser_email', '$purchaser_course', '$purchaser_payment_option_number')";
					} else if ($purchaser_payment_option == 'card') {
						$sql = "INSERT INTO purchasers (PurchasersID, PurchasersName, PurchasersEmail, PurchasersCourseCode, Card) VALUES ('$purchaser_id', '$purchaser_name', '$purchaser_email', '$purchaser_course', '$purchaser_payment_option_number')";
					} 
					
					if (mysqli_query($conn, $sql)) {   // not working, fix it............
						echo "<div class='alert alert-success' role='alert'> SUCCESSFULLY Purchased!</div>";
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
				} 
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
				
				<div class="form-group">
					<div class="input-group mb-3">
					  <label class="input-group-text" for="inputGroupSelect01">Course Code</label>
					  <select class="form-select" id="inputGroupSelect01" name="selected_course">
						<option selected>Choose...</option>
						<?php
							$query = "SELECT CourseCode, CourseTitle, ID_CourseProvider FROM courses"; 
							$row = mysqli_query($conn, $query); 
							while ($r = mysqli_fetch_array($row)){
								$cc = $r['CourseCode']; 
								$ct = $r['CourseTitle']; 
								$course_provider_id = $r['ID_CourseProvider'];
								echo "<option value=\"$cc-$course_provider_id\">$cc - $ct</option>";
							}
						?>
					  </select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group mb-3">
					  <label class="input-group-text" for="inputGroupSelect02">Payment Option</label>
					  <select class="form-select" id="inputGroupSelect02" name="payment_option">
						<option selected>Choose...</option>
						<option value="cash">Cash</option>
						<option value="mobile_banking">Mobile Banking</option>
						<option value="card">Card </option>
					  </select>
					  <input type="text" placeholder="Bkash/Card:" name="payment_option_number" class="form-control">
					</div>
				</div>
				
				<div class="form-group">
					<div class="form-btn">
						<input type="submit" class="btn btn-primary" value="Purchase" name="purchase">
					</div>
				</div>
				
				<div class="form-group">
					<div class="form-btn">
						<input type="submit" class="btn btn-primary" value="Cancel" name="cancel">
					</div>
				</div>
			</form>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
	</body>
</html>