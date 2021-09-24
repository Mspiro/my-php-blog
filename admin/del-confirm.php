<?php include('add-stuff.php');
include('classes/Article.php');
include('classes/Profile.php');
include('sidebar.php');

if (isset($_GET['id']) && isset($_GET['choice'])) {
 $id = $_GET['id'];
 $choice = $_GET['choice'];

 switch ($choice) {

  case "article":
   if (isset($_POST['Yes'])) {
    $Article->deleteArticle($id);
    header('location:index.php');
    exit;
   } else if (isset($_POST['No'])) {
    header('location:index.php');
    exit;
   }
   break;
  case "user":
   if (isset($_POST['Yes'])) {
    $User->delUserById($id);
    $Profile->delUserProfileById($id);
    header('location:users-list.php');
    exit;
   } else if (isset($_POST['No'])) {
    header('location:users-list.php');
    exit;
   }
   break;

  default:
   echo "Please provide right choice..!";
 }
}
?>

<form action="" method="POST">
 Are you sure you want ot delete? <br>
 <button name="Yes" class="subbtn"> Yes</button>
 <button name="No" class="delbtn"> No</button>

</form>