<?php
class UserModel extends BaseModel{
		function __construct(){
			parent::__construct('users');
		}
		
		function login($login, $pwd){
			
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE login=? AND pass=concat(salt, md5(concat(salt, ?)))", $login, $pwd);
			
			if (count($result) > 0){
				$this -> bind($result);
				return true;
			} else {
				return false;
			}
		}
		
		function afterLoad() {
			$ui_model = new UserInterestsModel;
			$this->interest = implode(", ", $ui_model -> getInterests($this -> id));
		}
		
		function afterSave() {
			
		}
		
		function load($id) {
			$result=parent::load($id);
			$this->afterLoad();
			return $result;
		}
		
		function save() {
			$result=parent::save();
			$this->afterSave();
			return $result;
		}
		
		function loadByActivationCode($code, $user_group_id){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE md5(concat(login,salt,pass))=? AND user_type_id=?d LIMIT 1", $code, (int)$user_group_id);
			$this -> bind($result);
			$this->afterLoad();
		}
		
		/** 
		 * Get user group object
		 * */
		function getUserType(){
			$o = new UserTypeModel();
			if ($this -> user_type_id > 0){
				$o -> load($this -> user_type_id);
			}
			return $o;
		}
		
		function loadByLogin($login){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE login=? LIMIT 1", $login);
			$this -> bind($result);
			$this->afterLoad();
		}
		
		function loadByEmail($email){
			$DE = Project::getDatabase();
			$result = array();
			$result = $DE -> selectRow("SELECT * FROM ".$this -> _table." WHERE LOWER(TRIM(email))=? LIMIT 1", strtolower(trim($email)));
			$this -> bind($result);
			$this->afterLoad();
		}
		
		function &getBlog(){
			$blog_model = new BlogModel;
			$blog_model -> loadByUserId($this -> id);
			return $blog_model;
		}
		
		function ban($user_id){
			Project::getDatabase() -> selectRow("UPDATE ".$this -> _table." SET banned=1 WHERE id=?d ", (int)$user_id);
		}
		
		function unban($user_id){
			Project::getDatabase() -> selectRow("UPDATE ".$this -> _table." SET banned=0 WHERE id=?d ", (int)$user_id);
		}
		
		function getActivationCode(){
			return md5($this -> login . $this -> salt . $this -> pass);
		}
    
    /**
    * Запрос основного поиска пользователей
    */
    public function loadSearchUser($p_sex = null, $p_age_from = null, $p_age_to = null, $p_country = null, $p_login = null, $p_with_photo = null, $p_id_interests_tag = null){
      $v_where = '1=1';
      $v_left_join = '';
      if ($p_sex !== null) { 
        if (((int)$p_sex == 0) or ((int)$p_sex == 1)) $v_where .= " and u.`gender` = ".(int)$p_sex;
      }
      if ((int)$p_age_from > 0)   $v_where .= ' and YEAR(now())-YEAR(u.`birth_date`) >= '.(int)$p_age_from;
      if ((int)$p_age_to   > 0)   $v_where .= ' and YEAR(now())-YEAR(u.`birth_date`) <= '.(int)$p_age_to;
      if ((int)$p_country  > 0)   $v_where .= ' and u.`country_id` = '.(int)$p_country;
      if ($p_login !== null)      $v_where .= ' and u.`login` like "%'.$p_login.'%"';
      if ($p_with_photo !== null) $v_where .= ' and p.cnt > 0';
      if ((int)$p_id_interests_tag > 0) {
        $v_left_join = ' LEFT JOIN `users_interests` ui ON ui.`user_id` = u.`id` ';
        $v_where    .= ' and ui.`interest_id` = '.(int)$p_id_interests_tag;
      }
      $sql="
      SELECT 
          u.*,
          YEAR(now())-YEAR(u.`birth_date`) as user_age,
          cn.`name` as country_name,
          ct.`name` as city_name,
          IF(p.cnt is null, 0, p.cnt) as count_photos
        FROM `users` u
          LEFT JOIN `countries` cn ON u.`country_id` = cn.`id`
          LEFT JOIN `cities` ct ON u.`city_id` = ct.`id`
          LEFT JOIN (SELECT p2.`user_id`, count(*) as cnt FROM `photo` p2 GROUP BY p2.`user_id`) p ON u.`id` = p.`user_id`
          ".$v_left_join."
        WHERE ".$v_where."
        ORDER BY u.`reputation` DESC, u.`registration_date`
        LIMIT ?d, ?d 
        ";
      $result = Project::getDatabase() -> 
          selectPage( $this -> _countRecords, 
                      $sql, 
                      $this -> _pager -> getStartLimit(), 
                      $this -> _pager -> getPageSize() /* limit params */
                    );
      $this -> updatePagerAmount();
      return $result;
      
    }
}
?>