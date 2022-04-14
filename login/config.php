<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "Arrviewer3!";
$db_name = "ArrViewer";
try {
    $db = new PDO("mysql:host=localhost;dbname=ArrViewer","root","Arrviewer3!");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}
catch (PDOException $err){
    echo "ERROR: Unable to connect: ".$err->getMessage();
}



?>




