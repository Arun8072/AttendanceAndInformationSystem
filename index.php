<?php 
session_start();
$Error="";
   if($_SERVER["REQUEST_METHOD"] == "POST" || isset($_SESSION['attusername'])) {
      // username and password sent from form 
//if session not working at new device set session only once $_SESSION['attusername'] = "hisyd" and erase it $_SESSION['attusername'] = "";
      if(isset($_SESSION['attusername'])){
     $user =$_SESSION['attusername'];
     $pass =$_SESSION['attpassword'];
    }elseif(isset($_POST['username'])){
      $user =$_POST['username'] ;
      $pass =$_POST['password'];
      }else{
       $user =" ";
        $pass =" ";
      }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Attendance";

// Create connection
$conn = new  mysqli($servername, $username, $password,$dbname);

 // Check connection
if ($conn->connect_error) {
   die("Connection failed: "  . $conn->connect_error);
}
   
   $sql = "SELECT username,password FROM Staff";
$result = $conn->query($sql);
$pass=MD5(strval(trim($pass)));

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     if($row["username"]==$user){
        if($row["password"]==$pass){
   		if(!isset($_SESSION['attusername'])){
   		 $_SESSION['attusername'] = $user;
         $_SESSION['attpassword'] = $pass;
         }
        $conn->close();
         header("location:main.php");
       }//p if
       else{
      $Error="Usernameor Password may be incorrect";
      }
         $conn->close();
     }//u if
      else{
      $Error="Username or Password may be incorrect";
      }		if(isset($_SESSION['attpassword'])){
     if($_SESSION['attpassword']!==$row["username"]){
 $ses=True;
        }
    } 
    }//wh
    if(isset($ses) && $ses==True){
echo "Please ".$_SESSION['attusername']."<h2><a href = \"logout.php\">Sign Out</a></h2>";

//session_destroy();
        }
    }//res
 
   }//post if
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Teachers Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="css/util.css"> -->
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<style type="text/css">

</style>
</head>
<body>
	
	<div class="container-login100 p-l-55 p-r-55 p-t-80 p-b-30 mx-auto" style="background-image: url('images/bg-01.jpeg');">

		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form class="login100-form validate-form" method="POST">                      
                                             
                                                                        <span class="login100-form-title p-b-37">
					Login 
				</span>            
		<div class="container-login100-form-btn "> 
                                                                                
			</div>
							<div class="wrap-input100 validate-input m-b-20" data-validate="Enter username">
					<input class="input100" type="text" name="username" pattern="[a-zA-Z0-9\s]{6,20}"  placeholder="Username">
					<span class="focus-input100"></span>
				</div>              

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="password" placeholder="password">
					<span class="focus-input100"></span>
				</div>              

				<div class="container-login100-form-btn">
					<button type="submit" value="submit" class="login100-form-btn">
						Login
					</button>
				</div>


							
			</form>
<div class="container-login100-form-btn "> 
                          
                                                    <p><?php echo $Error; ?></p> 

                        
			</div>
<center><a href="timetable.html">Create User</a></center>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.js"></script>
	<script src="vendor/bootstrap/js/popper.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


</body>
</html>
