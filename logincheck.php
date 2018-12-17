<?php

session_start();
$_SESSION['id'] = $_POST["id"];
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

// Check data
$sql = "Select * from employees where ID = '$userid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Improper Login";
} else {
    header("Location: http://localhost/PhpProject2/clockin.php");
}

mysqli_close($conn);
?>
