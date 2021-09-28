<?php
require_once('../includes/config.php');
// require_once('classes/class.user.php');
require_once('classes/User.php');
// require_once('../header.php');
?>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/blog/assets/style.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/blog/assets/css-min.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/blog/assets/css/main.css">
</head>

<body>

  <!-- <h2 class="account-forms" style="margin-top: 30vh;"> Change Password</h2> -->
  <?php


  if (isset($_POST['submit'])) {
    extract($_POST);

    if ($username == '') {
      $error[] = 'Please enter the username.';
    }

    if (strlen($password) > 0) {
      if ($password == '') {
        $error[] = 'Please enter the password.';
      }

      if ($passwordConfirm == '') {
        $error[] = 'Please enter the Confirm password.';
      }

      if ($password != $passwordConfirm) {
        $error[] = 'Password do not match.';
      }
    }

    if ($email == '') {
      $error[] = "Please enter the email address.";
    }

    if (!isset($error)) {
      if ($password) {
        try {

          $result = $User->editUser($userid);

          header('location:http://localhost/blog/admin/login.php');
          exit;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      } else {
        echo '<p class="invalid"><strong>Password Not set</strong></p>';
      }
    }
  }
  ?>
  <?php

  if (isset($error)) {
    foreach ($error as $error) {
      echo $error . '<br>';
    }
  }
  try {
    $id = $_GET['id'];
    $row = $User->selectSingleUserById($id);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  ?>

  <form action="" method="post" class="form">
    <div class="from-content">
      <h1>Change Password</h1>
      <div class="from">
        <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">
        <div class="from-list">
          <input type="text" name="username" placeholder="Username" value="<?php echo $row['username']; ?>" readonly>
          <hr>
        </div>

        <div class="from-list">
          <input type="password" name="password" placeholder="Password" value="" id="password">
          <i class="far fa-eye r-p-pass-eye " id="togglePassword" ></i>
          <hr>
        </div>

        <div class="from-list">
          <input type="password" name="passwordConfirm" placeholder="Confirm Password" value="" id="confirm_password">
          <i class="far fa-eye r-c-pass-eye" id="togglePassword1"></i>
          <hr>
        </div>

        <div class="from-list">
          <input type="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" readonly>
          <hr>
        </div>

        <div class="submit-btn">
          <p><input type="submit" name="submit" class="editbtn" value="update"></p>
        </div>

      </div>
    </div>
  </form>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const togglePassword1 = document.querySelector('#togglePassword1');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirm_password');

    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });

    togglePassword1.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmPassword.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>

</body>