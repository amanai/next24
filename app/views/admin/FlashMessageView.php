<?php
class FlashMessageView extends BaseAdminView{
	
		function show($list){
			$this -> setTemplate(null, 'flash_message.tpl.php');
			$this -> assign('messages', $list);
			return $this -> parse();
			
		}
		
		function addFlashMessage(){
			throw new TemplateException("Can't add flash message to FlashMessageView:: will be endless loop!!!");
		}
}
?>
