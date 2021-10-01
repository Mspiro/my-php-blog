<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/blog/includes/config.php');
class Profile
{


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
    $db->query("INSERT INTO user_profile(
             userid,firstName, middleName,lastName, displayProfile, mobile, email, city, district, state, country) VALUES('$userid', '$firstName', '$middleName', '$lastName', '$fileName', '$mobile','$email', '$city', '$district', '$state', '$country')")->fetch();
  }

  function updateUserProfile($fileName)
  {
    global $db;
    extract($_POST);
    $db->prepare("UPDATE user_profile SET firstName='$firstName', middleName='$middleName',lastName='$lastName', displayProfile='$fileName', mobile='$mobile', email='$email', city='$city', district='$district', state='$state', country='$country' WHERE userid='$userid'")->execute();

    $db->prepare("UPDATE users SET roleid='$role' WHERE userid='$userid'")->execute();
  }

  function delUserProfileById($id)
  {
    global $db;
    $db->query("DELETE FROM user_profile WHERE userid='" . $id . "' ")->fetch();
  }
}

$Profile = new Profile;
