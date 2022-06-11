<?php
    $server = "localhost";
    $username = "root";
    $password = 'Atharva@123';
    $db = "bank";

    $con = mysqli_connect($server, $username, $password,$db,"3307");

    if(!$con){
        die("Connection Fail" . mysqli_connect_error());
    }
?>