<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Contact Us | Pearly Whites Dental</title>
	<meta charset="utf-8">

	<!-- stylesheet -->
	<link rel="stylesheet" href="css/styles.css">
	<script type = "text/javascript" src = "scripts.js"></script>
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
		<div class="contact-img">
			<div class="contact-content">
				<h1 class="homename">Contact Us</h1>
				
			</div>
		</div>

		<!-- page content -->
		<div class="main-content">
			<div style="height: 60px;"></div>

			<div id="leftcolumn">
				<br>
				<img src="images/map.png" alt="map">
			</div>

			<div id="rightcolumn">
				<br>
				<br>
				<h2>Address</h2>
				123 Sparkling Street
				<br>
				Singapore 987654
				<br>
				<br>
				<br>			
				<h2>Opening hours</h2>
				Daily, 9am to 8pm
				<br>
				Last appointment timeslot: 6.30pm
				<br>
				<br>
				<br>
				<h2>Contacts</h2>
				<div class="icons">
					<img src="images/icon_phone.png" width="20" height="20" alt="phone">
					<div style="margin-left: 10px">61234567</div>
				</div>
				<div class="icons">
					<img src="images/icon_mail.png" width="20" height="20" alt="email">
					<div style="margin-left: 10px">enquiry@pearlywhites.com</div>
				</div>
			</div>

			<div style="height: 40px; clear: both;"></div>
			
		</div>
		<div>
			<h1>Send us your enquiries below </h1>
			<form action="enquiries.php" method="post">
				<div>
					<div class="form-col__two">
						<input type="text" name="name" id="name" class="form-row__one" size="50" required placeholder="Name">
						<br>
						<small id="name-error"></small>
					</div>
				</div>
				<div>
					<div class="form-col__two">
						<input name="number" id="number" class="form-row__one" size="50" required placeholder="Contact Number">
						<br>
						<small id="num-error"></small>
					</div>
				</div>
				<div>
					<div class="form-col__two">
						<input name="email" id="email" class="form-row__one" size="50" required placeholder="Email address">
						<br>
						<small id="email-error"></small>
					</div>
				</div>
				
				<div>
					<div class="form-col__two">
						<textarea name="message" id="message" class="form-row__one" rows="4" cols="52" required placeholder="Message"></textarea>
						<br>
						<small id="msg-error"></small>
					</div>
				</div>
				<br>
				<input type="submit" class="btn-outline btn-submit" id="btnSubmit" value="Send message">
			</form>

			<div style="height: 80px;"></div>
		</div>
	</div>
	
	
	
	<br>
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