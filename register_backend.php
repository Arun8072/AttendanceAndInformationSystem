<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //MySQLi Object-oriented(php with mysql) is used in all
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Attendance";
    //first create database in phpmyadmin  so that you can connect here
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<br>Connection failed: " . $conn->connect_error);
    }

    if ("create" == $_POST['a']) {
        $Name = $_POST['Name'];
        $Name = stripslashes($Name);
        $Name = trim($Name); //remove empty space from left and right
        $ZName = htmlspecialchars($Name);
        $Name = strip_tags($ZName);
        $Name = preg_replace('/[^A-Za-z0-9.\s]/', '', $Name);
        if ($ZName !== $Name) {
            //if any tags present in post of name it exit
            die("#_#");
            exit();
        }
        $reg = $_POST['reg'];
        $Sec = $_POST['sec'];
        $batch = $_POST['bs'] . "-" . $_POST['bl'];
        $tname = $batch . $Sec;
        //Strip all characters but letters and numbers from a PHP string
        $tname = preg_replace("/[^A-Z0-9]/", "", $tname);

        if (strlen($Name) > 3 && isset($_POST['reg']) && isset($_POST['sec']) && strlen($reg) == 12 && strlen($_POST['bs']) == 4 || strlen($_POST['bl']) == 4 && strlen($_POST['bs']) < strlen($_POST['bl']) && strlen($batch) == 9) {

            // sql to create table
            $sqlt = "CREATE TABLE IF NOT EXISTS {$tname} (RegisterNumber VARCHAR(12) NOT NULL UNIQUE, Name VARCHAR(30) NOT NULL)";

            if ($conn->query($sqlt) === FALSE) {
                echo "<br>Error creating table: " . $conn->error;
            }
            else {
                $sqlt = "INSERT INTO {$tname} (RegisterNumber,Name)VALUES ('1','Staff') ";
                if ($conn->query($sqlt) === FALSE) {
                    //echo "\nInsert Error: " . $conn->error;
                }
            }

            $sqlt = "INSERT INTO {$tname} (RegisterNumber,Name)VALUES ('$reg','$Name') ";

            if (isset($_POST['Name']) && $conn->query($sqlt) === FALSE) {
                echo "\nInsert Error: " . $conn->error;
            }

        } //post if
        elseif ($_POST['Name'] == "" && $_POST['sec'] == "" && $_POST['reg'] == "") {
            echo "\nNULL VALUES NOT PROCESSED";
        }
        elseif ($_POST['Name'] == "") {

            echo "\nName field is empty";
            echo "\nNULL VALUES NOT PROCESSED";

        }
        elseif ($_POST['sec'] == "") {
            echo "\nDepartment field is not selected";
            echo "\nNULL VALUES NOT PROCESSED";
        }
        elseif ($_POST['reg'] == "") {
            echo "\nRegister number field is not filled";
            echo "\nNULL VALUES NOT PROCESSED";
        }
        elseif (strlen($_POST['bs']) !== 4 || strlen($_POST['bl']) !== 4) {
            echo "\nEnter a valid year ";
        }
        elseif ($_POST['bs'] >= $_POST['bl']) {
            echo "\nLast year should be greater than first year ";
        }
    } //cr if
    
    if ("select" == $_POST['a']) {

        $sec = $_POST['sec'];
        $batch = $_POST['bs'] . "-" . $_POST['bl'];
        $tname = $batch . $sec;
        $tname = preg_replace("/[^A-Z0-9]/", "", $tname);

        if (strlen($tname) > 11 && strlen($tname) < 15) {
            //$Sec= $_POST['dept'];
            $sql = "SELECT RegisterNumber,Name FROM {$tname} ORDER BY RegisterNumber DESC";

            $result = $conn->query($sql);
            if ($conn->query($sql) === FALSE) {
                echo "<br>select-Error : " . $conn->error;
            }
            else if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    if ($row["RegisterNumber"] > 1) {
                        echo "<hr>Name: " . $row["Name"] . "<br>RegNumber: " . $row["RegisterNumber"];
                    } //if
                    
                } //wh
                
            }
            else {
                echo "0 results";
            } //el
            

            
        } //if
        return;
    } //sl if
    
    


    if ("delaccount" == $_POST['a']) {
        $user = $_SESSION['attusername'];
        $pass = $_SESSION['attpassword'];
        $sql = "DELETE FROM Staff WHERE username='{$user}' AND password='{$pass}' ";
        if ($conn->query($sql) == TRUE) {
            if (session_destroy()) {
                header("Location:index.php");
            }
        }
    } // del if

    $conn->close();
} //post

?>
