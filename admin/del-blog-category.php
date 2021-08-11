<?php
include('add-stuff.php');
?>
<?php

if (isset($_GET['id'])) {
    $stmt = $db->query("DELETE FROM category WHERE categoryId='" . $_GET['id'] . "' ")->fetch(PDO::FETCH_OBJ);   
    header('location:blog-categories.php');
}
?>

