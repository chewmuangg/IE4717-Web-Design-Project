<?php
	// reschedule.php
	// conncect to db
	include "dbconnect.php";
	session_start();

	// create short variable names
	$apptId = $_GET['apptId'];

	// query formulation
	$query = "SELECT * FROM appointments WHERE apptId=".$apptId;

	// query submission
	$result = $dbcnx->query($query);

	$oldAppt = array();
	
	// Fetch data and store it in the $appointment array
	while ($row = $result->fetch_assoc()) {
		$oldAppt[] = $row;
	}

	// create short variables names for $oldAppt array
	$dentistId = $oldAppt[0]['dentistId'];
	$date = $oldAppt[0]['date'];
	$time = $oldAppt[0]['time'];
	$service = $oldAppt[0]['serviceType'];

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
		<h2>Current appointment</h2>
		<?php echo var_dump($oldAppt); ?>
		<!-- appointment card to display appointment details -->
		<div class="appt-card">
			<div style="width: 160px;" align="center">image here</div>
			<div>
				<p><?php echo $date; ?></p>
				<p><?php echo $time; ?></p>
				<p><?php echo $dentistId; ?></p>
				<p><?php echo $service; ?></p>
			</div>
		</div>
		
		<!-- reschedule appt form -->
		<form method="post" action="confirmation.php">
			<div>
				<p>Choose a new date & time</p>
				<div class="row justify-content-center">
					<div>
						<input type="date" name="date" required>
					</div>
					<div class="col">
						<div>
							<input type="radio" name="time" value="0900">9.00 am
							<input type="radio" name="time" value="1000">10.00 am
							<input type="radio" name="time" value="1100">11.00 am
						</div>
						<div>
							<input type="radio" name="time" value="1330">1.30 pm
							<input type="radio" name="time" value="1430">2.30 pm
							<input type="radio" name="time" value="1530">3.30 pm
						</div>
						<div>
							<input type="radio" name="time" value="1630">4.30 pm
							<input type="radio" name="time" value="1730">5.30 pm
							<input type="radio" name="time" value="1830">6.30 pm
						</div>
					</div>
					<!-- hidden input -->
					<input type="text" name="reschedule" style="display: none;" value="<?php echo $apptId; ?>">
					<input type="text" name="dentist" style="display: none;" value="<?php echo $dentistId; ?>">
					<input type="text" name="serviceType" style="display: none;" value="<?php echo $service; ?>">
				</div>
			</div>
			<input type="submit" class="btn-pri" value="Confirm booking">
		</form>

		<h2>New appointment</h2>
		<!-- appointment card to display appointment details -->
		<div class="appt-card">
			<div style="width: 160px;" align="center">image here</div>
			<div>
				<p><?php echo 'new date'; ?></p>
				<p><?php echo 'new time'; ?></p>
				<p><?php echo $dentistId; ?></p>
				<p><?php echo $service; ?></p>
			</div>
		</div>

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