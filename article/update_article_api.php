<?php 

//Required headers


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization, X-Requested-With ");


//require files

require_once '../config/database.php';

require_once '../objects/article.php';

require_once '../utilities/helper_functions.php';

$database=new DatabaseConnection();
$db=$database->getConnection();

$article=new Article($db);

var_dump($_POST);

if(isset($_GET['']) && $_GET['']==true){


    //decoding user id
    $user_id = $_POST['user_id'];
    $decoded_id = decodeData($user_id);

    //taking title and body 
    $title=$_POST['title'];
    $body=$_POST['body'];

    //taking main_image
    $main_image=$_FILES['main_image']['name'];
    $tmp_main_image=$_FILES['main_image']['tmp_name'];

    //making string of article images, ; between each two.
    $image_collection="";
    $allowed_types=['image/jpeg','image/jpg','image/png','image/bmp'];
    $type_error=0;
   
    for($i=0; $i<count($_FILES['file']['name'])-1; $i++){
        $image_collection=$image_collection.$_FILES['file']['name'][$i].";";
        
        if(in_array($_FILES['file']['type'][$i],$allowed_types)) 
        {
            
        }else $type_error++;

      
    }
    
    
   

    if($type_error>0) {
    
   echo json_encode(
        ['error' => 'type_error','msg' => $type_error.' file have wrong type. Allowed types are:jpeg,jpg,bmp,png']);
    exit();
   } 
  

    //created at
    $date=date("Y-m-d H:i:s");

    $article->BindData($title,$main_image,$body,$image_collection,$date,$decoded_id);
    
   

    
    if($article->Create()){

        //Set response code to  201 - Created.
        http_response_code(201);

        
       $id=$article->recentlyCreated();

        if (!file_exists('../'.$id)) {
            mkdir('../uploads/'.$id.'/', 0777, true);

          //  echo 'creating directory';
        }

        $target_path = "../uploads/".$id.'/';
        
        
       

        for($i=0; $i<count($_FILES['file']['name'])-1; $i++){
           
           
            $target = $target_path.$_FILES['file']['name'][$i]; 
        
            if(move_uploaded_file($_FILES['file']['tmp_name'][$i], $target)) {
               // echo "The file has been uploaded successfully <br/>";
            }
            else{
               // echo "Something went wrong! <br/>";
            } 
        } 

        $target_main = "../uploads/".$id.'/';
        $target = $target_main.$_FILES['main_image']['name']; 
        if(move_uploaded_file($_FILES['main_image']['tmp_name'], $target)) {
            // echo "The file has been uploaded successfully <br/>";
         }
         else{
            // echo "Something went wrong! <br/>";
         } 


       


        //Notify user
        echo json_encode(['error' => 'success', 'msg' => 'Article was created!']);
    }
    //Not able to create product
    else {

        //Set response code to  503 - Service unavailable.
        http_response_code(503);

        //Notify user
        echo json_encode(['error' => 'error', 'msg' => 'Something went wrong!']);

    }

   
}


?>