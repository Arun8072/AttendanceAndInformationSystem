<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
//MySQLi Object-oriented(php with mysql) is used in all
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Attendance";
//first create database in phpmyadmin  so that you can connect here

// Create connection
$conn = new  mysqli($servername, $username, $password,$dbname);

 // Check connection
if ($conn->connect_error) {
   die("<br>Connection failed: "  . $conn->connect_error);
}

if("create"==$_POST['a']){
$Name= $_POST['Name'];
$Name=stripslashes($Name);
$Name=trim($Name);//remove empty space from left and right
$ZName=htmlspecialchars($Name);
$Name=strip_tags($ZName);
$Name = preg_replace('/[^A-Za-z0-9.\s]/', '', $Name);
if($ZName!==$Name){
//if any tags present in post of name it exit
die("#_#");
exit();
}
$reg= $_POST['reg'];
$Sec= $_POST['sec'];
$batch=$_POST['bs']."-".$_POST['bl'];
$tname=$batch.$Sec;
//Strip all characters but letters and numbers from a PHP string
$tname = preg_replace("/[^A-Z0-9]/", "", $tname);

if(strlen($Name) >3 &&  isset($_POST['reg']) && isset($_POST['sec']) && strlen($reg)==12 && strlen($_POST['bs'])==4 || strlen( $_POST['bl'])==4 && strlen($_POST['bs'])<strlen( $_POST['bl']) &&strlen($batch)==9){

// sql to create table
$sqlt = "CREATE TABLE IF NOT EXISTS {$tname} (RegisterNumber VARCHAR(12) NOT NULL UNIQUE, Name VARCHAR(30) NOT NULL)";

if ($conn->query($sqlt) ===FALSE) {
   echo "<br>Error creating table: " . $conn->error;
}else{
$sqlt = "INSERT INTO {$tname} (RegisterNumber,Name)VALUES ('1','Staff') ";
if ($conn->query($sqlt) ===FALSE ) {
 echo "\nInsert Error: ".$conn->error;}
}

$sqlt = "INSERT INTO {$tname} (RegisterNumber,Name)VALUES ('$reg','$Name') ";

if (isset($_POST['Name']) && $conn->query($sqlt) ===FALSE ) {
    echo "\nInsert Error: " . $conn->error;   
}

}//post if

elseif($_POST['Name']=="" && $_POST['sec']=="" && $_POST['reg']=="") {
 echo "\nNULL VALUES NOT PROCESSED";
}
elseif($_POST['Name']=="") {

echo "\nName field is empty";
echo "\nNULL VALUES NOT PROCESSED";

}
elseif($_POST['sec']=="") {
echo "\nDepartment field is not selected";
echo "\nNULL VALUES NOT PROCESSED";
}
elseif($_POST['reg']=="") {
echo "\nRegister number field is not filled";
echo "\nNULL VALUES NOT PROCESSED";
}
elseif(strlen($_POST['bs'])!==4 || strlen($_POST['bl'])!==4 ) {
echo "\nEnter a valid year ";
}
elseif($_POST['bs']>=$_POST['bl'] ) {
echo "\nLast year should be greater than first year ";
}
}//cr if 

if("alter"==$_POST['a']){

 $Date= date('DdMY').$_POST['pr'];
 $tname = $_POST['tname'];
$tname = preg_replace("/[^A-Z0-9]/", "", $tname);

if(isset($Date) && strlen($tname)>11 && strlen($tname)<15 && strlen($_POST['pr'])==2){

//$conn = new  mysqli($servername, $username, $password,$dbname);

 $alt =" ALTER TABLE {$tname} ADD COLUMN {$Date} VARCHAR(20) NOT NULL ";
  
 if ($conn->query($alt) ===FALSE) {
  echo "Alter-Error : " .$conn->error;
  }

}else{ echo "Failed";}
  
}//alt if

if("select"==$_POST['a']){

$sec= $_POST['sec'];
$batch=$_POST['bs']."-".$_POST['bl'];
$tname=$batch.$sec;
$tname = preg_replace("/[^A-Z0-9]/", "", $tname);

if(strlen($tname)>11 && strlen($tname)<15) { 
//$Sec= $_POST['dept'];
$sql = "SELECT RegisterNumber,Name FROM {$tname} ORDER BY RegisterNumber DESC";

$result = $conn->query($sql);
if ($conn->query($sql) ===FALSE) {
 echo "<br>select-Error : " .$conn->error;
  }

if ($result->num_rows > 0) {
    // output data of each row
  while($row = $result->fetch_assoc()) {
  if($row["RegisterNumber"]>1){
    echo  "<hr>Name: " . $row["Name"] . "<br>RegNumber: " . $row["RegisterNumber"];
    }//if
    }
  } else {
    echo "0 results";
     }

}//if

}//sl if

if("update"==$_POST['a']){
$Arr=$_POST['Arr'];
 $cname= date('DdMY').$_POST['pr'];
if($_POST['tname'] && $_POST['pr']){
$tname=$_POST['tname'];
 $user=$_SESSION['attusername'];
$upd="UPDATE {$tname} SET {$cname}= '{$user}' WHERE Name ='Staff' AND RegisterNumber='1' ";
 if ($conn->query($upd) ===FALSE) {
  echo "<br>Update-Error : " ;
 // echo $conn->error;
  }
foreach($Arr as $Ar){
 $n=$Ar[0];
 $r=$Ar[1];
 $v=$Ar[2];
$upd="UPDATE {$tname} SET {$cname}= '{$v}' WHERE Name ='{$n}' AND RegisterNumber={$r} ";
 if ($conn->query($upd) ===FALSE) {
  echo "\nUpdate-Error : ";
 // echo $conn->error;
  }
  
}//for
echo "Submitted";
}//if
}// update if 

if("user"==$_POST['au']){
 $id=intval($_POST['unqid']);
 $uid=intval("620117104010");
 if($id!==$uid){
 exit("Invalid Unique password");
 die();
 }
 $data= json_decode($_POST['prd']);
$us=preg_replace("/[^a-zA-Z0-9.\s]/", "", $data[0]);
$ps=MD5(strval(trim($data[1])));
$data= preg_replace("/[^A-Z0-9]/","",$data);
$mp1=$data[2];
$mp2=$data[3];
$mp3=$data[4];
$mp4=$data[5];
$mp5=$data[6];
$mp6=$data[7];
$mp7=$data[8];
$mp8=$data[9];
$tup1=$data[10];
$tup2=$data[11];
$tup3=$data[12];
$tup4=$data[13];
$tup5=$data[14];
$tup6=$data[15];
$tup7=$data[16];
$tup8=$data[17];
$wp1=$data[18];
$wp2=$data[19];
$wp3=$data[20];
$wp4=$data[21];
$wp5=$data[22];
$wp6=$data[23];
$wp7=$data[24];
$wp8=$data[25];
$tp1=$data[26];
$tp2=$data[27];
$tp3=$data[28];
$tp4=$data[29];
$tp5=$data[30];
$tp6=$data[31];
$tp7=$data[32];
$tp8=$data[33];
$fp1=$data[34];
$fp2=$data[35];
$fp3=$data[36];
$fp4=$data[37];
$fp5=$data[38];
$fp6=$data[39];
$fp7=$data[40];
$fp8=$data[41];
$sp1=$data[42];
$sp2=$data[43];
$sp3=$data[44];
$sp4=$data[45];
$sp5=$data[46];
$sp6=$data[47];
$sp7=$data[48];
$sp8=$data[49];

if("ucreate"==$_POST['ar']){
$sql = "CREATE TABLE IF NOT EXISTS Staff (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,username VARCHAR(20) NOT NULL UNIQUE, password VARCHAR(35) NOT NULL UNIQUE,Monp1 VARCHAR(14),Monp2 VARCHAR(14),Monp3 VARCHAR(14),Monp4 VARCHAR(14),Monp5 VARCHAR(14),Monp6 VARCHAR(14),Monp7 VARCHAR(14),Monp8 VARCHAR(14),Tuep1 VARCHAR(14),Tuep2 VARCHAR(14),Tuep3 VARCHAR(14),Tuep4 VARCHAR(14),Tuep5 VARCHAR(14),Tuep6 VARCHAR(14),Tuep7 VARCHAR(14),Tuep8 VARCHAR(14),Wedp1 VARCHAR(14),Wedp2 VARCHAR(14),Wedp3 VARCHAR(14),Wedp4 VARCHAR(14),Wedp5 VARCHAR(14),Wedp6 VARCHAR(14),Wedp7 VARCHAR(14),Wedp8 VARCHAR(14),Thup1 VARCHAR(14),Thup2 VARCHAR(14),Thup3 VARCHAR(14),Thup4 VARCHAR(14),Thup5 VARCHAR(14),Thup6 VARCHAR(14),Thup7 VARCHAR(14),Thup8 VARCHAR(14),Frip1 VARCHAR(14),Frip2 VARCHAR(14),Frip3 VARCHAR(14),Frip4 VARCHAR(14),Frip5 VARCHAR(14),Frip6 VARCHAR(14),Frip7 VARCHAR(14),Frip8 VARCHAR(14),Satp1 VARCHAR(14),Satp2 VARCHAR(14),Satp3 VARCHAR(14),Satp4 VARCHAR(14),Satp5 VARCHAR(14),Satp6 VARCHAR(14),Satp7 VARCHAR(12),Satp8 VARCHAR(14),accessto VARCHAR(20) NULL DEFAULT NULL,accessfrom VARCHAR(12) NULL DEFAULT NULL) ";
if ($conn->query($sql) ===FALSE) {
    echo "<br>Error creating table: " . $conn->error;
}
$sqlt= $conn->prepare("INSERT INTO Staff (username,password,Monp1,Monp2,Monp3,Monp4,Monp5,Monp6,Monp7,Monp8,Tuep1,Tuep2,Tuep3,Tuep4,Tuep5,Tuep6,Tuep7,Tuep8,Wedp1,Wedp2,Wedp3,Wedp4,Wedp5,Wedp6,Wedp7,Wedp8,Thup1,Thup2,Thup3,Thup4,Thup5,Thup6,Thup7,Thup8,Frip1,Frip2,Frip3,Frip4,Frip5,Frip6,Frip7,Frip8,Satp1,Satp2,Satp3,Satp4,Satp5,Satp6,Satp7,Satp8) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$sqlt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssss",$us,$ps,$mp1,$mp2,$mp3,$mp4,$mp5,$mp6,$mp7,$mp8,$tup1,$tup2,$tup3,$tup4,$tup5,$tup6,$tup7,$tup8,$wp1,$wp2,$wp3,$wp4,$wp5,$wp6,$wp7,$wp8,$tp1,$tp2,$tp3,$tp4,$tp5,$tp6,$tp7,$tp8,$fp1,$fp2,$fp3,$fp4,$fp5,$fp6,$fp7,$fp8,$sp1,$sp2,$sp3,$sp4,$sp5,$sp6,$sp7,$sp8);
if($sqlt->execute()){
echo "New records created successfully";
}else{
echo "Something Went Wrong , Please Try Again/Later \n";
echo $sqlt->error;
}
$sqlt->close();
}//crt

if("ualter"==$_POST['ar']){
$sqlt= $conn->prepare("UPDATE Staff SET Monp1=?,Monp2=?,Monp3=?,Monp4=?,Monp5=?,Monp6=?,Monp7=?,Monp8=?,Tuep1=?,Tuep2=?,Tuep3=?,Tuep4=?,Tuep5=?,Tuep6=?,Tuep7=?,Tuep8=?,Wedp1=?,Wedp2=?,Wedp3=?,Wedp4=?,Wedp5=?,Wedp6=?,Wedp7=?,Wedp8=?,Thup1=?,Thup2=?,Thup3=?,Thup4=?,Thup5=?,Thup6=?,Thup7=?,Thup8=?,Frip1=?,Frip2=?,Frip3=?,Frip4=?,Frip5=?,Frip6=?,Frip7=?,Frip8=?,Satp1=?,Satp2=?,Satp3=?,Satp4=?,Satp5=?,Satp6=?,Satp7=?,Satp8=? WHERE username=? AND password=?");
$sqlt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssss",$mp1,$mp2,$mp3,$mp4,$mp5,$mp6,$mp7,$mp8,$tup1,$tup2,$tup3,$tup4,$tup5,$tup6,$tup7,$tup8,$wp1,$wp2,$wp3,$wp4,$wp5,$wp6,$wp7,$wp8,$tp1,$tp2,$tp3,$tp4,$tp5,$tp6,$tp7,$tp8,$fp1,$fp2,$fp3,$fp4,$fp5,$fp6,$fp7,$fp8,$sp1,$sp2,$sp3,$sp4,$sp5,$sp6,$sp7,$sp8,$us,$ps);
if($sqlt->execute()){
echo "Records updated successfully";
}else{
echo "Something Went Wrong , Please Try Again/Later \n";
}
$sqlt->close();
}//alt

}//user if

if("subst"==$_POST['a'] & isset($_POST['otpnum'])){
$n = trim($_POST['otpnum']);
$user=$_SESSION['attusername'];
 $pass=$_SESSION['attpassword'];
  $upd="UPDATE Staff SET otp= '{$n}' WHERE username='{$user}' AND password='{$pass}' ";
 if ($conn->query($upd) ===FALSE) {
  echo "<br>Subst-Error : " .$conn->error;
  }else{ echo "Done"; }
 
}//subst

if("subfor"==$_POST['a'] & 5<strlen($_POST['pr'])  & isset($_POST['otp']) ){

if("0"==$_POST['otp'] | 6<strlen($_POST['otp']) | 4>strlen($_POST['otp'])){ die(" #"); }
 $o=$_POST['otp'];
 $p=$_POST['pr'];
 $sql = "SELECT {$p} FROM Staff WHERE otp='{$o}' ";
 $result = $conn->query($sql);
if ($result ===FALSE) {
 echo "<br>Select-Error : " .$conn->error;
 }
 if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  echo '<button class="form-control-plaintext" type="submit" name="submit" value="'.$row["$p"].'">'.$row["$p"].'</button></li>';
  }else{ echo "<center>Access Not Available</center>";}
  
}// subfor if 

if("otphad"==$_POST['a']){
$user=$_SESSION['attusername'];
 $pass=$_SESSION['attpassword'];
 $upd="SELECT otp FROM Staff WHERE username='{$user}' AND password='{$pass}' ";
 $result=$conn->query($upd);
 if ($result===FALSE) {
  echo "<br>Sub-Error : " .$conn->error;
  } 
 if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
   if($row["otp"]!=="0"){
 echo '<span id="otp">'.$row["otp"].'</span>   <i id="delotp" class="material-icons">delete_sweep</i>';
  }else{ echo "Access Not Given";}
  }
}//otphad

if("delotp"==$_POST['a']){
 $user=$_SESSION['attusername'];
 $pass=$_SESSION['attpassword'];
 $sql = "UPDATE Staff SET otp='NULL' WHERE username='{$user}' AND password='{$pass}' ";
 $conn->query($sql); 
}// del if 
 
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

if("redo1"==$_POST['a']){
 $user=$_SESSION['attusername'];
 $pass=$_SESSION['attpassword'];
 //$day= date('D');
 if("Timeout"==$_POST['pr']){ 
  $_POST['pr']=9;
 }
 $pr=preg_replace("/[^0-9]/", "", $_POST['pr']);
for($i=1;$i<$pr;$i++){
 $period=date('D')."p".$i;
$sql = "SELECT {$period} FROM Staff WHERE username='{$user}' AND password='{$pass}' ";
 $result = $conn->query($sql);
if($result->num_rows > 0){
 $row = $result->fetch_array();
echo '<button class="rework m-1 btn btn-outline-secondary">'.$row[0].'</button>' ;
}
}//for
}// redo if 

if("redo2"==$_POST['a']){
$tname = $_POST['tname'];
  $sql = "SELECT Name,RegisterNumber FROM {$tname} WHERE RegisterNumber!='1' ";
 $result = $conn->query($sql);
/* if ($result==FALSE) {
 echo "<br>Select-Error : " .$conn->error;
  } */
if($result->num_rows > 0){
while($row = $result->fetch_assoc()) { 
  echo "\n";
 //make align one by one in portrait and float right in landscape mode
echo '<div class="d-inline-flex p-2 mw" >';
    echo ' <div class="chip border" name="'.$row["Name"].'"  reg="'.$row["RegisterNumber"].' "> ';
 echo '<i class="material-icons od">person</i>';
  echo $row["Name"];
  echo '</div>';
echo'</div>';
echo'<br><button id="sj2" class="btn btn-lg btn-block" btntype="submit">Submit</button>';
}//wh
}//if

}// redo if 



if("delaccount"==$_POST['ae']){
 $user=$_SESSION['attusername'];
 $pass=$_SESSION['attpassword'];
 $sql = "DELETE FROM Staff WHERE username='{$user}' AND password='{$pass}' ";
if($conn->query($sql)==TRUE){
if(session_destroy()) {
      header("Location:index.php");
 }}
}// del if 
  
$conn->close();
}//post
?>