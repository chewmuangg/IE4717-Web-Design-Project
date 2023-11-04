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
			<a href="index.html"><img src="images/logo.png" id="header-logo" alt="Pearly Whites Dental Logo"></a>
			<div id="header-links">
				<a href="index.html">Home</a>
				<a href="our-dentists.html">Our Dentists</a>
				<a href="contact-us.html">Contact Us</a>
				<a href="login.html" class="btn-pri btn-login" style="color: white;">Log In</a>
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
		    <div>
			    <br>
			    <h1>Thank you for sending us your enquiries.</h1>
                <p>We will get back to you as soon as possible.</p>

                
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

<?php
$to      = 'f32ee@localhost';
$from = $_POST["email"]; 
$fromName = $_POST["name"];
$subject = 'Enquiries';
$message = $_POST["message"];
$headers = 'From: '.$fromName.'<'.$from.'>' . "\r\n" .
    'Reply-To: f32ee@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers,'-ff31ee@localhost');

?> 

</body>

</html>