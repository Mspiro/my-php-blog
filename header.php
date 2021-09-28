<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
 <link rel="stylesheet" type="text/css" href="./assets/css-min.css">
 <link rel="stylesheet" type="text/css" href="./assets/style.css">
 <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
 <title>Header</title>
</head>

<body>

 <?php include_once("includes/config.php"); ?>


 <ul class="ulclass">
  <li><a href="./">Home</a></li>
  <!-- <li><a href="">Menu</a></li>
  <li><a href="">Menu</a></li>
  <li><a href="">Menu</a></li>
  <li><a href="">Menu</a></li> -->

  <li class="logout-btn" style="float:right;"><a href="./admin/logout.php" style="color: red;">Logout</a></li>
  <li class="reg-log-btn" style="float: right;"><a class="" href="./admin/">Login</a></li>
  <li class="reg-log-btn" style="float: right;"><a class="" href="./register.php">Register</a></li>

 </ul>

 <script>
  const regLogBtn = document.querySelectorAll('.reg-log-btn');
  let logout = document.querySelector('.logout-btn');
  let login = <?php echo $_SESSION['loggedin'] ?>;
  let username = ' <?php echo strtoupper($_SESSION['username']) ?>';
  console.log(username);
  <?php
  // if(isset($_SESSION['loggedin'])){
  // echo '<script>console.log(login)</script>';

  // } else {
  // echo "session is not set";
  // }
  ?>

  console.log(login);
  // console.log(logout);
  // var isLoggin = 0;
  if (login) {
   regLogBtn[0].children[0].textContent = username;
   regLogBtn[1].style.display = 'none';
   logout.style.display = 'block';

  } else {
   // logout.style.display = 'none';
   console.log('logout button parynat pohachalo');
  }
 </script>
</body>

</html>