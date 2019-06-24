<?php 


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization, X-Requested-With ");


require_once '../objects/article.php';

require_once '../config/database.php';

$database=new DatabaseConnection();
$db=$database->getConnection();

$article=new Article($db);

//$data=json_decode(file_get_contents("php://input"),true);

//var_dump($data);


if(isset($_POST["page"])){


$page_id=$_POST['page'];
$stmt=$article->Read($page_id);
$num=$stmt->rowCount();

if($num>0){
    //Define array where we gonna place our data
    $article_arr=array();

    $article_arr["records"]=array();

    //We iterate through and fetch data

    
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){

        
        //create variable that will hold one row of data and push it to $article_arr.

        $collection=explode(";",$row['image_collection']);
        
        $article_item=array(
            "size"=>$row['size'],
            "user_name"=>$row['user_name'],
            "id"=>$row['id'],
            "title"=>$row['title'],
            "body"=>html_entity_decode($row['body']),
            "main_image"=>$row['main_image'],
            "user_id"=>$row['user_id'],
            "image_collection"=>$collection,
            "created"=>$row['created']

        );
        array_push($article_arr["records"],$article_item);


    }
    //Setting response code to 200 - OK

    http_response_code(200);

    //Show data in JSON format

    echo json_encode($article_arr);
}else{
    //Setting response code to 404 - Not Found

    http_response_code(404);

    //Tell the user no products were found

    echo json_encode(array("messsage"=>"No Article found."));

}
}
?>