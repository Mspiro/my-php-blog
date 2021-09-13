<?php include_once("../includes/config.php");

$stmt = $db->prepare('SELECT articleId,articleDescrip,articleTitle, articleSlug,  articleContent, articleDate,articleEditDate, articleImage FROM article WHERE articleSlug = :articleSlug');
$stmt->execute(array(':articleSlug' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
// if ($row['articleId'] == '') {
//   header('Location: ./');
//   exit;
// }
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
    echo '<strong>Posted on: </strong> ' . date('jS M Y', strtotime($row['articleDate'])) ;
    if(isset($row['articleEditDate']) && !($row['articleDate']==$row['articleEditDate'])){
      echo ' || <strong>Last Update: </strong>' . date('jS M Y ', strtotime($row['articleEditDate']));
  }

    // $stmt2 = $db->prepare('SELECT categoryName, categorySlug FROM category,cat_links WHERE category.categoryId=cat_links.categoryId AND cat_links.articleId=:articleId');
    // $stmt2->execute(array(':articleId' => $row['articleId']));
    // $catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    // $links = array();
    // foreach ($catRow as $cat) {
    //   $links[] = "<a href='./" . $cat['categorySlug'] . "'>" . $cat['categoryName'] . "</a>";
    // }
    // echo implode(", ", $links);

    // echo '</p>';
    echo '<hr>';



    echo '<div class="center"> 
    <img src="/blog/assets/img/articleImages/'.$row['articleImage'] .'" alt="There is no image" width="700" height="400">
     </div>';

    echo '<p >' . $row['articleContent'] . '</p>';

    echo '</div>';
    ?>


    <?php
    $baseUrl = "./";
    $slug = $row['articleSlug'];
    $articleIdc = $row['articleId'];


    ?>


    <!-- <br><br><hr>
    <h2> Recomended Posts:</h2>
    <?php
    $recom = $db->query("SELECT * from article where articleId>$articleIdc order by articleId ASC limit 5");

    while ($row1 = $recom->fetch()) {
      echo '<h2 ><a class="title2" href="' . $row1['articleSlug'] . '" style="text-decoration:none;">' . $row1['articleTitle'] . '</a></h2>';
    }
    ?>
    <br><br><hr>
    <h2> Previous Posts:</h2>
    <?php
    $previous = $db->query("SELECT * from article where articleId<$articleIdc order by articleId DESC limit 5");
    while ($row1 = $previous->fetch()) {
      echo '<h2 ><a class="title2" href="' . $row1['articleSlug'] . '" style="text-decoration:none;">' . $row1['articleTitle'] . '</a></h2>';
    }


    ?> -->

  </div>
  <?php include("sidebar.php"); ?>
</div>
<?php include("footer.php"); ?>

