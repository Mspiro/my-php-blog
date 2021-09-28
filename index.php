<?php include_once("includes/config.php");
require_once("head.php");
require_once("admin/classes/Article.php");
require_once("admin/classes/User.php");

?>
<title>Blog</title>
<?php include("header.php"); ?>

<body>

 <div class="main-container">
  <?php include('carousel.php'); ?>
 </div>
 <div class="container">
  <div>
   <?php
   $perPageRecord = 5;
   $pageNo = 0;
   if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if ($page == 0 || $page == 1) {
     $pageNo = 0;
    } else {
     $pageNo = ($page * $perPageRecord) - $perPageRecord;
    }
   }
   try {

    $row = $Article->selectArticleByLimit($pageNo);

    foreach ($row as $row) {
     $userid = $row['userid'];
     $user = $User->selectSingleUserById($userid);
     echo '<div class="box">';
     echo '<h1 class="title"><a href="show.php?id=' . $row['articleId'] . '" style="text-decoration:none;">' . $row['articleTitle'] . '</a></h1>';
     echo '<hr>';
     if (isset($user['username'])) {
      echo "<strong>Author: </strong>" . $user['username'];
     }
     echo ' <strong>Posted on: </strong>' . date('jS M Y ', strtotime($row['articleDate']));

     if (isset($row['articleEditDate'])) {
      echo ' <strong>Updated on: </strong>' . date('jS M Y ', strtotime($row['articleEditDate']));
     }

     echo '<hr>';

     echo '<p>' . $row['articleDescrip'] . '</p>';
     echo '<p><button class="readbtn"><a href="show.php?id=' . $row['articleId'] . '">Read More</a></button></p>';
     echo '</div>';
    }
   } catch (PDOException $e) {
    echo $e->getMessage();
   }

   ?>

  </div>
  <div class="center space">

   <?php
   $totalRecords = $Article->totalArticle();
   $perPageRecord = 5;
   $numberOfPages = ceil($totalRecords / $perPageRecord);
   echo '<a href="index.php?page=0">First</a>';
   for ($i = 1; $i <= $numberOfPages; $i++) {

   ?> <a href="index.php?page=<?php echo $i ?>" style="text-decoration: none;"> <span id="pagenumber"> <?php echo $i ?> </span> </a> <?php }
                                                                                                                                                                      echo '<a href="index.php?page=' . $numberOfPages . '">Last</a>'; ?>


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