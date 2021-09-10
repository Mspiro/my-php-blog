<?php
require_once('../includes/config.php');
require_once('classes/class.user.php');

if (!$user->is_logged_in()) {
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
        
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/blog/assets/img/";
            $fileName = basename($_FILES["articleImage"]["name"]);
            $fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $fileName);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileName = md5(time()) . "." . $fileType;
            $targetFilePath = $uploadDir . $fileName;
            $fileTypes = array('jpg', 'png', 'jpeg');
        
            try {
                move_uploaded_file($_FILES["articleImage"]["tmp_name"], $targetFilePath);
                $stmt = $db->prepare('UPDATE article SET articleTitle=:articleTitle, articleSlug=:articleSlug, articleDescrip=:articleDescrip, articleContent=:articleContent, articleEditDate=:articleEditDate, articleTags=:articleTags, articleImage=:articleImage  WHERE articleId=:articleId');
                $stmt->execute(array(
                    ':articleImage' =>$fileName,
                    ':articleTitle' => $articleTitle,
                    ':articleSlug' => $articleSlug,
                    ':articleDescrip' => $articleDescrip,
                    ':articleContent' => $articleContent,
                    ':articleId' => $articleId,
                    ':articleTags' => $articleTags,
                    ':articleEditDate' => date('Y-m-d H:i:s'),
                ));

                $stmt = $db->prepare('DELETE FROM cat_links WHERE articleId = :articleId');
                $stmt->execute(array(':articleId' => $articleId));

                if (is_array($categoryId)) {
                    foreach ($_POST['categoryId'] as $categoryId) {
                        $stmt = $db->prepare('INSERT INTO cat_links (articleId,categoryId)VALUES(:articleId,:categoryId)');
                        $stmt->execute(array(
                            ':articleId' => $articleId,
                            ':categoryId' => $categoryId
                        ));
                    }
                }

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

        $stmt = $db->prepare('SELECT articleId,articleTitle, articleSlug, articleDescrip, articleContent, articleTags, articleImage FROM article WHERE articleId = :articleId');
        $stmt->execute(array(':articleId' => $_GET['id']));
        $row = $stmt->fetch();
        $imageName = $row['articleImage'];
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    ?>
    <form action='' method='post' enctype="multipart/form-data">
        <!-- <?php echo $fileType ;?> -->
        <input type='hidden' name='articleId' value="<?php echo $row['articleId']; ?>">

        <h2><label>Article Title</label><br>
            <input type='text' name='articleTitle' style="width:100%;height:40px" value="<?php echo $row['articleTitle']; ?>"required>
        </h2>

        <h2><label>Article Slug</label><br>
            <input type='text' name='articleSlug' style="width:100%;height:40px" value="<?php echo $row['articleSlug']; ?>"required>
        </h2>


        <h2><label>Short Description(Meta Description) </label><br>
            <textarea name='articleDescrip' cols='120' rows='6' required><?php echo $row['articleDescrip']; ?></textarea>
        </h2>

        <h2><label>Long Description(Body Content)</label><br>
            <textarea name='articleContent' id='textarea1' class='mceEditor' cols='120' rows='20' required><?php echo $row['articleContent']; ?></textarea>
        </h2>
        <fieldset>
                <input type="file" name="articleImage" required> 
        </fieldset>
        <fieldset>
            <h2>
                <legend>Categories</legend>

                <?php
                $checked = null;
                $stmt2 = $db->query('SELECT categoryId, categoryName FROM category ORDER BY categoryName');
                while ($row2 = $stmt2->fetch()) {

                    $stmt3 = $db->prepare('SELECT categoryId FROM cat_links WHERE categoryId = :categoryId AND articleId = :articleId');
                    $stmt3->execute(array(':categoryId' => $row2['categoryId'], ':articleId' => $row['articleId']));
                    $row3 = $stmt3->fetch();

                    if (isset($row3['categoryId']) == $row2['categoryId']) {
                        $checked = 'checked=checked';
                    } else {
                        $checked = null;
                    }

                    echo "<input type='checkbox' name='categoryId[]' value='" . $row2['categoryId'] . "' $checked> " . $row2['categoryName'] . "<br />";
                }

                ?>
            </h2>
        </fieldset>

        <h2><label>Articles Tags (Seprated by comma without space)</label><br>
            <input type='text' name='articleTags' style="width:100%;height:40px;" value='<?php echo $row['articleTags']; ?>'>
            <br>
        </h2>


        <button name='submit' class="subbtn"> Update</button>

    </form>

</div>

<?php include("footer.php");  ?>



