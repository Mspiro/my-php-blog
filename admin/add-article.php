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
    <h1>Add New Article</h1>
    <?php
    if (isset($_POST['submit'])) {

      extract($_POST);

      $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/blog/assets/img/articleImages/";
      $fileName = basename($_FILES["articleImage"]["name"]);
      $fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $fileName);
      $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
      $fileName = md5(time()) . "." . $fileType;
      $targetFilePath = $uploadDir . $fileName;
      $fileTypes = array('jpg', 'png', 'jpeg');


      if ($articleTitle == '') {
        $error[] = 'Please enter your title';
      }

      if ($articleDescrip == '') {
        $error[] = 'Please enter your description';
      }

      if ($articleContent == '') {
        $error[] = 'Please enter your content';
      }


      if (!isset($error)) {
        try {
          move_uploaded_file($_FILES["articleImage"]["tmp_name"], $targetFilePath);

          $Article->createArticle($fileName);
          header("location: index.php?action=added");
          exit;
        } catch (PDOException $e) {
          echo $e->getMessage();
        }

        if (isset($error)) {
          foreach ($error as $error) {
            echo '<p class="message">' . $error . '</p>';
          }
        }
      }
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data" class="add-article-form" >
      <fieldset>
      <fieldset>
          <input class="image-feild" type="file" name="articleImage" required>
        </fieldset>
        <fieldset>
          <h2><label>Article Title</label><br>
            <input type="text" name="articleTitle" class="input-feild" value="<?php if (isset($error)) {
                                                                                echo $_POST['articleTitle'];
                                                                              } ?>">
          </h2>
          <hr>
        </fieldset>
        <fieldset>
          <h2><label>Short Description(Meta Description) </label><br>
            <textarea type="text" name="articleDescrip" class="input-feild"><?php if (isset($error)) {
                                                                              echo $_POST['articleDescrip'];
                                                                            } ?></textarea>
          </h2>
        </fieldset>
        <fieldset>
          <h2><label>Long Description(Body Content)</label><br>
            <textarea type="text" name="articleContent" id="textarea1" cols='120' rows='30' class="mceEditor"><?php if (isset($error)) {
                                                                                                                echo $_POST['articleContent'];
                                                                                                              } ?></textarea>
          </h2>
        </fieldset>
        
        <fieldset>
          <h2><label>Articles Tags (Separated by comma without space)</label><br>
            <input type='text' name='articleTags' value='<?php if (isset($error)) {
                                                            echo $_POST['articleTags'];
                                                          } ?>' style="width:100%;height:40px">
          </h2>
        </fieldset>
        <div class="submit-btn">
          <input type="submit" name="submit" value="Add Article" />
        </div>
      </fieldset>
    </form>
</body>