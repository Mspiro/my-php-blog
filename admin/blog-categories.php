<?php
//include config
require_once('../includes/config.php');

//if not logged in redirect to login page
if (!$user->is_logged_in()) {
    header('Location: login.php');
}

//show message from add / edit page
if (isset($_GET['delcat'])) {

    $stmt = $db->prepare('DELETE FROM category WHERE categoryId = :categoryId');
    $stmt->execute(array(':categoryId' => $_GET['delcat']));

    header('Location: categories.php?action=deleted');
    exit;
}

?>
<?php include("head.php");  ?>
<title>Categories- Blog</title>
<script language="JavaScript" type="text/javascript">
    function delcat(id, title) {
        if (confirm("Are you sure you want to delete '" + title + "'")) {
            window.location.href = 'categories.php?delcat=' + id;
        }
    }
</script>
<?php include("header.php");  ?>

<div class="content">
    <?php
    //show message from add / edit page
    if (isset($_GET['action'])) {
        echo '<h3>Category ' . $_GET['action'] . '.</h3>';
    }
    ?>

    <table>
        <tr>
            <th>Title</th>
            <th>Operation</th>
        </tr>
        <?php
        try {

            $stmt = $db->query('SELECT categoryId, categoryName, categorySlug FROM category ORDER BY categoryName DESC');
            while ($row = $stmt->fetch()) {

                echo '<tr>';
                echo '<td>' . $row['categoryName'] . '</td>';
        ?>

                <td>
                    <button class="editbtn"> <a href="edit-blog-category.php?id=<?php echo $row['categoryId']; ?>">Edit</a> </button>
                    <button class="delbtn"> <a href="javascript:delcat('<?php echo $row['categoryId']; ?>','<?php echo $row['categorySlug']; ?>')">Delete</a></button>
                </td>

        <?php
                echo '</tr>';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </table>

    <p><button class="editbtn"><a href='add-blog-category.php'>Add New Category</a></button></p>
</div>
<?php include("sidebar.php");  ?>
<?php include("footer.php");  ?>