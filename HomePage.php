<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Time Clock</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="homepagecss.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>

        <div class="main">

            <h3 id="time">Current time is: </h3>
            <div class="btns-cont">
                <div class="btns-left">
                    <p id="clockin">Clock-in time: </p>
                    <button type="button" id="clockInBtn" class="btn">Clock In</button>
                    <p id="breakout">Break-out time: </p>
                    <button type="button" id="breakOutBtn" class="btn">Break Out</button>
                </div>

                <div class="btns-right">
                    <p id="clockout">Clock-out time: </p>
                    <button type="button" id="clockOutBtn" class="btn">Clock Out</button>
                    <p id="breakin">Break-in time: </p>
                    <button type="button" id="breakInBtn" class="btn">Break In</button>
                </div>
            </div>
            <div id="exit" class="exit"><button type='button' id="exitBtn" class="exitBtn">Exit</button></div>
        </div>

        <script>
            var clock = {
                bool: false,
                in: 0,
                inText: 'Clock-in time: ',
                inText2: 'Already clocked in: ',
                out: 0,
                outText: 'Not clocked in.',
                outText2: 'Clock-out time is: '
            };

            var rest = {
                bool: false,
                out: 0,
                outText: 'Break-out time is: ',
                outText2: 'Still on break: ',
                in: 0,
                inText: 'Not on break.',
                inText2: 'Break-in time is: '
            };

            function clockIn(id) {
                switch (clock.bool) {
                    case false:
                        let d = new Date().toLocaleTimeString();
                        clock.bool = true;
                        clock.in = d;
                        document.getElementById(id).innerHTML = clock.inText + clock.in;
                        onClockIn();
                        break;
                    case true:
                        document.getElementById(id).innerHTML = clock.inText2 + clock.in;
                        break;
                }
            }
            ;

            function clockOut(id) {
                if (rest.bool === false) {
                    switch (clock.bool) {
                        case false:
                            document.getElementById(id).innerHTML = clock.outText;
                            break;
                        case true:
                            let d = new Date().toLocaleTimeString();
                            clock.bool = false;
                            clock.out = d;
                            document.getElementById(id).innerHTML = clock.outText2 + clock.out;
                            onClockOut();
                            break;
                    }
                } else {
                    document.getElementById(id).innerHTML = rest.outText2 + rest.out;
                }
            }
            ;


            function breakOut(id) {
                if (clock.bool === true) {
                    switch (rest.bool) {
                        case false:
                            var d = new Date().toLocaleTimeString();
                            rest.bool = true;
                            rest.out = d;
                            document.getElementById(id).innerHTML = rest.outText + rest.out;
                            onBreakOut();
                            break;
                        case true:
                            document.getElementById(id).innerHTML = rest.outText2 + rest.out;
                            break;
                    }
                } else {
                    document.getElementById(id).innerHTML = clock.outText;
                }
            }
            ;

            function breakIn(id) {
                if (rest.bool === true) {
                    switch (rest.bool) {
                        case false:
                            document.getElementById(id).innerHTML = rest.inText;
                            break;
                        case true:
                            var d = new Date().toLocaleTimeString();
                            rest.bool = false;
                            rest.in = d;
                            document.getElementById(id).innerHTML = rest.inText2 + rest.in;
                            onBreakIn();
                            break;
                    }
                } else {
                    document.getElementById(id).innerHTML = clock.outText;
                }
            }
            ;

            var myVar = setInterval(myTimer, 1000);
            function myTimer() {
                var d = new Date().toLocaleTimeString();
                document.getElementById('time').innerHTML = 'Current time is: ' + d;
            }
            ;

            function resetBtnTxt(id, text) {
                setTimeout(function () {
                    document.getElementById(id).innerHTML = text;
                }, 3000);
            }
            ;

            function currentDate() {
                let date = new Date();
                let year = date.getFullYear();
                let month = date.getMonth() + 1;
                let day = date.getDate();
                return month + '/' + day + '/' + year;
            }
            ;

            function currentTime() {
                let date = new Date();
                let hours = date.getHours();
                if (hours > 12) {
                    hours = hours - 12;
                }
                ;
                let minutes = date.getMinutes();
                if (minutes < 10) {
                    minutes = '0' + minutes;
                }
                ;
                let time = {
                    hours: hours,
                    minutes: minutes,
                    time: hours + ':' + minutes
                };
                return JSON.stringify(time);
            }
            ;

            function onClockIn() {
                var xhr = new XMLHttpRequest();
                var data = {
                    status: 'status=true',
                    date: 'clockInDate=' + currentDate(),
                    time: 'clockInTime=' + currentTime(),
                    functionToCall: 'functionToCall=clockIn'
                };
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                    }
                };
                xhr.open('POST', 'timeclockPHPMaster.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(`${data.status}&${data.date}&${data.time}&${data.functionToCall}`);
            }
            ;


            function onClockOut() {
                var xhr = new XMLHttpRequest();
                var data = {
                    status: 'status=false',
                    date: 'clockOutDate=' + currentDate(),
                    time: 'clockOutTime=' + currentTime(),
                    functionToCall: 'functionToCall=clockOut'
                };
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                    }
                };
                xhr.open('POST', 'timeclockPHPMaster.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(`${data.status}&${data.date}&${data.time}&${data.functionToCall}`);
            }
            ;

            function onBreakOut() {
                var xhr = new XMLHttpRequest();
                var data = {
                    date: 'breakOutDate=' + currentDate(),
                    time: 'breakOutTime=' + currentTime(),
                    functionToCall: 'functionToCall=breakOut'
                };
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                    }
                };
                xhr.open('POST', 'timeclockPHPMaster.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(`${data.date}&${data.time}&${data.functionToCall}`);
            }
            ;

            function onBreakIn() {
                var xhr = new XMLHttpRequest();
                var data = {
                    date: 'breakInDate=' + currentDate(),
                    time: 'breakInTime=' + currentTime(),
                    functionToCall: 'functionToCall=breakIn'
                };
                xhr.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                    }
                };
                xhr.open('POST', 'timeclockPHPMaster.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(`${data.date}&${data.time}&${data.functionToCall}`);
            }
            ;

            function exit() {
                location.href = 'http://localhost/TimeClock/index.php';
            }
            ;

            document.getElementById('exitBtn').addEventListener('click', exit);

            document.getElementById('clockInBtn').addEventListener('click', function () {
                clockIn('clockin');
                resetBtnTxt('clockin', clock.inText);
            });

            document.getElementById('clockOutBtn').addEventListener('click', function () {
                clockOut('clockout');
                resetBtnTxt('clockout', clock.outText2);
            });

            document.getElementById('breakOutBtn').addEventListener('click', function () {
                breakOut('breakout');
                resetBtnTxt('breakout', rest.outText);
            });

            document.getElementById('breakInBtn').addEventListener('click', function () {
                breakIn('breakin');
                resetBtnTxt('breakin', rest.inText2);
            });
        </script>
    </body>
</html>
