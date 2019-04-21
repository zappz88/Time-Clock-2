<?php

//Initiate session and access session variables
session_start();
$userid = $_SESSION['id'];

$clockInTime = $_SESSION['clockInTime'];

$clockInDate = $_SESSION['clockInDate'];

$_SESSION['clockOutTime'] = $_POST['clockOutTime'];
$clockOutTime = $_SESSION['clockOutTime'];

$_SESSION['clockOutDate'] = $_POST['clockOutDate'];
$clockOutDate = $_SESSION['clockOutDate'];

$clockIn = $_SESSION['clockIn'];

$breakTime = $_SESSION['breakTime'];

class DataSort {

    //Variables within PHP classes cannot be located outside functions at least in PHP without error
    function DataSort($data) {
        $test = json_decode($data);
        $this->time = $test->time;
        $this->hours = $test->hours;
        $this->minutes = $test->minutes;
    }

}

$clockOut = new DataSort($clockOutTime);
$hours = 0;
$minutes = 0;

if ($clockInTime) {
    if ($clockOut->hours < $clockIn->hours) {
        $hours = (12 - $clockIn->hours) + ($clockOut->hours - 1);
        $hours = $hours * 60;
    } else {
        $hours = $clockOut->hours - $clockIn->hours;
        $hours = $hours * 60;
    }
}

if ($clockInTime) {
    if ($clockOut->minutes < $clockIn->minutes) {
        $minutes = $clockOut->minutes + (60 - $clockIn->minutes);
    } else {
        $minutes = $clockOut->minutes - $clockIn->minutes;
    }
}

$hours = $hours + $minutes;
$hoursWithBreak = ($hours - $breakTime) / 60;   


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
$sql = "INSERT INTO times (UserID, Status, Date, Time, Hours) VALUES ('$userid', 'Clocked Out', '$clockOutDate', '$clockOut->time', '$hoursWithBreak');";
if ($conn->query($sql) == true) {
    echo "Data added successfully";
    echo $hours;
} else {
    echo "Error adding data: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?> 
