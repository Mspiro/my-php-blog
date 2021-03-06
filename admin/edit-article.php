<?php
require_once('../includes/config.php');
require_once('classes/User.php');
require_once('classes/Article.php');

if (!$User->is_logged_in()) {
  header('location:login.php');
}
?>
<?php include("head.php"); ?>
<title>Blog for Blogger</title>
<script src='https://cdn.tiny.cloud/1/5hgs2bkc5j9hn0hx4q19pdj0x3p0kf3md7l91r7yzj2i2mmk/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>
<script>
  tinymce.init({
    selector: '#textarea1'
  });
</script>

<body>
  <?php include("header.php"); ?>

  <div class="content">

    <h2>Edit Post</h2>

    <?php

    $fileName = '';

    if (isset($_POST['submit'])) {
      extract($_POST);

      if ($articleId == '') {
        $error[] = 'This post is missing a valid ID!.';
      }

      if ($articleTitle == '') {
        $error[] = 'Please enter the title';
      }

      if ($articleDescrip == '') {
        $error[] = 'Please enter the Description';
      }

      if ($articleContent == '') {
        $error[] = 'Please enter the Content ';
      }

      if (!isset($error)) {

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/blog/assets/img/articleImages/";
        $fileName = basename($_FILES["articleImage"]["name"]);
        $fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $fileName);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileName = md5(time()) . "." . $fileType;
        $targetFilePath = $uploadDir . $fileName;
        $fileTypes = array('jpg', 'png', 'jpeg');

        try {
          move_uploaded_file($_FILES["articleImage"]["tmp_name"], $targetFilePath);

          $Article->editArticle($fileName);


          header("Location: index.php?action=updated");
          exit;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }
    }
    ?>
    <?php
    if (isset($error)) {
      foreach ($error as $error) {
        echo $error . '<br>';
      }
    }

    try {

      $id = $_GET['id'];
      $row =  $Article->selectArticleByArticleId($id);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    ?>

    <form action='' method='post' enctype="multipart/form-data" class="edit-article-form">
      <input type='hidden' name='articleId' value="<?php echo $row['articleId']; ?>">
      <fieldset>
        <fieldset>
          <input class="image-feild" type="file" name="articleImage" required>
        </fieldset>
        <fieldset>
          <h2><label>Article Title</label>
            <input type='text' name='articleTitle' style="width:100%;height:40px" value="<?php echo $row['articleTitle']; ?>" required>
          </h2>
        </fieldset>
        <fieldset>
          <h2><label>Article Slug</label><br>
            <input type='text' name='articleSlug' style="width:100%;height:40px" value="<?php echo $row['articleSlug']; ?>" required>
          </h2>
        </fieldset>
        <fieldset>
          <h2><label>Short Description(Meta Description) </label><br>
            <textarea name='articleDescrip' style="width:100%;height:40px" required><?php echo $row['articleDescrip']; ?></textarea>
          </h2>
        </fieldset>
        <fieldset>
          <h2><label>Long Description(Body Content)</label><br>
            <textarea name='articleContent' id='textarea1' class='mceEditor' cols='120' rows='30' required><?php echo $row['articleContent']; ?></textarea>
          </h2>
        </fieldset>
        <fieldset>
        <h2><label>Articles Tags (Seprated by comma without space)</label><br>
          <input type='text' name='articleTags' style="width:100%;height:40px;" value='<?php echo $row['articleTags']; ?>'>
          <br>
        </h2>
        </fieldset>

        <!-- <button name='submit' class="subbtn"> Update</button> -->

        <div class="submit-btn">
          <input type="submit" name="submit" value="Update Article" />
        </div>

      </fieldset>
    </form>

  </div>



</body>