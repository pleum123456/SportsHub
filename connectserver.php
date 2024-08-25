<?php
    $servername = "202.29.234.50";
    $username = "admin";
    $password = "Web3@ptc.ac.th";
    $mydb = "dbno013";

    $conn = mysqli_connect($servername, $username, $password, $mydb);
    mysqli_set_charset($conn, "utf8");
    
    if($conn -> connect_error){
        die("Connection failed: " . $conn -> connect_error);
    }
  
?>