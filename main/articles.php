<?php 

require_once '../utilities/session.php';

$session=new Session();

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

<div class="front-img">

</div>

<div class="marker"></div>

<?php 
      if($session->checkSession()){
        ?>
  <div class="container">
    <div class="row">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
    <a href="create_article.php" class="btn btn-primary btn-lg btn-block">Create new Article</a>
    </div>
    </div>
  </div>
      <?php } ?>

<div class="marker"></div>

<div class="container">
<div class="row">

    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
    
    
    <h1>Naslov naslov naslov</h1>
    <hr>
    <div  class="img-wrap">
        <img class="img-fluid"  src="../assets/images/collection/home-office-336378_1920.jpg">
    </div>

    <div class="text-wrap">
        <hr>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum </p>
    
    <p>by Username on 19.03.2009</p>
   
    
    </div>

    </div>
    <div class="col-md-2 col-sm-2"></div>
    

</div>

<div class="row">

    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
    
    
    <h1>Naslov naslov naslov</h1>
    <hr>
    <div  class="img-wrap">
        <img class="img-fluid"  src="../assets/images/collection/home-office-336378_1920.jpg">
    </div>

    <div class="text-wrap">
        <hr>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum </p>
    <p>by Username on 19.03.2009</p>
    
   
    
    </div>

    </div>

    
    <div class="col-md-2 col-sm-2"></div>
</div>

<div class="row">

    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
    
    
    <h1>Naslov naslov naslov</h1>
    <hr>
    <div  class="img-wrap">
        <img class="img-fluid"  src="../assets/images/collection/Lake_Sunrises_and_sunsets_USA_Texas_Grass_526577_800x600.jpg">
    </div>

    <div class="text-wrap">
        <hr>
    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum </p>
    <p>by Username on 19.03.2009</p>
   
    
    
   
    
    </div>

    </div>

    <div class="col-md-8 col-sm-8">

</div>


</div>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>