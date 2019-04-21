    <!DOCTYPE html>
<?php
session_start();
?>

<html>
    <head>
        <title>Time Clock</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="indexcss.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="main">

            <h3 id="time">Current time is: </h3>

            
            <form method="POST" action="timeclockPHPMaster.php" class="loginInfo" target="_self">
                    ID: <input type="text" id="login" name="id" value="" required>
                    <input type="submit" value="Login">
                </form>
            <div class="btnDiv">
                <div class="loginLayout">
                    <button type="button" id="btn0" class="btnLogin">0</button>
                    <button type="button" id="btn1" class="btnLogin">1</button>
                    <button type="button" id="btn2" class="btnLogin">2</button>
                    <button type="button" id="btn3" class="btnLogin">3</button>
                    <button type="button" id="btn4" class="btnLogin">4</button>
                    <button type="button" id="btn5" class="btnLogin">5</button>
                    <button type="button" id="btn6" class="btnLogin">6</button>
                    <button type="button" id="btn7" class="btnLogin">7</button>
                    <button type="button" id="btn8" class="btnLogin">8</button>
                    <button type="button" id="btn9" class="btnLogin">9</button>
                </div>

                <div id="resetBtnDiv" class="resetBtnDiv">
                    <button type="button" id="btnReset" class="btnLoginReset">Reset</button>
                </div>

            </div>

        </div>
        <script>
            var myVar = setInterval(myTimer, 1000);
            function myTimer() {
                var d = new Date().toLocaleTimeString();
                document.getElementById("time").innerHTML = "Current time is: " + d;
            };
            
            function login() {
                $(function () {
                    var text = $("#login").val();
                    $("#btn0").click(function () {
                        text += "0";
                        $("#login").val(text);
                    });
                    $("#btn1").click(function () {
                        text += "1";
                        $("#login").val(text);
                    });
                    $("#btn2").click(function () {
                        text += "2";
                        $("#login").val(text);
                    });
                    $("#btn3").click(function () {
                        text += "3";
                        $("#login").val(text);
                    });
                    $("#btn4").click(function () {
                        text += "4";
                        $("#login").val(text);
                    });
                    $("#btn5").click(function () {
                        text += "5";
                        $("#login").val(text);
                    });
                    $("#btn6").click(function () {
                        text += "6";
                        $("#login").val(text);
                    });
                    $("#btn7").click(function () {
                        text += "7";
                        $("#login").val(text);
                    });
                    $("#btn8").click(function () {
                        text += "8";
                        $("#login").val(text);
                    });
                    $("#btn9").click(function () {
                        text += "9";
                        $("#login").val(text);
                    });
                    $("#btnReset").click(function () {
                        text = "";
                        $("#login").val(text);
                    });
                });
            };
            
            login();

            document.getElementById("btn0").addEventListener("click", login);
            document.getElementById("btn1").addEventListener("click", login);
            document.getElementById("btn2").addEventListener("click", login);
            document.getElementById("btn3").addEventListener("click", login);
            document.getElementById("btn4").addEventListener("click", login);
            document.getElementById("btn5").addEventListener("click", login);
            document.getElementById("btn6").addEventListener("click", login);
            document.getElementById("btn7").addEventListener("click", login);
            document.getElementById("btn8").addEventListener("click", login);
            document.getElementById("btn9").addEventListener("click", login);
            document.getElementById("btnReset").addEventListener("click", login);
        </script>
    </body>
</html>
