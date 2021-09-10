<?php
require_once('../includes/config.php');
require_once('classes/class.user.php');

if ($user->is_logged_in()) {
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
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if ($username && $password) {
            try {
                $password = md5($password);
                $result = $db->query("SELECT username, password,userid FROM users WHERE username='" . $username . "' and password='" . $password . "'")->fetch(PDO::FETCH_OBJ);
                if ($result->username == $username and $result->password == $password) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    // $GLOBALS['loggedin'] = true;
                    // $GLOBALS['username'] = $result->username;
                    $_SESSION['username'] = $result->username;
                    $_SESSION['userid'] = $result->userid;
                    header('location:index.php');
                    exit;
                } else {
                    echo "<p class='invalid'>Invalid Username or Password </p>";
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
        <label>Username</label>
        <input type="text" name="username" value="" require />

        <br>

        <label>Password</label>
        <input type="password" name="password" value="" require />

        <br>

        <label></label>
        <input type="submit" name="submit" value="Sign In" />
    </form>
    <h3 class="form">
        <a href="send-mail.php" style="margin: 10px;">Forgot Passward?</a>
        <a href="../register.php" style="margin: 10px;">New User</a>
    </h3>
</body>

</html>