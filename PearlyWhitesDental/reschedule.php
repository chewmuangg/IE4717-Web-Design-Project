<?php
// reschedule.php
// conncect to db
include "dbconnect.php";
session_start();

// create short variable names
$apptId = $_GET['apptId'];

// query formulation
$query = "SELECT * FROM appointments WHERE apptId=" . $apptId;

// query submission
$result = $dbcnx->query($query);

$oldAppt = array();

// Fetch data and store it in the $appointment array
while ($row = $result->fetch_assoc()) {
	$oldAppt[] = $row;
}

// create short variables names for $oldAppt array
$userId = $oldAppt[0]['userId'];
$dentistId = $oldAppt[0]['dentistId'];
$date = $oldAppt[0]['date'];
$time = $oldAppt[0]['time'];
$service = $oldAppt[0]['serviceType'];

// check if patient or dentist
if ($_SESSION['user_type'] == 1) {
	// display dentist's name in appt card
	// get dentist name
	switch ($dentistId) {
		case 2001: 
			$name = "Dr. Emily Pearson";
			break;
		case 2002: 
			$name = "Dr. Carlos Novakowski";
			break;
		case 2003: 
			$name = "Dr. Sarah Rodriguez";
			break;
		default:
			$name = "Unknown Dentist...";	
	}

} elseif ($_SESSION['user_type'] == 9) {
	// display patient's name in appt card
	// get patient's name

	// query formulation 
	$nameQuery = "SELECT name FROM users WHERE userId=".$userId;

	// run query
	$nameResult = $dbcnx->query($nameQuery);

	// fetch name from database
	$row = $nameResult->fetch_assoc();
	$name = $row['name'];
}

// close data base connection
$dbcnx->close();
?>
<html lang="en">

<head>
	<title>Pearly Whites Dental</title>
	<meta charset="utf-8">
	
	<!-- javascript -->
	<script type="text/javascript" src="input_display.js"></script>

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
	<div class="container acct-container">
		<h1>Reschedule Appointment</h1>
		<div class="row justify-content-center align-items-center">
			<!-- current appointment column -->
			<div class="col">
				<h3>Current appointment</h3>
				<!-- appointment card to display appointment details -->
				<div class="appt-card">
					<div style="width: 160px;" align="center">image here</div>
					<div>
						<p><?php echo $date; ?></p>
						<p><?php echo $time; ?></p>
						<p><?php echo $name; ?></p>
						<p><?php echo $service; ?></p>
					</div>
				</div>
			</div>

			<div class="col">
				image here
			</div>

			<!-- new appt column -->
			<div class="col">
				<h3>New appointment</h3>
				<!-- appointment card to display appointment details -->
				<div class="appt-card">
					<div style="width: 160px;" align="center">image here</div>
					<div>
						<p id="displayDate">new date</p>
						<p id="displayTime">new time</p>
						<p><?php echo $name; ?></p>
						<p><?php echo $service; ?></p>
					</div>
				</div>

			</div>

		</div>
		<div class="row justify-content-center">
			<!-- reschedule appt form -->
			<form id="reschForm" method="post" action="confirmation.php">
				<h2>Choose a new date & time</h2>
				<div class="row justify-content-space-between">
					<div>
						<input type="date" name="date" id="newDate" required>
						<!-- event handler assigned in input_display.js -->
					</div>
					<div class="col">
						<div class="time-row">
							<input type="radio" name="time" class="radio" id="timeslot1" value="0900">
							<label class="radio-label label-1 timeslot" for="timeslot1">9.00 AM</label>

							<input type="radio" name="time" class="radio" id="timeslot2" value="1000">
							<label class="radio-label label-2 timeslot" for="timeslot2">10.00 AM</label>

							<input type="radio" name="time" class="radio" id="timeslot3" value="1100">
							<label class="radio-label label-3 timeslot" for="timeslot3">11.00 AM</label>
						</div>
						<div class="time-row">
							<input type="radio" name="time" class="radio" id="timeslot4" value="1330">
							<label class="radio-label label-4 timeslot" for="timeslot4">1.30 PM</label>

							<input type="radio" name="time" class="radio" id="timeslot5" value="1430">
							<label class="radio-label label-5 timeslot" for="timeslot5">2.30 PM</label>

							<input type="radio" name="time" class="radio" id="timeslot6" value="1530">
							<label class="radio-label label-6 timeslot" for="timeslot6">3.30 PM</label>
						</div>
						<div class="time-row">
							<input type="radio" name="time" class="radio" id="timeslot7" value="1630">
							<label class="radio-label label-7 timeslot" for="timeslot7">4.30 PM</label>

							<input type="radio" name="time" class="radio" id="timeslot8" value="1730">
							<label class="radio-label label-8 timeslot" for="timeslot8">5.30 PM</label>

							<input type="radio" name="time" class="radio" id="timeslot9" value="1830">
							<label class="radio-label label-9 timeslot" for="timeslot9">6.30 PM</label>
						</div>
						<!-- event handler for radio button group "time" assigned in input_display.js -->
					</div>
				</div>
				<!-- hidden input -->
				<input type="text" name="rescheduleID" style="display: none;" value="<?php echo $apptId; ?>">
				<input type="text" name="dentist" style="display: none;" value="<?php echo $dentistId; ?>">
				<input type="text" name="serviceType" style="display: none;" value="<?php echo $service; ?>">
				<input type="text" name="nameDisplayed" style="display: none;" value="<?php echo $name; ?>">
				<input type="submit" class="btn-pri" value="Reschedule">
			</form>
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