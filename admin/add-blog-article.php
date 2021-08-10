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
<?php include("sidebar.php"); ?>

<div class="content">
    <h1>Add New Article</h1>
    <?php
    if (isset($_POST['submit'])) {

        extract($_POST);

        if ($articleTitle == '') {
            $error[] = 'Please enter your title';
        }

        if ($articleDescrip == '') {
            $error[] = 'Please enter your title';
        }

        if ($articleContent == '') {
            $error[] = 'Please enter your title';
        }

        if (!isset($error)) {
            try {
                $articleSlug = slug($articleTitle);
                $stmt = $db->prepare("INSERT INTO article(
                        articleTitle, articleSlug, articleDescrip, articleContent, articleDate, articleTags,userid
                    ) VALUES(:articleTitle, :articleSlug, :articleDescrip, :articleContent, :articleDate, :articleTags, :userid)");
                $stmt->execute(array(
                    ':articleTitle' => $articleTitle,
                    ':articleSlug' => $articleSlug,
                    ':articleDescrip' => $articleDescrip,
                    ':articleContent' => $articleContent,
                    ':articleTags' => $articleTags,
                    ':userid' => $_SESSION['userid'],
                    ':articleDate' => date('Y-m-d H:i:s'),

                ));

                $articleId = $db->lastInsertId();
                if (is_array($categoryId)) {
                    foreach ($_POST['categoryId'] as $categoryId) {
                        $stmt = $db->prepare('INSERT INTO cat_links (articleId,categoryId)VALUES(:articleId,:categoryId)');
                        $stmt->execute(array(
                            ':articleId' => $articleId,
                            ':categoryId' => $categoryId
                        ));
                    }
                }


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

    <form action="" method="post">

        <h2><label>Article Title</label><br>
            <input type="text" name="articleTitle" style="width:100%;height:40px" value="<?php if (isset($error)) {
                                                                                                echo $_POST['articleTitle'];
                                                                                            } ?>">
        </h2>

        <h2><label>Short Description(Meta Description) </label><br>
            <textarea name="articleDescrip" cols="120" rows="6"><?php if (isset($error)) {
                                                                    echo $_POST['articleDescrip'];
                                                                } ?></textarea>
        </h2>

        <h2><label>Long Description(Body Content)</label><br>
            <textarea name="articleContent" id="textarea1" class="mceEditor"><?php if (isset($error)) {
                                                                                    echo $_POST['articleContent'];
                                                                                } ?></textarea>
        </h2>
        <fieldset>
            <h2>
                <legend>Categories</legend>

                <?php
                $checked = null;
                $stmt2 = $db->query('SELECT categoryId, categoryName FROM category ORDER BY categoryName');

                while ($row2 = $stmt2->fetch()) {

                    if (isset($_POST['categoryId'])) {

                        if (in_array($row2['categoryId'], $_POST['categoryId'])) {
                            $checked = "checked='checked'";
                        } else {
                        }
                    }

                    echo "<input type='checkbox' name='categoryId[]' value='" . $row2['categoryId'] . "' $checked> " . $row2['categoryName'] . "<br />";
                }

                ?>
            </h2>
        </fieldset>
        <h2><label>Articles Tags (Separated by comma without space)</label><br>
            <input type='text' name='articleTags' value='<?php if (isset($error)) {
                                                                echo $_POST['articleTags'];
                                                            } ?>' style="width:100%;height:40px">
        </h2>

        <button name="submit" class="subbtn">Submit</button>

    </form>
</div>

<?php include("footer.php"); ?>