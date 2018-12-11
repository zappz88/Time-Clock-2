<!DOCTYPE html>
<html>
    <head>
        <title>Time Clock</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="timeclock2.css">
        <script src="timeclock2.js"></script>
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
                    <button type="button" onclick="clockIn('clockin'); resetBtnTxt('clockin', clock.inText)">Clock In</button>
                    <button type="button" onclick="clockOut('clockout'); resetBtnTxt('clockout', clock.outText2)">Clock Out</button>
                </div>

                <div  class="btnstxt">
                    <p id="breakout">Break-out time: </p>
                    <p id="breakin">Break-in time: </p>
                </div>
                <div class="btns">
                    <button type="button" onclick="breakOut('breakout'); resetBtnTxt('breakout', rest.outText)">Break Out</button>
                    <button type="button" onclick="breakIn('breakin'); resetBtnTxt('breakin', rest.inText2)">Break In</button>
                </div>
            </div>

        </div>
    </body>
</html>
