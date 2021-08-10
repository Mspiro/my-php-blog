<?php require('includes/config.php'); ?>

<?php include("head.php");  ?>

<title><?php echo htmlspecialchars($_GET['id']); ?>-Techno Smarter</title>
<?php include("header.php");  ?>
<div class="content">


    <p>Articles in tag:- <?php echo htmlspecialchars($_GET['id']); ?></p>
    <hr>


    <?php
    try {

        $stmt = $db->prepare('SELECT articleId, articleTitle, articleSlug, articleDescrip, articleDate, articleTags FROM article WHERE articleTags like :articleTags ORDER BY articleId DESC');
        $stmt->execute(array(':articleTags' => '%' . $_GET['id'] . '%'));
        while ($row = $stmt->fetch()) {

            echo '<div  class="box">';
            echo '<h1><a href="../' . $row['articleSlug'] . '">' . $row['articleTitle'] . '</a></h1>';
            echo '<p>Posted on ' . date('jS M Y H:i:s', strtotime($row['articleDate'])) . ' in ';

            $stmt2 = $db->prepare('SELECT categoryName, categorySlug FROM category, cat_links WHERE category.categoryId = cat_links.categoryId AND cat_links.articleId = :articleId');
            $stmt2->execute(array(':articleId' => $row['articleId']));

            $catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);

            $links = array();
            foreach ($catRow as $cat) {
                $links[] = "<a href='../category/" . $cat['categorySlug'] . "'>" . $cat['categoryName'] . "</a>";
            }
            echo implode(", ", $links);

            echo '</p>';
            echo '<p>Tagged as: ';
            $links = array();
            $parts = explode(',', $row['articleTags']);
            foreach ($parts as $tags) {
                $links[] = "<a href='" . $tags . "'>" . $tags . "</a>";
            }
            echo implode(", ", $links);
            echo '</p>';
            echo '<p>' . $row['articleDescrip'] . '</p>';
            echo '<p><button class="readbtn"><a href="../' . $row['articleSlug'] . '">Read More</a></button></p>';


            echo '</div>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    ?>
</div>
<?php include("sidebar.php");  ?>

<?php include("footer.php");  ?>