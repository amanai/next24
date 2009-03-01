<?php
class GroupsView extends BaseSiteView{
	protected $_dir = 'groups';
	private $_stack;
	public function __construct() {
		parent::__construct();
	}
	public function __set($name,$var) {
		$this->_stack[$name] = $var;
	}
	public  function groupsView() {
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'main_groups.tpl.php');
	//	$this->set($data);
	}
	public function subGroupView() {
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'inner_group.tpl.php');
	//	$this->set($data);			
	}
	public function topicView() {
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'topic_forum.tpl.php');
	//	$this->set($data);			
	}
	public function createNewGroupForm() {
		$pid = $this->_stack['pid'];
		$result = '<form action="'.Project::getRequest() -> createUrl('Groups','groupsCreate').'" method="post" />
					<table>
						<tr>
							<td>
								Название группы :
							</td>
							<td>
								<input type="text" name="full_name" />
							</td>
							<td>
								<input type="submit" name="crete_new_group" value="Создать группу" />
							</td>
						</tr>
						<tr>
							<td>
								Описание :
							</td>
							<td colspan="2">
								<input type="text" name="description" />
							</td>
						</tr>
						<tr>
							<td>
								Тип группы :
							</td>
							<td>
				   				<select name="id_group_name">
				   					<option value="1">Сообщество</option>
				   					<option value="2">Фан-клуб</option>
				   				</select>							
							</td>
						</tr>	
					</table>
					<input type="hidden" name="pid" value="'.$pid.'" />	
				   </form>';
		return $result;
	}
	public function createNewSubGroupForm() {
		$pid = $this->_stack['pid'];
		$result = '<form action="'.Project::getRequest() -> createUrl('Groups','subGroupCreate').'" method="post" />
					<table>
						<tr>
							<td>
								Название группы :
							</td>
							<td>
								<input type="text" name="full_name" />
							</td>
							<td>
								<input type="submit" name="crete_new_sub_group" value="Создать подгруппу" />
							</td>
						</tr>
						<tr>
							<td>
								Описание :
							</td>
							<td colspan="2">
								<input type="text" name="description" />
							</td>
						</tr>
					</table>
					<input type="hidden" name="pid" value="'.$pid.'" />	
				   </form>';
		return $result;
	}	
	public function createGroupsTree() {
		$groups = $this->_stack['groups'];
		foreach ($groups as $group) {
			$result .= '<br /><a href="'.Project::getRequest() -> createUrl('Groups','subGroupView').'/id:'.$group['id'].'">'.$group['full_name'].'</a>
						<br />Метка группы : '.$group['group_name'].'<br />';
		}
		return $result;
	}
	public function createSubGroupsTree() {
		$sub_groups = $this->_stack['sub_groups'];
		foreach ($sub_groups as $sub_group) {
			$result .= '<br /><a href="'.Project::getRequest() -> createUrl('Groups','topicView').'/tid:'.$sub_group['id'].'">'.$sub_group['full_name'].'</a>';
		}
		return $result;		
	}
}		
?>