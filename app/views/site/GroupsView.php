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
		$id = $this->_stack['id'];
		$alter_group = $this->_stack['alter_group'];
		if(!is_array($alter_group)) {
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
						<tr>
							<td>
								Доступ :
							</td>
							<td>
				   				<select name="access_rule">
				   					<option value="0">Доступно для всех</option>
				   					<option value="1">Доступно по заявке</option>
				   				</select>							
							</td>
						</tr>								
					</table>
					<input type="hidden" name="pid" value="'.$pid.'" />';	
					$result .= $this->createUsersTree();
				    $result .= '</form>';
			return $result;
		}
		else {
			$result = '<form action="'.Project::getRequest() -> createUrl('Groups','groupsAlter').'" method="post" />
					<table>
						<tr>
							<td>
								Название группы :
							</td>
							<td>
								<input type="text" name="full_name" value="'.$alter_group['full_name'].'" />
							</td>
							<td>
								<input type="submit" name="alter" value="Изменить группу" />
							</td>
						</tr>
						<tr>
							<td>
								Описание :
							</td>
							<td colspan="2">
								<input type="text" name="description" value="'.$alter_group['description'].'" />
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
						<tr>
							<td>
								Доступ :
							</td>
							<td>
				   				<select name="access_rule">
				   					<option value="0">Доступно для всех</option>
				   					<option value="1">Доступно по заявке</option>
				   				</select>							
							</td>
						</tr>							
					</table>
					<input type="hidden" name="id" value="'.$alter_group['id'].'" />	
				   </form>';
			return $result;				
		}
	}
	public function createNewSubGroupForm() {
		$pid = $this->_stack['pid'];
		$id = $this->_stack['id'];
		$alter_subgroup = $this->_stack['alter_subgroup'];
		if(!is_array($alter_subgroup)) {		
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
					<input type="hidden" name="pid" value="'.$pid.'" />';
				 $result.= $this->createGroupUsersTree();
				 $result.= '</form>';
			return $result;
		}
		else {
			$result = '<form action="'.Project::getRequest() -> createUrl('Groups','subGroupAlter').'" method="post" />
					<table>
						<tr>
							<td>
								Название группы :
							</td>
							<td>
								<input type="text" name="full_name" value="'.$alter_subgroup['full_name'].'" />
							</td>
							<td>
								<input type="submit" name="alter" value="Изменить подгруппу" />
							</td>
						</tr>
						<tr>
							<td>
								Описание :
							</td>
							<td colspan="2">
								<input type="text" name="description" value="'.$alter_subgroup['description'].'" />
							</td>
						</tr>
					</table>
					<input type="hidden" name="pid" value="'.$alter_subgroup['id'].'" />	
					<input type="hidden" name="id" value="'.$id.'" />	
				   </form>';
			return $result;			
		}
	}	
	public function createNewTopicForm() {
		$pid = $this->_stack['pid'];
		$tid = $this->_stack['tid'];
		$alter_topic = $this->_stack['alter_topic'];
		if(!is_array($alter_topic)) {
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
		else {
			$result = '<form action="'.Project::getRequest() -> createUrl('Groups','topicAlter').'" method="post" />
					<table>
						<tr>
							<td>
								Название темы :
							</td>
							<td>
								<input type="text" name="full_name" value="'.$alter_topic['full_name'].'" />
							</td>
							<td>
								<input type="submit" name="alter" value="Изменить тему" />
							</td>
						</tr>
						<tr>
							<td>
								Описание :
							</td>
							<td>
								<input type="text" name="description" value="'.$alter_topic['description'].'" />
							</td>
							<td>
								Фотоальбом : <input type="checkbox" name="photo_album" value="1" '.(($alter_topic['photo_album'])?'checked="checked"':'').' />	
							</td>
						</tr>
					</table>
					<input type="hidden" name="pid" value="'.$pid.'" />
					<input type="hidden" name="tid" value="'.$tid.'" />
				   </form>';
			return $result;				
		}
	}
	public function createNewMessageForm() {
		$tid = $this->_stack['tid'];
		$pid = $this->_stack['pid'];
		$alter_message = $this->_stack['alter_message'];
		if(!is_array($alter_message)) {
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
		$current_user_id = Project::getUser() -> getDbUser() -> id;
		foreach ($groups as $group) {
			if(!$group['access_rule']) {
				if(!$group['access_rule_code']) {
					$result .= '<br /><a href="'.Project::getRequest() -> createUrl('Groups','subGroupView').'/id:'.$group['id'].'">'.$group['full_name'].'</a>';
					if($group['id_user'] == $current_user_id) {
						$result .= '&nbsp;&nbsp;<a href="'.Project::getRequest() -> createUrl('Groups','groupsDelete').'/id:'.$group['id'].'">удалить</a>&nbsp;<a href="'.Project::getRequest() -> createUrl('Groups','groupsAlter').'/id:'.$group['id'].'">изменить</a>';
					}
						
					$result .= '<br />Метка группы : '.$group['group_name'].'<br />';
				}
				else {
					$result .= '<br />'.$group['full_name'].'&nbsp;&nbsp;<a href="'.Project::getRequest() -> createUrl('Groups','subGroupView').'/id:'.$group['id'].'">подать заявку</a>
								<br />Метка группы : '.$group['group_name'].'<br />';					
				}
			}
			else {
				$result .= '<br />'.$group['full_name'].'&nbsp;&nbsp;<a href="'.Project::getRequest() -> createUrl('Groups','subGroupView').'/id:'.$group['id'].'">подать заявку</a>
							<br />Метка группы : '.$group['group_name'].'<br />';					
			}
		}
		return $result;
	}
	public function createSubGroupsTree() {
		$sub_groups = $this->_stack['sub_groups'];
		$id = $this->_stack['id'];
		foreach ($sub_groups as $sub_group) {
			$result .= '<br /><a href="'.Project::getRequest() -> createUrl('Groups','topicView').'/pid:'.$sub_group['id'].'">'.$sub_group['full_name'].'</a>&nbsp;&nbsp;<a href="'.Project::getRequest() -> createUrl('Groups','subGroupDelete').'/id:'.$id.'/pid:'.$sub_group['id'].'">удалить</a>&nbsp;<a href="'.Project::getRequest() -> createUrl('Groups','subGroupAlter').'/id:'.$id.'/pid:'.$sub_group['id'].'">изменить</a>';
		}
		return $result;		
	}
	public function createTopicsTree() {
		$topics = $this->_stack['topics'];
		foreach ($topics as $topic) {
			$result .= '<br /><a href="'.Project::getRequest() -> createUrl('Groups','messagesView').'/pid:'.$topic['group_id'].'/tid:'.$topic['id'].'">'.$topic['full_name'].'</a>&nbsp;&nbsp;<a href="'.Project::getRequest() -> createUrl('Groups','topicDelete').'/pid:'.$topic['group_id'].'/tid:'.$topic['id'].'">удалить</a>&nbsp;<a href="'.Project::getRequest() -> createUrl('Groups','topicAlter').'/pid:'.$topic['group_id'].'/tid:'.$topic['id'].'">изменить</a>';
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
	public function createUsersTree() {
		$user_list = $this->_stack['user_list'];		
		$result = '<select name="users[]" multiple="multiple" style="height: 400px;">';
		$result .= '<option value="false">Выбрать пользователей</option>';
		foreach($user_list as $id => $user) {
			$result .= '<option value="'.$id.'">'.$user['full_name'].'</option>'; 
		}
		$result .= '</select>';
		return $result;
	}
	public function createGroupUsersTree() {
		$user_list = $this->_stack['user_list'];
		$result = '<table cellspacing="5">';		
		$result .= '<tr>
						<td>
							Пользователь
						</td>	
						<td>
							Чтение
						</td>
						<td>
							Создание подгрупп
						</td>
						<td>
							Принятие в группу
						</td>
						<td>
							Модерирование подгруппы
						</td>
						<td>
							Модерирование фотоальбома
						</td>
						<td>
							Публикация постов
						</td>
					</tr>';
		foreach($user_list as $id => $user) {
			$result .= '<tr>
							<td>
								'.$user['full_name'].'
							</td>
							<td style="text-align: center;">
								<input type="checkbox" disabled="disabled" name="access_rule[1]" value="1" />
							</td>
							<td style="text-align: center;">
								<input type="checkbox" disabled="disabled" name="access_rule[2]" value="1" />
							</td>
							<td style="text-align: center;">
								<input type="checkbox" name="access_rule[3]" value="1" />
							</td>
							<td style="text-align: center;">
								<input type="checkbox" name="access_rule[4]" value="1" />
							</td>	
							<td style="text-align: center;">
								<input type="checkbox" name="access_rule[5]" value="1" />
							</td>	
							<td style="text-align: center;">
								<input type="checkbox" disabled="disabled" name="access_rule[6]" value="1" />
							</td>																			
						</tr>';
		}
		$result .= '</table>';	
		return $result;
	}	
}		
?>