<?php
class DebateModel extends BaseModel{
    
    function __construct(){
        parent::__construct('news');
    }
    
    function changeOneValue($table_name, $id, $field, $value){
        $DE = Project::getDatabase();
        $sql = "
            UPDATE ".$table_name." SET ".$field." = ? 
            WHERE id = ?
        ";
        $result = $DE -> query($sql, $value, $id);
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
    
    
    /**
     * Debate_now
     * 
    */ 
    
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
            UPDATE debate_now SET stake_amount = ?, user_id_2 = ?
            WHERE id = ?
        ";
        $DE -> query($sql, $stake_amount, $user_id, $debateNow['id']);
        return true;
    }
    
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
                WHERE ord > ?
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
        return $result;
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
            UPDATE debate_etaps SET is_pause = 1, pause_start = ? , pause_passed = 0
            WHERE id = ?
        ";
        $result = $DE -> query($sql, $currTime, $id);
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
        return $result['c'];
    }
    
    function clearAllThemes(){
        $DE = Project::getDatabase();
        $sql = "
            TRUNCATE TABLE `debate_theme`
        ";
        $result = $DE -> query($sql, $id);
    }
    
    function addTheme($user_id, $theme, $votes=0){
        $DE = Project::getDatabase();
        $sql = "
            INSERT INTO `debate_theme` ( `user_id` , `theme` , `votes` )
            VALUES (
            ?, ?, ?
            )
        ";
        $DE -> query($sql, $user_id, strip_tags($theme), $votes);
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
        echo $sql.$theme_id."<hr>";
        $result = $DE->selectRow($sql, $theme_id);
        $themeCount = $result['c'];
        $sql = "
            UPDATE debate_theme
            SET votes = ?
            WHERE id = ?
        ";
        echo $sql.$themeCount.$theme_id."<hr>";
        $DE -> query($sql, $themeCount, $theme_id);
    }
    
    
    /**
     * END Debate_theme
     * 
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
    
}
?>