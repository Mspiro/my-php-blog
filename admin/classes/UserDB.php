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

    function selectUserDetailsById($id){
        global $db;
        $profile = $db->query("SELECT * FROM user_profile where userid='" . $id. "'")->fetch();
        return $profile;        
    }

    function selectRoleByUser($id){
        global $db;
        $role = $db->query("SELECT * FROM role where roleid='" . $id . "'")->fetch();
        return $role;

    }

}
$UserDB = new UserDB;
