<?php 
    
require_once '../config/database.php';

require_once '../objects/users.php';


$database=new DatabaseConnection();
$db=$database->getConnection();

$user=new Users($db);


if(isset($_REQUEST["term"])){

            //Query for selecting proper rows
          
$stmt=$user->Search($_REQUEST["term"]);
 
$num=$stmt->rowCount();

if($num>0){
    while($row=$stmt->fetch()){

        echo "<p>".$row['user_name']."</p>";
    }
}
else{
    echo "<p> No matches found!</p>";
}
}


   

?>