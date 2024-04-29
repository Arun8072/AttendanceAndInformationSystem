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

<!-- main navbar of sidenav deleted for design-->
<!--side Nav-->
 <ul id="slide-out" class="sidenav fixed">
 
 <div class="user-view">
      <div class="background">
        <img src="images/imgt.jpg">
      </div>
 <li class="nav-item"> <a class="nav-link white-text" href="main.php">Attendance</a></li> <li class="nav-item active"> <a class="nav-link white-text" href="view.php">View</a> </li> <li class="nav-item active"> <a class="nav-link white-text" href="register.php">Register</a> </li> 
 </div>
 
 
  <!-- Grid column -->
<div id="rd" class="col-12">
   <!-- Default input --> 
  <form class="form-inline">
      <input class="form-control" type="search" id ="sh" placeholder="Search" aria-label="Search">
  </form> 
</div><!-- Grid column --> 
 <!--form tag for post of dept value-->

 <form method="post">
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
 <li>   <button name="submit" class="form-control-plaintext" type="submit"  value="<?php echo $fi."CSEB"; ?>">CSE-B</button></li>
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
  <input type="text" class="form-control input-sm" placeholder="Department" name=ckie value="'.$_POST['submit'].'" >
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

         
