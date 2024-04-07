<?php
	
	$servername = "localhost";
	$username = "root";
	$password_server = "";
	$dbname = "elearningplatform";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password_server, $dbname);
	
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	} else{
		mysqli_select_db($conn, $dbname);
		//echo "Connection successful";
	} 

?>