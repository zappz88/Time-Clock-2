<?php

//Initiate session and access session variables
session_start();
$userid = $_SESSION['id'];

$_SESSION['clockInTime'] = $_POST['clockInTime'];
$clockInTime = $_SESSION['clockInTime'];

$_SESSION['clockInDate'] = $_POST['clockInDate'];
$clockInDate = $_SESSION['clockInDate'];

class DataSort {

    //Variables within PHP classes cannot be located outside functions at least in PHP without error
    function DataSort($data) {
        $test = json_decode($data);
        $this->time = $test->time;
        $this->hours = $test->hours;
        $this->minutes = $test->minutes;
    }

}

$clockIn = new DataSort($clockInTime);
$_SESSION['clockIn'] = $clockIn;


//Database connection variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Insert data
$sql = "INSERT INTO times (UserID, Status, Date, Time) VALUES ('$userid', 'Clocked In', '$clockInDate', '$clockIn->time');";
if ($conn->query($sql) == true) {
    echo "Data added successfully";
    echo $clockIn->time;
} else {
    echo "Error adding data: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
