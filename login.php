
<!DOCTYPE html>
<html>
<head>
<title>Creating a form</title>
<link rel="stylesheet" type="text/css" href="Login.css">
   </head>
<body>
	
	
					     	
					 </div>
	
	<div class="login-box">
		
 
    <h1>PLEASE LOG IN HERE</h1>
    <form action=""  method="POST">
<p>EMAIL_ADDRESS: </p>
    <input type="email" id="email" name="Email_address" placeholder="enter email" >

<p>PASSWORD:</p>
  <input type="password" id="password" name="Password" placeholder="enter password" >


<input type="submit" name="login" value="login" > 


<a href="create_account.php">Do you have an account?Sign up</a>
 
 
 
</form>
  
   

</div>
</body>
</html>




<?php 

include './pdo.php';
include './user.php';
if(isset($_POST['login'])){

		$con = new DBConnector();
		$pdo = $con->connectToDB();

		$user = new User();
		
		$user->setEmail_address($_POST['Email_address']);
		$user->setPassword( $_POST['Password']);

		echo $user->login($pdo);
	
}
 ?>








