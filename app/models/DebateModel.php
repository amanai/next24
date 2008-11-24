<?php
class DebateModel extends BaseModel{
    
    function __construct(){
        parent::__construct('news');
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
    
    function truncateTable($table_name){
        $DE = Project::getDatabase();
        $sql = "
            TRUNCATE TABLE `$table_name`
        ";
        $result = $DE -> query($sql);
        return $result;
    }
    
    function getLastId($table_name){
        $DE = Project::getDatabase();
        $sql = "
            SELECT id FROM ".$table_name." 
            ORDER BY id DESC
            LIMIT 0, 1
        ";
        //echo $sql;
        $result = $DE -> selectRow($sql, $id);
        if ($result) return $result['id'];
        else return $result;
    }
    /**
     * Debate_now
     * 
    */ 
    
    function addDebateNow(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            INSERT INTO `debate_now` ( `start_time` , `debate_theme_id` , `theme` , `stake_amount` , `user_id_1` , `user_id_2` , `helper_id_1_1` , `helper_id_1_2` , `helper_id_2_1` , `helper_id_2_2` , `is_ready_1` , `is_ready_2` , `helper_1_1_rate` , `helper_1_2_rate` , `helper_2_1_rate` , `helper_2_2_rate` )
            VALUES (
            '".date("Y-m-d H:i:s")."', NULL , NULL , '0', NULL , NULL , NULL , NULL , NULL , NULL , NULL , NULL , '0', '0', '0', '0'
            )
        ";
        $result = $DE -> selectRow($sql);
        return $result;
    }
    
    function getDebateNow(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM debate_now 
        ";
        $result = $DE -> selectRow($sql);
        return $result;
    }
    
    function doStakeSecondUser($user_id, $stake_amount, $debateNow=array()){
        $DE = Project::getDatabase();
        if (!$debateNow) $debateNow = $this->getDebateNow();
        if ($stake_amount <= $debateNow['stake_amount']) return false;
        $sql ="
            UPDATE debate_now SET stake_amount = '$stake_amount', user_id_2 = $user_id
            WHERE id = ".$debateNow['id']."
        ";
        //echo $stake_amount; exit;
        $DE -> query($sql);
        return true;
    }
    
    function getDebateHistory($page_settings, $order){
        $DE = Project::getDatabase();
        $result = array();
        $sqlLimit = $this->getSqlLimit($page_settings);
        $sql ="
            SELECT *
            FROM debate_history
            ORDER BY ".$order."
        ".$sqlLimit;
        $result = $DE -> select($sql);
        return $result;
    }
    
    function getDebateHistoryCount(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT count(*) as c
            FROM debate_history
        ";
        $result = $DE -> selectRow($sql);
        if ($result)  return $result['c'];
        return 0;
    }
    
    function addDebateHistory($start_time, $theme, $stake_amount, $user_id_1, $user_id_2, $helper_id_1_1, $helper_id_1_2,
                              $helper_id_2_1, $helper_id_2_2, $user1_vote, $user2_vote, $debate_protocol){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            INSERT INTO `debate_history` ( `start_time` , `theme` , `stake_amount` , `user_id_1` , `user_id_2` , 
                `helper_id_1_1` , `helper_id_1_2` , `helper_id_2_1` , `helper_id_2_2` , 
                `user1_vote` , `user2_vote` , `debate_protocol` )
            VALUES ('$start_time', '$theme', '$stake_amount', '$user_id_1', '$user_id_2', '$helper_id_1_1', '$helper_id_1_2', 
                    '$helper_id_2_1', '$helper_id_2_2', '$user1_vote', '$user2_vote', '$debate_protocol')
        ";
        $result = $DE -> query($sql);
        return mysql_insert_id();
    }
    
    
    
    
    //  helper can say
    function getHelperCanSay(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM debate_helper_cansay
        ";
        $result = $DE -> select($sql);
        return $result;
    }
    
    // return array, where key -> helper_id, value -> 1
    function getHelperCanSay2(){
        $aHelperCanSay = $this->getHelperCanSay();
        $result = array();
        foreach ($aHelperCanSay as $helperCanSay){
            $result[$helperCanSay['helper_id']] = 1;
        }
        
        return $result;
    }
    
    function isHelperCanSay($helper_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM debate_helper_cansay
            WHERE helper_id = ?
        ";
        $result = $DE -> selectRow($sql, $helper_id);
        return $result;
    }
    
    function addHelperCanSay($helper_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            INSERT INTO debate_helper_cansay (helper_id)
            VALUES (?)
        ";
        $DE -> query($sql, $helper_id);
    }
    
    function delHelperCanSay($helper_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            DELETE FROM debate_helper_cansay 
            WHERE helper_id = ?
        ";
        $DE -> query($sql, $helper_id);
    }
    // END helper can say
    
    /**
     * END Debate_now
     * 
    */ 
    
    /**
     * Debate_etaps
     * 
    */ 
    
    function getAllEtaps(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM debate_etaps
            ORDER BY ord
        ";
        $result = $DE -> select($sql);
        return $result;
    }
    
    function getFirstEtap(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM debate_etaps
            ORDER BY ord
            LIMIT 0, 1
        ";
        $result = $DE -> selectRow($sql);
        return $result;
    }
    
    function getNextEtap($id){
        $DE = Project::getDatabase();
        $result = array();
        $flag = false;
        $currentEtap = $this->getEtapById($id);
        if ($currentEtap){
            $sql ="
                SELECT * 
                FROM debate_etaps
                WHERE id > ?
                ORDER BY ord
                LIMIT 0, 1
            ";
            $result = $DE -> selectRow($sql, $currentEtap['ord']);
            if (!$result) $flag = true;
        }else{
            $flag = true;
        }        
        if ($flag) $result = $this->getFirstEtap();
        return $result;
    }
    
    function getActiveEtap(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM debate_etaps
            WHERE is_active = 1 
            ORDER BY ord
        ";
        $result = $DE -> selectRow($sql);
        return $result;
    }
    
    function getEtapById($id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM debate_etaps
            WHERE id = ? 
        ";
        $result = $DE -> selectRow($sql, $id);
        return $result;
    }
    
    function getEtapByName($name){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM debate_etaps
            WHERE name = '$name' 
        ";
        $result = $DE -> selectRow($sql);
        return $result;
    }
    
    /**
     * CHECK is duration > passed time. 
     * return (duration - passed)
     */
    function checkEtapDuration($id){ 
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT (duration - passed) as  duration_passed
            FROM debate_etaps
            WHERE id = ? 
        ";
        $result = $DE -> selectRow($sql, $id);
        if ($result) return $result['duration_passed'];
        else return 0;
    }
    
    function checkPauseDuration($id){ 
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT pause_passed
            FROM debate_etaps
            WHERE id = ? 
        ";
        $result = $DE -> selectRow($sql, $id);
        if ($result)  return $result['pause_passed'];
        else return 0;
    }
    
    function startEtap($id){
        $DE = Project::getDatabase();
        $currTime = date("Y-m-d H:i:s");
        $sql = "
            UPDATE debate_etaps SET is_active = 1, start = ? , passed = 0, is_pause = 0, pause_start = '', pause_passed = 0, pause_passed_sum = 0 
            WHERE id = ?
        ";
        $result = $DE -> query($sql, $currTime, $id);
    }
    
    function stopEtap($id){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE debate_etaps SET is_active = 0, start = '', passed = 0, is_pause = 0, pause_start = '', pause_passed = 0, pause_passed_sum = 0 
            WHERE id = ?
        ";
        $result = $DE -> query($sql, $id);
    }
    
    
    function pauseOnEtap($id){
        $DE = Project::getDatabase();
        $currTime = date("Y-m-d H:i:s");
        $sql = "
            UPDATE debate_etaps SET is_pause = 1, pause_start = '$currTime' , pause_passed = 0
            WHERE id = ?
        ";
        $result = $DE -> query($sql, $id);
    }
    
    function pauseOffEtap($id){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE debate_etaps SET is_pause = 0, pause_start = '' , pause_passed_sum = pause_passed_sum+pause_passed
            WHERE id = ?
        ";
        $result = $DE -> query($sql, $id);
    }
    
    function setPausePassedEtap($id){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE debate_etaps SET pause_passed = UNIX_TIMESTAMP() - UNIX_TIMESTAMP(pause_start)
            WHERE id = ?
        ";
        $result = $DE -> query($sql, $id);
    }
    
    function setPassedEtap($id){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE debate_etaps SET passed = UNIX_TIMESTAMP() - UNIX_TIMESTAMP(start) - pause_passed_sum
            WHERE id = ?
        ";
        $result = $DE -> query($sql, $id);
    }
    
    /**
     * END Debate_etaps
     * 
    */ 
    
    
    /**
     * Debate_theme
     * 
    */ 
    
    function getAllThemes($page_settings=array(), $order="debate_theme.votes DESC"){
        $DE = Project::getDatabase();
        $result = array();
        $sqlLimit = $this->getSqlLimit($page_settings);
        $sql ="
            SELECT users.login, 
                   debate_theme.id as debate_theme_id, debate_theme.user_id, debate_theme.theme as debate_theme_theme, 
                   debate_theme.votes as debate_theme_votes
            FROM debate_theme
            INNER JOIN users
                ON debate_theme.user_id = users.id
            ORDER BY ".$order."
        ".$sqlLimit;
        $result = $DE -> select($sql);
        return $result;
    }
    
    function getThemeById($theme_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT users.login, 
                   debate_theme.id as debate_theme_id, debate_theme.user_id, debate_theme.theme as debate_theme_theme, 
                   debate_theme.votes as debate_theme_votes
            FROM debate_theme
            INNER JOIN users
                ON debate_theme.user_id = users.id
            WHERE  debate_theme.id = ?               
        ";
        $result = $DE -> selectRow($sql, $theme_id);
        return $result;
    }
    
    function getThemesCount(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT count(*) as c
            FROM debate_theme
        ";
        $result = $DE -> selectRow($sql);
        if ($result)  return $result['c'];
        return 0;
    }
    
    function addTheme($user_id, $theme, $votes=0){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `debate_theme` ( `user_id` , `theme` , `votes` )
            VALUES (
            ?, ?, ?
            )
        ";
        $DE -> query($sql, $user_id, htmlspecialchars($theme), $votes);
        return mysql_insert_id();
    }
    
    function deleteTheme($theme_id){
        $DE = Project::getDatabase();
        $sql = "
            DELETE FROM `debate_theme`
            WHERE id = ?
        ";
        return $DE -> query($sql, $theme_id);
    }
    
    
    function getThemeVoteByUserId($user_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT *
            FROM debate_theme_vote
            WHERE user_id = ?
        ";
        $result = $DE -> select($sql, $user_id);
        return $result;
    }
    
    function addThemeVote($user_id, $theme_id){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `debate_theme_vote` ( `user_id` , `debate_theme_id` )
            VALUES (
            ?, ?
            )
        ";
        $DE -> query($sql, $user_id, $theme_id);
        $sql = "
            SELECT count(*) as c
            FROM debate_theme_vote 
            WHERE debate_theme_id = ?
        ";
        //echo $sql.$theme_id."<hr>";
        $result = $DE->selectRow($sql, $theme_id);
        $themeCount = $result['c'];
        $sql = "
            UPDATE debate_theme
            SET votes = ?
            WHERE id = ?
        ";
        //echo $sql.$themeCount.$theme_id."<hr>";
        $DE -> query($sql, $themeCount, $theme_id);
    }
    
    function getVoteWinnerTheme(){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT debate_theme_vote.debate_theme_id, debate_theme.theme, count(*) as c
            FROM debate_theme_vote
            INNER JOIN debate_theme
                ON debate_theme.id = debate_theme_vote.debate_theme_id
            GROUP BY debate_theme_vote.debate_theme_id, debate_theme.theme
            ORDER BY c DESC
            LIMIT 0, 1
        ";
        $result = $DE -> select($sql, $user_id);
        if ($result && count($result)>0) $winnerTheme = $result[0];
        else $winnerTheme = array();
        return $winnerTheme;
    }
    
    
    /**
     * END Debate_theme
     * 
    */ 
    
    
    /**
     * Debate_helper_check
     * 
    */ 
    
    function getHelpersByDebateUserId($debate_user_id){
        $DE = Project::getDatabase();
        $sql = "
            SELECT *
            FROM debate_helper_check
            INNER JOIN users
                ON users.id = debate_helper_check.helper_id
            WHERE debate_user_id = ? 
        ";
        return $DE -> select($sql, $debate_user_id);
    }
    
    // возвращает helper_id кроме $exeptUserId. Для того, когда пользователь не выбрал помощников, ему назначают любых
    function getHelperByDebateUserId_exept($debate_user_id, $exeptUserId){
        $DE = Project::getDatabase();
        $sql = "
            SELECT *
            FROM debate_helper_check
            WHERE debate_user_id = $debate_user_id AND helper_id <> $exeptUserId
            LIMIT 0, 1
        ";
        $result = $DE -> selectRow($sql);
        if ($result && count($result)>0) $helper_id = $result['helper_id'];
        else $helper_id = 0;
        return $helper_id;
    }
    
    function addHelperCheck($helper_id, $debate_user_id){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `debate_helper_check` ( `helper_id` , `debate_user_id` )
            VALUES (
            ?, ?
            )
        ";
        $DE -> query($sql, $helper_id, $debate_user_id);
    }
    
    function isInHelperTable($helper_id){
        $DE = Project::getDatabase();
        $sql = "
            SELECT *
            FROM debate_helper_check
            INNER JOIN users
                ON users.id = debate_helper_check.debate_user_id
            WHERE helper_id = ?
        ";
        return $DE -> selectRow($sql, $helper_id);
    }
    
    /**
     * END Debate_helper_check
     * 
    */ 
    
    
    
    /**
     *  Debate_stakes
     * 
    */ 
    
    function getDebateStakes($debate_history_id){
        $DE = Project::getDatabase();
        $sql = "
            SELECT *
            FROM debate_stakes
            WHERE debate_history_id = ?
        ";
        $result = $DE -> select($sql, $debate_history_id);
        return $result;
    }
    
    function getDebateStakesByUserId($user_id, $debate_history_id){
        $DE = Project::getDatabase();
        $sql = "
            SELECT *
            FROM debate_stakes
            WHERE user_id = ? AND debate_history_id = ?
        ";
        $result = $DE -> select($sql, $user_id, $debate_history_id);
        return $result;
    }
    
    function getDebateStakesByDebateUserId($debate_user_id, $debate_history_id){
        $DE = Project::getDatabase();
        $sql = "
            SELECT *
            FROM debate_stakes
            WHERE debate_user_id = ? AND debate_history_id = ?
        ";
        $result = $DE -> select($sql, $debate_user_id, $debate_history_id);
        return $result;
    }
    
    function getDebateStakesCount($debate_user_id = 0, $debate_history_id = 0){
        $DE = Project::getDatabase();
        if ($debate_user_id) $sqlWhere = " AND debate_user_id = ".$debate_user_id; else $sqlWhere = "";
        $sql = "
            SELECT count(*) as stakesCount
            FROM debate_stakes
            WHERE debate_history_id = ? ".$sqlWhere."
        ";
        $result = $DE -> selectRow($sql, $debate_history_id);
        return $result['stakesCount'];
    }
    
    function getDebateStakesSum($debate_user_id = 0, $debate_history_id = 0){
        $DE = Project::getDatabase();
        if ($debate_user_id) $sqlWhere = " AND debate_user_id = ".$debate_user_id; else $sqlWhere = "";
        $sql = "
            SELECT sum(stake_amount) as stakesSum
            FROM debate_stakes
            WHERE debate_history_id = ? ".$sqlWhere."
        ";
        $result = $DE -> selectRow($sql, $debate_history_id);
        return $result['stakesSum'];
    }
    
    function doStake($user_id, $debate_user_id, $stake_amount, $debate_history_id = 0){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `debate_stakes` (`user_id` , `debate_user_id` , `stake_amount` , `debate_history_id` )
            VALUES ('$user_id', '$debate_user_id', '$stake_amount', '$debate_history_id')
        ";
        //echo $sql; exit;
        $DE -> query($sql);
        return true;
    }
    
    function setStakeHistoryId($old_history_id, $debate_history_id){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE debate_stakes SET debate_history_id = ? 
            WHERE debate_history_id = ?
        ";
        $DE -> query($sql, $debate_history_id, $old_history_id);
        return true;
    }
    
    /**
     * END Debate_stakes
     * 
    */ 
    
    
    /**
     *  CHAT !!!
     * 
    */ 
    
    function addChatLine($dbTable, $user_id, $message, $message_time, $debate_user_id = 0){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO $dbTable (user_id, message, message_time, debate_user_id)
            VALUES ($user_id, '".addslashes(htmlspecialchars($message))."', '$message_time', $debate_user_id)
        ";
        
        $DE -> query($sql);
        return true;
    }
    
    function getChatLines($dbTable, $debateChatId, $debate_user_id = 0){
        $DE = Project::getDatabase();
        //if ($debateChatId){
            $sql = "
                SELECT $dbTable.*, users.login FROM $dbTable 
                INNER JOIN users 
                    ON $dbTable.user_id = users.id
                WHERE $dbTable.id > '$debateChatId' AND debate_user_id = $debate_user_id
                ORDER BY $dbTable.id
            ";
            $result = $DE -> select($sql);
        /*
        }else{
            $sql = "
                SELECT $dbTable.*, users.login FROM $dbTable 
                INNER JOIN users 
                    ON $dbTable.user_id = users.id
                WHERE debate_user_id = $debate_user_id
                ORDER BY $dbTable.id DESC
            ";
            $result2 = $DE -> select($sql); 
            $result = array();
            for ($i = count($result2)-1; $i>=0; $i--){
                $result[]=$result2[$i];
            }
        }
        */
        return $result;
    }
    
    function getChatInText($dbTable, $debateChatId){
        $aChatLines = $this->getChatLines($dbTable, $debateChatId);
        $text = '';
        foreach ($aChatLines as $chatLine){
            $text .= $chatLine['login'].'['.$chatLine['message_time'].']'.$chatLine['message'].'\n';
        }
        
        return $text;
    }
    
    /**
     * END CHAT !!!
     * 
    */ 
    
    
    /**
     * debate user Vote
     */
    
    function addDebateVote($user_id, $debate_user_id){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `debate_user_vote` ( `user_id` , `debate_user_id` )
            VALUES (
            ?, ?
            )
        ";
        $DE -> query($sql, $user_id, $debate_user_id);
    }
    
    function isUserDebateVoted($user_id){
        $DE = Project::getDatabase();
        $sql = "
            SELECT * FROM debate_user_vote
            WHERE user_id = ?
        ";
        return $DE -> select($sql, $user_id);
    }
    
    function getDebateResults(){
        $DE = Project::getDatabase();
        $sql = "
            SELECT debate_user_id, count(*) as c 
            FROM `debate_user_vote`
            GROUP BY debate_user_id
        ";
        $debateResult = $DE -> select($sql, $user_id);
        $result = array();
        foreach ($debateResult as $debate){
            $result[$debate['debate_user_id']] = $debate['c'];
        }
        return $result;
    }
    
    /**
     * END debate user Vote
     */
    
    
    
    // формиирует LIMIT для SQL запроса, для PAGER
    function getSqlLimit($page_settings=array()){
        if (is_array($page_settings) && count($page_settings)>0){
            $record_per_page = $page_settings['record_per_page'];
            $current_page_number = $page_settings['current_page_number'];
            $sqlLimit = " LIMIT ".(($current_page_number-1)*$record_per_page).", ".$record_per_page." ";;
        }else $sqlLimit ="";
        
        return $sqlLimit;
    }
    
    function getUserByHelper($debateNow, $helper_id){
        $user_id = 0;
        if ($helper_id){
            if ($debateNow['helper_id_1_1'] == $helper_id || $debateNow['helper_id_1_2'] == $helper_id) $user_id = $debateNow['user_id_1'];
            elseif ($debateNow['helper_id_2_1'] == $helper_id || $debateNow['helper_id_2_2'] == $helper_id) $user_id = $debateNow['user_id_2'];
        }
        
        return $user_id;
    }
    
    function getUserNumber($debateNow, $user_id){
        $userNumber = 0;
        if ($user_id){
            if ($debateNow['user_id_1'] == $user_id) $userNumber = 1;
    		elseif ($debateNow['user_id_2'] == $user_id) $userNumber = 2;
        }
		return $userNumber;
    }
    
    function getHtmlChatText($aChatLines, $debateNow){
        $htmlChatText = '';
        foreach ($aChatLines as $chatLine){
            $helperUserId = $this->getUserByHelper($debateNow, $chatLine['user_id']);
            $helperUserNumber = $this->getUserNumber($debateNow, $helperUserId);
            
            if ($helperUserNumber) $addMsg = '<span class="gray" >Помощник '.$helperUserNumber.'-го участника '; else $addMsg = "";
            $userSayLogin = $chatLine['login'];
            $htmlChatText .= '
            <div class="ChatLine">
                <span class="ChatLineNick">'.$addMsg.'<a style="font-weight: bold;" href="'.Project::getRequest()->createUrl('User', 'Profile', null, $userSayLogin).'" class="Nick" target="_blank">'.$userSayLogin.'</a></span>: 
				<span class="TextRow">'.$chatLine['message'].'</span>
            </div>';
        }
        return $htmlChatText;
    }
    
    function getLastIdFromArray($arr){
        $lastId = 0;
        if (count($arr)>0) $lastId = $arr[count($arr)-1]['id'];
        return $lastId;
    }
    
    function getWinnerId($debateResult, $debateNow){
        if ($debateResult[$debateNow['user_id_1']] > $debateResult[$debateNow['user_id_2']]){
		    $winnerUserId = $debateNow['user_id_1'];
		}elseif ($debateResult[$debateNow['user_id_1']] < $debateResult[$debateNow['user_id_2']]){
		    $winnerUserId = $debateNow['user_id_2'];
		}else{ // nobody win
		    $winnerUserId = 0;
		}
		
		return $winnerUserId;
    }    
   
}
?>