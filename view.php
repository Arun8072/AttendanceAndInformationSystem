<?php
session_start();
 date_default_timezone_set("Asia/Kolkata");
if(!isset($_SESSION['attusername'])){
      header("location:index.php");
      die();
   }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>Attendance management</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
   
   <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    

<style type="text/CSS">  

/*enable for testing purpose
*{
box-shadow:1px 0px 3px orange;
}*/
.bor{
box-shadow:0px 0px 2px grey;
padding:3px;
font-size:12px;
width:14px;
transition: width 1s;
overflow: auto;
}
.bor:hover{
width:90px;
}

</style>
 </head>
<body>


    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="#prct" class="nav-link" data-toggle="tab">Percentage</a>
    </li>
    <li class="nav-item">
        <a href="#class-A" class="nav-link active" data-toggle="tab">Class-A</a>
    </li>
</ul>

<div class="tab-content">
    
    <div class="tab-pane fade" id="prct">
    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Attendance";
$today= date('DdMY'); 
$dp1= date('DdMY')."p1"; 
// Create connection
$conn = new  mysqli($servername, $username, $password,$dbname);

 // Check connection
if ($conn->connect_error) {
   die("<br>Connection failed: "  . $conn->connect_error);
}

if (isset($_GET['dept']) ) {
$tname=$_GET['dept'];
}else {
        $day= date('D');
        $time=date('H:i'); if($time>=date('H:i',strtotime("09:00"))&& $time<date('H:i',strtotime("10:00"))){
        $pr="p1";
        }elseif($time>=date('H:i',strtotime("10:00"))&& $time<date('H:i',strtotime("11:00"))){
        $pr="p2";
        }elseif($time>=date('H:i',strtotime("11:15"))&& $time<date('H:i',strtotime("12:00"))){
        $pr="p3";
        }elseif($time>=date('H:i',strtotime("12:00"))&& $time<date('H:i',strtotime("12:50"))){
        $pr="p4";
        }elseif($time>=date('H:i',strtotime("13:30"))&& $time<date('H:i',strtotime("14:15"))){
        $pr="p5";
        }elseif($time>=date('H:i',strtotime("14:15"))&& $time<date('H:i',strtotime("15:00"))){
        $pr="p6";
        }elseif($time>=date('H:i',strtotime("15:15"))&& $time<date('H:i',strtotime("16:00"))){
        $pr="p7";
        }elseif($time>=date('H:i',strtotime("16:00"))&& $time<date('H:i',strtotime("16:35"))){
        $pr="p8";
        }else{ 
        $pr="Timeout";
        }
 $user=$_SESSION['attusername'];
 $pass=$_SESSION['attpassword'];
 	  $period=$day."$pr";
   		 $sql = "SELECT {$period} FROM Staff WHERE username='{$user}' AND password='{$pass}' ";
 $result = $conn->query($sql);
/*if ($result===FALSE) {
 echo "<br>Select-Error : " .$conn->error;
 }*/
 if ($result->num_rows>0) {
    // output data of each row
  while($row = $result->fetch_assoc()) {
//print_r($row);
 $tname=$row[$period];
    }//wh
  } else {
     $tname="Timeout";
     }//el
}
if(date("m")>=06){
$Y=date("Y");
}else{
$Y=date("Y")-1;
}
$fi=$Y.$Y+4;
$tw=($Y-1).($Y-1)+4;
$th=($Y-2).($Y-2)+4;
$fo=($Y-3).($Y-3)+4;

$mfi=$Y.$Y+2;
$mtw=($Y-1).($Y-1)+2;

$dep=substr($tname,8,3);
$tname1a=$fi.$dep."A";
$tname1b=$fi.$dep."B";
$tname2a=$tw.$dep."A";
$tname2b=$tw.$dep."B";
$tname3a=$th.$dep."A";
$tname3b=$th.$dep."B";
$tname4a=$fo.$dep."A";
$tname4b=$fo.$dep."B";
if("MBA"==$dep){
$tname1a=$mfi.$dep."A";
$tname1b=$mfi.$dep."B";
$tname2a=$mtw.$dep."A";
$tname2b=$mtw.$dep."B";
}
?>
  
<center><h5><?php echo$dep." Department";?></h5></center>
<table  class="table table-sm table-hover table-responsive"> <thead> 
<tr> 
<th>Class</th> 
<th>Strength</th> 
<th>Present</th>
<th>Absent</th> 
<th>OnDuty</th>
<th>Present%</th> 
</tr> 
</thead> 
<tbody> 
<tr> 
<td>1-A</td> 
<?php
$sql = "SELECT COUNT(Name) AS b1 FROM {$tname1a} WHERE RegisterNumber!='1' " ;
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo "<td>".$row["b1"] ."</td>";
 $totals=$row["b1"];
  }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS pr FROM {$tname1a} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>".$row["pr"] . "</td>";
$totalp=$row["pr"];
       }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS abs FROM {$tname1a} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["abs"] . "</td>";
  $totala= $row["abs"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS od FROM {$tname1a} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>".$row["od"] . "</td>";
$totalo=$row["od"];
      }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS tl FROM {$tname1a}  WHERE RegisterNumber!='1' " ; 
$tl = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS pr FROM {$tname1a} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$pr = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS abs FROM {$tname1a} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$ab = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS od FROM {$tname1a} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$od = $conn->query($sql);

if ($tl->num_rows > 0 && $tl->num_rows !==" ") {
if ($pr->num_rows > 0 || $ab->num_rows > 0 || $od->num_rows > 0) {
$pr=$pr->fetch_assoc();
$tl=$tl->fetch_assoc(); 
$od=$od->fetch_assoc();
$tp=$pr["pr"]+$od["od"];
$prc=ceil(($tp/$tl["tl"])*100);
$tprc=$prc;
  echo "<td> $prc% </td>";
}
}
else{
    echo "<td>  </td>";
}

?>
</tr> 
<tr> 
<td>1-B</td> 
<?php
$sql = "SELECT COUNT(Name) AS b1 FROM {$tname1b} WHERE RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
echo "<td>".$row["b1"] ."</td>";
$totals+=$row["b1"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS pr FROM {$tname1b} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>".$row["pr"] . "</td>";
$totalp+=$row["pr"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS abs FROM {$tname1b} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo  "<td>".$row["abs"] . "</td>";
$totala+=$row["abs"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS od FROM {$tname1b} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>".$row["od"] . "</td>";
$totalo+=$row["od"];
      }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS tl FROM {$tname1b} WHERE RegisterNumber!='1' " ;
$tl = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS pr FROM {$tname1b} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$pr = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS abs FROM {$tname1b} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$ab = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS od FROM {$tname1b} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$od = $conn->query($sql);

if ($tl->num_rows > 0) {
if ($pr->num_rows > 0 || $ab->num_rows > 0 || $od->num_rows > 0) {
$pr=$pr->fetch_assoc();
$tl=$tl->fetch_assoc(); 
$od=$od->fetch_assoc();
$tp=$pr["pr"]+$od["od"];
$prc=ceil(($tp/$tl["tl"])*100);
$tprc+=$prc;
  echo "<td> $prc% </td>";
}
}
else{
    echo "<td>  </td>";
}

?>
</tr> 
<tr> 
<td>2-A</td> 
<?php
$sql = "SELECT COUNT(Name) AS b1 FROM {$tname2a} WHERE RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo "<td>".$row["b1"] ."</td>";
$totals+=$row["b1"];
      }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS pr FROM {$tname2a} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["pr"] . "</td>";
 $totalp+=$row["pr"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS abs FROM {$tname2a} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["abs"] . "</td>";
    $totala+=$row["abs"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS od FROM {$tname2a} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["od"] . "</td>";
  $totalo+=$row["od"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS tl FROM {$tname2a} WHERE RegisterNumber!='1' " ;
$tl = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS pr FROM {$tname2a} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$pr = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS abs FROM {$tname2a} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$ab = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS od FROM {$tname2a} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$od = $conn->query($sql);

if ($tl->num_rows > 0) {
if ($pr->num_rows > 0 || $ab->num_rows > 0 || $od->num_rows > 0) {
$pr=$pr->fetch_assoc();
$tl=$tl->fetch_assoc(); 
$od=$od->fetch_assoc();
$tp=$pr["pr"]+$od["od"];
$prc=ceil(($tp/$tl["tl"])*100);
$tprc+=$prc;
  echo "<td> $prc% </td>";
}
}
else{
    echo "<td>  </td>";
}

?>
</tr> 
<tr> 
<td>2-B</td> 
<?php
$sql = "SELECT COUNT(Name) AS b1 FROM {$tname2b} WHERE RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo "<td>".$row["b1"] ."</td>";
  $totals+=$row["b1"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS pr FROM {$tname2b} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["pr"] . "</td>";
    $totalp+=$row["pr"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS abs FROM {$tname2b} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["abs"] . "</td>";
  $totala+=$row["abs"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS od FROM {$tname2b} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["od"] . "</td>";
    $totalo+=$row["od"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS tl FROM {$tname2b} WHERE RegisterNumber!='1' " ;
$tl = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS pr FROM {$tname2b} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$pr = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS abs FROM {$tname2b} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$ab = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS od FROM {$tname2b} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$od = $conn->query($sql);

if ($tl->num_rows > 0) {
if ($pr->num_rows > 0 || $ab->num_rows > 0 || $od->num_rows > 0) {
$pr=$pr->fetch_assoc();
$tl=$tl->fetch_assoc(); 
$od=$od->fetch_assoc();
$tp=$pr["pr"]+$od["od"];
$prc=ceil(($tp/$tl["tl"])*100);
$tprc+=$prc;
  echo "<td> $prc% </td>";
}
}
else{
    echo "<td>  </td>";
}

?>
</tr> 
<tr> 
<td>3-A</td> 
<?php
$sql = "SELECT COUNT(Name) AS b1 FROM {$tname3a} WHERE RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo "<td>".$row["b1"] ."</td>";
$totals+=$row["b1"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS pr FROM {$tname3a} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["pr"] . "</td>";
$totalp+=$row["pr"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS abs FROM {$tname3a} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["abs"] . "</td>";
$totala+=$row["abs"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS od FROM {$tname3a} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["od"] . "</td>";
$totalo+=$row["od"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS tl FROM {$tname3a} WHERE RegisterNumber!='1' " ;
$tl = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS pr FROM {$tname3a} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$pr = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS abs FROM {$tname3a} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$ab = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS od FROM {$tname3a} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$od = $conn->query($sql);

if ($tl->num_rows > 0) {
if ($pr->num_rows > 0 || $ab->num_rows > 0 || $od->num_rows > 0) {
$pr=$pr->fetch_assoc();
$tl=$tl->fetch_assoc(); 
$od=$od->fetch_assoc();
$tp=$pr["pr"]+$od["od"];
 $prc=ceil(($tp/$tl["tl"])*100);
 $tprc+=$prc;
  echo "<td> $prc% </td>";
}
}
else{
    echo "<td>  </td>";
}

?>
</tr>
<tr> 
<td>3-B</td> 
<?php
$sql = "SELECT COUNT(Name) AS b1 FROM {$tname3b} WHERE RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo "<td>".$row["b1"] ."</td>";
$totals+=$row["b1"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS pr FROM {$tname3b} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["pr"] . "</td>";
$totalp+=$row["pr"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS abs FROM {$tname3b} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["abs"] . "</td>";
$totala+=$row["abs"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS od FROM {$tname3b} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["od"] . "</td>";
$totalo+=$row["od"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS tl FROM {$tname3b}  WHERE RegisterNumber!='1' " ;
$tl = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS pr FROM {$tname3b} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$pr = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS abs FROM {$tname3b} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$ab = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS od FROM {$tname3b} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$od = $conn->query($sql);

if ($tl->num_rows > 0) {
if ($pr->num_rows > 0 || $ab->num_rows > 0 || $od->num_rows > 0) {
$pr=$pr->fetch_assoc();
$tl=$tl->fetch_assoc(); 
$od=$od->fetch_assoc();
$tp=$pr["pr"]+$od["od"];
$prc=ceil(($tp/$tl["tl"])*100);
$tprc+=$prc;
  echo "<td> $prc% </td>";
}
}
else{
    echo "<td>  </td>";
}

?>
</tr>
<tr> 
<td>4-A</td> 
<?php
$sql = "SELECT COUNT(Name) AS b1 FROM {$tname4a}  WHERE RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo "<td>".$row["b1"] ."</td>";
$totals+=$row["b1"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS pr FROM {$tname4a} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["pr"] . "</td>";
$totalp+=$row["pr"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS abs FROM {$tname4a} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["abs"] . "</td>";
$totala+=$row["abs"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS od FROM {$tname4a} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["od"] . "</td>";
$totalo+=$row["od"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS tl FROM {$tname4a}  WHERE RegisterNumber!='1' " ;
$tl = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS pr FROM {$tname4a} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$pr = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS abs FROM {$tname4a} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$ab = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS od FROM {$tname4a} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$od = $conn->query($sql);

if ($tl->num_rows > 0) {
if ($pr->num_rows > 0 || $ab->num_rows > 0 || $od->num_rows > 0) {
$pr=$pr->fetch_assoc();
$tl=$tl->fetch_assoc(); 
$od=$od->fetch_assoc();
$tp=$pr["pr"]+$od["od"];
$prc=ceil(($tp/$tl["tl"])*100);
$tprc+=$prc;
  echo "<td> $prc% </td>";
}
}
else{
    echo "<td>  </td>";
}

?>
</tr>
<tr> 
<td>4-B</td> 
<?php
$sql = "SELECT COUNT(Name) AS b1 FROM {$tname4b} WHERE RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo "<td>".$row["b1"] ."</td>";
$totals+=$row["b1"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS pr FROM {$tname4b} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["pr"] . "</td>";
$totalp+=$row["pr"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS abs FROM {$tname4b} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["abs"] . "</td>";
$totala+=$row["abs"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS od FROM {$tname4b} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  echo  "<td>". $row["od"] . "</td>";
$totalo+=$row["od"];
    }
}
else{
    echo "<td>  </td>";
}

$sql = "SELECT COUNT(Name) AS tl FROM {$tname4b} WHERE RegisterNumber!='1' " ;
$tl = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS pr FROM {$tname4b} WHERE {$dp1}='P' AND RegisterNumber!='1' " ;
$pr = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS abs FROM {$tname4b} WHERE {$dp1}='A' AND RegisterNumber!='1' " ;
$ab = $conn->query($sql);
$sql = "SELECT COUNT(Name) AS od FROM {$tname4b} WHERE {$dp1}='O' AND RegisterNumber!='1' " ;
$od = $conn->query($sql);

if ($tl->num_rows > 0) {
if ($pr->num_rows > 0 || $ab->num_rows > 0 || $od->num_rows > 0) {
$pr=$pr->fetch_assoc();
$tl=$tl->fetch_assoc(); 
$od=$od->fetch_assoc();
$tp=$pr["pr"]+$od["od"];
$prc=ceil(($tp/$tl["tl"])*100);
$tprc+=$prc;
  echo "<td> $prc% </td>";
}
}
else{
    echo "<td>  </td>";
}

?>
</tr>
<tr>
<td>TOTAL</td>
<?php
  echo "<td>". $totals ."</td>";
  echo "<td>".$totalp ."</td>";
  echo "<td>". $totala ."</td>";
  echo "<td>". $totalo ."</td>";
  echo "<td> $tprc% </td>";
?>
</tr>
</tbody>
</table>
    </div>


    <div class="tab-pane fade show active" id="class-A">
       <!--php conn-->
<?php if($tname=="Timeout"){
 echo "Slide right from the left edge to select department"; } ?>
​<table class="striped  centered responsive-table">
        <thead>
          <tr>
          <th>Name</th>
<?php 

$sql = "SELECT Name FROM {$tname}" ;
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {
  echo  "<th>". $row["Name"] . "</th>";
    }
}
else{
    echo "<th> 0 results </th>";
}
?>
          </tr>
        </thead>

        <tbody>
<?php 
function fu($vl){
if("P"==$vl){ return "Present"; 
}elseif("A"==$vl){ return "Absent";
}elseif("O"==$vl){ return "OnDuty";
}else{ return $vl; }
}//fun

for($i=1;$i<9;$i++){
 $y=$today."p".$i;
echo "<tr>
<th>$y</th>";
$sql = "SELECT {$y} FROM {$tname} "; 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 echo "<td>".fu($row["$y"])."</td>";
}
}
else{
    echo "<td> 0 results </td>";
}
echo"</tr>";
}
?>
<?php


for($k=-1;$k>-155;$k--){
  echo "<tr>";
 $d=strtotime("$k days");
if(Sun==date('D',$d)){
 continue;
}
$d=date('DdMY',$d);
echo "<th>$d</th>";
for($i=1;$i<9;$i++){
  $t[$i]=$d."p".$i;
}//fr

$sql="SELECT {$t[1]},{$t[2]},{$t[3]},{$t[4]},{$t[5]},{$t[6]},{$t[7]},{$t[8]} FROM {$tname} ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 echo '<td>';
echo '<div class="row">';
echo '<section class="bor">'.fu($row["$t[1]"]).'</section>
<section class="bor">'.fu($row["$t[2]"]).'</section>
<section class="bor">'.fu($row["$t[3]"]).'</section>
<section class="bor">'.fu($row["$t[4]"]).
'</section><section class="bor"> </section> 
<section class="bor">'.fu($row["$t[5]"]).'</section>
<section class="bor">'.fu($row["$t[6]"]).'</section>
<section class="bor">'.fu($row["$t[7]"]).'</section>
<section class="bor">'.fu($row["$t[8]"]).'</section>';
echo '</div>';
echo '</td>';
}
}else{
    echo "<td>0 results</td>";
}
  echo "</tr>";
 }//fr
  ?>
        </tbody>
      </table>
     </div>
     
         
</div>

<?php 
if(isset($conn)){
$conn->close();
}

if(date("m")>=06){
$Y=date("Y");
}else{
$Y=date("Y")-1;
}
$fi=$Y.$Y+4;
$tw=($Y-1).($Y-1)+4;
$th=($Y-2).($Y-2)+4;
$fo=($Y-3).($Y-3)+4;

$mfi=$Y.$Y+2;
$mtw=($Y-1).($Y-1)+2;
?>

<!-- main navbar of sidenav deleted for design-->
<!--side Nav-->
 <ul id="slide-out" class="sidenav fixed">
 
 <div class="user-view">
      <div class="background">
        <img src="images/imgt.jpg">
      </div>
 <li class="nav-item" style="height:40px;"> <a class="nav-link white-text" href="main.php">Attendance</a></li>
  <li class="nav-item active" style="height:40px;"> <a class="nav-link white-text" href="view.php">View</a> </li>
 <li class="nav-item" style="height:40px;"> <a class="nav-link white-text" href="register.php">Register</a> </li>
 <li class="nav-item" style="height:40px;"> <a class="nav-link white-text" href="search.php">Search</a> </li>
 </div>
 
 
 <!--form tag for GET of dept value-->

 <form method="GET" action="view.php">
 <li class="no-padding">
  <ul class="collapsible collapsible-accordion">
  
  <li>
<!--collapsible inside a collapsible-->
    <span class="collapsible-header"><i class="material-icons">list</i>Computer Science and Engg</span>
<div class="collapsible-body">
 <ul>
  <li>
  <ul class="collapsible collapsible-accordion">
  <li>
    <a><span class="collapsible-header">First year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
 <li>
 <!--GET value to php to change dept-->
     <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."CSEA"; ?>">CSE-A</button></li>
 <li>   <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."CSEB"; ?>">CSE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."CSEA"; ?>">CSE-A</button></li>
   <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."CSEB"; ?>">CSE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
 <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."CSEA"; ?>">CSE-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."CSEB"; ?>">CSE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."CSEA"; ?>">CSE-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."CSEB"; ?>">CSE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
 
   </ul><!--col acc-->
   </ul><!--col body-->
 </li><!--acc child-->
  
<li>
   <span class="collapsible-header"><i class="material-icons">list</i>Electronics&Comm Engg</span>
<div class="collapsible-body">
 <ul>
  <li>
  <ul class="collapsible collapsible-accordion">
   <li>
    <a><span class="collapsible-header">First year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."ECEA"; ?>">ECE-A</button></li>
   <li>   <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."ECEB"; ?>">ECE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."ECEA"; ?>">ECE-A</button></li>
   <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."ECEB"; ?>">ECE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
    <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."ECEA"; ?>">ECE-A</button></li>
   <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."ECEB"; ?>">ECE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."ECEA"; ?>">ECE-A</button></li>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."ECEB"; ?>">ECE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
 
   </ul><!--col acc-->
   </ul><!--col body-->
 </li><!--acc child-->
  
  
<li>
    <span class="collapsible-header"> <i class="material-icons">list</i>Electrical&Electronics Engg</span>
<div class="collapsible-body">
 <ul>
  <li>
  <ul class="collapsible collapsible-accordion">
   <li>
    <a><span class="collapsible-header">First year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."EEEA"; ?>">EEE-A</button></li>
  <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."EEEB"; ?>">EEE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."EEEA"; ?>">EEE-A</button></li>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."EEEB"; ?>">EEE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."EEEA"; ?>">EEE-A</button></li>
   <li>  <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."EEEB"; ?>">EEE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."EEEA"; ?>">EEE-A</button></li>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."EEEB"; ?>">EEE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
 
   </ul><!--col acc-->
   </ul><!--col body-->
 </li><!--acc child-->
  
  
<li>
    <span class="collapsible-header"><i class="material-icons">list</i>Mechanical Engineering</span>
<div class="collapsible-body">
 <ul>
  <li>
  <ul class="collapsible collapsible-accordion">
    <li>
    <a><span class="collapsible-header">First year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."MECHA"; ?>">MECH-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."MECHB"; ?>">MECH-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."MECHA"; ?>">MECH-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."MECHB"; ?>">MECH-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."MECHA"; ?>">MECH-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."MECHB"; ?>">MECH-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."MECHA"; ?>">MECH-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."MECHB"; ?>">MECH-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
 
   </ul><!--col acc-->
   </ul><!--col body-->
 </li><!--acc child-->
  
     
<li>
   <span class="collapsible-header"> <i class="material-icons">list</i>Civil Engineering</span>
<div class="collapsible-body">
 <ul>
  <li>
  <ul class="collapsible collapsible-accordion">
  <li>
    <a><span class="collapsible-header">First year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."CIVILA"; ?>">CIVIL-A</button></li>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fi."CIVILB"; ?>">CIVIL-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."CIVILA"; ?>">CIVIL-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $tw."CIVILB"; ?>">CIVIL-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."CIVILA"; ?>">CIVIL-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $th."CIVILB"; ?>">CIVIL-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."CIVILA"; ?>">CIVIL-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $fo."CIVILB"; ?>">CIVIL-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
 
   </ul><!--col acc-->
   </ul><!--col body-->
 </li><!--acc child-->
  
<li>
  <span class="collapsible-header"> <i class="material-icons">list</i>MBA</span>
<div class="collapsible-body">
<ul>
  <li>
  <ul class="collapsible collapsible-accordion">
  <li>
    <a><span class="collapsible-header">First year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $mfi."MBAA"; ?>">MBA-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $mfi."MBAB"; ?>">MBA-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $mtw."MBAA"; ?>">MBA-A</button></li>
   <li><button name="dept" class="form-control-plaintext" type="submit"  value="<?php echo $mtw."MBAB"; ?>">MBA-B</button></li>
 </ul>
</div>
   </ul><!--col acc-->
   </ul><!--col body-->
 </li><!--acc child-->
   
 <li>
   <span class="collapsible-header"> <i class="material-icons">list</i>Set Default View</span>
<div class="collapsible-body">
 <ul>
   <li>
 <?php //selected dept is get as value to cookie
echo '<div class="col-12">
  <input type="text" class="form-control input-sm" placeholder="Department" name=ckie value="'.$_GET['dept'].'" >
  </div>
  <div class="col-6">
    <button id="dft" type="submit" class="waves-effect waves-teal btn-flat">Set Default</button>
  </div>'; 
?>
</li>
 </ul>
</div>
 </li><!--acc child-->
            
 <li>
   <span class="collapsible-header"> <i class="material-icons">list</i>Select Date Range</span>
<div class="collapsible-body">
 <ul>
   <li>
    <form class="col s12">
      <div class="row">
<div class="input-field col s6">
<label for="frdt">from date</label>
      <input type="text" id="frdt" class="datepicker">
</div>
<div class="input-field col s6">
<label for="todt">to date</label>
       <input type="text" id="todt" class="datepicker">
</div>
      </div>
    </form>
</li>
 </ul>
</div>
 </li><!--acc child-->
            

         </ul><!--col acc-->
  	   </li> <!--no pad-->
    </ul> <!--sid nav-->


    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  <!--      -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script> document.addEventListener('DOMContentLoaded', function() {
M.AutoInit();
var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
      toolbarEnabled: true
    });
 var elems = document.querySelectorAll('.datepicker');
var options={'autoClose':true,'format':"ddd dd mmm yyyy"};
    var instances = M.Datepicker.init(elems, options);
  });

 </script>
</body>

</html>
