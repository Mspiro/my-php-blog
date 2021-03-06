<?php
include('add-stuff.php');
include("classes/Profile.php");
include("classes/Roles.php");


?>
<div class="content">
  <?php
  $userid = $_GET['id'];
  $profile  = $Profile->selectUserDetailsById($userid);
  $row = $User->selectSingleUserById($userid);
  if (isset($_POST['submit'])) {
    extract($_POST);

    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/blog/assets/img/userProfilePicture/";
    $fileName = basename($_FILES["displayProfile"]["name"]);
    $fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $fileName);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileName = md5(time()) . "." . $fileType;
    $targetFilePath = $uploadDir . $fileName;
    $fileTypes = array('jpg', 'png', 'jpeg');

    if ($firstName == '') {
      $error[] = 'Please enter the First Name ';
    }

    if ($middleName == '') {
      $error[] = 'Please enter the Middle Name ';
    }

    if ($lastName == '') {
      $error[] = 'Please enter the Last name ';
    }

    if ($mobile == '') {
      $error[] = 'Please enter your Mobile Number ';
    }

    if ($email == '') {
      $error[] = 'Please enter the email address ';
    }
    if ($city == '') {
      $error[] = 'Please enter the city';
    }
    if ($district == '') {
      $error[] = 'Please enter the District';
    }
    if ($state == '') {
      $error[] = 'Please enter the State';
    }
    if ($country == '') {
      $error[] = 'Please enter the Country';
    }

    if (!isset($error)) {
      try {
        move_uploaded_file($_FILES["displayProfile"]["tmp_name"], $targetFilePath);
        if (!isset($profile['userid'])) {
          $User->addUserProfile($fileName);
          header('location:users-list.php?action=added');
          exit;
        } else {
          $Profile->updateUserProfile($fileName);
          header('location:users-list.php?action=added');
          exit;
        }
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

  <form action="" method="post" enctype="multipart/form-data" class="form">
    <div class="from-content">
      <h1> Edit my Profile</h1>
      <div class="from">
        <div class="from-list">
          <input style="display:none" type="text" name="userid" value="<?php
                                                                        echo $row['userid'];
                                                                        ?>">
        </div>
        <div class="from-list">
          <input type="file" name="displayProfile" required>
        </div>

        <div class="from-list">
          <label for="">First Name:</label><br>
            <input type="text" name="firstName" value="<?php if (isset($profile['firstName'])) {
                                                          echo $profile['firstName'];
                                                        } ?>">
          
          <hr>
        </div>
        <div class="from-list">
          <label for="">Middle Name:</label><br>
            <input type="text" name="middleName" value="<?php if (isset($profile['middleName'])) {
                                                          echo $profile['middleName'];
                                                        } ?>">
        
          <hr>
        </div>
        <div class="from-list">
          <label for="">Last Name:</label><br>
            <input type="text" name="lastName" value="<?php if (isset($profile['lastName'])) {
                                                        echo $profile['lastName'];
                                                      } ?>">
          
          <hr>
        </div>
        <div class="from-list">
          <label for="">Mobile No:</label><br>
            <input type="text" name="mobile" value="<?php if (isset($profile['mobile'])) {
                                                      echo $profile['mobile'];
                                                    } ?>">
          
          <hr>
        </div>
        <div class="from-list">
          <label for="">Email:</label><br>
            <input type="text" name="email" value="<?php
                                                    echo $row['email'];
                                                    ?>" readonly>
          
          <hr>
        </div>
        <div class="from-list">
          <label for="">City:</label><br>
            <input type="text" name="city" value="<?php if (isset($profile['city'])) {
                                                    echo $profile['city'];
                                                  } ?>">
          
          <hr>
        </div>
        <div class="from-list">
          <label for="">District:</label><br>
            <input type="text" name="district" value="<?php if (isset($profile['district'])) {
                                                        echo $profile['district'];
                                                      } ?>">
          
          <hr>
        </div>
        <div class="from-list">
        <label for="">State:</label><br>
            <input type="text" name="state" value="<?php if (isset($profile['state'])) {
                                                      echo $profile['state'];
                                                    } ?>">
          
          <hr>
        </div>
        <div class="from-list">
          <label for="">Country:</label><br>
            <input type="text" name="country" value="<?php if (isset($profile['country'])) {
                                                        echo $profile['country'];
                                                      } ?>">
    <hr>  
      </div>
          <?php

          $id = $row['roleid'];
          $role = $Roles->selectRoleByUser($id);

          echo '<br><br><p><label for="">Current Role: ( ' . $role['role'] . ' )</label><br> ';

          $loggedInUser = $User->selectSingleUserById($_SESSION['userid']);

          if ($loggedInUser['roleid'] == 1) {
            $roles = $Roles->selectAllRole();
            $i = 1;
            echo 'New Role:<br>';
            foreach ($roles as $role) {
              echo '<div class="role">'.$i . ') <label for="role">' . $role['role'];
              echo ' <input class="radio-btn" type="radio" name="role" value="' . $role['roleid'] . '">&nbsp;&nbsp;&nbsp;&nbsp; </div>';
              $i++;
            }
          }
          ?>
          </p>
          <div class="submit-btn">
          <input type="submit" name="submit" value="Update" />
        </div>
        </div>
      </div>

  </form>
  <?php include("footer.php"); ?>
</div>
