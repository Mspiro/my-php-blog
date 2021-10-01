<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="../assets/css/main.css" class="css">

</head>

<body>

  <?php

  require_once('../includes/config.php');
  require_once('classes/User.php');


  if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    if ($email) {
      try {

        $result = $User->selectSingleUserByEmail($email);
        if ($result->email == $email) {

          $sendMail = $User->sendMail($result);
        } else {
          echo "<p class='invalid'>This email is not registereed </p>";
        }
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    } else {
      echo "<p class='invalid'>Please enter all credentials </p>";
    }
  }
  ?>
  <form action="" method="POST" class="form">
    <div class="from-content">
      <h1>Forget Password</h1>
      <div class="from">
      <div class="from-list">

      <input type="email" name="email" id="formGroupExampleInput" placeholder="Enter your email">
      <hr>
      </div>
      <div class="submit-btn">
      <input type="submit" name="submit" id="submit" value="Send Mail" />
      </div>
      </div>
    </div>

  </form>
</body>

</html>