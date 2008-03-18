<?php
class SubscribeView extends BaseSiteView{
	protected $_dir = 'subscribe';
	
	
		function SubscribeList($info){
			$this -> setTemplate($this -> _dir, 'list.tpl.php');
			$this -> set($info);
		}
		
		function AjaxBlogCatalogTree($info){
			
			$response = Project::getAjaxResponse();
			
			if ($info['direction'] === 1){
				foreach($info['blog_catalog'] as &$item){
					$item['ajax_param'] = AjaxRequest::getJsonParam('Subscribe', 'AjaxBlogTree', array($item['id'], $info['level'], $info['filter'], 1));
					$item['subscribe_param'] = AjaxRequest::getJsonParam('Subscribe', 'Change', array($item['id']));
					
				}
				$ajax_param = AjaxRequest::getJsonParam('Subscribe', 'AjaxBlogCatalogTree', array($info['id'], $info['level'], $info['filter'], 0));
				$response -> block('bti_'.$info['id'].'_'.($info['level'] - 1), true, '<a href="#" onClick=\'ajax('.$ajax_param.');\'><img src="'.$this -> image_url.'icons/minus.gif" /></a>' );
				
				$this -> set($info);
				$this -> setTemplate($this -> _dir, 'blog_tree.tpl.php');
				$response -> block('btl_'.$info['id'].'_'.($info['level'] - 1), true, $this -> parse());
			} else {
				$response -> hide('btl_'.$info['id'].'_'.($info['level'] - 1));
				$ajax_param = AjaxRequest::getJsonParam('Subscribe', 'AjaxBlogCatalogTree', array($info['id'], ($info['level'] - 1), $info['filter'], 1));
				$response -> block('bti_'.$info['id'].'_'.($info['level'] - 1), true, '<a href="#" onClick=\'ajax('.$ajax_param.');\'><img src="'.$this -> image_url.'icons/plus.gif" /></a>' );
			}
		}
		
		function AjaxBlogTree($info){
			$response = Project::getAjaxResponse();
			if ($info['direction'] === 1){
				foreach($info['blog_catalog'] as $key=>&$item){
					if ($info['id'] == $item['id']){
						unset($info['blog_catalog'][$key]);
					} else {
						$item['ajax_param'] = AjaxRequest::getJsonParam('Subscribe', 'AjaxBlogTree', array($item['id'], $info['level'], $info['filter'], 1));
						$item['subscribe_param'] = AjaxRequest::getJsonParam('Subscribe', 'Change', array($item['id']));
					}
				}
				
				$ajax_param = AjaxRequest::getJsonParam('Subscribe', 'AjaxBlogTree', array($info['id'], $info['level'], $info['filter'], 0));
				$response -> block('bti_'.$info['id'].'_'.($info['level'] - 1), true, '<a href="#" onClick=\'ajax('.$ajax_param.');\'><img src="'.$this -> image_url.'icons/minus.gif" /></a>' );
				
				$this -> set($info);
				$this -> setTemplate($this -> _dir, 'blog_tree.tpl.php');
				$response -> block('btl_'.$info['id'].'_'.($info['level'] - 1), true, $this -> parse());
			} else {
				$response -> hide('btl_'.$info['id'].'_'.($info['level'] - 1));
				$ajax_param = AjaxRequest::getJsonParam('Subscribe', 'AjaxBlogTree', array($info['id'], ($info['level'] - 1), $info['filter'], 1));
				$response -> block('bti_'.$info['id'].'_'.($info['level'] - 1), true, '<a href="#" onClick=\'ajax('.$ajax_param.');\'><img src="'.$this -> image_url.'icons/plus.gif" /></a>' );
			}
			
			
			
		}
}
?>