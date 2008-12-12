<?php
class WarningModel extends BaseModel{
		function __construct(){
			parent::__construct('warning');
		}
		
		function add($user_id, $cause){
		    
			if (strlen(trim($cause))){
			    $userModel = new UserModel();
			    $currentUser = Project::getUser()->getDbUser();
			    $userModel->load($user_id);
			    if ($userModel->id){
			        $banHistoryModel = new BanHistoryModel();
			        $paramModel = new ParamModel();
    			    $n_warnings_to_ban = $paramModel->getParam("UserController", "N_WARNINGS_TO_BAN");
    			    $t_ban_time_sec = $paramModel->getParam("UserController", "T_BAN_TIME_SEC");
                    $count_user_warnings = $this->getUserWarningCount($user_id);
    			    
    			    
    				$this -> clear();
    				$this -> user_id = (int)$user_id;
    				$this -> cause = $cause;
    				$warning_id = $this -> save();
    				
    				if (($userModel->warnings_fromlast_ban + 1) >= $n_warnings_to_ban){
    			        // пора банить
    			        $subject = "Ваш аккаун заблокирован в системе Next24.ru";
    			        $userModel->warnings_fromlast_ban = 0;
    			        $userModel->banned = 1;
    			        $userModel->banned_date = time();
    			        $banHistoryModel->ban($user_id, $currentUser->id, $warning_id, date("Y-m-d H:i:s", time()+$t_ban_time_sec));
    			        
    			    }else{
    			        $userModel->warnings_fromlast_ban = $userModel->warnings_fromlast_ban+1;
    			        $subject = "Администратор Next24.ru установил Вам предупреждение";
    			    }
    			    $userModel->save();
    			    
    			    $url_referer = $_SERVER['HTTP_REFERER'];
    			    $this->sendMessage((int)$user_id, $subject, $cause, $url_referer);
    			    
    			    return $warning_id;
			    }
			} 
			return 0;
		}
		
		function getUserWarningCount($user_id){
		    $DE = Project::getDatabase();
            $sql = "
                SELECT count(*) as c
                FROM warning
                WHERE user_id = '".$user_id."'
            ";
            $result = $DE -> selectRow($sql);
            return $result['c'];
		}
		
		function sendMessage($user_id, $subject, $cause, $url_referer){
		    $userModel = new UserModel();
		    $user = $userModel->getUserById($user_id);
		    if ($user){
    		    $mailer = new PHPMailer();
    		    $mailer->CharSet = "utf-8";
    			$mailer->From = "info@next24.ru";
    			$mailer->FromName = "Next24.ru";
    			$mailer->Subject = $subject;
    			$sReferer = ($url_referer)?"Ссылка ".$url_referer:"";
    			$body = $subject." <br>Описание: ".$cause." <br>".$sReferer;
    			$alt_body = $subject." \nОписание: ".$cause." \n".$sReferer;
    			$mailer->Body    = $body;  
                $mailer->AltBody = $alt_body;  
                $mailer->AddAddress($user['email'], $user['first_name']." ".$user['middle_name']." ".$user['last_name']); 
    			$mailer->Send();
		    }
		}
}
?>