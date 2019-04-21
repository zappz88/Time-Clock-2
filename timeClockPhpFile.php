<?php

session_start();

if (isset($_POST) && !empty($_POST)) {
    switch ($_POST) {
        case filter_has_var(INPUT_POST, 'id'):
            $_SESSION['id'] = $_POST['id'];
            break;
        case filter_has_var(INPUT_POST, 'clockInTime'):
            $_SESSION['clockInTime'] = $_POST['clockInTime'];
            break;
        case filter_has_var(INPUT_POST, 'clockInDate'):
            $_SESSION['clockInDate'] = $_POST['clockInDate'];
            break;
        case filter_has_var(INPUT_POST, 'clockOutTime'):
            $_SESSION['clockOutTime'] = $_POST['clockOutTime'];
            break;
        case filter_has_var(INPUT_POST, 'clockOutDate'):
            $_SESSION['clockOutDate'] = $_POST['clockOutDate'];
            break;
        case filter_has_var(INPUT_POST, 'breakInTime'):
            $_SESSION['breakInTime'] = $_POST['breakInTime'];
            break;
        case filter_has_var(INPUT_POST, 'breakOutTime'):
            $_SESSION['breakOutTime'] = $_POST['breakOutTime'];
            break;
        default:
            print_r($_POST);
            break;
    }
}

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'mydb';

if (isset($_POST['id']) && !empty($_POST['id'])) {

    $userID = $_POST['id'];

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $sql = "Select * from employees where EmployeeID = $userID";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            header("Location: http://localhost/TimeClock/index.php");
            echo 'Error';
        } else {
            $_SESSION['status'] = true;
            header("Location: http://localhost/TimeClock/homepage.php");
        }

        $conn->close();
    }
}

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
            $clockInDate = $_POST['clockInDate'];

            if ($_SESSION['status'] == true) {

                $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    $sql = "INSERT INTO times (UserID, Status, Date, Time) VALUES ('$userID', 'Clocked In', '$clockInDate', '$clockInTimeObj->hours');";
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
        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
            $userID = $_SESSION['id'];
            $status = $_SESSION{'status'};
            $clockOutTimeObj = json_decode($_SESSION['clockOutTime']);
            $_SESSION['clockOut'] = $clockOutTimeObj;
            $clockOutDate = $_POST['clockOutDate'];
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

                $sql = "INSERT INTO times (UserID, Status, Date, Time, Hours) VALUES ('$userID', 'Clocked Out', '$clockOutDate', '$clockOutTimeObj->time', '$hours');";

                if ($conn->query($sql) == true) {
                    $_SESSION['status'] = false;
                } else {
                    echo "Error adding data: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
            }
        }
        print_r($_SESSION);
    }

    public function breakIn() {
        $breakInTime = $_SESSION['breakInTime'];
        $breakInTimeObj = json_decode($breakInTime);
        $breakOutTime = $_SESSION['breakOutTime'];
        $breakOutTimeObj = json_decode($breakOutTime);

        $hours = 0;
        $minutes = 0;

        if ($breakOutTime) {
            if ($breakInTimeObj->hours < $breakOutTimeObj->hours) {
                $hours = (12 - $breakOutTimeObj->hours) + ($breakInTimeObj->hours - 1);
                $hours = $hours * 60;
            } 
            else {
                $hours = $breakInTimeObj->hours - $breakOutTimeObj->hours;
                $hours = $hours * 60;
            }
            if ($breakInTimeObj->minutes < $breakOutTimeObj->minutes) {
                $minutes = $breakInTimeObj->minutes + (60 - $breakOutTimeObj->minutes);
            } 
            else {
                $minutes = $breakInTimeObj->minutes - $breakOutTimeObj->minutes;
            }
        }

        $hours = ($hours + $minutes) / 60;
        $_SESSION['breakTime'] = $hours;
    }

    public function breakOut() {
        $_SESSION['breakOutTime'] = $_POST['breakOutTime'];
    }

}

if (isset($_POST['functionToCall']) && !empty($_POST['functionToCall'])) {
    switch ($_POST['functionToCall']) {
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
