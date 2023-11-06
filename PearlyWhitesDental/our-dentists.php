<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Our Dentists | Pearly Whites Dental</title>
	<meta charset="utf-8">

	<!-- javascript -->
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
						<a href="logout.php" onclick="return confirmLogout();">Log Out</a>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<!-- end of nav bar -->

	<div class="main-container">
		<!-- banner image -->
		<div class="dentists-img">
			<div class="dentists-content">
				<h1 class="homename">Our Dentists</h1>
				
			</div>
		</div>

		<!-- page content -->
		<div class="main-content">
			<div class="row">
				<!-- Dentist 1 -->
				<div class="col-dentist"><img src="images/dentist1.jpg" alt="Dr. Emily Pearson">
					<br>
					<strong class="dentist-name">Dr. Emily Pearson</strong>
					<div class="dentist-subtitle">&lpar;DDS&rpar;, Dental Surgeon</div>
					<br>
					<br>
					<button type="button" class="collapsible">View details</button>
					<div class="collapsecontent">
						<p>
							Dr. Emily Pearson is a highly regarded dentist with over two decades of experience in general and cosmetic dentistry. She is known for her commitment to patient care and has earned the trust of her community. Dr. Pearson is a recipient of the "Distinguished Service Award" from the American Dental Association for her outstanding contributions to the field. Her gentle chairside manner and dedication to staying current with the latest dental advancements make her a go-to choice for families seeking exceptional oral healthcare.
						</p>
					</div>
				</div>

				<!-- Dentist 2 -->
				<div class="col-dentist"><img src="images/dentist2.jpg" alt="Dr. Carlos Novakowski">
					<br>
					<strong class="dentist-name">Dr. Carlos Novakowski</strong>
					<div class="dentist-subtitle">DMD, MS, Orthodontist</div>
					<br>
					<br>
					<button type="button" class="collapsible">View details</button>
					<div class="collapsecontent">
						<p>
							Dr. Carlos Novakowski is an accomplished orthodontist who holds a Doctor of Dental Medicine (DMD) degree along with a Master of Science (MS) in Orthodontics. He has transformed the smiles of countless patients with his expertise in orthodontic treatments. Dr. Novakowski is a recipient of the "Orthodontic Excellence Award" from the American Association of Orthodontists, recognizing his exceptional skill in creating beautiful, well-aligned smiles. Patients admire his attention to detail and the life-changing results he achieves.
						</p>
				    </div>
				</div>

				<!-- Dentist 3-->
				<div class="col-dentist"><img src="images/dentist3.jpg" alt="Dr. Sarah Rodriguez">
					<br>
					<strong class="dentist-name">Dr. Sarah Rodriguez</strong>
					<div class="dentist-subtitle">PhD, Pediatric Dentist</div>
					<br>
					<br>
					<button type="button" class="collapsible">View details</button>
					<div class="collapsecontent">
						<p>
							Dr. Sarah Rodriguez is a dedicated pediatric dentist who holds both a Doctor of Dental Medicine (DMD) degree and a Doctor of Philosophy (PhD) in Pediatric Dentistry. Her passion for working with children and her contributions to dental research have earned her the "Outstanding Pediatric Dentist Award" from the National Association of Pediatric Dentists. Dr. Rodriguez's warm and friendly approach to pediatric dental care has made her a favorite among parents and children alike, providing a nurturing environment for young patients to develop lifelong oral health habits.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- script for animated collapsible -->
	<script>
		var coll = document.getElementsByClassName("collapsible");
		var i;
		
		for (i = 0; i < coll.length; i++) {
		  coll[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var content = this.nextElementSibling;
			if (content.style.maxHeight){
			  content.style.maxHeight = null;
			} else {
			  content.style.maxHeight = content.scrollHeight + "px";
			} 
		  });
		}
	</script>
		
		
	
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