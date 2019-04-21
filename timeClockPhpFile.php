<?php

session_start();

if (isset($_POST) && !empty($_POST)) {
    switch ($_POST) {
        case 'id':
            $_SESSION['id'] = $_POST['id'];
            break;
        case 'clockInTime':
            $_SESSION['clockInTime'] = $_POST['clockInTime'];
            break;
        case 'clockInDate':
            $_SESSION['clockInDate'] = $_POST['clockInDate'];
            break;
        case 'clockIn':
            $_SESSION['clockIn'] = $_POST['clockIn'];
            break;
        case 'clockOutTime':
            $_SESSION['clockOutTime'] = $_POST['clockOutTime'];
            break;
        case 'clockOutDate':
            $_SESSION['clockOutDate'] = $_POST['clockOutDate'];
            break;
        case 'clockOut':
            $_SESSION['clockOut'] = $_POST['clockOut'];
            break;
        case 'breakInTime':
            $_SESSION['breakInTime'] = $_POST['breakInTime'];
            break;
        case 'breakOutTime':
            $_SESSION['breakOutTime'] = $_POST['breakOutTime'];
            break;
        case 'breakTime':
            $_SESSION['breakTime'];
            break;
        case 'status':
            $_SESSION['status'] = $_POST['status'];
            break;
        default:
            print_r($_POST);
            break;
    }
}

class TimeClock {

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "mydb";

    public function dataSort($data) {
        $obj = json_decode($data);
        $this->time = $obj->time;
        $this->hours = $obj->hours;
        $this->minutes = $obj->minutes;
    }

    public function checkLogin() {
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            
            $userID = $_SESSION['id'];

            $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $sql = "Select * from employees where EmployeeID = $userID";
                $result = $conn->query($sql);

                if ($result->num_rows == 0) {
                    header("Location: http://localhost/TimeClock/index.php");
                    echo 'Error';
                } else {
                    $_SESSION['status'] = true;
                    header("Location: http://localhost/TimeClock/homepage.php");
                    echo 'Error';
                }

                $conn->close();
            }
        } else {
            echo "Session userID not set.";
        }
    }

    public function clockIn() {
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            
            $userID = $_SESSION['id'];
            $clockInTimeObj = $this->dataSort($_SESSION['clockInTime']);         
            $_SESSION['clockIn'] = $clockInTimeObj;
            $clockInDate = $_SESSION['clockInDate'];

            if ($_SESSION['status'] == true) {

                $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    $sql = "INSERT INTO times (UserID, Status, Date, Time) VALUES ('$userID', 'Clocked In', '$clockInDate', '$clockInTimeObj->hours');";
                    if ($conn->query($sql) == true) {
                        echo "Data added successfully\n";
                        var_dump($clockInTimeObj);
                        print_r($_SESSION);
                    } else {
                        echo "Error adding data: " . $sql . "<br>" . $conn->error;
                    }
                    $conn->close();
                }
            }
        }
    }

    public function clockOut() {

        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            
            $userID = $_SESSION['id'];
            $clockOut = $this->dataSort($SESSION['clockOutTime']);
            $clockOutDate = $_SESSION['clockOutDate'];
            $clockIn = $_SESSION['clockIn'];
            $hours = 0;            
            $minutes = 0;

            if ($clockOut->hours < $clockIn->hours) {
                $hours = (12 - $clockIn->hours) + ($clockOut->hours - 1);
                $hours = $hours * 60;
            } else {
                $hours = $clockOut->hours - $clockIn->hours;
                $hours = $hours * 60;
            }

            if ($clockOut->minutes < $clockIn->minutes) {
                $minutes = $clockOut->minutes + (60 - $clockIn->minutes);
            } else {
                $minutes = $clockOut->minutes - $clockIn->minutes;
            }

            $hours = $hours + $minutes;
            $hoursWithBreak = ($hours - $breakTime) / 60;

            if ($status == true) {
                $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO times (UserID, Status, Date, Time, Hours) VALUES ('$userID', 'Clocked Out', '$clockOutDate', '$clockOut->time', '$hoursWithBreak');";

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
        $breakIn = $_SESSION['breakInTime'];
        $breakIn = new $this->dataSort($breakInTime);
        $breakOut = new $this->dataSort($breakOutTime);

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
    }

    public function breakOut() {
        $_SESSION['breakOutTime'] = $_POST['breakOutTime'];
    }
}

if (isset($_POST['callbackFunction']) && !empty($_POST['callbackFunction'])) {
    switch ($_POST['callbackFunction']) {
        case 'clockIn':
            $returnFunction = new TimeClock();
            $returnFunction = $returnFunction->clockIn();
            echo 'Function Call Successful\n';
            break;
        case 'clockOut':
            $returnFunction = new TimeClock();
            $returnFunction = $returnFunction->clockOut();
            echo 'Function Call Successful\n';
            break;
        case 'breakIn':
            $returnFunction = new TimeClock();
            $returnFunction = $returnFunction->breakIn();
            echo 'Function Call Successful\n';
            break;
        case 'breakOut':
            $returnFunction = new TimeClock();
            $returnFunction = $returnFunction->breakOut();
            echo 'Function Call Successful\n';
            break;
    }
}
?>
