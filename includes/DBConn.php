<?php
// include("class_user.php");

class DBConn 
{
 public $db;
    function __construct()
    {
        ob_start();
        if(!isset($_SESSION)){
        session_start();
        }
        $host = "localhost";
        $uname = "root";
        $pass = "";
        $database = "blog";

        try {
            $this->db =  new PDO("mysql:host=$host; dbname=$database", $uname, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo "<p class='invalid'>Connection failed with database</p>";
        }

        date_default_timezone_set('Asia/Kolkata');

        include("class_user.php");

        $user = new User($this->db);

        include("functions.php");
    }
}


$db = new DBConn;
// print_r($db->db);
?>