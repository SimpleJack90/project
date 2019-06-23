<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With ");

require_once '../config/database.php';

require_once '../objects/article.php';

require_once '../utilities/helper_functions.php';

$database=new DatabaseConnection();
$db=$database->getConnection();

$article=new Article($db);



if(isset($_GET['number_id'])){

    $id=$_GET['number_id'];
    
    if($article->Delete($id)){

        // Set response code - 200 OK.
        $directory='../uploads/'.$id;

        removeDirectoryAndFiles($directory);

        http_response_code(200);
     
        //Notify user.
        echo json_encode(['error' => 'success', 'msg' => 'Article was deleted!']);
    }
    else{
    
        // Set response code 503 - Service Unavailable.
        http_response_code(503);
     
        //Notify user.
        
        echo json_encode(['error' => 'failure', 'msg' => 'Article was not deleted!']);
    
    }

}else echo json_encode(['error' => 'false_data', 'msg' => 'Wrong id']);


?>