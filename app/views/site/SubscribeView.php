<?php
class SubscribeView extends BaseSiteView{
	protected $_dir = 'subscribe';
	
	
		function SubscribeList($info){
			$this -> setTemplate($this -> _dir, 'list.tpl.php');
			$this -> set($info);
		}
		
		function AjaxBlogCatalogTree($info){
			
			
			foreach($info['blog_catalog'] as &$item){
				$item['ajax_param'] = AjaxRequest::getJsonParam('Subscribe', 'AjaxBlogTree', array($item['id'], $info['level'], $info['filter']));
				$item['subscribe_param'] = AjaxRequest::getJsonParam('Subscribe', 'Change', array($item['id']));
				
			}
			
			$response = Project::getAjaxResponse();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'blog_tree.tpl.php');
			$response -> block('btl_'.$info['id'].'_'.($info['level'] - 1), true, $this -> parse());
		}
		
		function AjaxBlogTree($info){
			foreach($info['blog_catalog'] as $key=>&$item){
				if ($info['id'] == $item['id']){
					unset($info['blog_catalog'][$key]);
				} else {
					$item['ajax_param'] = AjaxRequest::getJsonParam('Subscribe', 'AjaxBlogTree', array($item['id'], $info['level']));
					$item['subscribe_param'] = AjaxRequest::getJsonParam('Subscribe', 'Change', array($item['id']));
				}
			}
			$response = Project::getAjaxResponse();
			$this -> set($info);
			$this -> setTemplate($this -> _dir, 'blog_tree.tpl.php');
			$response -> block('btl_'.$info['id'].'_'.($info['level'] - 1), true, $this -> parse());
		}
}
?>