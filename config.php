<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";

// try connecting to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
