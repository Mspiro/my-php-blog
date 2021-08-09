<?php include_once("includes/config.php"); ?>
<?php require_once("head.php"); ?>
<title>Blog</title>

<?php  include("header.php"); ?>


<div class="container">
<?php include("sidebar.php");?>
<div class="content">
        <?php
            try {   
                    //selecting data by id 
               $stmt = $db->query('SELECT articleId, articleTitle, articleSlug, articleDescrip, articleDate, articleTags FROM article ORDER BY articleId DESC');

                while($row = $stmt->fetch()){
                    
                    echo '<div class="box">';
                        echo '<h1><a href="'.$row['articleSlug'].'" style="text-decoration:none;">'.$row['articleTitle'].'</a></h1>';
                        echo '<p>Tagged as: ';
                        $links = array();
                        $parts = explode(',', $row['articleTags']);
                        foreach ($parts as $tags)
                        {
                            $links[] = "<a href='tag/".$tags."'>".$tags."</a>";
                        }
                        echo implode(", ", $links);
                    echo '</p>'; 
                             echo '<hr>';
                      //Display the date 

                     echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['articleDate'])).' in ';

                    $stmt2 = $db->prepare('SELECT categoryName, categorySlug FROM category, cat_links WHERE category.categoryId = cat_links.categoryId AND cat_links.articleId = :articleId');
                    $stmt2->execute(array(':articleId' => $row['articleId']));

                    $catRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    $links = array();
                    foreach ($catRow as $cat){
                        $links[] = "<a href='category/".$cat['categorySlug']."'>".$cat['categoryName']."</a>";
                    }
                    echo implode(", ", $links);

                    echo '</p>';
                        echo '<p>'.$row['articleDescrip'].'</p>';                
                        echo '<p><button class="readbtn"><a href="'.$row['articleSlug'].'">Read More</a></button></p>';                
                    echo '</div>';

                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        ?>


</div>
</div>


<?php //footer content 
include("footer.php");  ?>
