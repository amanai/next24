


function ShowOrHide(ob, d1, d2)
{
	if (d1 != '')
	{
		DoDiv(ob, d1);
	}
	if (d2 != '')
	{
		DoDiv(ob, d2);
	}
}

function setState(id) {
	if ($('#'+id).val()==1) {
		$('#'+id).val(2);
	} else {
		$('#'+id).val(1);
	}
}

function DoDiv(ob, id)
{
	var item = null;
	if (document.getElementById)
	{
		item = document.getElementById(id);
	}
	else if (document.all)
	{
		item = document.all[id];
	}
	else if (document.layers)
	{
		item = document.layers[id];
	}
	if (!item)
	{
	}
	else if (item.style)
	{
		if (item.style.display == "none")
		{
			ob.src = ob.src.replace(/open/, 'close');
			//item.style.display = "";
			$(item).animate({
				  			height: 'toggle', opacity: 'toggle'
							}, "normal");
			//$(item).fadeIn("slow");
		}
		else
		{
			ob.src = ob.src.replace(/close/, 'open');
			//item.style.display = "none";
			$(item).animate({
				  			height: 'toggle', opacity: 'toggle'
							}, "normal");
			//$(item).fadeOut("slow");
		}
	}
	else
	{
		item.visibility = "show";
	}
}