<?php
  session_start();

  // store to test if they *were* logged in
  $old_user = $_SESSION['valid_user'];
  unset($_SESSION['valid_user']);
  $_SESSION = array();
  session_destroy();

  // Redirect back to the page after updating
  header("Location: index.html");
?>