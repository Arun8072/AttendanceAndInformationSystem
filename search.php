<?php
   session_start();
if(!isset($_SESSION['attusername'])){
 die(header("location:index.php"));
   }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Full Details</title>
   
   <!-- Compiled and minified CSS 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    
    <link rel="stylesheet" href="css/materialize.min.css">
    
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   
<style type="text/CSS">  
/*enable for testing purpose
*{
box-shadow:1px 0px 3px orange;
}*/
#ru{
position:relative;
}
#delacc{
position:absolute;
right:0px;
color:grey;
}
button{
margin:13px;
}
.container{
margin-left:10%;
margin-right:12%;
}
</style>
 </head>
<body>

<div class="row">
   <!-- Default input --> 
  <form class="form-inline" method="GET" action="search.php">
  <div class="col s5 input-field">
  <input class="form-control col-5 m-1" type="search" name="stud" placeholder="Name or Reg No" required>
</div>
<div class="col s5 input-field">
<input class="form-control col-5 m-1 autocomplete" type="search" name="class" placeholder="Batch-Class-Section" required></div>
<div class="col s2">
 <button class="btn btn-small">Search</button></div>
  </form> </div>


<div id="result" class="container">

<?php  $n=preg_replace('/[^A-z0-9.\s]/', '', trim($_GET["stud"]));
 $c=preg_replace('/[^A-Za-z0-9]/', '',strtoupper($_GET["class"]));

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

echo '​<table class="striped  centered"><thead>
<tr> <th>Date</th> <th>Status</th> <th>Staff</th> </tr>
</thead> <tbody>';

$sql = "select * from $c where RegisterNumber='$n' or Name='$n' or RegisterNumber='1' ";
$result = $conn->query($sql);
//data of appropriate table
$sqc = "SELECT column_name from information_schema.columns where table_schema='Attendance' and table_name='$c' ";
$res = $conn->query($sqc);
//column name of the appropriate table from information_schema.columns
//echo $conn->error;
if ($result->num_rows > 0) {
//fetching the detail of who takes attendance
$staff = $result->fetch_array();
//$count=$result->field_count;
 $row = $result->fetch_array();
//column is not idetifiable so fetch_array is used instead of associative array 
$i=-1;
while ($col = $res->fetch_array()){
//data of tablename displayed while column name fetched,displayed in the information_schema 
//print_r($col);
 $i++; //start from zero
//if($i<0){ continue; }
echo '<tr> <td>'.$col[0].'</td> <td class="sr">';
if("P"==$row[$i]){ echo "Present"; 
}elseif("A"==$row[$i]){ echo "Absent";
}elseif("O"==$row[$i]){ echo "OnDuty"; }
else{ echo $row[$i]; }
echo '</td> <td class="sr">'.$staff[$i].'</td> </tr>';
//column name as col and data as row
//$i++;
}
//for($i=2;$i<$count;$i++){
//}
}
else{
    echo '<tr><td colspan="3">0 results</td></tr>';
}

echo '</tbody> </table>';

?>

</div>

<!--side Nav -->
  <ul id="slide-out" class="sidenav fixed">
 <div class="user-view">
      <div class="background">
        <img src="images/imgt.jpg">
      </div>
 <h6 class="white-text"> <?php echo $_SESSION['attusername']; ?></h6> 
 <div id="ru" class="row"> <p><a href = "logout.php">Sign Out</a> </p>  <p id="delacc">Delete Account</p>
</div>
 </div>
             
<li class="nav-item"><a class="nav-link" href="main.php">Attendance</a></li>
<li class="nav-item"> <a class="nav-link" href="view.php">View</a> </li> 
<li class="nav-item active"> <a class="nav-link " href="register.php">Register</a> </li> 

         </ul><!--col acc-->
  

 <!-- Compiled and minified JavaScript -->
  <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>  -->
    <script src="js/materialize.js"></script>
    <script src="js/materialize.min.js"></script>
    		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function(){

$(".sr").click(function(){
var txt=$(this).text().toLowerCase();
$("tbody tr").filter(function(){
 $(this).toggle($(this).text().toLowerCase().indexOf(txt)>-1);
 }); //fl
}); //clk

}); //doc
</script>

    <script> document.addEventListener('DOMContentLoaded', function() {
M.AutoInit();
    var elems = document.querySelectorAll('.autocomplete');
options={'limit':7,'data':{
<?php
$sq= "SELECT distinct table_name from information_schema.columns where table_schema='Attendance' and table_name!='Staff' ";
$res = $conn->query($sq);
if ($res->num_rows > 0) {
while ($r = $res->fetch_array()){
  echo ' "'.$r[0].'": null, ';
}}
if(isset($conn)){
$conn->close();
}
?>
 }};
    var instances = M.Autocomplete.init(elems, options);


  });
 </script>
</body>
</html>
