<?php
// 1. Load credentials from your configuration file
include 'db_config.php'; 

// 2. Establish connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Check connection for errors
if ($conn->connect_error) {
    // Stop execution and display a developer-friendly error
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to UTF-8 for better text handling
$conn->set_charset("utf8");

// Note: We don't close the connection here; it remains open for the script that includes it.
?>