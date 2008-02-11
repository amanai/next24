$(document).ready(function() {
    $(".button").pngfix();
	$(".icon div").pngfix();
	$(".button").bind("mouseover", function(){
		var cl=$(this).attr("class").split(" ");
		$(this).addClass(cl[cl.length-1]+'_hover');
	});
	$(".button").bind("mouseout", function(){
		var cl=$(this).attr("class").split(" ");
		$(this).removeClass(cl[cl.length-1]);
	});
	$(".sm").each(function(i){
		$(this).bind("mouseover",function(){ mouseOver(); });
		$(this).bind("mouseout",function(){ mouseOut($(this).attr('id')); });
	});
	$(".sub").each(function(i){
		var id=$(this).attr('id').substr(1);
		$(this).bind("mouseover",function(){ showMenu($(this), id); });
		$(this).bind("mouseout",function(){ mouseOut(id); });
	});
});