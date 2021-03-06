<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/blog/includes/config.php');
require_once($_SERVER["DOCUMENT_ROOT"] . '/blog/phpmailer/PHPMailerAutoload.php');

class User
{

 public function is_logged_in()
 {
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
   return true;
  }
 }

 public function logout()
 {
  session_destroy();
 }

 function login()
 {
  global $db;
  extract($_POST);
  $username = trim($username);
  $password = trim($password);
  $hashPassword = md5($password);

  $result = $db->query("SELECT * FROM users WHERE username='" . $username . "' and password='" . $hashPassword . "'")->fetch();

  if ($result['username'] == $username and $result['password'] == $hashPassword) {
   $_SESSION['loggedin'] = true;
   $_SESSION['username'] = $result['username'];
   $_SESSION['userid'] = $result['userid'];
   header('location:../index.php');
   exit;
  } else {
   echo "<p class='invalid'>Invalid Username or Password </p>";
  }
  return $result;
 }

 function sendMail($result)
 {
  $mail = new PHPMailer;
  $emailid = 'meeninath.dhobale@qed42.com';
  $password = 'z6jxakav9m';
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = $emailid;
  $mail->Password = $password;
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;
  $mail->setFrom($emailid, 'Blog');
  $mail->addAddress($result->email, $result->username);
  $mail->addReplyTo($emailid, 'Blog');
  $mail->isHTML(true);
  $mail->Subject = 'Change Password- Blog.com';
  $mail->Body = 'Hello ' . $result->username . '<br>For change your current password please click <a href="http://localhost/blog/admin/forget-password.php/?id=' . $result->userid . '">here</a>';

  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  if (!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
   header('location:login.php');
  }
  exit;
 }

 // user Table

 function selectAllUsersById($id)
 {
  global $db;
  $stmt = $db->prepare('SELECT * FROM users WHERE userid != :userid');
  $stmt->execute(array(':userid' => $id));
  $row = $stmt->fetchAll();
  return $row;
 }

 function selectSingleUserById($id)
 {
  global $db;
  $row = $db->query("SELECT * FROM users where userid='" . $id . "'")->fetch();
  return $row;
 }

 function selectSingleUserByEmail($email)
 {
  global $db;
  $result = $db->query("SELECT * FROM users where email='" . $email . "'")->fetch(PDO::FETCH_OBJ);
  return $result;
 }

 function addNewUser()
 {
  global $db;
  extract($_POST);
  $password = md5($password);
  $stmt = $db->prepare("INSERT INTO users(username,password,email, roleid) VALUES('$username', '$password', '$email', 3 )")->execute();

  $userid = $db->lastInsertId();

  $stmt = $db->prepare("INSERT INTO user_profile( userid, email) VALUES( '$userid','$email' )")->execute();

  $profileid = $db->lastInsertId();

  $stmt = $db->prepare("UPDATE  users SET profileid='$profileid' where userid= '$userid' ")->execute();
 }

 function delUserById($id)
 {
  global $db;
  $stmt = $db->query("DELETE FROM users WHERE userid='" . $id . "' ")->fetch();
 }

 function editUser($id)
 {
  global $db;
  extract($_POST);
  $password = md5($password);

  $stmt = $db->prepare("UPDATE users SET username= '$username', password ='$password', email = '$email' WHERE userid = '$id'")->execute();
 }

 // user_profile Table


 // role Table

 
}
$User = new User;
