    <?php 
    require_once('../includes/config.php');
    require_once('classes/class.user.php');
    ?>


<div class="sidebar">
    <h2>Quick Shorcut For:
    <?php
    $auther= $db->query("SELECT username FROM users where userid='".$_SESSION['userid']."'");
    $autherName= $auther->fetch(PDO::FETCH_ASSOC);
    echo "".$autherName['username'];
    ?>    </h2>
  
      <a href="index.php">View Articles </a>
      <a href="add-blog-article.php">Add New Blog Post </a>
      <a href="blog-categories.php">View Categories </a>
      <a href="add-blog-category.php">Add New Category </a>
      <a href="blog-users.php">View Users </a>    
      <a href="add-blog-user.php">Add New Users  </a>
      <a target="_blank" href="../">Visit Blog </a>
  <?php 
  $sql = $db->query('select count(*) from article')->fetchColumn(); 
echo'<h2>Total Posted '.'<font color="red">'.$sql.'</font>'.'</h2>' ;
?>


</div>