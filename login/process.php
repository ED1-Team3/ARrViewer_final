<?php
require_once('config.php');


if(isset($_POST)){

	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];
	$email 			= $_POST['email'];
	$password 		= ($_POST['password']);
    $cpassword 		= ($_POST['confirm_password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // check if pws match
    if ($password == $cpassword){
        
        $sql = "INSERT INTO Creators (firstname, lastname, email, password ) VALUES(?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$firstname, $lastname, $email, $hashed_password]);
        
        if($result){
			echo 'Success! You can now log in.';
            }
		}        
    else{
		echo 'Passwords do not match. Please try again.';
		}
}else{
	echo 'No data';
}
?>
