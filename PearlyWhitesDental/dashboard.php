<?php
	// login.php
	// conncect to db
	include "dbconnect.php";
	session_start();

	// check if account type, email and password has been entered
	if (isset($_POST['account']) && isset($_POST['email']) && isset($_POST['password'])) {
		// if the user has just tried to log in
		$email = $_POST['email'];
		$password = $_POST['password'];
		$accountType = $_POST['account'];

		if ($accountType == 1) {
			// paitient account
			// encrypt password
			$password = md5($password);
		} elseif ($accountType == 9) {
			// dentist or admin account

		}
		
		// formulate query
		$query = 'select * from users '
    		. "where userType='$accountType' "
    		. "and email='$email' "
    		. "and password='$password'";

		// run query
		$result = $dbcnx->query($query);

		// get the query result
		if ($result->num_rows > 0) {
			// if they are in the database register the user's name
			// and a session ID will be created

			// fetch name from database
			$row = $result->fetch_assoc();
			$username = $row['name'];
			$_SESSION['valid_user'] = $username;
		}
		$dbcnx->close();
	}
?>
<html lang="en">

<head>
	<title>Pearly Whites Dental</title>
	<meta charset="utf-8">

	<!-- stylesheet -->
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<?php 
		// check if user login is valid	
		if (!isset($_SESSION['valid_user'])) {
			echo "<script>";
			echo "alert('User not found! Please try again.');";
			echo "window.location.href = 'login.html';"; // Redirect to login.html
			echo "</script>";

			exit;
		}
	
	?>
	<!-- start of nav bar -->
	<header>
		<nav id="header-container">
			<a href="index.html" id="header-logo">LOGO HERE</a>
			<div id="header-links">
				<a href="index.html">Home</a>
				<a href="our-dentists.html">Our Dentists</a>
				<a href="contact-us.html">Contact Us</a>
				<a href="dashboard.html"><img src="images/icon_account.png" width="32" height="32"></a>
			</div>
		</nav>
	</header>
	<!-- end of nav bar -->

	<!-- page content -->
	<div class="container booked">
		<h1>Hello, <?php echo $_SESSION['valid_user'];?>!</h1>
		<p>What would you like to do today?</p>
		<a href="logout.php">Logout</a>

		<!-- appointment schedule -->

		<div class="appt">
            <div class="col">
                <div class="row justify-content-space-between align-items-center">
                    <h2>My Appointments</h2>
                    <a class="btn-outline" href="appointment.html">Book an Appointment</a>
                </div>
                <div class="schdl-card">
                    <div class="row align-items-center">
                        <div class="col">
                            <p>30 Sep</p>
                            <p>3.00 pm</p>
                        </div>
                        <div class="vertical-line"></div>
                        <div class="col">
                            <p>Dr. David Tan</p>
                            <p>Scaling & Polishing</p>
                        </div>
                    </div>
                    
                    <a class="btn-outline" href="#">Reschedule</a>

                </div>
                <div class="no-schdl-card">
                    <p>You have no upcoming appointments.</p>
                </div>
            </div>
            
		</div>
	</div>

	<!-- start of footer -->
	<footer>
		<div id="footer-content">
			123 Sparkling Street Singapore 987654
			<br>
			6123 4567
			<br>
			<a href="mailto:enquiry@pearlywhites.com">
				enquiry@pearlywhites.com
			</a>
			<br>
		</div>
		<hr width="80%" size="1px">
		<small><i>Copyright &copy; 2023 Pearly Whites Dental</i></small>
	</footer>
	<!-- end of footer -->
</body>

</html>