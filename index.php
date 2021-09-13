<?php include_once("includes/config.php"); ?>
<?php require_once("head.php"); ?>
<title>Blog</title>

<?php include("header.php"); ?>
<body>

    <div class="container">
        <div style="border: 2px solid black; margin:20px 0;">
       <?php include('carousel.php');?>
       </div>
        <div class="content">
            <?php
            try {
                $stmt = $db->query('SELECT articleId, articleTitle, articleSlug, articleDescrip, articleDate, articleTags,userid FROM article ORDER BY articleId DESC');

                while ($row = $stmt->fetch()) {

                    $auther = $db->query("SELECT username FROM users where userid='" . $row['userid'] . "'");
                    $autherName = $auther->fetch(PDO::FETCH_ASSOC);
                    echo '<div class="box">';
                    echo '<h1><a href="' . $row['articleSlug'] . '" style="text-decoration:none;">' . $row['articleTitle'] . '</a></h1>';
                    echo "<strong>Auther: </strong>" . $autherName['username'];

                    echo '<hr>';
                    //Display the date 

                    echo '<p>Posted on ' . date('jS M Y ', strtotime($row['articleDate']));


                    echo '</p>';
                    echo '<p>' . $row['articleDescrip'] . '</p>';
                    echo '<p><button class="readbtn"><a href="' . $row['articleSlug'] . '">Read More</a></button></p>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>


        </div>
    </div>

</body>
<?php //footer content 
include("footer.php");  ?>