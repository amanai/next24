$(function() { 
if($("div.dropdown")) {	
	$("div.dropdown").hover(
			function () {
				$(".dropdown-active").removeClass("dropdown-active"); 
				$(this).addClass("dropdown-active");
			}, 
			function () {
				$(this).removeClass("dropdown-active");  
			}
	);
}
if($("ul.nav-list")) {
	$("i.arrow-icon").click(function () {
		if($(this).siblings("ul.nav-list").is(":hidden")) {
			$(this).siblings("ul.nav-list").slideDown("slow");
		}
		else {
			$(this).siblings("ul.nav-list").slideUp("slow");
		}
	}); 
}  
if($("div.info-entry")) {
	$("i.arrow-icon").click(function () {
		if($(this).parent().siblings("div.info-entry").is(":hidden")) {
			$(this).parent().siblings("div.info-entry").slideDown("slow");
		}
		else {
			$(this).parent().siblings("div.info-entry").slideUp("slow");
		}
	}); 
}
if($("a.frind-list-dropdown")) {
	$("a.frind-list-dropdown").click(function () {
		if($(this).parent().siblings("dd.friend-list-dd").is(":hidden")) {
			$(this).parent().siblings("dd.friend-list-dd").slideDown("slow");
		}
		else {
			$(this).parent().siblings("dd.friend-list-dd").slideUp("slow");
		}
	}); 	
}
});	