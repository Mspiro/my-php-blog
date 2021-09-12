<?php include_once("includes/config.php");

$stmt = $db->prepare('SELECT articleId,articleDescrip,articleTitle, articleSlug,  articleContent, articleDate, articleImage FROM article WHERE articleSlug = :articleSlug');
$stmt->execute(array(':articleSlug' => $_GET['id']));
$row = $stmt->fetch();

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
<div class="container">

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
            $addComment = $db->prepare('INSERT INTO comment (userid, articleId, comment) VALUES (:userid, :articleId, :comment)');
            $addComment->execute(array(
              ':userid' => $_SESSION['userid'],
              ':articleId' => $row['articleId'],
              ':comment' => $comment,
            ));

          } catch (PDOException $e) {
            echo $e->getMessage();
          }
        }
      }

      echo '<div>';
      echo '<h1>' . $row['articleTitle'] . '</h1>';
      
      echo '<p>Posted on ' . date('jS M Y H:i:s', strtotime($row['articleDate']));
      
      // $stmt2 = $db->prepare('SELECT categoryName, categorySlug FROM category,cat_links WHERE category.categoryId=cat_links.categoryId AND cat_links.articleId=:articleId');
      // $stmt2->execute(array(':articleId' => $row['articleId']));
      // $catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);
      // $links = array();
      // foreach ($catRow as $cat) {
        //   $links[] = "<a href='./" . $cat['categorySlug'] . "'>" . $cat['categoryName'] . "</a>";
        // }
        // echo implode(", ", $links);
        
        echo '</p>';
        echo '<hr>';
        
        if(isset($row['articleImage'])){
        echo '<div><h3>Article Image</h3> 
        <img src="/blog/assets/img/articleImages/' . $row['articleImage'] . '" alt="There is no image" width="300" height="300">
        </div>';
        }else{
          echo 'There is no image for this article';
        }
        
        echo '<hr><hr><h2> Aricle:</h2><p>' . $row['articleContent'] . '</p><hr><hr>';
        echo '<fieldset><h2> Article Comments: </h2>';

        try {
          $comments = $db->query("SELECT commentId, comment, userid FROM comment WHERE articleId='" . $row['articleId'] . "'")->fetchAll(PDO::FETCH_ASSOC);

          if(isset($comments['userid'])){
          
          $comm = array();
          $user = array();
          foreach($comments as $comment){
            $comm[] = $comment['comment'];
            $user = $db->query("SELECT firstName, lastName FROM user_profile WHERE userid='" . $comment['userid'] . "'")->fetch(PDO::FETCH_ASSOC);

            echo '<hr><h4>'. $user['firstName'].' '. $user['lastName'].':-</h4> ';
            echo $comment['comment'];
            echo '<br>';
          }

        }else{
          echo '<h4 class="invalid">No comments for this post</h4>';
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

      <p><label for=""><hr><br>Add New Comment</label><br>
        <input type="text" name="comment">
      </p>

      <p><input type="submit" name="submit" class="editbtn" value="Add Comment"></p>



    </form>

    <?php
    $baseUrl = "./";
    $slug = $row['articleSlug'];
    $articleIdc = $row['articleId'];

    ?>


    <h2> Recomended Posts:</h2>
    <?php
    $recom = $db->query("SELECT * from article where articleId>$articleIdc order by articleId ASC limit 5");

    while ($row1 = $recom->fetch()) {
      echo '<h2 ><a href="' . $row1['articleSlug'] . '" style="text-decoration:none;">' . $row1['articleTitle'] . '</a></h2>';
    }
    ?>
    <h2> Previous Posts:</h2>
    <?php
    $previous = $db->query("SELECT * from article where articleId<$articleIdc order by articleId DESC limit 5");
    while ($row1 = $previous->fetch()) {
      echo '<h2><a href="' . $row1['articleSlug'] . '" style="text-decoration:none;">' . $row1['articleTitle'] . '</a></h2>';
    }
    ?>

  </div>
</div>
<?php include("footer.php"); ?>