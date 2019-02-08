<?php

//Initiate session and access session variables
session_start();
$userid = $_SESSION['id'];

$clockInTime = $_SESSION['clockInTime'];


$clockInDate = $_SESSION['clockInDate'];
$clockIn = $_SESSION['clockIn'];

$_SESSION['breakOutTime'] = $_POST['breakOutTime'];
$breakOutTime = $_SESSION['breakOutTime'];
