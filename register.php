<?php include_once("includes/config.php"); ?>
<?php require_once("head.php"); ?>
<title>Blog</title>

<?php  include("header.php"); ?>


<div class="container">

<div class="content">
    <h2>New Registration</h2>
    <?php
            if(isset($_POST['submit'])){
                extract($_POST);

                if($username==''){
                    $error[]='Please enter the username ';
                }

                if($password==''){
                    $error[]='Please enter the password ';
                }
                
                if($passwordConfirm==''){
                    $error[]='Please enter the password again ';
                }

                if($password!=$passwordConfirm){
                    $error[]='Password do not match ';
                }

                if($email==''){
                    $error[]='Please enter the email address ';
                }

                if(!isset($error)){                            
                    try {
                        $stmt=$db->prepare('INSERT INTO users(username,password,email,isAuther) VALUES(:username, :password, :email, :isAuther)');
                        $stmt->execute(array(':username' =>$username, ':password' => $password, ':email'=>$email, ':isAuther'=>$isAuther));

                        header('location: blog-users.php?action=added');
                        exit;
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                }
            }
                } 
            if(isset($error)){
                foreach($error as $error){
                    echo '<p class="message">'.$error.'</p>';
            }
        }
    ?>
    <form action="" method="post">
        <p><label for="">Username</label><br>
        <input type="text" name="username" value="<?php if(isset($error)){
            echo $_POST['username'];}?>">
        </p>
        
        <p><label for="">Password</label><br>
        <input type="text" name="password" value="<?php if(isset($error)){
            echo $_POST['password'];}?>">
        </p>

        <p><label for="">Confirm Password</label><br>
        <input type="text" name="passwordConfirm" value="<?php if(isset($error)){
            echo $_POST['passwordConfirm'];}?>">
        </p>

        <p><label for="">Email</label><br>
        <input type="text" name="email" value="<?php if(isset($error)){
            echo $_POST['email'];}?>">
        </p>
        <p><label for="">Is Auther</label><br>
        <input type="checkbox" name="isAuther" value="<?php if(isset($error)){
            echo $_POST['isAuther'];}?>">
        </p>


        
        <button name="submit" class="subbtn">Add User</button>
    </form>
</div>

<?php include("footer.php");?>