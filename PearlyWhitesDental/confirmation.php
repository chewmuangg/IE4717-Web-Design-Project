<?php
	// confirmation.php
	// conncect to db
	include "dbconnect.php";
	session_start();

	// create short variable names
	$dentistId = $_POST['dentist'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$service = $_POST['serviceType'];
	$is_booked = false;

	// check if reschedule or new appt
	if (isset($_POST['reschedule'])) {
		// appointment ID variable
		$apptId = $_POST['reschedule'];
		
		// query formulation
		$query = "UPDATE appointments SET date='".$date."', time='".$time."' WHERE apptId=".$apptId;
	} else {
		// query formulation
		$query = "INSERT INTO appointments (userId, dentistId, date, time, serviceType)
				VALUES (".$_SESSION['user_id'].", ".$dentistId.", '".$date."', '".$time."', '".$service."')";
	}

	// query submission
	$result = $dbcnx->query($query);

	if (!$result) {
		echo "Your query failed.";
	} else {
		$is_booked = true;
	}

	// close data base connection
	$dbcnx->close();
?>
<html lang="en">

<head>
	<title>Pearly Whites Dental</title>
	<meta charset="utf-8">

	<!-- stylesheet -->
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<!-- start of nav bar -->
	<header>
		<nav id="header-container">
			<a href="index.html"><img src="images/logo.png" id="header-logo" alt="Pearly Whites Dental Logo"></a>
			<div id="header-links">
				<a href="index.html">Home</a>
				<a href="our-dentists.html">Our Dentists</a>
				<a href="contact-us.html">Contact Us</a>
				<a href="dashboard.php"><img src="images/icon_account.png" width="32" height="32"></a>
			</div>
		</nav>
	</header>
	<!-- end of nav bar -->

	<!-- page content -->
	<div class="container booked">
		<h1>Your appointment has been confirmed!</h1>
		<p>An email confirmation has been sent to your email.</p>
		<!-- appointment card to display appointment details -->
		<div class="appt-card" <?php if(!$is_booked) echo 'style="display: none;"'; ?>>
			<div style="width: 160px;" align="center">image here</div>
			<div>
				<p><?php echo $date; ?></p>
				<p><?php echo $time; ?></p>
				<p><?php echo $dentistId; ?></p>
				<p><?php echo $service; ?></p>
			</div>
		</div>
		<br>
		<br>
		<!-- buttons -->
		<div>
			<a href="dashboard.php" class="btn-outline">Back to my dashboard</a>
			<a href="logout.php" class="btn-pri">Log out</a>
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