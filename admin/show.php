<?php include_once("../includes/config.php");
include_once("classes/Article.php");

$id = $_GET['id'];

$row = $Article->selectArticleByArticleId($id);

?>

<?php include("head.php");  ?>

<title><?php echo $row['articleTitle']; ?></title>
<meta name="description" content="<?php echo $row['articleDescrip']; ?>">
<meta name="keywords" content="Article Keywords">

<?php include("header.php"); ?>
<div class="container">

 <div class="content">

  <?php
  echo '<div>';
  echo '<h1>' . $row['articleTitle'] . '</h1>';
  echo '<strong>Posted on: </strong> ' . date('jS M Y', strtotime($row['articleDate']));
  if (isset($row['articleEditDate']) && !($row['articleDate'] == $row['articleEditDate'])) {
   echo ' || <strong>Last Update: </strong>' . date('jS M Y ', strtotime($row['articleEditDate']));
  }

  echo '<hr>';
  echo '<div class="center"> 
    <img src="/blog/assets/img/articleImages/' . $row['articleImage'] . '" alt="There is no image" width="700" height="400">
     </div>';
  echo '<p >' . $row['articleContent'] . '</p>';
  echo '</div>';
  ?>


  <?php
  $baseUrl = "./";
  $slug = $row['articleSlug'];
  $articleIdc = $row['articleId'];
  $recom = $Article->selectNextArticle($articleIdc);
  ?>
  <br><br>
  <hr>
  <h2> Next Posts:</h2>
  <?php

  foreach ($recom as $row1) {
   echo '<h2 ><a class="title2" href="show.php?id=' . $row1['articleId'] . '" style="text-decoration:none;">' . $row1['articleTitle'] . '</a></h2>';
  }
  ?>

  <br><br>
  <hr>
  <h2> Previous Posts:</h2>
  <?php
  $previous = $Article->selectPreviousArticle($articleIdc);
  foreach ($previous as $row1) {
   echo '<h2 ><a class="title2" href="show.php?id=' . $row1['articleId'] . '" style="text-decoration:none;">' . $row1['articleTitle'] . '</a></h2>';
  }


  ?>

 </div>
 <?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); ?>