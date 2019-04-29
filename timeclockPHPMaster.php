<?php

session_start();

class TimeClock {

    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'mydb';

    public function clockIn() {
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            $userID = $_SESSION['id'];
            $clockInTimeObj = json_decode($_SESSION['clockInTime']);
            $_SESSION['clockIn'] = $clockInTimeObj;
            $clockInDate = $_SESSION['clockInDate'];

            if ($_SESSION['status'] == true) {

                $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    $sql = "INSERT INTO times (UserID, Status, Date, Time, Hours) VALUES ('$userID', 'Clock In', '$clockInDate', '$clockInTimeObj->time', 0);";
                    if ($conn->query($sql) === true) {
                        echo "Data added successfully\n";
                    } else {
                        echo "Error adding data: " . $sql . "<br>" . $conn->error;
                    }
                    $conn->close();
                }
            }
        }
    }

    public function clockOut() {
        if (isset($_SESSION['clockIn']) && !empty($_SESSION['clockIn'])) {
            $userID = $_SESSION['id'];
            $status = $_SESSION{'status'};
            $clockOutTimeObj = json_decode($_SESSION['clockOutTime']);
            $_SESSION['clockOut'] = $clockOutTimeObj;
            $clockOutDate = $_SESSION['clockOutDate'];
            $clockIn = $_SESSION['clockIn'];
            $hours = 0;
            $minutes = 0;

            if ($clockOutTimeObj->hours < $clockIn->hours) {
                $hours = (12 - $clockIn->hours) + ($clockOutTimeObj->hours - 1);
                $hours = $hours * 60;
            } else {
                $hours = $clockOutTimeObj->hours - $clockIn->hours;
                $hours = $hours * 60;
            }

            if ($clockOutTimeObj->minutes < $clockIn->minutes) {
                $minutes = $clockOutTimeObj > minutes + (60 - $clockIn->minutes);
            } else {
                $minutes = $clockOutTimeObj->minutes - $clockIn->minutes;
            }

            $hours = $hours + $minutes;
            if (isset($_SESSION['breaktime']) && !empty($_SESSION['breaktime'])) {
                $hours = ($hours - $breakTime) / 60;
            }

            if ($status == true) {
                $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO times (UserID, Status, Date, Time, Hours) VALUES ('$userID', 'Clock Out', '$clockOutDate', '$clockOutTimeObj->time', '$hours');";

                if ($conn->query($sql) == true) {
                    $_SESSION['status'] = false;
                } else {
                    echo "Error adding data: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
            }
        }
    }

    public function breakIn() {
        $breakInTime = $_SESSION['breakInTime'];
        $breakInTimeObj = json_decode($breakInTime);
        $breakInDate = $_SESSION['breakInDate'];
        $breakOutTime = $_SESSION['breakOutTime'];
        $breakOutTimeObj = json_decode($breakOutTime);
        $userID = $_SESSION['id'];

        $hours = 0;
        $minutes = 0;

        if ($breakOutTime) {
            if ($breakInTimeObj->hours < $breakOutTimeObj->hours) {
                $hours = (12 - $breakOutTimeObj->hours) + ($breakInTimeObj->hours - 1);
                $hours = $hours * 60;
            } else {
                $hours = $breakInTimeObj->hours - $breakOutTimeObj->hours;
                $hours = $hours * 60;
            }
            if ($breakInTimeObj->minutes < $breakOutTimeObj->minutes) {
                $minutes = $breakInTimeObj->minutes + (60 - $breakOutTimeObj->minutes);
            } else {
                $minutes = $breakInTimeObj->minutes - $breakOutTimeObj->minutes;
            }
        }

        $hours = ($hours + $minutes) / 60;
        $_SESSION['breakTime'] = $hours;
        
        if (isset($_SESSION['breakOutTime']) && !empty($_SESSION['breakOutTime'])) {

                $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    $sql = "INSERT INTO times (UserID, Status, Date, Time) VALUES ('$userID', 'Break In', '$breakInDate', '$breakInTimeObj->time');";
                    if ($conn->query($sql) === true) {
                        echo "Data added successfully\n";
                    } else {
                        echo "Error adding data: " . $sql . "<br>" . $conn->error;
                    }
                    $conn->close();
                }
            }
    }

    public function breakOut() {
        $breakOutTime = $_SESSION['breakOutTime'];
        $breakOutTimeObj = json_decode($breakOutTime);
        $breakOutDate = $_SESSION['breakOutDate'];
        $userID = $_SESSION['id'];
        
        if (isset($_SESSION['clockInTime']) && !empty($_SESSION['clockInTime'])) {

                $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    $sql = "INSERT INTO times (UserID, Status, Date, Time) VALUES ('$userID', 'Break Out', '$breakOutDate', '$breakOutTimeObj->time');";
                    if ($conn->query($sql) === true) {
                        echo "Data added successfully\n";
                    } else {
                        echo "Error adding data: " . $sql . "<br>" . $conn->error;
                    }
                    $conn->close();
                }
            }
    }

}

if (isset($_POST) && !empty($_POST)) {
    foreach ($_POST as $key => $value) {
        switch ($key) {
            case 'id':
                $_SESSION['id'] = $_POST['id'];
                break;
            case 'status':
                $_SESSION['status'] = $_POST['status'];
                break;
            case 'clockInTime':
                $_SESSION['clockInTime'] = $_POST['clockInTime'];
                break;
            case 'clockInDate':
                $_SESSION['clockInDate'] = $_POST['clockInDate'];
                break;
            case 'clockOutTime':
                $_SESSION['clockOutTime'] = $_POST['clockOutTime'];
                break;
            case 'clockOutDate':
                $_SESSION['clockOutDate'] = $_POST['clockOutDate'];
                break;
            case 'breakInTime':
                $_SESSION['breakInTime'] = $_POST['breakInTime'];
                break;
            case 'breakInDate':
                $_SESSION['breakInDate'] = $_POST['breakInDate'];
                break;
            case 'breakOutTime':
                $_SESSION['breakOutTime'] = $_POST['breakOutTime'];
                break;
            case 'breakOutDate':
                $_SESSION['breakOutDate'] = $_POST['breakOutDate'];
                break;
            default:
                break;
        }
    }
}

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'mydb';

if (isset($_POST['id']) && !empty($_POST['id'])) {

    $userID = $_SESSION['id'];

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $sql = "Select * from employees where EmployeeID = $userID";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            header("Location: http://localhost/TimeClock/index.php");
        } else {
            $_SESSION['status'] = true;
            header("Location: http://localhost/TimeClock/homepage.php");
        }

        $conn->close();
    }
}



if (isset($_POST['functionToCall']) && !empty($_POST['functionToCall'])) {
    switch ($_POST['functionToCall']) {
        case 'clockIn':
            $functionToCall = new TimeClock();
            $returnFunction = $functionToCall->clockIn();
            echo 'Function Call Successful\n';
            break;
        case 'clockOut':
            $functionToCall = new TimeClock();
            $returnFunction = $functionToCall->clockOut();
            echo 'Function Call Successful\n';
            break;
        case 'breakIn':
            $functionToCall = new TimeClock();
            $returnFunction = $functionToCall->breakIn();
            echo 'Function Call Successful\n';
            break;
        case 'breakOut':
            $functionToCall = new TimeClock();
            $returnFunction = $functionToCall->breakOut();
            echo 'Function Call Successful\n';
            break;
    }
}
?>
