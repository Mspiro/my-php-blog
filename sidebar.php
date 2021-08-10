<div class="sidebar">
    <h2>Recent Articles</h2>
    <?php
    $sidebar = $db->query('SELECT articleTitle, articleSlug FROM article ORDER BY articleId DESC LIMIT 6');
    while ($row = $sidebar->fetch()) {
        echo ' <a href="./' . $row['articleSlug'] . '" >' . $row['articleTitle'] . ' </a >';
    }
    ?>


    <h2>Categories</h2>

    <?php
    $stmt = $db->query('SELECT categoryName, categorySlug FROM category ORDER BY categoryId DESC');
    while ($row = $stmt->fetch()) {
        echo '<a href="./category/' . $row['categorySlug'] . '">' . $row['categoryName'] . '</a>';
    }
    ?>

    <h2>Tags </h2>
    <?php
    $tagsArray = [];
    $stmt = $db->query('SELECT distinct LOWER(articleTags) as articleTags from article where articleTags != "" group by articleTags');
    while ($row = $stmt->fetch()) {
        $parts = explode(',', $row['articleTags']);
        foreach ($parts as $tag) {
            $tagsArray[] = $tag;
        }
    }

    $finalTags = array_unique($tagsArray);
    foreach ($finalTags as $tag) {
        echo "<a href='./tag/" . $tag . "'>" . ucwords($tag) . "</a>";
    }

    ?>


</div>