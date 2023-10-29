<?php // register.php
include "dbconnect.php";	// separate php file to connect to database
if (isset($_POST['submit'])) {
	// check that user filled in all inputs
	if (empty($_POST['name']) || empty ($_POST['email'])
		|| empty ($_POST['password']) || empty ($_POST['password2']) ) {
		
		echo "<script>";
		echo "alert('Please fill in all inputs!');";
		echo "window.location.href = 'signup.html';"; // Redirect to signup.html
		echo "</script>";

		exit;
	}
}
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

// echo ("$username" . "<br />". "$password2" . "<br />");

// check if password is entered correctly
if ($password != $password2) {
	echo "Sorry passwords do not match";
	exit;
}

// encrypt password
$password = md5($password);

// echo $password;

// formulate query
$sql = "INSERT INTO users (userType, name, email, password) 
		VALUES (1, '".$name."', '".$email."', '".$password."')";
//	echo "<br>". $sql. "<br>";

// query submission
$result = $dbcnx->query($sql);

if (!$result) {
	echo "Your query failed.";
} else {
	echo "<script>";
	echo "alert('Welcome ".$name."! You are now registered.');";
	echo "window.location.href = 'login.html';"; // Redirect to login.html
	//consider redirecting to dashboard, meaning that upon successful signup, user is logged in
	echo "</script>";
}

// close data base connection
$dbcnx->close();
	
?>