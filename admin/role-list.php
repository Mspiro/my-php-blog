<?php
require_once('../includes/config.php');

//if not logged in redirect to login page
if (!$user->is_logged_in()) {
    header('Location: login.php');
}

?>
<?php include("head.php");  ?>
<title>User Roles- Blog</title>
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
    if (isset($_GET['action'])) {
        echo '<h3>Role ' . $_GET['action'] . '.</h3>';
    }
    ?>

    <table>
        <tr>
            <th>Title</th>
            <!-- <th>Operation</th> -->
        </tr>
        <?php
        try {

            $stmt = $db->query('SELECT * FROM role ORDER BY role DESC');
            while ($row = $stmt->fetch()) {

                echo '<tr>';
                echo '<td>' . $row['role'] . '</td>';
        ?>

                <td>
                    <!-- <button class="editbtn"> <a href="edit-blog-category.php?id=<?php echo $row['categoryId']; ?>">Edit</a> </button> -->
                    <!-- <button class="delbtn"> <a href="del-blog-category.php?id=<?php echo $row['categoryId']; ?>">Delete</a> </button> -->
                </td>

        <?php
                echo '</tr>';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        ?>
    </table>

    <p><button class="editbtn"><a href='add-user-role.php'>Add New Role</a></button></p>
</div>
<?php include("sidebar.php");  ?>
<?php include("footer.php");  ?>