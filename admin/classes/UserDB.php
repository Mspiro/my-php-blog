<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/blog/includes/config.php');

class UserDB
{

    function selectUserById($id){
        global $db; 

        global $db;
        $stmt = $db->prepare('SELECT * FROM users WHERE userid != :userid');
        $stmt->execute(array(':userid' => $id));
        $row = $stmt->fetchAll();
        return $row;

    }





}
$UserDB = new UserDB;

?>