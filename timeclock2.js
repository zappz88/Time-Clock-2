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

var x = 0;

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
}

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
            onClockOut()
            break;
    }
}


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
}

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
}

var myVar = setInterval(myTimer, 1000);
function myTimer() {
    var d = new Date();
    var t = d.toLocaleTimeString();
    document.getElementById("time").innerHTML = "Current time is: " + t;
}

function resetBtnTxt(id, text) {
    setTimeout(function () {
        document.getElementById(id).innerHTML = text;
    }, 3000);
}

function onClockIn() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
           alert("Success");
        }
    };
    xhttp.open("GET", "php-onclockin.php", true);
    xhttp.send();
};

function onClockOut() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
           alert("Success");
        }
    };
    xhttp.open("GET", "php-onclockout.php", true);
    xhttp.send();
};

//function onClockIn() {
//    var xhttp = new XMLHttpRequest();
//    xhttp.onreadystatechange = function () {
//        if (this.readyState == 4 && this.status == 200) {
//           alert("Successfully added data!");
//        }
//    };
//    xhttp.open("POST", "php-onclockin.php", true);
//    xhttp.send(name);
//};
//var username = "Andrew";
//
//function onClockIn2() {
//    $("#clockin").click(function () {
//        $.ajax({
//            url: "php-onclockin.php",
//            method: 'get',
//            data: {name:username},
//            success: function (data) {
//                alert(result);
//            },
//            error: function (data) {
//                alert("Error");
//            }
//        });
//    });
//}
//;