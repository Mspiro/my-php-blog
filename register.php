<?php
include_once("includes/config.php");
include_once("admin/classes/User.php");
require_once("head.php"); 
include("header.php"); ?>
<title>Blog</title>

<body>



  <?php
  if (isset($_POST['submit'])) {
    extract($_POST);

    if ($username == '') {
      $error[] = 'Please enter the username ';
    }

    if ($password == '') {
      $error[] = 'Please enter the password ';
    }

    if ($passwordConfirm == '') {
      $error[] = 'Please enter the password again ';
    }

    if ($password != $passwordConfirm) {
      $error[] = 'Password do not match ';
    }

    if ($email == '') {
      $error[] = 'Please enter the email address ';
    }

    if (!isset($error)) {
      try {
        $stmt = $User->addNewUser();
        if(isset($_SESSION)){
        header('location: ./admin/users-list.php?action=added');
      }
      else{
        // $User->login();
        // header('location: ./admin/index.php');
        // exit;
        header('location: ./admin/login.php');
        }
        exit;
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
  }
  if (isset($error)) {
    foreach ($error as $error) {
      echo '<p class="message">' . $error . '</p>';
    }
  }
  ?>

  <form action="" method="post" class="reg-form">
    <div class="from-content">
      <h1>Register Into Blog</h1>
      <div class="from">
        <div class="from-list">
          <input type="text" name="username" placeholder="Username" value="<?php if (isset($error)) {
                                                                              echo $_POST['username'];
                                                                            } ?>">
                                                                            <hr>
        </div>
        <div class="from-list">

          <input type="password" id="password" name="password" placeholder="Password" value="<?php if (isset($error)) {
                                                                                                echo $_POST['password'];
                                                                                              } ?>">
          <i class="far fa-eye r-p-pass-eye" id="togglePassword"></i>
          <hr>
        </div>
        <div class="from-list">

          <input type="password" id="confirmPassword" name="passwordConfirm" placeholder="Confirm Password" value="<?php if (isset($error)) {echo $_POST['passwordConfirm'];} ?>">
          <i class="far fa-eye r-c-pass-eye" id="togglePassword1"></i>
          <hr>
        </div>

        <div class="from-list">
          <input type="email" name="email" placeholder="Email" value="<?php if (isset($error)) {
                                                                        echo $_POST['email'];
                                                                      } ?>">
                                                                       <hr>
        </div>

        <div class="submit-btn">
          <input type="submit" name="submit" value="Sign In" />
        </div>

        <p class="tip signin-tip">
          <span>Already have an account?</span>
          <a href="./admin/login.php">Log in</a>
        </p>

      </div>
    </div>
  </form>
  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const togglePassword1 = document.querySelector('#togglePassword1');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirmPassword');

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