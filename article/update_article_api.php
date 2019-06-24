<?php 

//Required headers


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization, X-Requested-With ");


//require files

require_once '../utilities/helper_functions.php';

require_once '../config/database.php';

require_once '../objects/article.php';

require_once '../utilities/helper_functions.php';

$database=new DatabaseConnection();
$db=$database->getConnection();

$article=new Article($db);




if(isset($_GET['submit']) && $_GET['submit']==true){

    $files_not_to_be_deleted=['.','..'];

    //decoding user id
    $article_id = $_POST['article_id'];
   
    $user_id=$_POST['user_id'];

    //taking title and body 
    $title=$_POST['title'];
    $body=$_POST['body'];

    //taking main_image
    if(isset($_POST['main_image'])){
        $main_image=$_POST['main_image'];
        array_push($files_not_to_be_deleted,$_POST['main_image']);

    }else {
        $main_image=$_FILES['main_image']['name'];
        $tmp_main_image=$_FILES['main_image']['tmp_name'];

       
    }
    $image_collection="";

    if(isset($_POST['current_images'])){
        for($i=0;$i<count($_POST['current_images']);$i++){

            $image_collection=$image_collection.$_POST['current_images'][$i].";";

            array_push($files_not_to_be_deleted,$_POST['current_images']);

        }
    }

    //making string of article images, ; between each two.
    
    $allowed_types=['image/jpeg','image/jpg','image/png','image/bmp'];
    $type_error=0;
   
    for($i=0; $i<count($_FILES['new_images']['name'])-1; $i++){
        $image_collection=$image_collection.$_FILES['new_images']['name'][$i].";";
        
        if(in_array($_FILES['new_images']['type'][$i],$allowed_types)) 
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

    $article->BindData($title,$main_image,$body,$image_collection,$date,$user_id);
    
   

    
    if($article->Update($article_id)){

        //Set response code to  201 - Created.
        http_response_code(201);

        $dir='../uploads/'.$article_id;
        $get_all_files=scandir($dir);

        for($i=0;$i<count($get_all_files);$i++){
            $file=$get_all_files[$i];

            if(in_array($file,$files_not_to_be_deleted)){

            }else{
                unlink($dir.'/'.$file);
            }
        }
        
       

       

        $target_path = "../uploads/".$article_id.'/';
        
        
        if($_FILES["new_images"]["error"] == 4 || $_FILES["new_images"]["error"]==0 ){

        }else{

        for($i=0; $i<count($_FILES['new_images']['name'])-1; $i++){
           
           
            $target = $target_path.$_FILES['new_images']['name'][$i]; 
        
            if(move_uploaded_file($_FILES['new_images']['tmp_name'][$i], $target)) {
               // echo "The file has been uploaded successfully <br/>";
            }
            else{
               // echo "Something went wrong! <br/>";
            } 
        } 
    }

        if(!isset($_POST['main_image'])){
        $target_main = "../uploads/".$article_id.'/';
        $target = $target_main.$_FILES['main_image']['name']; 
        if(move_uploaded_file($_FILES['main_image']['tmp_name'], $target)) {
            // echo "The file has been uploaded successfully <br/>";
         }
         else{
            // echo "Something went wrong! <br/>";
         } 

        }
       


        //Notify user
        echo json_encode(['error' => 'success', 'msg' => 'Article was updated!']);
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