<?php
include('add-stuff.php');
?>
<?php
if (isset($_GET['id'])) {
    $stmt = $db->query("DELETE FROM users WHERE userid='" . $_GET['id'] . "' ")->fetch(PDO::FETCH_OBJ);
    $stmt = $db->query("DELETE FROM user_profile WHERE userid='" . $_GET['id'] . "' ")->fetch(PDO::FETCH_OBJ);
}
header('location:index.php');
?>