<?php 
class User{
    private $db;
    public function __constructor($db){
        $this->db=$db;
        
    }   

    public function is_logged_in(){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            return true;
        }
    }

    public function logout(){
        session_destroy();
    }
}


?>

