<?php 

class Article{

    private $conn;
    private $table_name="articles";

    public $id;
    public $title;
    public $main_image;
    public $body;
    public $image_collection;
    public $created;
    public $user_id;

    public function __construct($db){
       
        $this->conn=$db;
    }

    public function Create(){


        $query="INSERT INTO ".$this->table_name." 
                (title,main_image,body,image_collection,created,user_id)
                VALUES(:title,:main_image,:body,:image_collection,:created,:user_id)";

        $stmt=$this->conn->prepare($query);
         
       

        $stmt->bindParam(":title",$this->title);
        $stmt->bindParam(":main_image",$this->main_image);
        $stmt->bindParam(":image_collection",$this->image_collection);
        $stmt->bindParam(":body",$this->body);
        $stmt->bindParam(":created",$this->created);
        $stmt->bindParam(":user_id",$this->user_id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function BindData($title,$main_image,$body,$image_collection,$created,$user_id){

        $this->title= htmlspecialchars(strip_tags($title));
        $this->main_image= htmlspecialchars(strip_tags($main_image));
        $this->image_collection= htmlspecialchars(strip_tags($image_collection));
        $this->body= htmlspecialchars(strip_tags($body));
        $this->created= htmlspecialchars(strip_tags($created));
        $this->user_id= htmlspecialchars(strip_tags($user_id));
    }
    public function recentlyCreated(){

        $query="SELECT * FROM articles ORDER BY id DESC LIMIT 1";

        $stmt=$this->conn->prepare($query);

        if($stmt->execute()){

            $row=$stmt->fetch();
            $id=$row[0];

            return $id;
        }
        return 1;
    }
    public function Read(){
        
        //Select all query.
        $query="SELECT *
                FROM " . $this->table_name . "
                ORDER BY id DESC";

        //We prepare and execute statement.        
        $stmt=$this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    public function ReadOne($article_id){
        $query="SELECT *
        FROM " . $this->table_name . "
        WHERE id=:id
        ORDER BY id=:id DESC";

        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(':id',$article_id);
        
        $stmt->execute();

        return $stmt;
    }
}

?>