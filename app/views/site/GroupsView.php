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
	public function topicsView() {
		$this->_js_files[] = 'jquery.js';
	    $this->_js_files[] = 'news_tree.js';
	    $this->_css_files[] = 'news_tree.css';
		$this->setTemplate(null, 'inner_sub_groups.php');
	//	$this->set($data);			
	}
	public function messagesView() {
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
	public function createNewTopicForm() {
		$pid = $this->_stack['pid'];
		$result = '<form action="'.Project::getRequest() -> createUrl('Groups','topicCreate').'" method="post" />
					<table>
						<tr>
							<td>
								Название темы :
							</td>
							<td>
								<input type="text" name="full_name" />
							</td>
							<td>
								<input type="submit" name="crete_new_sub_group" value="Создать тему" />
							</td>
						</tr>
						<tr>
							<td>
								Описание :
							</td>
							<td>
								<input type="text" name="description" />
							</td>
							<td>
								Фотоальбом : <input type="checkbox" name="photo_album" value="1" />	
							</td>
						</tr>
					</table>
					<input type="hidden" name="pid" value="'.$pid.'" />
				   </form>';
		return $result;
	}
	public function createNewMessageForm() {
		$tid = $this->_stack['tid'];
		$pid = $this->_stack['pid'];
		$alter_message = $this->_stack['alter_message'];
		if(!isset($alter_message)) {
			$result = '<form action="'.Project::getRequest() -> createUrl('Groups','messageCreate').'" method="post" />
					<table>
						<tr>
							<td>
								Сообщение :
							</td>
							<td>
								<input type="text" name="message_name" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea name="message_content" style="width: 100%;"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="crete_new_sub_group" value="Создать сообщение" />
							</td>
						</tr>						
					</table>
					<input type="hidden" name="pid" value="'.$pid.'" />
					<input type="hidden" name="tid" value="'.$tid.'" />
				   </form>';
			return $result;
		}
		else {	
			$result = '<form action="'.Project::getRequest() -> createUrl('Groups','messageAlter').'" method="post" />
					<table>
						<tr>
							<td>
								Сообщение :
							</td>
							<td>
								<input type="text" name="message_name" value="'.$alter_message['message_name'].'" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea name="message_content" style="width: 100%;">'.$alter_message['message_content'].'</textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="alter" value="Изменить сообщение" />
							</td>
						</tr>						
					</table>
					<input type="hidden" name="pid" value="'.$pid.'" />
					<input type="hidden" name="tid" value="'.$tid.'" />
					<input type="hidden" name="mid" value="'.$alter_message['id'].'" />
				   </form>';
			return $result;			
		}
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
			$result .= '<br /><a href="'.Project::getRequest() -> createUrl('Groups','topicView').'/pid:'.$sub_group['id'].'">'.$sub_group['full_name'].'</a>';
		}
		return $result;		
	}
	public function createTopicsTree() {
		$topics = $this->_stack['topics'];
		foreach ($topics as $topic) {
			$result .= '<br /><a href="'.Project::getRequest() -> createUrl('Groups','messagesView').'/pid:'.$topic['group_id'].'/tid:'.$topic['id'].'">'.$topic['full_name'].'</a>';
		}
		return $result;		
	}	
	public function createMessagesTree() {
		$messages = $this->_stack['messages'];
		$pid = $this->_stack['tid'];
		foreach ($messages as $message) {
			$result .= '<br /><div style="font-weight: bold;">'.$message['message_name'].'</div><div><div>'.$message['message_content'].'</div><div><a href="'.Project::getRequest() -> createUrl('Groups','messageDelete').'/pid:'.$pid.'/tid:'.$message['id_topic'].'/mid:'.$message['id'].'">удалить</a>&nbsp;&nbsp;<a href="'.Project::getRequest() -> createUrl('Groups','messageAlter').'/pid:'.$pid.'/tid:'.$message['id_topic'].'/mid:'.$message['id'].'">изменить</a></div></div>';
		}
		return $result;			
	}
}		
?>