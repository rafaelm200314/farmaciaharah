<?php
// Start or resume the session
session_start();

// Destroy the current session
session_destroy();

// Redirect the user to the login page
header("Location: login.php");

// Ensure no further code execution after the redirect
exit;
?>