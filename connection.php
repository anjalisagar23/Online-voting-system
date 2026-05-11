<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_voting_system";

$con = new mysqli($servername, $username, $password, $dbname);

// connection check
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    
}
?>