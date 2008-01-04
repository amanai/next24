<textarea name="<?php echo $field['name']; ?>" rows="40" cols="80"><?php echo $this->form['data'][$field['name']]; ?></textarea>

<script language="javascript" type="text/javascript" src="/filemanager/jscripts/mcfilemanager.js"></script>
<script language="javascript" type="text/javascript" src="/imagemanager/jscripts/mcimagemanager.js"></script>

<script language="javascript" type="text/javascript" src="/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "css/editor.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		convert_fonts_to_spans : true,
		font_size_classes : "8px,9px,10px,12px,14px,18px,22px",
		font_size_style_values : "8px,9px,10px,12px,14px,18px,22px",
		extended_valid_elements : "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		file_browser_callback : "mcFileManager.filebrowserCallBack",
		paste_auto_cleanup_on_paste : true,
		paste_convert_headers_to_strong : true
	});
</script>
