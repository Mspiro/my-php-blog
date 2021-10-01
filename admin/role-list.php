<?php
require_once('../includes/config.php');
require_once('classes/User.php');
require_once('classes/Roles.php');

//if not logged in redirect to login page
if (!$User->is_logged_in()) {
 header('Location: login.php');
}

?>
<?php include("head.php");  ?>
<title>User Roles- Blog</title>
<?php include("header.php");  ?>

<div class="content">
 <?php
 if (isset($_GET['action'])) {
  echo '<h3>Role ' . $_GET['action'] . '.</h3>';
 }
 ?>

 <table>
  <tr>
   <th>Title</th>
  </tr>
  <?php
  try {

   $row = $Roles->selectAllRole();

   foreach ($row as $row) {
    echo '<tr>';
    echo '<td>' . $row['role'] . '</td>';
    echo '</tr>';
   }
  } catch (PDOException $e) {
   echo $e->getMessage();
  }
  ?>
 </table>

 <p><button class="editbtn"><a href='add-user-role.php'>Add New Role</a></button></p>
</div>
<?php include("footer.php");  ?>