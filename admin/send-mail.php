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


    if (isset($_POST['submit'])) {
        $email = trim($_POST['email']);
        if ($email) {
            try {
                $result = $db->query("SELECT email, userid, username FROM users WHERE email='" . $email . "'")->fetch(PDO::FETCH_OBJ);
                if ($result->email == $email) {
                    require '../phpmailer/PHPMailerAutoload.php';
                    $mail = new PHPMailer;
                    $emailid = 'meeninath.dhobale@qed42.com';
                    $password = 'z6jxakav9m';
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = $emailid;                 // SMTP username
                    $mail->Password = $password;                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to
                    $mail->setFrom($emailid, 'Blog');
                    $mail->addAddress($result->email, $result->username);     // Add a recipient                
                    $mail->addReplyTo($emailid, 'Blog');
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Change Password- Blog.com';
                    $mail->Body='<a href="http://localhost/blog/admin/forget-password.php/?id='.$result->userid.' ">here</a>';
                    // $mail->Body    = 'Hello ' .$result->username. ', <br>For change your current password click 
                    // <a href="forget-password.php?id=<?php echo $result->userid >" >here</a> ';
                    
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    if (!$mail->send()) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    } else {
                        header('location:login.php');
                    }
                    exit;
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
            <label for="formGroupExampleInput" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="formGroupExampleInput" placeholder="Enter your email">
        </div>

        <input type="submit" name="submit" id="submit" value="Send Mail" />
    </form>
</body>

</html>