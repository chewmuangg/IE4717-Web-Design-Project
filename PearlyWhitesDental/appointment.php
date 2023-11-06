<?php
	session_start();
?>

<html lang="en">

<head>
	<title>Book an Appointment | Pearly Whites Dental</title>
	<meta charset="utf-8">

	<!-- javascript-->
	<script type="text/javascript" src="appt_form.js"></script>
	<script type="text/javascript" src="btn-func.js"></script>

	<!-- stylesheet -->
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<!-- start of nav bar -->
	<header>
		<nav id="header-container">
			<a href="index.php"><img src="images/logo.png" id="header-logo" alt="Pearly Whites Dental Logo"></a>
			<div id="header-links">
				<a href="index.php">Home</a>
				<a href="our-dentists.php">Our Dentists</a>
				<a href="contact-us.php">Contact Us</a>

				<!-- dropdown for account page & logout -->
				<div class="dropdown">
					<button class="dropbtn">
						<img src="images/icon_account.png" width="32" height="32"> 
					</button>

					<div class="dropdown-content">
						<!-- My Account Page-->
						<a href="dashboard.php">My Account</a>
						
						<!-- Logout Button -->
						<a href="logout.php" onclick="return confirmLogout();">Log Out</a>
					</div>
				</div> 
			</div>
		</nav>
	</header>
	<!-- end of nav bar -->

	<div class="container appt">
		<!-- page content -->
		<div class="appt-form-container">
			<h1>Book an Appointment</h1>
			<form method="post" action="confirmation.php" id="appt-form">
				<?php 
					// show this div when dentist or admin is logged in 
					if ($_SESSION['user_type'] == 9) {
						echo "<div class='appt-form-patientId'>";
						echo "<label for='patientId'>Patient's ID: </label>";
						echo "<input type='text' name='patientId' id='patientId' placeholder='1xxx' required onkeyup='patientIdChecker()'>";
						echo "<small id='patientId-error'></small>";
						echo "</div>";
					}
				?>

				<div class="appt-form-step">
					<p>Step 1 of 3: Choose your dentist</p>
					<div class="toggle-radio-grp">
						<input type="radio" name="dentist" class="radio" id="dr1" value="2001">
						<label class="radio-label-dentist" for="dr1">Dr. Emily Pearson</label>
						
						<input type="radio" name="dentist" class="radio" id="dr2" value="2002">
						<label class="radio-label-dentist" for="dr2">Dr. Carlos Novakowski</label>
						
						<input type="radio" name="dentist" class="radio" id="dr3" value="2003">
						<label class="radio-label-dentist" for="dr3">Dr. Sarah Rodriguez</label>
					</div>
				</div>

				<div class="appt-form-step">
					<p>Step 2 of 3: Choose a service</p>
					<select name="serviceType">
						<option value="0">--- Select one ---</option>
						<option value="Consultation">Consultation</option>
						<option value="Scaling & Polishing">Scaling & Polishing</option>
						<option value="Emergency Dental Care">Emergency Dental Care</option>
						<option value="Crowns & Bridges">Crowns & Bridges</option>
						<option value="Dentures">Dentures</option>
						<option value="Orthodontics">Orthodontics</option>
						<option value="Endodontics">Endodontics</option>
						<option value="Periodontal Care">Periodontal Care</option>
						<option value="Pediatric Dentistry">Pediatric Dentistry</option>
						<option value="Oral Surgery">Surgery</option>
						<option value="X-ray and Diagnostic Imaging">Scaling & Polishing</option>
						<option value="Cosmetic Dentistry">Cosmetic Dentistry</option>
					</select>
				</div>

				<div class="appt-form-step">
					<p>Step 3 of 3: Choose a date & time</p>
					<div class="row justify-content-space-between">
						<div>
							<input type="date" name="date" id="date" required oninput="showTimeslots()">
							<!-- include js for min date selection -->
						</div>
						
						<div class="col" id="timeslot-col">
							<div class="time-row">
								<input type="radio" name="time" class="radio" id="timeslot1" value="09:00">
								<label class="radio-label label-1 timeslot" for="timeslot1">9.00 AM</label>
								
								<input type="radio" name="time" class="radio" id="timeslot2" value="10:00">
								<label class="radio-label label-2 timeslot" for="timeslot2">10.00 AM</label>
								
								<input type="radio" name="time" class="radio" id="timeslot3" value="11:00">
								<label class="radio-label label-3 timeslot" for="timeslot3">11.00 AM</label>
							</div>
							<div class="time-row">
								<input type="radio" name="time" class="radio" id="timeslot4" value="13:30">
								<label class="radio-label label-4 timeslot" for="timeslot4">1.30 PM</label>
								
								<input type="radio" name="time" class="radio" id="timeslot5" value="14:30">
								<label class="radio-label label-5 timeslot" for="timeslot5">2.30 PM</label>
								
								<input type="radio" name="time" class="radio" id="timeslot6" value="15:30">
								<label class="radio-label label-6 timeslot" for="timeslot6">3.30 PM</label>
							</div>
							<div class="time-row">
								<input type="radio" name="time" class="radio" id="timeslot7" value="16:30">
								<label class="radio-label label-7 timeslot" for="timeslot7">4.30 PM</label>
								
								<input type="radio" name="time" class="radio" id="timeslot8" value="17:30">
								<label class="radio-label label-8 timeslot" for="timeslot8">5.30 PM</label>
								
								<input type="radio" name="time" class="radio" id="timeslot9" value="18:30">
								<label class="radio-label label-9 timeslot" for="timeslot9">6.30 PM</label>
							</div>
						</div>
					</div>
				</div>
				
				<div class="appt-form-submit">
					<input type="submit" class="btn-outline btn-submit" value="Confirm booking">
				</div>
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