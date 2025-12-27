<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');           // Change to your MySQL username
define('DB_PASS', 'Moses@19');               // Change to your MySQL password
define('DB_NAME', 'user_system');

// Create database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start session
session_start();
?>