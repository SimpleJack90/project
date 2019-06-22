<?php

require_once '../utilities/session.php';

$session=new Session();

if(!$session->checkSession()) header('Location: articles.php');
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



<div class="container">
<div class="row">

    <div class="col-md-1 col-sm-1"></div>
    <div class="col-md-10 col-sm-10">
    
    
    <h1>Create new Article:</h1>
    <hr>
    <div id="page_error">
            
        </div>
        <form id="article-form" enctype="multipart/form-data"  method="post">
    
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter article title:">
            
        </div>
        <div id="title_error">
            
        </div>
    
        <div class="form-group">
            <label for="front_image">Main image:</label>
            <input type="file" name="main_image" class="form-control" id="front_image" >
        </div>
        <div id="front_image_error">
            
        </div>

        <div class="form-group">
        <label for="bodyArea">Text:</label>
        <textarea class="form-control" name="body" id="bodyArea" rows="3"></textarea>
        </div>
        <div id="body_error">
            
        </div>

        <div class="form-group file_imgs">
            <label for="file0">Article images:</label>
            <input name="file[]" type="file" id="file1" class='file_add form-control' />
        </div>

        <div id="image_collection_error">
            
        </div>
        <div  id="image_preview">
        
        </div class="form-group">
        <div class="form-group">
        <input type="submit" id="submitArticle" class="btn btn-success btn-block form-control" name='submitArticle' value="Submit Article"/>
        </div>
        <?php 
        
        
        $id=$session->getEncodedId();

        echo"<input type='hidden' id='user_id' name='user_id' value=".$id.">"; ?>
        
    </form>

    

   

    </div>
    <div class="col-md-1 col-sm-1"></div>
    

</div>






<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script type="text/javascript" src="../assets/js/upload_article_imgs.js"></script>
</body>

</html>