<!DOCTYPE html>

<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Reset Password</title>
      <link rel="stylesheet" href="assets/css/login.css">
      <link rel="stylesheet" href="assets/css/login.css?v=<?php echo time(); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>


<!----------------------------- FORGOT PW ------------------------------->

      <div class="wrapper">
         <a href="index.php" ><img src="assets/img/logo.png" alt="" class="centerLogo"></a>
        <br>
        <h2 class="forgot">RESET PASSWORD</h2>
          
         <div class="form-container">
            
            <div class="form-inner">
               <form method="post" class="login">
               <div class="field">
                     <input type="password" name="password" id="password" placeholder="Email" required>
                  </div>
                  <div class="field">
                     <input type="password" name="password" id="password" placeholder="Password" required>
                  </div>
                  <div class="field">
                     <input type="confirm_password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                  </div>

                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" name="submit" value="Reset Password">
                  </div>

               </form>
