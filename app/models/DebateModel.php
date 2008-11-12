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
}
?>