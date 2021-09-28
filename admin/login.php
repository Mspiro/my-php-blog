<?php
require_once('../includes/config.php');
// require_once('classes/User.php');
require_once('classes/User.php');
// include_once('../header.php');

if ($User->is_logged_in()) {
  header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="assets/style.css" class="css">
  <link rel="stylesheet" href="../assets/style.css" class="css">
  <link rel="stylesheet" href="../assets/css-min.css" class="css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/main.css" class="css">
</head>

<body>
  <?php
  if (isset($_POST['submit'])) {
    extract($_POST);
    if ($username && $password) {
      try {
        $result = $User->login();
      } catch (PDOException $e) {
        // echo $e->getMessage();
      }
    } else {
      echo "<p class='invalid'>Please enter all credentials </p>";
    }
  }
  ?>

  <form action="" method="POST" class="form">
    <div class="from-content">
      <h1> Login into Blog</h1>
      <div class="from">
        <div class="from-list">
          <input type="text" name="username" placeholder="Username" require />
          <hr>
        </div>
        <div class="from-list">
          <input type="password" name="password" id="id_password" placeholder="Password" require />
          <i class="far fa-eye pass-eye" id="togglePassword"></i>
          <hr>
        </div>
        <p class="tip">
          <a href="send-mail.php">Forgot Passward?</a>
        </p>
        <div class="submit-btn">
          <input type="submit" name="submit" value="Sign In" />
        </div>
        <p class="tip signin-tip">
          <span>Don't have an account?</span>
          <a href="../register.php">Sign up</a>
        </p>
      </div>
    </div>
  </form>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#id_password');

    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>

</body>

</html>