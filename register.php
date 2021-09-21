<?php
include_once("includes/config.php");
include_once("admin/classes/UserDB.php");
?>
<?php require_once("head.php"); ?>
<title>Blog</title>

<body>

    <?php include("header.php"); ?>


    <!-- <div class="container"> -->

    <!-- <div class="content"> -->

    <?php
    if (isset($_POST['submit'])) {
        extract($_POST);

        if ($username == '') {
            $error[] = 'Please enter the username ';
        }

        if ($password == '') {
            $error[] = 'Please enter the password ';
        }

        if ($passwordConfirm == '') {
            $error[] = 'Please enter the password again ';
        }

        if ($password != $passwordConfirm) {
            $error[] = 'Password do not match ';
        }

        if ($email == '') {
            $error[] = 'Please enter the email address ';
        }

        if (!isset($error)) {
            try {
                $stmt = $UserDB->addNewUser();
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
    <form action="" method="post" class="account-forms">
        <h2>New Registration</h2>
        <p><label for="">Username</label><br>
            <input type="text" name="username" value="<?php if (isset($error)) {
                                                            echo $_POST['username'];
                                                        } ?>">
        </p>

        <p><label for="">Password</label><br>
            <input type="password" id="password" name="password" value="<?php if (isset($error)) {
                                                                            echo $_POST['password'];
                                                                        } ?>">
            <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
        </p>

        <p><label for="">Confirm Password</label><br>
            <input type="password" id="confirmPassword" name="passwordConfirm" value="<?php if (isset($error)) {
                                                                                            echo $_POST['passwordConfirm'];
                                                                                        } ?>">
            <i class="far fa-eye" id="togglePassword1" style="margin-left: -30px; cursor: pointer;"></i>
        </p>

        <p><label for="">Email</label><br>
            <input type="email" name="email" value="<?php if (isset($error)) {
                                                        echo $_POST['email'];
                                                    } ?>">
        </p>

        <button name="submit" class="subbtn" style="margin-top:50px;">Create Account</button>
        <br>
        <a href="./admin/login.php">Already have an account!</a>
    </form>
    <!-- </div> -->
    <?php include("footer.php"); ?>
    <!-- </div> -->


    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const togglePassword1 = document.querySelector('#togglePassword1');
        const password = document.querySelector('#password');
        const confirmPassword = document.querySelector('#confirmPassword');

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