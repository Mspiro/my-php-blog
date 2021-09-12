<?php
include('add-stuff.php');
?>
<?php include("sidebar.php"); ?>
<div class="content">
    <h2>Edit My Profile</h2>
    <?php

$stmt1 = $db->query("SELECT * FROM user_profile where userid='" . $_SESSION['userid'] . "' ");
$profile = $stmt1->fetch();

$stmt = $db->query("SELECT * FROM users  where userid='" . $_SESSION['userid'] . "' ");
$row = $stmt->fetch();

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
                    $stmt = $db->prepare('INSERT INTO user_profile(userid,firstName, middleName,lastName, displayProfile, mobile, email, city, district, state, country) VALUES(:userid, :firstName, :middleName, :lastName, :displayProfile, :mobile, :email, :city, :district,:state, :country)');
                    $stmt->execute(
                        array(
                            ':userid' => $userid,
                            ':firstName' => $firstName,
                            ':middleName' => $middleName,
                            ':lastName' => $lastName,
                            ':displayProfile' => $fileName,
                            ':mobile' => $mobile,
                            ':email' => $email,
                            ':city' => $city,
                            ':district' => $district,
                            ':state' => $state,
                            ':country' => $country
                        )
                    );
                }else{
                    $stmt = $db->prepare('UPDATE user_profile SET firstName=:firstName, middleName=:middleName,lastName=:lastName, displayProfile=:displayProfile, mobile=:mobile, email=:email, city=:city, district=:district, state=:state, country=:country WHERE userid=:userid');
                    $stmt->execute(
                        array(
                            ':userid' => $userid,
                            ':firstName' => $firstName,
                            ':middleName' => $middleName,
                            ':lastName' => $lastName,
                            ':displayProfile' => $fileName,
                            ':mobile' => $mobile,
                            ':email' => $email,
                            ':city' => $city,
                            ':district' => $district,
                            ':state' => $state,
                            ':country' => $country
                        )
                    );
                }
                header('location: blog-users.php?action=added');
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


    <form action="" method="post" enctype="multipart/form-data">

        <input style="display:none" type="text" name="userid" value="<?php
                                                                        echo $row['userid'];
                                                                        ?>">

        <input type="file" name="displayProfile" required>


        <p><label for="">First Name:</label><br>
            <input type="text" name="firstName" value="<?php if (isset($profile['firstName'])) {
                                                            echo $profile['firstName'];
                                                        } ?>">
        </p>

        <p><label for="">Middle Name:</label><br>
            <input type="text" name="middleName" value="<?php if (isset($profile['middleName'])) {
                                                            echo $profile['middleName'];
                                                        } ?>">
        </p>

        <p><label for="">Last Name:</label><br>
            <input type="text" name="lastName" value="<?php if (isset($profile['lastName'])) {
                                                            echo $profile['lastName'];
                                                        } ?>">
        </p>

        <p><label for="">Mobile No:</label><br>
            <input type="text" name="mobile" value="<?php if (isset($profile['mobile'])) {
                                                        echo $profile['mobile'];
                                                    } ?>">
        </p>

        <p><label for="">Email:</label><br>
            <input type="text" name="email" value="<?php
                                                    echo $row['email'];
                                                    ?>" readonly>
        </p>

        <p><label for="">City:</label><br>
            <input type="text" name="city" value="<?php if (isset($profile['city'])) {
                                                        echo $profile['city'];
                                                    } ?>">
        </p>

        <p><label for="">District:</label><br>
            <input type="text" name="district" value="<?php if (isset($profile['district'])) {
                                                            echo $profile['district'];
                                                        } ?>">
        </p>

        <p><label for="">State:</label><br>
            <input type="text" name="state" value="<?php if (isset($profile['state'])) {
                                                        echo $profile['state'];
                                                    } ?>">
        </p>

        <p><label for="">Country:</label><br>
            <input type="text" name="country" value="<?php if (isset($profile['country'])) {
                                                            echo $profile['country'];
                                                        } ?>">
        </p>

        <button name="submit" class="subbtn">Edit / Update Profile</button>
    </form>
</div>

<?php include("footer.php"); ?>