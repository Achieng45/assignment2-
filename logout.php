<?php
if(isset($_POST["logout"])){
	session_start();
	include 'pdo.php';
	include 'user.php';

	$con= new DBConnector();
	$pdo=$con-> connectToDB();

	$user = new User();
	$user->logout($pdo);
}


?>