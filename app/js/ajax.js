// JavaScript Document
function blockUnblockUI(){
	$().ajaxStop($.unblockUI);
	block();
}

function block(){
	$.blockUI('Пожалуйста, подождите...');
}
  

function ajax(params){
	if (params){
		p = eval(params);
		if (p.answer){
			if (!confirm(p.answer)){
				return false;
			}
		}
		if (p.async == true){
			blockUnblockUI();
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
						if (item.class){
							class = 'class="' + item.class + '"';
						} else {
							class = '';
						}
						$(parent).append("<div id='" + item.id + "' " + class + ">" + item.html + "</div>");
						//alert(parent);
					//}
		          });
		    }
		    cancel(msg);
		}
	}
}

function cancel(params){
		p = eval(params);
		if (p){
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
	for (i = 0; i < a.length; i++){
		//parameter += '&' + a[i].name + '=' + a[i].value;
		parameter[a[i].name] = a[i].value;
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
		parameter[a[i].name] = a[i].value;
	}
	a = $('#'+form_id+' :hidden');
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