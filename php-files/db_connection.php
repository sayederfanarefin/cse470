<?php

$servername = "cse470win.cloudapp.net:3306";
$username = "root";
$password = "sXdG1234";
$db = "yo";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>