<?php
session_start();
include 'pdo.php';
include 'user.php';
if(isset($_POST['change'])){
	if(isset($_SESSION["Email_address"])){
		$con= new DBConnector();
		$pdo=$con-> connectToDB();

		

		$user = new User();
		$user->setPassword($_POST['Password1']);
		$user->setPassword2($_POST['Password2']);
		$user->setEmail_address($_SESSION['Email_address']);

		 $user-> changePassword($pdo);
	}else{
		echo '<script>alert("Authentication Error. Log in again")</script>';
		echo '<script>window.location="login.php"</script>';
	}


	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change password</title>
</head>
<body>
	<form method="post" action="">
		<div style="padding: 5px">
			<label for="email_add">Old password:</label>
			<input type="password" name="Password1" id="Email_address">
		</div>
		<div style="padding: 5px">
			<label for="Email_address">New password:</label>
			<input type="password" name="Password2" id="Email_address">
		</div>
		<div style="padding: 10px">
			<input type="submit" name="change">
		</div>
	</form>
</body>
</html>