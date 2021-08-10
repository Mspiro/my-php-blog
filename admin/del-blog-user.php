<?php
include('add-stuff.php');
?>
<?php

if (isset($_GET['id'])) {
    $stmt1 = $db->query("SELECT COUNT(userid) as count FROM users")->fetch(PDO::FETCH_OBJ);
    if ($stmt1->count > 1) {
        if (!$_GET['id'] != '1') {
            echo $_GET['id'];
            $stmt = $db->query("DELETE FROM users WHERE userid='" . $_GET['id'] . "' ")->fetch(PDO::FETCH_OBJ);
            echo "deleted";
        }
    } else {
        header('location:blog-users.php');
    }
    header('location:blog-users.php');
}
?>

