<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Comments of Students</title>
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
				
				
				if (isset($_POST['submit'])){
					// print_r($_POST);    // Array ( [selected_course] => 1-CSE111-42 [comment] => fgasdfga [submit] => Submit )
					
					$comment = $_POST['comment'];
					$purchaseNumber_courseCode_providerID = $_POST['selected_course'];
					
					$query = "INSERT INTO comment_of_students (CommenterID, purchaseNumber_courseCode_providerID, CommenterComment) VALUES ('$id', '$purchaseNumber_courseCode_providerID', '$comment')";
					if (mysqli_query($conn, $query)) {
					  // Showing that the registration/insertion SUCCESSFULLY completed... 
						echo "<div class='alert alert-success' role='alert'> Comment Added SUCCESSFULLY! </div>";
					} else {
						echo "Error: " . $query . "<br>" . mysqli_error($conn);
					}
				}
			?>
			
			<form action="16_commentsOfStudents.php" method="post">
				<div class="form-group">
					<h1>Comment section</h1>
				</div>
				<?php 
				// echo $id; // I get the user id. 
				
				// show purchaser number, id, Name, email, course code 
				$query = "SELECT * FROM users WHERE ID='$id'"; 
				$row = mysqli_query($conn, $query); 
				while ($r = mysqli_fetch_array($row)){
					$purchaser_name = $r["Name"];  // PurchasersName stored. 
					$purchaser_email = $r["Email"];  // PurchasersEmail stored. 
				}  
				echo '<p class="text-muted">
						  Purchaser ID: '.$id.'
						  <br>
						  Purchaser Name: '.$purchaser_name.'
						  <br>
						  Purchaser Email: '.$purchaser_email.' 
						  <br>
						</p>';
				
				?>
				
				<div class="form-group">
					<div class="input-group mb-3">
					  <label class="input-group-text" for="inputGroupSelect01">PurchaseNumber-CourseCode-ProviderID</label>
					  <select class="form-select" id="inputGroupSelect01" name="selected_course">
						<option selected>Choose...</option>
						<?php
							$query = "SELECT * FROM purchasers WHERE PurchasersID='$id'"; 
							$row = mysqli_query($conn, $query); 
							while ($r = mysqli_fetch_array($row)){
								$purchase_number = $r['PurchaseNumber'];
								$purchaser_course_code = $r['PurchasersCourseCode'];
								
								echo "<option value=\"$purchase_number-$purchaser_course_code\">$purchase_number-$purchaser_course_code</option>";
							}
						?>
					  </select>
					</div>
				</div>
				
				<div class="input-group">
				  <span class="input-group-text">Comment</span>
				  <textarea class="form-control" aria-label="With textarea" name='comment'></textarea>
				</div>
				
				<br>
				
				<div class="form-group">
					<div class="form-btn">
						<input type="submit" class="btn btn-primary" value="Submit" name="submit">
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