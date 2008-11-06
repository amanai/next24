
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
    /*
    $(".bCheckTree").click(function(){
        var isChecked = $(this).attr('checked');
        $(this).parent().parent().find(".bCheckTree").attr({checked:isChecked});
    });
    */
    
});

function validateAddRss(frm){
    if (!frm.feed_name.value){
        alert ("Введите название RSS-ленты");
        return false;
    }
    if (!frm.feed_url.value){
        alert ("Введите URL RSS-ленты");
        return false;
    }
    return true;
}