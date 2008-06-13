<?php
class FlashMessageView extends BaseView{
	
		function show($list, $category=FM::INFO){
			$this -> setTemplate(null, 'flash_message.tpl.php');
			$this -> assign('messages', $list);
			$this -> assign('category', $category);
			return $this -> parse();
			
		}
		
		function addFlashMessage(){
			throw new TemplateException("Can't add flash message to FlashMessageView:: will be endless loop!!!");
		}
}
?>
