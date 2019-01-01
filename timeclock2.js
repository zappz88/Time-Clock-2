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
    }
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
    }
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
    }
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
    }
};

const myVar = setInterval(myTimer, 1000);
function myTimer() {
    let d = new Date();
    let t = d.toLocaleTimeString();
    document.getElementById("time").innerHTML = "Current time is: " + t;
};

function resetBtnTxt(id, text) {
    setTimeout(function () {
        document.getElementById(id).innerHTML = text;
    }, 3000);
};

function onClockIn() {
    let xhttp = new XMLHttpRequest();
//    xhttp.onreadystatechange = function () {
//        if (this.readyState != 4 && this.status != 200) {
//            alert("Connection error");
//        }
//    };
    xhttp.open("GET", "php_onclockin.php", true);
    xhttp.send();
};


function onClockOut() {
    let xhttp = new XMLHttpRequest();
//    xhttp.onreadystatechange = function () {
//        if (this.readyState != 4 && this.status != 200) {
//            alert("Connection error");
//        }
//    };
    xhttp.open("GET", "php_onclockout.php", true);
    xhttp.send();
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
}

document.getElementById("clockInBtn").addEventListener("click", function(){
    clockIn('clockin');
    resetBtnTxt('clockin', clock.inText);
}); 

document.getElementById("clockOutBtn").addEventListener("click", function(){
    clockOut('clockout');
    resetBtnTxt('clockout', clock.outText2); 
}); 

document.getElementById("breakOutBtn").addEventListener("click", function(){
    breakOut('breakout');
    resetBtnTxt('breakout', rest.outText); 
}); 

document.getElementById("breakInBtn").addEventListener("click", function(){
    breakIn('breakin'); 
    resetBtnTxt('breakin', rest.inText2);
});
