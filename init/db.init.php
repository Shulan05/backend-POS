<?php
$host = 'fdb1029.awardspace.net'; // Use the actual MySQL host provided by your hosting
$dbname = '4618332_tey';              // Make sure this DB exists in your hosting panel
$user = '4618332_tey';           // Your database username
$password = 'xt;*G(nk7vJcWz.(';  // Your database password

// Create a new MySQL connection
$db = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}


?>
