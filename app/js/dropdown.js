$(document).ready(function() {
//$("li").mouseover(function(){
    //  $("p:first",this).text("mouse over");
    //  $("p:last",this).text(++i);
//	 alert(1111);
 //   });
//    .mouseout(function(){
//      $("p:first",this).text("mouse out");
//    });

$("div.dropdown").hover(
     function () {
    	$(".dropdown-active").removeClass("dropdown-active"); 
        $(this).addClass("dropdown-active");
      }, 
      function () {
    	$(this).removeClass("dropdown-active");  
      }
);
 
});