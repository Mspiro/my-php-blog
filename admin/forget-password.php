<?php 
require_once('../includes/config.php');
require_once('classes/class.user.php');
?>
<head>
<link rel="stylesheet" type="text/css" href="http://localhost/blog/assets/style.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/blog/assets/css-min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
<div class="content">
    <h2>Edit User</h2>
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
                    $password = md5($password);
                    $id=$userid;
                    echo $id;
                    $stmt = $db->prepare('UPDATE users SET username= :username, password =:password, email = :email WHERE userid = :userid');
                    $stmt->execute(array(
                        ':username' => $username,
                        ':password' => $password,
                        ':email' => $email,
                        ':userid' => $userid,
                    ));
                    // echo 'Ethe tr pohachalo pn ethun pudh kay hotaye tuch bg ata ';
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
        $stmt = $db->prepare('SELECT userid, username, email FROM users WHERE userid=:userid');
        $stmt->execute(array(':userid' => $_GET['id']));
        $row = $stmt->fetch();

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    <form action="" method="post">

        <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">

        <p><label for="">Username</label><br>
            <input type="text" name="username" value="<?php echo $row['username']; ?>">
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
            <input type="email" name="email" value="<?php echo $row['email']; ?>">
        </p>

        <p><input type="submit" name="submit" class="editbtn" value="update"></p>
    </form>

</div>
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