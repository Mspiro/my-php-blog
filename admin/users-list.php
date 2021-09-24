<?php

require_once('../includes/config.php');
// require_once('classes/class.user.php');
require_once('classes/User.php');
require_once('classes/Roles.php');
require_once('classes/Profile.php');

if (!$User->is_logged_in()) {
 header('location: login.php');
}

?>

<?php include("head.php"); ?>

<title>Admin Page</title>

<?php include("header.php"); ?>

<?php //include("sidebar.php"); ?>
<div class="content">
 <?php
 if (isset($_GET['action'])) {
   if($_GET['action']=='added'){
  echo '<h3 style="color:Green;">User updated successfully..!</h3>';
   }else{
    echo '<h3 style="color:Green;">User added successfully..!</h3>';
   }
 }
 ?>

 <table>

  <tr>
   <th>UserName</th>
   <th>Full Name</th>
   <th>Role</th>
   <th>Update</th>
   <th>Delete</th>
  </tr>
  <?php
  try {
   $id = $_SESSION['userid'];

   $stmt = $User->selectAllUsersById($id);

   foreach ($stmt as $row) {

    $userid = $row['userid'];
    echo '<tr>';
    echo '<td> <a style="text-decoration:none; color:blue;" href="my-profile.php?id=' . $userid . '">' . ucwords($row['username']) . '</a></td>';

    $profile = $Profile->selectUserDetailsById($userid);

    if (isset($profile['firstName']) && isset($profile['lastName'])) {
     echo '<td> ' .ucwords($profile['firstName']) . ' ' . ucwords($profile['lastName']) . '</td>';
    } else {
     echo '<td> ' . ucwords($row['username']) . '</td>';
    }
    try {
     $roleid = $row['roleid'];
     $role = $Roles->selectRoleByUser($roleid);
     if(isset($role['role'])){
     echo '<td>' . $role['role'] . '</td>';
     }else{
      echo '<td> Unauthorized</td>';
     }
    } catch (PDOException $e) {
     echo '<td>NO Role Assign</td>';
    }

  ?>
    <td>
     <button class="editbtn">
      <a href="edit-current-user.php?id=<?php echo $row['userid']; ?>">Edit</a>
     </button>
    </td>
    <td>
     <button class="delbtn"><a href="del-confirm.php?id=<?php echo $row['userid']; ?>&choice=user">Delete</a></button>
    </td>

  <?php
    echo '</tr>';
   }
  } catch (PDOException $e) {
   echo $e->getMessage();
  }

  ?>
 </table>
 <p><button class="editbtn"><a href="../register.php">Add New User</a></button></p>
</div>


<?php include("footer.php"); ?>