<?php 

class Session{



    public function __construct(){

        session_start();
    }

    public function setSession($id,$username){
        $_SESSION['id']=$id;
        $_SESSION['username']=$username;
    }

    public function checkSession(){

        if(isset($_SESSION['id']) && !empty($_SESSION['id']))
            return true;
        return false;    

    }
    public function getUserName(){

        return (string) $_SESSION['username'];
    }
    public function getId(){

        return (string) $_SESSION['id'];
    }

    public function destroySession(){
        session_destroy();
    }

}



?>