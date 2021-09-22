<?php

require_once('../includes/config.php');
require_once('classes/User.php');
require_once('classes/Article.php');

if (!$User->is_logged_in()) {
 header('location: login.php');
}
?>

<?php include("head.php"); ?>

<title>Admin Page</title>
<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>
<div class="content">
 <?php
 if (isset($_GET['action'])) {
  echo '<h3>Post' . $_GET['action'] . '.</h3>';
 }
 ?>

 <table>

  <tr>
   <th>Article Title</th>
   <th>Updated On</th>
   <th>Update</th>
   <th>Delete</th>
  </tr>

  <?php
  try {
   $id = $_SESSION['userid'];
   $rows = $Article->selectArticleByUserid($id);

   foreach ($rows as $row) {
    echo '<tr>';
    echo '<td > <a style="text-decoration: none;
                color: blue;"  href="show.php?id=' . $row['articleId'] . '">' . $row['articleTitle'] . '</a></td>';
    echo '<td>' . date(' jS M Y', strtotime($row['articleEditDate'])) . '</td>';
  ?>
    <td>
     <button class="editbtn">
      <a href="edit-article.php?id=<?php echo $row['articleId']; ?>">Edit</a>
     </button>
    </td>
    <td>
     <button class="delbtn"><a href="del-confirm.php?id=<?php echo $row['articleId']; ?>&choice=article">Delete</a></button>

    </td>

  <?php
    echo '</tr>';
   }
  } catch (PDOException $e) {
   echo $e->getMessage();
  }

  ?>
 </table>
 <p><button class="editbtn"><a href="add-article.php">Add New Article</a></button></p>
</div>


<?php include("footer.php"); ?>