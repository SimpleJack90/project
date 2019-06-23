$(document).ready(function(){

    
    var current_page=1;
    
    var article_size;
    console.log('document loaded');
    

    $('#btn_prev').attr('hidden',true);

    var dataJsonOriginal={"page":current_page}
    $.ajax({

        url: '../article/list_articles_api.php?',
        type: 'POSt',
        dataType:'JSON',
        data:dataJsonOriginal,
        success: function (data) {

        article_size=data['records'][0]['size'];

        console.log(current_page);
        console.log(article_size);
       
        if(current_page==article_size){
            $('#btn_next').attr('hidden',true);
        }

        for(var i=0;i<data['records'].length;i++){


            
        var str=data['records'][i]['body'].replace(/img[0-9]+/g,"");   
        var body=str.substr(0,100); 
       
        var id=encodeURIComponent(data['records'][i]['id']);
             
        $('#article-data').append("<h1><a href='../main/article.php?number_id="+data['records'][i]['id']+"'>"+data['records'][i]['title']+"</a></h1><hr>"
        +"<div class='img-wrap'><a href='../main/article.php?number_id="+id+"'><img class='img-fluid' src='../uploads/"+data['records'][i]['id']+"/"+data['records'][i]['main_image']+"'></a></div>"
        +"<div class='text-wrap'><hr><p>"+body+"</p>"
        +"<p>by "+data['records'][i]['user_name']+" on "+data['records'][i]['created']+"</p></div>");

    
            }

        },
    
       
    });


    

    

    $(document).on('click','#btn_next',function(e){
        e.preventDefault();

        
        console.log(current_page);
        console.log(article_size);
        if(current_page<article_size){
            current_page++;

            console.log(current_page);
            console.log(article_size);
            
            if(current_page>=article_size){
                
                $('#btn_next').attr('hidden',true);
                
            }
            
            $('#page').html(current_page);

            $('#btn_prev').attr('hidden',false);
            
        }else if(current_page>=article_size){

            current_page=article_size;
            $('#btn_next').attr('hidden',true);
            
        }
        
        var dataJson={"page":current_page}

        $.ajax({

            url: '../article/list_articles_api.php',
            type: 'POST',
            dataType:'JSON',
            data:dataJson,
            success: function (data) {
    
               
                article_size=data['records'][0]['size'];

                $('#article-data').html("");
            for(var i=0;i<data['records'].length;i++){
    
    
            var str=data['records'][i]['body'].replace(/img[0-9]+/g,"");   
            var body=str.substr(0,100); 
           
                  
            $('#article-data').append("<h1><a href='../main/article.php?number_id="+data['records'][i]['id']+"'>"+data['records'][i]['title']+"</a></h1><hr>"
            +"<div class='img-wrap'><a href='../main/article.php?number_id="+data['records'][i]['id']+"'><img class='img-fluid' src='../uploads/"+data['records'][i]['id']+"/"+data['records'][i]['main_image']+"'></a></div>"
            +"<div class='text-wrap'><hr><p>"+body+"</p>"
            +"<p>by "+data['records'][i]['user_name']+" on "+data['records'][i]['created']+"</p></div>");
    
        
                }
    
            },
        
           
        });

       

    });

    $(document).on('click','#btn_prev',function(e){
        e.preventDefault();
       
        
        
        if(current_page<=article_size && current_page>1){
            current_page--;
            
            if(current_page==1){
                $('#page').html(current_page);

                $('#btn_prev').attr('hidden',true);
            }
            console.log(current_page);
            
            $('#page').html(current_page);

            $('#btn_next').attr('hidden',false);

            
          
        }else if(current_page<1){
            current_page=1;
            $('#btn_prev').attr('hidden',true);
          
        }
        
        var dataJson={"page":current_page}
        $.ajax({

            url: '../article/list_articles_api.php',
            type: 'POST',
            dataType:'JSON',
            data:dataJson,
            success: function (data) {
    
                
                article_size=data['records'][0]['size'];
                $('#article-data').html("");
            for(var i=0;i<data['records'].length;i++){
    
    
            var str=data['records'][i]['body'].replace(/img[0-9]+/g,"");   
            var body=str.substr(0,100); 
           
                  
            $('#article-data').append("<h1><a href='../main/article.php?number_id="+data['records'][i]['id']+"'>"+data['records'][i]['title']+"</a></h1><hr>"
            +"<div class='img-wrap'><a href='../main/article.php?number_id="+data['records'][i]['id']+"'><img class='img-fluid' src='../uploads/"+data['records'][i]['id']+"/"+data['records'][i]['main_image']+"'></a></div>"
            +"<div class='text-wrap'><hr><p>"+body+"</p>"
            +"<p>by "+data['records'][i]['user_name']+" on "+data['records'][i]['created']+"</p></div>");
    
        
                }
    
            },
        
           
        });

       

    });



})