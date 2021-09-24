<?php
require_once('../includes/config.php');
require_once('classes/User.php');
require_once('classes/Roles.php');
require_once('classes/Profile.php');



if (!$User->is_logged_in()) {
 header('location:login.php');
}
include("head.php");

?>

<title>My Profile</title>
<body>
  

<?php include("header.php"); ?>

<div class="content content-center">
 <?php
 $userid = $_GET['id'];

 try {

  $profile = $Profile->selectUserDetailsById($userid);



  $row = $User->selectSingleUserById($userid);

  if (isset($profile['userid'])) {
   $role = $Roles->selectRoleByUser($row['roleid']);

   echo '<div class="content-center"> <h1>My Profile: </h1>
            <img  class="content-center" src="/blog/assets/img/userProfilePicture/' . $profile['displayProfile'] . '" alt="There is no image" width="100" height="100">
             </div> 
             <h1> Name: ' . $profile['firstName'] . ' ' . $profile['middleName'] . ' ' . $profile['lastName'] . '</h1>
              <h3>
             Role: <span style="color:Gray;">' . $role['role'] . '</span>
              <br>
                Mobile No:- ' . $profile['mobile'] . ' <br>
                Email:- ' . $profile['email'] . ' <br>
                Address:- ' . $profile['city'] . ', ' . $profile['district'] . ', ' . $profile['state'] . ' , ' . $profile['country'] . ' <br>
                
             </h3> 
             ';
  } else {
   echo "<h1>You have to update your profile! Please check button down below </h1> ";
  }
  // }
 } catch (PDOException $e) {
  echo $e->getMessage();
 }
 ?>

 <p><button class="editbtn"><a href="edit-current-user.php?id=<?php echo $userid; ?>">Edit My Profile</a></button></p>
</div>


<?php // include("sidebar.php"); ?>
<?php include("footer.php"); ?>

</body>