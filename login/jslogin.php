<?php
session_start();
require_once('config.php');

$email = $_GET['email'];
$password = $_GET['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM Creators WHERE email = ?";
$stmtselect  = $db->prepare($sql);

$result = $stmtselect->execute([$email]);

if($result){
	$stmtselect->fetch(PDO::FETCH_ASSOC);
	if($stmtselect->rowCount() > 0){
        if(password_verify($password, $hashed_password)) {
			echo 'Login Successful';
			$_SESSION['userlogin'] = $email;
        }
	}else{
		echo 'Invalid email or password. Try again.';		
	}
}else{
	echo 'There were errors while connecting to database.';
} 
?>