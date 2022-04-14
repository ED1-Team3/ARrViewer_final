<?php

   session_start();

      if(isset($_SESSION['userlogin'])){
         header("Location: portal.php");
         }
       require_once('config.php');
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link rel="stylesheet" href="assets/css/login.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>

<!----------------------------- LOGIN ------------------------------->

      <div class="wrapper">
         <a href="index.php" ><img src="assets/img/logo.png" alt="" class="centerLogo"></a>
         <div class="title-text">
            <div class="title login">
               LOG IN
            </div>
            <div class="title signup">
               SIGN UP
            </div>
         </div>
         <div class="form-container">
            <div class="slide-controls">
               <input type="radio" name="slide" id="login" checked>
               <input type="radio" name="slide" id="signup">
               <label for="login" class="slide login">Login</label>
               <label for="signup" class="slide signup">Signup</label>
               <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
               <form action="Login.php" class="login">
                  <div class="field">
                     <input type="email" name="email" id="email" placeholder="Email Address" required>
                  </div>
                  <div class="field">
                     <input type="password" minlength="5" id="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="pass-link">
                     <a href="forgot_pw.php">Forgot password?</a>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" id="Login2" value="Login">
                  </div>
                  <div class="signup-link">
                     Not a member? <a href="">Signup now</a>
                  </div>
               </form>

<!----------------------------- SIGNUP ------------------------------->

               <form action="Login.php" method="post" class="signup">
               <div class="field">
                     <input type="firstname" name="first_name" id="first_name" placeholder="First Name" required>
                  </div>
                  <div class="field">
                     <input type="lastname" name="last_name" id="last_name" placeholder="Last Name" required>
                  </div>
                  <div class="field">
                     <input type="email" name="email_signup" id="email_signup" placeholder="Email Address" required>
                  </div>
                  <div class="field">
                     <input type="password" minlength="5" id="password_signup" name="password_signup" placeholder="Password" required>
                  </div>
                  <div class="field">
                     <input type="password" minlength="5" name="confirm_password" id="confirm_password" placeholder="Confirm password" required>
                  </div>
                  <div class="field btn">
                     <div class="btn-layer"></div>
                     <input type="submit" id="register" name="create" value="Signup">
                  </div>
                  
               </form>
            </div>
         </div>
      </div>

<!----------------------------- JQUERY FOR LOG IN------------------------------->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript">


         $(function(){
               $('#Login2').click(function(e){

                  var valid = this.form.checkValidity();

                     if(valid){
                        var firstname      = $('#first_name').val();
                        var lastname      = $('#last_name').val();
                        var email = $('#email').val();
                        var password = $('#password').val();
                     }

                     e.preventDefault();

                     $.ajax({
                        type: 'POST',
                        url: 'jslogin.php',
                        data: {firstname: firstname, lastname: lastname, email: email,password: password},
                        success: function(data){
                           alert(data);
                           if($.trim(data) === "Login Successful"){
                              setTimeout(' window.location.href =  "portal.php"', 1000);
                           }
                        },
                        error: function(data){
                           alert('there were erros while doing the operation.');
                        }
                     });
               });
            });

</script>
<!----------------------------- JQUERY FOR SIGN UP ------------------------------->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript">


         $(function(){
            $('#register').click(function(e){

               var valid = this.form.checkValidity();
   
               if(valid){

               var firstname      = $('#first_name').val();
               var lastname      = $('#last_name').val();
               var email      = $('#email_signup').val();
               var password   = $('#password_signup').val();
               var confirm_password   = $('#confirm_password').val();

                  e.preventDefault();	

               $.ajax({
					type: 'POST',
					url: 'process.php',
					data: {firstname: firstname, lastname: lastname, email: email, password: password, confirm_password: confirm_password},

					success: function(data){
					Swal.fire({
								//'title': 'Successful!',
								'text': data,
								'type': 'success',
                        //'icon': 'success',
                        'confirmButtonColor':'#7a1111'
								})
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});				
			}else{			
			}
		});		
	});     
 </script>

 <!----------------------------- LOGIN / SIGNUP SLIDE ------------------------------->
      <script>
         const loginText = document.querySelector(".title-text .login");
         const loginForm = document.querySelector("form.login");
         const loginBtn = document.querySelector("label.login");
         const signupBtn = document.querySelector("label.signup");
         const signupLink = document.querySelector("form .signup-link a");
         signupBtn.onclick = (()=>{
           loginForm.style.marginLeft = "-50%";
           loginText.style.marginLeft = "-50%";
         });
         loginBtn.onclick = (()=>{
           loginForm.style.marginLeft = "0%";
           loginText.style.marginLeft = "0%";
         });
         signupLink.onclick = (()=>{
           signupBtn.click();
           return false;
         });
      </script>

   </body>
</html>