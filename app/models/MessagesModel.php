<?php
class MessagesModel extends BaseModel{
    
    function __construct(){
        parent::__construct('messages');
    }
    

    function getAllMessagesToUser($page_settings, $recipient_id, $groupId, $isDeleted = 0, $isRead = 0){
        $DE = Project::getDatabase();
        $result = array();
        $sqlLimit = $this->getSqlLimit($page_settings);
        
        if ($groupId >= 0) $addGroupId = " AND friend.group_id = ".(int)$groupId."";
        else $addGroupId = "";
        
        if ($folderId){
            $addSelect = ", friend_group.id as friend_group_id, friend_group.name as friend_group_name";
            $addSql = "
            INNER JOIN friend
                ON friend.user_id = messages.recipient_id AND friend.friend_id = messages.author_id ".$addGroupId."
            INNER JOIN friend_group
                ON friend_group.id = friend.group_id
            ";
            $addWhere = "";
        }else {
            $addSelect = "";
            $addSql = "";
            $addWhere = " AND messages.id NOT IN 
            (
                SELECT messages.id
                FROM messages
                INNER JOIN friend
                    ON friend.user_id = messages.recipient_id AND friend.friend_id = messages.author_id
                WHERE messages.recipient_id = ".(int)$recipient_id."
            )
            ";
        }
        
        if ($isRead >= 0) $addIsRead = " AND messages.is_read = '".(int)$isRead."' ";
        else $addIsRead = "";
        
        $sql = "
            SELECT messages.*, messages.id as messages_id,
               u_author.login as author_login,
               avatars.id as avatars_id, avatars.sys_av_id, avatars.path as avatars_path, avatars.av_name as avatars_av_name, avatars.def as avatars_def,
               sys_av.av_name as sys_av_name, sys_av.path as sys_av_path
               ".$addSelect."
            FROM messages 
            INNER JOIN users as u_author
                ON u_author.id = messages.author_id
            LEFT JOIN avatars
                ON avatars.id = messages.avatar_id
            LEFT JOIN sys_av
                ON sys_av.id = avatars.sys_av_id
            ".$addSql."
            WHERE messages.recipient_id = '".(int)$recipient_id."' AND messages.is_deleted = '".(int)$isDeleted."' ".$addIsRead." ".$addWhere."
            ORDER BY messages.send_date DESC ".$sqlLimit."
        ";
        //echo $sql;
        $result = $DE -> select($sql);
        return $result;
    }
    
    // if $isRead == -1 => не фильтровать читал/не читал, все сообщения
    // if $groupId == -1 => не фильтровать по группам, все сообщения
    function getCountMessagesToUser($recipient_id, $groupId, $isDeleted = 0, $isRead = 0){
        $DE = Project::getDatabase();
        $result = array();
        
        if ($groupId >= 0) $addGroupId = " AND friend.group_id = ".(int)$groupId."";
        else $addGroupId = "";
        
        if ($folderId){
            $addSql = "
            INNER JOIN friend
                ON friend.user_id = messages.recipient_id AND friend.friend_id = messages.author_id ".$addGroupId."
            INNER JOIN friend_group
                ON friend_group.id = friend.group_id
            ";
            $addWhere = "";
        }else {
            $addSql = "";
            $addWhere = " AND messages.id NOT IN 
            (
                SELECT messages.id
                FROM messages
                INNER JOIN friend
                    ON friend.user_id = messages.recipient_id AND friend.friend_id = messages.author_id
                WHERE messages.recipient_id = ".(int)$recipient_id."
            )
            ";
        }
        
        if ($isRead >= 0) $addIsRead = " AND messages.is_read = '".(int)$isRead."' ";
        else $addIsRead = "";
        
        $sql = "
            SELECT count(*) as c
            FROM messages 
            INNER JOIN users as u_author
                ON u_author.id = messages.author_id
            ".$addSql."
            WHERE messages.recipient_id = '".(int)$recipient_id."' AND messages.is_deleted = '".(int)$isDeleted."' ".$addIsRead." ".$addWhere."
            ORDER BY messages.send_date DESC
        ";
        
        $result = $DE -> selectRow($sql);
        return $result['c'];
    }

}
?>