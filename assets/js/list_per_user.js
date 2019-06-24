$(document).ready(function(){

    $(document).on('click','#search_user',function(e){
        e.preventDefault();
        alert("clicked");
    
       var input=$('#search_bar').val()
    
        if(input==""){
          alert("empty");

         
        }
        else{
          alert("not empty");
    
    
        var current_page_user=1;
        
        $('#article-data').html("");
        var article_size;
        console.log('document loaded');
        
    
        $('#btn_prev').attr('hidden',true);
    
        var dataJsonOriginal={"page":current_page_user,"user":input}
        $.ajax({
    
            url: '../article/list_user_articles_api.php',
            type: 'POSt',
            dataType:'JSON',
            data:dataJsonOriginal,
            success: function (data) {
    
            article_size=data['records'][0]['size'];
    
            console.log(current_page_user);
            console.log(article_size);
           
           
    
            console.log('inside ajax');
            for(var i=0;i<data['records'].length;i++){
    
    
                
            var str=data['records'][i]['body'].replace(/img[0-9]+/g,"");   
            var body=str.substr(0,100); 
           
            var id=encodeURIComponent(data['records'][i]['id']);
                 
            $('#article-data').append("<h1><a href='../main/article.php?number_id="+data['records'][i]['id']+"'>"+data['records'][i]['title']+"</a></h1><hr>"
            +"<div class='img-wrap'><a href='../main/article.php?number_id="+id+"'><img class='img-fluid' src='../uploads/"+data['records'][i]['id']+"/"+data['records'][i]['main_image']+"'></a></div>"
            +"<div class='text-wrap'><hr><p>"+body+"</p>"
            +"<p>by "+data['records'][i]['user_name']+" on "+data['records'][i]['created']+"</p></div>");
    
        
                }

                $('#button_layout').html("<a href='#'  class='btn btn-primary' id='btn_prev_user'>Prev</a>"
                                        +"<span id='page_user' class='btn btn-primary'>1</span>"
                                        +"<a href='#' class='btn btn-primary' id='btn_next_user'>Next</a>");

                $('#btn_prev_user').attr('hidden',true);
                if(current_page_user==article_size){
                    
                    $('#btn_next_user').attr('hidden',true);
                }
    
            },
        
           
        });
    
    
        console.log('button layout');
        $('#button_layout').html("");
    
        
        //next button
        $(document).on('click','#btn_next_user',function(e){
            e.preventDefault();
    
            
            console.log(current_page_user);
            console.log(article_size);
            if(current_page_user<article_size){
                current_page_user++;
    
                console.log(current_page_user);
                console.log(article_size);
                
                if(current_page_user>=article_size){
                    
                    $('#btn_next_user').attr('hidden',true);
                    
                }
                
                $('#page_user').html(current_page_user);
    
                $('#btn_prev_user').attr('hidden',false);
                
            }else if(current_page_user>=article_size){
    
                current_page_user=article_size;
                $('#btn_next_user').attr('hidden',true);
                
            }
            
            var dataJson={"page":current_page_user,"user":input}
    
            $.ajax({
    
                url: '../article/list_user_articles_api.php',
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
    
        //prev button
        $(document).on('click','#btn_prev_user',function(e){
            e.preventDefault();
           
            
            
            if(current_page_user<=article_size && current_page_user>1){
                current_page_user--;
                
                if(current_page_user==1){
                    $('#page').html(current_page_user);
    
                    $('#btn_prev_user').attr('hidden',true);
                }
                console.log(current_page_user);
                
                $('#page_user').html(current_page_user);
    
                $('#btn_next_user').attr('hidden',false);
    
                
              
            }else if(current_page_user<1){
                current_page_user=1;
                $('#btn_prev_user').attr('hidden',true);
              
            }
            
            var dataJson={"page":current_page_user,"user":input}
            $.ajax({
    
                url: '../article/list_user_articles_api.php',
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
    }
})
    
        

    
      
    
});