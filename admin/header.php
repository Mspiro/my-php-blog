<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="http://localhost/blog/assets/css-min.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/blog/assets/style.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/main.css">

  <title>Header</title>
</head>
<?php
require_once('classes/User.php');
$userid = $_SESSION['userid'];
$user = $User->selectSingleUserById($userid);
?>

<body>
  <ul class="ulclass">
    <li><a href="../">Home</a></li>
    <?php
    if ($user['roleid'] == 2 || $user['roleid'] == 1) {
      echo '
          <li><a href="index.php">My Articles</a></li>
         <li> <a href="add-article.php">Add New Post </a></li>
          ';
    }
    if ($user['roleid'] == 1) {
      echo '
         <li> <a href="add-user-role.php">Add New Role</a></li>
          <li><a href="role-list.php">View Roles </a></li>
          <li><a href="users-list.php">View Users </a></li>
          <li><a href="my-profile.php?id='.$userid.'">Profile</a></li>
          '; }
          ?>
          
          <div class="nav-item-right" style="float: right;">
          <li><a href="logout.php" style="color: red;">Logout</a></li>
    </div>
  </ul>
</body>
</html>