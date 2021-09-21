<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/blog/includes/config.php');

class UserDB
{
    
    function selectAllUsersById($id)
    {
        global $db;
        $stmt = $db->prepare('SELECT * FROM users WHERE userid != :userid');
        $stmt->execute(array(':userid' => $id));
        $row = $stmt->fetchAll();
        return $row;
    }

    function selectSingleUserById($id)
    {
        global $db;
        $row = $db->query("SELECT * FROM users where userid='" . $id . "'")->fetch();
        return $row;
    }


    function selectUserDetailsById($id)
    {
        global $db;
        $profile = $db->query("SELECT * FROM user_profile where userid='" . $id . "'")->fetch();
        return $profile;
    }

    function selectRoleByUser($id)
    {
        global $db;
        $role = $db->query("SELECT * FROM role where roleid='" . $id . "'")->fetch();
        return $role;
    }

    function addUserProfile($fileName)
    {
        global $db;

        extract($_POST);
        $stmt = $db->query("INSERT INTO user_profile(
            userid,firstName, middleName,lastName, displayProfile, mobile, email, city, district, state, country) VALUES('$userid', '$firstName', '$middleName', '$lastName', '$fileName', '$mobile','$email', '$city', '$district', '$state', '$country')")->fetch();
    }

    function updateUserProfile($fileName)
    {
        global $db;
        extract($_POST);
        $stmt = $db->prepare("UPDATE user_profile SET firstName='$firstName', middleName='$middleName',lastName='$lastName', displayProfile='$fileName', mobile='$mobile', email='$email', city='$city', district='$district', state='$state', country='$country' WHERE userid='$userid'")->execute();

        $stmt = $db->prepare("UPDATE users SET roleid='$role' WHERE userid='$userid'")->execute();
    }

    function selectAllRole(){
        global $db;
        $roles = $db->query("SELECT * FROM role")->fetchAll();
        return $roles;
    }


}
$UserDB = new UserDB;
