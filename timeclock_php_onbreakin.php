<?php

//Initiate session and access session variables
session_start();
$userid = $_SESSION['id'];

$clockInTime = $_SESSION['clockInTime'];

$clockInDate = $_SESSION['clockInDate'];

$clockOutTime = $_SESSION['clockOutTime'];

$clockOutDate = $_SESSION['clockOutDate'];

$clockIn = $_SESSION['clockIn'];

$breakOutTime = $_SESSION['breakOutTime'];

$_SESSION['breakInTime'] = $_POST['breakInTime'];
$breakInTime = $_SESSION['breakInTime'];

class DataSort {
    //Variables within PHP classes cannot be located outside functions at least in PHP without error
    function DataSort($data) {
        $test = json_decode($data);
        $this->time = $test->time;
        $this->hours = $test->hours;
        $this->minutes = $test->minutes;
    }
}

$breakIn =  new DataSort($breakInTime);
$breakOut = new DataSort($breakOutTime);

$hours = 0;
$minutes = 0;

if ($breakOutTime) {
    if ($breakIn->hours < $breakOut->hours) {
        $hours = (12 - $breakOut->hours) + ($breakIn->hours - 1);
        $hours = $hours * 60;
    } else {
        $hours = $breakIn->hours - $breakOut->hours;
        $hours = $hours * 60;
    }
}

if ($breakOutTime) {
    if ($breakIn->minutes < $breakOut->minutes) {
        $minutes = $breakIn->minutes + (60 - $breakOut->minutes);
    } else {
        $minutes = $breakIn->minutes - $breakOut->minutes;
    }
}

$hours = ($hours + $minutes) / 60;
$_SESSION['breakTime'] = $hours;
