<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ALL COMMENTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
		if (isset($_POST['back'])){
			// echo "Back Clicked"; 
			if ($teacher_type){
				// echo "go teacher file"; 
				header('Location: 9_teacherProfile.php');
			} else{
				// echo "go student file";
				header('Location: 3_studentProfile.php');
			}
		} 
	?>
	<form action="18_showAllComments.php" method="post">
		<div class="form-group">
			<div class="form-btn">
				<input type="submit" class="btn btn-primary" value="Back" name="back">
			</div>
		</div>
	</form>
	<table class="table caption-top">
	  <caption>All COMMENTS</caption>
	  <thead>
		<tr>
		  <th scope="col">#</th>
		  <th scope="col">Commenter ID</th>
		  <th scope="col">purchaseNumber_courseCode_providerID</th>
		  <th scope="col">Comment</th>
		</tr>
	  </thead>
	  <tbody>
		<?php 
			require_once('0_databaseConnection.php');
			$query = "SELECT * FROM comment_of_students";
			$row = mysqli_query($conn, $query); 
			$count = 0;
			while ($r = mysqli_fetch_array($row)){
				$commenter_id = $r["CommenterID"];  // id stored. 
				$purchaseNumber_courseCode_providerID = $r['purchaseNumber_courseCode_providerID']; 
				$comment = $r['CommenterComment'];
				$count++;
				echo '<tr>
						  <th scope="row">'.$count.'</th>
						  <td>'.$commenter_id.'</td>
						  <td>'.$purchaseNumber_courseCode_providerID.'</td>
						  <td>'.$comment.'</td>
						</tr>';
			}  
		?>
		
	  </tbody>
	</table>
		
		
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>