<?php 
require_once('../includes/config.php');
require_once('classes/class.user.php');
require_once('classes/UserDB.php');
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" type="text/css" href="http://localhost/blog/assets/style.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/blog/assets/css-min.css">
</head>
<body>

    <h2 class="account-forms" style="margin-top: 30vh;"> Change Password</h2>
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
                    
                    $result = $UserDB->editUser($userid);

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
        $row = $UserDB->selectSingleUserById($id);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    <form action="" method="post" class="account-forms" >

        <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">

        <p><label for="">Username</label><br>
            <input type="text" name="username" value="<?php echo $row['username']; ?>" readonly>
        </p>

        <p><label for="">Password</label><br>
            <input type="password" name="password" value="" id="password" >
            <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>


        </p>

        <p><label for="">Confirm Password</label><br>
            <input type="password" name="passwordConfirm" value="" id="confirm_password" >
            <i class="far fa-eye" id="togglePassword1" style="margin-left: -30px; cursor: pointer;"></i>

        </p>

        <p><label for="">Email</label><br>
            <input type="email" name="email" value="<?php echo $row['email']; ?>" readonly>
        </p>

        <p><input type="submit" name="submit" class="editbtn" value="update"></p>
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