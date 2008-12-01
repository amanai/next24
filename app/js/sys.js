


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
        
        //strCommentText = strip_tags(strCommentText, '');
        
        var strTemp = '[quote name="'+commentUser+'"]';
        strTemp += strCommentText;
        strTemp += '[/quote]';
        
        $("#addCommentArea").attr("value", addCommentArea.value+strTemp+'\n');
    }
}

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}

function strip_tags(str, allowed_tags) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Luke Godfrey
    // +      input by: Pul
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // +      input by: Alex
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Marc Palau
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: strip_tags('<p>Kevin</p> <br /><b>van</b> <i>Zonneveld</i>', '<i><b>');
    // *     returns 1: 'Kevin <b>van</b> <i>Zonneveld</i>'
    // *     example 2: strip_tags('<p>Kevin <img src="someimage.png" onmouseover="someFunction()">van <i>Zonneveld</i></p>', '<p>');
    // *     returns 2: '<p>Kevin van Zonneveld</p>'
    // *     example 3: strip_tags("<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>", "<a>");
    // *     returns 3: '<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>'
 
    var key = '', tag = '', allowed = false;
    var matches = allowed_array = [];
 
    var replacer = function(search, replace, str) {
        return str.split(search).join(replace);
    };
 
    // Build allowes tags associative array
    if (allowed_tags) {
        allowed_array = allowed_tags.match(/([a-zA-Z]+)/gi);
    }
  
    str += '';
 
    // Match tags
    matches = str.match(/(<\/?[^>]+>)/gi);
 
    // Go through all HTML tags
    for (key in matches) {
        if (isNaN(key)) {
            // IE7 Hack
            continue;
        }
 
        // Save HTML tag
        html = matches[key].toString();
 
        // Is tag not in allowed list? Remove from str!
        allowed = false;
 
        // Go through all allowed tags
        for (k in allowed_array) {
            // Init
            allowed_tag = allowed_array[k];
            i = -1;
 
            if (i != 0) { i = html.toLowerCase().indexOf('<'+allowed_tag+'>');}
            if (i != 0) { i = html.toLowerCase().indexOf('<'+allowed_tag+' ');}
            if (i != 0) { i = html.toLowerCase().indexOf('</'+allowed_tag)   ;}
 
            // Determine
            if (i == 0) {
                allowed = true;
                break;
            }
        }
 
        if (!allowed) {
            str = replacer(html, "", str); // Custom replace. No regexing
        }
    }
 
    return str;
}
