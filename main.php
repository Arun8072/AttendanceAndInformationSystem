<?php
   session_start();
   date_default_timezone_set("Asia/Kolkata");
if(!isset($_SESSION['attusername'])){
 die(header("location:index.php"));
      
   }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Attendance management</title>

    <!-- Bootstrap CDN commands -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  
      <!-- Compiled and minified materialize CSS CDN commands -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!--materialize CSS icons-->
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--including Google fonts-->
<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
 
<style>
.sidenav,#sj{
    font-family: Ubuntu ;
}
.progress-bar{
 position : fixed;
  top:0% 
  width:100%;
  height:1.5px;
}

article{
padding: 15px;
}

.chip {
  display: inline-block;
 padding:4px;/*remove It & align ver,hor-Center*/
  height: 45px;
  font-size: 16px;
 /* line-height: 25px;*/
  border-radius: 25px;
  background-color: #ffffff;
 /* box-shadow:1px 1px 4px #00e68a;*/
}

.chip i {
  float:left;
/* margin: 0px 5px 0px -25px;
  height:40px;
  width:40px;
  border-radius:50%;*/
}

/*at landscape div of chip are float left and right*/
@media only screen and (orientation: landscape) {
  article>div:nth-child(even){
 float: right;
}
article>div:nth-child(odd){
 float: left;
}
}

/*by assigning the min-width to 250 div of chip not get together in same row at portrait even if the name is only 5characters */
.mw{
min-width: 250px;
height:57px;
}

#sc{
height:35px;
white-space:nowrap;
position:sticky;
top:0;
z-index:+1;/*navbar behind sidenav*/
}

#ru{
position:relative;
}

#delacc{
position:absolute;
right:0px;
color:grey;
}

/*enable for testing purpose
*{
box-shadow:1px 0px 3px orange;
}*/

</style>

<!--changing the width using js-->
  <div id="pb" class="progress-bar bg-success fixed-top" role="progressbar" style="width:0%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</head>
<body>

<!--side Nav -->
 <ul id="slide-out" class="sidenav fixed">
 <div class="user-view">
      <div class="background">
        <img src="images/imgt.jpg">
      </div>
 <h5 class="white-text" > <?php echo $_SESSION['attusername']; ?></h5> 
 <div id="ru" class="row"> <p><a href="logout.php">Sign Out</a></p>  <p id="delacc">Delete Account</p>
</div>
 </div>

<li class="nav-item active"> <a class="nav-link " href="main.php">Attendance</a></li> <li class="nav-item"> <a class="nav-link " href="view.php">View</a> </li> <li class="nav-item "> <a class="nav-link " href="register.php">Register</a> </li> 
<?php 
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
 <form id="snform" method="post">
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
 <!--post value to php to change dept-->
     <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."CSEA"; ?>">CSE-A</button></li>
 <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."CSEB"; ?>">CSE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."CSEA"; ?>">CSE-A</button></li>
   <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."CSEB"; ?>">CSE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
 <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."CSEA"; ?>">CSE-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."CSEB"; ?>">CSE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."CSEA"; ?>">CSE-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."CSEB"; ?>">CSE-B</button></li>
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
     <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."ECEA"; ?>">ECE-A</button></li>
   <li>   <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."ECEB"; ?>">ECE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."ECEA"; ?>">ECE-A</button></li>
   <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."ECEB"; ?>">ECE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
    <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."ECEA"; ?>">ECE-A</button></li>
   <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."ECEB"; ?>">ECE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."ECEA"; ?>">ECE-A</button></li>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."ECEB"; ?>">ECE-B</button></li>
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
     <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."EEEA"; ?>">EEE-A</button></li>
  <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."EEEB"; ?>">EEE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."EEEA"; ?>">EEE-A</button></li>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."EEEB"; ?>">EEE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
     <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."EEEA"; ?>">EEE-A</button></li>
   <li>  <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."EEEB"; ?>">EEE-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."EEEA"; ?>">EEE-A</button></li>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."EEEB"; ?>">EEE-B</button></li>
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
     <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."MECHA"; ?>">MECH-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."MECHB"; ?>">MECH-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."MECHA"; ?>">MECH-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."MECHB"; ?>">MECH-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."MECHA"; ?>">MECH-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."MECHB"; ?>">MECH-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."MECHA"; ?>">MECH-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."MECHB"; ?>">MECH-B</button></li>
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
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."CIVILA"; ?>">CIVIL-A</button></li>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."CIVILB"; ?>">CIVIL-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
 
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."CIVILA"; ?>">CIVIL-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $tw."CIVILB"; ?>">CIVIL-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  
  <li>
    <a><span class="collapsible-header">Third year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."CIVILA"; ?>">CIVIL-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $th."CIVILB"; ?>">CIVIL-B</button></li>
 </ul>
</div>
 </li><!--acc child-->

  
  <li>
    <a><span class="collapsible-header">Fourth year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."CIVILA"; ?>">CIVIL-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fo."CIVILB"; ?>">CIVIL-B</button></li>
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
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $mfi."MBAA"; ?>">MBA-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $mfi."MBAB"; ?>">MBA-B</button></li>
 </ul>
</div>
 </li><!--acc child-->
  
  <li>
    <a><span class="collapsible-header">Second year<i class="material-icons">arrow_drop_down</i></span></a>
<div class="collapsible-body">     
 <ul>
   <li> <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $mtw."MBAA"; ?>">MBA-A</button></li>
   <li><button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $mtw."MBAB"; ?>">MBA-B</button></li>
 </ul>
</div></form>
   </ul><!--col acc-->
   </ul><!--col body-->
 </li><!--acc child-->
 
         </ul><!--col acc-->
  	   </li> <!--no pad-->
         </ul><!--col acc-->

 <!-- Nav tabs -->
<div class="">
  <ul id="sc" class="nav nav-tabs bg-light sticky-top" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Class </a>
    </li>
    <li class="nav-item">
      <a id="abst" class="nav-link" data-toggle="tab" href="#menu1">Absentees</a>
    </li>
    <li id="odt" class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">OnDuty</a>
    </li>
   <li id="prs" class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu3">Present</a></li>
  </ul>

  <!-- Tab panes -->
  <span class="tab-content">
    <div id="home" class=" tab-pane active"><br>
<!-- Class name and badge included in ch.php  -->
<article class="clearfix">

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Attendance";

// Create connection
$conn = new  mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
   die("<br>Connection failed: "  . $conn->connect_error);
}
if (isset($_POST['submit']) ) {
    $tname=$_POST['submit'];
}//if
else{
        $day= date('D');
        $time=date('H:i'); if($time>=date('H:i',strtotime("09:00"))&& $time<date('H:i',strtotime("10:00"))){
        $pr="p1";
        }elseif($time>=date('H:i',strtotime("10:00"))&& $time<date('H:i',strtotime("11:15"))){
        $pr="p2";
        }elseif($time>=date('H:i',strtotime("11:15"))&& $time<date('H:i',strtotime("12:00"))){
        $pr="p3";
        }elseif($time>=date('H:i',strtotime("12:00"))&& $time<date('H:i',strtotime("13:30"))){
        $pr="p4";
        }elseif($time>=date('H:i',strtotime("13:30"))&& $time<date('H:i',strtotime("14:15"))){
        $pr="p5";
        }elseif($time>=date('H:i',strtotime("14:15"))&& $time<date('H:i',strtotime("15:15"))){
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
}//el

  echo '<h6 class="container">';
  echo $tname;
echo'<span id="cbg"  class="badge"></span>
</h6><br> ';

 $sql = "SELECT Name,RegisterNumber FROM {$tname} WHERE RegisterNumber!='1' ";
 $result = $conn->query($sql);
/* if ($result==FALSE) {
 echo "<br>Select-Error : " .$conn->error;
  }*/
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
}//wh
}//if
$conn->close();
?>  
<!-- 
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h5>Swap Class</h5>
  <div id="swu" class="row"> </div>
<form><input type="text" id="usernm" class="form-control" placeholder="Username" pattern="[a-zA-Z0-9\s.]{6,20}" >  
   <button id="swap" type="submit" class="btn waves-effect waves-teal btn-flat">Allow</button></form> 
   <h5>Swapped Class</h5>
 <form id="swapped" method="POST"> </form>
    </div>
    <div class="modal-footer">
      <p id="close" class="modal-close waves-effect btn-flat">Close</p>
    </div>
  </div>  -->
  <!-- Modal Structure -->
  <div id="modal2" class="modal">
    <div class="modal-content">
      <h5>Swap Class</h5>
  <div id="otphad" class="row"> </div>
<form><input type="number" id="otpnum" class="form-control" pattern="[0-9]{4,6}"  placeholder="Number">  
 <button id="subal" type="submit" class="btn waves-effect waves-teal btn-flat">Allow</button> <button id="subgt" type="submit" class="btn waves-effect waves-teal btn-flat right">Request</button></form> 
   <h5>Swapped Class</h5>
 <form id="subfor" method="POST"> </form>
     </div>    <!--   -->
    <div class="modal-footer">
      <p class="modal-close waves-effect btn-flat">Close</p>
    </div><!--  -->
  </div><!--modal -->
  <!-- Modal Structure -->
  <div id="modal3" class="modal">
    <div class="modal-content">
      <h5>Redo</h5>
  <div id="min"> 

  </div> 
  </div>  
    <div class="modal-footer">
      <p class="modal-close waves-effect btn-flat">Close</p>
    </div><!-- -->
  </div><!--modal -->
   
  
      <!--FAB-->
<div class="fixed-action-btn  toolbar">
<!-- class="btn-large red"-->
  <a class="btn-floating">
  <!--class="large"-->
    <i class="large material-icons">mode_edit</i>
  </a>
  <ul>
 <li><a id="subi" class="btn-floating" ><i class="material-icons modal-trigger" href="#modal2">swap_horiz</i></a></li>
  <li><a id="redo" class="btn-floating" ><i class="material-icons modal-trigger" href="#modal3">update</i></a></li>
<li><a id="all" class="btn-floating"><i class="material-icons">playlist_add_check</i></a></li>
    <li><a onclick="topFunction()" id="top" class="btn-floating" ><i class="material-icons">publish</i></a></li>
  </ul>
</div>

</article>
<br><br>
<button id="sj" class="btn btn-lg btn-block" btntype="submit">Submit</button>
    </div><!--tab1-->
    
    <div id="menu1" class="container tab-pane fade">
      <h4>Absentees <span id="abg"  class="badge"> </span></h4>
      <p id="abste" style="word-break: break-all;"> </p>
    </div>
    <div id="menu2" class="container tab-pane fade">
      <h4>OnDuty <span id="obg"  class="badge"> </span></h4>
      <p id="odty" style="word-break: break-all;" > </p>
    </div>
   <div id="menu3" class="container tab-pane fade">
      <h4>Present <span id="pbg"  class="badge"> </span></h4>
      <p id="prst" style="word-break: break-all;" > </p>
    </div>
  </span>
</div>
​         
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
 
<script>
$(document).ready(function(){
$("#snform").hide();

//click an dblclick function on same element

$( ".chip" ).on({

// if chip clicked present
"click": function() {  
$(this).attr("value","P");
 $(this).css("box-shadow", "1px 1px 5px green");
 $(this).fadeTo(0,1);

// changing value for progress bar as per no of chip selected
 var obt = document.querySelectorAll("div[value]").length;
var prc = Math.ceil(obt*100/ttl);
$('#pb').attr('style', 'width:'+Number(prc)+'%');
  },
 
//if double clicked absent
"dblclick": function() { 
$(this).attr("value","A");
   $(this).css("box-shadow", "1px 0px 3px black");
  $(this).fadeTo(0,0.4); }

});

//img tag  is clicked onduty

$(".od").click(function(){
$(this).toggle(
  function(){
 $(this).parent().attr("value","O");
  $(this).parent().css("box-shadow", "1px 0px 3px orange");
});//tg
 });//clk


//send chips name,dept,value attributes with values to ins.php through ajax
$("#sj").click(function(){ 
 $(this).prop( "disabled", true );
var bt=this;
var tname="<?php echo $tname; ?>";
var pr="<?php echo $pr; ?>";

if(pr!=="Timeout" && tname!=="Timeout"){

$.ajax({
    type: "POST",
    url: 'fl.php',
    data:{tname:tname,pr:pr,a:"alter"},
    success: function(data){
    //console.log(data);
     var arr=[];
$(".chip").each(function(){
 var sd = $(this).attr("name") ;
 var as = $(this).attr("reg") ;
 var df = $(this).attr("value");
arr.push([sd,as,df]);
});//ech      

 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{Arr:arr,tname:tname,pr:pr,a:"update"},
    success: function(data){
   $("#all").fadeOut();
   $("#sj").text(data);
$("[value='P'],[value='A'],[value='O'] ").parent().fadeOut("slow").remove();
    }//suc
});//aj

    }//suc
});//aj
//from materialize css
       M.toast({html: 'Successfully Sent'})
 }//pr if
 
});//clk


/*
$("#sw").click(function(){
 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{a:"swapped"},
    success: function(data){
       $("#swapped").html(data);
    }//suc 
    });//aj
 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{a:"acto"},
    success: function(data){
       $("#swu").html(data);
 $("#delacs").click(function(){
 var unm=$("#unm").text();
   $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{unm:unm,a:"delacs"},
    success: function(data){
    alert("Permission Revoked");
     $(".modal-close").trigger("click");
    }//suc 
    });//aj
   });//cl
  }//suc 
  });//aj
});//cl


$("#swap").click(function(e){
var name=$("#usernm").val()
var tname="<?php echo $tname; ?>";
 e.preventDefault();
 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{name:name,tname:tname,a:"swap"},
    success: function(data){
       alert(data);
       $("#usernm").val("");
      $(".modal-close").trigger("click");
    }//suc 
    });//aj
});//cl
*/
    
$("#subi").click(function(){
 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{a:"otphad"},
    success: function(data){
       $("#otphad").html(data);
 $("#delotp").click(function(){
   $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{a:"delotp"},
    success: function(data){
  $(".modal-close").trigger("click");
    alert("Permission Revoked");
    }//suc 
    });//aj 
   });//cl 
  }//suc 
  });//aj
});//cl

$("#subgt").click(function(e){
e.preventDefault();
var otp=$("#otpnum").val();
var pr="<?php echo $period; ?>";
 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{otp:otp,pr:pr,a:"subfor"},
    success: function(data){
       $("#subfor").html(data);
 $("#otpnum").val("");
    }//suc 
    });//aj

});//cl


$("#subal").click(function(e){
var otpnum=$("#otpnum").val();
 e.preventDefault();
 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{otpnum:otpnum,a:"subst"},
    success: function(data){
       alert(data);
       $("#otpnum").val("");
     $(".modal-close").trigger("click");
    }//suc 
    });//aj
});//cl

  
  $("#redo").click(function(){
 var pr="<?php echo $pr; ?>";

 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{pr:pr,a:"redo1"},
    success: function(data){
    $("#min").html(data);
    
    $(".rework").click(function(){
 var tname=$(this).text();
 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{tname:tname,a:"redo2"},
    success: function(data){
    $("#min").html(data);
    
    $( ".chip" ).on({
// if chip clicked present
"click": function() {  
$(this).attr("value","P");
 $(this).css("box-shadow", "1px 1px 5px green");
 $(this).fadeTo(0,1); },
//if double clicked absent
"dblclick": function() { 
$(this).attr("value","A");
   $(this).css("box-shadow", "1px 0px 3px black");
  $(this).fadeTo(0,0.4); }
});
//img tag  is clicked onduty
$(".od").click(function(){
$(this).toggle(
  function(){
 $(this).parent().attr("value","O");
  $(this).parent().css("box-shadow", "1px 0px 3px orange");
});//tg
 });//clk
    
 $("#sj2").click(function(){ 
 $(this).prop( "disabled", true );
var bt=this;

if(pr!=="Timeout" && tname!=="Timeout"){
$.ajax({
    type: "POST",
    url: 'fl.php',
    data:{tname:tname,pr:pr,a:"alter"},
    success: function(data){
    //console.log(data);
     var arr=[];
$(".chip").each(function(){
 var sd = $(this).attr("name") ;
 var as = $(this).attr("reg") ;
 var df = $(this).attr("value");
arr.push([sd,as,df]);
});//ech      

 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{Arr:arr,tname:tname,pr:pr,a:"update"},
    success: function(data){
   $("#all").fadeOut();
   $("#sj2").text(data);
$("[value='P'],[value='A'],[value='O'] ").parent().fadeOut("slow").remove();
    }//suc
});//aj

    }//suc
});//aj
//from materialize css
       M.toast({html: 'Successfully Sent'})
 }//pr if
 
});//clk

 
    }//suc 
    });//aj
});//cl

    }//suc 
    });//aj
  
});//cl

  
//select all as present
$("#all").click(function(){
 $.each($(".chip"), function(){ 
   $(this).trigger("click");
 });//ech
});//clk


// When the user scrolls down 100px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop  > 100 || document.documentElement.scrollTop > 100) {
    document.getElementById("top").style.display = "block";
  } else {
    document.getElementById("top").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

$("#abst").click(function(){
var ab = [ ];
 $("[value='A']").each(function(){
 ab.push($(this).attr("name"));
 });//ech
 $("#abste").text("");
for(var i=0;i<ab.length;i++){
$("#abste").append("<p>"+ab[i]+"</p>");
}
//update badge value
 var abbg= ab.length;
document.getElementById("abg").innerHTML = abbg;

});//cl

$("#odt").click(function(){
var od = [ ];
 $("[value='O']").each(function(){
 od.push($(this).attr("name"));
 });//ech 
 $("#odty").text("");
for(var i=0;i<od.length;i++){
$("#odty").append("<p>"+od[i]+"</p>");
}
//update badge value
 var odbg= od.length;
document.getElementById("obg").innerHTML = odbg;

});//cl

$("#prs").click(function(){
var pt = [ ];
 $("[value='P']").each(function(){
 pt.push($(this).attr("name"));
 });//ech 
 $("#prst").text("");
for(var i=0;i<pt.length;i++){
$("#prst").append("<p>"+pt[i]+"</p>");
}
//update badge value
 var ptbg= pt.length;
document.getElementById("pbg").innerHTML = ptbg;

});//cl

var ttl = document.getElementsByClassName("chip").length;
//update badges value
document.getElementById("cbg").innerHTML = ttl;

$("#delacc").click(function(e){
 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{ae:"delaccount"},
    success: function(data){
    window.location="timetable.html";
    }//suc 
    });//aj
});//cl

if(0==$("article .chip").length){
$("#sj").hide();
}
 });//doc
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
    
 <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  
      <script src="js/bootstrap.min.js"></script>
 
 <!-- materialcsslite   removed  because of it not working with materialize CSS-->
 
  <!--side nav activation-->
 <script>
 document.addEventListener('DOMContentLoaded', function() {
M.AutoInit();
var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
      toolbarEnabled: true
    });
  });

</script>
 
</body>

</html>
