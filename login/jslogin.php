<?php
session_start();
require_once('config.php');

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "SELECT * FROM Creators WHERE email = ?";
$stmtselect  = $db->prepare($sql);

// $firstname = $stmtselect[$firstname];

$result = $stmtselect->execute([$email]);
// $firstname= $stmtselect->execute([$firstname]);

if($result){
	$stmtselect->fetch(PDO::FETCH_ASSOC);
	if($stmtselect->rowCount() > 0){

        if(password_verify($password, $hashed_password)) {
            $_SESSION['userlogin'] = $email;
			// $firstname= $stmtselect->execute([$firstname]);
            // echo '1';
			echo 'Login Successful';
        }
	}else{
		echo 'There no user for that combo';		
	}
}else{
	echo 'There were errors while connecting to database.';
} 
?>