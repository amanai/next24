<?php
class ArbitrationModel extends BaseModel{
    
    function __construct(){
        parent::__construct('arbitration');
    }
   
   /* 
    function getCorrespondenceBetweenUsers($aUsersID){
        $DE = Project::getDatabase();
        $result = array();
        if ($aUsersID){
            $sUsersId = implode(",",$aUsersID);
            $sql = "
            SELECT messages.*, messages.id as messages_id,
               u_author.login as author_login
            FROM messages
            INNER JOIN users as u_author
                ON u_author.id = messages.author_id
            WHERE messages.author_id IN (".$sUsersId.") AND messages.recipient_id IN (".$sUsersId.") AND (messages.is_deleted = '0' OR messages.is_deleted = '1')";
            $sql .= " ORDER BY messages.send_date ";
            $result = $DE -> select($sql);
        }
        return $result;
    }
    */

}
?>