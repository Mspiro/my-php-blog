    <?php
    require_once('../includes/config.php');
    require_once('classes/class.user.php');
    require_once('classes/UserDB.php');
    require_once('classes/Article.php');
    ?>
    <div class="sidebar">
      <h2 style="padding-left: 10px;">Quick Shorcut For:
        <?php
        $userid = $_SESSION['userid'];
        $user = $UserDB->selectSingleUserById($userid);
        echo "<span style='color:#fff;'>" . strtoupper($user['username']) . "</span>";
        ?> </h2>
      <a href="my-profile.php?id=<?php echo $userid; ?>">Profile
        <hr>
      </a>

      <?php
      if ($user['roleid'] == 2 || $user['roleid'] == 1) {
        echo '
          <a href="index.php">My Articles <hr></a>
          <a href="add-article.php">Add New Post <hr> </a>
          ';
      }
      
      if ($user['roleid'] == 1) {
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

      $count = $Article->totalArticle();
      echo '<h2 style="padding: 0 65px;"> <span style="text-decoration: underline;">Total Posts: </span> ' . '<span class="text">' . $count . '</span>' . '</h2>';
      ?>
    </div>