<?php 

    $dbhost = "127.0.0.1:3306";
    $dbuser = "root";
    $dbpass = "";
    $database = "dblab8";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $database);

    if ($conn -> connect_error){
        printf("Connection failed: ",$conn ->connect_error);
        exit();
    }

    // echo "connection estd";

?>
