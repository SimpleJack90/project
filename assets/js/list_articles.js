$(document).ready(function(){


    

    $.ajax({

        url: '../article/list_articles_api.php',
        type: 'POSt',
        dataType:'JSON',
        
        success: function (data) {

        for(var i=0;i<data['records'].length;i++){


        var str=data['records'][i]['body'].replace(/img[0-9]+/g,"");   
        var body=str.substr(0,100); 
        console.log(body);
              
        $('#article-data').append("<h1><a href='../main/article.php?number_id="+data['records'][i]['id']+"'>"+data['records'][i]['title']+"</a></h1><hr>"
        +"<div class='img-wrap'><a href='../main/article.php?number_id="+data['records'][i]['id']+"'><img class='img-fluid' src='../uploads/"+data['records'][i]['id']+"/"+data['records'][i]['main_image']+"'></a></div>"
        +"<div class='text-wrap'><hr><p>"+body+"</p>"
        +"<p>by Username on "+data['records'][i]['created']+"</p></div>");

      

     


           
            console.log(data['records'][i]['id']);
            console.log(data['records'][i]['title']);

           console.log(data['records'][i]['body']);
           
           
           
           
           console.log(str);
            
            }

            
           
            
        },
    
       
    });



})