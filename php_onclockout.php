<?php

//Initiate session and access session variables
session_start();
$userid = $_SESSION['id'];

//Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

//Sent data
$date = $_POST["date"];
$time = $_POST["time"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Insert data
$sql = "INSERT INTO times (UserID, Status, Date, Time) VALUES ('$userid', 'Clocked Out', '$date', '$time');";
if ($conn->query($sql) == true) {
    echo "Data added successfully";
} else {
    echo "Error adding data: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
