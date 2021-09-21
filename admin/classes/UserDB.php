<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/blog/includes/config.php');

class UserDB
{
    // user Table

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

    function addNewUser()
    {
        global $db;
        extract($_POST);
        $password = md5($password);
        $stmt = $db->prepare("INSERT INTO users(username,password,email, roleid) VALUES('$username', '$password', '$email', 3 )")->execute();

        $userid = $db->lastInsertId();

        $stmt = $db->prepare("INSERT INTO user_profile( userid, email) VALUES( '$userid','$email' )")->execute();

        $profileid = $db->lastInsertId();

        $stmt = $db->prepare("UPDATE  users SET 	profileid='$profileid' where userid= '$userid' ")->execute();
    }

    function delUserById($id)
    {
        global $db;
        $stmt = $db->query("DELETE FROM users WHERE userid='" . $id . "' ")->fetch();
    }


    // user_profile Table

    function selectUserDetailsById($id)
    {
        global $db;
        $profile = $db->query("SELECT * FROM user_profile where userid='" . $id . "'")->fetch();
        return $profile;
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

    function delUserProfileById($id)
    {
        global $db;
        $stmt = $db->query("DELETE FROM user_profile WHERE userid='" . $id . "' ")->fetch();
    }



    // role Table

    function selectAllRole()
    {
        global $db;
        $roles = $db->query("SELECT * FROM role")->fetchAll();
        return $roles;
    }

    function selectRoleByUser($id)
    {
        global $db;
        $role = $db->query("SELECT * FROM role where roleid='" . $id . "'")->fetch();
        return $role;
    }

    function addNewRole()
    {
        global $db;
        extract($_POST);
        $stmt = $db->prepare("INSERT INTO role (role) VALUES ('$role')")->execute();
    }
}
$UserDB = new UserDB;
