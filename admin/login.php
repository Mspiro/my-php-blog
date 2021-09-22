<?php
require_once('../includes/config.php');
// require_once('classes/User.php');
require_once('classes/User.php');

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
  <label>Username</label>
  <input type="text" name="username" require />

  <br>

  <label>Password</label>
  <input type="password" name="password" id="id_password" require />
  <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>

  <br>

  <label></label>
  <input type="submit" name="submit" value="Sign In" />
 </form>
 <h3 class="form">
  <a href="send-mail.php" style="margin: 10px;">Forgot Passward?</a>
  <a href="../register.php" style="margin: 10px;">New User</a>
 </h3>

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