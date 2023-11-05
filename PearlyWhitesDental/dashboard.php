<?php
	// dashboard.php
	// conncect to db
	include "dbconnect.php";
	session_start();

	// login verification
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

			// set $is_dentist boolean to false
			//$is_dentist = false;
			
		} elseif ($accountType == 9) {
			// dentist or admin account
			// set $is_dentist boolean to true
			//$is_dentist = true;

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
			$_SESSION['user_type'] = $row['userType'];
			$_SESSION['user_id'] = $row['userId'];
		}
	}
?>
<html lang="en">

<head>
	<title>My Account | Pearly Whites Dental</title>
	<meta charset="utf-8">

	<!-- stylesheet -->
	<link rel="stylesheet" href="css/styles.css">
</head>

<body>
	<?php 
		// check if user login is valid	
		if (!isset($_SESSION['valid_user'])) {
			// unsucessful user login
			echo "<script>";
			echo "alert('User not found! Please try again.');";
			echo "window.location.href = 'login.html';"; // Redirect to login.html
			echo "</script>";

			exit;
		} else {
			// successful user login
			
			if ($_SESSION['user_type'] == 9) {
				// retrieve dentist's appointment schedule
				switch ($_SESSION['user_id']) {
					case 1000:
						// admin function
						// query formulation
						$apptQuery = "SELECT * FROM appointments ORDER BY date ASC";
						break;
						
					default:
						// dentist
						// query formulation
						$apptQuery = "SELECT * FROM appointments WHERE dentistId=".$_SESSION['user_id']." ORDER BY date ASC";
				}

			} else {
				// retrieve patient's appointment details
				// query formulation
				$apptQuery = "SELECT * FROM appointments WHERE userId=".$_SESSION['user_id']." ORDER BY date ASC";
				
			}

			// query submission
			$apptResult = $dbcnx->query($apptQuery);

			// initialise an appointments array to store results retrieved from db
			$appointments = array();

			// Fetch data and store it in the $appointment array
			while ($row = $apptResult->fetch_assoc()) {
				$appointments[] = $row;
			}
			
			// Store the $appointment array in a session variable
			$_SESSION['appointments'] = $appointments;
		}
	?>

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
						<!-- My Account button --> 
						<a href="dashboard.php">My Account</a>
						
						<!-- logout button -->
						<a href="logout.php">Logout</a>
					</div>
				</div> 
			</div>
		</nav>
	</header>
	<!-- end of nav bar -->

	<!-- page content -->
	<div class="container acct-container" style="color:white">
		<h1>Hello, <?php echo $_SESSION['valid_user'];?>!</h1>
		
		<!-- show text for patients accs, hide for dentists accs -->
		<p <?php if($_SESSION['user_type'] == 9) echo 'style="display: none;"'; ?>>What would you like to do today?</p>
		
		<!-- show text for dentists accs, hide for patients accs -->
		<p <?php if($_SESSION['user_type'] == 1) echo 'style="display: none;"'; ?>>It's a beautiful day to save smiles :&rpar;</p>

		<!-- appointment schedule -->
		<div class="dashboard" style="color:black">
            <div class="col">
                <div class="row justify-content-space-between align-items-center">

					<!-- show text for patients accs, hide for dentists accs -->
                    <h2 <?php if($_SESSION['user_type'] == 9) echo 'style="display: none;"'; ?>>My Appointments</h2>
                    
					<!-- show text for dentists accs, hide for patients accs -->
					<h2 <?php if($_SESSION['user_type'] == 1) echo 'style="display: none;"'; ?>>Scheduled Appointments</h2>

					<!-- show button for patients accs, hide for dentists accs -->
                    <!-- <a class="btn-pri" href="appointment.html" <?php if($_SESSION['user_type'] == 9) echo 'style="display: none;"'; ?>>Book an Appointment</a> -->
                    <a class="btn-pri btn-book" href="appointment.html" >Book an Appointment</a>
                </div>

				<!-- start of an appointment card --> 
				<?php 
					foreach ($_SESSION['appointments'] as $appointment) {
						if (count($_SESSION['appointments']) == 0) {
							echo "<div class='schdl-card' style='display: none;'>";
						} else {
							echo "<div class='schdl-card'>";
						}
						
						$apptId = $appointment['apptId'];
						$userId = $appointment['userId'];
						$dentistId = $appointment['dentistId'];
						$date = $appointment['date'];
						$time = $appointment['time'];
						$service = $appointment['serviceType'];

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
						
						echo "<div class='schdl-card-content'>";
						echo "<div class='col-date-time'>";
						echo "<p style='font-size: 20px;'>".$date."</p>";
						echo "<p>".$time."</p>";
						echo "</div>";
						
						echo "<div class='vertical-line'></div>";
						
						echo "<div class='col'>";
						echo "<p style='font-size: 20px; font-weight: 600;'>".$name."</p>";
						echo "<p>".$service."</p>";
						echo "</div>";
						echo "</div>";

						echo "<a class='btn-outline' href='reschedule.php?apptId=".$apptId."'>Reschedule</a>";

                		echo "</div>";
					}
				?>
				<!-- <div class="schdl-card">
					<div class='row align-items-center'>
						<div class='col'>
							<p>30 Oct 2023</p>
							<p>10:00 AM</p>
						</div>
						<div class='vertical-line'></div>
                        <div class="col">
                            <p>Dr. David Tan</p>
                            <p>Scaling & Polishing</p>
                        </div>
                    </div>
                    
                    <a class="btn-outline" href="#">Reschedule</a>

                </div> -->
				<!-- end of an appointment card --> 

				<!-- Start of no appointments card -->
                <div class="no-schdl-card" <?php if(count($_SESSION['appointments']) > 0) echo 'style="display: none;"'; ?>>
                    <p>You have no upcoming appointments.</p>
                </div>
				<!-- End of no appointments card --> 
            </div>
            
		</div>
	</div>

	<?php 
		// close data base connection
		$dbcnx->close();
	?>

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