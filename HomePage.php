<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Time Clock</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="timeclock.css">
        <script src="timeclock.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        
        <div class="main">

            <h3 id="time">Current time is: </h3>

            <div class="btns-cont">
                <div class="btnstxt">
                    <p id="clockin">Clock-in time: </p>
                    <p id="clockout">Clock-out time: </p>
                </div>
                
                <div class="btns">       
                    <button type="button" id="clockInBtn">Clock In</button>
                    <button type="button" id="clockOutBtn">Clock Out</button>
                </div>

                <div  class="btnstxt">
                    <p id="breakout">Break-out time: </p>
                    <p id="breakin">Break-in time: </p>
                </div>
                
                <div class="btns">
                    <button type="button" id="breakOutBtn">Break Out</button>
                    <button type="button" id="breakInBtn">Break In</button>
                </div>
            </div>

        </div>
    </body>
</html>
