var timer;
var lastid;

function showMenu(elem, id)
{
	hideMenu(lastid);
	var offset=$(elem).offset()
	var width=$(elem).width();
	$("#"+id).css('left', offset['left']+width+11);
	$("#"+id).css('top', offset['top']);
	$("#"+id).css('visibility', 'visible');
	$("#"+id).css('display', 'block');
	lastid=id;
}

function mouseOut(id)
{
	timer=setTimeout('hideMenu(\''+id+'\')',1000);
} 

function mouseOver()
{
	clearTimeout(timer);
}

function hideMenu(id)
{
	$("#"+id).css('visibility', 'hidden');
	$("#"+id).css('display', 'none');
	clearTimeout(timer);
}