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


    if ("user" == $_POST['au']) {

        $id = intval($_POST['unqid']);
        $uid = intval("620117104010");
        if ($id !== $uid) {
            exit("Invalid Unique password");
            die();
        }
        $data = json_decode($_POST['prd']);
        $us = preg_replace("/[^a-zA-Z0-9.\s]/", "", $data[0]);
        $ps = MD5(strval(trim($data[1])));
        $data = preg_replace("/[^a-zA-Z0-9]/", "", $data);
        $mp1 = strtoupper($data[2]);
        $mp2 = strtoupper($data[3]);
        $mp3 = strtoupper($data[4]);
        $mp4 = strtoupper($data[5]);
        $mp5 = strtoupper($data[6]);
        $mp6 = strtoupper($data[7]);
        $mp7 = strtoupper($data[8]);
        $mp8 = strtoupper($data[9]);
        $tup1 = strtoupper($data[10]);
        $tup2 = strtoupper($data[11]);
        $tup3 = strtoupper($data[12]);
        $tup4 = strtoupper($data[13]);
        $tup5 = strtoupper($data[14]);
        $tup6 = strtoupper($data[15]);
        $tup7 = strtoupper($data[16]);
        $tup8 = strtoupper($data[17]);
        $wp1 = strtoupper($data[18]);
        $wp2 = strtoupper($data[19]);
        $wp3 = strtoupper($data[20]);
        $wp4 = strtoupper($data[21]);
        $wp5 = strtoupper($data[22]);
        $wp6 = strtoupper($data[23]);
        $wp7 = strtoupper($data[24]);
        $wp8 = strtoupper($data[25]);
        $tp1 = strtoupper($data[26]);
        $tp2 = strtoupper($data[27]);
        $tp3 = strtoupper($data[28]);
        $tp4 = strtoupper($data[29]);
        $tp5 = strtoupper($data[30]);
        $tp6 = strtoupper($data[31]);
        $tp7 = strtoupper($data[32]);
        $tp8 = strtoupper($data[33]);
        $fp1 = strtoupper($data[34]);
        $fp2 = strtoupper($data[35]);
        $fp3 = strtoupper($data[36]);
        $fp4 = strtoupper($data[37]);
        $fp5 = strtoupper($data[38]);
        $fp6 = strtoupper($data[39]);
        $fp7 = strtoupper($data[40]);
        $fp8 = strtoupper($data[41]);
        $sp1 = strtoupper($data[42]);
        $sp2 = strtoupper($data[43]);
        $sp3 = strtoupper($data[44]);
        $sp4 = strtoupper($data[45]);
        $sp5 = strtoupper($data[46]);
        $sp6 = strtoupper($data[47]);
        $sp7 = strtoupper($data[48]);
        $sp8 = strtoupper($data[49]);

        if ("ucreate" == $_POST['ar']) {
            $sql = "CREATE TABLE IF NOT EXISTS Staff (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,username VARCHAR(20) NOT NULL UNIQUE, password VARCHAR(35) NOT NULL UNIQUE,Monp1 VARCHAR(14),Monp2 VARCHAR(14),Monp3 VARCHAR(14),Monp4 VARCHAR(14),Monp5 VARCHAR(14),Monp6 VARCHAR(14),Monp7 VARCHAR(14),Monp8 VARCHAR(14),Tuep1 VARCHAR(14),Tuep2 VARCHAR(14),Tuep3 VARCHAR(14),Tuep4 VARCHAR(14),Tuep5 VARCHAR(14),Tuep6 VARCHAR(14),Tuep7 VARCHAR(14),Tuep8 VARCHAR(14),Wedp1 VARCHAR(14),Wedp2 VARCHAR(14),Wedp3 VARCHAR(14),Wedp4 VARCHAR(14),Wedp5 VARCHAR(14),Wedp6 VARCHAR(14),Wedp7 VARCHAR(14),Wedp8 VARCHAR(14),Thup1 VARCHAR(14),Thup2 VARCHAR(14),Thup3 VARCHAR(14),Thup4 VARCHAR(14),Thup5 VARCHAR(14),Thup6 VARCHAR(14),Thup7 VARCHAR(14),Thup8 VARCHAR(14),Frip1 VARCHAR(14),Frip2 VARCHAR(14),Frip3 VARCHAR(14),Frip4 VARCHAR(14),Frip5 VARCHAR(14),Frip6 VARCHAR(14),Frip7 VARCHAR(14),Frip8 VARCHAR(14),Satp1 VARCHAR(14),Satp2 VARCHAR(14),Satp3 VARCHAR(14),Satp4 VARCHAR(14),Satp5 VARCHAR(14),Satp6 VARCHAR(14),Satp7 VARCHAR(14),Satp8 VARCHAR(14),accessto VARCHAR(20) NULL DEFAULT NULL,accessfrom VARCHAR(12) NULL DEFAULT NULL,otp VARCHAR(12) NULL DEFAULT NULL) ";
            if ($conn->query($sql) === FALSE) {
                echo "<br>Error creating table: " . $conn->error;
            }
            $sqlt = $conn->prepare("INSERT INTO Staff (username,password,Monp1,Monp2,Monp3,Monp4,Monp5,Monp6,Monp7,Monp8,Tuep1,Tuep2,Tuep3,Tuep4,Tuep5,Tuep6,Tuep7,Tuep8,Wedp1,Wedp2,Wedp3,Wedp4,Wedp5,Wedp6,Wedp7,Wedp8,Thup1,Thup2,Thup3,Thup4,Thup5,Thup6,Thup7,Thup8,Frip1,Frip2,Frip3,Frip4,Frip5,Frip6,Frip7,Frip8,Satp1,Satp2,Satp3,Satp4,Satp5,Satp6,Satp7,Satp8) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $sqlt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssss", $us, $ps, $mp1, $mp2, $mp3, $mp4, $mp5, $mp6, $mp7, $mp8, $tup1, $tup2, $tup3, $tup4, $tup5, $tup6, $tup7, $tup8, $wp1, $wp2, $wp3, $wp4, $wp5, $wp6, $wp7, $wp8, $tp1, $tp2, $tp3, $tp4, $tp5, $tp6, $tp7, $tp8, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8, $sp1, $sp2, $sp3, $sp4, $sp5, $sp6, $sp7, $sp8);
            if ($sqlt->execute()) {
                echo "New records created successfully";
            }
            else {
                echo "Something Went Wrong , Please Try Again/Later \n";
                echo $sqlt->error;
            }
            $sqlt->close();
        } //crt
        if ("ualter" == $_POST['ar']) {
            $sqlt = $conn->prepare("UPDATE Staff SET Monp1=?,Monp2=?,Monp3=?,Monp4=?,Monp5=?,Monp6=?,Monp7=?,Monp8=?,Tuep1=?,Tuep2=?,Tuep3=?,Tuep4=?,Tuep5=?,Tuep6=?,Tuep7=?,Tuep8=?,Wedp1=?,Wedp2=?,Wedp3=?,Wedp4=?,Wedp5=?,Wedp6=?,Wedp7=?,Wedp8=?,Thup1=?,Thup2=?,Thup3=?,Thup4=?,Thup5=?,Thup6=?,Thup7=?,Thup8=?,Frip1=?,Frip2=?,Frip3=?,Frip4=?,Frip5=?,Frip6=?,Frip7=?,Frip8=?,Satp1=?,Satp2=?,Satp3=?,Satp4=?,Satp5=?,Satp6=?,Satp7=?,Satp8=? WHERE username=? AND password=?");
            $sqlt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssss", $mp1, $mp2, $mp3, $mp4, $mp5, $mp6, $mp7, $mp8, $tup1, $tup2, $tup3, $tup4, $tup5, $tup6, $tup7, $tup8, $wp1, $wp2, $wp3, $wp4, $wp5, $wp6, $wp7, $wp8, $tp1, $tp2, $tp3, $tp4, $tp5, $tp6, $tp7, $tp8, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8, $sp1, $sp2, $sp3, $sp4, $sp5, $sp6, $sp7, $sp8, $us, $ps);
            if ($sqlt->execute()) {
                echo "Records updated successfully";
            }
            else {
                echo "Something Went Wrong , Please Try Again/Later \n";
            }
            $sqlt->close();
        } //alt
        
    } //user if

    
    $conn->close();
} //post

?>
