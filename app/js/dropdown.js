$(document).ready(function() {
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

		p.success = handleResponse;
		$.ajax(p);
	}
}

function handleResponse2(data) {
	if (data.status) {
		hideForm('register');
		alert("Заявка успешно отправлена!");
	} else {
		alert("Заполните все обязательные поля!");
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
				    if(document.getElementById(item.id)){
				        $("#"+item.id).html(item.html);
						if (item.show == true){
							$("#"+item.id).show();
						} else {
							$("#"+item.id).hide();
						}
				    }
			          });
			}
			if (p.attr){
				$.each(p.attr, function(i, item){
				        if(document.getElementById(item.id)){
    						var attr_name = item.attr_name;
    						var attr_value = ''+item.attr_value;
    						$("#"+item.id).attr(attr_name, attr_value);
				        }
			          });
			}
			
			if (p.append){
				$.each(p.append, function(i, item){
				        if(document.getElementById(item.id)){
						  $("#"+item.id).append(item.html);
				        }
			        });
			}
			
			if (p.prepend){
				$.each(p.prepend, function(i, item){
				        if(document.getElementById(item.id)){
						  $("#"+item.id).prepend(item.html);
				        }
			        });
			}
			
			if (p.disable){
				$.each(p.disable, function(i, item){
				        if(document.getElementById(item)){
						  $("#"+item).block();
				        }
					});
			}
			if (p.enable){
				$.each(p.enable, function(i, item){
				        if(document.getElementById(item)){
						  $("#"+item).unblock();
				        }
					});
			}
			if (p.hide){
				$.each(p.hide, function(i, item){
				        if(document.getElementById(item)){
						  $("#"+item).hide();
				        }
					});
			}
			if (p.show){
				$.each(p.show, function(i, item){
				        if(document.getElementById(item)){
						  $("#"+item).show();
				        }
					});
			}
			
		    if (p.new_blocks){
		    	$.each(p.new_blocks, function(i, item){
						if (item.parent_id){
							parent = "#" + item.parent_id;
						} else {
							parent = "body";
						}
						
						$(parent).append("<div id='" + item.id + "' >" + item.html + "</div>");
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
		    
		    if (p.runFunction){
				$.each(p.runFunction, function(i, item){
				        eval(item.fName);
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
		//parameter[a[i].name] = a[i].value;
		if(a[i].name.substr(a[i].name.length-2,a[i].name.length-1) == '[]') {
			parameter[a[i].name+'_'+ind] = a[i].value;
			ind++;			
			//alert (a[i].name+' = '+a[i].value);	
		} else {
			parameter[a[i].name] = a[i].value;	
		}
		
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
	
	if (p.data.editor_form) {
		$.each(p.data.editor_form, function(i, item) {
			try{
				var oEditor = FCKeditorAPI.GetInstance(item);
				var content = oEditor.GetXHTML( true ) ;
				content = encodeURIComponent(content);
				parameter[item] = content;
			} catch(e){}
		})
	}
	return parameter;
}