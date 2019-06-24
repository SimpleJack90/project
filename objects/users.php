<?php

class Users{

    private $conn;
    private $table_name="users";

    public $id;
    public $user_name;
    public $email;
    public $password;

    public function __construct($db_connection){
        $this->conn=$db_connection;
    }

    public function CheckIfLogged($email,$password){
        
        $query="SELECT * 
                FROM ".$this->table_name." 
                WHERE email=:email AND password=:password";
        
        $stmt=$this->conn->prepare($query);
        
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);

        $stmt->execute();

        return $stmt;

    }
    public function Search($term){

        $query="SELECT * FROM ".$this->table_name." WHERE user_name LIKE :term";

        //Preparing statements and binding
        $stmt=$this->conn->prepare($query);
        $term=$term.'%';
        $stmt->bindParam(":term",$term);
        
        //Execute prepared statement
        $stmt->execute();

        return $stmt;
    }
}

?>