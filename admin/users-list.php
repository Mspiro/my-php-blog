<?php

require_once('../includes/config.php');
require_once('classes/class.user.php');
require_once('classes/UserDB.php');

if (!$user->is_logged_in()) {
    header('location: login.php');
}

?>

<?php include("head.php"); ?>

<title>Admin Page</title>

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
            $id=$_SESSION['userid'];

            $stmt = $UserDB->selectUserById($id);
           
            foreach ($stmt as $row) {

                echo '<tr>';
                echo '<td> <a href="view-blog-user.php?id=' . $row['profileid'] . '">' . $row['username'] . '</a></td>';
                $userid = $row['userid'];
                $profile = $UserDB->selectUserDetailsById($userid);

                echo '<td> ' . $profile['firstName'] . ' ' . $profile['lastName'] . '</a></td>';
            
                try {
                    $roleid = $row['roleid'];

                    $role = $UserDB->selectRoleByUser($roleid);
                    echo '<td>' . $role['role'] . '</td>';
                } catch (PDOException $e) {
                    echo '<td>NO Role Assign</td>';
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