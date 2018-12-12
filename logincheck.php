<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindb";

$userid = $_POST["ID"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "Select * from ids where ID = '$userid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Improper Login";
} else {
    header("Location: http://localhost/PhpProject2/clockin.php?ID=");
}

mysqli_close($conn);
?>
