<?php include_once("includes/config.php");
include_once("admin/classes/Article.php");
include_once("admin/classes/UserDB.php");

$id = $_GET['id'];

$row = $Article->selectArticleByArticleId($id);

$userid = $row['userid'];
$articleid = $row['articleId'];

$user =  $UserDB->selectSingleUserById($userid);

//if post does not exists redirect user.
if ($row['articleId'] == '') {
  header('Location: ./');
  exit;
}
?>

<?php include("head.php");  ?>

<title><?php echo $row['articleTitle']; ?></title>
<meta name="description" content="<?php echo $row['articleDescrip']; ?>">
<meta name="keywords" content="Article Keywords">

<?php include("header.php"); ?>
<div class="center">

  <div class="content">

    <?php
    if ($_SESSION) {
      if (isset($_POST['submit'])) {
        extract($_POST);

        if ($comment == '') {
          $error[] = 'Please enter comment first.';
        }
        if (!isset($error)) {
          try {
            $addComment = $Article->addComment($articleid);
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
        }
      }

      echo '<div >';
      echo '<h1>' . $row['articleTitle'] . '</h1>';
      if (isset($user['username'])) {
        echo "<strong>Author: </strong>" . $user['username'] . ', ';
      }

      echo '<strong> Posted on:</strong> ' . date('jS M Y', strtotime($row['articleDate']));
      if (isset($row['articleEditDate']) && !($row['articleDate'] == $row['articleEditDate'])) {
        echo ' <strong>Updated on: </strong>' . date('jS M Y ', strtotime($row['articleEditDate']));
      }

      echo '<hr>';

      if (isset($row['articleImage'])) {
        echo '<div class="center"> 
        <img src="/blog/assets/img/articleImages/' . $row['articleImage'] . '" width="700" height="400">
        </div>';
      }
      echo '<h2> Article:</h2><p>' . $row['articleContent'] . '</p><hr><hr>';
      echo '<fieldset><h2>Comments: </h2>';

      try {

        $comments = $Article->showComments($articleid);

        foreach ($comments as $comment) {
          $userid = $comment['userid'];

          $user = $UserDB->selectUserDetailsById($userid);
          echo '<hr><h4>' . $user['firstName'] . ' ' . $user['lastName'] . ':-</h4> ';
          echo $comment['comment'];
          echo '<br>';
        }
        echo '</fieldset>';
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      echo '</div>';
    } else {
      header('location:./register.php');
      exit;
    }

    ?>
    <form action="" method="post">

      <p><label for="">
          <hr><br>Add New Comment
        </label><br>
        <input type="text" name="comment">
      </p>

      <p><input type="submit" name="submit" class="editbtn" value="Add Comment"></p>

    </form>

    <h2> Recomended Posts:</h2>
    <?php

    $articleIdc = $row['articleId'];
    $recom = $Article->selectNextArticle($articleIdc);

    foreach ($recom as $row1) {
      echo '<h2 ><a href="show.php?id=' . $row1['articleId'] . '" style="text-decoration:none;">' . $row1['articleTitle'] . '</a></h2>';
    }
    ?>
    <h2> Previous Posts:</h2>
    <?php

    $previous = $Article->selectPreviousArticle($articleIdc);

    foreach ($previous as $row1) {
      echo '<h2><a href="show.php?id=' . $row1['articleId'] . '" style="text-decoration:none;">' . $row1['articleTitle'] . '</a></h2>';
    }
    ?>

  </div>
</div>
<?php include("footer.php"); ?>