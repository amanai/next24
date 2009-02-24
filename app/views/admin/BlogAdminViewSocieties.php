<?php
class BlogAdminViewSocieties extends BaseAdminView{
	protected $_dir = 'blog_societies';
	
	
		function CatalogList($info){
			$request = Project::getRequest();
			foreach ($info['catalog_list'] as &$item){
				$param = array($item['id'], (int)$info['page_number']);
				$item['edit_link'] = $request -> createUrl($info['edit_controller'], $info['edit_action'], $param);
			}
			$this -> setTemplate($this -> _dir, 'catalog_list.tpl.php');
			$this -> set($info);
		}
		
		function CatalogEdit($info){
			$request = Project::getRequest();
			foreach ($info['tag_list'] as &$item){
				$p = $info['common_param'];
				$p[] = $item['id'];
				$item['delete_link'] = $request -> createUrl('BlogAdmin', 'CatalogDeleteTag', $p);
			}
			
			$this -> setTemplate($this -> _dir, 'catalog_edit.tpl.php');
			$this -> set($info);
		}
		
}
?>