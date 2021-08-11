<?php
include('add-stuff.php');
?>
<?php
if (isset($_GET['id'])) {
    $stmt = $db->query("DELETE FROM article WHERE articleId='" . $_GET['id'] . "' ")->fetch(PDO::FETCH_OBJ);
}
header('location:index.php');
?>


