<?php
require_once('../includes/config.php');

if (!$user->is_logged_in()) {
    header('location:login.php');
}
include("head.php");

?>

<title>My Profile</title>
<?php include("header.php"); ?>

<div class="content">
    <?php



    try {

        $stmt = $db->query("SELECT * FROM user_profile where profileid='" . $_GET['id'] . "' ");
        $profile = $stmt->fetch();

        $stmt1 = $db->query("SELECT * FROM users where userid='" . $profile['userid'] . "' ");
        while ($row = $stmt1->fetch()) {
            if (isset($profile['userid'])) {
                echo '<div> 
            <img src="/blog/assets/img/userProfilePicture/' . $profile['displayProfile'] . '" alt="There is no image" width="100" height="100">
             </div> ';





                echo '
             
             <h1> Name: ' . $profile['firstName'] . ' ' . $profile['middleName'] . ' ' . $profile['lastName'] . ' </h1>
             <h3>
        

                Mobile No:- ' . $profile['mobile'] . ' <br>
                Email:- ' . $profile['email'] . ' <br>
                Address:- ' . $profile['city'] . ', ' . $profile['district'] . ', ' . $profile['state'] . ' , ' . $profile['country'] . ' <br>
                
             </h3> 
             ';
                $role = $db->query("SELECT * FROM role where roleid='" . $row['roleid'] . "'")->fetch();

                echo '<h2> Role: ' . $role['role'] . '</h2>';
            } else {
                echo "<h1>You have to update your profile! Please check button down below </h1> ";
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    <p><button class="editbtn"><a href="edit-current-user.php?id=<?php echo $profile['userid']; ?>">Edit Profile</a></button></p>
</div>


<?php include("sidebar.php"); ?>
<?php include("footer.php"); ?>