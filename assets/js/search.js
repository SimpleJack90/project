$(document).ready(function(){

    $('.search_box input[type="text"]').on("keyup",function(){

        var inputVal=$(this).val();
        var resultDropdown=$(this).siblings(".result");

        if(inputVal.length){
            $.get(
                "../article/search.php",
                {term:inputVal}
                ).done(function(data){

                    resultDropdown.html(data);
                    
                });
        }else{
            resultDropdown.empty();
        }


    });

    $(document).on("click",".result p",function(){
        $(this).parents(".search_box")
        .find('input[type="text"]')
        .val($(this).text());

        $(this).parent(".result").empty();

    });

});