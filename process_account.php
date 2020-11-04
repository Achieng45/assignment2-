<?php 
 include_once './pdo.php';
 include_once './user.php';




$First_name= $_POST['fname'];
$Second_name= $_POST['sname'];
$Email_address=$_POST['email'];

$Residence=$_POST['residence'];

$Password=$_POST['password'];

$con = new DBConnector();
$pdo = $con->connectToDB();


$user= new User();
$user->setFirst_name($First_name);
$user->setSecond_name($Second_name);
$user->setEmail_address($Email_address);
$user->setResidence($Residence);
$user->setPassword($Password);

 echo $user->register($pdo);

?>
            
 
