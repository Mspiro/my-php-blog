<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/style.css" class="css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>

<body>

    <?php

    require_once('../includes/config.php');
    require_once('classes/class.user.php');
    require_once('classes/UserDB.php');


    if (isset($_POST['submit'])) {
        $email = trim($_POST['email']);
        if ($email) {
            try {

                $result = $UserDB->selectSingleUserByEmail($email);
                if ($result->email == $email) {

                    $sendMail = $UserDB->sendMail($result);
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
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Email</label><br>
            <input type="email" name="email" id="formGroupExampleInput" placeholder="Enter your email">
        </div>

        <input type="submit" name="submit" id="submit" value="Send Mail" />
    </form>
</body>

</html>