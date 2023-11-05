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
$is_reschedule = false;

// query formulation
$apptQuery = "SELECT dentistId, date, time FROM appointments ORDER BY date, time";

// query submission
$apptResult = $dbcnx->query($apptQuery);

// initialise an all appts array to store results retrieved from db
$allAppts = array();

// Fetch data and store it in the $appointment array
while ($row = $apptResult->fetch_assoc()) {
	$allAppts[] = $row;
}

$unavailTimeslots = array();

foreach ($allAppts as $appt) {
	if (($appt['dentistId'] == $dentistId) && ($appt['date'] == $date)) {
		$unavailTimeslots[] = $appt['time'];
	}
}

foreach ($unavailTimeslots as $timeslots) {
	if ($timeslots == $time) {
		$apptExists = true; 	// timeslot has already been booked, unavailable
		break;	// exit the loop early since we found a match
	}
}

if ($apptExists) {
	echo "<script>";
	echo "alert('Oh no! It seems like the timeslot is unavailable. Please select another timeslot! Sorry for the inconvenience caused!');";
	echo "window.location.href = 'appointment.html';"; // Redirect to appointment.html
	echo "</script>";

	exit;
}

// check if reschedule or new appt
if (isset($_POST['rescheduleID'])) {
	// appointment ID variable
	$apptId = $_POST['rescheduleID'];
	$name = $_POST['nameDisplayed'];
	$is_reschedule = true;

	// query formulation
	$query = "UPDATE appointments SET date='" . $date . "', time='" . $time . "' WHERE apptId=" . $apptId;
} else {
	// a new appt is booked

	// check if patient or dentist
	if ($_SESSION['user_type'] == 1) {
		// is a patient acc, display dentist's name in appt card
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
		// is a dentist / admin acc, display patient's name in appt card
		// get patient's name

		// query formulation 
		$nameQuery = "SELECT name FROM users WHERE userId=" . $userId;

		// run query
		$nameResult = $dbcnx->query($nameQuery);

		// fetch name from database
		$row = $nameResult->fetch_assoc();
		$name = $row['name'];
	}

	// query formulation
	$query = "INSERT INTO appointments (userId, dentistId, date, time, serviceType)
				VALUES (" . $_SESSION['user_id'] . ", " . $dentistId . ", '" . $date . "', '" . $time . "', '" . $service . "')";
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

				<!-- dropdown for account page & logout -->
				<div class="dropdown">
					<button class="dropbtn">
						<img src="images/icon_account.png" width="32" height="32">
					</button>
					<div class="dropdown-content">
						<!-- My Account Page -->
						<a href="dashboard.php">My Account</a>

						<!-- Logout Button -->
						<a href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<!-- end of nav bar -->

	<!-- page content -->
	<div class="container acct-container">
		<?php
		if ($is_reschedule) {
			// appointment is rescheduled
			echo "<h1>Your appointment has been rescheduled!</h1>";

			// check if patient or dentist made the reschedule
			if ($_SESSION['user_type'] == 1) {
				// patient made the reschedule
				echo "<p>An email confirmation has been sent to your email.<br>We will notify the respective dentist about the changes made.</p>";
			} elseif ($_SESSION['user_type'] == 9) {
				// dentist made the reschedule
				echo "<p>An email has been sent to notify the paitent of the changes.</p>";
			}
		} else {
			// new appointment is  booked
			echo "<h1>Your appointment has been confirmed!</h1>";
			echo "<p>An email confirmation has been sent to your email.</p>";
		}
		?>

		<!-- appointment card to display appointment details -->
		<div class="appt-card" <?php if (!$is_booked) echo 'style="display: none;"'; ?>>
			<div style="width: 160px;" align="center">
				<img src="images/icon_event.png" width="112" height="112">
			</div>
			<div>
				<p>Date: <?php echo $date; ?></p>
				<p>Time: <?php echo $time; ?></p>
				<p>
					<?php 
						if ($_SESSION['user_type'] == 1) {
							// show dentist's name if patient book or reschedule the appt
							echo "Name of Dentist: " . $name; 

						} elseif ($_SESSION['user_type'] == 9) {
							// show patient's name if dentist reschedule the appt 
							echo "Name of Patient: " . $name; 
						}
					?>
				</p>
				<p>Service: <?php echo $service; ?></p>
			</div>
		</div>
		<br>
		<br>
		<!-- buttons -->
		<div id="cfm-page-btns">
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

	<?php
		// Send email to patient 

		// get dentist's name
		switch ($dentistId) {
			case 2001:
				$dentistName = "Dr. Emily Pearson";
				break;
			case 2002:
				$dentistName = "Dr. Carlos Novakowski";
				break;
			case 2003:
				$dentistName = "Dr. Sarah Rodriguez";
				break;
			default:
				$name = "Unknown Dentist...";
		}

		if ($is_reschedule) {
			// Reschedule email notification
			$to = 'f31ee@localhost';
			$from = 'appointments@pearlywhites.com';
			$fromName = 'Pearly Whites Dental';
			$subject = 'Appointment rescheduled - Pearly Whites Dental';
			$dateText = "\n\nDate: " . $date;
			$timeText = "\n\nTime: " . $time;
			$serviceText = "\n\nService: " . $service;
			$dentistText = "\n\nDentist: " . $dentistName;
			$message = 'You have rescheduled your appointment with us. Here are the details of your new appointment: ' . $dentistText . $serviceText . $dateText . $timeText;
			$headers = 'From: ' . $fromName . '<' . $from . '>' . "\r\n" .
				'Reply-To: f31ee@localhost' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
	
			mail($to, $subject, $message, $headers, '-ff32ee@localhost');

		} else {
			// New Appointment email notification
			$to = 'f31ee@localhost';
			$from = 'appointments@pearlywhites.com';
			$fromName = 'Pearly Whites Dental';
			$subject = 'Confirmation of appointment at Pearly Whites Dental';
			$dateText = "\n\nDate: " . $date;
			$timeText = "\n\nTime: " . $time;
			$serviceText = "\n\nService: " . $service;
			$dentistText = "\n\nDentist: " . $dentistName;
			$message = 'Thank you for choosing us. Here are the details of your appointment: ' . $dentistText . $serviceText . $dateText . $timeText;
			$headers = 'From: ' . $fromName . '<' . $from . '>' . "\r\n" .
				'Reply-To: f31ee@localhost' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
	
			mail($to, $subject, $message, $headers, '-ff32ee@localhost');

		}

	?>

</body>

</html>