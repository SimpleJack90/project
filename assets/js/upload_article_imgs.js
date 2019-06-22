// if document ready do following

$(document).ready(function(){

    
    var id=2;
    var i=1;
    var body="";
    var main_image="";
    var title="";

    //adding article images to preview and generating additional inputs
    //also adding selectors to text area
    $(document).on('change','.file_add',function(e){

        $(this).after("<input name='file[]' type='file' id='file"+id+"' class='file_add form-control'/>");
       // $(this).attr('disabled',true);

        $('#image_preview')
        .append("<img width='200px' class='image_col' id='img"+i+"' height='200px' src='"+URL.createObjectURL(e.target.files[0])+"'>");
        var tmpBody=$('#bodyArea').val()
        

        $('#bodyArea').val(tmpBody+" img"+i);



        id++;
        i++;
        
        console.log(e.target.files[0].name.length);
    });
    //clicking on images will remove them from preview div, textarea and will
    //remove corresponding input
    $(document).on('click','.image_col',function(){
        var id="";
        
        id=$(this).attr('id');

        
        body= $('#bodyArea').val();
        body=body.replace(id,'');
        $('#bodyArea').val(body);

        console.log(id);
        id=id.substring(3);
        console.log(id);


        $(this).parent().siblings('.file_imgs').children('#file'+id).remove();
        $(this).remove();

        
        });

         // main image validation
        if(document.getElementById("front_image").files.length == 0){
            $('#front_image_error').html("Image not selected, please select image.");
            $('#front_image_error').addClass('val_error');
            $('#front_image').addClass('val_error');

        }
        $("#front_image").change(function(e){

        if(document.getElementById("front_image").files.length == 0){
    
                
            $('#front_image_error').html("Image not selected, please select image.");
            $('#front_image_error').addClass('val_error').removeClass('val_success');
            $('#front_image').addClass('val_error').removeClass('val_success');
        }
        else{

            $('#front_image_error').html("File successfully added");
            $('#front_image_error').addClass('val_success').removeClass('val_error');
            $('#front_image').removeClass('val_error').addClass('val_success');
            main_image=event.target.files;
        }
    
        });

        //Title validation
        $("#title").on('focusout',function(){

        var tmpTitle=$('#title').val();
       
        if(tmpTitle.length==0){
            $('#title_error').html("Title is required.").addClass('val_error').removeClass('val_success');
            $('#title').addClass('val_error').removeClass('val_success');
        }else if(tmpTitle.length>30){
            $('#title_error').html("Title must have 30 characters or less.").addClass('val_error').removeClass('val_success');
            $('#title').addClass('val_error').removeClass('val_success');
        }
        else {

            title=tmpTitle;
            $('#title_error').html("");
            $('#title').removeClass('val_error').addClass('val_success');
        }
        console.log(tmpTitle);
        console.log(tmpTitle.length);
        });

        //taking value of text area on focus and validation
        $("#bodyArea").on('focusout',function(){
        body=$('#bodyArea').val();

       if(body.length>0) 
       {
            $('#body_error').html('Text successfully added')
            $('#body_error').removeClass('val_error').addClass('val_success').removeClass('val_allowed');
        }
        else {
            $('#body_error').html('Text is optional');
            $('#body_error').removeClass('val_error').removeClass('val_success').addClass('val_allowed');

        }
        });

        //if everything is filled correctly
        $(document).on('click','#submitArticle',function(e){

        e.preventDefault();

    if(title.length>0 
     && title.length<=30 
     && !jQuery.isEmptyObject(main_image) 
     && body.length>0 
     ){
        
      
     

        
        var myform = document.getElementById("article-form");
       
        var formData = new FormData(myform);


       
         console.log(formData);
         $.ajax({
            url: '../article/create_article_api.php?submit=true',
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

