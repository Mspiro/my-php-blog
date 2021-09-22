<?php

    ob_start();
    session_start();

    $host = "localhost";
    $uname = "root";
    $pass = "";
    $database = "blog";

    try{
        $db =  new PDO("mysql:host=$host; dbname=$database", $uname, $pass);
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $error){
        echo "<p class='invalid'>Connection failed with database</p>";
    }

    date_default_timezone_set('Asia/Kolkata');

    include("class_user.php");
    
    $UserDB=new UserDB($db);

    include("functions.php");
