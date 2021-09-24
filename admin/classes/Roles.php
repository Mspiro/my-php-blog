<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/blog/includes/config.php');
class Roles{
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

$Roles = new Roles;