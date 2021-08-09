<?php
include('add-stuff.php');
?>
<?php 
if(isset($_GET['id'])){
    
        if(!$_GET['id'] !='1'){
            $stmt = $db->query("DELETE FROM article WHERE articleId='".$_GET['id']."' ")->fetch(PDO::FETCH_OBJ);
        }
}
header('location:index.php');
?>


