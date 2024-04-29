<?php
   session_start();
if(!isset($_SESSION['attusername'])){
 die(header("location:index.php"));
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendance management</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
<style type="text/CSS">

#li{
 width: 100%;

}

body {
 background:  url("images/imgg.png") no-repeat center fixed;
 background-color: #ffffff;
 
height: 500px; /* You must set a specified height */
  
  background-size: cover; /* Resize the background image to cover the entire container */
}
.jumbotron{
opacity: 1.0;
 /* filter:  alpha(opacity=60);*/
  background-color: #ffffff;
 border-radius:7px;
  }
/*.jumbotron:hover{
opacity: 1.0;
  filter:  alpha(opacity=100);
}*/
#hd{
 text-align: center;
}
.er{
 /*overflow:scroll;*/
/* overflow-y:auto;*/
 max-height:300px;
 overflow-x:auto;
 width:90%;
 margin: auto;
}

.navbar{
opacity: 0.8;
}
.navbar:hover{
opacity: 1.0;
}
#ru{
position:relative;
}
#delacc{
position:absolute;
right:0px;
color:grey;
}
</style>
 
 </head>
<body>
  <div class="container">
  <br>
  
    <div class="jumbotron">
        <div class="panel panel-default">
     <div class="panel-heading">
  <strong> <h2 id="hd" >Student Details</h2></strong>
              </div>
              <div class="panel-body">

                  <form id="fg" class="form-horizontal" role="form" method="POST"  >
                    <div class="form-group">
                    
 <h5>Register Number</h5>
<input type="number" id="rg" name="Reg"  pattern="[0-9]{12}" placeholder="" required>

  <h5>Student Name</h5>
<!-- [a-z]{3,30}[A-Z]{2,3}[\s.]{1,2}-->
<input id="nm" type="text" name="Name" pattern="[a-zA-Z\s.]{5,30}" title="enter only text" placeholder=" " required>
                              <h4>Batch</h4>

<!-- Grid row -->
<div class="row"> 
  <!-- Grid column --> 
<div class="col"> 
  <!-- Material input -->
   <div class="md-form mt-0"> 
  <input type="number" class="form-control" name="bts" placeholder="First year">
    </div> 
</div> <!-- Grid column -->
 <!-- Grid column -->
  <div class="col">
   <!-- Material input -->
     <div class="md-form mt-0"> 
    <input type="number" class="form-control" name="btl" placeholder="Last year"> 
     </div> 
  </div> <!-- Grid column --> 
</div> <!-- Grid row -->

<h4>Department</h4>
<div class="input-field col s12" >  <!--  -->
   <select name="sec">
<option value="" disabled selected hidden>Select Section</option>
   <optgroup label="CSE">
<option  value="CSEA">CSE-A</option>
<option  value="CSEB">CSE-B</option>
      </optgroup>
      <optgroup label="ECE">
<option value="ECEA">ECE-A</option>
<option value="ECEB">ECE-B</option>
      </optgroup>
    <optgroup label="EEE">
<option value="EEEA">EEE-A</option>
<option value="EEEB">EEE-B</option>
      </optgroup>
      <optgroup label="MECH">
<option value="MECHA">MECH-A</option>
<option value="MECHB">MECH-B</option>
   </optgroup>
      <optgroup label="CIVIL">
<option value="CIVILA">CIVIL-A</option>
<option value="CIVILB">CIVIL-B</option>
    </optgroup>
 <optgroup label="MBA">
<option value="MBAA">MBA-A</option>
<option value="MBAB">MBA-B</option>
</select>
      </optgroup>
    </select>
  </div> <!--  -->
             <div class="panel-footer">
        <!--   btn-primary -->
                   <button id="submit" type="submit" class="btn "  value="Submit">Submit</button>
             </div>
         </form>
     </div>
    </div>
   </div>
 </div>

<!--side Nav -->
  <ul id="slide-out" class="sidenav fixed">
 <div class="user-view">
      <div class="background">
        <img src="images/imgt.jpg">
      </div>
 <h5 class="white-text" ><?php echo $_SESSION['attusername']; ?></h5> 
 <div id="ru" class="row"> <p><a href = "logout.php">Sign Out</a> </p>  <p id="delacc">Delete Account</p>
</div>
 </div>
             
<li class="nav-item"><a class="nav-link" href="main.php">Attendance</a></li>
<li class="nav-item"> <a class="nav-link" href="view.php">View</a> </li> 
<li class="nav-item active"> <a class="nav-link " href="register.php">Register</a> </li> 

         </ul><!--col acc-->
  
<script>
$(document).ready(function() { 
 $("#submit").click(function(e){
   e.preventDefault();
var zn =$('[name=Name]').val();
var zd =$('[name=sec]').val();
var zr =$('[name=Reg]').val();
var bts =$('[name=bts]').val();
var btl =$('[name=btl]').val();
if (zn.length>4 && zd.length>3 && zd.length<7 && bts.length==4 && btl.length==4 && zr.length==12 ){
 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{Name:zn,sec:zd,reg:zr,bs:bts,bl:btl,a:"create"},
    
    success: function(data){
    if (data !=="") {
        alert(data);
     }
     if (data =="") {
     $("#nm").val(""); 
     $("#rg").val(""); 
     }
    }//suc
    });//aj
    }//if
  });//clk
  
 $("#li").click(function(){
   
var zd =$('[name=sec]').val();
var bts =$('[name=bts]').val();
var btl =$('[name=btl]').val();

 $.ajax({
    type: "POST",
    url: 'fl.php',
    data:{sec:zd,bs:bts,bl:btl,a:"select"},
    success: function(data){
      $("#rc").html(data);
    }//suc
    });//aj
  });//clk
  

});//doc


</script>


 <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


 <script>
 document.addEventListener('DOMContentLoaded', function() {
M.AutoInit();
  });

</script>


   <!-- btn-primary -->

<!-- Modal Trigger -->
  <button id="li" class="waves-effect waves-light btn modal-trigger btn-lg btn-block" href="#modal1">Last inserted</button>

  <!-- Modal Structure -->
  <div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Recent records</h4>
      <span id="rc"></span>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>
     
</body>
</html>
