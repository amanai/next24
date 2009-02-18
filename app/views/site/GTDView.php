<?php
class GTDView extends BaseSiteView{
	protected $_dir = 'gtd';
	private $GTDTree;
	
	public function GTDOutput() {
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'gtd.tpl.php');
	//	$this->set($data);
	}	
	public function viewTreeCategories() {
		return $this->GTDTree;
	}
	public function buildViewTreeCategories($categories){
		$this->GTDTree .= '<ul class="checkbox_tree">';
		$this->buildTreeCategories($categories);
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
				$this->GTDTree .= '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewFolders').'">'.$values['category_name'].'</a></label>';								
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
	public function buildTreeFolders($folders) {
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
				$this->GTDTree .= '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewFolders').'">'.$values['category_name'].'</a></label>';								
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
}		
?>