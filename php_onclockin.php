<?php

session_start();
$userid = $_SESSION['id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert data
$sql = "INSERT INTO times (UserID, Status) VALUES ('$userid', 'Clocked In');";
if (mysqli_query($conn, $sql)) {
    echo "Data added successfully";
} else {
    echo "Error adding data: " . $sql . mysqli_error($conn);
}

mysqli_close($conn);
?>
