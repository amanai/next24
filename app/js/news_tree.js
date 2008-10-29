
$(document).ready(function(){  

    $(".checkbox_tree li img").click(function(){
        if ($(this).hasClass("minus")){
            $(this).removeClass("minus");
            $(this).addClass("plus");
            $(this).next("label").next("ul").slideUp("slow");
        }
        else{
            $(this).removeClass("plus");
            $(this).addClass("minus");
            $(this).next("label").next("ul").slideToggle("slow");
        }
        
    });
    
    
});
