<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Time Clock</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="timeclockphp.css">
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

        <script>
            var clock = {
                bool: false,
                in: 0,
                inText: "Clock-in time: ",
                inText2: "Already clocked in: ",
                out: 0,
                outText: "Not clocked in.",
                outText2: "Clock-out time is: "
            };

            var rest = {
                bool: false,
                out: 0,
                outText: "Break-out time is: ",
                outText2: "Already on break: ",
                in: 0,
                inText: "Not on break.",
                inText2: "Break-in time is: "
            };

            function clockIn(id) {
                switch (clock.bool) {
                    case false:
                        var d = new Date();
                        var t = d.toLocaleTimeString();
                        clock.bool = true;
                        clock.in = t;
                        document.getElementById(id).innerHTML = clock.inText + clock.in;
                        onClockIn();
                        break;
                    case true:
                        document.getElementById(id).innerHTML = clock.inText2 + clock.in;
                        break;
                };
            };

            function clockOut(id) {
                switch (clock.bool) {
                    case false:
                        document.getElementById(id).innerHTML = clock.outText;
                        break;
                    case true:
                        var d = new Date();
                        var t = d.toLocaleTimeString();
                        clock.bool = false;
                        clock.out = t;
                        document.getElementById(id).innerHTML = clock.outText2 + clock.out;
                        onClockOut();
                        break;
                };
            };


            function breakOut(id) {
                switch (rest.bool) {
                    case false:
                        var d = new Date();
                        var t = d.toLocaleTimeString();
                        rest.bool = true;
                        rest.out = t;
                        document.getElementById(id).innerHTML = rest.outText + rest.out;
                        break;
                    case true:
                        document.getElementById(id).innerHTML = rest.outText2 + rest.out;
                        break;
                };
            };

            function breakIn(id) {
                switch (rest.bool) {
                    case false:
                        document.getElementById(id).innerHTML = rest.inText;
                        break;
                    case true:
                        var d = new Date();
                        var t = d.toLocaleTimeString();
                        rest.bool = false;
                        rest.in = t;
                        document.getElementById(id).innerHTML = rest.inText2 + rest.in;
                        break;
                };
            };

            var myVar = setInterval(myTimer, 1000);
            function myTimer() {
                var d = new Date();
                var t = d.toLocaleTimeString();
                document.getElementById("time").innerHTML = "Current time is: " + t;
            };

            function resetBtnTxt(id, text) {
                setTimeout(function () {
                    document.getElementById(id).innerHTML = text;
                }, 3000);
            };

            function onClockIn() {
                var xhttp = new XMLHttpRequest();
//    xhttp.onreadystatechange = function () {
//        if (this.readyState != 4 && this.status != 200) {
//            alert("Connection error");
//        }
//    };
                xhttp.open("GET", "php_onclockin.php", true);
                xhttp.send();
            };


            function onClockOut() {
                var xhttp = new XMLHttpRequest();
//    xhttp.onreadystatechange = function () {
//        if (this.readyState != 4 && this.status != 200) {
//            alert("Connection error");
//        }
//    };
                xhttp.open("GET", "php_onclockout.php", true);
                xhttp.send();
            };

            document.getElementById("clockInBtn").addEventListener("click", function () {
                clockIn('clockin');
                resetBtnTxt('clockin', clock.inText);
            });

            document.getElementById("clockOutBtn").addEventListener("click", function () {
                clockOut('clockout');
                resetBtnTxt('clockout', clock.outText2);
            });

            document.getElementById("breakOutBtn").addEventListener("click", function () {
                breakOut('breakout');
                resetBtnTxt('breakout', rest.outText);
            });

            document.getElementById("breakInBtn").addEventListener("click", function () {
                breakIn('breakin');
                resetBtnTxt('breakin', rest.inText2);
            });
        </script>
    </body>
</html>
