<?php
	session_start();
?>
<!DOCTYPE html>
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
			<a href="index.php"><img src="images/logo.png" id="header-logo" alt="Pearly Whites Dental Logo"></a>
			<div id="header-links">
				<a href="index.php">Home</a>
				<a href="our-dentists.php">Our Dentists</a>
				<a href="contact-us.php">Contact Us</a>
				
				<!-- Log in button, show when not logged in --> 
				<?php 
					if (!isset($_SESSION['valid_user'])) {
						// not logged in, show logged in button 
						echo '<a href="login.html" class="btn-pri btn-login" style="color: white;">Log In</a>';
					}
				?>
								
				<!-- dropdown for account page & logout -->
				<div class="dropdown" 
					<?php 
						// hide if not logged in
						if (!isset($_SESSION['valid_user'])) {
							echo 'style="display: none;"';
						}
					?>
				>
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

	<div class="main-container">
		<!-- banner image -->
		<div class="banner-img">
			<div class="banner-content">
				<h1 class="homename">Pearly Whites Dental</h1>

			</div>
		</div>

		<!-- page content -->
		<div class="main-content">
			<div style="height: 60px;"></div>
			<h1>Why choose us?</h1>
			<div class="row">
				<div class="column" style="margin-left: 20px">
					<img src="images/2.png" alt="clinicicon">
					<br>
					<strong>More than 80 clinics in Singapore.</strong>
					<br>
					Many clinics around the country for convenient access wherever you may be.
				</div>
				<div class="column" style="margin-left: 100px">
					<img src="images/3.png" alt="dentisticon">
					<br>
					<strong>Over 100 highly qualified dentists</strong>
					<br>
					All of our dentists are highly experienced and adept at multiple treatments and procedures.
				</div>
				<div class="column" style="margin-left: 100px">
					<img src="images/4.png" alt="servicesicon">
					<br>
					<strong>Wide range of dental services</strong>
					<br>
					We offer a multitude of dental services using modern dental technology, which are much more
					effective and highly efficient.
				</div>
			</div>
			<div style="height: 100px;"></div>

		</div>

		<div class="table-container">
			<div class="table-img">
				<div class="table-content">
					<h1>Our Services</h1>

					<!--table of services provided-->
					<table>
						<tr>
							<td class="table-col__one"><strong>Scaling & Polishing</strong></td>
							<td class="table-col__three">Professional cleaning helps remove plaque and tartar buildup,
								preventing gum disease and cavities.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>X-ray and Diagnostic Imaging</strong></td>
							<td class="table-col__three">X-ray enables hidden dental problems to be identified, and
								treatments can be planned using diagnostic tools.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>Crowns & Bridges</strong></td>
							<td class="table-col__three">Crowns help to protect and restore damaged or weakened teeth;
								bridges can replace missing teeth using crowns on the adjacent teeth.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>Dentures</strong></td>
							<td class="table-col__three">Partial or full dentures can replace multiple missing teeth.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>Orthodontics</strong></td>
							<td class="table-col__three">Misaligned teeth and bite patterns can be corrected using
								traditional braces, clear aligners and removable retainers.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>Oral Surgery</strong></td>
							<td class="table-col__three">Various dental problems require surgery to correct, such as
								wisdom tooth removal, as well as certain oral and maxillofacial pathology diagnoses.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>Endodontics</strong></td>
							<td class="table-col__three">Problems that affect the tooth pulp such as infection and
								inflammation can be addressed by endodontics procedures such as root canal treatment.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>Periodontal Care</strong></td>
							<td class="table-col__three">Treatment and management of gum disease.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>Cosmetic Dentistry</strong></td>
							<td class="table-col__three">The appearance of teeth can be improved and enhanced via
								treatments such as teeth whitening and teeth bonding.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>Emergency Dental Care</strong></td>
							<td class="table-col__three">Immediate care for dental emergencies, such as severe
								toothache, trauma, or knocked-out teeth.
								<br>
								<br>
							</td>
						</tr>
						<tr>
							<td class="table-col__one"><strong>Pediatric Dentistry</strong></td>
							<td class="table-col__three">Specialized care for children, including preventive treatments,
								education, and cavity management.
								<br>
								<br>
							</td>
						</tr>

					</table>
					<br>
					<br>
				</div>
			</div>
		</div>

		<div id="cta-section">
			<h1>Make an appointment with us today!</h1>
			
			<!-- book now button -->
			<?php 
				// check if logged in
				if (isset($_SESSION['valid_user'])) {
					// logged in 
					echo '<a href="dashboard.php" class="btn-outline btn-cta">BOOK NOW</a>';
				} else {
					// not logged in
					echo '<a href="login.html" class="btn-outline btn-cta">BOOK NOW</a>';
				}
			?>			

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