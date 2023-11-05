<?php
	$to = 'f32ee@localhost';
	$from = $_POST["email"]; 
	$fromName = $_POST["name"];
	$subject = 'Enquiries';
	$message = $_POST["message"];
	$headers = 'From: '.$fromName.'<'.$from.'>' . "\r\n" .
		'Reply-To: f32ee@localhost' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers,'-ff31ee@localhost');

	// alert message after submitting enquires form and redirect back to contact-us.html
	echo "<script>";
	echo "alert('Thank you for sending us your enquiries. We will get back to you as soon as possible.');";
	echo "window.location.href = 'contact-us.html';"; // Redirect to contact-us.html
	echo "</script>";
?> 