// JavaScript Document


function blockUnblockUI(){
	$().ajaxStop($.unblockUI);
	block();
}

function block(){
	$.blockUI('<img src="/app/images/ajax-loader3.gif" align="absmiddle"/>&nbsp;&nbsp;Пожалуйста, подождите...', { 
        border: 'none', 
        padding: '15px', 
        backgroundColor: '#4E9BD7', 
        '-webkit-border-radius': '10px', 
        '-moz-border-radius': '10px', 
        opacity: '.5', 
        color: '#fff' 
    });
	//document.write('Unblocked');
}

function changeList(params, list) {
	var id=$(list).val();
	params['url']=params['url'].replace('#id#', id);
	ajax(params);
}

function sendParams(params, addition, nblockui, start, end) {
	for (i in addition) {
		params['data']+=i+'='+addition[i]+'&';
	}
	ajax(params, nblockui, start, end);
}

function ajax(params, nblockui, start, end){
	if (params){
		p = eval(params);
		if (p.answer){
			if (!confirm(p.answer)){
				return false;
			}
		}
		
		if (start)
			start();
		else {
			if (p.async == true&&!nblockui) {
				block();
			}
		}
		
		if (end) {
			$().ajaxStop(end);
		} else {
			$().ajaxStop($.unblockUI);
		}
		
		//cancel(p);
		p.success = handleResponse;
		
		$.ajax(p);
	}
}

function handleResponse(msg){
	if (msg){
		p = eval(msg);
		if (p){
			if (p.clear_blocks){
				$.each(p.clear_blocks, function(i, item){
						$("div#"+item).html('');
			          });
			    p.clear_blocks = null;
			}
			if (p.location){
				document.location = p.location;
			}
			
			if (p.services){
				$.each(p.services, function(i, item){
					ajax(item);
				});
			}
			if (p.blocks){
				$.each(p.blocks, function(i, item){
						if (item.show == true){
							$("div#"+item.id).html(item.html);
							$("div#"+item.id).show();
						} else {
							$("div#"+item.id).hide();
						}
			          });
			}
		    if (p.new_blocks){
		    	$.each(p.new_blocks, function(i, item){
		    		//if ($("div#" + item.id).length == 0){
						if (item.parent_id){
							parent = "#" + item.parent_id;
						} else {
							parent = "body";
						}
						/*
						alert(item);
						alert(item.class);
						if (item.class){
							class = "class='" + item.class + "'";
						} else {
							class = "";
						}*/
						$(parent).append("<div id='" + item.id + "' >" + item.html + "</div>");
						//alert(parent);
					//}
		          });
		    }
		    if (p.effects){
		    	$.each(p.effects, function(i, item){
		    		if (item.name == 'blur'){
		    			$("#"+item.id).blur();
		    		} else if (item.name == 'focus'){
		    			$("#"+item.id).focus();
		    		} else if (item.name == 'revert') {
		    			if ($("#"+item.id).attr('checked') == true){
		    				$("#"+item.id).attr('checked', false);
		    			} else {
			    			$("#"+item.id).attr('checked', true);
		    			}
		    		}
		    	});
		    }
		    cancel(msg);
		}
	}
}

function cancel(params){
		p = eval(params);
		if (p){
			if (p.clear_blocks){
				$.each(p.clear_blocks, function(i, item){
						$("div#"+item).html('');
			          });
			    p.clear_blocks = null;
			}
			if (p.disable){
				$.each(p.disable, function(i, item){
						$("div#"+item).block();
					});
			}
			if (p.enable){
				$.each(p.enable, function(i, item){
						$("div#"+item).unblock();
					});
			}
			if (p.hide){
				$.each(p.hide, function(i, item){
						$("div#"+item).hide();
					});
			}
			if (p.show){
				$.each(p.show, function(i, item){
						$("div#"+item).show();
					});
			}
		}
}

function save(params){
	p = eval(params);
	tmp = getFormData(p);
	p.data = "";
	$.each(tmp, function(key, value){
				if (p.data){
					p.data += "&";
				}
				p.data += key + "=" +value;
			});
	p.success = handleResponse;
	ajax(p);
}

function getFormData(p){

	parameter = new Object;
	parameter.p = p.p;
	form_id = p.data.form_id;
	a = $('#'+ form_id +' :text');
	ind = 0;
	for (i = 0; i < a.length; i++){
		//parameter += '&' + a[i].name + '=' + a[i].value;
		
		if(a[i].name.substr(a[i].name.length-2,a[i].name.length-1) == '[]') {
			parameter[a[i].name+'_'+ind] = a[i].value;
			ind++;			
			//alert (a[i].name+' = '+a[i].value);	
		} else {
			parameter[a[i].name] = a[i].value;	
		}
		
	}
	
	a = $('#'+form_id+' :select');
	for (i = 0; i < a.length; i++){
		if (a[i].selectedIndex >= 0){
			val = a[i].options[a[i].selectedIndex].value;
		} else {
			val = 0;
		}
		//alert(a[i].name+'='+val+'('+a[i].selectedIndex+')');
		//parameter += '&' + a[i].name + '=' + val;
		parameter[a[i].name] = val;
	}
	
	a = $('#'+form_id+' :checkbox[@checked]');
	for (i = 0; i < a.length; i++){
		//parameter += '&' + a[i].name + '=' + a[i].value;
		if (a[i].value == 'on'){
			parameter[a[i].name] = 1;
		}
	}
	
	a = $('#'+form_id+' :radio[@checked]');
	for (i = 0; i < a.length; i++){
		//parameter += '&' + a[i].name + '=' + a[i].value;
		parameter[a[i].name] = a[i].value;
	}
	
	a = $('#'+form_id+' :textarea');
	for (i = 0; i < a.length; i++){
		//parameter += '&' + a[i].name + '=' + a[i].value;
		//parameter[a[i].name] = a[i].value;
		if(a[i].name.substr(a[i].name.length-2,a[i].name.length-1) == '[]') {
			parameter[a[i].name+'_'+ind] = a[i].value;
			ind++;			
			//alert (a[i].name+' = '+a[i].value);	
		} else {
			parameter[a[i].name] = a[i].value;	
		}
	}
	a = $('#'+form_id+' :hidden');
	for (i = 0; i < a.length; i++){
		//parameter += '&' + a[i].name + '=' + a[i].value;
		parameter[a[i].name] = a[i].value;
	}
	a = $('#'+form_id+' :password');
	for (i = 0; i < a.length; i++){
		//parameter += '&' + a[i].name + '=' + a[i].value;
		parameter[a[i].name] = a[i].value;
	}
	
	
	if (p.editors){
		$.each(p.editors, function(i, item){
			try{
				var oEditor = FCKeditorAPI.GetInstance(item);
				var content = oEditor.GetXHTML( true ) ;
				content = encodeURIComponent(content);
				//parameter += '&' + editorName + '=' + content;
				parameter[editorName] = content;
			} catch(e){}
			});
	}
	return parameter;
}