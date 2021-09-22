<?php
require_once('../includes/config.php');
require_once('classes/User.php');

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
   <!-- <th>Operation</th> -->
  </tr>
  <?php
  try {

   $row = $User->selectAllRole();

   foreach ($row as $row) {
    echo '<tr>';
    echo '<td>' . $row['role'] . '</td>';
  ?>

    <td>
     <!-- <button class="editbtn"> <a href="">Edit</a> </button> -->
     <!-- <button class="delbtn"> <a href="">Delete</a> </button> -->

    </td>

  <?php
    echo '</tr>';
   }
  } catch (PDOException $e) {
   echo $e->getMessage();
  }
  ?>
 </table>

 <p><button class="editbtn"><a href='add-user-role.php'>Add New Role</a></button></p>
</div>
<?php include("sidebar.php");  ?>
<?php include("footer.php");  ?>