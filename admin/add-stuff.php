<?php
require_once('../includes/config.php');
require_once('classes/User.php');

if (!$User->is_logged_in()) {
 header('location:login.php');
}
?>
<?php include("head.php"); ?>
<title>Blog for Blogger</title>
<?php include("header.php"); ?>