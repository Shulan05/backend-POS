<?php
// Automatically detect the environment
$serverName = $_SERVER['SERVER_NAME'];

if ($serverName === 'localhost' || $serverName === '127.0.0.1') {
    // Local development settings (XAMPP)
    $host = '127.0.0.1';
    $dbname = 'webapp';     // Your local database name
    $user = 'root';
    $password = '';
} else {
    // Hosting settings (AwardSpace)
    $host = 'fdb1029.awardspace.net';
    $dbname = '4618332_tey';
    $user = '4618332_tey';
    $password = 'xt;*G(nk7vJcWz.(';
}

// Connect to MySQL
$db = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}
?>
