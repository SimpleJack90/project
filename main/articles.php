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
    <div class="col-md-8 col-sm-8" id="article-data">


    </div>
    <div class="col-md-2 col-sm-2"></div>
    </div>
  <div class="row">
  <div class="col-md-5 col-sm-5"></div>
    <div class="col-md-2 col-sm-2" >
   <a href="#"  class="btn btn-primary" id="btn_prev">Prev</a>
  <span id="page" class="btn btn-primary">1</span>
  <a href="#" class="btn btn-primary" id="btn_next">Next</a>


    </div>
    
    
  </div>






</div>


<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="../assets/js/list_articles.js"></script>
</body>

</html>