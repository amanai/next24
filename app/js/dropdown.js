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
if($("div.widget")) {
	widget_height = 0;
	
	$("div.widget").draggable({ 
	zIndex: 2700, 
//	containment: 'document', 
//	cursor: 'resize', 
	handle: $(".widget-header"),
	//start: function(event, ui) { $(this).css({'position':'absolute','width':''+$(this).width()+'px'});}
	});
	$('div.column').droppable({ 
	//	accept: 'div.widget',
		activeClass: 'ui-state-highlight',
		hoverClass: 'ui-state-highlight',
		drop: function(event, ui) {
			alert('drop!!!');
			//$(this).addClass('ui-state-highlight').find('p').html('Dropped!');
		}
	});
//	$("div.widget").css({'position':'relative'});
	$("div.widget").resizable({ 
		maxWidth: $("div.widget").parent().width()-12, 
		minWidth: 265, 
		minHeight: 30,
		//start: function(event, ui) {$(this).css({'position':'relative','width':''+$(this).width()+'px'}); },
		//stop: function(event, ui) {$(this).css({'position':'static'});  }
		}); 
	$("i.widget-сollapse-icon").parent("span").click(function () {
		if($(this).parent().parent().parent().parent("div.widget").height()==26) {
			$(this).parent().parent().parent().parent("div.widget").animate({height: widget_height+"px"}, 'slow' );			
		}
		else {
			widget_height = $(this).parent().parent().parent().parent("div.widget").height();
			$(this).parent().parent().parent().parent("div.widget").animate({height: "26px"}, 'slow' );
		} 
	}); 
	$("i.widget-delete-icon").parent("span").click(function () {
		$(this).parent().parent().parent().parent().css({'display' : 'none'});
	}); 	
}
});	