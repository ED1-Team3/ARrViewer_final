<!-- Optional theme
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
 
<form id="register-form" role="form" autocomplete="off" class="form" method="post">    
  <div class="form-group">
<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
  <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
</div>
  </div>
  <div class="form-group">
<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
  </div>
  
  <input type="hidden" class="hide" name="token" id="token" value="">
</form>
 -->

<?php
    $conn=mysqli_connect('localhost:4306', 'root', '', "useraccounts");

    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $query = "select * from users where email='$email'";
        $run = mysqli_query($conn, $query);

        if(mysqli_num_rows($run)>0){
            $row=mysqli_fetch_array($run);
            $db_email = $row['email'];
            $db_id=$row['id'];
            $token = uniqid(md5(time()));
            $query="INSERT INTO password_reset(id,email,token) VALUES(NULL, '$email','$token')";

            if(mysqli_query($conn, $query)){
                $to = $db_email;
                $subject="Password reset link";
                $message = "Click <a href='https://YOUR_WEBSITE.com/reset.php?token=$token'>here</a> to reset your password.";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers = 'From: <demo@demo.com' ."\r\n";
                //mail($to, $subject, $message, $headers);

                $msg = "<div class='alert alert-success'> Password reset link has been sent to the email. </div>";
            }
            else{
                $msg = "<div class='alert alert-danger'>User not found.</div>";
            }
        }
        else {
            $msg = "ERROR";
        }
    }

?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Forgot Password</title>
      <link rel="stylesheet" href="assets/css/login.css">
      <link rel="stylesheet" href="assets/css/login.css?v=<?php echo time(); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>


<!----------------------------- FORGOT PW ------------------------------->

      <div class="wrapper">
         <a href="index.php" ><img src="assets/img/logo.png" alt="" class="centerLogo"></a>
        <br>
        <h2 class="forgot">FORGOT PASSWORD</h2>
          
         <div class="form-container">
            
            <div class="form-inner">
               <form method="post" class="login">
                  <div class="field">
                     <input type="email" name="email" id="email" placeholder="Email Address" required>
                  </div>

                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" name="submit" value="Submit">
                  </div>

               </form>
