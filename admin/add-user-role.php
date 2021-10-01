<?php
require_once('../includes/config.php');
require_once('classes/User.php');
require_once('classes/Roles.php');


if (!$User->is_logged_in()) {
  header('Location: login.php');
}
?>
<?php include("head.php");  ?>
<title>Add New User Role</title>
<?php include("header.php");  ?>

<div class="content">

  <?php

  //if form has been submitted process it
  if (isset($_POST['submit'])) {

    $_POST = array_map('stripslashes', $_POST);

    //collect form data
    extract($_POST);

    //very basic validation
    if ($role == '') {
      $error[] = 'Please enter the Role.';
    }

    if (!isset($error)) {

      try {


        //insert into database

        $roleAdded = $Roles->addNewRole();


        //redirect to index page
        header('Location: role-list.php?action=added');
        exit;
      } catch (PDOException $e) {
        echo '<h1 class="invalid">This Role already exist.</h1>';
      }
    }
  }

  //check for any errors
  if (isset($error)) {
    foreach ($error as $error) {
      echo '<p class="message">' . $error . '</p>';
    }
  }
  ?>

  <form action="" method="post" class="form">
    <div class="from-content">
      <h1> Add New Role</h1>
      <div class="from">
      <div class="from-list">
        <input type='text' name='role' placeholder="Enter New Role" value='<?php if (isset($error)) {
                                                echo $_POST['role'];
                                              } ?>'>
                                              <hr>
        </div>
        <div class="submit-btn">
        <input type="submit" name="submit" value="Add Role">
        </div>
        </h2>
      </div>
    </div>
  </form>
</div>

<?php include("footer.php");  ?>