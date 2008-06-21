<script>
var tbody = document.getElementById('dialog').getElementsByTagName('TBODY')[0];
		var row = document.createElement("TR");
    	tbody.appendChild(row);
    	var td1 = document.createElement("TD");
    	var td2 = document.createElement("TD");
    	row.appendChild(td1);
    	row.appendChild(td2);
    	td1.innerHTML = "Загаловок страницы";
    	td2.innerHTML = '<input type="text" id="title_page[]" name="title_page[]" />';
    	var row = document.createElement("TR");
    	tbody.appendChild(row);
    	var td1 = document.createElement("TD");
    	var td2 = document.createElement("TD");
      	row.appendChild(td1);
    	row.appendChild(td2);
    	td1.innerHTML = "Текст страницы <?=$this->num_page-1?>";
    	td2.innerHTML = '<?php
				$oFCKeditor = new FCKeditor("content_page[".($this->num_page-1)."]") ;
				$oFCKeditor -> BasePath = $this -> js_url.'fckeditor/' ;
				$oFCKeditor -> Width = 700;
				$oFCKeditor -> Create();
			?>';
    	document.getElementById('add_btn').innerHTML = "<input type='button' onClick='ajax(<?=addcslashes($this->add_page_link, "'\\\r\n\"\'")?>)' value='Добавить страницу'>";
    	document.getElementById('save_btn').innerHTML = "<a href='#' onclick='save(<?=addcslashes($this->save_param, "'\\\r\n\"\'")?>);'>Сохранить</a>";
</script> 

