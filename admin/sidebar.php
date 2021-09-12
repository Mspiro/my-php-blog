    <?php
    require_once('../includes/config.php');
    require_once('classes/class.user.php');
    ?>


    <div class="sidebar">
      <h2>Quick Shorcut For:
        <?php
        $auther = $db->query("SELECT username FROM users where userid='" . $_SESSION['userid'] . "'");
        $autherName = $auther->fetch(PDO::FETCH_ASSOC);
        echo "<span style='color:#ECF87F'>" .strtoupper($autherName['username'])."</span>";
        ?> </h2>

      <a href="blog-users.php">Profile <hr> </a>
      <!-- <hr> -->
      <a href="index.php">My Articles<hr> </a>
      
      <a href="add-blog-article.php">Add New Blog Post <hr></a>
      <a href="blog-categories.php">View Categories<hr> </a>
      <a href="add-blog-category.php">Add New Category <hr></a>
      <!-- <a href="add-blog-user.php">Add New Users  </a> -->
      <a href="../">Visit Blog <hr></a>
      <?php
      $sql = $db->query('select count(*) from article')->fetchColumn();
      echo '<h2> <span style="text-decoration: underline;">Total Posts: </span> ' . '<span class="text">' . $sql . '</span>' . '</h2>';
      ?>


    </div>