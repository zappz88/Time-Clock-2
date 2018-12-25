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
                <form method="POST" action="php_checklogin.php" class="loginInfo" target="_self">
                    ID: <input type="text" id="login" name="id" placeholder="Login ID">
                    <input type="submit" value="Login">
                </form>
                
                <div class="loginLayout">
                    <button type="button" id="btn0" class="btnLogin" onclick="login()">0</button>
                    <button type="button" id="btn1" class="btnLogin" onclick="login()">1</button>
                    <button type="button" id="btn2" class="btnLogin" onclick="login()">2</button>
                    <button type="button" id="btn3" class="btnLogin" onclick="login()">3</button>
                    <button type="button" id="btn4" class="btnLogin" onclick="login()">4</button>
                    <button type="button" id="btn5" class="btnLogin" onclick="login()">5</button>
                    <button type="button" id="btn6" class="btnLogin" onclick="login()">6</button>
                    <button type="button" id="btn7" class="btnLogin" onclick="login()">7</button>
                    <button type="button" id="btn8" class="btnLogin" onclick="login()">8</button>
                    <button type="button" id="btn9" class="btnLogin" onclick="login()">9</button>
                </div>
                
                <div id="resetBtnDiv" class="resetBtnDiv">
                    <button type="button" id="btnReset" class="btnLoginReset" onclick="login()">Reset</button>
                </div>
                
            </div>

        </div>
    </body>
</html>
