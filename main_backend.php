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
                    echo "\nInsert Error: " . $conn->error;
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
    if ("alter" == $_POST['a']) {

        $Date = date('DdMY') . $_POST['pr'];
        $tname = $_POST['tname'];
        // $tname = preg_replace("/[^A-Z0-9]/", "", $tname);
        if (isset($Date) && (strlen($tname) > 11 && strlen($tname) < 15) && strlen($_POST['pr']) == 2) {
            echo "success";
            //$conn = new  mysqli($servername, $username, $password,$dbname);
            $alt = " ALTER TABLE {$tname} ADD COLUMN IF NOT EXISTS {$Date} VARCHAR(20) DEFAULT 'N' ";
// default value N= null is given to handle the situation : after entered all names in attendance and took attendance yestaday and today now a new student joined ,when entering his name in register it is entered due to column is already created with no default value so we set default to N ,now it is entered with N and we do attendance once for him
            if ($conn->query($alt) === FALSE) {
                echo "Alter Table-Error : " . $conn->error;
            }

        }
        else {
            echo "Alter Table Failed";
        }

    } //alt if
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
    if ("update" == $_POST['a']) {
         $Arr = $_POST['Arr'];
        $cname = date('DdMY') . $_POST['pr'];
        if ($_POST['tname'] && $_POST['pr']) {
            $tname = $_POST['tname'];
            $user = $_SESSION['attusername'];
            $upd = "UPDATE {$tname} SET {$cname}= '{$user}' WHERE Name ='Staff' AND RegisterNumber='1' ";
            if ($conn->query($upd) === FALSE) {
                echo "<br>Update-Error : ";
                // echo $conn->error;
                
            }
            foreach ($Arr as $Ar) {
                 $n = $Ar[0];
                 $r = $Ar[1];
                 $v = $Ar[2];  //todo : clear error here
                $upd = "UPDATE {$tname} SET {$cname}= '{$v}' WHERE Name ='{$n}' AND RegisterNumber={$r} ";
                if ($conn->query($upd) === FALSE) {
                    echo "\nUpdate-Error : ";
                    // echo $conn->error;
                    
                } //if
                
            } //for
            echo "Submitted";
        } //if
        
    } // update if

    if(isset($_POST['otpnum'])){

    if ("subst" == $_POST['a'] & isset($_POST['otpnum'])) {
        $n = trim($_POST['otpnum']);
        $user = $_SESSION['attusername'];
        $pass = $_SESSION['attpassword'];
        $upd = "UPDATE Staff SET otp= '{$n}' WHERE username='{$user}' AND password='{$pass}' ";
        if ($conn->query($upd) === FALSE) {
            echo "<br>Subst-Error : " . $conn->error;
        }
        else {
            echo "Done";
        }
    } //subst
    
}

if(isset($_POST['otp'])){
    if ("subfor" == $_POST['a'] & 5 < strlen($_POST['pr']) & isset($_POST['otp'])) {

        if ("0" == $_POST['otp'] | 6 < strlen($_POST['otp']) | 4 > strlen($_POST['otp'])) {
            die(" #");
        }
        $o = $_POST['otp'];
        $p = $_POST['pr'];
        $sql = "SELECT {$p} FROM Staff WHERE otp='{$o}' ";
        $result = $conn->query($sql);
        if ($result === FALSE) {
            echo "<br>Select-Error : " . $conn->error;
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<button class="form-control-plaintext" type="submit" name="submit" value="' . $row["$p"] . '">' . $row["$p"] . '</button></li>';
        }
        else {
            echo "<center>Access Not Available</center>";
        }

    } // subfor if
}


    if ("otphad" == $_POST['a']) {
        $user = $_SESSION['attusername'];
        $pass = $_SESSION['attpassword'];
        $upd = "SELECT otp FROM Staff WHERE username='{$user}' AND password='{$pass}' ";
        $result = $conn->query($upd);
        if ($result === FALSE) {
            echo "<br>Sub-Error : " . $conn->error;
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row["otp"] !== "0") {
                echo '<span id="otp">' . $row["otp"] . '</span>   <i id="delotp" class="material-icons">delete_sweep</i>';
            }
            else {
                echo "Access Not Given";
            }
        }
    } //otphad


    if ("delotp" == $_POST['a']) {
        $user = $_SESSION['attusername'];
        $pass = $_SESSION['attpassword'];
        $sql = "UPDATE Staff SET otp='NULL' WHERE username='{$user}' AND password='{$pass}' ";
        $conn->query($sql);
    } // del if

    /*
    if("swap"==$_POST['a']){
    if($_POST['name']&&$_POST['tname']){
    $n = $_POST['name'];
    $tname = $_POST['tname'];
    $upd="UPDATE Staff SET accessfrom= '{$tname}' WHERE username ='{$n}' ";
    if ($conn->query($upd) ===FALSE) {
    echo "<br>Swap-Error : " .$conn->error;
    }else{
    $user=$_SESSION['attusername'];
    $pass=$_SESSION['attpassword'];
    $upd="UPDATE Staff SET accessto= '{$n}' WHERE username='{$user}' AND password='{$pass}' ";
    if ($conn->query($upd)===FALSE) {
    echo "<br>Access_to-Error : " .$conn->error;
    }
    echo "Allowed"; }
    }
    }// swap if
    
    if("swapped"==$_POST['a']){
    $user=$_SESSION['attusername'];
    $pass=$_SESSION['attpassword'];
    $sql = "SELECT accessfrom FROM Staff WHERE username='{$user}' AND password='{$pass}' ";
    $result = $conn->query($sql);
    if ($result ===FALSE) {
    echo "<br>Select-Error : " .$conn->error;
    }
    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tname=$row["accessfrom"];
    if($tname!=="NULL" && $tname!=="Timeout"){
    echo '<button class="form-control-plaintext" type="submit" name="submit" value="'.$tname.'">'.$tname.'</button></li>';
    }else{ echo "<center>Access Not Available</center>";}
    }
    }// swapped if
    
    if("acto"==$_POST['a']){
    $user=$_SESSION['attusername'];
    $pass=$_SESSION['attpassword'];
    $sql = "SELECT accessto FROM Staff WHERE username='{$user}' AND password='{$pass}' ";
    $result = $conn->query($sql);
    if ($result ===FALSE) {
    echo "<br>Select-Error : " .$conn->error;
    }
    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $un=$row["accessto"];
    if($un!=="NULL"){
    echo '<span id="unm">'.$un.'</span>   <i id="delacs" class="material-icons">delete_sweep</i>
    ';
    }else{ echo "Access Not Given";}
    }
    }// acto if
    
    if("delacs"==$_POST['a']){
    $unm=$_POST['unm'];
    $user=$_SESSION['attusername'];
    $pass=$_SESSION['attpassword'];
    $sql = "UPDATE Staff SET accessto='NULL' WHERE username='{$user}' AND password='{$pass}' ";
    $conn->query($sql);
    $sql = "UPDATE Staff SET accessfrom='NULL' WHERE username='{$unm}' ";
    $conn->query($sql);
    
    }// del if
    */

    if ("redo1" == $_POST['a']) {
        $user = $_SESSION['attusername'];
        $pass = $_SESSION['attpassword'];
        //$day= date('D');
        if ("Timeout" == $_POST['pr']) {
            $_POST['pr'] = 9;
        }
        $pr = preg_replace("/[^0-9]/", "", $_POST['pr']);
        for ($i = 1;$i < $pr;$i++) {
            $period = date('D') . "p" . $i;
            $sql = "SELECT {$period} FROM Staff WHERE username='{$user}' AND password='{$pass}' ";
            $result = $conn->query($sql);
            if ($result == FALSE) {
                echo "<br>Select-Error : " . $conn->error;
            }
            else if ($result->num_rows > 0) {
                $row = $result->fetch_array();
                echo '<button class="rework m-1 btn btn-outline-secondary">' . $row[0] . '</button>';
            }
        } //for
        
    } // redo if
    if ("redo2" == $_POST['a']) {
        $tname = $_POST['tname'];
        $sql = "SELECT Name,RegisterNumber FROM {$tname} WHERE RegisterNumber!='1' ";
        $result = $conn->query($sql);
        if ($result == FALSE) {
            echo "<br>Select-Error : " . $conn->error;
        }
        else if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "\n";
                //make align one by one in portrait and float right in landscape mode
                echo '<div class="d-inline-flex p-2 mw" >';
                echo ' <div class="chip border" name="' . $row["Name"] . '"  reg="' . $row["RegisterNumber"] . ' "> ';
                echo '<i class="material-icons od">person</i>';
                echo $row["Name"];
                echo '</div>';
                echo '</div>';
               // echo '<br><button id="sj2" class="btn btn-lg btn-block" btntype="submit">Submit</button>';
            } //wh
             echo '<br><button id="sj2" class="btn btn-lg btn-block" btntype="submit">Submit</button>';
        } //if
        
    } // redo if
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
