<?php 
session_start();
require_once "../login/config.php"; 

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] < 4000000) {
                $email = $_SESSION['userlogin'];
            

                //$imgData = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                $imgData = file_get_contents($_FILES['file']['tmp_name']);
                $imageProperties = getimageSize($_FILES['file']['tmp_name']);
                $filename = $_FILES['file']['name'];

                $sql = "INSERT INTO Creator_Models (model_file, file_name, email, filetype ) VALUES(?,?,?,?)";
                $stmtinsert = $db->prepare($sql);
                $result = $stmtinsert->execute([$imgData, $filename, $email, $imageProperties['mime']]);

                if($result){
                    echo "Success! You can now log in.";             
                    header("Location: display.php");
                }else{
                    $_SESSION['error'] = "Cannot insert into the database.";
                }
            }
            else{
                $_SESSION['error'] = "Please try again. Your AR file is invalid.";
            }
        }
        
    
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Publish</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../login/css/main.css">
<!--===============================================================================================-->
</head>
<body>


 <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="../login/portal.php" class="logo"><img src="../login/assets/img/logo.png" alt=""></a>

            <nav id="navbar" class="navbar">
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
     <!-- Success or Error Notification -->
     <?php
        require_once "../login/config.php"; 
        if(isset($_SESSION['error'])){
            echo
            "<div class='alert alert-danger text-center'>".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        }
    ?>
	<div class="center">
	    <h1><strong>Upload your glb file here to see your work</strong></h1>
	</div>
    <div id="container" class="center">
        <form name="frmImage" enctype="multipart/form-data" action="upload.php" method="post">
               <label>Your glb file should be under 4MB.</label>
                <input id="center" name="file" type="file" />
                <input  class="btn btn-dark" id="center" type="submit" value="Submit"/>
        </form>

    </div>
    <section id="portal" class="d-flex align-items-center">
	</section>
    


	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<!--===============================================================================================-->
<style>
.center {
 text-align: center
}
#center {
  text-align: center;
  margin: auto;
}
</style>
</body>
</html>
