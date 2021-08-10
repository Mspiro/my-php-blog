<?php

require_once('../includes/config.php');
require_once('classes/class.user.php');
if (!$user->is_logged_in()) {
    header('location: login.php');
}

if (isset($_GET['delpost'])) {
    $stmt = $db->prepare('DELETE from article where articleId=:articleId');
    $stmt->execute(array(':articleId' => $_GET['delpost']));
    header('location:index.php?action=deleted');
    exit;
}
?>

<?php include("head.php"); ?>

<title>Admin Page</title>

<script type="text/javascript">
    function delpost(id, title) {
        if (confirm("Are you sure want to delete '" + title + "'")) {
            window.location.href = 'index.php?delpost=' + id;
        }
    }
</script>
<?php include("header.php"); ?>

<?php include("sidebar.php"); ?>
<div class="content">
    <?php
    if (isset($_GET['action'])) {
        echo '<h3>Post' . $_GET['action'] . '.</h3>';
    }
    ?>

    <table>
        <tr>
            <th>Article Title</th>
            <th>Posted Date</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php
        try {
            $stmt = $db->query("SELECT articleId, articleTitle, articleDate FROM article where userid='" . $_SESSION['userid'] . "'  ORDER BY articleId DESC");
            while ($row = $stmt->fetch()) {
                echo '<tr>';
                echo '<td>' . $row['articleTitle'] . '</td>';
                echo '<td>' . date(' jS M Y', strtotime($row['articleDate'])) . '</td>';
        ?>
                <td>
                    <button class="editbtn">
                        <a href="edit-blog-article.php?id=<?php echo $row['articleId']; ?>">Edit</a>
                    </button>
                </td>
                <td>
                    <button class="delbtn"><a href="del-blog-post.php?id=<?php echo $row['articleId']; ?>">Delete</a></button>
                </td>

        <?php
                echo '</tr>';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        ?>
    </table>
    <p><button class="editbtn"><a href="add-blog-article.php">Add New Article</a></button></p>
</div>


<?php include("footer.php"); ?>