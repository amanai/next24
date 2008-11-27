<?php
class UserModel extends BaseModel{
    private $_sTmp;
    
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
		
		function updateInterests() {

		}
		
		function afterLoad(){
			$ui_model = new UserInterestsModel;
			//$this->interest = implode(", ", $ui_model -> getInterests($this -> id));
			$country_model = new CountryModel;
			$country_model -> load($this->country_id);
			$this->country=$country_model ->name;
			$state_model = new StateModel;
			$state_model -> load($this->state_id);
			$this->state=$state_model ->name;
			$city_model = new CityModel;
			$city_model -> load($this->city_id);
			$this->city=$city_model ->name;
		}
		
		function load($id) {
			$result=parent::load($id);
			$this->afterLoad();
			return $result;
		}
		
		function save() {
			// Убираем текстовые поля
			unset($this->_data['country'], $this->_data['state'], $this->_data['city']);
			// ----------------------
			$result=parent::save();
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
    
    
    public function getUserById($user_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT *
            FROM users
            WHERE id = ?
        ";
        $result = $DE -> selectRow($sql, $user_id);
        return $result;
    }
    
    
    
    public function changeUserRate($user_id, $delta_rate){
        $DE = Project::getDatabase();
        $sql ="
            UPDATE users SET rate = (rate + $delta_rate)
            WHERE id = $user_id
        ";
        $DE -> query($sql);
    }
    
    /**
     *  MONEY_TRANSACTION    
    */
    
    public function getMoneyTransactionSumByUser($user_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT sum(amount) as money
            FROM money_transaction
            WHERE user_id = ?
        ";
        $result = $DE -> selectRow($sql, $user_id);
        return $result['money'];
    }
    
    public function changeUserMoney($user_id, $partner_id, $deal_amount, $description = ""){
        $DE = Project::getDatabase();
        $result = array();
        $dateNow = date("Y-m-d H:i:s");
        $sql ="
            INSERT INTO money_transaction (user_id, partner_id, amount, transaction_date, description)
            VALUES ($user_id, $partner_id, '$deal_amount', '$dateNow', '".strip_tags($description)."')
        ";
        //echo $sql; exit;
        $DE -> query($sql);
        
        $userMoney = $this->getMoneyTransactionSumByUser($user_id);
        $sql ="
            UPDATE users SET nextmoney = '$userMoney'
            WHERE id = $user_id
        ";
        $DE -> query($sql);
    }
    
    /**
     *  END ***  MONEY_TRANSACTION    
    */
    
    
    /**
     *  AVATAR
    */
    public function getUserAvatar($user_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT avatars.*, sys_av.av_name as sys_name, sys_av.path as sys_path
            FROM avatars
            LEFT JOIN sys_av
                ON avatars.sys_av_id = sys_av.id
            WHERE avatars.user_id = ? AND avatars.def=1
        ";
        $result = $DE -> selectRow($sql, $user_id);
        if (!$result) {
            $result['id'] = 0;
            $result['user_id'] = $user_id;
            $result['path'] = 'no.png';
            $result['av_name'] = 'no image';
            $result['def'] = 1;
            $result['sys_av_id'] = 0;
        }
        return $result;
    }
    
    public function getAllUserAvatars($user_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT avatars.*, sys_av.av_name as sys_name, sys_av.path as sys_path
            FROM avatars
            LEFT JOIN sys_av
                ON avatars.sys_av_id = sys_av.id
            WHERE avatars.user_id = ?
        ";
        $result = $DE -> select($sql, $user_id);
        return $result;
    }
    
    public function getAllSysAvatars(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT *
            FROM sys_av
        ";
        $result = $DE -> select($sql);
        return $result;
    }
    
    public function getCountAllUserAvatars($user_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT count(*) as c
            FROM avatars
            LEFT JOIN sys_av
                ON avatars.sys_av_id = sys_av.id
            WHERE avatars.user_id = ?
        ";
        $result = $DE -> selectRow($sql, $user_id);
        return $result['c'];
    }
    
    public function getAvatarById($id, $table = ""){
        $DE = Project::getDatabase();
        $result = array();
        $table = ($table)?$table:"avatars";
        $sql = "
            SELECT *
            FROM $table
            WHERE id = ?
        ";
        $result = $DE -> selectRow($sql, $id);
        return $result;
    }
    
    public function addUserAvatar($user_id, $path, $av_name, $def, $sys_av_id = 0){
        $DE = Project::getDatabase();
        $sql ="
            INSERT INTO avatars  ( `user_id` , `sys_av_id` , `path` ,  `av_name` , `def` )
            VALUES (?, ?, '".$path."',  '".stripslashes(htmlspecialchars($av_name))."', ? )
        ";
        $DE -> query($sql, $user_id, $sys_av_id, $def);
    }
    
    public function addSystemAvatar($path, $av_name){
        $DE = Project::getDatabase();
        $sql ="
            INSERT INTO sys_av  ( `path` ,  `av_name`)
            VALUES ('".$path."',  '".stripslashes(htmlspecialchars($av_name))."')
        ";
        $DE -> query($sql);
    }
    
    // if OK return false, else return problem description
    public function uploadImgFile($uploaddir, $file){
        $UploadRes = array();
        $UploadRes['error'] = false;
        if ($file['type'] != 'image/jpeg' && $file['type'] != 'image/gif' && $file['type'] != 'image/png'){
            $UploadRes['error'] = true;
            $UploadRes['error_message'] = "Принимаются только форматы GIF, JPEG, PNG. ";
            return $UploadRes;
        }
        $sName = $this -> makeNormalName($file['name']);
        $this->getUploadFileName($uploaddir, $sName); // get a free file name, to not replace other image
        $sName = $this->_sTmp;
        $uploadfile = $uploaddir.$sName;
        if (move_uploaded_file( $file['tmp_name'], $uploadfile)){
            $asido = new Asido();
            $asido->Driver('gd');
            $im = $asido->Image($uploadfile, $uploadfile);
            $asido->Fit($im, 90, 90);
            $im->Save(ASIDO_OVERWRITE_ENABLED);
            $UploadRes['file_name'] = $sName;
            
            return $UploadRes;
        } else {
            $UploadRes['error'] = true;
            $UploadRes['error_message'] = "Проблема при загрузке файла на сервер. Обратитесь к администратору.";
            return $UploadRes;
        }
    }
    
    public function makeNormalName($sName){
        $sName=strtolower(trim($sName));
        $sName = ereg_replace("[^a-zA-Z_0-9\.]","_",$sName);
        return $sName;
    }
    
    public function getUploadFileName($uploaddir, $sName, $addStr = ""){
        if (is_file($uploaddir.$sName)){
            $sName = substr($sName, strlen($addStr));
            $newAddStr = rand(1, 999999);
            $this->getUploadFileName($uploaddir, $newAddStr.$sName, $newAddStr);
        }
        else $this->_sTmp = $sName;
    }
    
    public function setDefaultAvatar($user_id, $avatar_id){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE `avatars` SET def = 0 
            WHERE user_id = ?
        ";
        $DE -> query($sql, $user_id);
        
        $sql = "
            UPDATE `avatars` SET def = 1 
            WHERE id = ?
        ";
        $DE -> query($sql, $avatar_id);
    }
    
    function delAvatar($table, $avatar_id, $uploaddir){
        $DE = Project::getDatabase();
        $avatar = $this->getAvatarById($avatar_id, $table);
        if ($avatar){
            if (is_file($uploaddir.$avatar['path'])) unlink($uploaddir.$avatar['path']);
            $sql = "
                DELETE FROM `$table`
                WHERE id = ?
            ";
            $DE -> query($sql, $avatar_id);
        }
    }
    
    /**
     *  END ***  AVATAR
    */
    
    // $result['rate'] - rate       $result['nm'] - next money , by registration information
    public function getUserRateNMByRegistrationData($user_id){
        $user = $this->getUserById($user_id);
        $result = array();
        if ($user){
            $rate = 0; $rate2 = 0; $nm = 0;
    		if ($user['first_name']) $rate += 1;
    		if ($user['middle_name']) $rate += 1;
    		if ($user['last_name']) $rate += 1;
    		
    		if ($user['birth_date']) $rate += 1;
    		$rate += 1;
    		if ($user['marital_status']) $rate += 1;
    		if ($user['icq']) $rate += 1;
    		if ($user['website']) $rate += 1;
    		if ($user['phone']) $rate += 1;
    		if ($user['mobile_phone']) $rate += 1;
    		if ($user['books']) $rate2 += 1;
    		if ($user['films']) $rate2 += 1;
    		if ($user['musicians']) $rate2 += 1;
    		if ($user['interest']) $rate2 += 1;
    		
    		if ($user['country_id']) $rate += 3;
    		if ($user['state_id']) $rate += 1;
    		if ($user['city_id']) $rate += 2;
    		
    		$nm += $rate*1.5/15;
			$nm += $rate2*1.5/4;
    		$result['rate'] = $rate+$rate2;
            $result['nm'] = $nm;
        }else{
            $result['rate'] = 0;
            $result['nm'] = 0;
        }
        return $result;
    }
    
    function changeOneValue($table_name, $id, $field, $value){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE `$table_name` SET $field = '$value' 
            WHERE id = $id
        ";
        //echo $sql; exit;
        $result = $DE -> query($sql);
    }
    
    function getOneRecord($table_name, $id){
        $DE = Project::getDatabase();
        $sql = "
            SELECT * FROM ".$table_name." 
            WHERE id = ?
        ";
        $result = $DE -> selectRow($sql, $id);
        return $result;
    }
    
    function delOneRecord($table_name, $id){
        $DE = Project::getDatabase();
        $sql = "
            DELETE FROM ".$table_name." 
            WHERE id = ?
        ";
        $result = $DE -> query($sql, $id);
        return $result;
    }
}
?>