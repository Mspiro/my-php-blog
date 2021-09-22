<?php include_once("includes/config.php"); ?>
<?php require_once("head.php"); ?>
<title>Blog</title>

<?php include("header.php"); ?>

<body>

    <div style="padding-bottom:30px; border-bottom: 2px solid black; margin:10px; margin-bottom:30px;">
        <?php include('carousel.php'); ?>
    </div>
    <div class="container">


        <div>
            <?php
            $perPageRecord = 4;
            $pageNo = 0;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                if ($page == 0 || $page == 1) {
                    $pageNo = 0;
                } else {
                    $pageNo = ($page * $perPageRecord) - $perPageRecord;
                    // if($pageNo<0){
                    //     $pageNo = 0;
                    // }
                }
            }
            try {

                $stmt = $db->query('SELECT articleId, articleTitle, articleSlug, articleDescrip, articleDate,articleEditDate, articleTags,userid FROM article ORDER BY articleId DESC LIMIT ' . $pageNo . ',4');

                while ($row = $stmt->fetch()) {

                    $auther = $db->query("SELECT username FROM users where userid='" . $row['userid'] . "'");
                    $autherName = $auther->fetch(PDO::FETCH_ASSOC);
                    echo '<div class="box">';
                    echo '<h1 class="title"><a href="' . $row['articleId'] . '" style="text-decoration:none;">' . $row['articleTitle'] . '</a></h1>';
                    echo '<hr>';
                    if (isset($autherName['username'])) {
                        echo "<strong>Author: </strong>" . $autherName['username'];
                    }
                    echo ' <strong>Posted on: </strong>' . date('jS M Y ', strtotime($row['articleDate']));

                    if (isset($row['articleEditDate'])) {
                        echo ' <strong>Updated on: </strong>' . date('jS M Y ', strtotime($row['articleEditDate']));
                    }

                    echo '<hr>';

                    echo '<p>' . $row['articleDescrip'] . '</p>';
                    echo '<p><button class="readbtn"><a href="' . $row['articleSlug'] . '">Read More</a></button></p>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            ?>

        </div>

        <div class="center space">

            <?php
            $totalRecords = $db->query('select count(*) from article')->fetchColumn();
            $perPageRecord = 4;
            $numberOfPages = ceil($totalRecords / $perPageRecord);
            // $i=0;
            echo '<a style="padding: 0 15px;" href="index.php?page=0">First</a>';
            for ($i = 1; $i <= $numberOfPages; $i++) {

            ?> <a  href="index.php?page=<?php echo $i ?>" style="text-decoration: none;">  <span id="pagenumber" style="padding: 0 15px;"> <?php echo $i ?> </span> </a> <?php } 
            
            echo '<a style="padding: 0 15px;" href="index.php?page='.$numberOfPages.'">Last</a>';
            ?>


        </div>
    </div>

    <script>
        let pageNumber = document.querySelector('#pagenumber');
        pageNumber.addEventListener('click', function() {
            pageNumber.style.color = 'red'; 
        });
    </script>

</body>
<?php //footer content 
include("footer.php");  ?>