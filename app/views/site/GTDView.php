<?php
class GTDView extends BaseSiteView{
	protected $_dir = 'gtd';
	private $GTDTree;
	private $CategoryName;
	
	public function GTDOutput() {
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'gtd.tpl.php');
	//	$this->set($data);
	}	
	public function GTDOutputFolders($CategoryName) {
		$this->CategoryName = $CategoryName;
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'gtdfolders.tpl.php');
	//	$this->set($data);
	}	
	public function viewCategoryName() {
		return '<a href="'.Project::getRequest() -> createUrl('GTD','gtd').'">Группы</a> :: '.$this->CategoryName;	
	}
	public function viewTreeCategories() {
		return $this->GTDTree;
	}
	public function buildViewTreeCategories($categories){
		$this->GTDTree .= '<ul class="checkbox_tree">';
		$this->buildTreeCategories($categories);
		$this->GTDTree .= '</ul>';
	}
	public function buildViewTreeFolders($categories){
		$this->GTDTree .= '<ul class="checkbox_tree">';
		$this->buildTreeFolders($categories);
		$this->GTDTree .= '</ul>';
	}	
	public function buildTreeCategories($categories) {
		if(is_array($categories)) {
			foreach ($categories['subcategories'] as $key => $values) {		
				$this->GTDTree .= '<li>';
				if($values['subcategories']) {
					$this->GTDTree .= '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" />';	
				}				
				$this->GTDTree .= '<label style="white-space: nowrap; ">';
				$this->GTDTree .=  '<form action="'.Project::getRequest() -> createUrl('GTD','GTDAddCategory').'" method="post">';
				$this->GTDTree .= '<input type="text" name="CategoryName" value="" /><input type="hidden" name="id" value="'.$values['id'].'" />';
				$this->GTDTree .= '<input type="submit" name="AddCategory" value="Добавить группу" />';
				$this->GTDTree .= '</form>';				
				$this->GTDTree .= '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewFolders').'/cid:'.$values['id'].'">'.$values['category_name'].'</a></label>';								
				if($values['subcategories']) {
					$this->GTDTree .= '<ul class="checkbox_tree">';
				}
				$this->buildTreeCategories($values);
				if($values['subcategories']) {
					$this->GTDTree .= '</ul>';	
				}
				$this->GTDTree .= '</li>';
			}
		}
		else {
			throw new TemplateException("Argument is not an array !");
		}
	}
	public function getCategoryId() {
		$v_request = Project::getRequest();
		$request_keys = $v_request->getKeys();		
		return $request_keys['cid'];
	}
	public function buildTreeFolders($folders) {
		if(is_array($folders)) {
			foreach ($folders['subfolders'] as $key => $values) {		
				$this->GTDTree .= '<li>';
				if($values['subfolders']) {
					$this->GTDTree .= '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" />';	
				}				
				$this->GTDTree .= '<label style="white-space: nowrap; ">';
				$this->GTDTree .=  '<form action="'.Project::getRequest() -> createUrl('GTD','GTDAddFolder').'" method="post">';
				$this->GTDTree .= '<input type="text" name="FolderName" value="" /><input type="hidden" name="id" value="'.$values['id'].'" /><input type="hidden" name="cid" value="'.$this->getCategoryId().'" />';
				$this->GTDTree .= '<input type="submit" name="AddFolder" value="Добавить папку" />';
				$this->GTDTree .= '</form>';				
				$this->GTDTree .= '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewFolders').'">'.$values['folder_name'].'</a></label>';								
				if($values['subfolders']) {
					$this->GTDTree .= '<ul class="checkbox_tree">';
				}
				$this->buildTreeFolders($values);
				if($values['subfolders']) {
					$this->GTDTree .= '</ul>';	
				}
				$this->GTDTree .= '</li>';
			}
		}
		else {
			throw new TemplateException("Argument is not an array !");
		}
	}	
	public function categoryName() {
		
	}
}		
?>