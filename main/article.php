<?php 

require_once '../utilities/session.php';

require_once '../config/database.php';
require_once '../objects/article.php';



$session=new Session();

$database=new DatabaseConnection();
$db=$database->getConnection();

$article=new Article($db);

$stmt="";
$row="";
if(isset($_GET['number_id'])){

    $article_id=$_GET['number_id'];

    $stmt=$article->ReadOne($article_id);
    $num=$stmt->rowCount();

    if($num>0){

        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        
    }

}

$image_collection=explode(';',$row['image_collection']);

$body=$row['body'];



$i=0;

$body="<p>".$body."</p>";

$i=0;

while($i<count($image_collection)-1){

    $image="<br><div class='img-wrap'>
        <img class='img-fluid' src='../uploads/".$row['id']."/".$image_collection[$i]."'>
    </div><br>";

    $body=preg_replace('/img[0-9]+/',$image,$body,1);

   $i++;
}






?>

<html>
    <title>Article List</title>
<head>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php 
require_once '../navigation/nav_bar.php';
?>



<div>

<div class="front-img" 
style="background-image:url('../uploads/<?php echo $row['id'];?>/<?php echo $row['main_image']?>');">

</div>

<div class="marker"></div>
<div class="marker"></div>
<div class="container">
<div class="row">

    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8" id="article-data">

    <h1><?php echo $row['title'];?></h1>
    <hr>

    <?php echo $body;?>
   
    </div>
    <div class="col-md-2 col-sm-2"></div>
    

</div>






</div>

<div class="marker"></div>
<?php 
      if($session->checkSession()){
        ?>
  <div class="container">
    <div class="row">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
    <a href="create_article.php" class="btn btn-success btn-lg btn-block">Edit</a>
    <a href="create_article.php" class="btn btn-danger btn-lg btn-block">Delete</a>
    </div>
    </div>
  </div>
      <?php } ?>






<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>


</script>
</body>

</html>