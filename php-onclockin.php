<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$time = date('Y-m-d H:i:s');
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "INSERT INTO employees (FirstName, LastName, Status, Time) VALUES ('Andrew', 'Ramshaw', 'Clocked In', '$time');";
if (mysqli_query($conn, $sql)) {
    echo "Data added successfully";
} else {
    echo "Error adding data: " . $sql . mysqli_error($conn);
}

mysqli_close($conn);
?>