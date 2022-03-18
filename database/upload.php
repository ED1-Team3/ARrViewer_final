<?php 
session_start();
        $server = "localhost";
        $dbuser = "root";
        $pass = "root";
        $db = "model";
        // Database connection (server,username,password,database)
        $conn = new mysqli($server,$dbuser,$pass,$db);
        // Check connection
        if($conn === false){
            die("COULD NOT CONNECT. ".$conn->connect_error);
        }
        //echo $_SESSION['username'];  

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            if(is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['size'] < 4000000) {
                
                $imgData =addslashes(file_get_contents($_FILES['file']['tmp_name']));
                $imageProperties = getimageSize($_FILES['file']['tmp_name']);
                $username = $_SESSION['username']; 
                
                $sql = "INSERT INTO output_images(imageType, imageData, username)
                VALUES('{$imageProperties['mime']}', '{$imgData}', '{$username}')";
                $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Cannot insert file to the database<br/>" . mysqli_error($conn));
                if(isset($current_id)) {
                  
                    echo "Successfully upload";
                    header("Location: display.php?username=".$username);
                    //
                    
                }
            }
            else{
                echo "Please try again. Your AR file is over 4MB.";
                echo "";
            }
        }
        
    
    ?>
<!doctype html>
<html>
<head lang="en">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<meta charset="utf-8">
<title>Upload Project</title>
</head>
<body>
    <form name="frmImage" enctype="multipart/form-data" action="upload.php" method="post" class="frmImageUpload">
        <label>Please upload your glb file here to see your work:</label><br/>
        <input name="file" type="file" />
        <input type="submit" value="Submit"/>
    </form>
    
    <?php
    session_start();
    if (isset($_GET['username'])){
        $_SESSION['username'] = $_GET['username'];
    }
    ?>    
</body>
</html>
