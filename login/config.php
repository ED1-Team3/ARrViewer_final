<?php

// $db_host = "localhost";
// $db_user = "root";
// $db_pass = "Arrviewer3!";
// $db_name = "ArrViewer";
$db_host = "localhost:4306";
$db_user = "root";
$db_pass = "";
$db_name = "ArrViewer";

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_pass);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
}
catch (PDOException $err){
    echo "ERROR: Unable to connect: ".$err->getMessage();
}

?>




