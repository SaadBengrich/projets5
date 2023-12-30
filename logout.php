<?php
// logout.php

session_start(); // start the session if not already started
session_destroy(); // destroy the session

// Redirect to the login page or any other desired page after logout
header("Location: login.php");
exit();
?>