    <?php
    require_once('../includes/config.php');
    require_once('classes/class.user.php');
    ?>


    <div class="sidebar">
      <h2 style="padding-left: 10px;">Quick Shorcut For:
        <?php
        $auther = $db->query("SELECT username FROM users where userid='" . $_SESSION['userid'] . "'");
        $autherName = $auther->fetch(PDO::FETCH_ASSOC);
        echo "<span style='color:#fff;'>" . strtoupper($autherName['username']) . "</span>";
        ?> </h2>

      <a href="blog-users.php">Profile
        <hr>
      </a>
     
      <?php 
       $isAdmin = $db->query("SELECT * FROM users where userid='" . $_SESSION['userid'] . "'");
       $isAdmin = $isAdmin->fetch();

       if ($isAdmin['roleid'] == 2 || $isAdmin['roleid'] == 1 ) {
        echo '
          <a href="index.php">My Articles <hr></a>
          <a href="add-article.php">Add New Post <hr> </a>
          <a href="blog-categories.php">Existing Categories <hr> </a>
          <a href="add-blog-category.php">Add New Category <hr> </a>
          ';
      }

      ?>
      
      <?php
      if ($isAdmin['roleid'] == 1) {
        echo '
          <a href="add-user-role.php">Add New Role <hr></a>
          <a href="role-list.php">View Roles <hr> </a>
          <a href="users-list.php">View Users <hr> </a>
          ';
      }

      ?>

      <a href="../">Visit Blog
        <hr>
      </a>

      <?php
      $sql = $db->query('select count(*) from article')->fetchColumn();
      echo '<h2 style="padding: 0 65px;"> <span style="text-decoration: underline;">Total Posts: </span> ' . '<span class="text">' . $sql . '</span>' . '</h2>';
      ?>


    </div>