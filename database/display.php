<!doctype html>
<html>

<head>
    <title>3D Model AR</title>
    <meta charset="UTF-8" />

<!-- Import the component -->
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.js"></script>

<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>

<link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>

</head>

<body class="w-100 sans-serif bg-white"> 
        <?php
            session_start();
            require_once "../login/config.php"; 

            $email =  $_SESSION['userlogin'];
            // Get id to display the newest project
            $sql = "SELECT email, MAX(model_id) as model_id FROM Creator_Models WHERE email = '$email'";
            foreach($db->query($sql, PDO::FETCH_ASSOC) as $row){

                $_SESSION['id'] = $row['model_id'];
            }
            // Display newest project
            $id = $_SESSION['id'];
            $sql1 = "SELECT * FROM Creator_Models WHERE model_id = '$id'";
            foreach($db->query($sql1, PDO::FETCH_ASSOC) as $row){
                echo "<model-viewer ar ar-modes='webxr scene-viewer quick-look' camera-controls src='data:".$row["filetype"].";base64,".base64_encode($row['model_file'])."'>
                <button slot='ar-button' id='ar-button'>
                View in your space
                </button>
                "; 
            }
        ?>
<style>
body{
      overflow:hidden;
    font-family: -apple-system,BlinkMacSystemFont,avenir next,avenir,helvetica neue,helvetica,ubuntu,roboto,noto,segoe ui,arial,sans-serif;
}

article.pa3.pa5-ns {
    position: absolute;
}

model-viewer{
    position: absolute;
    width:100vw;
    height:100vh;
    margin: 0 auto;
}
</style>

</body>
