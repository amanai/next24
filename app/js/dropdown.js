$(document).ready(function() {
$("div.dropdown").hover(
     function () {
    	$(".dropdown-active").removeClass("dropdown-active"); 
        $(this).addClass("dropdown-active");
      }, 
      function () {
    	$(this).removeClass("dropdown-active");  
      }
);
$("i.arrow-icon").click(function () {
	if($(this).siblings("ul.nav-list").is(":hidden")) {
		$(this).siblings("ul.nav-list").slideDown("slow");
	}
	else {
		$(this).siblings("ul.nav-list").slideUp("slow");
	}
}); 
});