<?php
include('add-stuff.php');
?>
<div class="content">
    <h2>Edit User</h2>
    <?php  

        if(isset($_POST['submit'])){
            extract($_POST);

            if($username == ''){
                $error[]= 'Please enter the username.';
            }

            if(strlen($password)>0){
                if($password == ''){
                    $error[]= 'Please enter the password.';
                }

                if($passwordConfirm == ''){
                    $error[]= 'Please enter the Confirm password.';
                }

                if($password != $passwordConfirm){
                    $error[]= 'Password do not match.'; 
                }
            }

            if($email ==''){
                $error[]="Please enter the email address.";
            }

            if(!isset($error)){
                try {                    
                        $stmt = $db->prepare('UPDATE users SET username= :username, password =:password, email = :email WHERE userid = :userid');
                        $stmt->execute(array(
                            ':username'=>$username,
                            ':password'=>$password,
                            ':email'=>$email, 
                            ':userid' => $userid ));            
                        header('location:blog-users.php?action=updated');
                        exit;
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
    ?>
    <?php

    if(isset($error)){
        foreach($error as $error){
            echo $error.'<br>';
        }
    }
    try {
        $stmt = $db->prepare('SELECT userid, username, email FROM users WHERE userid=:userid');
        $stmt->execute(array(':userid'=>$_GET['id']));
        $row=$stmt->fetch();
    } catch (PDOException $e) {
            echo $e->getMessage();
    }
    ?>

    <form action="" method="post">

        <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">

        <p><label for="">Username</label><br>
        <input type="text" name="username" value="<?php echo $row['username'];?>">
        </p>

        <p><label for="">Password</label><br>
        <input type="password" name="password" value="">
        </p>

        <p><label for="">Confirm Password</label><br>
        <input type="password" name="passwordConfirm" value="">
        </p>

        <p><label for="">Email</label><br>
        <input type="text" name="email" value="<?php echo $row['email'];?>">
        </p>

        <p><input type="submit" name="submit" value="update"></p>
    </form>

</div>
<?php include("sidebar.php"); ?>
<?php include("footer.php");?>