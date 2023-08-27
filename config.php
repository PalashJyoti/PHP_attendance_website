<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";

// try connecting to the database
$conn = mysqli_connect($servername,$username,$password,$dbname);

// check the connection
if(mysqli_connect_errno()){
    echo"<script>alert('cannot connect to the database');</script>";
    exit();
}
