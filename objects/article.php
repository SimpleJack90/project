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
    public function Count(){
        $query="SELECT * FROM ".$this->table_name;

        $stmt=$this->conn->prepare($query);

        $stmt->execute();

        $num=$stmt->rowCount();

        return $num;
    }
    public function Read($page_id){
        
        $page_size=3;

        $offset = ($page_id - 1)  * $page_size;
        //Select all query.
        $query="SELECT :pages as size,u.user_name , a.id, a.title, a.body, a.main_image, a.image_collection,a.created,a.user_id
                FROM " . $this->table_name . " a LEFT JOIN users u ON a.user_id=u.id
                ORDER BY a.id DESC
                LIMIT :offset,:page_size";


        $size=$this->Count();

        $pages = ceil($size / $page_size);

        //We prepare and execute statement.        
        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);
        $stmt->bindParam(':page_size',$page_size,PDO::PARAM_INT);
        $stmt->bindParam(':pages',$pages,PDO::PARAM_INT);

        $stmt->execute();

        return $stmt;
    }
    public function CountArticlePerUser($user_name){
        
        
        $query="SELECT * FROM ".$this->table_name." a JOIN users u on a.user_id=u.id
                    WHERE user_name=:user_name 
                    ORDER BY a.id";


        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(":user_name",$user_name);

        $stmt->execute();
            
        

       
        $num=$stmt->rowCount();

        return $num;
    }

    public function ReadUser($page_id,$user){
        
        $page_size=3;

        $offset = ($page_id - 1)  * $page_size;
        //Select all query.
        $query="SELECT :pages as size,u.user_name , a.id, a.title, a.body, a.main_image, a.image_collection,a.created,a.user_id
                FROM " . $this->table_name . " a LEFT JOIN users u ON a.user_id=u.id
                WHERE user_name=:user
                ORDER BY a.id DESC
                LIMIT :offset,:page_size";


        $size=$this->CountArticlePerUser($user);

        $pages = ceil($size / $page_size);

        //We prepare and execute statement.        
        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(':offset',$offset,PDO::PARAM_INT);
        $stmt->bindParam(':page_size',$page_size,PDO::PARAM_INT);
        $stmt->bindParam(':pages',$pages,PDO::PARAM_INT);
        $stmt->bindParam(':user',$user);

        $stmt->execute();

        return $stmt;
    }

    public function ReadOne($article_id){

        $query="SELECT *
        FROM " . $this->table_name . "
        WHERE id=:id
        ";

        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(':id',$article_id);
        
        $stmt->execute();

        return $stmt;
    }

    public function Delete($id){

        $query="DELETE FROM ".$this->table_name." WHERE id=:id";

        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(":id",$id);

        if($stmt->execute()){

           

            return true;
        }
        return false;

    }
   
}

?>