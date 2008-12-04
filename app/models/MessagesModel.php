<?php
class MessagesModel extends BaseModel{
    
    function __construct(){
        parent::__construct('messages');
    }
    

    function getAllMessagesToUser($recipient_id){
        $DE = Project::getDatabase();
        $result = array();
        $sql ="
            SELECT * 
            FROM messages 
            INNER JOIN users as u_author
                ON u_author.id = messages.author_id
            LEFT JOIN friend
                ON friend.user_id = messages.recipient_id AND friend.friend_id = messages.author_id
            WHERE messages.recipient_id = ?d
            ORDER BY send_date DESC
        ";
        $result = $DE -> select($sql);
        return $result;
    }

}
?>