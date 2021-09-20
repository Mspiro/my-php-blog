<?php include('add-stuff.php');
include('classes/Article.php');
include('sidebar.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['Yes'])) {
        $Article->deleteArticle($id);
        header('location:index.php');
        exit;

    } else if (isset($_POST['No'])) {

        header('location:index.php');

        exit;
    }
}





?>

<form action="" method="POST">
    Are you sure you want ot delete? <br>
    <button name="Yes" class="subbtn"> Yes</button>
    <button name="No" class="delbtn"> No</button>

</form>