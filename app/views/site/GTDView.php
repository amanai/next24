<?php
class GTDView extends BaseSiteView{
	protected $_dir = 'gtd';
	private $GTDTree;
	private $CategoryName;
	private $FolderName;
	private $folder_id;
	private $filesTree;
	private $_stack;
	private $category_id;
	
	public function __set($name,$var) {
		$this->_stack[$name] = $var;
	}
	public function viewSelectUserList() {
		$users = $this->_stack['users'];
		$selected_user = $this->_stack['selected_user'];
		$result = '<form name="usr_list" method="post" action="'.Project::getRequest() -> createUrl('GTD','GTDViewAnotherUserCategories').'">';
		$result .= '<select name="usr" onchange="usr_list.submit();">';
		foreach ($users as $id => $user) {
			$result .= '<option '.(($id==$selected_user)?'selected="selected"':'').' value="'.$id.'">'.$user['full_name'].'</option>';
		}
		$result .= '</select></form>';
		return $result;
	}
	public function viewSelectSecureUserList($name,$key,$section,$style = '') {
		$user_id = Project::getUser() -> getDbUser() -> id;
		$users = $this->_stack['users'];
		$result = '<form '.$style.' name="usr_list'.$key.'" method="post" action="'.Project::getRequest() -> createUrl('GTD','GTDAddSecureUser').'">';
		$result .= '<select name="'.$name.'" onchange="usr_list'.$key.'.submit();">';
		$result .= '<option>Добавить пользователя...</option>';
		foreach ($users as $id => $user) {
			if($id!=$user_id) {
				$result .= '<option value="'.$id.'">'.$user['full_name'].'</option>';
			}	
		}
		$result .= '</select><input type="hidden" name="id" value="'.$key.'" />
		<input type="hidden" name="section" value="'.$section.'" /></form>';
		return $result;
	}	
	public function GTDOutput() {
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'gtd.tpl.php');
	//	$this->set($data);
	}	
	public function GTDOutputFolders($CategoryName,$category_id) {
		$this->category_id = $category_id;
		$this->CategoryName = $CategoryName;
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'gtdfolders.tpl.php');
	//	$this->set($data);
	}	
	public function GTDOutputFiles($CategoryName,$FolderName,$category_id,$folder_id) {
		$this->folder_id = $folder_id;
		$this->category_id = $category_id;
		$this->CategoryName = $CategoryName;
		$this->FolderName = $FolderName;
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'gtdfiles.tpl.php');		
	}
	public function loadFileView() {
		if(!$this->_stack['another_user']) {	
			$result = '<form enctype="multipart/form-data" action="'.Project::getRequest() -> createUrl('GTD','GTDAddFile').'/cid:'.$this->category_id.'/fid:'.$this->folder_id.'" method="post">
				<input type="file" name="FileName" value="" />
				<input type="submit" name="AddCategory" value="Загрузить Файл" />
				<input type="radio" checked="checked" name="secure" value="0"> Доступен для всех
				<input type="radio" name="secure" value="1"> По приглашению
				</form>';	
			return $result;	
		}
	}
	public function TreeFilesView() {
		return $this->filesTree;
	}
	public function BuldTreeFilesView($files) {
		$result = '<ul class="checkbox_tree">';
		foreach ($files as $key => $value) {
			$path = str_replace('#','/',$value['file_path']);
			$result .= '<li><a href="http://next24.home'.$path.'">'.$value['file_name'].'</a> -- <a href="'.Project::getRequest() -> createUrl('GTD','GTDDeleteFile').'/flid:'.$key.'">Удалить файл</a>';
			if($value['secure']) {
				$result .= ' (Добавить пользователя для просмотра '.$this->viewSelectSecureUserList('addusr',$key,3,'style="display: inline;"').')';
			}	
			$result .= '</li>';
		}
		$result .= '</ul>';
		$this->filesTree = $result;
	}
	public function BuldAnotherUserTreeFilesView($files) {
		$result = '<ul class="checkbox_tree">';
		if($files) {
			foreach ($files as $key => $value) {
				$path = str_replace('#',DIRECTORY_SEPARATOR,$value['file_path']);
				$result .= '<li><a href="'.$path.'">'.$value['file_name'].'</a> -- <a href="'.Project::getRequest() -> createUrl('GTD','GTDDeleteFile').'/flid:'.$key.'">Удалить файл</a></li>';
			}
			$result .= '</ul>';
		}
		else {
			$result = '<span style="color:red;">У данного ползователя нет файлов или они запрещены для просмотра !</span>';
		}
		$this->filesTree = $result;
	}	
	public function viewCategoryName() {
		if($this->_stack['another_user']) {
			return '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewAnotherUserCategories').'/usr:'.$this->_stack['selected_user'].'">Группы</a> :: '.$this->CategoryName;		
		}
		else {
			return '<a href="'.Project::getRequest() -> createUrl('GTD','gtd').'">Группы</a> :: '.$this->CategoryName;	
		}	
	}
	public function viewFolderName() {
		if($this->_stack['another_user']) {
			return '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewAnotherUserCategories').'/usr:'.$this->_stack['selected_user'].'">Группы</a> :: '.$this->CategoryName.' :: <a href="'.Project::getRequest() -> createUrl('GTD','GTDViewAnotherUserFolders').'/cid:'.$this->category_id.'/usr:'.$this->_stack['selected_user'].'">Папки</a> :: '.$this->FolderName;
		}
		else {
			return '<a href="'.Project::getRequest() -> createUrl('GTD','gtd').'">Группы</a> :: '.$this->CategoryName.' :: <a href="'.Project::getRequest() -> createUrl('GTD','GTDViewFolders').'/cid:'.$this->category_id.'">Папки</a> :: '.$this->FolderName;	
		}
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
	public function buildAnotherUserViewTreeCategories($categories) {
		$this->GTDTree = '<ul class="checkbox_tree">';
		$this->buildAnotherUserTreeCategories($categories);
		$this->GTDTree .= '</ul>';		
	}
	public function buildAnotherUserViewTreeFolders($folders) {
		$this->GTDTree .= '<ul class="checkbox_tree">';
		$this->buildAnotherUserTreeFolders($folders);
		$this->GTDTree .= '</ul>';		
	}	
	public function buildAnotherUserTreeFolders($folders) {
			if(is_array($folders)) {
			foreach ($folders['subfolders'] as $key => $values) {		
				$this->GTDTree .= '<li>';
				if($values['subfolders']) {
					$this->GTDTree .= '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" />';	
				}				
				$this->GTDTree .= '<label style="white-space: nowrap; ">';				
				$this->GTDTree .= '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewAnotherUserFiles').'/fid:'.$values['id'].'/cid:'.$this->category_id.'/usr:'.$this->_stack['selected_user'].'">'.$values['folder_name'].'</a></label>';								
				if($values['subfolders']) {
					$this->GTDTree .= '<ul class="checkbox_tree">';
				}
				$this->buildAnotherUserTreeFolders($values);
				if($values['subfolders']) {
					$this->GTDTree .= '</ul>';	
				}
			}
		}
		else {
				$this->GTDTree =  '<span style="color:red;">У данного ползователя не создано ни одной папки или они запрещены для просмотра !</span>';
		}		
	}	
	public function buildAnotherUserTreeCategories($categories) {
			if(is_array($categories)) {
			foreach ($categories['subcategories'] as $key => $values) {		
				$this->GTDTree .= '<li>';
				if($values['subcategories']) {
					$this->GTDTree .= '<img class="minus" height="11" width="11" alt="" src="'.$this -> image_url.'1x1.gif" />';	
				}				
				$this->GTDTree .= '<label style="white-space: nowrap; ">';				
				$this->GTDTree .= '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewAnotherUserFolders').'/cid:'.$values['id'].'/usr:'.$this->_stack['selected_user'].'">'.$values['category_name'].'</a></label>';								
				if($values['subcategories']) {
					$this->GTDTree .= '<ul class="checkbox_tree">';
				}
				$this->buildAnotherUserTreeCategories($values);
				if($values['subcategories']) {
					$this->GTDTree .= '</ul>';	
				}
			}
		}
		//else {
			//	$this->GTDTree =  '<span style="color:red;">У данного ползователя не создано ни одной группы или они запрещены для просмотра !</span>';
		//}	
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
				$this->GTDTree .= '<input type="submit" name="AddCategory" value="Добавить группу" /><input type="radio" checked="checked" name="secure" value="0"> Доступно для всех
				<input type="radio" name="secure" value="1"> По приглашению';
				$this->GTDTree .= '</form>';				
				$this->GTDTree .= '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewFolders').'/cid:'.$values['id'].'">'.$values['category_name'].'</a> -- <a href="'.Project::getRequest() -> createUrl('GTD','GTDDeleteCategory').'/cid:'.$values['id'].'">Удалить группу</a>';
				if($values['secure']) {
					$this->GTDTree .= ' (Добавить пользователя для просмотра '.$this->viewSelectSecureUserList('addusr',$values['id'],1,'style="display: inline;"').')';
				}	
				$this->GTDTree .= '</label>';								
				if($values['subcategories']) {
					$this->GTDTree .= '<ul class="checkbox_tree">';
				}
				$this->buildTreeCategories($values);
				if($values['subcategories']) {
					$this->GTDTree .= '</ul>';	
				}
			}
		}
		else {
				$this->GTDTree =  '<form action="'.Project::getRequest() -> createUrl('GTD','GTDAddCategory').'" method="post">';
				$this->GTDTree .= '<input type="text" name="CategoryName" value="" /><input type="hidden" name="id" value="0" />';
				$this->GTDTree .= '<input type="submit" name="AddCategory" value="Добавить группу" /><input type="radio" checked="checked" name="secure" value="0"> Доступно для всех
				<input type="radio" name="secure" value="1"> По приглашению';
				$this->GTDTree .= '</form>';
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
				$this->GTDTree .= '<input type="submit" name="AddFolder" value="Добавить папку" /><input type="radio" checked="checked" name="secure" value="0"> Доступно для всех
				<input type="radio" name="secure" value="1"> По приглашению';
				$this->GTDTree .= '</form>';				
				$this->GTDTree .= '<a href="'.Project::getRequest() -> createUrl('GTD','GTDViewFiles').'/fid:'.$values['id'].'/cid:'.$this->category_id.'">'.$values['folder_name'].'</a> -- <a href="'.Project::getRequest() -> createUrl('GTD','GTDDeleteFolder').'/fid:'.$values['id'].'">Удалить папку</a>';
				if($values['secure']) {
					$this->GTDTree .= ' (Добавить пользователя для просмотра '.$this->viewSelectSecureUserList('addusr',$key,2,'style="display: inline;"').')';
				}	
				$this->GTDTree .= '</label>';												
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
				$this->GTDTree =  '<form action="'.Project::getRequest() -> createUrl('GTD','GTDAddFolder').'/usr:'.$this->_stack['selected_user'].'" method="post">';
				$this->GTDTree .= '<input type="text" name="FolderName" value="" /><input type="hidden" name="id" value="0" /><input type="hidden" name="cid" value="'.$this->getCategoryId().'" />';
				$this->GTDTree .= '<input type="submit" name="AddFolder" value="Добавить папку" /><input type="radio" checked="checked" name="secure" value="0"> Доступно для всех
				<input type="radio" name="secure" value="1"> По приглашению';
				$this->GTDTree .= '</form>';
		}
	}	
}		
?>