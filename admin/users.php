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
            <th>UserName</th>
            <th>Full Name</th>
            <th>Role</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php
        try {
            $stmt = $db->query("SELECT * FROM users where userid!='" . $_SESSION['userid'] . "'")->fetchAll();;
            // $stmt = $db->query("SELECT * FROM users where userid=30")->fetchAll();

            foreach ($stmt as $row) {

                // while ($row = $stmt->fetch()) {
                echo '<tr>';
                echo '<td> <a href="view-blog-user.php?id=' . $row['profileid'] . '">' . $row['username'] . '</a></td>';

                $profile = $db->query("SELECT * FROM user_profile where userid='" . $row['userid'] . "'");
                $profile = $profile->fetch();

                echo '<td> ' . $profile['firstName'] . ' ' . $profile['lastName'] . '</a></td>';

                try {
                    $stmt = $db->query("SELECT * FROM role where roleid='" . $row['roleid'] . "'");
                    $role = $stmt->fetch();
                    echo '<td>' . $role['role'] . '</td>';
                } catch (PDOException $e) {
                    echo '<td>NO Role Assign</td>';
                    // echo $e->getMessage();
            }

        ?>
                <td>
                    <button class="editbtn">
                        <a href="edit-current-user.php?id=<?php echo $row['userid']; ?>">Edit</a>
                    </button>
                </td>
                <td>
                    <button class="delbtn"><a href="del-user.php?id=<?php echo $row['userid']; ?>">Delete</a></button>
                </td>

        <?php
                echo '</tr>';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        ?>
    </table>
    <p><button class="editbtn"><a href="../register.php">Add New User</a></button></p>
</div>


<?php include("footer.php"); ?>