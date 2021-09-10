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
    echo '<div>';
    echo '<h1>' . $row['articleTitle'] . '</h1>';

    echo '<p>Posted on ' . date('jS M Y H:i:s', strtotime($row['articleDate'])) ;

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



    echo '<div> 
    <img src="/blog/assets/img/'.$row['articleImage'] .'" alt="There is no image" width="300" height="300">
     </div>';

    echo '<p >' . $row['articleContent'] . '</p>';

    echo '</div>';
    ?>


    <?php
    $baseUrl = "./";
    $slug = $row['articleSlug'];
    $articleIdc = $row['articleId'];


    ?>

    <!-- <p><strong>Share </strong></p>
    <ul>

      <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $baseUrl . $slug; ?>"> <img src="assets/icon/facebook.png" style="widht:50px; height:50px;"></a>

      <a target="_blank" href="http://twitter.com/share?text=Visit the link &url=<?php echo $baseUrl . $slug; ?>&hashtags=blog,technosmarter,programming,tutorials,codes,examples,language,development">
        <img src="assets/icon/twitter.png" style="width:50px; height:50px;"></a>

      <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $baseUrl . $slug; ?>"> <img src="assets/icon/linkedin.png" style="widht:50px; height:50px; "></a>

      <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo $baseUrl . $slug; ?>">
        <img src="assets/icon/pinterest.png" style="width:50px; height:50px;"></a>
    </ul> -->

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
  <!-- <?php include("sidebar.php"); ?> -->
</div>
<?php include("footer.php"); ?>

