<?php
    // cancel.php
    // conncect to db
    include "dbconnect.php";
    session_start();

    // create short variable names
    $apptId = $_GET['apptId'];

    // query formulation
    $query = "DELETE FROM appointments WHERE apptId=" . $apptId;

    // query submission
    $result = $dbcnx->query($query);

    // Redirect back to the page after deleting
    // alert message after submitting enquires form and redirect back to contact-us.html
	echo "<script>";
	echo "alert('The appointment has been cancelled.');";
	echo "window.location.href = 'dashboard.php';"; // Redirect to contact-us.html
	echo "</script>";
?>