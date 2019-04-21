<?php

session_start();
$_SESSION['id'] = $_POST['id'];
$userid = $_SESSION['id'];

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

// Check data
        $sql = "Select * from employees where EmployeeID = $userid";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            header("Location: http://localhost/TimeClock/index.php");
        } else {
            header("Location: http://localhost/TimeClock/HomePage.php");
        }

        $conn->close();
?> 
