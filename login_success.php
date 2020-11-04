<?php
session_start();
include 'pdo.php';
include 'user.php';

$con= new DBConnector();
$pdo=$con-> connectToDB();

$user = new User();
$user->setEmail_address($_SESSION["Email_address"]);
$results = $user-> getDetails($pdo);

if(isset($_POST["logout"])){
	$user->logout($pdo);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<body >
	<fieldset style="width: 300px;height: 550px; top: 50%;margin:0 auto;">
		
		<div style="padding: 5px">
			<p>Email address:<?php
			if(isset($_SESSION["Email_address"])
						){
							echo $_SESSION["Email_address"];
						}else{
							echo '<script>alert("Authentication Error. Log in again")</script>';
							echo '<script>window.location="login.php"</script>';
						}?>
				
			</p>
		</div>
		<div style="padding: 5px">
			<p>Name:<?php echo $results['First_name'];?></p>
		</div>
		<div style="padding: 5px">
			<p>Residence: <?php echo $results['Residence'];?></p>
		</div>
		<div style="padding: 5px">
			<a href="password_change.php">Change password</a>
		</div>
		<form action="logout.php" method="post">
			<div style="padding: 5px">
				<input type="submit" name="logout" value="Log Out">
			</div>
		</form>
	</fieldset>
</body>
</html>