<?php

require_once '../utilities/session.php';

require_once '../utilities/helper_functions.php';

require_once '../config/database.php';

require_once '../objects/article.php';

$session=new Session();
$row="";
if(!$session->checkSession()){ header('Location: articles.php');}
else{

    if(isset($_GET['article_id'])){


        $database=new DatabaseConnection();
    $db=$database->getConnection();

    $article=new Article($db);

    $article_id=$_GET['article_id'];

    $stmt=$article->ReadOne($article_id);
    $num=$stmt->rowCount();

    if($num>0){

        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        
    }


    }
}

$image_collection=explode(';',$row['image_collection']);


preg_match_all('/img[0-9]+/',$row['body'],$matches);


$values=[];

for($m=0;$m<count($matches[0]);$m++)
array_push($values,substr($matches[0][$m],3));

$k;

?>

<html>
    <title>Article List</title>
<head>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/fontawesome-free-5.9.0-web/css/all.css" >
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



<div class="container">
<div class="row">

    <div class="col-md-1 col-sm-1"></div>
    <div class="col-md-10 col-sm-10">
    
    
    <h1>Update Article:</h1>
    <hr>
    <div id="page_error">
            
    </div>
        <form id="article-form" enctype="multipart/form-data"  method="post">
    
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" id="title" value="<?php echo $row['title']?>" placeholder="Enter article title:">
            
        </div>
        <div id="title_error">
            
        </div>
    
        <div class="form-group">
            <label for="front_image">Main image:</label>
            <input type="text" name="main_image" 
            class="form-control" name="main_front_image" id="main_front_image" value="<?php echo $row['main_image'];?>" >
            <input type="file" name="main_image" hidden disabled class="form-control" id="front_image" >
            <div class="main_image_preview">
            <br>
            <?php echo "<img width='200px'  id='main_img_id' height='200px' 
            src='../uploads/".$row['id']."/".$row['main_image']."' >"?>
            </div>
        </div>
        <div id="front_image_error">
            
        </div>

        <div class="form-group">
        <label for="bodyArea">Text:</label>
        <?php echo "<textarea class='form-control' name='body' id='bodyArea' rows='8' maxlength='20000' >".$row['body']."</textarea>";?>
        
        <div id="charNum"></div>
        </div>
        <div id="body_error">
            
        </div>

        <div class="form-group file_imgs">
            <label for="file0">Article images:</label>

            <?php
                $count=count($image_collection);
                
                for($i=0;$i<$count-1; $i++){
                    $k=$values[$i];
                    
                    echo "<input value='$image_collection[$i]' name='current_images[]' type='text' id='current_file$k' class='form-control'/>";
                }
            ?>
            <input name="new_images[]"  type="file" 
            id="current_file<?php 
            
            if(isset($k)) echo $k+1;

            else echo "1";
            
            ?>" class='update_file form-control' />

            
        </div>

        <div id="image_collection_error">
            
        </div>
        <div  id="image_preview">
                
        <?php 
        
            $count=count($image_collection);
            $j;
             for($i=0;$i<$count-1; $i++){
                $j=$values[$i];
            echo "<img width='200px' class='image_col_curr'  id='img$j' height='200px' 
            src='../uploads/".$row['id']."/".$image_collection[$i]."' >";
            
            }
            ?>
        </div class="form-group">
        <div class="form-group">
        <input type="submit" 
        id="submitArticle" class="btn btn-success btn-block form-control" name='submitArticle' 
        value="Update Article"/>
        </div>
        <?php 
        
        
        $id=encodeData($session->getId());

        echo"<input type='hidden' id='user_id' name='article_id' value=".$row['id'].">"; ?>
        
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
<script src="../assets/fontawesome-free-5.9.0-web/js/all.js"></script>
<script type="text/javascript" src="../assets/js/upload_article_imgs.js"></script>
<script>
    $(document).ready(function(){

        var files=[];
       
        if($("#front_image").attr('hidden')=='hidden'){
            $('#front_image_error').html("File successfully added");
            $('#front_image_error').addClass('val_success').removeClass('val_error');
            $('#front_image').removeClass('val_error').addClass('val_success');
        }

        $("#front_image").change(function(e){


            main_image=event.target.files;
        });

        $(document).on('click','#main_img_id',function(){
            
            $(this).parent().siblings('#main_front_image').remove();
                
                $("#front_image").attr('hidden',false);
                $("#front_image").attr('disabled',false);

            console.log("tes test");
            $(this).remove();

              
           

        });

        $(document).on('click','.image_col_curr',function(){
        var id="";
        console.log("We are in curr");
        id=$(this).attr('id');

        
        body= $('#bodyArea').val();
        body=body.replace(id,'');
        $('#bodyArea').val(body);

        console.log(id);
        id=id.substring(3);
        console.log(id);


        $(this).parent().siblings('.file_imgs').children('#current_file'+id).remove();
      
        $(this).remove();

        
        });
        var i=0;
        var file_inc=0;
        $(document).on('change','.update_file',function(e){

       if(i==0){
          var id= $(this).attr('id');

           i=id.substring(12);
           file_inc=i;
       }

    file_inc++;

        $(this).after("<input name='new_images[]' type='file' id='current_file"+file_inc+"' class='update_file form-control'/>");
        // $(this).attr('disabled',true);

       files.push(e.target.files[0])

        $('#image_preview')
        .append("<img width='200px' class='image_col_curr' id='img"+i+"' height='200px' src='"+URL.createObjectURL(e.target.files[0])+"'>");
        var tmpBody=$('#bodyArea').val()


        $('#bodyArea').val(tmpBody+" img"+i);

        i++;

    
        
    });

    //if everything is ok, update
    $(document).on('click','#submitArticle',function(e){

       var body= $('#bodyArea').val();
        var title=$('#title').val();
        console.log("submit")

        console.log(title)
        console.log(body)
        e.preventDefault();

        if(title.length>0 
        && title.length<=30 
         
        && body.length>0 
        && body.length<20000
            ){





        var myform = document.getElementById("article-form");

        var formData = new FormData(myform);
               console.log(files);

                for(var i=0;i<files.length;i++)
             formData.append('file[]', files[i]);
       

 console.log(formData);
 $.ajax({
    url: '../article/update_article_api.php?submit=true',
    type: 'POST',
    dataType:'JSON',
    xhr: function() {
        var myXhr = $.ajaxSettings.xhr();
        return myXhr;
    },
    success: function (data) {

        
        alert(data["error"]);
       
        if(data['error']=='success'){

            $('#page_error').html(data['msg']);
            $('#page_error').addClass('val_success').removeClass('val_error');
            setTimeout(function(){
                location = '../main/articles.php';
              },2000);

        }else if(data['error']=='error'){

            $('#page_error').html(data['msg']);
            $('#page_error').addClass('val_error').removeClass('val_success');
        }else if(data['error']=='type_error'){
            $('#page_error').html(data['msg']);
            $('#page_error').addClass('val_error').removeClass('val_success');
        }
    },
    data: formData,
    cache: false,
    contentType: false,
    processData: false
});

 
     
     
 
 

       

}else {
 $('#page_error').html('Something went wrong, please fill form correctly.');
 $('#page_error').addClass('val_error');
}


});

       
});

  

</script>
</body>

</html>