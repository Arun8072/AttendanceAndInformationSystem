<?php

//TODO: create a page which has buttons to
/*1:create database
2:create table ,regno , name 
after display each buttons with table names 
3:when clicking the button it sends table name to back end 
which create columns for today with 8 peroids 
display each peroids buttons with column name
4: when clicking the buttons it fills data for that column*/
$name_list = [
    "James",
    "John",
    "Robert",
    "Michael",
    "William",
    "David",
    "Richard",
    "Charles",
    "Joseph",
    "Thomas",
    "Christopher",
    "Daniel",
    "Paul",
    "Mark",
    "Donald",
    "George",
    "Kenneth",
    "Steven",
    "Edward",
    "Brian",
    "Ronald",
    "Anthony",
    "Kevin",
    "Jason",
    "Matthew",
    "Mary",
    "Patricia",
    "Linda",
    "Barbara",
    "Elizabeth",
    "Jennifer",
    "Maria",
    "Susan",
    "Margaret",
    "Dorothy",
    "Lisa",
    "Nancy",
    "Karen",
    "Betty",
    "Helen",
    "Sandra",
    "Donna",
    "Carol",
    "Ruth",
    "Sharon",
    "Michelle",
    "Laura",
    "Sarah",
    "Patrick",
    "Peter",
    "Harold",
    "Douglas",
    "Henry",
    "Carl",
    "Arthur",
    "Ryan",
    "Roger",
    "Joe",
    "Juan",
    "Jack",
    "Albert",
    "Jonathan",
    "Justin",
    "Terry",
    "Gerald",
    "Keith",
    "Samuel",
    "Willie",
    "Ralph",
    "Lawrence",
    "Nicholas",
    "Gary",
    "Timothy",
    "Jose",
    "Larry",
    "Jeffrey",
    "Frank",
    "Scott",
    "Eric",
    "Stephen",
    "Andrew",
    "Raymond",
    "Gregory",
    "Joshua",
    "Jerry",
    "Dennis",
    "Walter",
    "Kimberly",
    "Deborah",
    "Jessica",
    "Shirley",
    "Cynthia",
    "Angela",
    "Melissa",
    "Brenda",
    "Amy",
    "Anna",
    "Rebecca",
    "Virginia",
    "Kathleen",
    "Pamela",
    "Martha",
    "Debra",
    "Amanda",
    "Stephanie",
    "Carolyn",
    "Christine",
    "Marie",
    "Janet",
    "Catherine",
    "Frances",
    "Ann",
    "Joyce",
    "Diane",
    "Alice",
    "Julie",
    "Heather",
    "Teresa",
    "Doris",
    "Gloria",
    "Evelyn",
    "Jean",
    "Cheryl",
    "Mildred",
    "Katherine",
];

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

$ug_duration = 4;
$pg_duration = 2;
$semesterDuration = 06;

if (date("m") >= $semesterDuration) {
    //current year in semester
    $currentYear = date("Y");
} else {
    //for final semester
    $currentYear = date("Y") - 1;
}
//UG
// clg year=current year - final year
$allYear[0] = $fi = $currentYear . ($currentYear + $ug_duration);
$allYear[1] = $tw = $currentYear - 1 . ($currentYear - 1 + $ug_duration);
$allYear[2] = $th = $currentYear - 2 . ($currentYear - 2 + $ug_duration);
$allYear[3] = $fo = $currentYear - 3 . ($currentYear - 3 + $ug_duration);

$depart = ["cse", "ece", "eee", "mech", "civil"];
$section = ["a", "b"];

$clgcode = "6201";
$departCode = ["104", "106", "113", "110", "102"];
$value = ["P", "A", "O"];

$rollnum_length = 3;
$loopvar6 = 0;

//for table ,regnum , name insertion
if (isset($_GET["insert"]) && $_GET["insert"] == "tables") {
    //for year
    for ($loopvar1 = 0; $loopvar1 < count($allYear); $loopvar1++) {
        //for department
        for ($loopvar2 = 0; $loopvar2 < count($depart); $loopvar2++) {
            //for section
            for ($loopvar3 = 0; $loopvar3 < count($section); $loopvar3++) {
                $tname =
                    $allYear[$loopvar1] .
                    $depart[$loopvar2] .
                    $section[$loopvar3];

                //for teacher timetable entry
                $data[$loopvar6] = $tname;
                $loopvar6++;
                if ($loopvar6 < 10) {
                    //total table names are 40 but to fill the timetable till 8 needed so here it is for extra filling for time table
                    $data[$loopvar6 + 39] = $tname;
                }

                // sql to create table
                $sqlt = "CREATE TABLE IF NOT EXISTS {$tname} (RegisterNumber VARCHAR(12) NOT NULL UNIQUE, Name VARCHAR(30) NOT NULL)";

                if ($conn->query($sqlt) === false) {
                    echo "<br>Error creating table: " . $conn->error;
                } else {
                    $sqlt = "INSERT INTO {$tname} (RegisterNumber,Name)VALUES ('1','Staff') ";

                    if ($conn->query($sqlt) === false) {
                        echo "\nInsert Error: " . $conn->error;
                    }
                }

                // $sqlt = "INSERT INTO {$tname} (RegisterNumber,Name)VALUES ('$reg','$Name') ";
                // prepare and bind
                $stmt = $conn->prepare(
                    "INSERT INTO {$tname} (RegisterNumber,Name) VALUES (?, ?)"
                );
                $stmt->bind_param("is", $regnum, $Name);

                //to follow roll number for class a to b
                //for more query execution time only 40 per class
                if ($loopvar3 == 0) {
                    $regStart = 1;
                    $regEnd = 40;
                } elseif ($loopvar3 == 1) {
                    $regStart = 41;
                    $regEnd = 80;
                }
                $loopvar5 = 0; //for names
                for ($loopvar4 = $regStart; $loopvar4 <= $regEnd; $loopvar4++) {
                    // Left padding if number < $str_length
                    $rollNum = substr("0000{$loopvar4}", -$rollnum_length);

                    $regYear = preg_split(
                        "//",
                        $allYear[$loopvar1],
                        -1,
                        PREG_SPLIT_NO_EMPTY
                    );
                    $regYear = implode(array_slice($regYear, 2, 2));

                    // set parameters and execute
                    $regnum =
                        $clgcode . $regYear . $departCode[$loopvar2] . $rollNum;
                    $Name = $name_list[$loopvar5];

                    $loopvar5++;
                    //echo $regnum."".$name."<br>";

                    if ($stmt->execute() === false) {
                        echo "\nInsert Error: " . $conn->error;
                    } else {
                        echo "\n New records inserted successfully";
                    }
                } //for loopvar4
            } //for loopvar3
        } //for loopvar2
    } //for loopvar1

    // for first teacher entry
    $us = preg_replace("/[^a-zA-Z0-9.\s]/", "", "Deepan");
    $ps = MD5(strval(trim("Deepan@123")));
    $mp1 = strtoupper($data[0]);
    $mp2 = strtoupper($data[1]);
    $mp3 = strtoupper($data[2]);
    $mp4 = strtoupper($data[3]);
    $mp5 = strtoupper($data[4]);
    $mp6 = strtoupper($data[5]);
    $mp7 = strtoupper($data[6]);
    $mp8 = strtoupper($data[7]);
    $tup1 = strtoupper($data[8]);
    $tup2 = strtoupper($data[9]);
    $tup3 = strtoupper($data[10]);
    $tup4 = strtoupper($data[11]);
    $tup5 = strtoupper($data[12]);
    $tup6 = strtoupper($data[13]);
    $tup7 = strtoupper($data[14]);
    $tup8 = strtoupper($data[15]);
    $wp1 = strtoupper($data[16]);
    $wp2 = strtoupper($data[17]);
    $wp3 = strtoupper($data[18]);
    $wp4 = strtoupper($data[19]);
    $wp5 = strtoupper($data[20]);
    $wp6 = strtoupper($data[21]);
    $wp7 = strtoupper($data[22]);
    $wp8 = strtoupper($data[23]);
    $tp1 = strtoupper($data[24]);
    $tp2 = strtoupper($data[25]);
    $tp3 = strtoupper($data[26]);
    $tp4 = strtoupper($data[27]);
    $tp5 = strtoupper($data[28]);
    $tp6 = strtoupper($data[29]);
    $tp7 = strtoupper($data[30]);
    $tp8 = strtoupper($data[31]);
    $fp1 = strtoupper($data[32]);
    $fp2 = strtoupper($data[33]);
    $fp3 = strtoupper($data[34]);
    $fp4 = strtoupper($data[35]);
    $fp5 = strtoupper($data[36]);
    $fp6 = strtoupper($data[37]);
    $fp7 = strtoupper($data[38]);
    $fp8 = strtoupper($data[39]);
    $sp1 = strtoupper($data[40]);
    $sp2 = strtoupper($data[41]);
    $sp3 = strtoupper($data[42]);
    $sp4 = strtoupper($data[43]);
    $sp5 = strtoupper($data[44]);
    $sp6 = strtoupper($data[45]);
    $sp7 = strtoupper($data[46]);
    $sp8 = strtoupper($data[47]);

    $sql =
        "CREATE TABLE IF NOT EXISTS Staff (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,username VARCHAR(20) NOT NULL UNIQUE, password VARCHAR(35) NOT NULL UNIQUE,Monp1 VARCHAR(14),Monp2 VARCHAR(14),Monp3 VARCHAR(14),Monp4 VARCHAR(14),Monp5 VARCHAR(14),Monp6 VARCHAR(14),Monp7 VARCHAR(14),Monp8 VARCHAR(14),Tuep1 VARCHAR(14),Tuep2 VARCHAR(14),Tuep3 VARCHAR(14),Tuep4 VARCHAR(14),Tuep5 VARCHAR(14),Tuep6 VARCHAR(14),Tuep7 VARCHAR(14),Tuep8 VARCHAR(14),Wedp1 VARCHAR(14),Wedp2 VARCHAR(14),Wedp3 VARCHAR(14),Wedp4 VARCHAR(14),Wedp5 VARCHAR(14),Wedp6 VARCHAR(14),Wedp7 VARCHAR(14),Wedp8 VARCHAR(14),Thup1 VARCHAR(14),Thup2 VARCHAR(14),Thup3 VARCHAR(14),Thup4 VARCHAR(14),Thup5 VARCHAR(14),Thup6 VARCHAR(14),Thup7 VARCHAR(14),Thup8 VARCHAR(14),Frip1 VARCHAR(14),Frip2 VARCHAR(14),Frip3 VARCHAR(14),Frip4 VARCHAR(14),Frip5 VARCHAR(14),Frip6 VARCHAR(14),Frip7 VARCHAR(14),Frip8 VARCHAR(14),Satp1 VARCHAR(14),Satp2 VARCHAR(14),Satp3 VARCHAR(14),Satp4 VARCHAR(14),Satp5 VARCHAR(14),Satp6 VARCHAR(14),Satp7 VARCHAR(14),Satp8 VARCHAR(14),accessto VARCHAR(20) NULL DEFAULT NULL,accessfrom VARCHAR(12) NULL DEFAULT NULL,otp VARCHAR(12) NULL DEFAULT NULL) ";
    if ($conn->query($sql) === false) {
        echo "<br>Error creating table: " . $conn->error;
    }
    $sqlt = $conn->prepare(
        "INSERT INTO Staff (username,password,Monp1,Monp2,Monp3,Monp4,Monp5,Monp6,Monp7,Monp8,Tuep1,Tuep2,Tuep3,Tuep4,Tuep5,Tuep6,Tuep7,Tuep8,Wedp1,Wedp2,Wedp3,Wedp4,Wedp5,Wedp6,Wedp7,Wedp8,Thup1,Thup2,Thup3,Thup4,Thup5,Thup6,Thup7,Thup8,Frip1,Frip2,Frip3,Frip4,Frip5,Frip6,Frip7,Frip8,Satp1,Satp2,Satp3,Satp4,Satp5,Satp6,Satp7,Satp8) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"
    );

    $sqlt->bind_param(
        "ssssssssssssssssssssssssssssssssssssssssssssssssss",
        $us,
        $ps,
        $mp1,
        $mp2,
        $mp3,
        $mp4,
        $mp5,
        $mp6,
        $mp7,
        $mp8,
        $tup1,
        $tup2,
        $tup3,
        $tup4,
        $tup5,
        $tup6,
        $tup7,
        $tup8,
        $wp1,
        $wp2,
        $wp3,
        $wp4,
        $wp5,
        $wp6,
        $wp7,
        $wp8,
        $tp1,
        $tp2,
        $tp3,
        $tp4,
        $tp5,
        $tp6,
        $tp7,
        $tp8,
        $fp1,
        $fp2,
        $fp3,
        $fp4,
        $fp5,
        $fp6,
        $fp7,
        $fp8,
        $sp1,
        $sp2,
        $sp3,
        $sp4,
        $sp5,
        $sp6,
        $sp7,
        $sp8
    );
    if ($sqlt->execute()) {
        echo "\n New records  for teacher 1 created successfully";
    } else {
        echo "\n Something Went Wrong , Please Try Again/Later \n";
        echo $sqlt->error;
    }

    // for teacher 2 entry
    $us = preg_replace("/[^a-zA-Z0-9.\s]/", "", "Priya");
    $ps = MD5(strval(trim("Priya@123")));
    $sqlt->bind_param(
        "ssssssssssssssssssssssssssssssssssssssssssssssssss",
        $us,
        $ps,
        $sp1,
        $sp2,
        $sp3,
        $sp4,
        $sp5,
        $sp6,
        $sp7,
        $sp8,
        $fp1,
        $fp2,
        $fp3,
        $fp4,
        $fp5,
        $fp6,
        $fp7,
        $fp8,
        $tp1,
        $tp2,
        $tp3,
        $tp4,
        $tp5,
        $tp6,
        $tp7,
        $tp8,
        $wp1,
        $wp2,
        $wp3,
        $wp4,
        $wp5,
        $wp6,
        $wp7,
        $wp8,
        $tup1,
        $tup2,
        $tup3,
        $tup4,
        $tup5,
        $tup6,
        $tup7,
        $tup8,
        $mp1,
        $mp2,
        $mp3,
        $mp4,
        $mp5,
        $mp6,
        $mp7,
        $mp8
    );
    if ($sqlt->execute()) {
        echo "\n New records for teacher 2 created successfully";
    } else {
        echo "\n Something Went Wrong , Please Try Again/Later \n";
        echo $sqlt->error;
    }

    $sqlt->close();
}

///////////////////////////////////////////////////////////////////////////////////////////////
//add column for current day with 8 peroids for given years

//add new column
if (isset($_GET["year"])) {
    //echo $_GET['tname'];
    $date = date("DdMY");
    $total_periods = 8;

    //for department
    for ($loopvar9 = 0; $loopvar9 < sizeof($depart); $loopvar9++) {
        //for section
        for ($loopvar10 = 0; $loopvar10 < sizeof($section); $loopvar10++) {
            $table_name =
                $_GET["year"] . $depart[$loopvar9] . $section[$loopvar10];
            echo "<br>$table_name";

            //for 8period
            for ($loopvar8 = 1; $loopvar8 <= $total_periods; $loopvar8++) {
                $column_name[$loopvar8] = $date . "p" . $loopvar8;
                echo "<br>{$column_name[$loopvar8]}";

                //$alt = " ALTER TABLE {$tname} ADD COLUMN IF NOT EXISTS {$column_name[$i]} VARCHAR(20) DEFAULT 'N' ";
                $alt = " ALTER TABLE {$table_name} ADD COLUMN IF NOT EXISTS {$column_name[$loopvar8]} VARCHAR(20) DEFAULT 'N' ";

                if ($conn->query($alt) === false) {
                    echo "<br>Error altering table: " . $conn->error;
                }

                //}// post alter
                //for staff name
                $staff_name = ["Deepan", "Priya"];
                $staff = $staff_name[rand(0, sizeof($staff_name) - 1)];
                $upd = "UPDATE {$table_name} SET {$column_name[$loopvar8]}= '{$staff}' WHERE Name ='Staff' AND RegisterNumber='1' ";
                if ($conn->query($upd) === false) {
                    echo "<br>Error updating table: " . $conn->error;
                } else {
                    echo "<br>staff name $staff updated";
                }

                //if (isset($_POST['addColumn'])  && $_POST['addColumn']=="update"){
                //for b section roll number
                if ($loopvar10 == 0) {
                    $regStart = 1;
                    $regEnd = 40;
                } elseif ($loopvar10 == 1) {
                    $regStart = 41;
                    $regEnd = 80;
                }

                for ($loopvar4 = $regStart; $loopvar4 <= $regEnd; $loopvar4++) {
                    // Left padding if number < $str_length
                    $rollNum = substr("0000{$loopvar4}", -$rollnum_length);

                    $regYear = preg_split(
                        "//",
                        $_GET["year"],
                        -1,
                        PREG_SPLIT_NO_EMPTY
                    );
                    $regYear = implode(array_slice($regYear, 2, 2));

                    // set parameters and execute
                    $regnum =
                        $clgcode . $regYear . $departCode[$loopvar9] . $rollNum;

                    $value_i = rand(0, 2);
                    $upd = "UPDATE {$table_name} SET {$column_name[$loopvar8]}= '{$value[$value_i]}' WHERE RegisterNumber={$regnum} ";
                    if ($conn->query($upd) === false) {
                        echo "<br>Error updating table: " . $conn->error;
                    } else {
                        echo "<br>{$regnum} record updated";
                    }
                } //for loopvar4
            } //for loopvar8
        } //for loop10
    } //for loop9
} //get tname
//}//post update

$conn->close();

?>
