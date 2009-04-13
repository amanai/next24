


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
			$("#"+id).slideDown("slow");
			/*$(item).animate({
				  			height: 'toggle', opacity: 'toggle'
							}, "normal");*/
		}
		else
		{
			ob.src = ob.src.replace(/close/, 'open');
			//item.style.display = "none";
			$("#"+id).slideUp("slow");
			/*$(item).animate({
				  			height: 'toggle', opacity: 'toggle'
							}, "normal");*/
		}
	}
	else
	{
		item.visibility = "show";
	}
}

function commentMoodCheck(){
    if ($("#mood_id").val() == 0){
        $("#mood_text").show();
    }else{
        $("#mood_text").hide();
        $("#mood_text").attr("value", "");
    }
}


function commentQuote(quoteId, commentUser){
    var quoteDiv = document.getElementById('comment_quote'+quoteId);
    var addCommentArea = document.getElementById('addCommentArea');
    if (quoteDiv && addCommentArea){
        var strCommentText = trim(quoteDiv.innerHTML);
        strCommentText = strCommentText.split('\n').join('');
        
        reg=/<div.*?<\/div>/gi;
        strCommentText=strCommentText.replace(reg, "");
        
        reg=/<br>/g;
        strCommentText=strCommentText.replace(reg, "\n");
        
        var strTemp = '[quote name="'+commentUser+'"]';
        strTemp += strCommentText;
        strTemp += '[/quote]';
        
        $("#addCommentArea").attr("value", addCommentArea.value+strTemp+'\n');
    }
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}


function showChangeComment(elemId){
    var editCommentDiv = document.getElementById('div_comment_edit'+elemId);
    if (editCommentDiv){
        elem = $("#div_comment_edit"+elemId);
        if (elem.hasClass("hidden")){
            elem.removeClass("hidden");
            elem.addClass("showen");
        }else{
            elem.removeClass("showen");
            elem.addClass("hidden");
        }
    }  
}